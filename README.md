# Atomic Panel

![atomic](http://laravel-atomic.mustafakhaled.com/assets/img/panel.png)


# 🚀 Documentation
Atomic Panel Full Documentation [here](http://laravel-atomic.mustafakhaled.com)

# 💪 Support me
Support me in [Patreon](http://patreon.com/mustafakhaled) to help me keep going


## 🔥 Getting Started
Atomic Panel is a beautifully designed administration panel for Laravel. To make you the most productive developer in the galaxy and give your the opportunity to lead the future.


## Requirements

* PHP: `^7.0`
* Laravel: `^5.5`


## Installation

Require this package in the `composer.json` of your Laravel project. This will download the package.

```
composer require mustafakhaleddev/laravel-atomic
```

Install AtomicPanel
```
php artisan atomic:install
```

Add the ServiceProvider in `config/app.php`

```php
'providers' => [
    /*
     * Package Service Providers...
     */
     App\Providers\AtomicServiceProvider::class,
]
```

Published Files with installation

```
-app
   -Providers
     -AtomicServiceProvider.php
__________________________
-config
     -AtomicPanel.php
__________________________
-public
     -vendor
       -atomic
__________________________
-resources
     -views
        -vendor
          -atomic
__________________________

```
#### AtomicPanel
to make admin user
```php
php artisan atomic:user
```
then open `https://yourwebsite.domain/atomic`

### Authorizing Atomic
Within your `app/Providers/AtomicServiceProvider.php` file, there is a gate method. This authorization gate controls access to Atomic in non-local environments. By default, any user can access the Atomic Panel when the current application environment is local. You are free to modify this gate as needed to restrict access to your Atomic installation: 
```php
    /**
     * Register the Atomic gate.
     *
     * This gate determines who can access Atomic in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewAtomic', function ($user) {
            return in_array($user->email, [
                'atomic@mustafakhaled.com'
            ]);
        });
    }
```
## Usage

Atomic Panel is the best curd. it works with Laravel Models.
If you don`t want to use laravel models so you can create your own pages.

## ⏰ 3 steps for best curd 

### ☝ Step 1
Include `AtomicModel` trait in your model
```php
<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use MustafaKhaled\AtomicPanel\AtomicModel;

class MyModel extends Model
{
    use AtomicModel;
}
```

### ☝ Step 2
Override `AtomicFields()` method in model
```php
<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use MustafaKhaled\AtomicPanel\AtomicModel;

class MyModel extends Model
{
     use AtomicModel;
     
     public static function AtomicFields()
     {
          return [];   
     }
}
```
### ☝ Step 3
Register your curd fields
```php
<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use MustafaKhaled\AtomicPanel\AtomicModel;
use MustafaKhaled\AtomicPanel\Fields\ID;
use MustafaKhaled\AtomicPanel\Fields\Text;
use MustafaKhaled\AtomicPanel\Fields\Trix;

class MyModel extends Model
{
     use AtomicModel;
     
     public static function AtomicFields()
     {
          return [
            ID::make('id', 'id'),
            Text::make('Title', 'title'),
            Trix::make('Content', 'content'),
         ];
     }
}
```


## License

[MIT](LICENSE) © [Mustafa Khaled](https://mustafakhaled.com)
