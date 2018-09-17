# Ngram FT Parser

* [Setting Ngram Token Size](#setting-ngram-token-size)
* [Create FT with Ngram Parser](#create-ft-with-ngram-parser)
* [Ngram FTS Example](#ngram-fts-example)

MySQL use ngram full-text parser to support full-text searches for [ideographic](https://en.wikipedia.org/wiki/Ideogram) languages such as Chinese, Japanese, Korean, etc.

**> What the problem `Ngram FT Parser` try to solve?**

The built-in MySQL full-text parser determines the beginning and ending of words using white space. When it comes to ideographic languages such as Chinese, Japanese, or Korean, etc., this is a limitation because these languages do not use word delimiters.

To address this issue, MySQL included ngram full-text parser as a built-in server plugin. The main function of ngram full-text parser is [tokenizing](https://en.wikipedia.org/wiki/Tokenization_(data_security)) a sequence of text into a contiguous sequence of `n` characters.

The following illustrates how the ngram full-text parser tokenizes a sequence of text for `mysql`:
```sql
n = 1: 'm','y','s','q','l'
n = 2: 'my', 'ys', 'sq','ql'
n = 3: 'mys', 'ysq', 'sql'
n = 4: 'mysq', 'ysql'
n = 5: 'mysql
```

The Ngram parser excludes tokens that contain the `stopword` in the `stopword` list. Note that you must define your own `stopword` list if the language is other than English. In addition, the `stopwords` with lengths that are greater than `ngram_token_size` are ignored.

### Setting Ngram Token Size
As you can see the previous example, the `n` size determines how MySQL split the word.

The token size (`n`) in the Ngram by default is `2`. To change the token size, you use the `ngram_token_size` configuration option, which has a value between `1` and `10`.

Note that a smaller token size makes smaller full-text search index and allows you to search faster.

Because `ngram_token_size` is a read-only variable, therefore you only can set its value using two options:
* First, in the start-up string:
```sql
mysqld --ngram_token_size=1
```
* Second, in the configuration file:
```sql
[mysqld]
ngram_token_size=1
```

### Create FT with Ngram Parser
You add the `WITH PARSER ngram` in the `CREATE TABLE`, `ALTER TABLE`, or `CREATE INDEX` statements.
```sql
CREATE TABLE posts (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255),
    body TEXT,
    FULLTEXT ( title , body ) WITH PARSER NGRAM
)  ENGINE=INNODB CHARACTER SET UTF8MB4;
```

### Ngram FTS Example
Natural Language Mode
```sql
SELECT
    *
FROM
    posts
WHERE
    MATCH (title , body) AGAINST ('简单和有趣' IN natural language MODE);
```
Boolean Mode
```sql
SELECT
    *
FROM
    posts
WHERE
    MATCH (title , body) AGAINST ('简单和有趣' IN BOOLEAN MODE);
```
WildCard Search
```sql
SELECT
    id, title, body
FROM
    posts
WHERE
    MATCH (title , body) AGAINST ('my*' );
```
Ngram does not know the beginning of terms. When you perform wildcard searches, it may return unexpected result.The following rules are applied to wildcard search:
* If the prefix term in the wildcard is shorter than ngram token size, the query returns all documents that contain ngram tokens starting with the prefix term.
* If the prefix term in the wildcard is longer than ngram token size, MySQL will convert the prefix term into ngram phrases and ignore the wildcard operator.
