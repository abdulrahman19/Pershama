function applyDiscount(cost, discount) {
    discount = discount || .10; // default discount 10% if no discount presented.
    return cost - (cost * discount);
}

// console.log(applyDiscount(100));
// console.log(applyDiscount(100, .20));

// //====After ES2015====
// function applyDiscount(cost, discount = .10) {
//     return cost - (cost * discount);
// }

// // or you can use thing like functions as a default parameters.
function defaultDiscount() {
    return .10;
}

function applyDiscount(cost, discount = defaultDiscount()) {
    return cost - (cost * discount);
}

console.log(applyDiscount(100));
