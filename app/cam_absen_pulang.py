from flask import Flask, render_template, request, redirect, url_for, Response, jsonify
import mysql.connector
import cv2
from PIL import Image
import numpy as np
import json
import time
import pyttsx3
from datetime import date, datetime

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

speech = pyttsx3.init("sapi5")
rate = speech.getProperty("rate")
volume = speech.getProperty("volume")
voices = speech.getProperty("voices")
speech.setProperty("rate", 170)
speech.setProperty("volume", 1)
speech.setProperty("voice", voices[1].id)


def face_recognition2():  # generate frame by frame from camera
    def draw_boundary2(img, classifier, scaleFactor, minNeighbors, color, text, clf):
        gray_image = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)
        features = classifier.detectMultiScale(gray_image, scaleFactor, minNeighbors)
 
        global justscanned
        global pause_cnt
        waktu = datetime.now().strftime('%Y-%m-%d %H:%M:%S')

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
                w_filled = (cnt / 30) * w
 
                cv2.putText(img, str(int(n))+' %', (x + 20, y + h + 28), cv2.FONT_HERSHEY_SIMPLEX, 0.8, (153, 255, 255), 2, cv2.LINE_AA)
 
                cv2.rectangle(img, (x, y + h + 40), (x + w, y + h + 50), color, 2)
                cv2.rectangle(img, (x, y + h + 40), (x + int(w_filled), y + h + 50), (153, 255, 255), cv2.FILLED)
 
                mycursor.execute("SELECT a.img_person, b.nama, b.kelas, b.tanggal_lahir "
                                 " FROM images a "
                                 " LEFT JOIN data_person b ON a.img_person = b.id_master "
                                 " WHERE img_id = " + str(id))
                row = mycursor.fetchone()
                pnbr = row[0]
                pname = row[1]
                pkelas = row[2]
 
                if int(cnt) == 30:
                    cnt = 0
 
                    mycursor.execute("UPDATE attendance_datamaster SET attendance_out = ' " + waktu + " ' WHERE attendance_person = '" + pnbr + "'")
                    mydb.commit()
 
                    cv2.putText(img, pname + ' | ' + pkelas, (x - 10, y - 10), cv2.FONT_HERSHEY_SIMPLEX, 0.8, (153, 255, 255), 2, cv2.LINE_AA)
                    time.sleep(7)
                    # speech.say(pname + "successfully processed")
                    # speech.runAndWait()

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
        coords = draw_boundary2(img, faceCascade, 1.1, 10, (255, 255, 0), "Face", clf)
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

def video_feed2():
    # Video streaming route. Put this in the src attribute of an img tag
    return Response(face_recognition2(), mimetype='multipart/x-mixed-replace; boundary=frame')

# jsonhasil = json.dumps([
#     video_feed2()
# ])

print(face_recognition2())