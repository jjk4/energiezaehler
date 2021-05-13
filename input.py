import sys
import time
import os
from influxdb import InfluxDBClient
from datetime import datetime   
import pytz

client = InfluxDBClient(host='192.168.178.198', port=8086)
client.switch_database(str(sys.argv[1]))

#command = "touch \"" + str(sys.argv) + "\""
#os.system(command)
timestamp = str(sys.argv[3]) + ":00"
#Zeit in UTC kovertieren:
local = pytz.timezone("Europe/Berlin")
naive = datetime.strptime(timestamp, "%Y-%m-%dT%H:%M:%S")
local_dt = local.localize(naive, is_dst=None)
utc_dt = local_dt.astimezone(pytz.utc)
timestamp = utc_dt.strftime("%Y-%m-%dT%H:%M:%S")


json_body = [
        {
                "measurement": str(sys.argv[2]),
                "fields": {
                        "value": float(sys.argv[4]),
                        "add": "manual"
                },
                "time" : timestamp
        },
]
client.write_points(json_body)
