#!/bin/bash

##vytvor zlozky v /tmp
mkdir /tmp/mrtg-gen/
mkdir /tmp/mrtg-gen/www/

#Zmazem staru zlohu
rm -rf /var/www/html/mrtg.bak

##Premazem si /var/www/mrtg najlepsie cele zmazem a  vygenerujem si nove aby nam v tej zlozke nevznikol bordel
#stare si pre istotu zalohujem
cp -r /var/www/mrtg /var/www/mrtg.bak


##Pozor na Forks  !!!!!!!!!
## Prikaz na generovanie
#WorkDir: /home/http/mrtg
# odstranene --global "WorkDir: /var/www/html/mrtg"
# pridanie moznosti statickeho configu --global "Include: /etc/mrtg.other.cfg" 
echo '/usr/bin/cfgmaker  --output=/tmp/mrtg-gen/mrtg.cfg.new  --global "Interval: 5" --global "Forks: 4"  --global "options[_]: growright,bits"  --ifdesc=descr --ifdesc=name --ifdesc=alias --show-op-down --no-down  --subdirs=HOSTNAME__SNMPNAME \' > /tmp/mrtg-gen/script.sh

##stopneme si mrtg
#/etc/init.d/mrtg stop
killall mrtg
#systemctl stop mrtg
##zoznam IPciek na ktorych bezi SNMP
source /script/IP
#IP=(147.232.200.10 194.160.8.7 147.232.254.100)
############################################################################

  echo -n "# MRTG generujem script... "

  let a=0;
  for adress in ${IP[@]} ; do


echo -n ' public@' >>  /tmp/mrtg-gen/script.sh
echo -n $adress >>  /tmp/mrtg-gen/script.sh
echo -n ':::::2' >>  /tmp/mrtg-gen/script.sh


####pre indexmaker znova vygeneruje sa script urobi sa mrtg config a z neho sa urobi .html subor
# odstranene --global "WorkDir: /var/www/html/mrtg"
echo '/usr/bin/cfgmaker --output=/tmp/mrtg-gen/mrtg.cfg.new --global "Interval: 5" --global "Forks: 4"  --global "options[_]: growright,bits" --ifdesc=descr --show-op-down --ifdesc=name --ifdesc=alias --no-down --subdirs=HOSTNAME__SNMPNAME \' > /tmp/mrtg-gen/indexmaker.sh

echo -n ' public@' >>  /tmp/mrtg-gen/indexmaker.sh
echo -n $adress >>  /tmp/mrtg-gen/indexmaker.sh
echo -n ':::::2' >>  /tmp/mrtg-gen/indexmaker.sh
echo ';' >> /tmp/mrtg-gen/indexmaker.sh
##spusti vyrobu suboru mrtg configu pre jedno zariadenie
bash  /tmp/mrtg-gen/indexmaker.sh
##urobi index pre dane zariadenie (html subor)
indexmaker --output=/var/www/mrtg/$adress.html /tmp/mrtg-gen/mrtg.cfg.new

     let a=$a+1;
  done;
  echo "($a)";

  ############################################################################



echo ';' >> /tmp/mrtg-gen/script.sh

##vygeneruje script pre mrtg
bash /tmp/mrtg-gen/script.sh
#Zalohujem a implementujem novy config
rm -rf  /etc/mrtg.cfg.old
cp /etc/mrtg.cfg /etc/mrtg.cfg.old
rm -rf  /etc/mrtg.cfg
cp -f /tmp/mrtg-gen/mrtg.cfg.new /etc/mrtg.cfg
##ked sme to uz zalohovali tak treba vytvorit novu zlozku
#mkdir /var/www/mrtg
##nakopcim si config www suborov do zlozky /var/www/mrtg z zlozky /tmp//mrtg-gen/www/
#cp -r  /tmp/mrtg-gen/www /var/www/mrtg
##nakopcime do /var/www/mrtg index.html a .htacces z nejakej sablony  ktora je /script/www/mrtg


#startnem mrtg aby sa nam config implementoval
#/etc/init.d/mrtg start



#systemctl start mrtg




#Urobim po sebe poriadok pomaze bordel v tmp 
rm -rf /tmp/mrtg-gen/
