<?php

Route::get('users', 'AdminController@getUsers');

Route::get('user/{user_id}', 'AdminController@getUser');

Route::post('user/{user_id}', 'AdminController@postUser');

Route::delete('user/{user_id}', 'AdminController@deleteUser');

Route::post('users', 'AdminController@postUser');

Route::put('users', 'AdminController@putUser');

Route::get('menus', 'AdminController@getMenus');

Route::post('menus', 'AdminController@postMenu');

Route::put('menus', 'AdminController@putMenu');

Route::delete('menus/{id}', 'AdminController@deleteMenu');

Route::get('categories', 'AdminController@getCategories');

Route::post('categories/{category_id}', 'AdminController@postCategory');

Route::put('categories', 'AdminController@putCategory');

Route::delete('categories/{id}', 'AdminController@deleteCategory');

Route::get('languages', 'AdminController@getLanguages');

Route::post('languages', 'AdminController@postLanguage');

Route::put('languages', 'AdminController@putLanguage');

Route::delete('languages/{id}', 'AdminController@deleteLanguage');

Route::get('roles', 'AdminController@getRoles');
