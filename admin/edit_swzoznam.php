<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';


// Sanitize if you want
$customer_id = filter_input(INPUT_GET, 'customer_id', FILTER_VALIDATE_INT);
$operation = filter_input(INPUT_GET, 'operation',FILTER_SANITIZE_STRING); 
($operation == 'edit') ? $edit = true : $edit = false;
 $db = getDbInstance();

//Handle update request. As the form's action attribute is set to the same script, but 'POST' method, 
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    //Get customer id form query string parameter.
    $customer_id = filter_input(INPUT_GET, 'customer_id', FILTER_SANITIZE_STRING);

    //Get input data
    $data_to_update = filter_input_array(INPUT_POST);
    
//    $data_to_update['updated_at'] = date('Y-m-d H:i:s');
    $db = getDbInstance();
    $db->where('id',$customer_id);
    $stat = $db->update('swzoznam', $data_to_update);

    if($stat)
    {
        $_SESSION['success'] = "Zariadenie updated successfully!";
        //Redirect to the listing page,
        header('location: swzoznam.php');
        //Important! Don't execute the rest put the exit/die. 
        exit();
    }
}


//If edit variable is set, we are performing the update operation.
if($edit)
{
//    $db->where('id', $customer_id);
    //Get data to pre-populate the form.
//    $customer = $db->getOne("customers");
//echo $customer_id;
//$db->where("p.id", "4");
//$db->join("budova u", "p.idbudova=u.id", "INNER");
//$db->join("lokalita b", "p.idlokalita=b.id", "INNER");
//$db->where("p.id", $customer_id);
//$db->where("p.id", 6);
//$db->where ('p.id', '1');
//$db->joinOrWhere("swzoznam p", "p.id", $customer_id);
//$db->where('p.id',$customer_id);
//$customer = $db->get ("swzoznam p", null, "p.id, p.swname, p.swip, u.nazov as idbudova, b.nazov as idlokalita");

$customer2 = $db->rawQuery('SELECT  p.id, p.swname, p.swip, u.id as budovaid, u.nazov as idbudova, b.id as lokalitaid, b.nazov as idlokalita FROM swzoznam p INNER JOIN budova u on p.idbudova=u.id INNER JOIN lokalita b on p.idlokalita=b.id WHERE  p.id = '.$customer_id);
$customer['id'] = $customer2['0']['id'];
$customer['swname'] = $customer2['0']['swname'];
$customer['swip'] = $customer2['0']['swip'];
$customer['idbudova'] = $customer2['0']['idbudova'];
$customer['idlokalita'] = $customer2['0']['idlokalita'];
$customer['budovaid'] = $customer2['0']['budovaid'];
$customer['lokalitaid'] = $customer2['0']['lokalitaid'];

}
?>


<?php
    include_once 'includes/header.php';
?>
<div id="page-wrapper">
    <div class="row">
        <h2 class="page-header">Update Switch</h2>
    </div>
    <!-- Flash messages -->
    <?php
        include('./includes/flash_messages.php')
    ?>

    <form class="" action="" method="post" enctype="multipart/form-data" id="contact_form">
        
        <?php
            //Include the common form for add and edit  
            require_once('./forms/swzoznam_form.php'); 
        ?>
    </form>
</div>




<?php include_once 'includes/footer.php'; ?>
