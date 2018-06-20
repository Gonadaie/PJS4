function create_cookie_info() {
	let background = document.createElement('div');
	let info = document.createElement('div');
	let accept_btn = document.createElement('div');

	document.body.appendChild(background);
	document.body.appendChild(info);

	let p = document.createElement('p');
	p.setAttribute('id', 'cookie_text');
	p.innerHTML = "En continuant votre naviguation sur ce site, vous acceptez que des cookies soient stockes sur votre ordinateur afin de rendre votre experience sur notre site plus agreable.</br></br>Et les cookies c'est bon en plus.";

	info.appendChild(p);

	background.setAttribute('id', 'cookie_background');
	info.setAttribute('id', 'cookies_info');

	info.appendChild(accept_btn);
	accept_btn.setAttribute('id', 'cookie_accept');
	accept_btn.innerHTML = "Accepter";
	accept_btn.onclick = function() {
		background.style.display = 'none';
		info.style.display = 'none';
		accept_btn.style.display = 'none';
		document.cookie = "skiptiAcceptCookies=true";
	}
}

$('head').append('<link rel="stylesheet" type="text/css" href="../styles/cookies_info.css">');

if(!document.cookie.includes("skiptiAcceptCookies=true"))
	create_cookie_info();
