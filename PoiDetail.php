<html>
    <?php
    include "dbConn.php";
    ?>
    <h3 id="locationMessage"></h3>
    
    <script src="js/sorttable.js"></script>
    
    <h1>Poi Detail</h1>
    
    <script>
    function pointFlag(theFlag){
        localStorage.setItem("pointToFlag",localStorage.getItem("ourPoi")); //Why are these different, you ask? Why not just keep using "ourPoi"? Because they can be, ya dummy
        window.location.assign("flagPoint.php");
    }
    
    </script>
    <button onclick="pointFlag(localStorage.getItem('ourPoi')">Flag this point!</button>
    
    <form action="" method = "post">
        Type: <select name="dataType" required>
        <?php

        $theQuery = "SELECT readingType FROM `DataType`";
        $theResponse = mysql_query($theQuery);

        while($row = mysql_fetch_assoc($theResponse)) {
            echo "<option>".$row["readingType"]."</option>";
        }
        ?>        
        </select>
        
        Data Value: <input type="number" name="minValue" min="-99999" max="99999" required> to <input type="number" name="maxValue" min="-99999" max="99999" required>
        
        Time and Date:
        <input type="datetime-local" name="minDatetime" required>
        to
        <input type="datetime-local" name="maxDatetime" required>
        
        <input type="text" id="secretLoc" name="locationName" hidden> 
        
        <input type="submit" value="Apply Filters">
        <button type="button" onclick="resetFilters()">Reset Filter</button>
        
    </form>
    
    <script>
        document.getElementById('locationMessage').innerHTML = "POI Location: "+localStorage.getItem("ourPoi");
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
        
        $theQuery = "SELECT * FROM DataPoint 
        WHERE isApproved = 1 
        AND dataValue BETWEEN ".$_POST['minValue']." AND ".$_POST['maxValue']."
        AND locationName = '".$_POST['locationName']."'
        AND recordTime BETWEEN '".$_POST['minDatetime']."' AND '".$_POST['maxDatetime']."'
        AND type = '".$_POST['dataType']."'";
        
        //echo $theQuery;
        $theResponse = mysql_query($theQuery);
        
        while($row = mysql_fetch_assoc($theResponse)) {
            echo "<tr><td>".$row['type']."</td><td>".$row['dataValue']."</td><td>".$row['recordTime']."</td></tr>";
        }
    }
    ?>
        
    </table>

            
            
            
            
    
    
    
    
    
    
</html>