<?php

use Illuminate\Http\Request;
use App\Http\Controllers\BookController;
use App\Http\Controllers\RentBookController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsersController;

Route::middleware('jwt.verify')->group( function() {
	Route::get('users', [ UsersController::class , 'index' ] );
	Route::get('books', [ BookController::class , 'index' ] );
	Route::get('books/me', [ BookController::class , 'me' ] );
	Route::post('books/rent', [ RentBookController::class , 'store' ] );
	Route::put('books/{id}', [ BookController::class , 'update' ] );
	Route::delete('books/{id}', [ BookController::class , 'destroy' ] );
});
Route::prefix('auth')->group( function() {
	Route::post('login', [ AuthController::class , 'login' ]);
	Route::middleware('jwt.verify')->group( function() {
		Route::post('logout', [ AuthController::class , 'logout' ]);
	});
});