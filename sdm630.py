#usage: python3 sdm630.py host port database measurement counter usb id
import minimalmodbus
from influxdb import InfluxDBClient
import sys
from datetime import datetime, timezone


client = InfluxDBClient(host=str(sys.argv[1]), port=int(sys.argv[2]))
client.switch_database(str(sys.argv[3]))

instrument = minimalmodbus.Instrument(str(sys.argv[6]), int(sys.argv[7]))  # port name, slave address (in decimal)

timestamp = str(datetime.now(timezone.utc).strftime("%Y-%m-%d")) + "T" + str(datetime.utcnow().strftime("%H:%M")) + ":00"

print(timestamp)
json_body = [
	{
		"measurement": sys.argv[4],
		"fields": {
			"add": "sdm630",
		},
		"time": timestamp
	},
]
if sys.argv[5] == "l1":
	json_body[0]["fields"]["value"] = round(instrument.read_float(functioncode=4, registeraddress=358, number_of_registers=2), 2)

elif sys.argv[5] == "l2":
	json_body[0]["fields"]["value"] = round(instrument.read_float(functioncode=4, registeraddress=360, number_of_registers=2), 2)

elif sys.argv[5] == "l3":
	json_body[0]["fields"]["value"] = round(instrument.read_float(functioncode=4, registeraddress=362, number_of_registers=2), 2)

elif sys.argv[5] == "all":
	json_body[0]["fields"]["value"] = round(instrument.read_float(functioncode=4, registeraddress=342, number_of_registers=2), 2)

client.write_points(json_body)
print(json_body)
