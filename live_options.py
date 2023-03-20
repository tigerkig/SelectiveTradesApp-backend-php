import json
from time import sleep
import requests
import mysql.connector
import time

class Tracker:
    def __init__(self,tracker,timestamp,status,channel):
        self.tracker = tracker
        self.timestamp = timestamp
        self.status = status
        self.channel = channel

class LiveOption:
    def __init__(self, initial_tracker, pct_change, live_price, timestamp, status, tracker, channel):
        self.tracker = tracker
        self.live_price = live_price
        self.pct_change = pct_change
        self.timestamp = timestamp
        self.initial_tracker = initial_tracker
        self.status = status
        self.channel = channel

tracker_list = []
live_option_list = []
firebase_tokens = []

def getFirebaseTokens():
    database = mysql.connector.connect(
        host = '166.62.11.19',
        user = 'velodyne04',
        passwd = 'Trade123#@1',
        database = 'selectivetradesapp')
    cursor = database.cursor()
    timestamp = round(time.time() * 1000)
    cursor.execute("select * from users where firebase_tokens != ''")
    result = cursor.fetchall()
    if(len(firebase_tokens) != 0):
        firebase_tokens.clear()
    for row in result:
        expiry = int(row[6])
        firebase_tokens_ = row[8]
        try:
            firebase_json = json.loads(firebase_tokens_)
            list_ = firebase_json.get("firebase_tokens")
            firebase_tokens.extend(list_)
        except Exception as e:
            print("getFirebaseTokens: An error occured: " + str(e))

def getOption(tracker):
    _list = tracker.tracker.split('-')
    symbol = _list[0].upper()
    expiry = _list[1]
    call_put_ = _list[2]
    strike_ = list[3]
    strike_price = float(_list[4])
    stoploss = ""

    if len(_list) == 6:
        sl = 0
        try:
            sl = float(_list[5])
            stoploss = _list[5]
        except Exception as e:
            print("Exception in getOption: " + str(e))
    elif len(_list) == 7:
        stoploss = _list[5]
    elif len(_list) == 8:
        stoploss = _list[5]
    
    year = expiry[0:2]
    month = expiry[2:4]
    day = expiry[4:6]
    exp = "20" + year + "-" + month + "-" + day
    exp_ = year + month + day

    params = {
        "symbol": symbol,
        "expiration": exp}
    url = "https://api.tradier.com/v1/markets/options/chains"
    headers = {
        "Accept":"application/json",
        "Authorization": "Bearer nnA0GySxyJq0OGjOjlPSMKpsfjzv"}
    response = requests.get(url, params=params, headers=headers)
    _json = json.loads(str(response.text))
    options = _json["options"]

    if options is not None:
        option = _json["options"]["option"]
        for i in option:
            try:
                e = {}
                e.update(i)

                option_type = str(e.get("option_type")[0:1]).upper()
                strike = float(e.get("strike"))
                if option_type == call_put_[0:1].lower() and strike == strike_:
                    tracker_ = ""
                    if stoploss == "":
                        tracker_ = symbol + exp_ + option_type + str(strike_) + "@" + str(strike_price_)
                    else:
                        tracker_ = symbol + exp_ + option_type + str(strike_) + "@" + str(strike_price_) + "SL" + stoploss
                    last = float(e.get("last"))
                    diff = last = float(strike_price_)
                    pct = (diff / float(strike_price_)) * 100
                    status = "open"
                    if pct < -35:
                        status = "close"
                    option = LiveOption(
                        tracker.tracker,
                        round(pct, 2),
                        round(last,2),
                        str(tracker.timestamp),
                        status,
                        tracker_,
                        tracker.channel)
                    if pct <= -35 and tracker.status != "close":
                        print("updating and closing option " + tracker_)
                        updateLiveOptionStatus()
                        sendNotifications()

            except Exception as e:
                print("An error occurred in getOption: " + str(e))
    else:
        print("options is empty")


def getOptions():
    live_option_list = []
    for t in tracker_list:
        try:
            if t.status != "close":
                print("getOptions: getting option for " + t.tracker)
                getOption(t)
        except Exception as e:
            print("An error occured in getOption: " + str(e))

def getTrackers():
    database = mysql.connector.connect(
        host = '166.62.11.19',
        user = 'velodyne04',
        passwd = 'Trade123#@1',
        database = 'selectivetradesapp')

    cursor = database.cursor()
    cursor.execute('select * from live_options')
    result = cursor.fetchall()

    for row in result:
        _tracker = row[1]
        timestamp = row[3]
        status = row[4]
        channel = row[2]

        tracker = Tracker(_tracker, timestamp, status, channel)
        tracker_list.append(tracker)

    getOptions()
    getFirebaseTokens()


def main():
    print("Running... ")
    while True:
        getTrackers()
        sleep(1800)
    
def sendNotifications(tracker):
    server_key = "key=AAAAIT2SXPk:APA91bGGnfeSDcsa_p7OCIj9-I2SVeAY53uT7Xotb4YgA401QXUO1SS26e0KXzCiRVK7MxnRmxrbiD67xDEzlKf0NCgX8-Yw3yVT_L5YlX5H11XUJFFb62FzCGBRbdR63C-GbLNinLOq"
    message = {
        "notification": {
            "sound": "default",
            "title": "New message from live leap options",
            "body": "Option " + tracker + " is below 35%! We are closing this trade"},
        "data": {
            "click_action": "FLUTTER_NOTIFICATION_CLICK",
            "channel": "Live leap options",
            "message": "Option " + tracker + " is below 35%! We are closing this trade",
            "title": "New message from live leap options",
            "screen": "live_leap_options"},
        "registration_ids": firebase_tokens}
    url = "https://fcm.googleapis.com/fcm/send"
    headers = {
        "Accept": "application/json",
        "Authorization": server_key,
        "Content-Type": "application/json",
    }
    response = requests.post(url, json=message, headers=headers)
    print("sendNotifications: Sending notifications")

def updateLiveOptionStatus(tracker):
    url = "https://hnitrade.com/SelectiveTradesApp/updateLiveOptionStatus.php"
    body = {
        "tracker": tracker,
        "status": "close"}
    response = requests.post(url, json=body)
    print("updateLiveOptionStatus" + response.text)

getFirebaseTokens()
main()










    
