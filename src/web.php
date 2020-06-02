<?php

use Illuminate\Support\Facades\Route;

Route::redirect('', '/dashboard');

Route::group(['namespace' => config('vam.controller_namespace')], function () {
    \Auth::routes(['logout' => false]);
    Route::get('logout', 'Auth\LoginController@logout')->name('logout');
});

Route::group(['middleware' => ['web', 'auth', 'can:Access Admin Panel']], function () {
    Route::view('dashboard', 'vam::layouts.panel')->name('home');
});
