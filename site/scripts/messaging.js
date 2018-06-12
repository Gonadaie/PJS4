const my_list = document.querySelector('.preview_list');

my_list.style.height = window.innerHeight - my_list.offsetTop + "px";

window.addEventListener('resize', () => {
	my_list.style.height = window.innerHeight - my_list.offsetTop + "px";
})
