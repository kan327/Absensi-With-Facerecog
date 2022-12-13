# Import Module
# Import Module
import telebot
import mysql.connector
from datetime import date, datetime

# Setup Api Token
api = '5819520124:AAEivrJQBC61xDmrFRGzj0SQ35fAwxt5gG8'
bot = telebot.TeleBot(api)

# Database Setup
db = mysql.connector.connect(
    host = 'localhost',
    user = 'root',
    password = '',
    database = 'db_absensi'
)

# Check If Database Connected
if(db):
    print("Connected To Database")

# Input Database
sql = db.cursor()

# History Write
def history(message, perintah):
    tanggal = datetime.now()
    tanggal = tanggal.strftime('%d-%B-%Y')
    nama_awal = message.chat.first_name
    nama_akhir = message.chat.last_name
    id = message.chat.id
    text_log = "Tanggal : {}, Nama : {} {}, ID : {}, Command / Perintah  : {} \n".format(tanggal, nama_awal, nama_akhir, id, perintah)
    log_bot = open('./Pino/History.txt','a')
    log_bot.write(text_log)
    log_bot.close()

### === Normal Command For Normal User === ###
# Start Command
# Bot Message Handler
@bot.message_handler(commands=['start'])
def start(message):
    history(message, 'start')
    bot.reply_to(message, "Halo👋!  Saya Pino Yang Akan Membantu Kegiatan Layanan Informasi Pendidikan SMK Taruna Bhakti")

# MyId Command For Checking ID
@bot.message_handler(commands=['myid'])
def myid(message):
    history(message, 'myid')
    bot.reply_to(message, message.chat.id)

# Whoami Command For Checking Nama
@bot.message_handler(commands=['whoami'])
def whoami(message):
    history(message, 'whoami')
    nama = message.from_user.first_name
    bot.reply_to(message, "Halo👋! Kamu Adalah {}! Senang Bertemu Denganmu {}".format(nama, nama))

# Profile Command For Checking Profile
@bot.message_handler(commands=['profile'])
def profile(message):
    history(message, 'profile')
    nama = message.from_user.first_name
    id = message.from_user.id
    bot.reply_to(message, "Halo User {}, Berikut Adalah Profile Kamu\nID : {}\nUserName : {}".format(nama, id, nama))

# Time || Date Command For Checking Time

@bot.message_handler(commands=['time'])
def time(message):
    history(message, 'time')
    now = datetime.now()
    date_time = now.strftime("%d/%m/%y, %H:%M:%S")
    bot.reply_to(message, date_time)

### === Special Command For Admin === ###

# Absensi Mapel
@bot.message_handler(commands=['checkabsensi'])
def checkabsensi(message):
    history(message, checkabsensi)
    user = open('./Admin/Admin.txt', 'r')
    user = user.read()
    id_message = message.chat.id
    if str(id_message) in user:
        texts = message.text.split(' ')
        tanggal = str(texts[1])
        mapel = str(texts[2])
        sql.execute("SELECT absen_siswas.tanggal, absen_siswas.keterangan, gurus.name, siswas.nama_siswa, kelas.kelas, mapels.pelajaran FROM absen_siswas INNER JOIN gurus ON absen_siswas.guru_id=gurus.id INNER JOIN siswas ON absen_siswas.siswa_id=siswas.id INNER JOIN kelas ON absen_siswas.kelas_id=kelas.id INNER JOIN mapels ON absen_siswas.mapel_id=mapels.id WHERE tanggal = '{}' AND mapels.pelajaran LIKE '%{}%'".format(tanggal, mapel))
        hasil_sql = sql.fetchall()
        if (hasil_sql) :
            detail = hasil_sql[0]
            tanggal_absen = detail[0]
            nama_guru = detail[2]
            mapel = detail[5]

            final = ''        
            for data in range (len(hasil_sql)):
                final = final + str(data+1) + '.)' + str(hasil_sql[data][3]) + ' : ' + str(hasil_sql[data][1]) + '\n'

            print(final)
            pesan_balasan = "Detail Absensi :\nTanggal : {}\nGuru : {}\nMata Pelajaran : {}\n==================\nDaftar Absensi Siswa:\n{}".format(tanggal_absen, nama_guru, mapel, final)
            bot.reply_to(message, pesan_balasan)
        else :
            bot.reply_to(message, "Data Tidak Ditemukan")
    else : 
        bot.reply_to(message, "Anda Belum Terdaftar Sebagai Admin")



bot.polling(none_stop=True)