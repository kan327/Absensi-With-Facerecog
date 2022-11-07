import pyttsx3

tes = pyttsx3.init()

tes.setProperty('rate', 130)
text = input("isi : ")
tes.say(text)
tes.runAndWait()