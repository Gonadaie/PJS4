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
