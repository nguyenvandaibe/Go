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

Route::get('/', function () {
    return redirect('login');
});

// Authentication Routes...
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');

Route::post('/login', 'Auth\LoginController@login');

Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');

Route::post('/register', 'Auth\RegisterController@register');


// ------------------------------------------------------------------------------
Route::middleware(['auth'])->group(function () {

	Route::get('/home', function() {
		return view('home');
	});

	Route::prefix('/profile')->group(function () {

		Route::get('/me', 'HomeController@index');

		Route::get('/me/edit', 'HomeController@show');

		Route::post('/store', 'HomeController@store');
	});

	Route::prefix('/plans')->group(function () {

		Route::get('/{planId}', 'PlanController@index');

		Route::prefix('/{planId}/comments')->group(function () {

			Route::post('/create', 'CommentController@create');

			Route::post('/reply/{commentId}', 'CommentController@reply');
			
			Route::post('/delete/{commentId}', 'CommentController@delete');
		});

		Route::prefix('/create')->group(function () {

			Route::get('steps/info', 'PlanController@showFormInfo');

			Route::post('/info', 'PlanController@createNewPlanInfo');
		});

		Route::prefix('/status')->group(function () {

			Route::post('/run/{planId}', 'PlanController@run');

			Route::post('/end/{planId}', 'PlanController@end');

			Route::post('/cancel/{planId}', 'PlanController@cancel');
		});

		Route::prefix('/edit')->group(function () {

			Route::get('/show/{planId}', 'PlanController@showFormEditInfo');

			Route::post('/store/{planId}', 'PlanController@store');
		});

		Route::prefix('/points')->group(function () {

			Route::post('/create/{planId}', 'PointController@createNewPoint');

			Route::post('/edit/{planId}', 'PointController@editPoint');

			Route::post('/delete/{planId}', 'PointController@deletePoint');
		});
	});

	// -------------------- Get data by AJAX -----------------------------------------------
	Route::prefix('/get')->group(function () {

		Route::get('/points/{planId}', 'PointController@getArrayOfPoints'); // get array of points

		Route::get('/status/{planId}', 'PlanController@getPlanStatus');

		Route::get('/comments/{planId}', 'CommentController@getComments');
	});
});