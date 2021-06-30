<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\TicketController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//Auth
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Flight table
Route::get('/flights', [FlightController::class, 'index']);
Route::get('/flights/{id}', [FlightController::class, 'show']);

// Ticket table
Route::get('/tickets', [TicketController::class, 'index']);
Route::get('/tickets/{id}', [TicketController::class, 'show']);

Route::group(['middleware'=> 'auth:sanctum'], function (){

    //user manipulation
    Route::prefix('user')->group(function (){
        Route::get('/', [UserController::class, 'index']);
        Route::get('/{id}', [UserController::class, 'show']);
    });

    //admin dashboard [add/update/remove: tickets, flights]
    //flights
    Route::prefix('flights')->group(function (){
        Route::post('/', [FlightController::class, 'store']);
        Route::post('/{id}', [FlightController::class, 'update']);
        Route::delete('/{id}', [FlightController::class, 'destroy']);
    });

    //Tickets
    Route::prefix('tickets')->group(function (){
        Route::post('/', [TicketController::class, 'store']);
        Route::post('/{id}', [TicketController::class, 'update']);
        Route::delete('/{id}', [TicketController::class, 'destroy']);
    });

    Route::post('/logout', [AuthController::class, 'logout']);
});


