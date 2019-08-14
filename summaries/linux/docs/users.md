# Manage users

* [Add user](#add-user)
* [Show user information](#show-user-information)
* [Edit user](#edit-user)
* [Delete user](#delete-user)

## Add user
To add a new user account, you can run the following command as `root`.
```bash
sudo adduser username
```
Fill the user information and that is it.

## Show user information
For brief information about user using `id` command.
```bash
id username
```
To show all user groups (primary & supplementary)
```bash
id -nG username
# or
groups username
```
To show only primary group for the user
```bash
id -ng username
```
> The user’s login process and files and folders the user creates will be assigned to the `primary group`.

Or show show all information in `/etc/passwd` file.
```bash
cat /etc/passwd | grep username
```
This file save users in the following pattern
```bash
[username]:[x]:[UID]:[GID]:[Comment]:[Home directory]:[Default shell]
```
* `x` for encrypted password saved in `/etc/shadow` file.
* `UID` User Identification.
* `GID` Group Identification.

## Edit user
You can edit user information using the `usermod` command, whose basic syntax as follows:
```bash
usermod [options] [username]
```
* Setting the expiry date for an account
    ```bash
        sudo usermod --expiredate 2020-10-30 username
    ```
* Append the user to supplementary groups
    ```bash
        # -aG = --append --groups
        sudo usermod -aG group1,group2 username

        # to avoid logout use
        su - ${USER}
        # then enter your password
    ```
* Changing the default location of the user’s home directory
    ```bash
        # --home = -d
        sudo usermod --home /home/path username
    ```
* Changing the shell the user will use by default
    ```bash
        # --shell = -s
        sudo usermod --shell /bin/sh username
    ```
* Disabling account by locking password
    ```bash
        # --lock = -L
        sudo usermod --lock username
    ```
* Unlocking user password
    ```bash
        # --unlock = -U
        sudo usermod --unlock username
    ```

for changing password you can use the following command
```bash
sudo passwd username
```

## Delete user
For deleting user use the following command.
```bash
sudo userdel username
```
