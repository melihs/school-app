# school app

## Libraries in the Project
- tymon/jwt-auth@1.0.0: https://github.com/tymondesigns/jwt-auth
- laravel-cors https://github.com/barryvdh/laravel-cors
## All Endpoints
```
POST      | api/login        
POST      | api/register    
GET|HEAD  | api/users        
POST      | api/users        
GET|HEAD  | api/users/me     
PUT|PATCH | api/users/{user}  
                                                                                             
```

### Getting Started

### Installation (Manual)
```console
$ git clone https://github.com/melihs/school-app.git 
$ cd e-commerce-api && composer install
$ cp .env.example .env
- create new database and modifed your .env
$ php artisan migrate:fresh --seed
$ php artisan passport:install
$ php artisan key:generate 
$ php artisan serve
```

