<?php 
session_start();
require_once 'includes/auth_validate.php';
require_once './config/config.php';
$del_id = filter_input(INPUT_POST, 'del_id');
if ($del_id && $_SERVER['REQUEST_METHOD'] == 'POST') 
{

//	if($_SESSION['admin_type']!='super'){
//		$_SESSION['failure'] = "You don't have permission to perform this action";
//    	header('location: customers.php');
//        exit;
//
//	}
    $customer_id = $del_id;


    $db = getDbInstance();

    $idbudova = $db->rawQuery('SELECT id from swzoznam where idlokalita = '.$customer_id.' LIMIT 1');

    $db = getDbInstance();

    $db->where('id', $customer_id);
    if ($idbudova) {}
    else {


        $db = getDbInstance();
        $db->where('id',$customer_id);
        $lokalitaname= $db->getOne('lokalita');
        $db = getDbInstance();
        $udalost = 'Zmazanie Lokality:  ' . $lokalitaname['nazov'] . ' Lokalita ID: ' . $customer_id  ;

        $logs = array('user' => $_SESSION['user'] , 'udalost' => $udalost);
        $db->insert('logs',$logs);


        $db = getDbInstance();

        $db->where('id', $customer_id);
        $status = $db->delete('lokalita');
    }
    if ($status)
    {
        $_SESSION['info'] = "Lokalita deleted successfully!";

        header('location: lokality.php');
        exit;
    }
    else
    {
    	$_SESSION['failure'] = "Chyba zmazania lokality. Je priradena pre Switch";

    	header('location: lokality.php');
        exit;

    }
    
}
