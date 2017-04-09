<html>

    <head>
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/search_poi.css">

    <script type="text/javascript" src="js/search_poi.js"></script>
    </head>
    
    <header>Operation SLS</header>
    
    <div id="container">
        
        <div id="mainContent">
            <div>
                <h3>View POIs</h3>
            </div>
            
            <form action="SearchPOI.php" method="post">  
                <div class="viewEntry">
                    <label for="poiNameSelect">POI Location Name</label>
                    <select id="poiNameSelect" name="poiNameSelect"></select>
                </div>

                <div class="viewEntry">
                    <label for="citySelect">City</label>
                    <select id="citySelect" name="citySelect"></select>
                </div>

                <div class="viewEntry">
                    <label for="stateSelect">State</label>
                    <select id="stateSelect" name="stateSelect"></select>
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
                    <input type="date" id="dateFlaggedStart" name="dateFlagedStart"> <p>to</p> <input type="date" id="dateFlagedEnd" name="dateFlagedEnd"> 
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


    </div>
    
    
</html>