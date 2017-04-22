<html>
<script>
    function pointFailed(){
        localStorage.setItem("didFail","Nothing was selected");
        window.location.assign("pendingDataPoints.php")
    }
    function pointAccepted(){
        localStorage.setItem("didFail","Data points were approved");
        window.location.assign("pendingDataPoints.php")
    }
    function pointRejected(){
        localStorage.setItem("didFail","Data points were rejected");
        window.location.assign("pendingDataPoints.php")
    }
</script>

<?php
    include "dbConn.php";

    $selected = $_POST['ch'];
    if ($_POST['action'] == 'Accept') {
        foreach ($selected as $value) {
            echo $value;
            $locationName = substr($value,0,strrpos($value,"|"));
            echo $locationName;
            $recordTime = substr($value, strpos($value,"|") + 1);
            echo $recordTime;
            $theQuery = "UPDATE DataPoint SET isApproved = 1 WHERE locationName = '$locationName' && recordTime = '$recordTime'";
            $theResponse = mysql_query($theQuery);
            echo mysql_error();
        }
        if ($theResponse) {
            echo "<script>pointAccepted();</script>";
        }

    }
    if ($_POST['action'] == 'Reject') {
        foreach ($selected as $value) {
            echo $value;
            $locationName = substr($value,0,strrpos($value,"|" ));
            $recordTime = substr($value, strpos($value,"|") + 1);
            $theQuery = "UPDATE DataPoint SET isApproved = 0 WHERE locationName = '$locationName' && recordTime = '$recordTime'";
            $theResponse = mysql_query($theQuery);
            echo mysql_error();
        }
         if($theResponse){
                echo "<script>pointRejected();</script>";
        }
    }
        if(!$theResponse){
                echo "<script>pointFailed();</script>";
            }
    //should alter the isApproved value in CityOfficials
 ?>
 </html>
