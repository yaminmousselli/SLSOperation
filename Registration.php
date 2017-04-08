<html>

<center><h1>New User Registration</h1></center>

<form action='' method='post'>
    Username: <input type='text' name="username" required> <br>
    Email Address: <input type='email' name='email' required> <br>
    Password: <input type='password' id='pass' name='password' required> <br>
    Confirm Password: <input type='password' id='passConf' onchange="validatePass()" name='passwordConfirm' required> <br>
    
    <script>
    
    var pass = document.getElementById("pass");
    var confPass = document.getElementById('passConf');
    
    function validatePass(){

        if(pass.value != confPass.value){
            confPass.setCustomValidity("Passwords donut match");
        }
        else{
            confPass.setCustomValidity('');
        }
    }
    

    </script>
    
    User Type:
    <select name="userType" id="usrType" onchange="showOrHide()" required>
        <option>City Scientist</option>
        <option>City Official</option>
    </select><br>
    State: <select name="officialState" id='offStateSelect'>
        <?php
        
        $conn = mysqli_connect("localhost","compuser","yeahsure");
        mysqli_select_db("4400DatabaseProject",$conn);
        echo mysqli_error();

        if (!$conn) {
            echo "Unable to connect to DB: " . mysqli_error();
            exit;
        }

        
        $theQuery = "SELECT state FROM CityState";
        $theResponse = mysqli_query($theQuery);

        while($row = mysqli_fetch_assoc($theResponse)) {
            echo "<option>".$row["state"]."</option>";
        }
        ?>
        
    </select><br>
    City: <select name="officialCity" id="offCitySelect">
        <?php
        
        $conn = mysqli_connect("localhost","compuser","yeahsure");
        mysqli_select_db("4400DatabaseProject",$conn);
        echo mysqli_error();

        if (!$conn) {
            echo "Unable to connect to DB: " . mysqli_error();
            exit;
        }

        
        $theQuery = "SELECT city FROM CityState";
        $theResponse = mysqli_query($theQuery);

        while($row = mysqli_fetch_assoc($theResponse)) {
            echo "<option>".$row["city"]."</option>";
        }
        ?>
        
    </select>
    
    
    <br><input type=submit value="Submit">
    
    
    <script>
    document.write("lmao");
    
    var useType = document.getElementById('usrType');
    
    function showOrHide(){
        if(useType.value == "City Official"){
            document.getElementById("offStateSelect").style.display = "none";
            document.getElementById("offCitySelect").style.display = "none";
        }
        
        if(useType.value == "City Scientist"){
            document.getElementById("offStateSelect").style.display = "block";
            document.getElementById("offCitySelect").style.display="block";
        }
    }
    

    </script>

    </form>















</html>