import pyttsx3
from datetime import datetime
tes = pyttsx3.init("sapi5")
rate = tes.getProperty("rate")
volume = tes.getProperty("volume")
voices = tes.getProperty("voices")

tes.setProperty("rate", 170)
tes.setProperty("volume", 1)
tes.setProperty("voice", voices[1].id)
waktu = datetime.now().strftime('%Y-%m-%d')
# text = input("isi : ")
tes.say("now is" + waktu)
tes.runAndWait()