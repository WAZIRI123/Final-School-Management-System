
# Final school management system

>This is the full-stack School Management System. By Full stack School Management System i mean that the system includes both the website part or front end part and the backend part or system part. .

![school website](https://user-images.githubusercontent.com/74810402/203506069-20a1a3aa-d476-434d-b445-f7c21f0553b2.PNG)




Final School Management System is a multi-school management system that aims to make school administration and activities a breeze by using the power of the internet and increased connectivity.

## Requirements
* Php 8.1 and above
* Composer 
* Since this project is running laravel 9, we suggest checking out the official requirements [here](https://laravel.com/docs/9.x/upgrade#updating-dependencies)

## Installation Instructions

- Create a database 
- Open the project folder in your IDE
- Copy and paste the .env.example file in the same directory and rename the new .env copy.example to .env 
- In the .env file of the project add your database name
- Install Composer and NodeJs in your machine

- In the terminal in your IDE, run the following commands:

```
    1.  composer install
    2. 	php artisan key:generate
    3. 	php artisan migrate  --seed
    4.  php artisan key:generate
    5.	php artisan serve
```
After running the above commands, you should be able to access the application at http::/localhost or your designated domain name depending on configuration.

## Log in to the application with the following credentials

    **Admin**
       * Email: admin@demo.com
       * Password: password
       
    **Teacher**
       * Email: teacher@demo.com
       * Password: password
       
     **Student**
       * Email: student@demo.com
       * Password: password
       
     **Parent**
       * Email: parent@demo.com
       * Password: password


## Features
### Super Admin
By default super admin can manage all activities in each school, some super admin exclusive features are
* Ability to create, edit and delete schools
" Ability to set school of operation

### Admin
* Ability to manage own school settings
* Ability to create, edit, view and delete class groups in assigned school
* Ability to create, edit, view and delete classes 
* Ability to create, edit, view and delete sections
* Ability to create, edit, view and delete classes
* Ability to create, edit, view and delete subjects
* Ability to create, edit, view and delete academic years
* Ability to set Academic years
* Ability to admit students, view student profiles, edit student profile, print student profile and delete student
* Ability to create teachers, edit teacher profile and delete teacher
* Ability to create, edit, manage, view and delete timetables
* Ability to create, edit, view and delete sylabii
* Ability to create, edit, view and delete semester
* Ability to set own school academic year and semester

### Teachers
* Ability to create, edit, view and delete sylabii
* Ability to create, edit, manage, view and delete timetables

This project was highly inspired by yungifez/skuul

Do you like the current state of this project?, you can support me or hire me for work
