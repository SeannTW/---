<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'MessageController@index')->name('messages.index');
Route::get('messages', 'MessageController@index')->name('messages.index');
Route::post('messages', 'MessageController@store')->name('messages.store');
Route::get('messages/{id}/edit', 'MessageController@edit')->name('messages.edit');
Route::put('messages/{id?}', 'MessageController@update')->name('messages.update');
Route::delete('messages/{id?}', 'MessageController@destroy')->name('messages.destroy');

Route::get('replies/{id}', 'RepliesController@index')->name('replies.index');
Route::post('replies/{id}', 'RepliesController@store')->name('replies.store');
Route::get('replies/{id}/edit', 'RepliesController@edit')->name('replies.edit');
Route::put('replies/{id?}', 'RepliesController@update')->name('replies.update');
Route::delete('replies/{id?}', 'RepliesController@destroy')->name('replies.update');
