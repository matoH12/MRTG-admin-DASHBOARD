<?php
	require_once '/var/www/html/mrtg.uvt.tuke.sk/admin/config/config.php';

	$db = getDbInstance();
	$ip = $db->getValue ("swzoznam", "swip", null);
	foreach ($ip as $ips){

	$sysUpTime = "1.3.6.1.2.1.1.3.0";
	$db->where('swip', $ips);

	$comunnity = $db->getValue("swzoznam","snmpcomunity");

	$oo3 = clean_output(snmpget($ips,$comunnity,$sysUpTime));

	if($oo3) {

		$db->where ('swip', $ips);
		$data= array ( 'snmpuptime' => $oo3 );
		$db->update ('swzoznam', $data);
		}
	else {
                $db->where ('swip', $ips);
                $data= array ( 'snmpuptime' => 'error');
                $db->update ('swzoznam', $data);

		}
}
?>
