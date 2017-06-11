<p align="center"><img src="https://github.com/XookGT/RestFull/blob/master/public/logo_Xook.png"></p>

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

### Login
>**Method:** POST

>**Request:**  'email' => 'required|email' An email must comply with the regular email address 
			   'password' => 'required' minium 6 chars.

>**URL:** 		`http://xook.com.gt:88/api/authenticate`

>**Reponse:**	If the credentials are correct, the system will debug an authentication token.

else

				`invalid_credentials` whit code 401

else 

				`If the server does not respond`  `could_not_create_token` whit code 500.

### Get My Role
>**Method:** POST

>**Request:** Whitout Params

>**URL:**	`http://xook.com.gt:88/api/me/role`

>**Response:** If the user has a rol, the server retur JSON whit code 200, for example:

```php
{"role":"admin"} | {"role":"tutor"} | {"role":"user"}
```

else

If the user does not has a rol, the server return JSON whit code 200 but the mesaje is diferent, for example:
			   	  
```php
{"role":"whitout_role"}
```

else 	

If there is not toke (Not Auth), the server return:

```php
{"Token_no_provider"}
```

### CREATE USER
>**Method:** POST

>**Request:** Include the next parameters:

```php
{		'name' => 'required|max:255',
                'lastname' => 'required|max:45',
                'email' => 'required|email|max:255|unique:users,email',
                'password' => 'required|min:6',
                'celphone' => 'required|max:20|unique:users,celphone',
                'celphone2' => 'max:20',
                'url_crimina_record' => 'max:100',
                'birthdate' => 'required',
                'dni' => 'min:13|max:13|numeric|unique:users,dni',
                'dni_pdf' => 'max:100',
                'url_cv' => 'max:100',
                'id_profile_status' => 'required|numeric',
                'super' => 'numeric',
}
```

>**URL:**	`http://xook.com.gt:88/api/register`

>**Response:** If User has created, the server retur JSON whit code 200, for example:

```php
"Created"
```

else

If the user does not created, the server return JSON whit code 500 but the message is diferent, for example:
			   	  
```php
{
  "Error": "It has ocurred an error. Erro: The given data failed to pass validation."
}
```


### ASSIGN ROLE
>**Method:** POST

>**Request:** Include the next parameters:
```php
{
	'email' => 'The user`s email',
	'role'  => 'The role`s name',
}
```

```php
{
	'role`s name:'
	[
		'admin',
		'tutor',
		'user',

	]
}
```
>**URL:**	`http://xook.com.gt:88/api/assign-role`

>**Response:** If the role has assigned to user, the server retur JSON whit code 200, for example:
```php
{
	'Msj'=>'Role assigned'
}
```

else
		If ocurred an error the message maybe be:

```php
{
	'Error'=>'The User does not exist',
	'code' => '403'
}
```

```php
{
	'Error'=>'The Role does not exist',
	'code' => '403'
}
```

```php
{
	'Error'=>'It has ocurred an error. Erro: ' + Error,
	'code' => '500'
}
```


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

> **Request:** Include categorie name on the URL, for example:  `http://xook.com.gt:88/api/categorie-name/Matematicas`

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

> **Request:** This method no require params, only call de method, for example:  `http://xook.com.gt:88/api/categorie-all`

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

### Search categorie by Id

>**Method:**  GET

>**Request:** Include id categorie on the URL, for example: `http://xook.com.gt:88/api/categorie/2`

>**Response:** The Method return a JSON whit the information of the categorie and code 200, for example:

```php
{
  "id": 2,
  "name": "Programacion Extrema"
}
```

If the categorie does not exist, the server return JSON whit code 404:

```php
{
  "Msj": "The categorie does not exist"
}
```

If there is a problem the server will return error code 500

### Update the categorie

>**Method:** 	PUT|PATCH

>**Request:** Include id categorie on the URL, for example: `http://xook.com.gt:88/api/categorie/2`
			  And include the next parameters:
```php
			  'name' => 'required|unique:categories'
```

> **Response:** If the categorie has been  successfully updated  a message like the following is restored:

                `Successfull!!!` whit code 200

