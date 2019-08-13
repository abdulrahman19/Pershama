# Installing Git

* [Git configuration](#git-configuration)
* [Add/show your confg](#addshow-your-confg)
* [Git help](#git-help)

## Git configuration:
You can configure your git setting by using <code>config</code> command, and you can do it on three levels.

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
# Or
git config user.name
```
To show messages on specific editor.
```bash
git config --global core.editor "bla bla bla"
```
To color terminal.
```bash
git config --global color.ui true
```
You can make aliases to your git commands
```bash
git config --global alias.logg "log --oneline --graph --all --decorate --abbrev-commit"
```
Now when you write <code>git logg</code> it'll active all options above, and no need to write them again and again.

## Git help:
```bash
git help
```
To show specific command manual.
```bash
git help log
```
