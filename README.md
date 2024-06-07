# Wallet Application
This is a simple wallet system with functionality to credit and debit a users wallet

## Setup Instructions

1. Clone the repository:
```sh
git clone https://github.com/favtechbro/wallet-application.git
```

2. Install dependencies
```sh
composer install
```

3. Create a .env file and past the content of .env.example in it

4. Run migration
```sh
php artisan migrate
```

5. Seed database
```sh
php artisan db:seed
```

6. Run the application
```sh
php artisan serve
```

## API Documentation
The api for this application is documented using postman. Find APIs at 
```sh
https://documenter.getpostman.com/view/12177190/2sA3XJmQhx
```

## Admin Dashboard
To access the admin dashbaord, enter the following url in your browser
```sh
http://127.0.0.1:8000/dashboard
```
Login with the following details when prompted to log in
```sh
email: admin@test.com
password: Password+1
```