<html>

    <head><link rel="stylesheet" type="text/css" href="main.css"></head>

    <div>
        <center><h1>Add Data Point</h1></center>
    </div>

    <?php include "dbConn.php"; ?>

    <a href="AddLocation.php">add a new location</a>
    <br>
    <br>
    <form action="pointAdd.php" method="post">
        <h3>POI Location Name: </h3>

        <select name="newDataLocation" required>
        <?php

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
        <input type="datetime-local" name="newDataTime" required>

        <br>
        <br>

        <h3> Data Type </h3>
        <select name="newDataType" required>
        <?php

        $theQuery = "SELECT readingType FROM `DataType`";
        $theResponse = mysql_query($theQuery);

        while($row = mysql_fetch_assoc($theResponse)) {
            echo "<option>".$row["readingType"]."</option>";
        }
        ?>
        </select>

        <h3>Data value</h3>
        <input type="number" name="newDataValue" min="-99999" max="99999" required>
        <br>
        <br>
        <input type="submit" value="Submit">
        <input type="reset">
        <br>
        <p id='errorMsg'></p>
        <script>
        document.getElementById('errorMsg').innerHTML = localStorage.getItem("didFail");
        localStorage.setItem("didFail","");
        </script>
    </form>

    <form action="index.html">
        <input type="submit" value="Log out" />
    </form>
</html>
