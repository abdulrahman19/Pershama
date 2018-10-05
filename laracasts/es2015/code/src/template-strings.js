// // before ES2015
// let template = [
//     '<div class="Alert">',
//         '<p>Foo</p>',
//     '</div>'
// ].join('');

// console.log(template);

// After ES2015
let name = 'Bar';

let template = `
    <div class="Alert">
        <p>${name}</p>
    </div>
`.trim(); // trim() is optional

console.log(template);
