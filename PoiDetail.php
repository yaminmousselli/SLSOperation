<html>
    <?php
    include "dbConn.php";
    ?>
    <h3 id="locationMessage"></h3>
    <h4 id="flagMessage"></h4>

    <script src="js/sorttable.js"></script>

    <h1>Poi Detail</h1>

    <script>
    function pointFlag(){
        localStorage.setItem("pointToFlag",localStorage.getItem("ourPoi")); 
        document.getElementById('locName').value = localStorage.getItem("pointToFlag");
        document.getElementById("secForm").submit();
    }
    </script>

    <form action = "flagPoint.php" id='secForm' method="post" hidden>
        <input type='text' id='locName' name='locationName'>
    </form>

    <button onclick="pointFlag()">Toggle Flag</button>

    <form action="" method = "post">
        Type: <select name="dataType">
        <option>Any</option>
        <?php

        $theQuery = "SELECT readingType FROM `DataType`";
        $theResponse = mysqli_query($conn, $theQuery);

        while($row = mysqli_fetch_assoc($theResponse)) {
            echo "<option>".$row["readingType"]."</option>";
        }
        ?>        
        </select>

        Data Value: <input type="number" name="minValue" min="-99999" max="99999"> to <input type="number" name="maxValue" min="-99999" max="99999">
        
        Time and Date:
        <input type="datetime-local" name="minDatetime">
        to
        <input type="datetime-local" name="maxDatetime">
        
        <input type="text" id="secretLoc" name="locationName" hidden> 
        
        <input type="submit" value="Apply Filters">
        <button type="button" onclick="resetFilters()">Reset Filter</button>
    </form>
    
    <script>
        document.getElementById('locationMessage').innerHTML = "POI Location: "+localStorage.getItem("ourPoi");
        document.getElementById('flagMessage').innerHTML = localStorage.getItem("wasItFlagged");
        localStorage.setItem("wasItFlagged","")
        document.getElementById('secretLoc').value = localStorage.getItem("ourPoi");
    </script>
    
    <table class="sortable">
        <tr>
            <th>Reading Type</th>
            <th>Data Value</th>
            <th>Date and Time of Reading</th>
        </tr>
    <?php
    if (count($_POST) != 1){        
        $pointQuery = "SELECT * FROM DataPoint 
        WHERE isApproved = 1 AND ";

        if($_POST['minValue'] != ''){
            $pointQuery .= "dataValue >= " . $_POST['minValue']." AND "; 
        }
        if($_POST['maxValue'] != ''){
            $pointQuery .= "dataValue <= " . $_POST['maxValue']." AND ";
        }
        if($_POST['locationName'] != ''){
            $pointQuery .= "locationName = '" . $_POST['locationName']."' AND ";
        }
        if($_POST['minDatetime'] != ''){
            $pointQuery .= "recordTime >= '" . $_POST['minDatetime']."' AND ";
        }
        if($_POST['maxDatetime'] != ''){
            $pointQuery .= "recordTime <= '" . $_POST['maxDatetime']."' AND ";
        }
        if($_POST['dataType'] != 'Any'){
            $pointQuery .= "type = '" . $_POST['dataType']."' AND ";
        }

        // If there is a trailng AND, get rid of it
        $lastAndIndex = strrpos($pointQuery, "AND ");
        if ($lastAndIndex !== FALSE) {
            $pointQuery = substr($pointQuery, 0, $lastAndIndex);
        }

        $theResponse = mysqli_query($conn, $pointQuery);

        while($row = mysqli_fetch_assoc($theResponse)) {
            $tableRow = "<tr>";
            $tableRow .= "<td>" . $row['type'] . "</td>";
            $tableRow .= "<td>" . $row['dataValue'] . "</td>";
            $tableRow .= "<td>" . $row['recordTime'] . "</td>";
            $tableRow .= "</tr>";
            echo $tableRow;
        }
    }
    ?>
    </table>
</html>