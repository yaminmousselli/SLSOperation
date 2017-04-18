<!DOCTYPE html>
<html>
<body>

<script>
function goCityScientist() {
    window.location.assign("AddDataPoint.php")
}

function goAdmin() {
    window.location.assign("ChooseFunctionalityAdmin.html")
}

function goCityOfficial() {
    window.location.assign("ChooseFunctionalityOfficial.html")
}
</script>

<?php

//echo "trying<br>";

include "dbConn.php";

//$theQuery = "SELECT * FROM User WHERE username ='".$_POST['username']."' AND password = '".$POST_['password']."'";

$theQuery = "SELECT * FROM User";

//echo "this is the query: ".$theQuery."<br>";'''

$checkEmpty = mysql_query($theQuery);

echo mysql_error();


//echo "<br>the query returned: ".$checkEmpty."<br>";

$login = false;

while($row = mysql_fetch_assoc($checkEmpty)) {


    //echo "tried while<br>";
    if($row["username"] == strtolower($_POST["username"])) {
        if($row["password"] == $_POST["password"]){
            $login = true;

        }
    }
}

if($login){
    $theResponse = mysql_query("SELECT userType FROM User WHERE username='".$_POST["username"]."'");
    $theirType = mysql_fetch_assoc($theResponse)["userType"];

    if($theirType == "cityScientist") {
        echo "<script>goCityScientist();</script>";
    }

    if($theirType == "cityOfficial") {
        echo "<script>goCityOfficial();</script>";
    }

    if($theirType == "admin") {
        echo "<script>goAdmin();</script>";
    }
}

if(!$login){
    echo "Login failed. Try again?";
    echo '<form action="index.html"><input type="submit" value="Back" /></form>';

}
//echo "tried";

?>
  </body>
</html>
