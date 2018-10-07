"use strict";

var _TaskCollection = _interopRequireDefault(require("./TaskCollection"));

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

// import { TaskCollection, foo } from './TaskCollection';
// import TaskCollection, { foo } from './TaskCollection'; // when use default and return anything with the default.
// when use default and only return one thing.
new _TaskCollection.default(['Task one', 'Task two', '...etc']).dump();