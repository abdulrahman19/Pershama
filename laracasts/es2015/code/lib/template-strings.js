"use strict";

// // before ES2015
// let template = [
//     '<div class="Alert">',
//         '<p>Foo</p>',
//     '</div>'
// ].join('');
// console.log(template);
// After ES2015
var name = 'Bar';
var template = "\n    <div class=\"Alert\">\n        <p>".concat(name, "</p>\n    </div>\n").trim(); // trim() is optional

console.log(template);