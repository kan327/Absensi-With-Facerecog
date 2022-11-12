import mysql.connector
import json

def home():
    mydb = mysql.connector.connect(
        host="localhost",
        user="root",
        passwd="",
        database="db_absensi2"
    )
    mycursor = mydb.cursor()

    mycursor.execute("SELECT a.attendance_id, a.attendance_person, b.tanggal_lahir, date_format(a.attendance_in, '%H:%i:%s'), date_format(a.attendance_out, '%H:%i:%s') "
                     " FROM attendance_datamaster a "
                     " LEFT JOIN data_person b ON a.attendance_id = b.id_master "
                     " WHERE a.attendance_date = curdate() "
                     " ORDER BY a.attendance_date DESC")
    data = mycursor.fetchall()

    return data


print(json.dumps(home()))
