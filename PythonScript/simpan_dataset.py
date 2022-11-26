import mysql.connector
import cv2
from PIL import Image
import numpy as np
import os
import time
import pyttsx3
from datetime import date, datetime
  
 
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
 
  