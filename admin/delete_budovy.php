<?php 
session_start();
require_once 'includes/auth_validate.php';
require_once './config/config.php';
$del_id = filter_input(INPUT_POST, 'del_id');
if ($del_id && $_SERVER['REQUEST_METHOD'] == 'POST') 
{

//	if($_SESSION['admin_type']!='super'){
//		$_SESSION['failure'] = "You don't have permission to perform this action";
//    	header('location: budovy.php');
//        exit;

//	}
    $customer_id = $del_id;
    $db = getDbInstance();

    $idbudova = $db->rawQuery('SELECT id from lokalita where budovaid = '.$customer_id.' LIMIT 1');

	if($idbudova){}
		else {
		    $db = getDbInstance();
		    $db->where('id', $customer_id);
		    $status = $db->delete('budova');
			}    
    if ($status) 
    {
        $_SESSION['info'] = "Budova deleted successfully!";
        header('location: budovy.php');
        exit;
    }
    else
    {
    	$_SESSION['failure'] = "Unable to delete budovu. Existuje v lokalite";

    	header('location: budovy.php');
        exit;

    }
    
}
