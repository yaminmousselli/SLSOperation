<html>
<script>
    function pointFailed(){
        localStorage.setItem("didFail","Nothing was selected");
        window.location.assign("pendingCityOfficials.php")
    }
    function pointAccepted(){

            localStorage.setItem("didFail","CityOfficials were approved");
        window.location.assign("pendingCityOfficials.php")
    }
    function pointRejected(){
            localStorage.setItem("didFail","CityOfficials were rejected");
        window.location.assign("pendingCityOfficials.php")
    }
</script>

<?php 
    include "dbConn.php";

    $selected = $_POST['ch'];
    if ($_POST['action'] == 'Accept') {
        foreach ($selected as $value) {
            
            $theQuery = "UPDATE CityOfficial 
            SET isApproved = 1 
            WHERE username = '$value'";     
            $theResponse = mysql_query($theQuery);
            echo mysql_error(); 
        }
        if ($theResponse) {
            echo "<script>pointAccepted();</script>";
        }

    }
    if ($_POST['action'] == 'Reject') {
        foreach ($selected as $value) {
            
            $theQuery = "DELETE FROM User WHERE username = '$value'";     
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