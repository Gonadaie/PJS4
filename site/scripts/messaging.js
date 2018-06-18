const my_list = document.querySelector('.preview_list');
const message_previews = document.querySelectorAll('.preview_message')

my_list.style.height = window.innerHeight - my_list.offsetTop + "px";

window.addEventListener('resize', () => {
	my_list.style.height = window.innerHeight - my_list.offsetTop + "px";
})

for (let i = 0; i < message_previews.length; i++) {
	message_previews[i].addEventListener('click', () => {
		console.log(message_previews[i].dataset.student)
	})
}

/*const fetch_messages = (other_student_id, ) => {
	if (str == "") {
		document.getElementById("txtHint").innerHTML = "";
		return;
	}
	if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp = new XMLHttpRequest();
	} else { // code for IE6, IE5
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("txtHint").innerHTML = this.responseText;
		}
	}
	xmlhttp.open("GET", "getuser.php?q=" + str, true);
	xmlhttp.send();
}*/
