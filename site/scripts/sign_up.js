var d = new Date();
function sign_up(e) {
	var xhttp = new XMLHttpRequest();
	if(verifForm(e)){
		xhttp.onreadystatechange = function(){
			if(this.readyState == 4 && this.status == 200){
				var response = this.responseText.replace(/\n/g, "");
				console.log(response);
				if(response == "NOK"){
					highlight(document.getElementsByName("mail")[0], true);
					document.getElementById("mail_not_valid").style.display = "none";
					document.getElementById("mail_already_exist").style.display = "block";
				}
				//else if(this.responseText == "OK"){
				else{
					var request = new XMLHttpRequest();
					highlight(document.getElementsByName("mail")[0], false);
					highlight(document.getElementsByName("password")[0], false);
					request.open("POST", "../controller/register-confirmation.php", true);
					request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

					var mail = document.getElementsByName("mail")[0].value;
					var password = document.getElementsByName("password")[0].value;
					var year;
					if (document.getElementById('first').checked) {
						year = 1;
					}
					if(document.getElementById('second').checked) {
						year = 2;
					}
					var f = new Date();
					var time = f.getTime() - d.getTime();
					console.log(time);
					if(time >= 10000){ 
						request.send("&mail=" + mail + "&password=" + password + "&year=" + year);
					}
					else{
						console.log("goes here");
						alert("Vous avez tenté d'envoyer le formulaire trop souvent, attendez puis réessayer");
						return false;
					}
					request.onreadystatechange = function(){
						if(request.readyState == 4){
							window.location.href="../view/register-confirmation.php?mail="+mail;
						}
					}

				}

			}
		};

		xhttp.open("POST", "../controller/student_exists.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

		var mail = document.getElementsByName("mail")[0].value;

		xhttp.send("mail=" + mail);
		return false;
		}
}
