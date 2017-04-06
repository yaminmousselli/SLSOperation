<html>

<script>
function pointFailed(){
    localStorage.setItem("didFail","Invalid input, please check your data point's parameters and try again.");
    window.location.assign("AddDataPoint.php")
}
function pointSuccess(theLocation){
    localStorage.setItem("didFail","Point added to location "+theLocation);
    window.location.assign("AddDataPoint.php")
}
</script>
<!--
<form id="failForm" action="AddDataPoint.php">
    <input name="previousPageError" type="text" value="Inserting data point failed! Check your values and try again.">
</form>
-->
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
    $theValues = "'0','".$_POST["newDataValue"]."','".$_POST["newDataLocation"]."','".$_POST["newDataTime"]."','".$_POST["newDataType"]."'";
    echo $theValues;
    $theQuery = "INSERT INTO DataPoint (isApproved,dataValue,locationName,recordTime,type) VALUES (".$theValues.")";
    $theResponse = mysql_query($theQuery);
    echo mysql_error();
    if(!$theResponse){
        echo "<script>pointFailed();</script>"; //this will end the php because page change
    }
    if($theResponse){
        echo "<script>pointSuccess('".$_POST["newDataLocation"]."');</script>";
    }
    






?>





</html>