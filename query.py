import sys
import time
import os
from influxdb import InfluxDBClient

#command = "touch \"" + str(sys.argv) + "\""
#os.system(command)

client = InfluxDBClient(host=str(sys.argv[1]), port=int(sys.argv[2]), username=str(sys.argv[4]), password=str(sys.argv[5]))
client.switch_database(str(sys.argv[3]))

timestamp1 = str(sys.argv[7])
timestamp2 = str(sys.argv[8])
zaehler = str(sys.argv[6])

results = client.query("SELECT * FROM " + zaehler + " WHERE time > '" + timestamp1 + "' and time < '" + timestamp2 + "' tz('Europe/Berlin')")
points = results.get_points
point = 0
for point in points():
	try:
		print(point['time'])
		print(" :   ")
		print(point['value'])
		print(" :  ")
		print(point['add'])
		print("<br>")
	except:
		print("ERROR")
