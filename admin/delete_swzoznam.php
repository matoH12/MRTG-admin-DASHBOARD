<?php 
session_start();
require_once 'includes/auth_validate.php';
require_once './config/config.php';
$del_id = filter_input(INPUT_POST, 'del_id');
if ($del_id && $_SERVER['REQUEST_METHOD'] == 'POST') 
{

//	if($_SESSION['admin_type']!='super'){
//		$_SESSION['failure'] = "You don't have permission to perform this action";
//    	header('location: swzoznam.php');
//        exit;
//
//	}
    $customer_id = $del_id;



    $db = getDbInstance();
    $db->where('id',$customer_id);
    $swname = $db->getOne('swzoznam');
    $db = getDbInstance();
    $udalost = 'Zmazanie zariadenia:  ' . $swname['swname'] . ' zariadenie ID: ' . $customer_id  ;

    $logs = array('user' => $_SESSION['user'] , 'udalost' => $udalost);
    $db->insert('logs',$logs);

    $db = getDbInstance();
    $db->where('id', $customer_id);
    $status = $db->delete('swzoznam');


    if ($status) 
    {
        $_SESSION['info'] = "Switch deleted successfully!";
        header('location: swzoznam.php');
        exit;
    }
    else
    {
    	$_SESSION['failure'] = "Unable to delete switch";
    	header('location: swzoznam.php');
        exit;

    }
    
}