else

                `It has ocurred an error` whit code 500.

### Delete the categorie

>**Method:** 	DELETE

>**Request:** Include id categorie on the URL, for example: `http://xook.com.gt:88/api/categorie/2`

> **Response:** If the categorie has been  successfully deleted  a message like the following is restored:

                `Successfull!!!` whit code 200

else

                `It has ocurred an error` whit code 500.



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

> **Request:** Include Level name on the URL, for example:  `http://xook.com.gt:88/api/level-name/Universidad`

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

> **Request:** This method no require params, only call de method, for example:  `http://xook.com.gt:88/api/level-all`

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

### Search level by Id

>**Method:**  GET

>**Request:** Include id level on the URL, for example: `http://xook.com.gt:88/api/level/2`

>**Response:** The Method return a JSON whit the information of the level and code 200, for example:

```php
{
  "id": 2,
  "name": "Diversificado"
}
```

If the level does not exist, the server return JSON whit code 404:

```php
{
  "Msj": "The level does not exist"
}
```

If there is a problem the server will return error code 500

### Update the level

>**Method:** 	PUT|PATCH

>**Request:** Include id level on the URL, for example: `http://xook.com.gt:88/api/level/2`
			  And include the next parameters:
```php
			  'name' => 'required|unique:level'
```

> **Response:** If the level has been  successfully updated  a message like the following is restored:

                `Successfull!!!` whit code 200

else

                `It has ocurred an error` whit code 500.

### Delete the level

>**Method:** 	DELETE

>**Request:** Include id level on the URL, for example: `http://xook.com.gt:88/api/level/2`

> **Response:** If the level has been  successfully deleted  a message like the following is restored:

                `Successfull!!!` whit code 200

else

                `It has ocurred an error` whit code 500.


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

> **Request:** This method no require params, only call de method, for example:  `http://xook.com.gt:88/api/course-all`

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

### Show  Course for ID
> **Method:** GET

> **Request:** This method recives the id course at the url, for example:  `http://xook.com.gt:88/api/course/1`

> **Response:** This method return the objet JSON whit the information of all levels, for example:

```php
{
	"id": "1",
	"name": "Matematica Aplicada 1",
	"description": "Segun el pensum de la USAC",
	"starts": "0",
	"rank": "0",
	"id_categorie": "1",
	"id_level": "1",
	"categorie": "Matematicas",
	"level": "Universidad"
}
```

### Update the Course

>**Method:** 	PUT|PATCH

>**Request:** Include id course on the URL, for example: `http://xook.com.gt:88/api/course/1`
			  And include the next parameters:
```php
			'name' => 'required|unique:courses',
            'description'=>'required',
            'starts'=>'required|numeric',
            'id_categorie'=>'required|numeric',
            'id_level'=>'required|numeric'
```

> **Response:** If the course has been  successfully updated  a message like the following is restored:

                `Successfull!!!` whit code 200

else

                `It has ocurred an error` whit code 500.


### Delete the Course

>**Method:** 	DELETE

>**Request:** Include id course on the URL, for example: `http://xook.com.gt:88/api/course/2`

> **Response:** If the course has been  successfully deleted  a message like the following is restored:

                `Successfull!!!` whit code 200

else

                `It has ocurred an error` whit code 500.

## METHODS FOR COUNTRIES

In this section we are going to speak about the methods for Countries.

### Create a new country

>**Method:** POST

>**URL:** http://xook.com.gt:88/api/country
>**Request:** In this method it must send the name for the new country. 
```php
			'name' => 'required|unique:country'
```

>**Response:** If the country has been successfully created, the xook server return a message as the next:

`{"msj":"Successfull!!!. The ID for the new Country is 2"}` whit code 200

else

`{"Error":"it has ocurred an error"}` whit code 500


### Show the country for id
>**Method:** GET

>**URL:** http://xook.com.gt:88/api/country/{id}

>**Request:** This Method does not recive the parameters, only the id on the URL. For Example:
```php
			'http://xook.com.gt:88/api/country/2'
```

