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
use App\Http\Middleware\CheckRole;

Route::get('/',function(){
	return view('welcome');
});
Route::get('/home', function () {
	// return redirect()->Route('c');
    return view('home');
})->middleware(BeforeMiddleWare::class);

Route::get('/current',function(){
	$route = Route::current();
	$name = Route::currentRouteName();
	$action = Route::currentRouteAction();
	return "a";
})->name('c');

Route::get('/user/{id}','UserController@Show')->middleware(CheckRole::class);
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

