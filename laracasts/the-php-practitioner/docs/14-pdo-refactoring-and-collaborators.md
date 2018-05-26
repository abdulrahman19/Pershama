# 14-PDO Refactoring and Collaborators

[Tips] We can return values from other file we required.
```php
// fileOne.php
$val = 1;
return $val;
// fileTwo.php
$val = require 'fileOne.php';
echo $val; // 1
```