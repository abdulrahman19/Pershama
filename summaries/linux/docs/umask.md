# UMask

* [Show umask](#show-umask)
* [Change umask by characters](#change-umask-by-characters)
* [Change umask by numbers](#change-umask-by-numbers)

The `umask` utility is used to control the file-creation mode mask, which determines the initial value of file permission bits for newly created files.

> **Please note:** that `umask` only prevents permissions but never adds them.
> Thus, you get any permission only if the creating `open()` syscall does contain them.
>
> **For xample:** if you add execute permission to `owner` in `umask`, and you use `touch` program that doesn't add
> execute permission when create files, the final file permission will not contain execute permission.
> Even if you add it in `umask`.

## Show umask
To show current `umask` value, type the following command
```bash
umask
# or
umask -S # display current value symbolically
```

## Change umask by characters
Please check characters meaning [here](./permissions.md#add-permissions-by-characters)
```bash
umask u=rwx,go=
```
This is meaning `owner` has all the permissions, `group` and `other` none.

## Change umask by numbers
Octal digit in umask command | Permissions the mask will prohibit from being set during file creation
---|---|
0 | any permission may be set (read, write, execute)
1 | setting of execute permission is prohibited (read and write)
2 | setting of write permission is prohibited (read and execute)
3 | setting of write and execute permission is prohibited (read only)
4 | setting of read permission is prohibited (write and execute)
5 | setting of read and execute permission is prohibited (write only)
6 | setting of read and write permission is prohibited (execute only)
7 | all permissions are prohibited from being set (no permissions)

```bash
umask 077
```
This is meaning `owner` has all the permissions, `group` and `other` none.
