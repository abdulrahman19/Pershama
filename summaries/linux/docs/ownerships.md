# Manage ownerships

* [Switch between users](#switch-between-users)
* [Show user groups](#show-user-groups)
* [Show group members](#show-group-members)
* [Add user to group](#add-user-to-group)
* [Edit user groups](#edit-user-groups)
* [Remove user from groups](#remove-user-from-groups)
* [Change resources owner and group](#change-resources-owner-and-group)

## Switch between users
To switch between users use the following command
```bash
su - # to login as root and place in root home
su # to login as root and place in last path before login
su - username # to login as username and place in username home
su username # to login as username and place in last path before login
```

## Show user groups
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

## Show group members
```bash
cat /etc/group | grep groupname
```
Last block will carry group members names separated by comma.

## Add user to group
Append the user to supplementary groups
```bash
    # -aG = --append --groups
    sudo usermod -aG group1,group2 username

    # to avoid logout use
    su - ${USER}
    # then enter your password
```
Create a new user and assign a group in one command
```bash
    sudo useradd -G group1,group2 username
```

# Edit user groups
Edit user primary group
```bash
sudo usermod -g groupname username
```
Remove user from all his currently supplementary groups and add him to new supplementary groups in one command
```bash
sudo usermod -G new-group username
```

## Remove user from groups
Use the following command to remove user from a group
```bash
sudo gpasswd -d username groupname
```
Or by `usermod` as the previous example but that will need all groups names except the one you need to remove.
```bash
sudo usermod -G group1,group2 username
```

## Change resources owner
You can change the owner of any resources (files/folders) by the following command
```bash
sudo chown username resource-name
```

You can change the owner of any resources (files/folders) by the following command
```bash
sudo chgrp groupname resource-name
# or
sudo chown :groupname resource-name
```

You can also change owner and group in one command
```bash
sudo chown username:groupname resource-name
```

Use `-R` with folder if you want to change also all nested files and folders ownerships
```bash
sudo chown -R username:groupname resource-name
```
