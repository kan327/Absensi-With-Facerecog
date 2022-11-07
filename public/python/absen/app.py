from flask import Flask, render_template, request, session, redirect, url_for, Response, jsonify
import mysql.connector
import cv2
from PIL import Image
import numpy as np
import os
import time
from datetime import date
 
app = Flask(__name__)
 
cnt = 0
pause_cnt = 0
justscanned = False
 
mydb = mysql.connector.connect(
    host="localhost",
    user="root",
    passwd="",
    database="db_absensi"
)
mycursor = mydb.cursor()
mycursor2 = mydb.cursor()
 
 
# Generate dataset
def generate_dataset(nbr):
    face_classifier = cv2.CascadeClassifier("resources/haarcascade_frontalface_default.xml")
 
    def face_cropped(img):
        gray = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)
        faces = face_classifier.detectMultiScale(gray, 1.3, 5)
        # scaling factor=1.3
        # Minimum neighbor = 5
 
        if faces is ():
            return None
        for (x, y, w, h) in faces:
            cropped_face = img[y:y + h, x:x + w]
        return cropped_face
 
    cap = cv2.VideoCapture(0)
 
    mycursor.execute("select ifnull(max(img_id), 0) from images")
    row = mycursor.fetchone()
    lastid = row[0]
 
    img_id = lastid
    max_imgid = img_id + 100
    count_img = 0
 
    while True:
        ret, img = cap.read()
        if face_cropped(img) is not None:
            count_img += 1
            img_id += 1
            face = cv2.resize(face_cropped(img), (1000, 700))
            face = cv2.cvtColor(face, cv2.COLOR_BGR2GRAY)
 
            file_name_path = "dataset/"+nbr+"."+ str(img_id) + ".jpg"
            cv2.imwrite(file_name_path, face)
            cv2.putText(face, str(count_img), (50, 50), cv2.FONT_HERSHEY_COMPLEX, 1, (0, 255, 0), 2)
 
            mycursor.execute("""INSERT INTO `images` (`img_id`, `img_person`) VALUES
                                ('{}', '{}')""".format(img_id, nbr))
            mydb.commit()
 
            frame = cv2.imencode('.jpg', face)[1].tobytes()
            yield (b'--frame\r\n'b'Content-Type: image/jpeg\r\n\r\n' + frame + b'\r\n')
 
            if cv2.waitKey(1) == 13 or int(img_id) == int(max_imgid):
                break
                cap.release()
                cv2.destroyAllWindows()
 
 
# Train Classifier
@app.route('/train_classifier/<nbr>')
def train_classifier(nbr):
    dataset_dir = "dataset"
 
    path = [os.path.join(dataset_dir, f) for f in os.listdir(dataset_dir)]
    faces = []
    ids = []
 
    for image in path:
        img = Image.open(image).convert('L')
        imageNp = np.array(img, 'uint8')
        id = int(os.path.split(image)[1].split(".")[1])
 
        faces.append(imageNp)
        ids.append(id)
    ids = np.array(ids)
 
    # Train the classifier and save
    clf = cv2.face.LBPHFaceRecognizer_create()
    clf.train(faces, ids)
    clf.write("classifier.xml")
 
    return redirect('/mastersiswa')
 
 
# Face Recognition
def face_recognition():  # generate frame by frame from camera
    def draw_boundary(img, classifier, scaleFactor, minNeighbors, color, text, clf):
        gray_image = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)
        features = classifier.detectMultiScale(gray_image, scaleFactor, minNeighbors)
 
        global justscanned
        global pause_cnt
 
        pause_cnt += 1
 
        coords = []
 
        for (x, y, w, h) in features:
            cv2.rectangle(img, (x, y), (x + w, y + h), color, 2)
            id, pred = clf.predict(gray_image[y:y + h, x:x + w])
            confidence = int(100 * (1 - pred / 300))
 
            if confidence > 70 and not justscanned:
                global cnt
                cnt += 1
 
                n = (100 / 30) * cnt
                # w_filled = (n / 100) * w
                w_filled = (cnt / 30) * w
 
                cv2.putText(img, str(int(n))+' %', (x + 20, y + h + 28), cv2.FONT_HERSHEY_SIMPLEX, 0.8, (153, 255, 255), 2, cv2.LINE_AA)
 
                cv2.rectangle(img, (x, y + h + 40), (x + w, y + h + 50), color, 2)
                cv2.rectangle(img, (x, y + h + 40), (x + int(w_filled), y + h + 50), (153, 255, 255), cv2.FILLED)
 
                mycursor.execute("select a.img_person, b.nama, b.kelas, b.nisn "
                                 "  from images a "
                                 "  left join data_person b on a.img_person = b.id_master "
                                 " where img_id = " + str(id))
                row = mycursor.fetchone()
                pnbr = row[0]
                pname = row[1]
                pskill = row[2]
 
                if int(cnt) == 30:
                    cnt = 0
 
                    mycursor.execute("INSERT INTO attendance_datamaster (attendance_date, attendance_person) values('"+str(date.today())+"', '" + pnbr + "')")
                    mydb.commit()
 
                    cv2.putText(img, pname + ' | ' + pskill, (x - 10, y - 10), cv2.FONT_HERSHEY_SIMPLEX, 0.8, (153, 255, 255), 2, cv2.LINE_AA)
                    time.sleep(3)
                    # #######

                    justscanned = True
                    pause_cnt = 0
 
            else:
                if not justscanned:
                    cv2.putText(img, 'UNKNOWN', (x, y - 5), cv2.FONT_HERSHEY_SIMPLEX, 0.8, (0, 0, 255), 2, cv2.LINE_AA)
                else:
                    cv2.putText(img, ' ', (x, y - 5), cv2.FONT_HERSHEY_SIMPLEX, 0.8, (0, 0, 255), 2,cv2.LINE_AA)
 
                if pause_cnt > 80:
                    justscanned = False
 
            coords = [x, y, w, h]
        return coords
 
    def recognize(img, clf, faceCascade):
        coords = draw_boundary(img, faceCascade, 1.1, 10, (255, 255, 0), "Face", clf)
        return img
 
    faceCascade = cv2.CascadeClassifier("resources/haarcascade_frontalface_default.xml")
    clf = cv2.face.LBPHFaceRecognizer_create()
    clf.read("classifier.xml")
 
    wCam, hCam = 400, 400
 
    cap = cv2.VideoCapture(0)
    cap.set(3, wCam)
    cap.set(4, hCam)
 
    while True:
        ret, img = cap.read()
        img = recognize(img, clf, faceCascade)
 
        frame = cv2.imencode('.jpg', img)[1].tobytes()
        yield (b'--frame\r\n'
               b'Content-Type: image/jpeg\r\n\r\n' + frame + b'\r\n\r\n')
 
        key = cv2.waitKey(1)
        if key == 27:
            break
 
 
 
