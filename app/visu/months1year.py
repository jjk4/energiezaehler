import json
import sys
import time
import os
from influxdb import InfluxDBClient
import datetime

client = InfluxDBClient(host='192.168.178.198', port=8086)
client.switch_database('energietest')

dt = datetime.datetime.today()
maxdays = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31]
database = str(sys.argv[2])
year = sys.argv[1]
month = 1
timezone = "2"
all_values = []

while month < 13:
	last = 0
	first = 0
	if month < 10:
		monthprint = "0" + str(month)
	else:
		monthprint = str(month)
	
	results = client.query("SELECT FIRST(value) FROM " + database + " WHERE time >= '" + str(year) + "-" + monthprint + "-01T00:00:00+0" + timezone + ":00' and time <= '" + str(year) + "-" + monthprint + "-" + str(maxdays[month-1]) + "T23:59:59+0" + timezone + ":00'")
	points = results.get_points
	point = 0
	for point in points():
		first = (point['first'])
		

		results = client.query("SELECT LAST(value) FROM " + database + " WHERE time >= '" + str(year) + "-" + monthprint + "-01T00:00:00+0" + timezone + ":00' and time <= '" + str(year) + "-" + monthprint + "-" + str(maxdays[month-1]) + "T23:59:59+0" + timezone + ":00'")
	points = results.get_points
	point = 0
	for point in points():
		last = (point['last'])
	
	energy = last-first
	all_values.append(energy)
	month +=1
print(json.dumps([all_values, ['Jan', 'Feb', 'Mär', 'Apr', 'Mai', 'Jun', 'Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Dez']]))
