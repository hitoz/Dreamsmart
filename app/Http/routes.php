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

Route::get('/', 'WelcomeController@index');

Route::get('/storing', 'WelcomeController@storeAccessToken');

Route::get('/list/{tag?}', 'WelcomeController@getList');

Route::get('/test', function() {
	$str = "#rollit";
	$arr = explode("#", $str);
	foreach ($arr as $value) {
		if ($value != "") {
			$tagName = explode(" ", $value)[0];
			$tag = "#".$tagName;
			$str = str_replace($tag, "<a href='list/$tagName'>$tag</a>"." ", $str);	
		}		
	}
	return $str;
});

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
