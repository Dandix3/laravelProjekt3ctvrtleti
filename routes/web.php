<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
Auth::routes();

Route::get('/', function () {return view("database");})->middleware('auth');

// Endpointy místností
Route::get('/rooms', 'RoomController@getRooms')->middleware('auth');
Route::get('/roomDetail/{id}', 'RoomController@getRoom')->middleware('auth');

// Endpointy uživatelů
Route::get('/employees', 'EmployeeController@getEmployees')->middleware('auth');
Route::get('/employeeDetail/{id}', 'EmployeeController@getEmployee')->middleware('auth');

Route::get('/changePassword', 'EmployeeController@showChangePassword')->middleware('auth');
Route::post('changePassword', 'EmployeeController@changePassword')->middleware('auth');


// Endpointy admina
Route::get("/editEmployee/{id}", 'AdminController@showEditEmployee')->middleware('admin');
Route::post('editEmployee', 'AdminController@editEmployee')->middleware('admin');

Route::get('/editRoom/{id}', 'AdminController@showEditRoom')->middleware('admin');
Route::post('editRoom', 'AdminController@editRoom')->middleware('admin');

Route::get('/createEmployee', 'AdminController@showCreateEmployee')->middleware('admin');
Route::post('createEmployee', 'AdminController@createEmployee')->middleware('admin');

Route::get('/createRoom', 'AdminController@showCreateRoom')->middleware('admin');
Route::post('createRoom', 'AdminController@createRoom')->middleware('admin');

Route::post('deleteEmployee', 'AdminController@deleteEmployee')->middleware('admin');
Route::post('deleteRoom', 'AdminController@deleteRoom')->middleware('admin');

Route::post('forceDeleteRoom', 'AdminController@forceDeleteRoom')->middleware('admin');

// přihlášení
Route::get('/login', 'Authentication@showLogin')->name('login');

Route::post('login', 'Authentication@doLogin');
Route::get('logout', 'Authentication@doLogout')->middleware('auth');



