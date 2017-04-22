<?php
include "dbConn.php";

// Find the user that tried to login
$usernameEntered = $_POST["username"];
$passwordEntered = $_POST["password"];

$usersBasic = "SELECT username, password, userType FROM User WHERE username = '$usernameEntered' AND password = '$passwordEntered'";
$users = mysql_query($usersBasic);

if ($user = mysql_fetch_assoc($users)) {
    // If the user exists, go to the correct landing page

    $type = $user["userType"];

    if ($type == "cityScientist") {
        header("location:AddDataPoint.php");
    }

    if ($type == "cityOfficial") {
        // If an official is not approved, don't permit log in
        $officialApproved = "SELECT isApproved FROM CityOfficial WHERE username = '$usernameEntered'";
        $officials = mysql_query($officialApproved);
        $official = mysql_fetch_assoc($officials);

        if ($official["isApproved"] === NULL) {
            // Value is NULL, admin hasn't set it yet
            echo "City official not yet approved. Return to log in?";
        } else if (!$official["isApproved"]) {
            // Value is not NULL, but is falsy
            echo "City official was rejected. Sorry. Return to log in?";
        } else {
            // Value is Truthy
            header("location:ChooseFunctionalityOfficial.html");
        }
    }

    if ($type == "admin") {
        header("location:ChooseFunctionalityAdmin.html");
    }
} else {
    echo "Login failed. Try again?";
}
echo '<form action="index.html"><input type="submit" value="Back" /></form>';
?>