<p align="center">
    <a href="https://github.com/Myudhaap/api-management-product" target="_blank">
        <img src="resources\assets\home.png" width="400" alt="Laravel Logo">
    </a>
</p>

## About API Management Product

API Management Product is a RESTful API developed using the Laravel Framework, designed to assist in managing products. This API includes several features, including:

- Authentication with JWT (Login).
- Management Category Product
- Management Product

## Build With
- [Firebase Storage](https://firebase.google.com/?hl=id)
- [PHP 8](https://www.php.net/releases/8.0/en.php)
- [MySQL](https://www.mysql.com/)
- [Postman](https://www.postman.com/)
- [JWT Token](https://jwt.io/)

## Prerequisites

This is an example of how to list things you need to use the software and how to install them.

- WebStorm or another Code Editor
- DBeaver or another Mysql Management
- Postman or another API Testing
- Firebase account

## Installation
1. Clone the repo
   ```sh
    git clone https://github.com/Myudhaap/api-koperasi
   ```
2. Setup .env for example

   ```properties
    APP_NAME=Laravel
    APP_ENV=local
    APP_KEY=base64:e20VHpsEkXeaFseYEjD1E+QKOJguZnw3+4Lk4wu35r4=
    APP_DEBUG=true
    APP_URL=http://localhost

    LOG_CHANNEL=stack
    LOG_DEPRECATIONS_CHANNEL=null
    LOG_LEVEL=debug

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=db_api_management_product
    DB_USERNAME=root
    DB_PASSWORD=root
    
    BROADCAST_DRIVER=log
    CACHE_DRIVER=file
    FILESYSTEM_DISK=local
    QUEUE_CONNECTION=sync
    SESSION_DRIVER=file
    SESSION_LIFETIME=120
    
    MEMCACHED_HOST=127.0.0.1
    
    REDIS_HOST=127.0.0.1
    REDIS_PASSWORD=null
    REDIS_PORT=6379
    
    MAIL_MAILER=smtp
    MAIL_HOST=mailpit
    MAIL_PORT=1025
    MAIL_USERNAME=null
    MAIL_PASSWORD=null
    MAIL_ENCRYPTION=null
    MAIL_FROM_ADDRESS="hello@example.com"
    MAIL_FROM_NAME="${APP_NAME}"
    
    AWS_ACCESS_KEY_ID=
    AWS_SECRET_ACCESS_KEY=
    AWS_DEFAULT_REGION=us-east-1
    AWS_BUCKET=
    AWS_USE_PATH_STYLE_ENDPOINT=false
    
    PUSHER_APP_ID=
    PUSHER_APP_KEY=
    PUSHER_APP_SECRET=
    PUSHER_HOST=
    PUSHER_PORT=443
    PUSHER_SCHEME=https
    PUSHER_APP_CLUSTER=mt1
    
    VITE_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
    VITE_PUSHER_HOST="${PUSHER_HOST}"
    VITE_PUSHER_PORT="${PUSHER_PORT}"
    VITE_PUSHER_SCHEME="${PUSHER_SCHEME}"
    VITE_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
    
    JWT_SECRET=t08zF4rp8Snp9e6ip2PraISi0Um1JjZfv7V6Jg9cZtGUa0DPXpxyl9mZYU0PwWGa
   ```
3. Install dependency laravel
    ```properties
    composer install
    ```

4. Setup firebase json on 'storage/firebase_credential.json'


5. Run program
    ```properties
    php artisan serve
    ```

## API Documentation

Postman : https://documenter.getpostman.com/view/28401427/2sA3dxDBgg

Link File Postman and Environment : https://drive.google.com/drive/folders/1FvPjpzGsHwNqjXKljHsnoobczzbaKlC2?usp=sharing

## Contact

Muhammad Yudha Adi Pratama -
[@Intagram](https://instagram.com/myudha_ap) -
[@Linkedin](https://www.linkedin.com/in/muhammad-yudha-adi-pratama-116433177/)


Project Link API Koperasi: [https://github.com/Myudhaap/api-management-product](https://github.com/Myudhaap/api-management-product)
