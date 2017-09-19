<?php



/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Provide controller methods with object instead of ID


//Route::get('dashboard', 'DashboardController@dashboard'); 

Route::get('/', 'DashboardController@index');		
Route::get('login', 'WebController@signin');
Route::get('signup', 'WebController@signup');
Route::post('savenewuser', 'WebController@store');
Route::post('authenticate', 'Auth\AuthController@authenticate');

Route::get('dashboard', 'DashboardController@index');


//------------------------------------   [ USER ]   ------------------------------------//
Route::get('user', 				['middleware' => 'guest', 'uses' => 'UserController@index']);
Route::get('user/create', 		['middleware' => 'guest', 'uses' => 'UserController@create']);
Route::post('user', 			['middleware' => 'guest', 'uses' => 'UserController@store']);
Route::get('user/edit/{id}/', 	['middleware' => 'guest', 'uses' => 'UserController@edit'])->where('id', '[0-9]+');
Route::post('user/destroy',		['middleware' => 'guest', 'uses' => 'UserController@destroy']);


//------------------------------------   [ SERVICES ]   ------------------------------------//
Route::get('service', 				['middleware' => 'guest', 'uses' => 'ServiceController@index', 'as' => 'service']);
Route::get('service/create', 		['middleware' => 'guest', 'uses' => 'ServiceController@create']);
Route::post('service', 				['middleware' => 'guest', 'uses' => 'ServiceController@store']);
Route::get('service/edit/{id}/', 	['middleware' => 'guest', 'uses' => 'ServiceController@edit'])->where('id', '[0-9]+');
Route::post('service/destroy',		['middleware' => 'guest', 'uses' => 'ServiceController@destroy']);

//------------------------------------   [ CLIENTS ]   ------------------------------------//
Route::get('client', 				['middleware' => 'guest', 'uses' => 'ClientController@index']);
Route::post('client/filter',		['middleware' => 'guest', 'uses' => 'ClientController@index']);
Route::get('client/create', 		['middleware' => 'guest', 'uses' => 'ClientController@create']);
Route::post('client', 				['middleware' => 'guest', 'uses' => 'ClientController@store']);
Route::get('client/edit/{id}/', 	['middleware' => 'guest', 'uses' => 'ClientController@edit'])->where('id', '[0-9]+');
Route::post('client/destroy',		['middleware' => 'guest', 'uses' => 'ClientController@destroy']);
Route::get('client/create/express',['middleware' => 'guest', 'uses' => 'ClientController@storeExpress']);

//------------------------------------   [ APPOINTMENTS ]   ------------------------------------//
Route::get('appointments', 				['appointments' => 'guest', 'uses' => 'AppointmentController@index']);

Route::get('appointments', 				['appointments' => 'guest', 'uses' => 'AppointmentController@index']);
Route::get('getAppointments', 			['middleware' => 'guest', 'uses' => 'AppointmentController@getAppointments']);
Route::post('appointment', 				['middleware' => 'guest', 'uses' => 'AppointmentController@store']);
Route::post('appointments',				['middleware' => 'guest', 'uses' => 'AppointmentController@storeMassive']);
Route::get('getAppointment', 			['middleware' => 'guest', 'uses' => 'AppointmentController@getById']);
Route::get('getAppointmentByClient', 	['middleware' => 'guest', 'uses' => 'AppointmentController@getByClient']);

Route::get('appointment/delete/{id}/', 	['middleware' => 'guest', 'uses' => 'AppointmentController@destroy'])->where('id', '[0-9]+');
Route::get('getAppointmentResumen',		['middleware' => 'guest', 'uses' => 'AppointmentController@getResumen']);
Route::get('appointmentParams',			['middleware' => 'guest', 'uses' => 'AppointmentController@params']);
Route::get('getParams',					['middleware' => 'guest', 'uses' => 'AppointmentController@getParams']);
Route::post('saveParams',				['middleware' => 'guest', 'uses' => 'AppointmentController@saveParams']);
Route::get('appDay/{id}',				['middleware' => 'guest', 'uses' => 'AppointmentController@day'])->where('id', '[0-9]+');
Route::get('getAppointmentsToday', 		['middleware' => 'guest', 'uses' => 'AppointmentController@getAppointmentsToday']);

Route::post('updatebyclient',	 		['middleware' => 'guest', 'uses' => 'AppointmentController@updateByClientId']);


Route::get('getProspectList',			['middleware' => 'guest', 'uses' => 'ClientController@getProspectList']);
Route::get('getClientDetail/{id}',		['middleware' => 'guest', 'uses' => 'ClientController@getClientDetail'])->where('id', '[0-9]+');
Route::get('verifyphone/{phone}',		['middleware' => 'guest', 'uses' => 'ClientController@getClientByPhone']);

