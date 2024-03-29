#!/bin/bash

sudo apt install apache2 php iftop libapache2-mod-php
sudo service apache2 start

cp -r ../RPI-Web /var/www/
cd /var/www/
cp html/index.html RPI-Web/apacheindex.html

rm -r html
mv RPI-Web html

mv html/users.txt ./
mv html/sessions.txt ./
cp html/iftop-rpi-service.service /etc/systemd/system/
cp html/www-data /etc/sudoers.d/

systemctl daemon-reload
systemctl enable iftop-rpi-daemon
systemctl enable apache2

chmod +777 -R html/
chmod +777 sessions.txt
