const MAX_TRIES = 5;
var tries = 0;
var d = new Date();
function login() {
	var xhttp = new XMLHttpRequest();
	console.log("we are in login.js");

	xhttp.onreadystatechange = function(){
		if(this.readyState == 4 && this.status == 200){
			var response = this.responseText.replace(/\n/g, "");
			console.log(response);
			if(response == "OK"){
				highlight(document.getElementsByName("mail")[0], false);
				highlight(document.getElementsByName("password")[0], false);
				window.location.href="../view/swipe.php";
			} else if(response == "FIRST"){
				highlight(document.getElementsByName("mail")[0], false);
				highlight(document.getElementsByName("password")[0], false);
				window.location.href="../view/test.php";
			}
			else if(response == "ADMIN"){
				console.log("admin");
				highlight(document.getElementsByName("mail")[0], false);
				highlight(document.getElementsByName("password")[0], false);
				window.location.href="../view/session_admin.php";
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
	var keeplog = document.getElementById('keeplog').value;
	var f = new Date();
	var time = f.getTime() - d.getTime();
	console.log(time);
	if(time >= 10000){ 
		xhttp.send("mail=" + mail + "&password=" + password + "&keeplog=" + keeplog);
	}
	else{
		console.log("goes here");
		alert("Vous avez tenté d'envoyer le formulaire trop souvent, attendez puis réessayer");
		return false;
	}
	return false;
}
