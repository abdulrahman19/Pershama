# Symmetric Array Destructuring

Before PHP 7 when you wanna assign array to variables you do something like that:
```php
$arr = ['bla', 'bla_bla'];
list($bla, $bla_bla) = $arr;
echo $bla;
echo $bla_bla;
# output be like
# > bla
# > bla_bla
```
OK now with PHP 7.1 we can shortcut this operation like:
```php
$arr = ['bla', 'bla_bla'];
[$bla, $bla_bla] = $arr;
echo $bla;
echo $bla_bla;
# output be like
# > bla
# > bla_bla
```
And if you have associative array, you can do this:
```php
$arr = ['bla'=>'foo', 'bla_bla'=>'bar'];
['bla'=>$bla, 'bla_bla'=>$bla_bla] = $arr;
echo $bla;
echo $bla_bla;
# output be like
# > foo
# > bar
```
If you have multidimensional array you can then use <code>symmetric array</code> with <code>foreach</code> like that:
```php
$arr = [
    ['bla'=>'foo', 'bla_bla'=>'bar'],
    ['bla'=>'bar', 'bla_bla'=>'foo'],
];
foreach ($arr as ['bla'=>$bla, 'bla_bla'=>$bla_bla]) {
    echo $bla;
    echo $bla_bla;.
}

# output be like
# > foo
# > bar
# > bar
# > foo
```
