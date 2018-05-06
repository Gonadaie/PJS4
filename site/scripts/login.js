const MAX_TRIES = 5;
var tries = 0;

function login() {
	var xhttp = new XMLHttpRequest();
	console.log("we are in login.js");

	xhttp.onreadystatechange = function(){
		if(this.readyState == 4 && this.status == 200){
			if(JSON.parse(this.responseText) == "OK"){
				highlight(document.getElementsByName("mail")[0], false);
				highlight(document.getElementsByName("password")[0], false);
				window.location.href="../view/swipe.php";

			} else if(JSON.parse(this.responseText) == "FIRST"){
				highlight(document.getElementsByName("mail")[0], false);
				highlight(document.getElementsByName("password")[0], false);
				window.location.href="../view/test.php";
			}
			else {
				highlight(document.getElementsByName("mail")[0], true);
				highlight(document.getElementsByName("password")[0], true);
				++tries;
			}
			if(tries >= MAX_TRIES)
				window.location.href = "../view/forgot_passwd.html";
		}
	};

	xhttp.open("POST", "../controller/login.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

	var mail = document.getElementsByName("mail")[0].value;
	var password = document.getElementsByName("password")[0].value;
	var stayConnected = document.getElementById('keeplog').value;

	xhttp.send("mail=" + mail + "&password=" + password + "&stayConnected=" + stayConnected);
	return false;
}
