import json

def test():
    a = {
        "nama" : "Ridho",
        "kelas" : "X PPLG 1"
    }
    return a

print(json.dumps(test()))