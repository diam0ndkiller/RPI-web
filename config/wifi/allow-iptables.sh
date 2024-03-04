#!/bin/bash

iptables -F ALLOWED_DEVICES

iptables -A ALLOWED_DEVICES -m state --state RELATED,ESTABLISHED -j ACCEPT
iptables -A ALLOWED_DEVICES -p icmp -j ACCEPT

while read -r ip_address; do
    iptables -A ALLOWED_DEVICES -s "$ip_address" -j ACCEPT
done < /etc/allowed-devices.txt

iptables -A ALLOWED_DEVICES -j DROP

netfilter-persistent save
