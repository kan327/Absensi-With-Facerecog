import json
from flask import Flask
app = Flask(__name__)
@app.route('/test')
def test():
    return "Hallo"

a = test()
print(json.dumps(a))