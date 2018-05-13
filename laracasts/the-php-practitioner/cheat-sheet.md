* [13-Intro to PDO](#13-intro-to-pdo)
* [14-PDO Refactoring and Collaborators](#14-pdo-refactoring-and-collaborators)

# 13-Intro to PDO:
We can connect to PDO by use following syntax.
```php
try {
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=bla', 'user', 'pass')
} catch (PDOException $e) {
    die('Could not connect.');
}
```
Or you can show default php error message.
```php
die($e->getMessage());
```
After the connected, we need to prepare our query.
```php
$statement = $pdo->prepare('SELECT * FROM bla');
```
After that execute the query and fetch the result.
```php
$statement->execute();
var_dump($statement->fetchAll()); // for dump the result.
// fetchAll will returns both numeric and associative index in the same array.
```
We can fetch the data as an object.
```php
var_dump($statement->fetchAll(PDO::FETCH_OBJ));
// or single row
var_dump($statement->fetch(PDO::FETCH_OBJ));
```
We can fetch the result into a class.
```php
var_dump($statement->fetchAll(PDO::FETCH_CLASS, 'Task'));
```
Now after fetch the data on the class, and we can manipulate them as we want.
```php
class Task 
{
    public $description;
    public $completed;

    public function isCompleted()
    {
        return ($this->completed) ? 'completed' : 'not completed';
    }
}
```
Each row form database now will has isCompleted method.

# 14-PDO Refactoring and Collaborators
Jeffrey explain single responsible and how can apply it.

[Tips] We can return values from other file we required.
```php
// fileOne.php
$val = 1;
return $val;
// fileTwo.php
$val = require 'fileOne.php';
echo $val; // 1
```
