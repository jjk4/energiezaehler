import sys
import time
import os
from influxdb import InfluxDBClient
from datetime import datetime   
import pytz

client = InfluxDBClient(host=str(sys.argv[1]), port=int(sys.argv[2]), username=str(sys.argv[4]), password=str(sys.argv[5]))
client.switch_database(str(sys.argv[3]))

#command = "touch \"" + str(sys.argv) + "\""
#os.system(command)
timestamp = str(sys.argv[7]) + ":00"
#Zeit in UTC kovertieren:
local = pytz.timezone("Europe/Berlin")
naive = datetime.strptime(timestamp, "%Y-%m-%dT%H:%M:%S")
local_dt = local.localize(naive, is_dst=None)
utc_dt = local_dt.astimezone(pytz.utc)
timestamp = utc_dt.strftime("%Y-%m-%dT%H:%M:%S")


json_body = [
        {
                "measurement": str(sys.argv[6]),
                "fields": {
                        "value": float(sys.argv[8]),
                        "add": "manual"
                },
                "time" : timestamp
        },
]
client.write_points(json_body)
