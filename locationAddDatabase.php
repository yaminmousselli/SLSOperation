<!DOCTYPE html>
<html>
	<script>
    function pointFailed(){
        localStorage.setItem("didFail","Invalid input, please check your data location's parameters and try again.");
        window.location.assign("AddLocation.php")
}
    function pointSuccess(theLocation){
        localStorage.setItem("didFail", theLocation + "was added");
        window.location.assign("AddLocation.php")
}
</script>


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
    $theValues = "'".$_POST["newLocation"]."','".$_POST["zipCode"]."','".$_POST["City"]."', '".$_POST["State"]."'";

    $theQuery = "INSERT INTO Poi (locationName,zipcode,city, state) VALUES(".$theValues.")";
    $theResponse = mysql_query($theQuery);
    echo mysql_error();

    if(!$theResponse){
    	echo "<script>pointFailed();</script>"; 
    }

    if($theResponse){
    	echo <script>pointSuccess('".$_POST["newLocation"]."')</script>
    }

 ?>






</html>