# Nullable and Void Types

We talked about [return types](./2-return-type-declarations.md) here, but what if you want return <code>int</code> or <code>null</code> value?!
```php
function bla($age) : int
{
    return $age; // null
}
bla($class->method());
```
this is will give you an error, with PHP 7.1 you can avoid that by using <code>?</code> operator.
```php
function bla($age) : ?int
{
    return $age; // null
}
bla($class->method());
```
Now it'll work!

Same thing here with [Scalar typehints](./1-scalar-typehints.md)
```php
function bla(int $age)
{
    # code...
}
bla($class->method()); // null param
```
Will give you an error
```php
function bla(?int $age)
{
    # code...
}
bla($class->method()); // null param
```
It'll work!

But what if you don't pass any arguments & you wanna make it totally optional with value or null behavior, so, you can make it like:
```php
function bla(?int $age = null)
{
    # code...
}
bla();
```
