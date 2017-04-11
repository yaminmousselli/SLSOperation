<html>

    <head><link rel="stylesheet" type="text/css" href="main.css"></head>

    <div>
        <center><h1>Add a new Location</h1></center>
    </div>

    <?php  
//we gucci

    ?>

    <form action="locationAddDatabase.php" method = "post">
        <h3>POI location name: </h3>
        <input type = "text" name = "newLocation"><br>

        <h3>City:</h3>
        <select name="City" required>
        <?php 
            $conn = mysql_connect("localhost","compuser","yeahsure");
            mysql_select_db("4400DatabaseProject",$conn);
            echo mysql_error();

            if (!$conn) {
                echo "Unable to connect to DB: " .mysql_error();
                exit;
            }

            $theQuery = "SELECT city FROM CityState";
            $theResponse = mysql_query($theQuery);

            while($row  = mysql_fetch_assoc($theResponse)) {
                echo "<option>".$row["city"]."</option>";
            }
        ?>
            
        </select>   

        <br>
        <br>

        <h3>State:</h3>
        <select name = "State" required> 
        <?php 
            $conn = mysql_connect("localhost","compuser","yeahsure");
            mysql_select_db("4400DatabaseProject",$conn);
            echo mysql_error();

            if (!$conn) {
                echo "Unable to connect to DB: " .mysql_error();
                exit;
            }

            $theQuery = "SELECT DISTINCT state FROM CityState";
            $theResponse = mysql_query($theQuery);

            while($row  = mysql_fetch_assoc($theResponse)) {
                echo "<option>".$row["state"]."</option>";
            }
        ?>
        </select>


        <h3>Zip code: </h3><br>
        <input type = "text" name = "zipCode">
        <br>
        <br>
        <input type="submit" value="Submit">
        <input type="reset">
        <br>
        <p id = 'errorMsg'></p>
        <script>
        document.getElementById('errorMsg').innerHTML = localStorage.getItem("didFail");
        localStorage.setItem("didFail","");
        </script>   


    </form> 


    <form action="index.html">
        <input type="submit" value="Log out">
    </form>

</html>