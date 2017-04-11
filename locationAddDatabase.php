<!DOCTYPE html>
<html>
	<script type="text/javascript"></script>


<?php 
	$conn = mysql_connect("localhost","compuser","yeahsure");
    mysql_select_db("4400DatabaseProject",$conn);
    echo mysql_error();
    
    if (!$conn) {
        echo "Unable to connect to DB: " . mysql_error();
        exit;
    }
    var_dump($_POST);
    echo "<br>";
    $theValues = ""

    $theQuery = "INSERT INTO Poi (locationName,zipcode,city, state) VALUES(".$theValues.")";
    $theResponse = mysql_query($theQuery);
    echo mysql_error();

    if(!$theResponse){
    	// echo 
    }

    if($theResponse){
    	//echo
    }

 ?>






</html>