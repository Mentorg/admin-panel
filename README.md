#  Admin Panel

Simple admin panel app created with Laravel.

## Table of Contents ##

* [Short Description](#short-description)
* [Installation Guide](#installation-guide)

## Short Description

Admin Panel will assist you to manage the content of your website, including blog posts, users, and files.

## Installation Guide

### After cloning, in order to run this app, follow  the instructions below.

First, open a terminal where the app content is stored (depending on the server you use, the app will be stored under different directory names, e.g. for XAMPP: 'C:\xampp\htdocs\admin-panel', for Laragon: 'C:\laragon\www\admin-panel') and create the database which will contain all application's tables by typing the following command.

```
$ php artisan db:create
```

Define application's database schema.

```
$ php artisan migrate
```

Execute seeders to seed the database.

```
php artisan db:seed --class=PermissionTableSeeder
php artisan db:seed --class=CreateAdminUserSeeder
```

Create symbolic links in order to provide files' download functionality.

```
$ php artisan storage:link
```

In order to test this app, you can login with these credentials:

Email: test@admin.com

Password: 123456
