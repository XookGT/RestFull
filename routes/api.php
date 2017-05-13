<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/


// Route to create a new role
Route::post('role', 'JwtAuthenticateController@createRole');
// Route to create a new permission
Route::post('permission', 'JwtAuthenticateController@createPermission');
// Route to assign role to user
Route::post('assign-role', 'JwtAuthenticateController@assignRole');
// Route to attache permission to a role
Route::post('attach-permission', 'JwtAuthenticateController@attachPermission');
// Authentication route
Route::post('authenticate', 'JwtAuthenticateController@authenticate');
//Routes Only admin
Route::group(['middleware' => ['ability:admin,create-users']], function()
{
    // Protected route
    Route::get('users', 'JwtAuthenticateController@index');
    Route::get('/course-all', 'Courses@ShowAll');

});

/// estas rutas hay q cambiarlas, porque aca le tengo que aplicar los mismo permisos a todas si uso resouce para autogenerarlas
// pero como cualquiera puede usar las de consultar, esas son las unicas que deben quedar fuera
// todas las que van a salir ahi son autogeneradas por el resource lo q debo hacer es escribirlas igual solo q una x una 
// porque tienen diferentes permisos
Route::resource('/bank','Banks');
Route::resource('/bill','Bills');
Route::resource('/bill-state','BillStates');
Route::resource('/categorie','Categories');
Route::resource('/city','Cities');
Route::resource('/country','Countries');
Route::resource('/course','Courses');
Route::resource('/day','Days');
Route::resource('/level','Levels');
Route::resource('/payment-method','PaymentMethods');
Route::resource('/payment','Payments');
Route::resource('/payment-state','PaymentState');
Route::resource('/place','Places');
Route::resource('/profile-status','ProfileStatuses');
Route::resource('/province','Provinces');
Route::resource('/purchase-order','PurchaseOrders');
Route::resource('/score','Scores');
Route::resource('/state-purchase-order','StatePurchaseOrders');
Route::resource('/state-tutotial-payment','StateTutorialPayments');
Route::resource('/tutorial-day','TutorialDays');
Route::resource('/tutorial-has-place','TutorialHasPlaces');
Route::resource('/tutorial','Tutorials');
Route::resource('/tutorial-payment','TutorialPayments');
Route::resource('/tutor-payment','TutorPayments');
Route::resource('/xookcc','XookCCs');
//Entoces de momento esta esto y los metodos son los mismo del otro ya pase la doc aca tb

// eso seria todo digo yo manana voy a ahcer un metodo que se llame getRole() con ese vos vas a mandarme el token y yo te 
// devolver el numero de id de tu rol, voy a poner en el manual q numero es cada rol, algo asi como
// 1 admin, 2 tutor, 3 cliente, entonces te logas y yo te mando el token, en ese mismo controlador de angular,
//vos llamas a este metodo y te devuelvo por ejemplo uno 1 entonces pones un if y hace una vista para admi, ya? porque 
// venia pensando eso y no se me ocurrio otra forma de saber que vista poner jaja, no, solo cuando te logas para saber que menu mostrar,
//porque el menu de opciones depende del rol, luego si por ejemplo no esta en el menu,
//pero me quiero pasar de vivo y poner la url quemanda en el navegador, pufff entre el middleware y le dice token_invalid
// asi lo habia pensado yo, tambien habia pensado la forma de hacer que me retorne el menu desde aca, pero no se,
//creo q no seria optimo jaja, ahh va va, va ta bueno, me parece entonces ahora por ahora estan todas,
//las rutas libres pero ya luego cuando ya sea de componerlo haremos 3 de estos, cabal y las de get q son
//consultas asi afuerita como estas, fuera de los 3 cabal, porque el cliente solo tendra rutas para hacer contratciones va, y ver
//estados de pedidos e historial, y alguna q otra cosa q veamos ahi en el camino
//pero creo que es el q tiene menos, el q mas tiene es el admin jajaja
Route::get('/categorie-name/{name}', 'Categories@SearchByName');
Route::get('/categorie-all', 'Categories@ShowAll');
Route::get('/level-name/{name}', 'Levels@SearchByName');
Route::get('/level-all', 'Levels@ShowAll');

