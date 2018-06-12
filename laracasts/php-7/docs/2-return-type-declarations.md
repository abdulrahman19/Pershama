# Return Type Declarations

Like scalar typehints, you can also declare the type of returned value from the function.
```php
function bla(array $value) : array
{
    # code...
}
```
Now this function must accept array param and return array value.

Also you can use this with interfaces.
```php
interface Bla {
function bla_bla(array $value) : array;
}
```
