#usage: python3 energiesparkonto.py database zaehler file.csv 
import sys
import time
import os
from influxdb import InfluxDBClient

client = InfluxDBClient(host='192.168.178.198', port=8086)
client.switch_database(str(sys.argv[1]))

timezone = str(3)
file = open(str(sys.argv[2]))
for i in file:
	if i[0] != "Z": 
		day = i[0:2]
		month = i[3:5]
		year = i[6:10]
		hour = i[11:13]
		minute = i[14:16]
		second = i[17:19]
		value = i[20:]
		value = value[:-1]
		value = value.replace(",", ".")
		timestamp = (year + "-" + month + "-" + day + "T" + hour + ":" + minute + ":" + second + "+0" + timezone + ":00")
		json_body = [
			{
				"measurement": str(sys.argv[2]),
				"fields": {
				        "value": float(value),
				        "add": "energiesparkonto"
				},
				"time" : timestamp
			},
		]
		client.write_points(json_body)
