// import { TaskCollection, foo } from './TaskCollection';
// import TaskCollection, { foo } from './TaskCollection'; // when use default and return anything with the default.
import TaskCollection from './TaskCollection'; // when use default and only return one thing.

new TaskCollection([
    'Task one',
    'Task two',
    '...etc'
]).dump();
