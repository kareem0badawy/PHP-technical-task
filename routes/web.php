<?php

use Illuminate\Support\Facades\Route;


Route::group(['namespace'=>'App\Http\Controllers'], function () {
    Route::get('/', 'ProductController@index');
    Route::resource('products', 'ProductController');
    Route::get('/autocomplete-search', 'ProductController@autocompleteSearch')->name('autocomplete');
});
