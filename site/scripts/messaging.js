const my_list = document.querySelector('.preview_list')
const message_previews = document.querySelectorAll('.preview_message')
const messaging_welcome_pic = document.querySelector('.messaging_welcome_pic')
const finalBtnOff = document.querySelector('.conversation_final_btn_off')
const finalBtnOn = document.querySelector('.conversation_final_btn_on')
const conversation_messages = document.querySelector('.conversation_messages')
var send_messages_textbox = document.getElementById("send_messages_textbox");
var id_receiver;
var socket;
var nb_msg = 0;


createSocket();

send_messages_textbox.addEventListener("keydown", function (e) {
		if (e.keyCode === 13) {
		checkMessage(e);
		}
		});

function checkMessage(e){
	if(send_messages_textbox.value==null || send_messages_textbox.value=="" || send_messages_textbox.value==" " || !send_messages_textbox.value.replace(/\s/g, '').length){
	}
	else{
		var msg_data = [id_sender, id_receiver, send_messages_textbox.value];
		try{
			display_send_message(msg_data[2]);
		}catch(error){
			console.log(error);
		}

		sendMessage(JSON.stringify(msg_data));
	}
}
/***************************Socket stuff for message*********************/


function sendMessage(msg){
	socket.emit('message', msg);
}

function createSocket(){
	socket = io.connect('https://skipti.fr:8080');
	socket.on('message', function(message) {
		var jsonMSG = JSON.parse(message);
		if(jsonMSG[0] == id_receiver){
    	display_received_message(jsonMSG[2]);
	}
	})
}

/**************************End of socket stuff**************************/


my_list.style.height = window.innerHeight - my_list.offsetTop + "px";

window.addEventListener('resize', () => {
		my_list.style.height = window.innerHeight - my_list.offsetTop + "px";
		})

for (let i = 0; i < message_previews.length; i++) {
	message_previews[i].addEventListener('click', () => {
		fetch_messages(message_previews[i].dataset.student);
		messaging_welcome_pic.style.display = 'none';
		var messaging_conversation = document.querySelector('.messaging_conversation');
		messaging_conversation.style.display = 'block';
		var conversation_surname = document.querySelector('.conversation_surname');
		conversation_surname.innerHTML = message_previews[i].dataset.surname;
		//conversation_surname.dataset.
		//document.getElementById('item1').dataset.icon = "base.gif";
		conversation_messages.scrollTo(0, 1000000);
	})
}

const fetch_messages = (other_student_id) => {
	console.log("we are in get message fct");
	var xhttp = new XMLHttpRequest();
	id_receiver = other_student_id;

	xhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			var response = new Array();
			var response = JSON.parse(this.responseText);
			console.log(response);
			add_messages(response, other_student_id);
		}
	}
	xhttp.open("POST", "../controller/get_old_messages.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("other_student_id=" + other_student_id);

	console.log("end");
	return false;
}


finalBtnOff.addEventListener('click', () => {
	if (confirm("Êtes-vous sûr de vouloir choisir cette personne comme parrain/filleul?")){

	finalBtnOff.style.display = 'none';
	var finalBtnOn = document.querySelector('.conversation_final_btn_on');
	finalBtnOn.style.display = 'block';

	var xhttp = new XMLHttpRequest();


	xhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
		}

	}
	xhttp.open("POST", "../controller/find-the-right-one.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("other_student_id=" + other_student_id);

	}
})

const display_received_message = (messages) => {

	const conversation_messages = document.querySelector('.conversation_messages');
	let div_message = document.createElement("div");
	div_message.setAttribute('class', 'message_conversation_other_student');
	conversation_messages.insertBefore(div_message, conversation_messages.childNodes[nb_msg].nextSibling);
	div_message.innerHTML = messages;
	nb_msg++;
	conversation_messages.scrollTo(0, 1000000);
}


const display_send_message = (messages) => {

	const conversation_messages = document.querySelector('.conversation_messages');
	let div_message = document.createElement("div");
	div_message.setAttribute('class', 'message_conversation_student');
	conversation_messages.insertBefore(div_message, conversation_messages.childNodes[nb_msg].nextSibling);
	div_message.innerHTML = messages;
	nb_msg++;
	send_messages_textbox.value = "";
	conversation_messages.scrollTo(0, 1000000);
}




const add_messages = (messages, other_student_id) => {
	const conversation_messages = document.querySelector('.conversation_messages');
	nb_msg = messages.length;
	for (let i = 0; i < messages.length; i++) {
		let div_message = document.createElement("div");
		console.log(messages[i].sender_id);
		console.log(messages[i]);
		if (messages[i].sender_id == other_student_id) {
			div_message.setAttribute('class', 'message_conversation_other_student');
		} else {
			div_message.setAttribute('class', 'message_conversation_student');
		}
		conversation_messages.insertBefore(div_message, conversation_messages.childNodes[0]);
		div_message.innerHTML = messages[i].content;
	}
}
