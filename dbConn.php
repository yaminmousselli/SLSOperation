<?php            
    $conn = mysql_connect("localhost","compuser","yeahsure");
        mysql_select_db("4400DatabaseProject",$conn); 
        echo mysql_error();
            if (!$conn) {
                echo "Unable to connect to DB: " .mysql_error();
            exit;
        }
?>
