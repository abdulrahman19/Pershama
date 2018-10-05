"use strict";

// class TaskCollection {
//     constructor(tasks = []) {
//         this.tasks = tasks;
//     }
//     // log() {
//     //     this.tasks.forEach(function(task) {
//     //         console.log(task);
//     //     })
//     // }
//     // log() {
//     //     this.tasks.forEach((task) => {
//     //         console.log(task);
//     //     })
//     // }
//     // log() {
//     //     this.tasks.forEach(task => { // because it's a one argument.
//     //         console.log(task);
//     //     })
//     // }
//     // log() {
//     //     this.tasks.forEach(task => console.log(task));
//     // }
//     // log() {
//     //     this.tasks.forEach(() => console.log('aa')); // for anonymous function
//     // }
//     // log() {
//     //     this.tasks.forEach((task) => {
//     //         console.log(this); // `this` keyword now refer to TaskCollection class.
//     //     });
//     // }
//     log() {
//         this.tasks.forEach(function (task) {
//             console.log(this); // `function` keyword it'll make `this` refer to the window object.
//         });
//     }
// }
// class Task {}
// new TaskCollection([
//     new Task, new Task, new Task
// ]).log();
//====(=>) not need `return` keyword====
var names = ['Abdulrahman', 'Asaad']; // names = names.map(name => name + 'is cool.');

names = names.map(function (name) {
  return "".concat(name, " is cool.");
}); // with template strings.

console.log(names);