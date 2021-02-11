# Laravel Model Login

Simply collect login attempt.

## Installation

Install package via composer:

```bash
composer require fabpl/laravel-model-login
```

Run install artisan command:

```bash
php artisan model-login:install
```

Optionally you can publish `config` files with:

```bash
php artisan model-login:publish
```

Migrate the `logins` table:

```bash
php artisan migrate
```

## Usage

Add the `HasLogins` trait to your user model.

```php
use Fabpl\ModelLogin\HasLogins;

class User extends Authenticatable
{
    use HasLogins;
}
```

### Retrieving logins

You can get the logins collections:

```php
$userModel->logins;
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md).

### Security

If you discover any security related issues, please email planchettefabrice _at_ hotmail.com instead of using the issue tracker.

## Credits

- [Fabrice Planchette](https://fabpl.github.io)
