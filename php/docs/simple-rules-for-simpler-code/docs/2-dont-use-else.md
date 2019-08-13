# Don't Use "Else"

Think in this example, we need to save posts, but we don't do that in the Friday.
```php
public function store()
{
    $input = Request::all();
    $validation = Validator::make($input, ['username'=>'required']);

    if (data('l') !== 'Friday') 
    {
        if ($validation->passes())
        {
            Post::create($input);

            return Redirect::home();
        }
        else
        {
            return Redirect::back()->withInput()->withErrors($validation);
        }
    }
    else
    {
        throw new Exception('We do not work on Friday!');
    }
}
```
Now think about those "Else-s" do we really need to write them!

one tip here put the sad path before happy one! <br>
In our example you can instead of check if the validation pass, check if the validation failed!

That's will help you shorten the run time if things go wrong.
```php
public function store()
{
    $input = Request::all();
    $validation = Validator::make($input, ['username'=>'required']);

    if (data('l') !== 'Friday') 
    {
        throw new Exception('We do not work on Friday!');
    }

    if ($validation->fails())
    {
        return Redirect::back()->withInput()->withErrors($validation);
    }

    Post::create($input);
    return Redirect::home();
}
```
And if you use Laravel you can delete this part entirely.
```php
if (data('l') !== 'Friday') 
{
    throw new Exception('We do not work on Friday!');
}
```
And put it in its own filter before apply the request. instead of repeat it on every function we use.

Also you can delete this part.
```php
if (data('l') !== 'Friday') 
{
    $validation = Validator::make($input, ['username'=>'required']);

    if ($validation->fails())
    {
        return Redirect::back()->withInput()->withErrors($validation);
    }
}
```
And use dependency injection validation service instead.
```php
$this->validator->validate($input);
```
So we end with this
```php
public function store()
{
    $input = Request::all();

    $this->validator->validate($input);

    Post::create($input);

    return Redirect::home();
}
```

In some cases we may need more then clean our way to write the code, some cases we need to separate functionalities into classes, and use <code>interface</code> to mange them by <code>polymorphism</code> concept.

```php
public function singUp($subscription)
{
    if ($subscription == 'monthly') {
        $this->createMonthlySubscription();
    }
    elseif ($subscription == 'forever') {
        $this->createForeverSubscription();
    }
    # ...etc.
}
```
We can optimize this with
```php
interface Subscription
{
    public function subscribe();
}
```

```php
class MonthlySubscription implements Subscription
{
    public function subscribe() {
        # code...
    };
}

class ForeverSubscription implements Subscription
{
    public function subscribe() {
        # code...
    };
}
```

```php
public function singUp(Subscription $subscription)
{
    $subscription->subscribe();
}
```
