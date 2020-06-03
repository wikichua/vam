# Vue Admin Manager (CRUD generator) - Basic (TO BE ENHANCED)

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Build Status][ico-travis]][link-travis]
[![StyleCI][ico-styleci]][link-styleci]

## Requirements

1. A new Laravel related project (completedly new)
2. Composer require laravel/ui (no need installing the auth scalfolding)
3. A working NPM in your machine
4. Knowledge in Vue Js, Bootstrap-Vue, Axios, Sass, & all Laravel stuffs...

## Installation

``` bash
$ composer require wikichua/vam dev-master
$ php artisan vendor:publish --tag=vam.install --force
$ php artisan migrate
$ php artisan ziggy:generate
$ npm install && npm run dev
```
## Usage

### Creating new module

```bash
$ php artisan vam:config <ModelName>
$ php artisan vam:make <ModelName>
```

### Current Edition

1. Activity Logging
2. Preset Authentication (exactly from Laravel scalfolding)
3. Permission & Role (Authorization)
4. Settings configuration
5. Basic Users' Management
6. CRUD generator (create components for CRUD, migrations, forms, controller, model, etc...)

### Todo

1. Additional fields to support
	- ~File upload~
	- ~Datetime picker~
	- ~Date or Time picker~
	- Select, Radio & Checkbox fetch options from Model
2. Profile View & Update
3. Swal alert message
4. Setting update push notification
5. (still thinking...)

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