@app.route('/absensiswa')
def home():
    mycursor.execute("SELECT a.attendance_id, a.attendance_person, b.nama, b.kelas, b.nisn, date_format(a.attendance_in, '%H:%i:%s') "
                     " FROM attendance_datamaster a "
                     " LEFT JOIN data_person b ON a.attendance_person = b.id_master "
                     " WHERE a.attendance_date = curdate() "
                     " ORDER BY a.attendance_date desc")
    data = mycursor.fetchall()
 
    return render_template('absensiswa.html', data=data)

@app.route('/mastersiswa')
def master():
    mycursor.execute("SELECT id_master, nama, kelas, nisn, gender, added_on FROM data_person")
    data = mycursor.fetchall()

    return render_template('mastersiswa.html', data=data)
 
@app.route('/addprsn')
def addprsn():
    mycursor.execute("select ifnull(max(id_master) + 1 , 1001) from data_person")
    row = mycursor.fetchone()
    nbr = row[0]
    # print(int(nbr))
 
    return render_template('form.html', newnbr=int(nbr))
 
@app.route('/addprsn_submit', methods=['POST'])
def addprsn_submit():
    prsnbr = request.form.get('id')
    nama = request.form.get('nama')
    kelas = request.form.get('kelas')
    gender = request.form.get('jkelamin')
    nisn = request.form.get('nisn')
 
    mycursor.execute("""INSERT INTO `data_person` (`id_master`, `nama`, `kelas`, `gender`, `nisn`) VALUES ('{}', '{}', '{}', '{}', '{}')""".format(prsnbr, nama, kelas, gender, nisn))
    mydb.commit()
 
    # return redirect(url_for('home'))
    return redirect(url_for('vfdataset_page', prs=prsnbr, name=nama))
 
@app.route('/vfdataset_page/<prs>')
def vfdataset_page(prs):
    return render_template('camdaftar.html', prs=prs)
 
@app.route('/vidfeed_dataset/<nbr>')
def vidfeed_dataset(nbr):
    #Video streaming route. Put this in the src attribute of an img tag
    return Response(generate_dataset(nbr), mimetype='multipart/x-mixed-replace; boundary=frame')
 
 
@app.route('/video_feed')
def video_feed():
    # Video streaming route. Put this in the src attribute of an img tag
    return Response(face_recognition(), mimetype='multipart/x-mixed-replace; boundary=frame')
 
@app.route('/fr_page')
def fr_page():
    """Video streaming home page."""
    mycursor.execute("select a.attendance_id, a.attendance_person, b.nama, b.kelas, b.nisn, a.attendance_in "
                     "  from attendance_datamaster a "
                     "  left join data_person b on a.attendance_person = b.id_master "
                     " where a.attendance_date = curdate() "
                     " order by 1 desc")
    data = mycursor.fetchall()
 
    return render_template('absencam.html', data=data)
 
@app.route('/countTodayScan')
def countTodayScan():
    mydb = mysql.connector.connect(
        host="localhost",
        user="root",
        passwd="",
        database="db_absensi"
    )
    mycursor = mydb.cursor()
 
    mycursor.execute("select count(*) "
                     "  from attendance_datamaster "
                     " where attendance_date = curdate() ")
    row = mycursor.fetchone()
    rowcount = row[0]
 
    return jsonify({'rowcount': rowcount})
 
@app.route('/loadData', methods = ['GET', 'POST'])
def loadData():
    mydb = mysql.connector.connect(
        host="localhost",
        user="root",
        passwd="",
        database="db_absensi"
    )
    mycursor = mydb.cursor()
 
    mycursor.execute("select a.attendance_id, a.attendance_person, b.nama, b.kelas, b.nisn, date_format(a.attendance_in, '%H:%i:%s'), date_format(a.attendance_out, '%H:%i:%s') "
                     "  from attendance_datamaster a "
                     "  left join data_person b on a.attendance_person = b.id_master "
                     " where a.attendance_date = curdate() "
                     " order by a.attendance_date desc")
    data = mycursor.fetchall()
 
    return jsonify(response = data)

if __name__ == "__main__":
    app.run(debug=True)

# def countTotalAttendance():
#     mydb = mysql.connector.connect(
#         host="localhost",
#         user="root",
#         passwd="",
#         database="db_absensi"
#     )
#     mycursor = mydb.cursor()
 
#     mycursor.execute("select count(*) "
#                      "  from attendance_datamaster "
#                      " where attendance_date = curdate() ")
#     row = mycursor.fetchone()
#     rowcount = row[0]
 
#     return jsonify({'rowcount': rowcount})