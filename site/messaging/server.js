var https = require('https');
var fs = require('fs');

var server = https.createServer({
    key: fs.readFileSync('/etc/letsencrypt/live/skipti.fr/privkey.pem'),
    cert: fs.readFileSync('/etc/letsencrypt/live/skipti.fr/fullchain.pem'),
    ca: fs.readFileSync('/etc/letsencrypt/live/skipti.fr/fullchain.pem'),
    requestCert: false,
    rejectUnauthorized: false
}, function (){
	console.log("merde");
	fs.readFile('./index.html', 'utf-8', function(error, content) {

	res.writeHead(200, {"Content-Type": "text/html"});

	res.end(content);
	});
});

var io = require('socket.io').listen(server);
var sockets = [];

function searchSocketWithId(id) {
	for(var i = 0; i < sockets.lenght; ++i) {
		console.log(sockets[i]);
		console.log("ID DE LA SOCKET : " + sockets[i].id);
		if(sockets[i].id === id) return sockets[i];
	}
	throw "Invalid id"
}

function addMessageToDB(message){

	var jsonMSG = JSON.decode(message);

	var https = require("https");
	var options = {
		hostname: 'localhost',
		port: 80,
		path: '/controller/insert_message.php',
		method: 'POST',
		headers: {
		    'Content-Type': 'application/x-www-form-urlencoded',
		}
	};
	var req = https.request(options, function(res) {
			res.setEncoding('utf8');
			res.on('data', function (body) {
		});
	});

	req.on('error', function(e) {
	});
	// write data to request body
	req.write('sender=' + jsonMSG[0] + '&receiver=' + jsonMSG[1] + '&content=' + jsonMSG[2]);
	req.end();
}

io.sockets.on('connection', function (socket) {
		console.log('Client connected to the messaging server !');
		socket.isUnknown = true;
		sockets.push(socket);

		/**
 * 		 * A message should be composed like this : 
 * 		 */
		socket.on('message', function (message) {
			//Expect the socket to identify itself
			var msg = JSON.parse(message);
			console.log("un message !!!");
			console.log(msg);
			if(socket.isUnknown){
				//TODO : Check if theres a match between the two ids
				socket.id = msg[0];
				socket.isUnknown = false;
			}

			var id_dest = msg[1];
			try {
				console.log("Adding message to DB");
				addMessageToDB(message);
				console.log("Message added succesfully");
				var dest = searchSocketWithId(id_dest);
				console.log('jenvoie a la socket id ' + dest.id);
				dest.emit('message' , message);
			} catch(e) {console.log("Client socket could not be found");}
		});

		socket.on('disconnect', function(data) {
			const index = sockets.indexOf(socket);
			sockets.splice(index, 1);
		});
});


server.listen(8080);
