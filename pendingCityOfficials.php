<html>

<h1>Pending City Official Accounts</h1>
<script src="js/sorttable.js"></script>
<table class="sortable">
    <tr>
        <th>Username</th>
        <th>Email</th>
        <th>City</th>
        <th>State</th>
        <th>Title</th>
        <th>Select</th>
    </tr>

<?php
    include "dbConn.php";
    $theQuery = "SELECT User.username,email,city,state,title FROM User,CityOfficial WHERE User.username = CityOfficial.username GROUP BY username";
    $theResponse = mysql_query($theQuery);
    
    $concatLikeRows = array();
    while ($row = mysql_fetch_assoc($theResponse)) {
        echo '<tr>';
        echo '<td>'.$row["username"].'</td>';
        echo '<td>'.$row["email"].'</td>'; 
        echo '<td>'.$row["city"].'</td>'; 
        echo '<td>'.$row["state"].'</td>'; 
        echo '<td>'.$row["title"].'</td>';   
        echo '<td><input type="checkbox" name="ch1"value="unchecked"></td>';
        echo '</tr>';
    }   

?>
</table>
<form action = "ChooseFunctionalityOfficial.html">
    <input type="submit" value="Back">
</form>
<br>
<form action = "RejectCityOfficial.php"> <!--should delete selected CityOfficials -->
    <input type = "submit" value = "Reject">
<form>
<br>
<form action = "AcceptCityOfficial.php"> <!--should alter isApproved value for
CityOfficials -->
    <input type = "submit" value = "Accept">
</form>
</html>
