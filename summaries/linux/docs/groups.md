# Manage groups

* [Add group](#add-group)
* [Show group information](#show-group-information)
* [Edit group](#edit-group)
* [Delete group](#delete-group)

## Add group
To add a new group, you can run the following command as `root`.
```bash
sudo groupadd groupname
```

## Show group information
You can show group information using `getent` command.
```bash
getent group groupname
```
Or show show the information in `/etc/group` file.
```bash
cat /etc/group | grep groupname
```
This file save users in the following pattern
```bash
[Group name]:[Group password]:[GID]:[Group members]
```
* An `x` in `[Group password]` indicates group passwords are not being used.
* `GID` Group Identification.

## Edit group
You can edit group information using the `groupmod` command, whose basic syntax as follows:
```bash
groupmod [options] [username]
```
* Change group name
    ```bash
        # -n = --new-name
        sudo groupmod --new-name new-groupname old-groupname
    ```
* Change GID
    ```bash
        # -g = --gid
        sudo groupmod --gid 4000 groupname
    ```
* Add password to group - _not recommended_
    ```bash
        # -p = --password
        sudo groupmod --password passwd groupname
    ```

## Delete group
For deleting group use the following command.
```bash
sudo groupdel groupname
```
