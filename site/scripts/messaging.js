const my_list = document.querySelector('.preview_list');
const message_previews = document.querySelectorAll('.preview_message')

my_list.style.height = window.innerHeight - my_list.offsetTop + "px";

window.addEventListener('resize', () => {
	my_list.style.height = window.innerHeight - my_list.offsetTop + "px";
})

for (let i = 0; i < message_previews.length; i++) {
	message_previews[i].addEventListener('click', () => {
		fetch_messages(message_previews[i].dataset.student)
	})
}

const fetch_messages = (other_student_id) => {
	console.log("we are in get message fct");
	var xhttp = new XMLHttpRequest();


	xhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			var response = this.responseText.replace(/\n/g, "");
			console.log(this.responseText);
		}

	}
	xhttp.open("POST", "../controller/get_old_messages.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("other_student_id=" + other_student_id);

	console.log("end");
	return false;
}
