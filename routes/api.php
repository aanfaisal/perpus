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

    // telegram API
	// Route::get('telegram', 'TelegramController@index');
	// Route::post('telegram/kirim','TelegramController@postSendMessage');
	// Route::get('telegram/get-updates','TelegramController@getUpdates');
});
