<?php

Route::get('users', 'AdminPanelController@getUsers');

Route::get('user/{user_id}', 'AdminPanelController@getUser');

Route::post('user/{user_id}', 'AdminPanelController@postUser');

Route::delete('user/{user_id}', 'AdminPanelController@deleteUser');

Route::post('users', 'AdminPanelController@postUser');

Route::put('users', 'AdminPanelController@putUser');

Route::get('menus', 'AdminPanelController@getMenus');

Route::post('menus', 'AdminPanelController@postMenu');

Route::put('menus', 'AdminPanelController@putMenu');

Route::delete('menus/{id}', 'AdminPanelController@deleteMenu');

Route::get('categories', 'AdminPanelController@getCategories');

Route::post('categories/{category_id}', 'AdminPanelController@postCategory');

Route::put('categories', 'AdminPanelController@putCategory');

Route::delete('categories/{id}', 'AdminPanelController@deleteCategory');

Route::get('languages', 'AdminPanelController@getLanguages');

Route::post('languages', 'AdminPanelController@postLanguage');

Route::put('languages', 'AdminPanelController@putLanguage');

Route::delete('languages/{id}', 'AdminPanelController@deleteLanguage');

Route::get('roles', 'AdminPanelController@getRoles');
