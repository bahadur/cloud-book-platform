## About Cloud Book Writer Platform

This application is build on Laravel 10


## Installation

Steps to install this application

```
composer install
npm install
npm run dev

php artisan migrate
php artisan db:seed
```

This application has the seeder which creates author and collaborator users with credentials are below:

```
AUTHOR
email: author@domain.com
password: 12345678

COLLABORATOR
email: collaborator@domain.com
password: 12345678
```


## Installed Composer packages

This application uses the laravel package [spatie permissions](https://spatie.be/) for roles and permission. The RoleSeeder consists of two roles called 'author', and 'collaborator' 



## Accessing the application

Once installation is complete, you can access the application in the browser. If you configure this app in your local machine, then it can be access with localhost.
You can login with the author or collaborator users, or you can register new user.

## Assigning or Revoking user roles.
There are two users (Author and Collaborator) which is available on installation of this application. Author has the role which has the permission to manage users.
Like assigning role or revoking to user.
The user management can be access with the route /users.

## Role and Permission
There are two roles in this application called.
- AUTHOR
- COLLABORATOR

## AUTHOR
Author role has the permission to manage users, create and update folder and files.
- CREATE_FOLDER
- UPDATE_FOLDER
- DELETE_FOLDER
- CREATE_FILE
- UPDATE_FILE
- DELETE_FILE
- GRANT_ROLE
- REVOKE_ROLE
- VIEW_USERS

# COLLABORATOR
Collaborator role has limited permission. This role can not create folder or file and can not manage users.
- UPDATE_FOLDER
- DELETE_FOLDER
- UPDATE_FILE
- DELETE_FILE


