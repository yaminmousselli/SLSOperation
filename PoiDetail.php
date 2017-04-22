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
        localStorage.setItem("pointToFlag",localStorage.getItem("ourPoi")); //Why are these different, you ask? Why not just keep using "ourPoi"? Because they can be, ya dummy
        //document.write("come ON!");
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

        $theQuery = "SELECT readingType FROM DataType";
        $theResponse = mysql_query($theQuery);

        while($row = mysql_fetch_assoc($theResponse)) {
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
        /*
        $theQuery = "SELECT * FROM DataPoint 
        WHERE isApproved = 1 
        AND dataValue BETWEEN ".$_POST['minValue']." AND ".$_POST['maxValue']."
        AND locationName = '".$_POST['locationName']."'
        AND recordTime BETWEEN '".$_POST['minDatetime']."' AND '".$_POST['maxDatetime']."'
        AND type = '".$_POST['dataType']."'";
        */
        
        $theQuery = "SELECT * FROM DataPoint 
        WHERE isApproved = 1 AND ";
        
        if($_POST['minValue'] != ''){
            $theQuery = $theQuery."dataValue >= ".$_POST['minValue']." AND "; 
        }
        if($_POST['maxValue'] != ''){
            $theQuery = $theQuery."dataValue <= ".$_POST['maxValue']." AND ";
        }
        if($_POST['locationName'] != ''){
            $theQuery = $theQuery."locationName = '".$_POST['locationName']."' AND ";
        }
        if($_POST['minDatetime'] != ''){
            $theQuery = $theQuery."recordTime >= '".$_POST['minDatetime']."' AND ";
        }
        if($_POST['maxDatetime'] != ''){
            $theQuery = $theQuery."recordTime <= '".$_POST['maxDatetime']."' AND ";
        }
        if($_POST['dataType'] != 'Any'){
            $theQuery = $theQuery."type = '".$_POST['dataType']."' AND ";
        }
        
        $theQuery = $theQuery."1";
        
        //echo $theQuery;
        $theResponse = mysql_query($theQuery);
        
        while($row = mysql_fetch_assoc($theResponse)) {
            echo "<tr><td>".$row['type']."</td><td>".$row['dataValue']."</td><td>".$row['recordTime']."</td></tr>";
        }
    }
    ?>
        
    </table>

            
            
            
            
    
    
    
    
    
    
</html>