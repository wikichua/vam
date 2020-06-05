# Vue Admin Manager (CRUD generator) - Basic (TO BE ENHANCED)

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Build Status][ico-travis]][link-travis]
[![StyleCI][ico-styleci]][link-styleci]

## Requirements

1. A new Laravel related project (completedly new)
2. Composer require laravel/ui (no need installing the auth scaffolding)
3. A working NPM in your machine
4. Knowledge in Vue Js, Bootstrap-Vue, Axios, Sass, & all Laravel stuffs...

## Installation

Setup new Laravel project in terminal

``` bash
$ laravel new **project**
```

In your .env file

``` env
APP_URL=https://**project.test**
DB_DATABASE=**project_table**
```

Back to your terminal

``` bash
$ composer require wikichua/vam dev-master
$ composer require laravel/ui
$ php artisan vendor:publish --tag=vam.install --force
$ php artisan migrate
$ php artisan ziggy:generate
$ npm install && npm run dev
```

> php artisan vendor:publish --tag=vam.install --force

You will see this..

``` bash
Copied Directory [/vendor/wikichua/vam/resources/js] To [/resources/js]
Copied Directory [/vendor/wikichua/vam/resources/sass] To [/resources/sass]
Copied File [/vendor/wikichua/vam/package.json] To [/package.json]
Copied File [/vendor/wikichua/vam/webpack.mix.js] To [/webpack.mix.js]
```

Scary but yeah, it does overwrited if you already had modified those in your files (Suggest to backup those before publishing with --force):

1. resources/js/app.js
1. resources/js/bootstrap.js
1. webpack.mix.js

In your app/User.php

``` php
class User extends \Wikichua\VAM\Models\User
{
    use Notifiable;

    use \Wikichua\VAM\Http\Traits\AdminUser;
    use \Wikichua\VAM\Http\Traits\ModelScopes;
    use \Wikichua\VAM\Http\Traits\DynamicFillable;
    use \Wikichua\VAM\Http\Traits\UserTimezone;
```

This is how I normall do

``` bash
art vendor:publish --tag=vam.install --force && art ziggy:generate && npm run watch-poll
```

## Usage

### Creating new module

``` bash
$ php artisan vam:config <ModelName>
$ php artisan vam:make <ModelName>
$ php artisan ziggy:generate
$ npm install && npm run dev
```

This is how I normall do

``` bash
art ziggy:generate && npm run watch-poll
```

#### Config

You may get the sample of config file once vam:config called. 
Do advise if that's confusing, I will then make a wiki.md for that.
In case of you getting "Config file is not ready". 
This indicating your config generated from vam:config is still work in progress.

``` php
    'ready' => false, // set true when you are ready to generate CRUD
```

Once you have done your config, you can switch that to true. Of course after vam:make is done, this section will be turned to true automatically.
This could prevent you from accidentally run vam:make again.

### Current Edition

1. Activity Logging
1. Preset Authentication (exactly from Laravel scaffolding)
1. Permission & Role (Authorization)
1. Settings configuration
1. Basic Users' Management
1. Profile & Password Update
1. CRUD generator (create components for CRUD, migrations, forms, controller, model, etc...)
    - Datatable listing
        - Able to delete row record (Authorization Gate included)
    - Create and Edit form
        - Text, File, Textarea, Date or Time Picker, Select, Checkbox, Radio and etc...
1. Swal and Toast integrated
1. Select, Radio or Checkbox options will be added to settings table during migration
1. Select, Radio or Checkbox model options will be generated codes in controller and both create and edit component. 

### Todo

1. Additional fields to support
	- Editor
	- ~Select, Radio & Checkbox fetch options from Model~
    - Select2 or Datalist from Bootstrap-vue
1. Setting update push notification
1. ...still thinking...

## Security

If you discover any security related issues, please email wikichua@gmail.com instead of using the issue tracker.

## Credits

- [Wiki Chua][link-author]
- [All Contributors][link-contributors]

## License

license. Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/wikichua/vam.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/wikichua/vam.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/wikichua/vam/master.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/12345678/shield

[link-packagist]: https://packagist.org/packages/wikichua/vam
[link-downloads]: https://packagist.org/packages/wikichua/vam
[link-travis]: https://travis-ci.org/wikichua/vam
[link-styleci]: https://styleci.io/repos/12345678
[link-author]: https://github.com/wikichua
[link-contributors]: ../../contributors
