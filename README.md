# Pharmacy System

# Note :

    Diagram And Postman Collection Link In Public Path.

# To run this project on your locale :-

1- Clone Repository : 

    git clone https://github.com/YOUSSEIFJOO/pharamcy-system

2- Run this command : 

    composer install

3- Run this command :

    php artisan key:generate

4- Make a database In Your Locale Database.

5- Add values of keys in .env file :

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=The name of database you created on locale
    DB_USERNAME=The username of database on your locale
    DB_PASSWORD=The password of database on your locale

6- Run this command :

    php artisan migrate --seed

7- Run this command :
    
    php artisan serve

8- Test Apis On Postman.
