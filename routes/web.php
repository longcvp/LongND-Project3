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

//language
Route::get('lang/{lang}','Client\LangController@changeLang')->name('lang');

Route::group(['namespace' => 'Admin'], function() {
    Route::get('/login', 'AuthController@getLogin')->name('login.index');

    Route::get('/logout', 'AuthController@getLogOut')->name('logout');

    Route::post('/login', 'AuthController@postLogin')->name('login');

    Route::group(['middleware' => ['auth', 'root'], 'prefix' => 'admin'], function() {
        Route::get('/', 'UserController@index')->name('admin.index');
        Route::get('/create', 'UserController@create')->name('admin.create');
        Route::post('/store', 'UserController@store')->name('admin.store');
        Route::post('/reset', 'UserController@reset')->name('admin.reset');

        Route::get('/stores', 'StoreController@index')->name('stores.index');
        Route::get('/stores/create', 'StoreController@create')->name('stores.create');
        Route::post('/stores/store', 'StoreController@store')->name('stores.store');
        Route::get('/stores/{store}/edit', 'StoreController@edit')->name('stores.edit');
        Route::patch('/stores/{store}', 'StoreController@update')
                    ->name('stores.update');
        Route::get('admin/excel', 'StoreController@excelStore')->name('admin.excel');
        Route::get('admin/excel/user', 'UserController@excelUser')->name('admin.excelUser');
    });

    Route::get('/password/reset/{user}','AuthController@getResetPassword')->name('password.show');

    Route::post('/password/reset/{user}','AuthController@postResetPassword')->name('password.request');  
});


//Client
Route::group(['namespace' => 'Client'], function() {
    Route::group(['middleware' => 'auth'], function() {
        Route::get('/', 'StoreController@index')->name('users.index');
        Route::get('/stores/{store}', 'StoreController@show')->name('stores.show');
        Route::get('/import/{store}', 'StoreController@import')->name('stores.import');
        Route::get('/export/{store}', 'StoreController@export')->name('stores.export');
        Route::post('/export/{store}', 'StoreController@exportStore')->name('export.store');
        Route::post('/import/{store}', 'StoreController@importStore')->name('import.store');
        Route::post('/export/change/user', 'StoreController@changeData');

        Route::get('excel/{store}', 'StoreController@excelStore')->name('excel.export');
        Route::get('excel', 'StoreController@excelStoreUser')->name('excel.stores');

    });
});