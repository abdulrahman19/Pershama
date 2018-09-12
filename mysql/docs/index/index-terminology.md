# Indexes Chapter Terminologies

<br> Term <img width=350/>| Meaning
---|---|
Metadata | Metadata is “the data about the data.” Anything that describes the database as opposed to being the contents of the database is metadata. Thus column names, database names, user names, version names, and most of the string results from `SHOW` are metadata. This is also true of the contents of tables in `INFORMATION_SCHEMA` because those tables by definition contain information about database objects.
Prefix Index | is a index used to not consume a lot of disk space and speed operations when use `INSERT` statement, also increase the performance when use `SELECT` statement by decreasing the number of rows it searches on.


