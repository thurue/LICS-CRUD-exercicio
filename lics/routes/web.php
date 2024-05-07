<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CrudController;

Route::get('/card', [CrudController::class, 'Card']);
Route::get('/add', [CrudController::class, 'add']);
Route::get('/', [CrudController::class, 'index']);
Route::post('/licitacoes', [CrudController::class, 'store']);
Route::get('/lics/{id_lic}', [CrudController::class, 'show']);
Route::get('/edit/{id_lic}', [CrudController::class, 'edit']);
Route::put('/editado/{id_lic}', [CrudController::class, 'update']);

Route::delete('/lics/{id_lic}', [CrudController::class, 'destroy']);
