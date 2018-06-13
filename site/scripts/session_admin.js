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

function setfilename(){
	var thefile = document.getElementById('file');
	var label = document.getElementById('label_input');
	var name;
	for(var i = thefile.value.length; i >= 0; i--){
		if (thefile.value[i]=="\\"){
			break;
		}
		name = name + thefile.value[i];
	}
	name = name.reverse();
	label.value = name.toString();
}
String.prototype.reverse=function ()
{
        var n   =  '';
        for( var i=this.length-1; i >= 0; i--)
                n       +=     this.charAt(i);
        return n;
}