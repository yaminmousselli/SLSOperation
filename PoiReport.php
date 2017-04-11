<html>


<h1>Poi Report</h1>

<table class="sorttable">
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
    
    $conn = mysql_connect("localhost","compuser","yeahsure");
    mysql_select_db("4400DatabaseProject",$conn);
    echo mysql_error();

    if (!$conn) {
        echo "Unable to connect to DB: " . mysql_error();
        exit;
    }

    $theQuery = "SELECT isApproved, MIN(dataValue), AVG(dataValue), MAX(dataValue), locationName, type FROM DataPoint GROUP BY locationName, type ORDER BY locationName";
    $theResponse = mysql_query($theQuery);
    
    
    $concatLikeRows = array();
    while ($row = mysql_fetch_assoc($theResponse)) {
        $notIn = true;
        $arrlength = count($concatLikeRows);
        for($x = 0; $x < $arrlength; x++;){
            if($row['locationName' == $concatLikeRows[$x]['locationName']){
                $notIn = false;
                $concatLikeRows[$x] = array_merge($concatLikeRows[$x],$row); //THIS NEEDS TO MAKE SEPARATE SUMMARY KEYS FOR MOLD AND AQ
            }
        }
        if($notIn){
            array_push($concatLikeRows,$row)
        }
    }
    $c = $concatLikeRows
    $arrlength = count($c);
    for($x = 0; $x < $arrlength; x++;){
        echo "<tr><td>".$c['locationName']."</td><td>"."FILLER"."</td><td>"."FILLER"."</td><td>".$c."</td><td>".."</td><td>".."</td><td>".."</td><td>".."</td><td>".."</td><td>".."</td><td>".."</td></tr>"
    }
    ?>
    </table>
</html>
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    