var express = require('express');
var app = express();
var path = require('path');
var server = require('http').createServer(app);
var io = require('socket.io')(server);
var port = process.env.PORT || 8050;

server.listen(port, function () {
  console.log('Server listening at port %d', port);
});
app.get('/', ($req, $res) => {io.on("connection", (socket) => {
	setInterval(function(){
		console.log("Server request" + new Date());
	},3000);
	
})
$res.send("NEW PAGE")
})


//server.listen(8050)