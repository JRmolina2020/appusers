<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
})->name('login');

Route::post('login', 'AuthController@login');
//auth
Route::group(['middleware' => 'auth'], function () {
    Route::get('home', 'UserController@countuser');

    Route::group(['middleware' => ['permission:Administrador de seguridad']], function () {
        Route::get('usuarios', function () {
            return view('users.index');
        });
        Route::get('perfil', function () {
            return view('users.profile');
        });

        Route::get('roles', function () {
            return view('roles.index');
        });
        Route::get('permisos', function () {
            return view('permissions.index');
        });
    });

    Route::prefix('api')->group(function () {
        Route::resource('users', 'UserController')->except([
            'show', 'create', 'edit'
        ]);
        Route::put('users/available/{id}', 'UserController@available');
        Route::put('users/locked/{id}', 'UserController@locked');
        Route::put('users/password/{id}', 'UserController@updatepassword');
        Route::post('logout', 'AuthController@logout')->name('logout');
        //roles
        Route::resource('roles', 'RoleController')->except([
            'show', 'create', 'edit'
        ]);
        //permissions
        Route::resource('permissions', 'PermissionController')->except([
            'show', 'create', 'edit'
        ]);
        //categorie
        Route::post('categorie', 'CategoryController@store');
    });
});