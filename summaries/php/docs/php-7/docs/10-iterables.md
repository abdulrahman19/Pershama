# Iterables

If you wanna pass something to function is iterable like <code>array</code> or class implement <code>IteratorAggregate</code> for ex, with PHP 7.2 you can do
```php
function bla(iterable $values)
{
    foreach ($values as $key => $value) {
        # code...
    }
}

bla([1,2,3]);
# or
bla($collection); // implement IteratorAggregate
```
both will work so fine now.
