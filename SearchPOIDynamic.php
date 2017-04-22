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
                <h3>Search POIs</h3>
            </div>

            <form method="post">
                <div class="viewEntry">
                    <label for="poiNameSelect">POI Location Name</label>
                    <select id="poiNameSelect" name="poiNameSelect">
                    <option>Any</option>
                    <?php
                    $theQuery = "SELECT locationName FROM Poi";
                    $theResponse = mysql_query($theQuery);
                    while($row = mysql_fetch_assoc($theResponse)) {
                        echo "<option>" . $row["locationName"] . "</option>";
                    }
                    ?>
                    </select>
                </div>

                <div class="viewEntry">
                    <label for="citySelect">City</label>
                    <select id="citySelect" name="citySelect">
                    <option>Any</option>
                    <?php
                    $theQuery = "SELECT city FROM CityState";
                    $theResponse = mysql_query($theQuery);
                    while ($row = mysql_fetch_assoc($theResponse)) {
                        echo "<option>" . $row["city"] . "</option>";
                    }
                    ?>
                    </select>
                </div>

                <div class="viewEntry">
                    <label for="stateSelect">State</label>
                    <select id="stateSelect" name="stateSelect">
                    <option>Any</option>
                    <?php
                        $theQuery = "SELECT DISTINCT state FROM CityState";
                        $theResponse = mysql_query($theQuery);
                        while ($row = mysql_fetch_assoc($theResponse)) {
                            echo "<option>" . $row["state"] . "</option>";
                        }
                    ?>
                    </select>
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
                    <input type="date" id="dateFlaggedStart" name="dateFlaggedStart">
                    <p>to</p>
                    <input type="date" id="dateFlaggedEnd" name="dateFlaggedEnd"> 
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
            <table class="sortable" border = "1">
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
                $poiQuery = "SELECT locationName, city, state, zipcode, flagged, dateFlagged FROM Poi WHERE ";
                if($_POST['poiNameSelect'] != 'Any'){
                    $poiQuery .= "locationName = '" . $_POST['poiNameSelect'] . "' AND ";
                }
                
                if($_POST['citySelect'] != 'Any'){
                    $poiQuery .= "city = '" . $_POST['citySelect'] . "' AND ";
                }

                if($_POST['stateSelect'] != 'Any'){
                    $poiQuery .= "state = '" . $_POST['stateSelect'] . "' AND ";
                }

                if($_POST['zipCode'] != ''){
                    $poiQuery .= "zipcode = '" . $_POST['zipCode'] . "' AND ";
                }

                if($_POST['isFlagged'] != 'isFlagged'){
                    $poiQuery .= "flagged = '0' AND ";
                }

                if($_POST['isFlagged'] == 'isFlagged'){
                    $poiQuery .= "flagged = '1' AND ";
                }

                if($_POST['dateFlaggedStart'] != ''){
                    $poiQuery .= "dateFlagged >= '" . $_POST['dateFlaggedStart'] . "' AND ";
                }

                if($_POST['dateFlaggedEnd'] != ''){
                    $poiQuery .= "dateFlagged <= '" . $_POST['dateFlaggedEnd'] . "' AND ";
                }

                // If there is a trailng AND, get rid of it
                $lastAndIndex = strrpos($poiQuery, "AND ");
                if ($lastAndIndex !== FALSE) {
                    $poiQuery = substr($poiQuery, 0, $lastAndIndex);
                }

                $pois = mysql_query($poiQuery);
                while ($poi = mysql_fetch_assoc($pois)) {
                    // Edit output of table
                    if($poi['flagged'] == 0) {
                        $poi['flagged'] = 'no';
                        $poi['dateFlagged'] = 'N/A';
                    } else {
                        $poi['flagged'] = "yes";
                    }

                    // Build table row
                    $tableRow = "<tr>";
                    $tableRow .= "<td><button onclick=\"goPoiDetail('".$poi['locationName']."')\">".$poi['locationName']."</button></td>";
                    $tableRow .= "<td>" . $poi['state'] . "</td>";
                    $tableRow .= "<td>" . $poi['city'] . "</td>";
                    $tableRow .= "<td>" . $poi['zipcode'] . "</td>";
                    $tableRow .= "<td>" . $poi['flagged'] . "</td>";
                    $tableRow .= "<td>" . $poi['dateFlagged'] . "</td>";
                    $tableRow .= "</tr>";   
                    echo $tableRow;
                }
            }
            ?>
            </table>
        </div>
    </div>
</html>