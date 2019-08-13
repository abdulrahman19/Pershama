# Navigating the Commit Tree

* [Reference commits](#reference-commits)
* [Tree listings](#tree-listings)
* [Commit log](#commit-log)
* [View commits](#view-commits)
* [Comparing commits](#comparing-commits)

## Reference commits
Now we need to know a new concept on git called Tree-ish, we know about tree, tree is structure file in git repo. <br>
Tree-ish is something that references part of the tree, it like your directory in your file system. <br>
In another word Tree-ish is a reference for a commit.

Tree-ish can be:
* Full SHA-1 hash.
* Short SHA-1 hash.
* HEAD pointer.
* Branch reference, tag reference.
* Ancestry
    * parent commit
        - HEAD^, 4rt283ff^, master^
        - HEAD\~1, HEAD\~
    * grandparent commit
        - HEAD^^, 4rt283ff^^, master^^
        - HEAD~2
    * great-grandparent commit
        - HEAD^^^, 4rt283ff^^^, master^^^
        - HEAD~3

## Tree listings
In Linux file system you can use command to list dir content (dir tree)
```bash
ls -al
```
And also you can use Tree-ish to do same thing, list commit content
```bash
git ls-tree HEAD
# Now I use HEAD to show HEAD list, you can use whatever you want to target the point you want.
git ls-tree HEAD dir/
# We can list specific dir content from the snapshot.
git ls-tree HEAD^ dir/
# Now we can list content of previous snapshot on dir/ folder.
```
When you list commit content you will find two kind of content <code>blob</code> and <code>tree</code>, <code>blob</code> is a file and <code>tree</code> is a dir, and every file or dir has a unique SHA.

## View commits
To show commit changes
```bash
git show 214ds33
```
We can show short format
```bash
git show --format=oneline HEAD
```
<code>Show</code> option can do the same like ls-tree command, it can show <code>blob</code>, <code>tree</code>, <code>tag</code> or <code>commit</code> content.
```bash
git show 211rr323
# this 211rr323 SHA can be for dir or file
# you can get this SHA by use ls-tree command
```

## Comparing commits
We can compare between working dir and old commit.
```bash
git diff 211rr323
```
And we can be more specific and show difference on one file.
```bash
git diff 211rr323 file_name.txt
```
You can compare between two commits.
```bash
git diff 211rr323..3432fddsw
# and for specific file
git diff 211rr323..3432fddsw file_name.txt
```
> We can use also Tree-ish instead of commit SHA.

We can use several options with diff command.

For example we can see a brief about the changes between HEAD and old commit.
```bash
git diff --stat --summary 211rr323..HEAD
```
And we can show the deferent and ignore if someone change one white space to two spaces.
```bash
git diff --ignore-space-change 211rr323..HEAD
# shortcut
git diff -b 211rr323..HEAD
```
Or ignore all white spaces.
```bash
git diff --ignore-all-space 211rr323..HEAD
# shortcut
git diff -w 211rr323..HEAD
```
You can only colored the changes words by following:
```bash
git diff --color-words file_name.txt
```

And you can do the (word wrap) on a terminal when you use <code>git diff</code> command by following: <br>
Press <code>minus</code> then <code>shift+s</code> then <code>return key</code>, do the same for remove word wrap. <br>
