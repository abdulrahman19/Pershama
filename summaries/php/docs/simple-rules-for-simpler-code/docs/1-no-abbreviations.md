# No Abbreviations

The first simple rule to write a good code is NEVR abbreviate you class or variable names.
```php
class Trnsltr
{
    $wrd;

    public function conv_ltr($value)
    {
        # code...
    }
}
```
Instead write it like that
```php
class Translator
{
    $word;

    public function convert_letter($value)
    {
        # code...
    }
}
```
That's more readable, autocompete-able, and more clean.

Even if you already don't abbreviate your names, you must think about the name itself if it's appropriate or not.

```php
class UserRepository
{
    public function fetch($billingId)
    {
        # code...
    }
}

# now imagine after year or more you read this
$UserRepository->fetch();
```
Now you'll forget what parameters must pass. <br>
So it's better to do something like that.
```php
class UserRepository
{
    public function fetchByBillingId($id)
    {
        # code...
    }
}

$UserRepository->fetchByBillingId();
```
Now It's easy to follow and understand.

> There's a rule says that you must force your variables or methods or classes names to not be more then two words, that's will help you to be specific about what you do.

But in the above example it still good even if you break the rule.
