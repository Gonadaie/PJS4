var https = require('https');
var fs = require('fs');

var server = https.createServer({
key: fs.readFileSync('/etc/letsencrypt/live/skipti.fr/privkey.pem'),
cert: fs.readFileSync('/etc/letsencrypt/live/skipti.fr/fullchain.pem'),
ca: fs.readFileSync('/etc/letsencrypt/live/skipti.fr/fullchain.pem'),
requestCert: false,
rejectUnauthorized: false
}, function (){
fs.readFile('./index.html', 'utf-8', function(error, content) {

		res.writeHead(200, {"Content-Type": "text/html"});

		res.end(content);
		});
});

var io = require('socket.io').listen(server);
var sockets = [];

function searchSocketWithId(id) {
	for(var i = 0; i < sockets.length; ++i) {
		if(sockets[i].id_client === id) return sockets[i];
	}
	throw "Invalid id"
}

function addMessageToDB(message){
	const querystring = require('querystring');                                                                                                                                                                                                
	const https = require('https');
	var jsonMSG = JSON.parse(message);
	'sender=' + jsonMSG[0] + '&receiver=' + jsonMSG[1] + '&content=' + jsonMSG[2] 
	var postData = querystring.stringify({
			'sender' : jsonMSG[0],
			'receiver' : jsonMSG[1],
			'content' : jsonMSG[2]
			});

	var options = {
		hostname: 'skipti.fr',
		port: 443,
		path: '/controller/insert_message.php',
		method: 'POST',
		headers: {
			'Content-Type': 'application/x-www-form-urlencoded',
			'Content-Length': postData.length
		}
	};

	var req = https.request(options, (res) => {
			console.log('statusCode:', res.statusCode);
			console.log('headers:', res.headers);

			res.on('data', (d) => {
					process.stdout.write(d);
					});
			});

	req.on('error', (e) => {
			console.error(e);
			});

	req.write(postData);
	req.end();
}

io.sockets.on('connection', function (socket) {
		console.log('Client connected');
		socket.isUnknown = true;
		sockets.push(socket);

		/**
 * 		 * A message should be composed like this : 
 * 		 */
		socket.on('message', function (message) {
			//Expect the socket to identify itself
			var msg = JSON.parse(message);
			console.log("Received a messaged from student " + socket.id_client);
			if(socket.isUnknown){
				//TODO : Check if theres a match between the two ids
				socket.id_client = msg[0];
				socket.isUnknown = false;
			}

			var id_dest = msg[1];
			console.log("Adding message to DB");
			addMessageToDB(message);
			console.log("Message added succesfully");

			try {
				var dest = searchSocketWithId(id_dest);
				dest.emit('message' , message);
				console.log("Message sent to destination browser");
			} catch(e) {console.log("Client socket could not be found");}
		});

		socket.on('disconnect', function(data) {
			const index = sockets.indexOf(socket);
			sockets.splice(index, 1);
		});
});


server.listen(8080);
