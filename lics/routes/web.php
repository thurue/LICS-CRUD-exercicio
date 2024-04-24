<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

use App\Http\Controllers\CrudController;

Route::get('/', [CrudController::class, 'index']);
Route::get('/card', [CrudController::class, 'Card']);

// Route::get('/clientes/{id?}', function ($id) {

//     return view('clientes', ['id' => $id]);
// });
// Route::get('/card', function () {

//     return view('Card');
// });
