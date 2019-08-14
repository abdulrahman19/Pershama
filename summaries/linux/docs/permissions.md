# Manage permissions

* [Permission structure](#permission-structure)
* [Add permissions by characters](#add-permissions-by-characters)
* [Add permissions by numbers](#add-permissions-by-numbers)
* [Understanding setuid](#understanding-setuid)
* [Understanding setgid](#understanding-setgid)
* [Understanding sticky bit](#understanding-sticky-bit)

## Permission structure
![files permissions](../files/files-permissions.png)

The following table represents how files and folder affected by those permissions.

Permission | Character | Effect on files | Effect on directories
---|---|---|---|
<img width=300/>Read permission (first character) | `r` | <img width=200/>The file can be read. | The directory's contents can be shown.
Write permission (second character) | `w` | The file can be modified. | The directory's contents can be modified (create new files or folders; rename or delete existing files or folders); requires the execute permission to be also set, otherwise this permission has no effect.
Execute permission (third character) | `x` | The file can be executed. | The directory can be accessed with `cd`

> `delete` / `rename` file or folder it dependent on parent folder permissions not file or folder permissions itself.
> Even if you haven't any permission on this file or folder.
> To prevent that see [sticky bit](#understanding-sticky-bit)

the `-` symbol in place of `r`, `w` or `x` permissions, means that role doesn't has this permission.
<pre>
-rw-------
</pre>
The previous permissions mean that `owner` the only one has the permissions and those permissions are read and write only.

## Add permissions by characters
You can add permission to any file or folder by the simple following rules:
* `+` for append permission.
* `-` for remove permission.
* `=` for copy permission from other roles OR replace the entire old permission by the current given one.

The roles is:
* `u` for owner
* `g` for group
* `o` for other
* `a` for all

Examples:
* Append write permission to `owner` and `group`
    ```bash
        # ug+w shortcut for u+w,g+w
        sudo chmod ug+w file.txt
    ```
* Remove execute permission from `other`
    ```bash
        sudo chmod o-x file.txt
    ```
* Make `owner` has all permissions, `group` has read and write, `other` has only read
    ```bash
        sudo chmod u=wrx,g=wr,o=r file.txt
    ```
* Copy `owner` permissions to the `group`
    ```bash
        sudo chmod g=u file.txt
    ```
* Remove all the permissions from the `other` role
    ```bash
        sudo chmod o=- file.txt
        # or
        sudo chmod o= file.txt
    ```
* Change `example` folder permissions and all its nested contents, with `owner` and `group` all permissions and `other` only read
    ```bash
        sudo chmod -R ug=rwx,o=r example/
    ```

## Add permissions by numbers
You can add permission to any file or folder by the simple following rules:
* `0` for has no permission.
* `1` for execute permission.
* `2` for write permission.
* `4` for read permission.

sum any number combination of the previous numbers to add permission to files and folders.

> With numbers you will replace the entire permissions with the given one, it's act like `=` in characters way with no copy feature.

Examples:
* Add write permission to `owner`, `group` and no permissions for `other`
    ```bash
        sudo chmod 220 file.txt
    ```
* Make `owner` has all permissions, `group` has read and write, `other` has only read
    ```bash
        sudo chmod 764 file.txt
    ```
* Change `example` folder permissions and all its nested contents, with `owner` and `group` all permissions and `other` only read
    ```bash
        sudo chmod -R 774 example/
    ```

## Understanding setuid
`setuid` is a `Unix` access right bit that allow users to run an executable with the permissions of the executable's owner.

`setuid` or `SUID` is a shortcut for `set user ID`, and it's representing as character `s` in `owner` permissions. Like following:
<pre>
-rwsr-xr-x
</pre>

That's mean any executable file with `s` bit can executed with the same `owner execute permission` but only for **current user** that execute the file.

Example:

`/bin/passwd` program that changes users password owned by `root` and its group also `root` group
<pre>
-rwsr-xr-x 1 root root /bin/passwd
</pre>
Which means you should be the `root` user or in `root` group to execute this program.

But because of `setuid` bit which representing by character `s` as you can see, you don't need to be the `root` user or in `root` group to execute this program.
You can execute this program exactly like `root` user but only for **you**, if you try to execute this program for other users it'll give you an error.

To make any executable file flagged with `setuid`
```bash
sudo chmod u+s filename
# or octal
sudo chmod 4775 filename
```

## Understanding setgid
`setgid` is a `Unix` access right bit that make newly created files inherit the same group as the base directory.

`setgid` or `SGID` is a shortcut for `set group ID`, and it's representing as character `s` in `group` permissions. Like following:
<pre>
-rwxr-sr--
</pre>

Example:

`example/` folder owned by `root` and its group is `cto` group
<pre>
drwxrwxr-- 1 root cto example/
</pre>

If user `Ahmed` which is his primary group is `Ahmed` but he also member of `cto` group try to make a new folder `vp` inside `example/` folder,
the result will be like this
<pre>
drwxrwxr-- 1 Ahmed Ahmed vp/
</pre>
As you can see the `vp` group is `Ahmed` which is the primary group for user `Ahmed`

But if `root` user flag `example/` folder with `setgid` bit like this
```bash
sudo chmod g+s example/
# or octal
sudo chmod 2774 example/
```
<pre>
drwxrwsr-- 1 root cto example/
</pre>

And now user `Ahmed` try to create a new folder `vp` or any file inside `example/` folder, it'll inherit `example\` folder group
<pre>
drwxrwxr-- 1 Ahmed cto vp/
</pre>
This is very useful if you wanna every folder or file inside particular folder in the same group, no matter who create them.

## Understanding sticky bit
A user named `torvalds` creates a folder named `videogames` with group `engineers` and add sticky bit to it.
```bash
sudo chmod o+t videogames/
# or octal
sudo chmod 1770 videogames/
```
folder be like this
<pre>
drwxrwx--T 1 torvalds engineers videogames/
</pre>
A user named `torvalds` creates a file named `tekken` under the directory named `videogames`.
<pre>
-rwxr-xr-x 1 torvalds torvalds videogames/tekken
</pre>
A user named `wozniak`, who is also part of the group `engineers`, attempts to delete the file named `tekken` but he cannot, since he is not the owner.

Without `T` sticky bit `wozniak` could have deleted the file, because the directory named `videogames` **allows read and write** by `engineers`.

A default use of this can be seen at the `/tmp` folder.

### More information [here](https://en.wikipedia.org/wiki/Setuid)
