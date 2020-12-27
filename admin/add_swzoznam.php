<?php
session_start();
require_once './config/config.php';
require_once './includes/auth_validate.php';

    $db = getDbInstance();

//serve POST method, After successful insert, redirect to customers.php page.
if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    //Mass Insert Data. Keep "name" attribute in html form same as column name in mysql table.
    $data_to_store = array_filter($_POST);
    $db = getDbInstance();
    $db->where('swip',$data_to_store['swip']);
    $kontrola = $db->getOne('swzoznam','swip');
    if($kontrola){
        $_SESSION['failure'] = "IP adresa existuje";
        header('location: swzoznam.php');
        exit();
    }
    $db = getDbInstance();
    $db->where('swname',$data_to_store['swname']);
    $kontrola2 = $db->getOne('swzoznam','swname');
    if($kontrola2){

        $_SESION['failure'] = "Nazov SW existuje";
        header('location: swzoznam.php');
        exit();

    }
    //Insert timestamp
//    $data_to_store['created_at'] = date('Y-m-d H:i:s');
    $db = getDbInstance();
    
    $last_id = $db->insert('swzoznam', $data_to_store);

    $db = getDbInstance();
    $udalost = 'Vytvorenie zariadenia:  ' . $data_to_store['swname'] . ' Nastavenie IP: ' . $data_to_store['swip'] . ' Nastavenie budova ID:  ' . $data_to_store['idbudova'] . ' Nastavenie lokalita ID:  ' . $data_to_store['idlokalita'];

    $logs = array('user' => $_SESSION['user'] , 'udalost' => $udalost);
    $db->insert('logs',$logs);


    if($last_id)
    {
    	$_SESSION['success'] = "Switch added successfully!";
    	header('location: swzoznam.php');
    	exit();
    }
    else
    {
        echo 'insert failed: ' . $db->getLastError();
        exit();
    }
}

//We are using same form for adding and editing. This is a create form so declare $edit = false.
$edit = false;

require_once 'includes/header.php'; 
?>
<div id="page-wrapper">
<div class="row">
     <div class="col-lg-12">
            <h2 class="page-header">Add Customers</h2>
        </div>
        
</div>
    <form class="form" action="" method="post"  id="customer_form" enctype="multipart/form-data">
       <?php  include_once('./forms/swzoznam_form.php'); ?>
    </form>
</div>


<script type="text/javascript">
$(document).ready(function(){
   $("#customer_form").validate({
       rules: {
            f_name: {
                required: true,
                minlength: 3
            },
            l_name: {
                required: true,
                minlength: 3
            },   
        }
    });
});
</script>

<?php include_once 'includes/footer.php'; ?>
