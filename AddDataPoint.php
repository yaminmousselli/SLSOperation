<html>

    <head><link rel="stylesheet" type="text/css" href="main.css"></head>

    <div>
        <center><h1>Add Data Point</h1></center>
    </div>
    
    <a href="addLocation">add a new location</a>
    <br>
    <br>
    <h3>POI Location Name: </h3>
    <select>
    <?php
    
    $conn = mysql_connect("localhost","compuser","yeahsure");
    mysql_select_db("4400DatabaseProject",$conn);


    if (!$conn) {
        echo "Unable to connect to DB: " . mysql_error();
        exit;
    }
    
    $theQuery = "SELECT locationName FROM ``";
    $theResponse = mysql_query($theQuery);

    while($row = mysql_fetch_assoc($theResponse)) {
        echo "<option>".$row["locationName"]."</option>";
    }
    ?>
    </select>
    
</html>