# Multi-Catch Exception Handling

Before PHP 7 when you wanna throw exception with multi-catch you used to do like:

```php
class ExOne extends Exception {}
class ExTwo extends Exception {}

class ClassName
{

    function bla()
    {
        throw new ExOne;
        # or two
    }
}

try {
    (new ClassName)->bla();
} catch (ExOne $e) {
    var_dump('error');
} catch (ExTwo $e) {
    var_dump('error');
}
```
Now with PHP 7.1 to remove the duplication, you can make it like:
```php
try {
    (new ClassName)->bla();
} catch (ExOne | ExTwo $e) {
    var_dump('error');
}
```
