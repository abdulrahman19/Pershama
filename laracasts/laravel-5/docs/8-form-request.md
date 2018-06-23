# Form Request Data and CSRF

When you use <code>create()</code> method, Laravel will prevents pass a directly data to function, so we have several choises to fix that.

1- Tell model which fields we only need to pass
```php
protected $fillable = ['bla', 'bla'];
```
2- Do the opposite, tell model which fields you don't want to pass
```php
protected $guarded = ['bla', 'bla'];
```
3- Create a parent class and inherit things from it to not repeat yourself.
```php
class Parent extends Model
{
    protected $guarded = ['title', 'body'];
}

class Child extends Parent
{
    // code...
}
```
