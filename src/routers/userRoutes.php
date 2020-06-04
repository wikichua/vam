<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web', 'auth', 'can:Access Admin Panel']], function () {
    Route::group(['prefix' => 'user'], function () {
        Route::view('', 'vam::layouts.panel')->middleware('can:Read Users');
        Route::view('{user}/show', 'vam::layouts.panel')->middleware('can:Read Users');
        Route::view('create', 'vam::layouts.panel')->middleware('can:Create Users');
        Route::view('{user}/edit', 'vam::layouts.panel')->middleware('can:Update Users');
        Route::view('{user}/editPassword', 'vam::layouts.panel')->middleware('can:Update User Password');
    });
    Route::group(['prefix' => 'api/user', 'namespace' => config('vam.controller_namespace') . '\Admin'], function () {
        Route::match(['get', 'head'], 'list', 'UserController@index')->name('user.index');
        Route::match(['post'], 'store', 'UserController@store')->name('user.store');
        Route::match(['get', 'head'], '{user}/read', 'UserController@show')->name('user.show');
        Route::match(['put', 'patch'], '{user}/update', 'UserController@update')->name('user.update');
        Route::match(['delete'], '{user}/delete', 'UserController@destroy')->name('user.destroy');
        Route::match(['put', 'patch'], '{user}/updatePassword', 'UserController@updatePassword')->name('user.updatePassword');
    });
});
