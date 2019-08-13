# Character Set

* [Converting between different character sets](#converting-between-different-character-sets)

A MySQL character set is a set of characters that are legal in a string. For example, we have an alphabet with letters from `a` to `z`.We assign each letter a number, for example, `a = 1, b = 2` etc. The letter `a` is a symbol, and the number `1` that associates with the letter `a` is the encoding. The combination of all letters from `a` to `z` and their corresponding encodings is a `character set`.

Each character set has one or more collations that define a set of rules for comparing characters within the character set.

To get all available character sets in MySQL database server, you use the `SHOW CHARACTER SET` statement as follows:
```sql
SHOW CHARACTER SET;
```

The default character set in MySQL is `latin1`. If you want to store characters from multiple languages in a single column, you can use Unicode character sets, which is `utf8` or `ucs2`.

The values in the `Maxlen` column specify the number of bytes that a character in a character set holds. Some character sets contain single-byte characters e.g., `latin1` , `latin2` , `cp850` , etc., whereas other character sets contain multi-byte characters.

### Converting between different character sets
* The `CONVERT` function converts a string into a specific character set.
```sql
SET @str = CONVERT('MySQL Character Set' USING utf8);
SELECT LENGTH(@str), CHAR_LENGTH(@str);
```

Notice that some character sets contain multi-byte characters,  but their strings may contain only single-byte characters like `utf8`.

* The `CAST` function is similar to the `CONVERT` function. It converts a string to a different character set:
```sql
SELECT CAST(_latin1'MySQL character set' AS CHAR CHARACTER SET utf8);
```
