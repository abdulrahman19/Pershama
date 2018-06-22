# Git Tags

* [What and why tags?](#what-and-why-tags)
* [Add tags](#add-tags)
* [Show tags](#show-tags)
* [Push tags](#push-tags)
* [Delete tags](#delete-tags)
* [Checkout tag](#checkout-tag)

## What and why tags?
Tags refers to creating specific point in history to make release points.

## Add tags
To add a tag for HEAD commit.
```bash
git tag tag_name
```
To add tag for older commit
```bash
git tag tag_name 324dsa
```
To create annotated tags (description for tags)
```bash
git tag -a tag_name -m "bla bla bla"
```

## Show tags
To show all tags
```bash
git tag
```
To show list of tags by using part of there name
```bash
git tag -l "v1.*"
```
To show specific tag details
```bash
git show tag_name
```

## Push tags
To push all tags
```bash
git push --tags
```
To push specific tag
```bash
git push origin tag_name
```

## Delete tags
To delete tag locally
```bash
git tag -d tag_name
# or multi delete
git tag -d tag_name tag_name2 tag_name3
```
To delete origin tag
```bash
git push origin -d tag_name
# or
git push origin :tag_name
```

## Checkout tag
To checkout specific tag
```bash
git checkout tag_name
# or on another branch
git checkout -b branch_name tag_name
```
