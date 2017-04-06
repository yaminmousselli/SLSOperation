<html>

    <head><link rel="stylesheet" type="text/css" href="main.css"></head>

    <div>
        <center><h1>Add Data Point</h1></center>
    </div>
    
    <a href="addLocation">add a new location</a>
    <br>
    <br>
    <form action="/pointAdd.php">
        <h3>POI Location Name: </h3>

        <select name="newDataLocation">
        <?php
        
        $conn = mysql_connect("localhost","compuser","yeahsure");
        mysql_select_db("4400DatabaseProject",$conn);
        echo mysql_error();

        if (!$conn) {
            echo "Unable to connect to DB: " . mysql_error();
            exit;
        }

        
        $theQuery = "SELECT locationName FROM `Poi`";
        $theResponse = mysql_query($theQuery);

        while($row = mysql_fetch_assoc($theResponse)) {
            echo "<option>".$row["locationName"]."</option>";
        }
        ?>
        </select>
        
        <br>
        <br>

        <h3> Time and Date of Reading </h3>
        <input type="datetime-local" name="newDataTime">

        <br>
        <br>

        <h3> Data Type </h3>
        <select name="newDataType">
        <?php
        
        $conn = mysql_connect("localhost","compuser","yeahsure");
        mysql_select_db("4400DatabaseProject",$conn);
        echo mysql_error();

        if (!$conn) {
            echo "Unable to connect to DB: " . mysql_error();
            exit;
        }

        
        $theQuery = "SELECT readingType FROM `DataType`";
        $theResponse = mysql_query($theQuery);

        while($row = mysql_fetch_assoc($theResponse)) {
            echo "<option>".$row["readingType"]."</option>";
        }
        ?>        
        </select>

        <h3>Data value</h3>
        <input type="number" name="newDataValue" min="-99999" max="99999">
        <br>
        <br>
        <input type="submit" value="Submit">
        <input type="reset">
    </form>

    <form action="index.html">
        <input type="submit" value="Log out" />
    </form>
    


















</html>