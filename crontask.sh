#!/bin/bash

# Script directory (root path)
DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" >/dev/null 2>&1 && pwd )"

cd $DIR
echo "Sanning with Nmap"
sudo nmap -oX storage/nmap.xml  -sn 192.168.1.0/24


echo "Update DB entries"
php artisan nmap:parse storage/nmap.xml

