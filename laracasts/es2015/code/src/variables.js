// //====var====
// // var is like a global variable, wherever you define it you can access it from any place.
// function fire(bool) {
//     if (bool) {
//         var foo = 'bar'; // hoisting
//         console.log(foo);
//     } else {
//         console.log(foo); // undefined
//     }
// }

// fire(false);

// //====let====
// // It's like var but on block level
// function fire(bool) {
//     if (bool) {
//         let foo = 'bar';
//         console.log(foo);
//     } else {
//         console.log(foo); // error
//     }
// }

// fire(false);

//====const====
// It reject change values by direct way (assignment) but with other ways like use "push()" with arrays.

const names = ['John', 'Sandy'];

// names = ['Abdulrahman'] // error

names.push('Abdulrahman');

console.log(names);

