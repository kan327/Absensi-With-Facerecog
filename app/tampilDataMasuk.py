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
    mycursor.execute("SELECT id_master, nama, kelas, tanggal_lahir, gender FROM data_person")
    # mycursor.execute("SELECT * FROM data_person")
    data = mycursor.fetchall()

    return data


print(json.dumps(home()))
