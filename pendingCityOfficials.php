<html>

<h1>Pending City Official Accounts</h1>
<script src="js/sorttable.js"></script>
<table class="sortable" border = "1">
    <tr>
        <th>Username</th>
        <th>Email</th>
        <th>City</th>
        <th>State</th>
        <th>Title</th>
        <th>Select</th>
    </tr>
<form action = "AcceptCityOfficial.php" method = "post">
<?php
    include "dbConn.php";
    $theQuery = "SELECT User.username,email,city,state,title FROM User,CityOfficial WHERE User.username = CityOfficial.username && isApproved IS NULL GROUP BY username";
    $theResponse = mysql_query($theQuery);


    while ($row = mysql_fetch_assoc($theResponse)) {
        echo '<tr>';
        echo '<td>'.$row["username"].'</td>';
        echo '<td>'.$row["email"].'</td>';
        echo '<td>'.$row["city"].'</td>';
        echo '<td>'.$row["state"].'</td>';
        echo '<td>'.$row["title"].'</td>';
        echo '<td><input type="checkbox" name="ch[]" value = "'.$row["username"].' "></td>';

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
