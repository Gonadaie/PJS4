const yes = document.querySelector(".yes");
const swipe_profile = document.querySelector(".swipe_profile");
const no = document.querySelector(".no");
var recycled = document.querySelector(".bounceOutLeft");
var hearted = document.querySelector(".bounceOutRight");
const profil_link = document.querySelector("#swipe_picture");
const no_more_profile = document.querySelector(".no_more_profile");
const available_profiles = document.querySelector(".available_profile");
var end_of_swipe = false;


yes.addEventListener("click", () => {
	setTimeout(function () {
		setNewProfile();
	}, 1000);
	swipe_profile.classList.add("bounceOutRight");
	if(!end_of_swipe)
		ajax_liked_someone();
});

no.addEventListener("click", () => {
	setTimeout(function () {
		setNewProfile();
	}, 1000);
	swipe_profile.classList.add("bounceOutLeft");
});

function top_back() {

	swipe_profile.classList.remove("bounceOutRight");
	swipe_profile.classList.remove("bounceOutLeft");
	swipe_profile.classList.add("bounceInDown");
}

function ajax_liked_someone() {
	console.log("we are in liked function");
	var xhttp = new XMLHttpRequest();


	xhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			if (this.responseText == "MATCH") {
				document.location.href = "../view/match.php?email=" + email;
			} else if (this.responseText == "LIKE") {
				return true;
			}



		}
	}
	xhttp.open("POST", "../controller/like_student.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	console.log(email);
	xhttp.send("mail=" + email);

	console.log("end");
	return false;
}


function setNewProfile() {
	if (students.length > 0) {
		available_profiles.style.display = "block";
		no_more_profile.style.display = "none";
		document.getElementById("swipe_name").innerHTML = students[0].surname;
		if (students[0].description != null) //TODO Remove when we'll have a clean DB
			document.getElementById("swipe_description").innerHTML = students[0].description;

		var adjs = students[0].adj1 + " - " + students[0].adj2 + " - " + students[0].adj3;
		document.getElementById("swipe_adj").innerHTML = adjs;

		if (students[0].pic != undefined) document.getElementById("swipe_picture").src = students[0].pic;
		else document.getElementById("swipe_picture").src = '';
		email = students[0].email;
		students.splice(0, 1);
	} else {
		available_profiles.style.display = "none";
		no_more_profile.style.display = "block";
		end_of_swipe = true;

	}

	top_back();
}

swipe_profile.addEventListener("webkitAnimationEnd", top_back, false);
swipe_profile.addEventListener("animationend", top_back, false);
setNewProfile();

//go to profil other user
profil_link.addEventListener("click", () => {
	document.location.href = "../view/profil_other_user.php?email=" + email;
})
