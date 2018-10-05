"use strict";

// // Rest operator gives you a dynamic parameters.
// function sum(...numbers) {
//     return numbers.reduce((prev, current) => prev + current);
// }
// console.log(sum(1, 2, 3, 4));
// ===========================
// // Spread operator converts array to single arguments.
// function sum(x, y) {
//     return x + y;
// }
// let nums = [1, 2];
// console.log(sum(...nums));
// ===========================
// // if you pass any other parameters it'll deal with them
// function sum(...numbers, foo) {
//     // code
// }
// console.log(sum(1,2,3,4,'yes'));
// // numbers = [1,2,3,4]
// // foo = 'yes'
// the opposite to write
function sum(foo) {// code
}

console.log(sum('yes', 1, 2, 3, 4)); // foo = 'yes'
// numbers = [1,2,3,4]