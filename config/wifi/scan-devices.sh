#sudo arp-scan -l -t 200 -I $(ls /sys/class/net | grep -o "wl[^\t]\+") > dev.txt
arp -a | sort
echo
iw dev wlan0 station dump
