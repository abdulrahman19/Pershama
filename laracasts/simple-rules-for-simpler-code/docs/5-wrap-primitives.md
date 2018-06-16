# Wrap Primitives

Primitive just think of it as a basic building block. <br>
Things like <code>string</code> or <code>int</code> or <code>bool</code>.

Now what mean wrap primitives, look for this example.
```php
function cache($data, $seconds)
{
    # code ..
}

cache([], 50);
```
Now this function open for every thing (you can pass what ever you want) and not clean when you declare this function after that what should pass.

let's clean it
```php
class Second {
    # code..
}

function cache($data, Second $seconds)
{
    # code ..
}

cache([], new Second(50));
```
Now that's clear and protected. we pass second param with clear name and with specific type from <code>Second</code> class.

But that will be hard to follow for every primitive type, so you need to think if it's necessary or not. <br>
And this question will help you: <br>
1- Does it bring clarity. <br>
2- Is there behavior? <br>
3- There are validations associate to it? like check for email valid or not?
4- Important domain concept? <br> like latitude and longitude in Google maps for example, we shouldn't declare this as variables.
