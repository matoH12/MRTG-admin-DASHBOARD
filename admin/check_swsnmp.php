<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';


// Sanitize if you want
$id = filter_input(INPUT_GET, 'customer_id', FILTER_VALIDATE_INT);
$db = getDbInstance();

//Handle update request. As the form's action attribute is set to the same script, but 'POST' method, 


	$db->where ('id', $id);
        $ip = $db->getValue ("swzoznam", "swip", null);

        foreach ($ip as $ips){

        $sysUpTime = "1.3.6.1.2.1.1.3.0";
        $oo3 = clean_output(snmpget($ips,"public",$sysUpTime));

        if($oo3) {
		  $stat = 'TRUE';
                $db->where ('swip', $ips);
                $data= array ( 'snmpuptime' => $oo3 );
                $db->update ('swzoznam', $data);
                }
        else {
                  $stat = 'FALSE';

                $db->where ('swip', $ips);
                $data= array ( 'snmpuptime' => 'error');
                $db->update ('swzoznam', $data);

                }
}








   if($stat == 'TRUE')
    {
        $_SESSION['success'] = "SNMP pripojenie funguje!";
        //Redirect to the listing page,
        header('location: swzoznam.php');
        //Important! Don't execute the rest put the exit/die.
        exit();
    }
  else{
        $_SESSION['failure'] = "SNMP pripojenie NEfunguje!";
        //Redirect to the listing page,
        header('location: swzoznam.php');
        //Important! Don't execute the rest put the exit/die.
        exit();
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
//            require_once('./forms/swzoznam_form.php'); 
        ?>
    </form>
</div>




<?php include_once 'includes/footer.php'; ?>
