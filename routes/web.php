<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('cliente.index-3');
});

<<<<<<< HEAD
Route::get('/mercadoPublico', function () {
    return view('cliente.mercado-publico');
});
=======
Route::get('/quienes-somos', function () {
    return view('cliente.about_us');
});
>>>>>>> e6dd39ea6fbbd380615bdc1508e88bd6a4624ff4
