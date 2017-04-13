<html>


<h1>Poi Report</h1>
<script src="js/sorttable.js"></script>
<table class="sortable">
    <tr>
        <th>Location</th>
        <th>State</th>
        <th>City</th>
        <th>Mold Min</th>
        <th>Mold Avg</th>
        <th>Mold Max</th>
        <th>AQ Min</th>
        <th>AQ Avg</th>
        <th>AQ Max</th>
        <th># of data points</th>
        <th>Flagged?</th>
    </tr>
    <?php
    
    ini_set('display_errors', 'On');
    error_reporting(E_ALL | E_STRICT);
    
    include "dbConn.php";
    /*echo "oh sheesh";
    $conn = mysql_connect("localhost","compuser","yeahsure");
    mysql_select_db("4400DatabaseProject",$conn);
    echo mysql_error();

    if (!$conn) {
        echo "Unable to connect to DB: " . mysql_error();
        exit;
    }*/

    $theQuery = "SELECT isApproved, MIN(dataValue), AVG(dataValue), MAX(dataValue), locationName, type FROM DataPoint GROUP BY locationName, type ORDER BY locationName";
    $theResponse = mysql_query($theQuery);
    
    
    $concatLikeRows = array();
    while ($row = mysql_fetch_assoc($theResponse)) {
        if($row['type'] == 'Mold'){
            $row['minMold'] = $row['MIN(dataValue)'];
            $row['avgMold'] = $row['AVG(dataValue)'];
            $row['maxMold'] = $row['MAX(dataValue)'];
            unset($row['MIN(dataValue)']);
            unset($row['AVG(dataValue)']);
            unset($row['MAX(dataValue)']);
        }
        if($row['type'] == 'Air Quality'){
            $row['minAQ'] = $row['MIN(dataValue)'];
            $row['avgAQ'] = $row['AVG(dataValue)'];
            $row['maxAQ'] = $row['MAX(dataValue)'];
            unset($row['MIN(dataValue)']);
            unset($row['AVG(dataValue)']);
            unset($row['MAX(dataValue)']);
            
            
        }
        


        $notIn = true;
        $arrlength = count($concatLikeRows);
        for($x = 0; $x < $arrlength; $x++){
            if($row['locationName'] == $concatLikeRows[$x]['locationName']){
                $notIn = false;
                $concatLikeRows[$x] = array_merge($concatLikeRows[$x],$row); //THIS NEEDS TO MAKE SEPARATE SUMMARY KEYS FOR MOLD AND AQ
            }
        }
        if($notIn){
            array_push($concatLikeRows,$row);
        }
    }
    $c = $concatLikeRows;
    
    $theQuery = "SELECT locationName, city, state, flagged FROM Poi";
    $theResponse = mysql_query($theQuery);
    while ($row = mysql_fetch_assoc($theResponse)) {
        $arrlength = count($c);
        for($x = 0; $x < $arrlength; $x++){
            if($row['locationName'] == $c[$x]['locationName']){
                $c[$x]['city'] = $row['city'];
                $c[$x]['state'] = $row['state'];
                if($row['flagged'] == 0){
                    $c[$x]['flagged'] = 'no';
                }
                if($row['flagged'] == 1){
                    $c[$x]['flagged'] = 'yes';
                }
            }
        }
    }
    
    $theQuery = "SELECT COUNT(*),locationName FROM DataPoint GROUP BY locationName";
    $theResponse =  mysql_query($theQuery);
    while ($row = mysql_fetch_assoc($theResponse)) {
        $arrlength = count($c);
        for($x = 0; $x < $arrlength; $x++){
            if($row['locationName'] == $c[$x]['locationName']){
                $c[$x]['numPoints'] = $row['COUNT(*)'];
                
            }
        }
    }
   
    
    $arrlength = count($c);
    for($x = 0; $x < $arrlength; $x++){

        if(count($c[$x]) == 13){//I should figure out why $c[$x] has 13 attributes but whateva
            echo "<tr><td>".$c[$x]['locationName']."</td><td>".$c[$x]['city']."</td><td>".$c[$x]['state']."</td><td>".$c[$x]['minMold']."</td><td>".$c[$x]['avgMold']."</td><td>".$c[$x]['maxMold']."</td><td>".$c[$x]['minAQ']."</td><td>".$c[$x]['avgAQ']."</td><td>".$c[$x]['maxAQ']."</td><td>".$c[$x]['numPoints']."</td><td>".$c[$x]['flagged']."</td></tr>";
        }
    }
    
    
    ?>
    </table>
</html>
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    