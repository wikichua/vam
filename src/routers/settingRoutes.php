<?php

Route::group(['middleware' => ['web', 'auth', 'can:Access Admin Panel']], function () {
    Route::group(['prefix' => 'setting'], function () {
        Route::view('', 'vam::layouts.panel')->middleware('can:Read Settings');
        Route::view('{setting}/show', 'vam::layouts.panel')->middleware('can:Read Settings');
        Route::view('create', 'vam::layouts.panel')->middleware('can:Create Settings');
        Route::view('{setting}/edit', 'vam::layouts.panel')->middleware('can:Update Settings');
    });
    Route::group(['prefix' => 'api/setting', 'namespace' => config('vam.controller_namespace') . '\Admin'], function () {
        Route::match(['get', 'head'], 'list', 'SettingController@index')->name('setting.index');
        Route::match(['post'], 'store', 'SettingController@store')->name('setting.store');
        Route::match(['get', 'head'], '{setting}/read', 'SettingController@show')->name('setting.show');
        Route::match(['put', 'patch'], '{setting}/update', 'SettingController@update')->name('setting.update');
        Route::match(['delete'], '{setting}/delete', 'SettingController@destroy')->name('setting.destroy');

        Route::match(['get', 'head'], 'dropdown', 'SettingController@dropdown')->name('setting.dropdown');
    });
});
