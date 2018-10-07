// export default class TaskCollection {
//     constructor(task = []) {
//         this.tasks = tasks;
//     }

//     dump() {
//         console.log(this.tasks);
//     }
// }

// export let foo = 'bar';

// ====================================

class TaskCollection {
    constructor(tasks = []) {
        this.tasks = tasks;
    }

    dump() {
        console.log(this.tasks);
    }
}

export default TaskCollection;
