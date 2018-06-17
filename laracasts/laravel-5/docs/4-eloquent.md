# Eloquent 101

> <code>table</code> plural and <code>model</code> singular.

You can create model with migration file at once
```bash
php artisan make:model Task -m
# -m for migration
# -c for controller
```

You can fetch data by several ways
```php
App\Task::all(); // fetch all record from database
App\Task::pluck('body'); // fetch all bodies from database
App\Task::pluck('body')->first(); // fetch first body from database
App\Task::find(1); // find specific Id
App\Task::first(); // find first record
App\Task::where('id', '>', 1)->get(); // find using where
```

You can put functions inside <code>model</code> to do tasks for you
```php
public static function incomplete()
{
    return static::where('completed', 0)->get();
}
```
### Query scope
Or you can write a query scope function that returns query builder, just you need to write <code>scope</code> then the function name.
```php
public function scopeIncomplete($query, $any_other_data)
{
    return $query->where('completed', 0);
    // return query builder so use all other fun like get() or first()
}
```