>**Response:** If the country whit this ID exist then xook service returned, the country on JSON format.
```php
{
	"id": 2,
	"name": "Guatemala"
}
```

else the country does not exist xook service return, the next message:
```php
{
'msj'=>'The course does not exist'
}
```

### Update the country
>**Method:** PUT

>**URL:** http://xook.com.gt:88/api/country/{id}

>**Request:** In this method it must send the new name for the  country. 
```php
			'name' => 'required|unique:country'
```

>**Response:** If the country is updated, xook service return code 200 and the next message:
```php
{
	'msj'=>'The country has ben updated'
}
```

else xook service return code 403 and the next message:
```php
{
'Error'=>'The country does not exist'
}
```

### Delete the country
>**Method:** DELETE

>**URL:** http://xook.com.gt:88/api/country/{id}

>**Request:** This method does not recive parameters.

>**Response:** If the country is delete, xook service return code 200 and the next message:
```php
{
	'msj'=>'The country has ben deleted'
}
```

else xook service return code 403 and the next message:
```php
{
'Error'=>'The country does not exist'
}
```

### Get All Countries
>**Method:** GET

>**URL:** http://xook.com.gt:88/api/country-all

>**Request:** This method does not recive parameters.

>**Response:** Return all the countries:
```php
{
[{
	"id": 2,
	"name": "Guatemala"
}, {
	"id": 3,
	"name": "Mexico"
}, {
	"id": 4,
	"name": "Pais uno"
}]
}
```

else xook service return code 403 and the next message:
```php
{
'Error'=>'The countries does not exist'
}
```

## METHODS FOR PROVINCES
In this section we are going to speak about the methods for Provinces.

### Create a new Province

>**Method:** POST

>**URL:** http://xook.com.gt:88/api/province
>**Request:** In this method it must send the name for the new province. 
```php
			'name' => 'required'
			'id_country' => 'required|numeric'

			'unique' ='(name, id_country)'
```

>**Response:** If the province has been successfully created, the xook server return a message as the next:

`{"msj":"Successfull!!!. The ID for the new Province is 2"}` whit code 200

else

`{"Error":"it has ocurred an error"}` whit code 500


### Show the Province for id
>**Method:** GET

>**URL:** http://xook.com.gt:88/api/province/{id}

>**Request:** This Method does not recive the parameters, only the id on the URL. For Example:
```php
			'http://xook.com.gt:88/api/province/2'
```

>**Response:** If the province whit this ID exist then xook service returned, the country on JSON format.
```php
{
	"id": 2,
	"name": "Guatemala",
	"id_country" : 2
}
```

else the country does not exist xook service return, the next message:
```php
{
'msj'=>'The province does not exist'
}
```

### Update the Province
>**Method:** PUT

>**URL:** http://xook.com.gt:88/api/province/{id}

>**Request:** In this method it must send the new name for the  province. 
```php
			'name' => 'required'
			'id_country' => 'required|numeric'

			'unique' ='(name, id_country)'
```

>**Response:** If the province is updated, xook service return code 200 and the next message:
```php
{
	'msj'=>'The province has ben updated'
}
```

else xook service return code 403 and the next message:
```php
{
'Error'=>'The Province does not exist'
}
```

### Delete the province
>**Method:** DELETE

>**URL:** http://xook.com.gt:88/api/province/{id}

>**Request:** This method does not recive parameters.

>**Response:** If the province is delete, xook service return code 200 and the next message:
```php
{
	'msj'=>'The province has ben deleted'
}
```

else xook service return code 403 and the next message:
```php
{
'Error'=>'The province does not exist'
}
```

### Get All Province
>**Method:** GET

>**URL:** http://xook.com.gt:88/api/province-all

>**Request:** This method does not recive parameters.

>**Response:** Return all the provinces:
```php
[{
		"id": 2,
		"name": "Guatemala",
		"id_country": "3"
	},
	{
		"id": 3,
		"name": "Antigua",
		"id_country": "3"
	}
]
```

else xook service return code 403 and the next message:
```php
{
'Error'=>'The provinces does not exist'
}
```

## METHODS FOR TURORIALS
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
