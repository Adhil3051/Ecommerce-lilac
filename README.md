# Lilac E-Commerce
## Installation
1. Clone the repository:
2. cd Ecommerce-lilac
3. composer install
4. npm install
5. cp .env.example .env

## for mysql
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=lilac_ecommerce
DB_USERNAME=root
DB_PASSWORD=

## for sqlite
DB_CONNECTION=sqlite
DB_DATABASE=./database/database.sqlite
##
touch database/database.sqlite

6. php artisan key:generate
7. php artisan migrate
8. php artisan db:seed
9. php artisan db:seed --class=UserSeeder
10. php artisan serve
11. npm run dev

### Admin Login
name : admin
password: 123456
### User Login
name : user1
password : 123456


