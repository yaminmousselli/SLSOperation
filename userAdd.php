
<script>
function userTaken(){
    localStorage.setItem("didItFail","That username is already taken!");
    window.location.assign("Registration.php");
}
function emailTaken(){
    localStorage.setItem("didItFail","That email is already in use!");
    window.location.assign("Registration.php");
}
function success(){
    window.location.assign("index.html")
}
</script>


<?php
  
  
    $conn = mysql_connect("localhost","compuser","yeahsure");
    mysql_select_db("4400DatabaseProject",$conn);
    echo mysql_error();

    if (!$conn) {
        echo "Unable to connect to DB: " . mysql_error();
        exit;
    }

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
    }
  
    if(!$fail){
        $theQuery = "SELECT * FROM User WHERE username='".$_POST['username']."' OR email = '".$_POST['email']."'";
        $theResponse = mysql_query($theQuery);
        
        if(!$theResponse){
            echo "catastrophic failure gg no re";
        }
        if($theResponse){
            echo "<script>success();</script>";
        }
    }
  
?>