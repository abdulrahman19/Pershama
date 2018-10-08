// callback hell
// --------------

// var fs = require('fs');

// fs.exists('/path/to/file', function (){
//     // do some stuff.
// });

// what are promises
// -----------------

// var promise = this.$http.get('/some/path');

// promise.then(function(data) {
//     // do some stuff
// }).catch(function(err) {
//     // catch errors if happened
// });

// or as a second arg
// promise.then(function(data) {
//     // do some stuff
// },function(err) {
//     // catch errors if happened
// });

// create promises
// ---------------

var thing = new Promise(function (resolve, reject) {
    // do some stuff right now
    resolve(); // this is what will (resolve) later.
    reject(); // or if something goes wrong.
});

thing.then(function(data) {
    // do some stuff
},function(err) {
    // catch errors if happened
});
