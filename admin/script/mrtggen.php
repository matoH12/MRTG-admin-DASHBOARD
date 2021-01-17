<?php
require_once '/var/www/html/mrtg.uvt.tuke.sk/admin/config/config.php';

$db = getDbInstance();
$ip = $db->getValue ("swzoznam", "swip", null);
$snmpversion = '2';
$mrtgconf = '/usr/bin/cfgmaker  --output=/tmp/mrtg-gen/mrtg.cfg.new  --global "Interval: 5" --global "Forks: 4"  --global "options[_]: growright,bits"  --ifdesc=descr --ifdesc=name --ifdesc=alias --show-op-down --no-down  --subdirs=HOSTNAME__SNMPNAME  ';


shell_exec('mkdir /tmp/mrtg-gen/');
shell_exec('rm -rf /var/www/html/mrtg.bak');
shell_exec('cp -r /var/www/mrtg /var/www/mrtg.bak');

foreach ($ip as $ips){


    $db->where('swip', $ips);
    $comunnity = $db->getValue("swzoznam","snmpcomunity");

    $file =  '/usr/bin/cfgmaker --output=/tmp/mrtg-gen/mrtg.cfg.new --global "Interval: 5" --global "Forks: 4"  --global "options[_]: growright,bits" --ifdesc=descr --show-op-down --ifdesc=name --ifdesc=alias --no-down --subdirs=HOSTNAME__SNMPNAME  ';
    $file .= $comunnity . "@". $ips . ":::::" . $snmpversion . ";";
    $mrtgconf .= $comunnity . "@". $ips . ":::::" . $snmpversion . " ";

    $data= 'admin/script/mrtgindex.sh';
    file_put_contents($data, $file);
    shell_exec('bash admin/script/mrtgindex.sh');
    shell_exec('indexmaker --output=/var/www/mrtg/'. $ips. '.html /tmp/mrtg-gen/mrtg.cfg.new');


}
$data= 'admin/script/mrtgconf.sh';
file_put_contents($data, $mrtgconf);
shell_exec('bash admin/script/mrtgconf.sh');
shell_exec('killall mrtg');
shell_exec('rm -rf  /etc/mrtg.cfg.old');
shell_exec('mv /etc/mrtg.cfg /etc/mrtg.cfg.old');
shell_exec('cp -f /tmp/mrtg-gen/mrtg.cfg.new /etc/mrtg.cfg');
shell_exec('rm -rf /tmp/mrtg-gen/');
?>
