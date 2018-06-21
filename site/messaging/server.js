var http = require('http');
var fs = require('fs');

var server = http.createServer(function(req, res) {});
var io = require('socket.io').listen(server);

var sockets = [];

function searchSocketWithId(id) {
	for(var i = 0; i < sockets.lenght; ++i) {
		if(sockets[i].id === id) return sockets[i];
	}
	throw "Invalid id"
}

function addMessageToDB(message){

	var jsonMSG = JSON.decode(message);

	var http = require("http");
	var options = {
		hostname: 'localhost',
		port: 80,
		path: '/controller/insert_message.php',
		method: 'POST',
		headers: {
		    'Content-Type': 'application/x-www-form-urlencoded',
		}
	};
	var req = http.request(options, function(res) {
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
		socket.emit('message', 'You are connected');
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
				//Check if theres a match between the two ids
				socket.id = msg[0];	
			}
			else {
				var id_dest = msg[1];
				try {
					addMessageToDB(message);
					searchSocketWithId(id_dest).emit('message' , message);
				} catch(e) {}
			}	
		});

		socket.on('disconnect', function(data) {
			const index = sockets.indexOf(socket);
			sockets.splice(index, 1);
		});
});


server.listen(8080);
