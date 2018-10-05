// // object / method shorthand

// function getPerson() {
//     let name = 'John';
//     let age = 25;

//     return {
//         name, // name: name is ES5
//         age, // but now just the name.
//         greet() { // the new function format for ES6
//             return `Hello, ${this.name}`;
//         }
//     };
// }

// console.log(getPerson().name);
// console.log(getPerson().greet());

// ===================================

// object destructuring

// let person = {
//     name: 'Karen',
//     age: 32
// };

// let {name, age} = person;

// console.log(name);

function getData({results, count}) {
    console.log(results, count);
}

getData({
    results: ['foo', 'bar'],
    count: 30
});
