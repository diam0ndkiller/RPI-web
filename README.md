# RPI-web
Web Page for a Raspberry Pi with hostapd and smb

New `installer.sh`!!! It does basically the same as below. Run it as root. After install, you will have to go through the `config/sudoscript.py` and replace wifi interface names though.

This is a collection of web pages to be run on a Raspberry Pi. It has built-in `apache2` configuration, so use Apache as the web server. It also includes configuration for `hostapd`, `dnsmasq` and `dhcpcd`. In my setup, my Raspberry Pi is running as a WiFi access point, so that is my main router interface. This web page also supports `smb` configuration and built-in access to a NAS directory. To use that feature, create a folder called `share` anywhere on your system and link it to the `naspi` directory of this page.

To use these pages, install `apache2` and the newest `php` package. Put this repo into your `/var/www/html/` directory (or any other configured web page folder) and make sure that you have a `share` folder either directly in `naspi` or linked there, which is R/W accessible by WWW-DATA (the system user used by php / apache). To make it easier, just make it have permissions 777 (read / write / execute for everyone). Some system operations need `sudo` access. To allow the system to use those files, copy the `www-data` file to your `/etc/sudoers.d/` directory and change any file paths if neccessary.

To use the configuration pages, a password login is neccessary. That login is done using a `users.txt` and a `sessions.txt` file in the `/var/www/` directory, so it cannot be accessed from the web. Again, make sure the `sessions.txt` is writeable by `www-data`. You can use the demo files from this repo.

To use the Network Traffic monitoring feature, you will need to install a systemd service. First, install the `iftop` package. Copy the `iftop-rpi-service.service` file from this repo to `/etc/systemd/system/`, run `systemctl daemon-reload` and `systemctl enable iftop-rpi-service` to start it automatically on boot.

I'm sorry if this isn't the best install guide, but I think it will work for now.
