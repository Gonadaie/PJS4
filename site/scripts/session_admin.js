var result;
function ajax_mail_unmatch()
{
	var xhttp =  new XMLHttpRequest();
	
	xhttp.onreadystatechange = function() {
		if(this.readyState ==4 && this.status ==200){
			result = this.responseText;
			if (parseInt(result) == 0){
				alert("SUCCESS");
			}else{
				alert(result);
			}
		}
	}
	xhttp.open("GET", "../controller/mail_function_back.php");
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send();
	
	return false;
}


		