# Scalar Typehints

Before PHP-7 we could hint some complex types like <code>array</code>, <code>class</code> or <code>interface</code>.
```php
function bla(array $value)
{
    # code...
}
```
But with PHP-7 we can hint more types like <code>int</code>, <code>float</code>, <code>string</code> and <code>bool</code>.
```php
function bla(int $value)
{
    # code...
}
```
> Please note: that PHP in some case converts (hinting) some type to another if that's possible, like string to int.
```php
function bla(int $value)
{
    echo $value;
}
bla('30');
# output > 30
```
To avoid that, you need to add following code in top of your file or application.
```php
declare(strict_types=1);
```
You can catch type errors by use <code>TypeError</code> exception type.
```php
try {
    bla('30');
} catch (TypeError $e) {
    echo 'Error: '.$e->getMessage();
}
```
