<!DOCTYPE html>
<html>
	<script>
    function pointFailed() {
        localStorage.setItem("didFail","Invalid input, please check your data location's parameters and try again.");
        window.location.assign("AddLocation.php")
}
    function pointSuccess(theLocation) {
        localStorage.setItem("didFail", theLocation + " was added");
        window.location.assign("AddLocation.php")
}
</script>
<?php
    include "dbConn.php";
    var_dump($_POST);
    echo "<br>";
    $theValues = "'".$_POST["newLocation"]."','".$_POST["zipCode"]."','".$_POST["City"]."', '".$_POST["State"]."'";

    $theQuery = "INSERT INTO Poi (locationName,zipcode,city, state) VALUES(".$theValues.")";
    $theResponse = mysql_query($theQuery);
    echo mysql_error();

    if (!$theResponse) {
    	echo "<script>pointFailed();</script>";
    }

    if ($theResponse) {
    	echo "<script>pointSuccess('".$value."')</script>";
    }
 ?>
</html>
