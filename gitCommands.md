* [Git configuration](#git-configuration)
    * [Add/show your confg](#Add/show-your-confg)

# Git configuration:
System
```bash
git config --system
```
User
```bash
git config --global
```
Project
```bash
git config
```
## Add/show your confg:
```bash
git config --global user.name "bla bla bla"
git config --global user.email "bla@bla.bla"
```
To show current confgs.
```bash
git config --list
Or
git config user.name
```
TO show messages on specific editor.
```bash
git config --global core.editor "bla bla bla"
```
TO color terminal.
```bash
git config --global color.ui true
```