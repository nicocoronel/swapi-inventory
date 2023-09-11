<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Rutas para naves espaciales
Route::get('starships', 'StarshipsController@index'); // Obtener todas las naves espaciales
Route::get('starships/{id}', 'StarshipsController@show'); // Obtener una nave espacial por ID
Route::post('starships', 'StarshipsController@store'); // Crear una nueva nave espacial
Route::put('starships/{id}', 'StarshipsController@update'); // Actualizar una nave espacial por ID
Route::delete('starships/{id}', 'StarshipsController@destroy'); // Eliminar una nave espacial por ID

// Rutas para vehículos
Route::get('vehicles', 'VehiclesController@index'); // Obtener todos los vehículos
Route::get('vehicles/{id}', 'VehiclesController@show'); // Obtener un vehículo por ID
Route::post('vehicles', 'VehiclesController@store'); // Crear un nuevo vehículo
Route::put('vehicles/{id}', 'VehiclesController@update'); // Actualizar un vehículo por ID
Route::delete('vehicles/{id}', 'VehiclesController@destroy'); // Eliminar un vehículo por ID
