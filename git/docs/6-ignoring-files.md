# Ignoring Files

* [Git ignore](#git-ignore)
* [Global ignoring](#global-ignoring)
* [Ignore tracked](#ignore-tracked)
* [Track empty dirs](#track-empty-dirs)

## Git ignore
* To ignore some files we won't track them, we need to create (.gitignore) file.
* .gitignore Will not ignore the files already tracked, the only new one.
* We can use basic regular expression to ignore files like \*,?,[0-9]...etc.
* We can also negate expression with !, for example ignore all php file (\*.php) but not index.php (!index.php).
* Ignore dir by put / in the end.
* Put comments by using # symbol.

## Global ignoring
You can choose which files you want ignore anywhere by following:
```bash
git config --global core.excludesfile ~/.gitignore_global
```
Now put whatever you want inside gitignore_global file and it'll be ignored everywhere.

## Ignore tracked
Git not ignore tracked files, so we need to tell git to stop track those files, we have some scenarios here:
* Delete those files so git will not track them anymore.
```bash
git rm file_name.txt
```
* But what if we don't want delete those files, just we want untrack them!, now we need one more option.
```bash
git rm --cached file_name.txt
```
This command will remove files from staging index so git will ignore them in the future.

> After using last command you will find those files staged as deleted files, that's ok, that's how git stop tracking files, and also other contributors will understand that git delete those files so it'll not track them anymore. <br>
But all files on working dir and repo will still there.

## Track empty dirs
Git is designed to be a file-tracking system, so it'll not track those dirs they not have any files at all.

If you want git track empty dirs you need cheat on it by put any kind of files inside it to let git track this dir, and <code>.gitkeep</code> makes the trick.
