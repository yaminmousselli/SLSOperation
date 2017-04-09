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
            
            
            <div class="viewEntry">
                <label for="poiNameSelect">POI Location Name</label>
                <select id="poiNameSelect" name="poiNameSelect"></select>
            </div>

            <div class="viewEntry">
                <label for="citySelect">City</label>
                <select id="citySelect" id="citySelect"></select>
            </div>

            <div class="viewEntry">
                <label for="stateSelect">State</label>
                <select id="stateSelect"></select>
            </div>

            <div class="viewEntry">
                <label for="zipSelect">Zip Code</label>
                <input type="text" name="zipCode">
            </div>

            <div class="viewEntry">
                <label for="poiNameSelect">Flagged?</label>
            </div>

            <div class="viewEntry">
                <label for="poiNameSelect">Date Flagged</label>
            </div>
        </div>

        <div class="logout">
            <button onclick="goToLogin()">Log out</button>
        </div>
    </div>
    
    
</html>