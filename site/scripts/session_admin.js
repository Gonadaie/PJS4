var result;
function ajax_mail_unmatch()
{
	var xhttp =  new XMLHttpRequest();
	
	xhttp.onreadystatechange = function() {
		if(this.readyState ==4 && this.status ==200){
			if (this.responseText== "SUCCESS"){
				result = this.responseText;
				alert(result);
			}else{
				alert("FAIL");
			}
		}
	}
	xhttp.open("GET", "../controller/mail_function_back.php");
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send();
	
	return false;
}


		