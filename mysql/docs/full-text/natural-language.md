# Natural Language Full-Text Searches

* [Natural Language FTS Example](#natural-language-fts-example)

In natural language full-text searches, MySQL looks for rows or documents that are relevant to the free-text natural human language query, for example, “How to use MySQL natural language full-text searches”.

Relevance is a positive floating-point number.

When the relevance is zero, it means that there is no similarity.

MySQL computes the relevance based on various factors including:
* The number of words in the document.
* The number of unique words in the document.
* The total number of words in the collection.
* The number of documents (rows) that contain a particular word.

To perform natural language full-text searches, you use `MATCH()` and `AGAINST()` functions.
* The `MATCH()` function specifies the column where you want to search.
* The `AGAINST()` function determines the search expression to be used.

There are some important points you should remember when using the full-text search:
* The minimum length of the search term defined in MySQL full-text search engine is 4. It means that if you search for the keyword whose length is less than 4 e.g., car, cat, etc., you will not get any results.
* Stop words are ignored. MySQL defines a list of stop words in the MySQL source code distribution `storage/myisam/ft_static.c`.

### Natural Language FTS Example
```sql
SELECT productName, productline
FROM products
WHERE MATCH(productName) AGAINST('1932 Ford' IN NATURAL LANGUAGE MODE);
```
The `AGAINST()` function uses `IN NATURAL LANGUAGE MODE` search modifier by default therefore you can omit it in the query.
```sql
SELECT productName, productline
FROM products
WHERE MATCH(productline) AGAINST('1932 Ford');
```
