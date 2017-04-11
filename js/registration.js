function goToLogin() {
  window.location.assign("index.html");
}

var useType = document.getElementById('usrType');

function showOrHide(){
    if (useType.value == "City Official") {
        document.getElementById("offStateSelect").style.display = "none";
        document.getElementById("offCitySelect").style.display = "none";
    }
    if(useType.value == "City Scientist") {
        document.getElementById("offStateSelect").style.display = "block";
        document.getElementById("offCitySelect").style.display="block";
    }
}

var pass = document.getElementById("pass");
var confPass = document.getElementById('passConf');

function validatePass() {
  if (pass.value != confPass.value){
      confPass.setCustomValidity("Passwords donut match");
  } else {
    confPass.setCustomValidity('');
  }
}