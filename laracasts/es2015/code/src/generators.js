// function *numbers() {
//     console.log('Begin');

//     yield 1;
//     yield 2;
//     yield 3;
// }

// let iterator = numbers();

// console.log(iterator.next());
// console.log(iterator.next());
// console.log(iterator.next());

// -----------------

// function *range(start, end) {
//     while(start <= end) {
//         yield start;

//         start++;
//     }
// }

// let iterator = range();

// console.log(range.next());
// // ...
// for(let i of iterator) console.log(i);
// console.log(
//     [...range(1, 5)]
// );
