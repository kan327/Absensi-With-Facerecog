# Import Module
import telebot
import mysql.connector
from datetime import date, datetime

# Setup Api Token
api = '5674685660:AAHRATNzLDuEQJfqpwdEDVgX154K5gubG7E'
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

# Bot Message Handler
@bot.message_handler(commands=['start'])
def start(message):
    history(message, start)
    bot.reply_to(message, "Halo👋!  Saya Admin Pino Bot Yang Akan Membantu Kegiatan Layanan Informasi Pendidikan SMK Taruna Bhakti & Mengatur Role Admin Dari Pino Bot")

# Bot Message Handler
@bot.message_handler(commands=['myid'])
def myid(message):
        history(message, myid)
        bot.reply_to(message, message.chat.id)

# Bot Message Handler
@bot.message_handler(commands=['help'])
def help(message):
    history(message, help)
    bot.reply_to(message, "Admin-Pino-Bot hanya berfungsi sebagai bot pendaftaran\nBerikut adalah panduan pendaftaran : \n1.)Ketik Command \"\myid\" untu melihat id Telegram kamu\n2.)Kemudian ketik command \"\daftar [id-telegram-kamu] [nama-lengkap] [status]\"\n3.)Selamat kamu sudah terdaftar menjadi Admin")

# Daftar Command
@bot.message_handler(commands=['daftar'])
def daftar(message):
    history(message, daftar)
    user = open('./Admin/Admin.txt', 'r')
    user = user.read()
    id_message = message.chat.id
    if str(id_message) in user:
        bot.reply_to(message, "Kamu Sudah Terdaftar Menjadi Admin")
    else :
        tanggal = datetime.now()
        tanggal = tanggal.strftime('%d-%B-%Y')
        texts = message.text.split(' ')
        id_telegram = str(texts[1])
        nama_admin = str(texts[2])
        status_admin = str(texts[3])
        nama_admin = nama_admin.replace('-', ' ')
        text_sign_up = "1.) Admin Pino Bot, ID Telegram : {}, Nama Admin : {}, Status : {}, Tanggal Daftar : {}\n".format(id_telegram, nama_admin, status_admin, tanggal)
        sign_up = open('Admin.txt', 'a')
        sign_up.write(text_sign_up)
        sign_up.close()
        bot.reply_to(message, "Pendaftaran Berhasil")


bot.polling(none_stop=True)