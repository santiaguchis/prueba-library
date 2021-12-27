<?php

use Illuminate\Http\Request;
use App\Http\Controllers\BookController;
use App\Http\Controllers\RentBookController;
use App\Http\Controllers\AuthController;

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
	Route::get('books', [ BookController::class , 'index' ] );
	Route::get('books/me', [ BookController::class , 'me' ] );

	Route::get('books/rent', [ RentBookController::class , 'index' ] );
	Route::post('books/rent', [ RentBookController::class , 'store' ] );

	Route::prefix('auth')->group( function() {
		Route::post('login', [ AuthController::class , 'login' ]);
		Route::middleware('jwt.verify')->group( function() {
			Route::post('logout', [ AuthController::class , 'logout' ]);
		});
	});
// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
