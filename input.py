import sys
import time
import os
from influxdb import InfluxDBClient

client = InfluxDBClient(host='192.168.178.198', port=8086)
client.switch_database(str(sys.argv[1]))

timezone = str(sys.argv[6])

#command = "touch \"" + str(sys.argv) + "\""
#os.system(command)
timestamp = str(sys.argv[3]) + "T" + str(sys.argv[4]) + ":00+0" + timezone + ":00"

json_body = [
        {
                "measurement": str(sys.argv[2]),
                "fields": {
                        "value": float(sys.argv[5]),
                        "add": "manual"
                },
                "time" : timestamp
        },
]
client.write_points(json_body)
