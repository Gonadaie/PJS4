var result;
function ajax_mail_unmatch()
{
	var xhttp =  new XMLHttpRequest();
	
	xhttp.onreadystatechange = function() {
		if(this.readyState ==4 && this.status ==200){
			console.log(this.responseText);
			result = this.responseText;
			if (parseInt(result) == 0){
				console.log("Here i am");
				alert("SUCCESS");
			}else{
				console.log("Not supposed to be here")
				alert(result);
			}
		}
	}
	xhttp.open("GET", "../controller/mail_function_back.php");
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send();
	
	return false;
}


		