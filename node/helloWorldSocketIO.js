var app = require('express')();                 // $ npm install express --save
var http = require('http').Server(app);         // $ npm install http --save
var io = require('socket.io')(http);            // $ npm install scoket.io --save

// message
io.on('connection', function(socket){
    socket.on('hello', function() {
        console.log('Hello World!');
    });

    socket.on('bye', function() {
        console.log('Hello World!');
    });

    socket.on('off', function() {
        console.log('Hello World!');
    });
});


// listen port
http.listen('3000', function() {
    console.log('Lisetening on port 3000');
});

// client
// io.emit()