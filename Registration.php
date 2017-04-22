<!DOCTYPE html>
<html>
    <head>
      <link rel="stylesheet" type="text/css" href="css/main.css">
      <link rel="stylesheet" type="text/css" href="css/registration.css">
      <script type="text/javascript" src="js/registration.js"></script>
    </head>
    <?php include "dbConn.php"; ?>

    <header>Operation SLS</header>

    <div id="container">
        <div id="mainContent">
            <div>
                <h2>Registration</h2>
            </div>
            <h1 id="errorMsg"></h1>
            <form action="userAdd.php" method="post"> <!-- index.html might change-->
                <div class="registrationFormEntry">
                    <label>Username</label>
                    <input type="text" name="username" id="username" required>

                </div>

                <div class="registrationFormEntry">
                  <label>Email</label>
                  <input type="email" name="email" id="email" required>
                </div>

                <div class="registrationFormEntry">
                    <label>Password</label>
                    <input type="password" name="password" id="pass" required>
                </div>

                <div class="registrationFormEntry">
                    <label>Confirm Password</label>
                    <input type="password" id="passConf" onchange="validatePass()"
                        name="passwordConfrim" required> <br>
                </div>

      <script>

      </script>

      <div class="labelWidth">
        <div class="labelWidth"
            <label>User Type:</label>
            <select name="userType" id="userType" onchange="showOrHide()" required>
              <option>City Scientist</option>
              <option>City Official</option>
            </select><br>
        </div>
        <Label> Fill out title, city, and state if you choose city officials

        </label>
        <div class="labelWidth"
            <label> Title:</label>
            <input type="text" name="title">
        </div>

        <div class="labelWidth"
            <label>State:</label>
            <select name="officialState" id='offStateSelect'>
              <?php

              $theQuery = "SELECT DISTINCT state FROM CityState";
              $theResponse = mysql_query($theQuery);

              while ($row = mysql_fetch_assoc($theResponse)) {
                  echo "<option>".$row["state"]."</option>";
              }
              ?>

            </select><br>
        </div>
        <div class="labelWidth"
            <label>City:</label>
            <select name="officialCity" id="offCitySelect">
        </div>
  </div>
  <?php

    $theQuery = "SELECT city FROM CityState";
    $theResponse = mysql_query($theQuery);

    while ($row = mysql_fetch_assoc($theResponse)) {
        echo "<option>".$row["city"]."</option>";
    }
  ?>
  </select>

  <br><input type=submit value="Submit" id="btnSubmit">

  <button onclick=goToLogin() id="btnCancel"> Cancel </button>

  <script>
    document.getElementById('errorMsg').innerHTML = localStorage.getItem("didItFail");
    localStorage.setItem("didItFail","");
  </script>
 </form>

</html>
