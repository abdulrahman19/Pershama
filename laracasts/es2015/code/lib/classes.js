"use strict";

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

// // before ES6
// function User(username, email) {
//     this.username = username;
//     this.email = email;
// }
// User.prototype.changeEmail = function(newEmail) {
//     this.email = newEmail;
// }
// var user = new User('Abdulrahman', 'a@a.com');
// user.changeEmail('b@a.com');
// console.log(user.email);
// =========================
// // after ES6
// class User {
//     constructor(username, email) {
//         this.username = username;
//         this.email = email;
//     }
//     changeEmail(newEmail) {
//         this.email = newEmail;
//     }
// }
// let user = new User('Abdulrahman', 'a@a.com');
// user.changeEmail('b@a.com');
// console.log(user);
// =========================
// // static methods
// class User {
//     constructor(username, email) {
//         this.username = username;
//         this.email = email;
//     }
//     static register(...args) {
//         return new User(...args);
//     }
//     changeEmail(newEmail) {
//         this.email = newEmail;
//     }
// }
// let user = User.register('Abdulrahman', 'a@a.com');
// console.log(user);
// ================================
// // setter and getter
// class User {
//     constructor(username, email) {
//         this._username = username;
//         this.email = email;
//     }
//     static register(...args) {
//         return new User(...args);
//     }
//     set username(username) {
//         this._username = username;
//     }
//     get username() {
//         return this._username;
//     }
//     changeEmail(newEmail) {
//         this.email = newEmail;
//     }
// }
// let user = User.register('Abdulrahman', 'a@a.com');
// user.username = 'a';
// console.log(user);
// ================================
// Classes are first-class citizens
function log(strategy) {
  strategy.handle();
} // log(new class {
//     handle() {
//         console.log('This is console alert.');
//     }
// });


var ConsoleLogger =
/*#__PURE__*/
function () {
  function ConsoleLogger() {
    _classCallCheck(this, ConsoleLogger);
  }

  _createClass(ConsoleLogger, [{
    key: "handle",
    value: function handle() {
      console.log('This is console alert.');
    }
  }]);

  return ConsoleLogger;
}();

log(new ConsoleLogger());