# DOCUMENTATION SERVICES API REST FOR XOOK

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Total Downloads][ico-downloads]][link-downloads]

Based on https://github.com/XookGT/API

## About

The `API REST FULL` package allows you to send [SIMbit Company](http://www.simbitgt.com/)
headers with Laravel middleware configuration.

If you want to have have a global overview of CORS workflow, you can  browse
this [image](http://www.html5rocks.com/static/images/cors_server_flowchart.png).

## Features

* Handles CORS pre-flight OPTIONS requests
* Adds CORS headers to your responses

## AUTHENTICATION
>**Method:** POST

>**Request:**  'email' => 'required|email' An email must comply with the regular email address 
			   'password' => 'required' minium 6 chars.

>**URL:** 		`http://xook.com.gt:88/api/authenticate`

>**Reponse:**	If the credentials are correct, the system will debug an authentication token.

else
				`invalid_credentials` whit code 401

else 		
				`If the server does not respond`  `could_not_create_token` whit code 500.

				
## METHODS FOR CATEGORIES

### Create new Category

> **Method:** POST

> **Request:**  'name' => 'required|unique:categories',
                
                `http://xook.com.gt:9080/api/categorie`

> **Response:** If the category has been successfully added a message like the following is restored:

                `Successfull!!!. The ID for the new Categorie is 5` whit code 200

else

                `It has ocurred an error` whit code 500.



### Search Category by Name

> **Method:** GET

> **Request:** Include categorie name on the URL, for example:  `http://xook.com.gt:9080/api/categorie-name/Matematicas`

> **Response:** This method return the objet JSON whit the information of the course, for example:

```php
{
	"id": 1,
	"name": "Matematicas",
	"starts": "5",
	"rank": "0"
}
```

### Show All The Categories
> **Method:** GET

> **Request:** This method no require params, only call de method, for example:  `http://xook.com.gt:9080/api/categorie-all`

> **Response:** This method return the objet JSON whit the information of all Categories, for example:

```php
[{
	"id": 1,
	"name": "Matematicas",
	"starts": "5",
	"rank": "0"
}, {
	"id": 2,
	"name": "Fisica",
	"starts": "5",
	"rank": "0"
}, {
	"id": 3,
	"name": "Musica",
	"starts": "5",
	"rank": "0"
}, {
	"id": 4,
	"name": "Ingenieira Economica",
	"starts": "5",
	"rank": "0"
}, {
	"id": 5,
	"name": "Lenguajes Formales y Compiladores",
	"starts": "5",
	"rank": "0"
}, {
	"id": 6,
	"name": "Lenguajes Formales y Compiladores 2",
	"starts": "5",
	"rank": "0"
}, {
	"id": 7,
	"name": "Lenguajes Formales de programacion",
	"starts": "5",
	"rank": "0"
}, {
	"id": 8,
	"name": "Derecho Civil",
	"starts": "5",
	"rank": "0"
}]
```

## METHODS FOR LEVELS

### Create new Level

> **Method:** POST

> **Request:**  'name' => 'required|unique:levels',
                
                `http://xook.com.gt:9080/api/level`

> **Response:** If the level has been successfully added a message like the following is restored:

                `Successfull!!!. The ID for the new Level is 5` whit code 200

else

                `It has ocurred an error` whit code 500.


### Search Level by Name

> **Method:** GET

> **Request:** Include Level name on the URL, for example:  `http://xook.com.gt:9080/api/level-name/Universidad`

> **Response:** This method return the objet JSON whit the information of the level, for example:

```php
{
	"id": 1,
	"name": "Universidad",
	"starts": "0",
	"rank": "0"
}
```

### Show All The Levels
> **Method:** GET

> **Request:** This method no require params, only call de method, for example:  `http://xook.com.gt:9080/api/level-all`

> **Response:** This method return the objet JSON whit the information of all levels, for example:

```php
[{
	"id": 1,
	"name": "Universidad",
	"starts": "0",
	"rank": "0"
}, {
	"id": 2,
	"name": "Diversificado",
	"starts": "0",
	"rank": "0"
}]
```

## METHODS FOR COURSES

### Create a new Course

> **Method:** POST

> **Request:** Include params:
								'name' => 'required|unique:categories',
            					'description' => 'required',
            					'id_categorie' => 'numeric|required',
            					'id_level' => 'numeric|required',

								`http://xook.com.gt:9080/api/course/`

> **Response:** If the course has been successfully added a message like the following is restored:

                `Successfull!!!. The ID for the new course is 5` whit code 200
else

                `It has ocurred an error` whit code 500.

### Show All The Courses
> **Method:** GET

> **Request:** This method no require params, only call de method, for example:  `http://xook.com.gt:9080/api/course-all`

> **Response:** This method return the objet JSON whit the information of all levels, for example:

```php
[{
	"id": "1",
	"name": "Matematica Aplicada 1",
	"description": "Segun el pensum de la USAC",
	"starts": "0",
	"rank": "0",
	"id_categorie": "1",
	"id_level": "1",
	"categorie": "Matematicas",
	"level": "Universidad"
}, {
	"id": "2",
	"name": "Matematica Aplicada 2",
	"description": "Segun el pensum de la USAC",
	"starts": "0",
	"rank": "0",
	"id_categorie": "1",
	"id_level": "1",
	"categorie": "Matematicas",
	"level": "Universidad"
}, {
	"id": "3",
	"name": "Matematica Aplicada 3",
	"description": "Segun el pensum de la USAC",
	"starts": "0",
	"rank": "0",
	"id_categorie": "1",
	"id_level": "1",
	"categorie": "Matematicas",
	"level": "Universidad"
}]
```

## METHODS FOR TUTORIALS

The defaults are set in `config/cors.php`. Copy this file to your own config directory to modify the values. You can publish the config using this command:
```sh
$ php artisan vendor:publish --provider="Barryvdh\Cors\ServiceProvider"
```
> **Note:** When using custom headers, like `X-Auth-Token` or `X-Requested-With`, you must set the `allowedHeaders` to include those headers. You can also set it to `array('*')` to allow all custom headers.

> **Note:** If you are explicitly whitelisting headers, you must include `Origin` or requests will fail to be recognized as CORS.

    
```php
return [
     /*
     |--------------------------------------------------------------------------
     | Laravel CORS
     |--------------------------------------------------------------------------
     |
     | allowedOrigins, allowedHeaders and allowedMethods can be set to array('*')
     | to accept any value.
     |
     */
    'supportsCredentials' => false,
    'allowedOrigins' => ['*'],
    'allowedHeaders' => ['Content-Type', 'X-Requested-With'],
    'allowedMethods' => ['*'], // ex: ['GET', 'POST', 'PUT',  'DELETE']
    'exposedHeaders' => [],
    'maxAge' => 0,
]
```

`allowedOrigins`, `allowedHeaders` and `allowedMethods` can be set to `array('*')` to accept any value.

> **Note:** Try to be a specific as possible. You can start developing with loose constraints, but it's better to be as strict as possible!

> **Note:** Because of [http method overriding](http://symfony.com/doc/current/reference/configuration/framework.html#http-method-override) in Laravel, allowing POST methods will also enable the API users to perform PUT and DELETE requests as well.

### Lumen

On Laravel Lumen, load your configuration file manually in `bootstrap/app.php`:
```php
$app->configure('cors');
```

And register the ServiceProvider:

```php
$app->register(Barryvdh\Cors\ServiceProvider::class);
```

## METHODS FOR COUNTRIES
To allow CORS for all your routes, add the `HandleCors` middleware to the global middleware:
```php
$app->middleware([
    // ...
    \Barryvdh\Cors\HandleCors::class,
]);
```

## METHODS FOR PROVINCES
If you want to allow CORS on a specific middleware group or route, add the `HandleCors` middleware to your group:

```php
$app->routeMiddleware([
    // ...
    'cors' => \Barryvdh\Cors\HandleCors::class,
]);
```

## METHODS FOR CITIES
In order for the package to work, the request has to be a valid CORS request and needs to include an "Origin" header.

When an error occurs, the middleware isn't run completely. So when this happens, you won't see the actual result, but will get a CORS error instead.

This could be a CSRF token error or just a simple problem.

> **Note:** This should be working in Laravel 5.3+.

### Disabling CSRF protection for your API

If possible, use a different route group with CSRF protection enabled. 
Otherwise you can disable CSRF for certain requests in `App\Http\Middleware\VerifyCsrfToken`:

```php
protected $except = [
    'api/*'
];
```
    
## License

Released under the MIT License, see [LICENSE](LICENSE).

[ico-version]: https://img.shields.io/packagist/v/barryvdh/laravel-cors.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/barryvdh/laravel-cors/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/barryvdh/laravel-cors.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/barryvdh/laravel-cors.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/barryvdh/laravel-cors.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/barryvdh/laravel-cors
[link-travis]: https://travis-ci.org/barryvdh/laravel-cors
[link-scrutinizer]: https://scrutinizer-ci.com/g/barryvdh/laravel-cors/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/barryvdh/laravel-cors
[link-downloads]: https://packagist.org/packages/barryvdh/laravel-cors
[link-author]: https://github.com/barryvdh
[link-contributors]: ../../contributors
