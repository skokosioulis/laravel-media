<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/media-demo', function () {
    return view('media-demo');
});

Route::get('/media-upload', function () {
    return view('media-upload-demo');
});

Route::get('/media-gallery', function () {
    return view('media-gallery-demo');
});
