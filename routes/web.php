<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect('/app');
});

Route::get('/admin', function () {
    return redirect('/app');
});

