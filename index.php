<!DOCTYPE HTML>

<?php

function budova($mysqli) 
{
    $res = $mysqli->query("Select id FROM budova");
#    $res = ExecuteQuery($mysqli, $res);
    return $res;
}

function lokalita($id_budova)
{
$mysqli = new mysqli("localhost", "admin", 'yadFidth', "mrtgadmin");

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

	echo "<span class='domain'><h3><strong>".$row['nazov']."</strong></h3></span>";
        echo "<ul>";





    $res2 = $mysqli->query("Select id, nazov FROM lokalita where  budovaid = ".$row['id']." order by nazov");
    while ($row2 = $res2->fetch_assoc())
    {	


	echo "<li><span class='host'><a href='javascript:void(1)' onclick=\"toggle_visibility('".$row2['nazov']."');\">".$row2['nazov']."</a></span>";

        echo "<div id='".$row2['nazov']."' class='alist' style='display:none;'><ul>";







    $res3 = $mysqli->query("Select swname, swip, snmpuptime FROM swzoznam where  idbudova = ".$row['id']." and idlokalita =".$row2['id']." order by swname");
    while ($row3 = $res3->fetch_assoc())

    {


	echo "<li><a href='mrtg/".$row3['swip'].".html'>".$row3['swname']."</a>  UPTIME: ".$row3['snmpuptime']."</li>";


    }



        echo "</ul></div></li>";



    }


        echo "</ul>";


//        echo '<li id='.$row["id"].'><a href="#">'.$row["name"].'</a></li>';
    }
$mysqli->close();
}
?>
<!DOCTYPE HTML>
<html>                   
    <head>                                   
        <title>Mrtg                           
        </title>                                   
        <meta charset="utf-8" />                                   
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />                                   
        <link rel="stylesheet" href="assets/css/main.css" />                                           
        <link rel="shortcut icon" type="image/x-icon" href="../favicon.ico?" />                                           
        <noscript>                                      
            <link rel="stylesheet" href="assets/css/noscript.css" />                          
        </noscript>                   
    </head>                   
    <body class="is-preload">       
<script type="text/javascript">
        function toggle_visibility(id) {
                var list = document.getElementsByClassName("alist");
                for (var i = 0; i < list.length; i++) {
                        list[i].style.display = 'none';
                            }
                    var e = document.getElementById(id);
                    if(e.style.display == 'block') {
                            e.style.display = 'none';
                                } else {
                                        e.style.display = 'block';
                                        }
        }
    </script>                                      
        <!-- Wrapper -->                                          
        <div id="wrapper">                                                       
            <!-- Header -->                                                              
            <header id="header" class="alt">                                                                           
                <span class="logo">                                                              
                    <img src="../logo.png" />                                                  
                </span>                        <h1>Mrtg UVT TUKE</h1>                                                           
            </header>                                                       
            <!-- Nav -->                                                          
            <!-- Main -->                                                              
            <div id="main">                                                                           
                <!-- Introduction -->                                                                                  
                <section id="intro" class="main">                                                                                                   
                    <div class="content">                                                                                                                   
                        <header class="major">                                            <h2>Lokality</h2>                                                                                                                   
                        </header>                                                                                                                       





            <?php lokalita( 1) ?>








                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          
                    </div>                                                                       
            </div>                                                                   
            </section>                                               
        </div>                                           
        <!-- Footer -->                                                  
        <footer id="footer">                                                               
            <section>                            <h2>(C) UVT</h2>                                                                               
                <dl class="alt">                                                                                               
                    <p>                                                              
                    </p>                                                                               
                </dl>                                                               
            </section>                                               
        </footer>                                       
        </div>                                   
        <!-- Scripts -->                  
<script src="../assets/js/jquery.min.js"></script>                  
<script src="../assets/js/jquery.scrollex.min.js"></script>                  
<script src="../assets/js/jquery.scrolly.min.js"></script>                  
<script src="../assets/js/browser.min.js"></script>                  
<script src="../assets/js/breakpoints.min.js"></script>                  
<script src="../assets/js/util.js"></script>                  
<script src="../assets/js/main.js"></script>     
<script type="text/javascript">
    var userip;
    function getIP(json) {
            userip = json.ip
    }   
</script>     
<script type="application/javascript" src="https://api.ipify.org?format=jsonp&callback=getIP"></script>     
<script type="text/javascript">

</script>                 
    </body>
</html>
