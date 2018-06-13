var result;
function ajax_mail_unmatch()
{
	var xhttp =  new XMLHttpRequest();
	
	xhttp.onreadystatechange = function() {
		if(this.readyState ==4 && this.status ==200){
			console.log(this.responseText);
			result = this.responseText;
			if (result != "FAIL"){
				alert("Un e-mail a été envoyé à tous les étudiants sans match");
			}else{
				alert("Un problème est survenue, veuillez réessayer plus tard ou contacter le support");
			}
		}
	}
	xhttp.open("GET", "../controller/mail_function_back.php");
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send();
	
	return false;
}


		