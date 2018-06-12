# The Null Coalesce Operator

Instead of check for value like:
```php
$bla = isset($_GET['bla']) ? $_GET['bla'] : 'other bla';
```
Now we can use that
```php
$bla = $_GET['bla'] ?? 'other bla';
```
Pretty awesome..Ya!