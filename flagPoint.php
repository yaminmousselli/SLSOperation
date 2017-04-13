<html>

    <script>
    function wasFlagged(){
        localStorage.setItem("wasItFlagged","Location flagged!");
        window.location.assign('PoiDetail.php');
    }
    function wasNotFlagged(){
        localStorage.setItem("wasItFlagged","Location unflagged!");
        window.location.assign('PoiDetail.php');
    }
    </script>
    <?php

    include "dbConn.php";
    
    $theQuery = "SELECT locationName, flagged FROM Poi WHERE locationName = '".$_POST['locationName']."'";
    $theResponse = mysql_query($theQuery);
    
    $flagged = false;
    while($row = mysql_fetch_assoc($theResponse)) {
        if($row['flagged'] == 1){
            $flagged = true;
        }
    }
    
    if(!$flagged){
        $theQuery = "UPDATE Poi SET  flagged =  1 WHERE  locationName = '".$_POST['locationName']."'";
        $theResponse = mysql_query($theQuery);
        if(!$theResponse){
            mysql_error();
        }
        echo "<script>wasFlagged()</script>";
    }
    
    if($flagged){
        $theQuery = "UPDATE Poi SET  flagged =  0 WHERE  locationName = '".$_POST['locationName']."'";
        $theResponse = mysql_query($theQuery);
        if(!$theResponse){
            mysql_error();
        }
        echo "<script>wasNotFlagged()</script>";
    }
    
  

    ?>