# The PHP Practitioner
Jeffrey Way in this series try to gives us an idea about how to build MVC framework.
> Please note I'll not document all the series content here, but only highlight points or things I need to remember later, because I already know many things in this series before.

# Index
> If you find a link in episode title that means there are some explanations in there, otherwise the episode summary you will find them in the code, you can use commits to know what happened specifically.

* **[13- Intro to PDO](docs/13-intro-to-pdo.md)** <br>
Here you will know how to connect to database using PDO and fetch date.

* **[14- PDO Refactoring and Collaborators](docs/14-pdo-refactoring-and-collaborators.md)** <br>
Jeffrey here explains single responsible and how can apply it.

* **16- Make a Router** <br>
In this episode we'll create a simply router.

* **17- Dry Up Your Views** <br>
In this episode Jeffrey talks about how to dry the views, by separate the view into pieces, to not repeat ourself.

* **19- Forms, Request Types, and Routing** <br>
The idea of this episode is the past router class works only with <code>GET</code> requests, and it doesn't able to differentiate between <code>GET</code> and <code>POST</code> requests, so we'll fix that.

* **20- Dynamic Inserts With PDO**
* **21- Composer Autoloading**
* **22- Your First DI Container** <br>
Here will create App class and collect all config information inside it.
* **23- Refactoring to Controller Classes** <br>
Here will remove all PHPs files and create a class with methods, and edit our router to call those methods instead of call a normal PHPs files.
* **24- Switch to Namespaces** <br>
