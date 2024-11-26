<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\HotelController;
use App\Http\Controllers\Api\HabitacionController;
use App\Http\Controllers\Api\TipoHabitacionController;
use App\Http\Controllers\Api\AcomodacionController;
use App\Http\Controllers\Api\HotelTipoAcomodacionController;

// Rutas para el controlador de hoteles
Route::get('/hoteles', [HotelController::class, 'index']);
Route::post('/hoteles', [HotelController::class, 'store']);
Route::get('/hoteles/{hotel_id}', [HotelController::class, 'show']);
Route::put('/hoteles/{hotel_id}', [HotelController::class, 'update']);
Route::delete('/hoteles/{hotel_id}', [HotelController::class, 'destroy']);

// Rutas para el controlador de tipos de habitaciones
Route::get('/tipos-habitacion', [TipoHabitacionController::class, 'index']);
Route::post('/tipos-habitacion', [TipoHabitacionController::class, 'store']);
Route::get('/tipos-habitacion/{id}', [TipoHabitacionController::class, 'show']);
Route::put('/tipos-habitacion/{id}', [TipoHabitacionController::class, 'update']);
Route::delete('/tipos-habitacion/{id}', [TipoHabitacionController::class, 'destroy']);

// Rutas para el controlador de acomodaciones
Route::get('/acomodaciones', [AcomodacionController::class, 'index']);
Route::post('/acomodaciones', [AcomodacionController::class, 'store']);
Route::get('/acomodaciones/{id}', [AcomodacionController::class, 'show']);
Route::put('/acomodaciones/{id}', [AcomodacionController::class, 'update']);
Route::delete('/acomodaciones/{id}', [AcomodacionController::class, 'destroy']);

// Rutas para el controlador de combinaciones de tipo de habitación y acomodación por hotel
Route::post('/hotel-tipo-acomodacion', [HotelTipoAcomodacionController::class, 'store']);

// Rutas para habitaciones
Route::get('/hoteles/{hotel_id}/habitaciones', [HabitacionController::class, 'getHabitacionesPorHotel']);
Route::post('/habitaciones', [HabitacionController::class, 'store']);
