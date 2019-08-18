#!/bin/bash

echo 1 > /proc/sys/net/ipv4/ip_forward

### 变量
ipv=/usr/sbin/ipvsadm

iptables -t nat -A POSTROUTING -s 192.168.81.0/24 -o ens33 -j SNAT --to-source 192.168.91.141

$ipv -C
$ipv -A -t 192.168.91.141:80 -s wrr
$ipv -a -t 192.168.91.141:80 -r 192.168.91.142:80 -m -w 1
$ipv -a -t 192.168.91.141:80 -r 192.168.91.143:80 -m -w 1
