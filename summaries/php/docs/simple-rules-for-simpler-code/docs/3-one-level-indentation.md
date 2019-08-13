# One Level of Indentation

This rule says one level of indentation per method!, lets take an example.
```php
class BankAccounts
{
    protected $accounts;

    function __construct($accounts)
    {
        $this->accounts = $accounts;
    }

    public function filterBy($accountType)
    {
        $filtered = [];

        foreach ($this->accounts as $account) {
            if ($account->type() == $accountType) {
                if ($account->isActive()) {
                    $filtered[] = $account;
                }
            }
        }

        return $filtered;
    }
}
```
Now please take a deep look on <code>filterBy</code> method, to much check here..Right!!

Lets see how you can improve this.
```php
public function filterBy($accountType)
{
    return array_filter($this->accounts, function ($account) use ($accountType)
    {
        return $this->isOfType($accountType, $account);
    });
}

private function isOfType($accountType, $account)
{
    return $account->type() == $accountType && $account->isActive();
}
```
Now look at <code>filterBy</code> method, Ya! one level indentation, when you do this, you will know that you on the track.

BTW you can even optimize this more, by move <code>isOfType</code> method to <code>account</code> class and even optimize it more there, because this <code>account</code> class job! <br>
But for this example I think the idea is clear right now.
