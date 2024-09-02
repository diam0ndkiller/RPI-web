#!/bin/python3

import sys
import os
import time
import subprocess

command = sys.argv[1]

DEVICES = {}

class DeviceOnNetwork:
	def __init__(this, device: str):
		global DEVICES
		this.l = device.split(" ")
		this.name = this.l[0]
		this.ip = this.l[1].strip("()")
		if len(this.l) == 7:
			this.dc = False
			this.mac = this.l[3]
			this.interface = this.l[6]
			DEVICES[this.mac] = this
		else:
			this.dc = True
			DEVICES[this.ip] = this
		this.traffic = None

	def dump(this):
		if not this.dc: print(this.mac + " connected at " + this.ip + " (" + this.name + ") on " + this.interface)
		else: print(this.ip + " (" + this.name + ") disconnected.")
		if this.traffic:
			for i in this.traffic.split("\n")[1:]:
				print(i)
		print()




if command == "reboot":
	os.system("reboot")

elif command == "shutdown":
	os.system("poweroff")


elif command == "status-info":
	os.system("top -b -n 1")




elif command == "get-service-state":
	os.system("systemctl is-active " + sys.argv[2])


elif command == "restart-service":
	service = sys.argv[2]
	os.system(f"service {service} restart")


elif command == "get-config":
	file = sys.argv[2]
	os.system(f'cat "{file}"')

elif command == "save-config":
	file = sys.argv[2]
	os.system(f'cp "{file}" "{file}.old"')
	os.system(f'echo > "{file}"')
	for i in sys.argv[3].split("·"):
		if i: os.system(f'echo "{i}" >> "{file}"')

elif command == "reset-config":
	file = sys.argv[2]
	os.system(f'cp "{file}.old" "{file}"')




elif command == "wlan-status":
	ips = eval(str(subprocess.check_output("ip r", shell=True))[1:])
	print(ips)
	if ips.startswith("default"):
		ip = ips.split("\n")[0].split(" ")[2]
		print(eval(str(subprocess.check_output("ping -c 5 " + ip, shell=True))[1:]))
	else:
		print("No Internet Connection detected.\n")

elif command == "internet-connection":
	print(eval(str(subprocess.check_output("ip r", shell=True))[1:]).startswith("default"))

elif command == "list-devices":
	DEVICES = {}.copy()

	arp = eval(str(subprocess.check_output("arp -a | sort | awk '/wlan0/ {print $0}' && arp -a | awk '!/wlan0/'", shell=True))[1:])
	devices = arp.split("\n")[:-1]
	for i in devices:
		DeviceOnNetwork(i)
	for i in eval(str(subprocess.check_output("iw dev wlan0 station dump", shell=True))[1:]).split("\nStation"):
		if i:
			DEVICES[i.split(" ")[1]].traffic = i
	for i in DEVICES.values():
		i.dump()


elif command == "network-traffic":
	with open("iftop.txt", "r") as file:
		print(file.read().split("\n\n")[-2])




elif command == "allow-iptables":
	subprocess.run("sudo /var/www/html/config/wifi/allow-iptables.sh", shell=True)

elif command == "enable-allow-ips":
	subprocess.run("sudo iptables -A FORWARD -j ALLOWED_DEVICES && sudo netfilter-persistent save")

elif command == "disable-allow-ips":
	subprocess.run("sudo iptables -F FORWARD && sudo netfilter-persistent save")

elif command == "add-allow-ip":
	os.system("echo >> /etc/allowed-devices.txt")
	allowed_ips = [sys.argv[2]]
	with open("/etc/allowed-devices.txt", "r") as file:
		for i in file.read().split("\n"):
			if not i in allowed_ips:
				allowed_ips.append(i)
	os.system("echo > /etc/allowed-devices.txt")
	for i in allowed_ips:
		os.system(f"echo {i} >> /etc/allowed-devices.txt")

elif command == "remove-allow-ip":
	os.system("echo >> /etc/allowed-devices.txt")
	allowed_ips = []
	with open("/etc/allowed-devices.txt", "r") as file:
		for i in file.read().split("\n"):
			if not i in allowed_ips and i != sys.argv[2]:
				allowed_ips.append(i)
	os.system("echo > /etc/allowed-devices.txt")
	for i in allowed_ips:
		os.system(f"echo {i} >> /etc/allowed-devices.txt")


elif command == "get-active-ips":
	DEVICES = {}.copy()

	arp = eval(str(subprocess.check_output("arp -a -i wlan0 | sort", shell=True))[1:])
	devices = arp.split("\n")[:-1]
	ips = {}
	for i in devices:
		if not "arp:" in i:
			d = DeviceOnNetwork(i)
			ips[d.ip] = d.name + " active"
	x = eval(str(subprocess.check_output("cat /etc/allowed-devices.txt", shell=True))[1:])
	for i in x.split("\n"):
		if i != "" and not i in ips:
			ips[i] = i + " inactive"
	for k, i in ips.items():
		print(k, i, "unlocked" if "\n" + k + "\n" in eval(str(subprocess.check_output("cat /etc/allowed-devices.txt", shell=True))[1:]) else "blocked")
