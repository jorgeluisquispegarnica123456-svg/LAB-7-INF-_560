<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\EventoController;
use Illuminate\Support\Facades\Route;

Route::get("/", fn () => redirect()->route("eventos.index"));

Route::resource("eventos", EventoController::class);
Route::resource("categorias", CategoriaController::class);