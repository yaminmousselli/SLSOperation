<html>

<h1>Pending Data Points</h1>
<script src="js/sorttable.js"></script>
<table class="sortable" border = "1">
    <tr>
        <th>POI location</th>
        <th>Data type</th>
        <th>Data values</th>
        <th>Time and Date of data reading</th>
        <th>Select</th>
    </tr>
<form action = "dataPointApproval.php" method = "post"> 

<?php
    include "dbConn.php";
    $theQuery = "SELECT * FROM DataPoint WHERE isApproved IS NULL";
    $theResponse = mysql_query($theQuery);
   
 
    while ($row = mysql_fetch_assoc($theResponse)) {
        echo '<tr>';
        echo '<td>'.$row["locationName"].'</td>';
        echo '<td>'.$row["type"].'</td>'; 
        echo '<td>'.$row["dataValue"].'</td>'; 
        echo '<td>'.$row["recordTime"].'</td>'; 
        echo '<td><input type="checkbox" name="ch[]" value = "'.$row["locationName"].'|'.$row["recordTime"].'"></td>';
    
        echo '</tr>';
    }  

        
?>

</table>

    <input type = "submit" name = "action" value = "Accept">
    <br>
    <input type = "submit" name = "action" value = "Reject">

    <p id = 'errorMsg'></p>
        <script>
        document.getElementById('errorMsg').innerHTML = localStorage.getItem("didFail");
        localStorage.setItem("didFail","");
        </script>   

</form>
<form action = "ChooseFunctionalityAdmin.html">
    <input type="submit" value="Back">
</form>



</html>
