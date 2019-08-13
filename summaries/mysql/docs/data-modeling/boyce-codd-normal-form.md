# Boyce-Codd Normal Form (BCNF)

* [BCNF Definition](#bcnf-definition)
* [Apply In Our Example](#apply-in-our-example)

### BCNF Definition

The table be in the BCNF if:
* A table is in 3rd normal form.
* It contains only columns that are **dependent on the primary key** even the **primary keys** itself.

### Apply In Our Example

<pre>
    |-------------|------------|
                               v
    |- key -|     |- key -|
    CourseName    TeacherID    TeacherName
</pre>

This schema in 3NF because we didn't have `Transitive Dependency` because `TeacherID` here is a primary key.

But we still have a problem here, the `TeacherID` is dependent on `TeacherName` also and `TeacherName` is **not** a primary key.

<pre>
    |-------------|------------|
                               v
    |- key -|     |- key -|
    CourseName    TeacherID    TeacherName
                  ^
                  |------------|
</pre>

The problem here, what if you update `TeacherID` and didn't update his name, or the opposite?! <br>
This is an `update anomaly`. Right!!

So we need to sparate this table to two tables like that.

<pre>
    |- key -|     |- key -|
    CourseName    TeacherID

    And

    |- key -|
    TeacherID    TeacherName
</pre>

Now both tables in BCNF.
