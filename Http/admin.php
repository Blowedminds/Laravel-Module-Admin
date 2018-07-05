<?php

Route::get('users', 'UserController@getUsers');

Route::get('user/{user_id}', 'UserController@getUser');

Route::post('user/{user_id}', 'UserController@postUser');

Route::delete('user/{user_id}', 'UserController@deleteUser');

Route::post('users', 'UserController@postUser');

Route::put('users', 'UserController@putUser');


Route::get('menus', 'MenuController@getMenus');

Route::post('menus', 'MenuController@postMenu');

Route::put('menus', 'MenuController@putMenu');

Route::delete('menus/{id}', 'MenuController@deleteMenu');


Route::get('categories', 'CategoryController@getCategories');

Route::post('categories/{category_id}', 'CategoryController@postCategory');

Route::put('categories', 'CategoryController@putCategory');

Route::delete('categories/{id}', 'CategoryController@deleteCategory');


Route::get('languages', 'LanguageController@getLanguages');

Route::post('languages', 'LanguageController@postLanguage');

Route::put('languages', 'LanguageController@putLanguage');

Route::delete('languages/{id}', 'LanguageController@deleteLanguage');


Route::get('roles', 'RoleController@getRoles');

Route::get('role/{id}', 'RoleController@getRole');

Route::post('role/{id}', 'RoleController@postRole');

Route::put('role', 'RoleController@putRole');

Route::delete('role/{id}', 'RoleController@deleteRole');


Route::get('permissions', 'PermissionController@getPermissions');

Route::post('permission/{id}', 'PermissionController@postPermission');

Route::put('permission', 'PermissionController@putPermission');

Route::delete('permission/{id}', 'PermissionController@deletePermission');