let arr = [2, 4, 6, 8, 10, 12];

// console.log(arr.includes(4));

console.log(
    arr.find(item => item > 5) + ' index =>',
    arr.findIndex(item => item > 5)
);

// [].fill()
// [].keys()
// [].values()
// [].entries()
