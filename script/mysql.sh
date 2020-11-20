#!/bin/bash

#myvariable=$(echo "SELECT swip FROM swzoznam" | mysql mrtgadmin -u admin -pyadFidth)
myvariable=$(mysql mrtgadmin -N -uadmin -pyadFidth  -se "SELECT swip FROM swzoznam")
echo $myvariable > /tmp/ip
#grep -oE "\b([0-9]{1,3}\.){3}([0-9]{1,3})\b" /tmp/ip


echo 'IP=('$(cat /tmp/ip | grep -oE "\b([0-9]{1,3}\.){3}[0-9]{1,3}\b")');' > /script/IP

rm -rf /tmp/ip

