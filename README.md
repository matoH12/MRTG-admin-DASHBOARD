MRTG php admin

Install package debian/ubuntu:

```sh
apt install mrtg apache2 php php-mysql mariadb-server mariadb-client composser
```


Install script for generate MRTG configuration from MySQL database:
```sh
mkdir /var/www/mrtg
cp script /
```

Script contain:

1. generujV2-cron.sh – Create MRTG configuration (/etc/mrtg.cfg)

2. mysql.sh – Select all switch IP address from MYSQL


Web admin install:
Copy data from git to web root directrory. 

```sh
cd /var/www/
git clone https://github.com/matoH12/MRTG-admin-DASHBOARD.git .
mysql -u root mrtgadmin < admin/mrtgadmin.sql
```


Setting password for MYSQL in file:
1. index.php

2. admin/config/config.php



Default credential:
User: admin
Password: admin