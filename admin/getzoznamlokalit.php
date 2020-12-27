<?php
session_start();
require_once 'config/config.php';
require_once BASE_PATH . '/includes/auth_validate.php';

// Costumers class
require_once BASE_PATH . '/lib/Costumers/Costumers.php';
$costumers = new Costumers();
$db = getDbInstance();


if($_POST['idbudova']){
$budovaid = $_POST['idbudova'];
$db->where ('budovaid', $budovaid);
$select = array('id', 'nazov'); $db->pageLimit = 200; $result = $db->arraybuilder()->paginate('lokalita', "1", $select);




$resultStr = '';

//if (!$select) return false;
//    if (empty($results)) return false;
    $resultStr .= '<div id="budova" class="form-group">';
    $resultStr .= '<label>Lokalita </label>';

    $resultStr .= '<select name="idlokalita" class="form-control selectpicker" required >';
    $resultStr .= '<option value=" " >Vyber Lokality</option>';

                foreach ($result as $opt) {
                     $resultStr .= '<option value="'.$opt['id'].'">' . $opt['nazov'] . '</option>';
                }

    $resultStr .= '</select>';
    $resultStr .= '</div>';


echo $resultStr;

}
//exit();




?>
