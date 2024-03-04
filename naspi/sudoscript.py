#!/bin/python3

import sys
import os
import time
import subprocess

command = sys.argv[1]

print(sys.argv)

if command == "copy":
	os.system("cp '" + sys.argv[2] + "' '" + sys.argv[3] + "'")
	os.system("chmod +777 '" + sys.argv[3] + "'")

if command == "mkdir":
	os.system("mkdir -p '" + sys.argv[2] + "'")
	os.system("chmod -R +777 '" + sys.argv[2] + "'")

if command == "delete":
	if os.isdir(sys.argv[2]):
		os.system("rm -r '" + sys.argv[2] + "'")
	else:
		os.system("rm '" + sys.argv[2] + "'")
