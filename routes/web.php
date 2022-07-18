<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/',
    'App\Http\Controllers\HomeController@index'
);

Route::resource('/luckydraw',
    'App\Http\Controllers\LuckydrawController'
);

Route::resource('/adminluckydraw',
    'App\Http\Controllers\AdminLuckydrawController'
);

Route::get('/home',
    [App\Http\Controllers\HomeController::class, 'index']
)->name('home');

Route::get('/admin/reset/users' ,
    [App\Http\Controllers\AdminLuckydrawController::class, 'resetUsers']
);

Route::get('/admin/reset/winners' ,
    'App\Http\Controllers\AdminLuckydrawController@resetWinners'
);

Route::get('/admin/reset/winningnumbers' ,
    'App\Http\Controllers\AdminLuckydrawController@resetWinningNumbers'
);
