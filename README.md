# Library

Library is a simple tool for managing a book library. It utilizes Laravel web api, which is consumed by Vue.js client.

# Installation

## PHP
This project requires PHP installed. Please refer to the official [PHP documentation](https://www.php.net/manual/en/install.php).

## Composer, Yarn/NPM, .env, Vue
Before starting the Laravel project, it is important to be noted that Laravel uses [Composer](https://getcomposer.org) 
for managing its packages. Composer should be installed before working with the application.
For loading all needed packages, inside the server folder, run in the terminal the following command.  
``` composer update ```
All installed packages are listed in the composer.lock file.
Laravel also uses Javascript packages that are listed in the package.json file. In order to install them run  
  
``` yarn install ``` for Yarn  
or  
``` npm install ``` for NPM.  
  
Currently, the project lacks the essential .env file. Luckily .env.example is provided with base database configuration. In order 
to use it, copy the .env.example file and remove the '.example' part from the name of the file. Now we have .env file. All 
that is left is to generate APP_KEY. Run ``` php artisan key:generate ``` in the terminal. The APP_KEY configuration in the .env
file now should have a value assigned to it.  
  
To install all dependencies in the client, open the terminal in the client folder and run  
``` yarn install ``` for Yarn  
or  
``` npm install ``` for NPM.  

## MongoDB
The project uses MongoDB. For [MongoDB installation](https://docs.mongodb.com/manual/installation/) and for
adding [MongoDB extension to PHP](https://www.php.net/manual/en/mongodb.installation.php) please refer to the official documentation.
The [laravel-mongodb](https://github.com/jenssegers/laravel-mongodb) library is used in order to use Mongodb in Laravel. 
Database configuration should be provided in the .env file or in the config/database.php file. 
For more details please refer to the [laravel-mongodb](https://github.com/jenssegers/laravel-mongodb) documentation.

## Migrating and seeding the database
In order to run the migrations open the terminal in the server folder and run  
``` php artisan migrate ```  
This command will create new MongoDB database named 'Library' and will create 'books' collection inside it.
To populate the database with data run  
``` php artisan db:seed ```  
  
  
# Starting the application
To start the PHP server open the terminal inside the server folder and run   
``` php artisan serve ```  
To start the Vue client open the terminal inside the client folder and run  
``` yarn serve ``` or ``` npm run serve ```  
The application currently starts at 
``` http://localhost:8080 ```  
  
  
# Functionality  
## Books listing
When the application loads, all books are listed 20 per page. The books can be filtered by Title or Author and can be sorted by Title, Author and Price.
## Book manipulation
Books can be edited, added and deleted. For creation and edit all fields are required. When the user enters invalid data, error 
messages are displayed on the screen and the forms are not submitted to the server.
## Possible improvements
The application can be upgraded by adding authorization. The authorization can provide roles with different access rights and can prevent users without privileged role to edit and add books. 
The application will utilize stateless authentication with jwt and refresh tokens to allow authorization and authentication between the client and web api.

# Used tools
[PHP 7.3.9](https://www.php.net/)  
[Laravel 6.0](https://laravel.com/)  
[Vue.js 2.6.10](https://vuejs.org/)  
[MongoDB 4.2.0](https://www.mongodb.com/)  
[laravel-mongodb](https://github.com/jenssegers/laravel-mongodb)
