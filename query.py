import sys
import time
import os
from influxdb import InfluxDBClient

#command = "touch \"" + str(sys.argv) + "\""
#os.system(command)

client = InfluxDBClient(host='192.168.178.198', port=8086)
client.switch_database('energietest')

timestamp1 = str(sys.argv[1])
timestamp2 = str(sys.argv[2])
database = str(sys.argv[3])

results = client.query("SELECT * FROM " + database + " WHERE time > '" + timestamp1 + "' and time < '" + timestamp2 + "'")
points = results.get_points
point = 0
for point in points():
        print(point['time'])
        print(" :   ")
        print(point['value'])
        print("<br>")
