For each person and each project will bring a different code structure, each person likes and has their own style, this project does not help you to create really good controllers, but it can be a foundation. so you can create your own better versions by making changes in the templates folder

## Configuration

Install via composer ([packagist](https://packagist.org/packages/trannguyenhan/autogencontroller)): 

```bash
composer require trannguyenhan/autogencontroller
```

## Usage

Gen controller and repository with command: 

```bash
php artisan tnhgen:controller
```

If your controller extends orther Class without Controller or your repository extends other Class without BaseRepository add parameter when gen controller:

```bash
php artisan tnhgen:controller --basecontroller YourController --baserepository YourRepository
```

If you want assign model corresponding with controller use under parameter: 

```bash
php artisan tnhgen:controller --model YourModel
```

If controller within a namespace, add parameter: 

```bash
php artisan tnhgen:controller --namespace YourNamespace
```

and of course, you can combine all the above parameters at once. If you want gen model from MySQL database, PostgreSQL and SQLite, you can follow repository [https://github.com/reliese/laravel](https://github.com/reliese/laravel)
