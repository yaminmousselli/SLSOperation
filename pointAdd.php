<html>

<script>
function pointFailed(){
    document.failForm.submit();
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

    $theValues = "'0','".$_POST["newDataValue"]."','".$_POST["newDataLocation"]."','".$_POST["newDataTime"]."','".$_POST["newDataType"]."'";
    $theQuery = "INSERT INTO DataPoint (isApproved,dataValue,locationName,recordTime,type) VALUES (".$theValues.")";
    $theResponse = mysql_query($theQuery);
    echo mysql_error();
    if(!$theResponse){
        echo "<script>pointFailed();</script>"; //this will end the php because page change
    }

    








?>

<form name=failForm action="AddDataPoint.php">
    <input type="text" value="Inserting data point failed! Check your values and try again.">
</form>



</html>