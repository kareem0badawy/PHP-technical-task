# Installation

Use the [composer](https://getcomposer.org/) to install composer.

```bash
composer install
```

## Usage

```php
php artisan key:generate

# Database migrate
php artisan migrate

# Create dummy data in the database
php artisan db:seed

# Info : "This command takes the product id and returns the cheapest 5 pharmacies"
php artisan products:search-cheapest 22
```