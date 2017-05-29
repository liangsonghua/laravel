<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Http\Middleware\BeforeMiddleWare;
// Route::get('/login',function() {
// 	return view('auth.login');
// });

// Route::post('/loginCheck','Auth\LoginController@Check');
Route::get('/home', function () {
	// return redirect()->Route('c');
    return view('welcome');
})->middleware(BeforeMiddleWare::class);

Route::get('/current',function(){
	$route = Route::current();
	$name = Route::currentRouteName();
	$action = Route::currentRouteAction();
	return "a";
})->name('c');

// Route::get('/user/{id}','UserController@Show');

Route::resource('user','UserController');
Route::resource('project','ProjectController');
Route::get('/cache',function() {
	return Cache::get('key');
 });
// Route::get($uri, $callback)->name('get');
// Route::post($uri, $callback);
// Route::put($uri, $callback);
// Route::patch($uri, $callback);
// Route::delete($uri, $callback);
// Route::options($uri, $callback);

Auth::routes();

Route::get('/home', 'HomeController@index');
