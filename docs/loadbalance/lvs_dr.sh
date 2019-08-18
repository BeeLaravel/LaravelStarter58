#!/bin/bash

echo 1 > /proc/sys/net/ipv4/ip_forward

### 变量
ipv=/usr/sbin/ipvsadm
vip=192.168.91.148
rs1=192.168.91.146
rs2=192.168.91.147

ifconfig ens33:0 down
ifconfig ens33:0 $vip broadcast $vip netmask 255.255.255.255 up
route add -host $vip dev ens33:0

$ipv -C
$ipv -A -t $vip:80 -s wrr 
$ipv -a -t $vip:80 -r $rs1:80 -g -w 1
$ipv -a -t $vip:80 -r $rs2:80 -g -w 1
