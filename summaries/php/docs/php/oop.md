# PHP OOP Cheat Sheet

* [Advantages of OOP](#advantages-of-oop)
* [OOP Concepts](#oop-concepts)
* [Inheritance vs. Composition](#inheritance-vs-composition)

## Advantages of OOP
* OOP provides a clear modular structure for programs.
* It is good for defining abstract data types.
* It implements real life scenario.
* It is easy to maintain and modify existing code as new objects can be created with small differences to existing ones.
* Objects can also be reused within an across applications.

## OOP Concepts

1- **Abstraction**

`Abstraction` is selecting data from a larger pool to show only the relevant details to the object. It helps to reduce programming complexity and effort. [Video to explain](https://www.youtube.com/watch?v=SwAkGw4K8D4)

At a higher level, `Abstraction` is describe `generic types` and process of hiding the implementation details (complexity) and showing only functionality to the user. ie. While sending SMS, you just type the text and send the message. Here, you do not care about the internal processing of the message delivery. Abstraction can be achieved using Abstract Class and Abstract Method.

*> When to use Abstract Class & Abstract Methods?*

Abstract classes help to describe `generic types` of behaviors and object-oriented programming class hierarchy. It also describes subclasses to offer implementation details of the abstract class.

Abstract methods are mostly declared where two or more subclasses are also doing the same thing in different ways through different implementations. It also extends the same Abstract class and offers different implementations of the abstract methods.

2- **Encapsulation**

`Encapsulation` is a principle of wrapping data (variables) and code together as a single unit (class) and prevent access to this data directly.

`Encapsulation` this is concerned with hiding the implementation details and only exposing the methods. The main purpose of encapsulation is to:
* Reduce software development complexity – by hiding the implementation details and only exposing the operations, using a class becomes easy.
* Protect the internal state of an object – access to the class variables is via methods such as `get` and `set`, this makes the class flexible and easy to maintain.
* The internal implementation of the class can be changed without worrying about breaking the code that uses the class.

[Video to explain](https://www.youtube.com/watch?v=szYzBC89CPE)

**> Difference between Abstraction and Encapsulation**

Abstraction | Encapsulation
---|---|
Abstraction solves the issues at the design level. | Encapsulation solves it implementation level.
Abstraction is about hiding unwanted details (complexity) while showing most essential information. | Encapsulation means hiding the (code) and data into a single unit (class).
Abstraction allows focussing on what the information object must contain. | Encapsulation means hiding the internal details or mechanics of how an object does something for security reasons.


3- **Polymorphism**

`Polymorphism` this is concerned with having a single form but many different implementation ways. The main purpose of polymorphism is Simplify maintaining applications and making them more extendable.

`Runtime polymorphism` is implemented when we have “IS-A” relationship between objects. This is also called as method overriding because subclass has to override the superclass method for runtime polymorphism.If we are working in terms of superclass, the actual implementation class is decided at runtime. Compiler is not able to decide which class method will be invoked. This decision is done at runtime, hence the name as runtime polymorphism or dynamic method dispatch.

You can achieve the polymorphism using the `overriding`, `interface` or `abstract class`.

4- **Inheritance**

`Inheritance` this is concerned with the relationship between classes.

The relationship takes the form of a parent and child. The child uses the methods defined in the parent class.

The main purpose of inheritance is the Re-usability. a number of children can inherit from the same parent. This is very useful when we have to provide common functionality such as adding, updating and deleting data from the database.

## Inheritance vs. Composition

Inheritance happened when the contained object in “IS-A” relationship with other object. For example, Cat is-a pets.

```php
class Pets {
    // ...
}

class Cat extends Pets {
    // ...
}

$bob = new Cat; // Cat is-a Pets
```

Composition happened when the contained object in “HAS-A” relationship and this object can’t exist on it’s own, then it’s a case of composition. For example, House has-a Room. Here room can’t exist without house.

```php
class Room {
    // ...
}

class House {
    private $room;

    public function __construct(Room $room) {
       $this->room = $room;
    }
}

$flat = new House(new Room); // House has-a room
```
For more information [here](./uml.md) and [here](https://sergeyzhuk.me/2017/01/08/composition-over-inheritance/).

And for more explain in this [video](https://www.youtube.com/watch?v=RiRrcCUyn4M) and this [video](https://www.youtube.com/watch?v=f8vh966cOcw)


