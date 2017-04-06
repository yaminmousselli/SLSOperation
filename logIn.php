<!DOCTYPE html>
<html>
<body>


test
<?php

//echo "trying<br>";

$conn = mysql_connect("localhost","compuser","yeahsure");
mysql_select_db("4400DatabaseProject",$conn);
echo "line 13".mysql_error();

if (!$conn) {
    echo "Unable to connect to DB: " . mysql_error();
    exit;
}
echo "why";
//$theQuery = "SELECT * FROM User WHERE username ='".$_POST['username']."' AND password = '".$POST_['password']."'";

$theQuery = "SELECT * FROM `User`";

//echo "this is the query: ".$theQuery."<br>";'''

$checkEmpty = mysql_query($theQuery);
echo "heres ur error at checkempty<br><br>";
echo mysql_error();

echo $checkEmpty;

//echo "<br>the query returned: ".$checkEmpty."<br>";

$login = false;
echo "here comes the while loop<br>";
while($row = mysql_fetch_assoc($checkEmpty)) {

    echo $row["username"];
    echo $row["password"];
    echo $_POST["username"];
    echo $_POST["password"];
    //echo "tried while<br>";
    if($row["username"] == $_POST["username"]){
        if($row["password"] == $_POST["password"]){
            $login = true;
            echo "login is true";
        }
    }
}

if($login){
    redirect_to("twitter.com/briceedelman");
    
}

if(!$login){
    echo "wow you suck";
    
}
//echo "tried";

?>
</body>
</html>
