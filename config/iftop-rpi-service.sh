#!/bin/bash

iftop -t -i wlan0 -L 100 > /var/www/html/config/wifi/iftop.txt
