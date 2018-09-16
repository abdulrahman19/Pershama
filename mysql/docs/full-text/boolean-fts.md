# Boolean Full-Text Searches

* [Boolean FTS Operators](#boolean-fts-operators)
* [Boolean FTS Examples](#boolean-fts-examples)

MySQL supports an additional form of full-text search that is called Boolean full-text search. In the Boolean mode, MySQL searches for words instead of the concept like in the natural language search.

MySQL allows you to perform a full-text search based on very complex queries in the Boolean mode along with Boolean operators.

To perform a full-text search in the Boolean mode, you use the `IN BOOLEAN MODE` modifier in the `AGAINST` expression.
```sql
SELECT productName, productline
FROM products
WHERE MATCH(productName)
      AGAINST('Truck' IN BOOLEAN MODE )
```

**Boolean FTS have these characteristics:**
* MySQL does not automatically sort rows in the order of decreasing relevance in Boolean full-text search.
* To perform Boolean queries, InnoDB tables require all columns of the `MATCH` expression has a `FULLTEXT index`. Notice that MyISAM tables do not require this, although a search executed in this fashion would be quite slow.
* MySQL does not support multiple Boolean operators on a search query on InnoDB tables e.g., `++mysql`. MySQL will return an error if you do so. However, MyISAM behaves differently. It ignores other operators and uses the operator that is closest to the search word, for example, `+-mysql` will become `-mysql`.
* InnoDB full-text search does not support trailing plus (`+`) or minus (`-`) sign. It only supports leading plus or minus sign. MySQL will report an error if you search word is `mysql+` or `mysql-`. In addition, the following leading plus or minus with wildcard are invalid: `+*`, `+-`.
* The 50% threshold is not applied. By the way, 50% threshold means if a word appears in more than 50% of the rows, MySQL will ignore it in the search result.

### Boolean FTS Operators
<br>Operator <img width=35/>| Description
---|---|
no operator | By default (when neither `+` nor `-` is specified), the word is optional, but the rows that contain it are rated higher.
`+` | Include, the word must be present.
`–` | Exclude, the word must not be present.
`>` | Include, and increase ranking value.
`<` | Include, and decrease the ranking value.
`()` | Group words into subexpressions (allowing them to be included, excluded, ranked, and so forth as a group).
`~` | Negate a word’s ranking value.
`*` | Wildcard at the end of the word.
`"` | A phrase that is enclosed within double quote (`"`) characters matches only rows that contain the phrase literally, as it was typed.

### Boolean FTS Examples
To search for rows that contain at least one of the two words: `mysql` or `tutorial`.
```sql
AGAINST('mysql tutorial' IN BOOLEAN MODE )
```
To search for rows that contain both words: `mysql` and `tutorial`.
```sql
AGAINST('+mysql +tutorial' IN BOOLEAN MODE )
```
To search for rows that contain the word `mysql` but not `tutorial`.
```sql
AGAINST('+mysql -tutorial' IN BOOLEAN MODE )
```
To search for rows that contain the word `mysql`, but put the higher rank for the rows that contain `tutorial`.
```sql
AGAINST('+mysql tutorial' IN BOOLEAN MODE )
```
To search for rows that contain word `mysql` and rank the row lower if it contains the word `tutorial`.
```sql
AGAINST('+mysql ~tutorial' IN BOOLEAN MODE )
```
To search for rows that contain the words `mysql` and `tutorial`, or `mysql` and `training` in whatever order, but put the rows that contain `mysql tutorial` higher than `mysql training`.
```sql
AGAINST('+mysql +(>tutorial <training)' IN BOOLEAN MODE )
```
To find rows that contain words starting with `my` such as `mysql`, `myyahoo`, etc.
```sql
AGAINST('my*' IN BOOLEAN MODE )
```
Find rows that contain the exact phrase `mysql tutorial`.
```sql
AGAINST('"mysql tutorial"' IN BOOLEAN MODE )
```
