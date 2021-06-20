import json
import sys
import time
import os
from influxdb import InfluxDBClient
import datetime

client = InfluxDBClient(host=str(sys.argv[1]), port=int(sys.argv[2]), username=str(sys.argv[4]), password=str(sys.argv[5]))
client.switch_database(str(sys.argv[3]))

database = str(sys.argv[7])
year = sys.argv[6]

results = client.query("SELECT FIRST(value) FROM " + database + " WHERE time >= '" + str(year) + "-01-01T00:00:00Z' and time <= '" + str(year) + "-12-31T23:59:59Z' tz('Europe/Berlin')")
points = results.get_points
point = 0
for point in points():
	first = (point['first'])
	

results = client.query("SELECT LAST(value) FROM " + database + " WHERE time >= '" + str(year) + "-01-01T00:00:00Z' and time <= '" + str(year) + "-12-31T23:59:59Z' tz('Europe/Berlin')")
points = results.get_points
point = 0
for point in points():
	last = (point['last'])

energy = round(last-first, 2)
print(energy)
