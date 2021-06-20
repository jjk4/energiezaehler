#usage: python3 energiesparkonto.py host port database username password file.csv zaehler
import sys
import time
import os
from influxdb import InfluxDBClient
from datetime import datetime   
import pytz

client = InfluxDBClient(host=str(sys.argv[1]), port=int(sys.argv[2]), username=str(sys.argv[4]), password=str(sys.argv[5]))
client.switch_database(str(sys.argv[3]))

file = open(str(sys.argv[6]))
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
		timestamp = (year + "-" + month + "-" + day + "T" + hour + ":" + minute + ":" + second)
		#Zeit in UTC kovertieren:
		local = pytz.timezone("Europe/Berlin")
		naive = datetime.strptime(timestamp, "%Y-%m-%dT%H:%M:%S")
		local_dt = local.localize(naive, is_dst=None)
		utc_dt = local_dt.astimezone(pytz.utc)
		timestamp = utc_dt.strftime("%Y-%m-%dT%H:%M:%S") + "Z"
		json_body = [
			{
				"measurement": str(sys.argv[7]),
				"fields": {
				        "value": float(value),
				        "add": "energiesparkonto"
				},
				"time" : timestamp
			},
		]
		client.write_points(json_body)
