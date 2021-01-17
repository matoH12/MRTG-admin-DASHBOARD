<?php
//Including Database configuration file.
include "admin/config/config.php";
//Getting value of "search" variable from "script.js".
if (isset($_POST['search'])) {
    //Search box value assigning to $Name variable.
    $Name = $_POST['search'];
    //Search query.
    //$Query = "SELECT Name FROM search WHERE Name LIKE '%$Name%' LIMIT 5";
    $Query = "SELECT * FROM swzoznam WHERE swname LIKE '%$Name%' or swip LIKE '%$Name%' GROUP BY swname, swip LIMIT 5";
    $Query2 = "SELECT * FROM swzoznam WHERE swname LIKE '$Name' or swip LIKE '$Name' GROUP BY swname LIMIT 5";
    //Query execution

    $con = MySQLi_connect(DB_HOST, //Server host name.
        DB_USER, //Database username.
        DB_PASSWORD, //Database password.
        DB_NAME //Database name or anything you would like to call it.
    );


    if (MySQLi_connect_errno()) {
        echo "Failed to connect to MySQL: " . MySQLi_connect_error();
    }

    $fullnameorip = MySQLi_query($con,$Query2);

    if(mysqli_num_rows($fullnameorip) != 0) {

        $ExecQuery = $fullnameorip;

    }
    else {

        $ExecQuery = MySQLi_query($con, $Query);
    }




    //$ExecQuery = $db->rawQuery($Query);
    //Creating unordered list to display result.
    echo '<ul>';
    //Fetching result from database.


    while ($Result = MySQLi_fetch_array($ExecQuery)) {
        ?>
        <!-- Creating unordered list items.
             Calling javascript function named as "fill" found in "script.js" file.
             By passing fetched result as parameter.
        <li onclick='fill("<?php echo $Result['swname']; ?>")'>
            <a>-->
                <!-- Assigning searched result in "Search box" in "search.php" file. -->
                <!-- <?//php echo $Result['swname']; ?>-->
                <?php echo "<li><a href='mrtg/".$Result['swip'].".html'>".$Result['swname']."</a>  UPTIME: ".$Result['snmpuptime']."</li>"; ?>
        <!-- </li></a>-->

        <!-- Below php code is just for closing parenthesis. Don't be confused. -->
        <?php
    }}
?>
</ul>