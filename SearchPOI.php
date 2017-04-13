<html>

    <head>
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/search_poi.css">

    <script type="text/javascript" src="js/search_poi.js"></script>
    </head>
    <?php
    include "dbConn.php";
    ?>
    <header>Operation SLS</header>
    
    <div id="container">
        
        <div id="mainContent">
            <div>
                <h3>View POIs</h3>
            </div>
            
            <form action="" method="post">  
                <div class="viewEntry">
                    <label for="poiNameSelect">POI Location Name</label>
                    <select id="poiNameSelect" name="poiNameSelect">
                    <?php

                    $theQuery = "SELECT locationName FROM `Poi`";
                    $theResponse = mysql_query($theQuery);

                    while($row = mysql_fetch_assoc($theResponse)) {
                        echo "<option>".$row["locationName"]."</option>";
                    }
                    ?>
                    </select>
                </div>

                <div class="viewEntry">
                    <label for="citySelect">City</label>
                    <select id="citySelect" name="citySelect">
                    <?php

                    $theQuery = "SELECT city FROM CityState";
                    $theResponse = mysql_query($theQuery);

                    while ($row = mysql_fetch_assoc($theResponse)) {
                        echo "<option>".$row["city"]."</option>";
                    }
                    ?></select>
                </div>

                <div class="viewEntry">
                    <label for="stateSelect">State</label>
                    <select id="stateSelect" name="stateSelect">
                    <?php

                        $theQuery = "SELECT DISTINCT state FROM CityState";
                        $theResponse = mysql_query($theQuery);
                        while ($row = mysql_fetch_assoc($theResponse)) {
                            echo "<option>".$row["state"]."</option>";
                        }
                    ?></select>
                </div>

                <div class="viewEntry">
                    <label for="zipSelect">Zip Code</label>
                    <input type="text" id="zipCode" name="zipCode">
                </div>

                <div class="viewEntry">
                    <label for="poiNameSelect">Flagged?</label>
                    <input type="checkbox" id="isFlagged" name="isFlagged" value="isFlagged">
                </div>

                <div class="viewEntry" id="dateFlaggedEntry">
                    <label for="date">Date Flagged</label>
                    <input type="datetime-local" id="dateFlaggedStart" name="dateFlaggedStart"> <p>to</p> <input type="datetime-local" id="dateFlaggedEnd" name="dateFlaggedEnd"> 
                </div>

                <div id="filterControls">
                    <input type="submit" value="Apply Filters">
                    <button type="button" onclick="resetFilters()">Reset Filter</button>
                </div>
            </form>
            <div class="back">
                <button onclick="goToFunctionalityOfficial()">Back</button>
            </div>
        </div>


        <div id="result">
            <script>
            
            function goPoiDetail(thePoi){
                localStorage.setItem("ourPoi",thePoi);
                window.location.assign("PoiDetail.php");
            }
            </script>
            
            <script src="js/sorttable.js"></script>
            <table class="sortable">
                <tr>
                    <th>Location Name</th>
                    <th>State</th>
                    <th>City</th>
                    <th>Zip code</th>
                    <th>Flagged</th>
                    <th>Date Flagged</th>
                </tr>
            
            
            
        
            <?php
            

            
            if (count($_POST) != 0){
                
                
                /**echo $_POST['isFlagged'];
                echo gettype($_POST['isFlagged']);
                if($_POST['isFlagged'] == 'isFlagged'){
                    echo "FRICKIN GOSH DARM!!!";
                }**/
                
                if($_POST['isFlagged'] == 'isFlagged'){
                    $theQuery = "SELECT locationName, city, state, zipcode, flagged, dateFlagged FROM Poi 
                     WHERE locationName = '".$_POST['poiNameSelect']."' AND
                    city = '".$_POST['citySelect']."' AND
                    state = '".$_POST['stateSelect']."' AND
                    zipcode = '".$_POST['zipCode']."' AND
                    flagged = '1' AND
                    dateFlagged BETWEEN '".$_POST['dateFlaggedStart']."' AND '".$_POST['dateFlaggedEnd']."'";
                }
                
                if($_POST['isFlagged'] != 'isFlagged'){
                    $theQuery = "SELECT locationName, city, state, zipcode, flagged, dateFlagged FROM Poi 
                    WHERE locationName = '".$_POST['poiNameSelect']."' AND
                    city = '".$_POST['citySelect']."' AND
                    state = '".$_POST['stateSelect']."' AND
                    zipcode = '".$_POST['zipCode']."' AND
                    flagged = '0'";
                }
                
                echo $theQuery;
                $theResponse = mysql_query($theQuery);
                while ($row = mysql_fetch_assoc($theResponse)) {
                    if($row['flagged'] == 0){
                        $row['flagged'] = 'no';
                        $row['dateFlagged'] = 'N/A';
                    }
                    echo "<tr><td><button onclick=\"goPoiDetail('".$row['locationName']."')\">".$row['locationName']."</button></td><td>".$row['state']."</td><td>".$row['city']."</td><td>".$row['zipcode']."</td><td>".$row['flagged']."</td><td>".$row['dateFlagged']."</td></tr>";
                    
                }
                
                
                
                
                
            }
            
            
            
            ?>
            </table>
        </div>
        
    </div>
    
    
</html>