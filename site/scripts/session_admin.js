
var result;
var count;



function ajax_mail_unmatch()
{
	var xhttp =  new XMLHttpRequest();

	xhttp.onreadystatechange = function() {
		if(this.readyState ==4 && this.status ==200){
			console.log(this.responseText);
			var result = this.responseText.replace(/\n/g, "");
			result = this.responseText;
			if (result != "FAIL"){
				alert("Un e-mail a été envoyé à tous les étudiants sans match");
			}else{
				alert("Un problème est survenue, veuillez réessayer plus tard ou contacter le support");
			}
		}
	}
	xhttp.open("GET", "../controller/unmatch_mail.php");
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send();

	return false;
}


function ajax_mail_summary_couples()
{
	var xhttp =  new XMLHttpRequest();

	xhttp.onreadystatechange = function() {
		if(this.readyState ==4 && this.status ==200){
			console.log(this.responseText);
			result = this.responseText;
			alert("Un e-mail a été envoyé à tous les étudiants");
		}
	}
	xhttp.open("GET", "../controller/couples_mail.php");
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send();

	return false;
}


function ajax_random_match(){

	var xhttp =  new XMLHttpRequest();

	xhttp.onreadystatechange = function() {
		if(this.readyState ==4 && this.status ==200){
			console.log(this.responseText);
			result = this.responseText;
			if (result == "FIN"){
			alert("Les etudiants ont été mis ensemble de façon aléatoire !");
		}
		}
	}

	xhttp.open("GET", "../controller/random_match.php");
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send();

	return false;
}

function setfilename(){
	var thefile = document.getElementById('file');
	var label = document.getElementById('label_input');
	var name='';
	console.log(name);
	for(var i = thefile.value.length; i >= 0; i--){
		if (thefile.value[i]=="\\"){
			break;
		}
		if(name === "undefined") name = thefile.value[i];
		else name = name + thefile.value[i];
	}
	console.log(name);
	name = name.reverse();
	label.innerHTML = name;
}
function setfilename2(){
	var thefile = document.getElementById('file2');
	var label1 = document.getElementById('label_input2');
	var name='';
	console.log(name);
	for(var i = thefile.value.length; i >= 0; i--){
		if (thefile.value[i]=="\\"){
			break;
		}
		if(name === "undefined") name = thefile.value[i];
		else name = name + thefile.value[i];
	}
	console.log(name);
	name = name.reverse();
	label1.innerHTML = name;
}
String.prototype.reverse=function ()
{
        var n   =  '';
        for( var i=this.length-1; i >= 0; i--)
                n       +=     this.charAt(i);
        return n;
}

document.getElementById('file').addEventListener('change', checkFile);
document.getElementById('file2').addEventListener('change', checkFile);
function checkFile(){
	if ((document.getElementById("file").files.length === 0) || (document.getElementById("file2").files.length === 0))
		document.getElementById("list_submit1").style.display = 'none';
	else
		document.getElementById("list_submit1").style.display = 'block';
}
/*function count_file(){
	var x = document.getElementById("file").files.length;
	var y = document.getElementById("file2").files.length;
	if ((document.getElementById("file").files.length === 0) || (document.getElementById("file2").files.length === 0)){
		alert("Vous n'avez pas rentré suffisament de fichier");
		exit(0);
		return false;
	}
	else
		alert("fucking work");
		return true;
}*/
