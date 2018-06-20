const my_list = document.querySelector('.preview_list')
const message_previews = document.querySelectorAll('.preview_message')
const messaging_welcome_pic = document.querySelector('.messaging_welcome_pic')
const finalBtnOff = document.querySelector('.conversation_final_btn_off')
const finalBtnOn = document.querySelector('.conversation_final_btn_on')
const conversation_messages = document.querySelector('.conversation_messages')
var send_messages_textbox = document.getElementById("send_messages_textbox");

send_messages_textbox.addEventListener("keydown", function (e) {
		console.log("keydownnnnnnnnn")
    if (e.keyCode === 13) {
        checkMessage(e);
    }
});

function checkMessage(e){
	console.log("we are checking your awesome message")
	if(send_messages_textbox.value==null || send_messages_textbox.value=="" || send_messages_textbox.value==" " || !send_messages_textbox.replace(/\s/g, '').length){
		alert("That's bad");
	}
	else{
		alert("Good boy");
	}

}

my_list.style.height = window.innerHeight - my_list.offsetTop + "px";

window.addEventListener('resize', () => {
	my_list.style.height = window.innerHeight - my_list.offsetTop + "px";
})

for (let i = 0; i < message_previews.length; i++) {
	message_previews[i].addEventListener('click', () => {
		fetch_messages(message_previews[i].dataset.student)
		messaging_welcome_pic.style.display = 'none'
		var messaging_conversation = document.querySelector('.messaging_conversation')
		messaging_conversation.style.display = 'block'
		var conversation_surname = document.querySelector('.conversation_surname')
		conversation_surname.innerHTML = message_previews[i].dataset.surname;

		conversation_messages.scrollTo(0, 1000000)

	})
}

const fetch_messages = (other_student_id) => {
	console.log("we are in get message fct");
	var xhttp = new XMLHttpRequest();


	xhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			var response = new Array();
			var response = JSON.parse(this.responseText);
			console.log(response)
			add_messages(response, other_student_id)
		}

	}
	xhttp.open("POST", "../controller/get_old_messages.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("other_student_id=" + other_student_id);

	console.log("end");
	return false;
}


finalBtnOff.addEventListener('click', () => {
	finalBtnOff.style.display = 'none'
	var finalBtnOn = document.querySelector('.conversation_final_btn_on')
	finalBtnOn.style.display = 'block'
})
finalBtnOn.addEventListener('click', () => {
	finalBtnOn.style.display = 'none'
	var finalBtnOff = document.querySelector('.conversation_final_btn_off')
	finalBtnOff.style.display = 'block'
})

const add_messages = (messages, other_student_id) => {
	const conversation_messages = document.querySelector('.conversation_messages')
	for (let i = 0; i < messages.length; i++) {
		let div_message = document.createElement("div")
		console.log(messages[i].sender_id)
		console.log(messages[i])
		if (messages[i].sender_id == other_student_id) {
			div_message.setAttribute('class', 'message_conversation_other_student')
		} else {
			div_message.setAttribute('class', 'message_conversation_student')
		}
		conversation_messages.insertBefore(div_message, conversation_messages.childNodes[0])
		div_message.innerHTML = messages[i].content
	}
}
