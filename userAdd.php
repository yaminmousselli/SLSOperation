
<script>
function userTaken(){
    localStorage.setItem("didItFail","That username is already taken!");
    window.location.assign("Registration.php");
}
function emailTaken(){
    localStorage.setItem("didItFail","That email is already in use!");
    window.location.assign("Registration.php");
}
function passwordMismatch() {
  localStorage.setItem("didItFail","Passwords Do Not Match");
  window.location.assign("Registration.php");
}
function success(){
    window.location.assign("index.html")
}
</script>


<?php


    include "dbConn.php";

    $theQuery = "SELECT * FROM User WHERE username='".$_POST['username']."' OR email = '".$_POST['email']."'";
    $theResponse = mysql_query($theQuery);

    $fail = false;
    while ($row = mysql_fetch_assoc($theResponse)) {
        if($row['username'] == $_POST['username']){
            echo "<script>userTaken();</script>";
            $fail = true;
        }
        if($row['email'] == $_POST['email']){
            echo "<script>emailTaken();</script>";
            $fail = true;
        }
        if($_POST['password'] != $_POST['passwordConfirm']) {
            echo "<script>passwordMismatch();</script>";
            $fail = true;
        }
    }

    if($_POST['userType'] == 'City Scientist'){
        $type = 'cityScientist';

    }
    if($_POST['userType'] == 'City Official'){
        $type = 'cityOfficial';
    }

    
    if($_POST['password'] == $_POST['passwordConfirm']) {

        if(!$fail){
            $theQuery = "INSERT INTO User(username, email, password, userType) VALUES (LCASE('".$_POST['username']."'),'".$_POST['email']."','".$_POST['password']."','".$type."')";
            $theResponse = mysql_query($theQuery);
            echo mysql_error();
            if($type =='cityOfficial'){
                $theQuery = "INSERT INTO CityOfficial(username, title, city, state) VALUES ('".$_POST['username']."','".$_POST['title']."','".$_POST['officialCity']."','".$_POST['officialState']."')";
                $theResponse = mysql_query($theQuery);
                echo mysql_error();
            }

            if(!$theResponse){
                echo "catastrophic failure gg no re";
            }
            if($theResponse){
                echo "<script>success();</script>";
            }
        }
    } else {
        echo "<script>passwordMismatch();</script>";
        $fail = true;
    }

?>
