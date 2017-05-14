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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


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
    Route::post('/me-role','JwtAuthenticateController@getRole');
});

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
Route::get('/categorie-name/{name}', 'Categories@SearchByName');
Route::get('/categorie-all', 'Categories@ShowAll');
Route::get('/course-all', 'Courses@ShowAll');
Route::get('/level-name/{name}', 'Levels@SearchByName');
Route::get('/level-all', 'Levels@ShowAll');

Route::post('/updateCategorie','Categories@updateCategorie');
//creo que es al crear el objeto perame ya se que es creo



