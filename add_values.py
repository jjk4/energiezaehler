import sys
import time
import os
from influxdb import InfluxDBClient
import datetime

dt = datetime.datetime.today()
#command = "touch \"" + str(sys.argv) + "\""
#os.system(command)
maxdays = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31]
client = InfluxDBClient(host=str(sys.argv[1]), port=int(sys.argv[2]))
client.switch_database(str(sys.argv[3]))

database = str(sys.argv[4])

month = 1
year = 2015


while (str(year) + "-" + str(month)) != (str(dt.year) + "-" + str(dt.month)):
	if month == 13:
		year += 1
		month = 1
	if month < 10:
		monthprint = "0" + str(month)
	else:
		monthprint = str(month)


	nextmonth = month + 1
	nextyear = year
	if nextmonth == 13:
		nextyear += 1
		nextmonth = 1
	if nextmonth < 10:
		nextmonthprint = "0" + str(nextmonth)
	else:
		nextmonthprint = str(nextmonth)
	print("SELECT FIRST(value) FROM " + database + " WHERE time > '" + str(nextyear) + "-" + nextmonthprint + "-01T00:00:00Z' and time < '" + str(nextyear) + "-" + nextmonthprint + "-" + str(maxdays[nextmonth-1]) + "T23:59:59Z' tz('Europe/Berlin')")
	results = client.query("SELECT FIRST(value) FROM " + database + " WHERE time > '" + str(nextyear) + "-" + nextmonthprint + "-01T00:00:00Z' and time < '" + str(nextyear) + "-" + nextmonthprint + "-" + str(maxdays[nextmonth-1]) + "T23:59:59Z' tz('Europe/Berlin')")
	points = results.get_points
	point = 0
	for point in points():
		first = point['first']
		firstday = int(str(point['time'])[8:10])
		print(str(first))
		#print(firstday)

	print("SELECT LAST(value) FROM " + database + " WHERE time > '" + str(nextyear) + "-" + nextmonthprint + "-01T00:00:00Z' and time < '" + str(nextyear) + "-" + nextmonthprint + "-" + str(maxdays[nextmonth-1]) + "T23:59:59Z' tz('Europe/Berlin')")
	results = client.query("SELECT LAST(value) FROM " + database + " WHERE time > '" + str(nextyear) + "-" + nextmonthprint + "-01T00:00:00Z' and time < '" + str(nextyear) + "-" + nextmonthprint + "-" + str(maxdays[nextmonth-1]) + "T23:59:59Z' tz('Europe/Berlin')")
	points = results.get_points
	point = 0
	for point in points():
		last = point['last']
		lastday = int(str(point['time'])[8:10])
		print(str(last))
		#print(lastday)
	try:
		lastdayuntillastday = maxdays[month-1]-lastday
		daydifference = lastdayuntillastday+firstday
		print(lastdayuntillastday)
		print(daydifference)
		energy = round((((first-last)/daydifference)*lastdayuntillastday)+last, 2)
		print(energy)
		#Timestamp kovertieren in UTC
		timestamp = str(year) + "-" + monthprint + "-" + str(maxdays[month-1]) + "T23:59:59"
		local = pytz.timezone("Europe/Berlin")
		naive = datetime.strptime(timestamp, "%Y-%m-%dT%H:%M:%S")
		local_dt = local.localize(naive, is_dst=None)
		utc_dt = local_dt.astimezone(pytz.utc)
		timestamp = utc_dt.strftime("%Y-%m-%dT%H:%M:%S")
		json_body = [
			{
				"measurement": database,
				"fields": {
				        "value": energy,
				        "add": "auto" 
				},
				"time" : timestamp
			},
		]
		client.write_points(json_body)
		#Timestamp kovertieren in UTC
		timestamp = str(nextyear) + "-" + nextmonthprint + "-01T00:00:00"
		local = pytz.timezone("Europe/Berlin")
		naive = datetime.strptime(timestamp, "%Y-%m-%dT%H:%M:%S")
		local_dt = local.localize(naive, is_dst=None)
		utc_dt = local_dt.astimezone(pytz.utc)
		timestamp = utc_dt.strftime("%Y-%m-%dT%H:%M:%S")
		json_body = [
			{
				"measurement": database,
				"fields": {
				        "value": energy,
				        "add": "auto"
				},
				"time" : timestamp
			},
		]
		client.write_points(json_body)
	except:
		print("")
	month += 1
	first = 0
	last = 0
	firstday = 0
	lastday = 0
	lastdayuntillastday = 0
	daydifference = 0
