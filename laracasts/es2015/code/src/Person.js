class Person {
    constructor(name) {
        this.name = name;
    }

    greet() {
        return this.name + ' says hello.'; // review template strings.
    }
}

console.log(new Person('Abdulrahman').greet());
