<?php

$file= '/var/www/html/switchmap.uvt.tuke.sk/tukesw.pm';
file_put_contents($file, lokalita( 1));

function lokalita($id_budova)
{
$mysqli = new mysqli("localhost", "admin", 'yadFidth', "mrtgadmin");
$data = '';
if ($mysqli->connect_errno) {
    printf("Connection failed: %s\n", $mysqli->connect_error);
    exit();
}

if (!$mysqli->set_charset("utf8")) {
    printf("Error loading character set utf8: %s\n", $mysqli->error);
} else {
    $mysqli->character_set_name();
}




    $res = $mysqli->query("Select id, nazov FROM budova order by nazov");
//    $result = ExecuteQuery($mysqli, $res);
    while ($row = $res->fetch_assoc())
    {


	$data .= "push @LocalSwitches, '---".$row['nazov']."'; ";
	$data .= " ". PHP_EOL;



    $res2 = $mysqli->query("Select id, nazov FROM lokalita where  budovaid = ".$row['id']." order by nazov");
    while ($row2 = $res2->fetch_assoc())
    {	











    $res3 = $mysqli->query("Select swname, swip FROM swzoznam where  idbudova = ".$row['id']." and idlokalita =".$row2['id']." order by swname");
    while ($row3 = $res3->fetch_assoc())

    {



        $data .= "push @LocalSwitches, '".$row3['swname']."'; ";
        $data .= " ". PHP_EOL;

    }








    }



    }
return $data;

$mysqli->close();
}
?>