Route::get('checkDisponibility',		['middleware' => 'guest', 'uses' => 'AppointmentController@checkDisponibility']);


//------------------------------------   [ ADMIN - STATUS CALENDAR ]   ------------------------------------//
Route::get('appStatus',					['middleware' => 'guest', 'uses' => 'AppointmentStatusController@index']);
Route::post('appStatus',				['middleware' => 'guest', 'uses' => 'AppointmentStatusController@store']);
Route::delete('appStatus/delete/{id}/', ['middleware' => 'guest', 'uses' => 'AppointmentStatusController@destroy'])->where('id', '[0-9]+');


//------------------------------------   [ SALES ]   ------------------------------------//
Route::get('sale', 				['middleware' => 'guest', 'uses' => 'SaleController@index']);
Route::get('sale/create',		['middleware' => 'guest', 'uses' => 'SaleController@create']);
Route::post('sale', 			['middleware' => 'guest', 'uses' => 'SaleController@store']);
Route::get('sale/edit/{id}/', 	['middleware' => 'guest', 'uses' => 'SaleController@edit'])->where('id', '[0-9]+');
Route::post('sale/destroy',		['middleware' => 'guest', 'uses' => 'SaleController@destroy']);
Route::get('sale/show/{id}/', 	['middleware' => 'guest', 'uses' => 'SaleController@show'])->where('id', '[0-9]+');
Route::post('sale/payment', 	['middleware' => 'guest', 'uses' => 'SaleController@storePayment']);
Route::post('sale/payment/destroy/{id}', 	['middleware' => 'guest', 'uses' => 'SaleController@destroyPayment'])->where('id', '[0-9]+');


//------------------------------------   [ PACKAGES ]   ------------------------------------//
Route::get('package', 				['middleware' => 'guest', 'uses' => 'PackageController@index']);
Route::get('package/create', 		['middleware' => 'guest', 'uses' => 'PackageController@create']);
Route::post('package', 				['middleware' => 'guest', 'uses' => 'PackageController@store']);
Route::get('package/edit/{id}/', 	['middleware' => 'guest', 'uses' => 'PackageController@edit'])->where('id', '[0-9]+');
Route::post('package/destroy',		['middleware' => 'guest', 'uses' => 'PackageController@destroy']);



//------------------------------------   [ FOLLOW UP ]   ------------------------------------//
Route::get('followup', 				['middleware' => 'guest', 'uses' => 'FollowUpController@index']);
Route::get('followup/create', 		['middleware' => 'guest', 'uses' => 'FollowUpController@create']);
Route::post('followup', 			['middleware' => 'guest', 'uses' => 'FollowUpController@store']);
Route::get('followup/edit/{id}/', 	['middleware' => 'guest', 'uses' => 'FollowUpController@edit'])->where('id', '[0-9]+');
Route::post('followup/destroy',		['middleware' => 'guest', 'uses' => 'FollowUpController@destroy']);



//------------------------------------   [ DASHBOARD ]   ------------------------------------//
Route::get('getDashboardSale',	 		['middleware' => 'guest', 'uses' => 'DashboardController@getSales']);
Route::get('getTodayAppointment', 		['middleware' => 'guest', 'uses' => 'AppointmentController@getTodayAppointment']);
Route::get('getTopServices', 			['middleware' => 'guest', 'uses' => 'DashboardController@getTopServices']);
Route::get('getTopUsers', 				['middleware' => 'guest', 'uses' => 'DashboardController@getTopUsers']);
Route::get('getPendingPayments',		['middleware' => 'guest', 'uses' => 'DashboardController@getPendingPayments']);
Route::get('getTodaysFollowUp',			['middleware' => 'guest', 'uses' => 'DashboardController@getTodaysFollowUp']);

//------------------------------------   [ FOLLOW UP ]   ------------------------------------//
Route::get('inventory', 				['middleware' => 'guest', 'uses' => 'InventoryController@index']);
Route::get('inventory/delete', 				['middleware' => 'guest', 'uses' => 'InventoryController@destroy']);
Route::get('inventory/create', 				['middleware' => 'guest', 'uses' => 'InventoryController@create']);
Route::get('inventory/edit/{id}/', 	['middleware' => 'guest', 'uses' => 'InventoryController@edit'])->where('id', '[0-9]+');
Route::post('inventory', 				['middleware' => 'guest', 'uses' => 'InventoryController@store']);
