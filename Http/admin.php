<?php

Route::group(['prefix' => 'user'], function () {
    Route::get('users', 'UserController@getUsers');

    Route::get('user/{user_id}', 'UserController@getUser');

    Route::post('user', 'UserController@postUser');

    Route::put('user/{user_id}', 'UserController@putUser');

    Route::delete('user/{user_id}', 'UserController@deleteUser');
});

Route::group(['prefix' => 'menu'], function () {
    Route::get('menus', 'MenuController@getMenus');

    Route::post('menu', 'MenuController@postMenu');

    Route::put('menu/{menu_id}', 'MenuController@putMenu');

    Route::delete('menu/{menu_id}', 'MenuController@deleteMenu');
});

Route::group(['prefix' => 'category'], function () {
    Route::get('categories', 'CategoryController@getCategories');

    Route::post('category', 'CategoryController@postCategory');

    Route::put('category/{category_id}', 'CategoryController@putCategory');

    Route::delete('category/{category_id}', 'CategoryController@deleteCategory');
});

Route::group(['prefix' => 'language'], function () {
    Route::get('languages', 'LanguageController@getLanguages');

    Route::post('language', 'LanguageController@postLanguage');

    Route::put('language/{language_id}', 'LanguageController@putLanguage');

    Route::delete('language/{language_id}', 'LanguageController@deleteLanguage');
});

Route::group(['prefix' => 'role'], function () {
    Route::get('roles', 'RoleController@getRoles');

    Route::get('role/{role_id}', 'RoleController@getRole');

    Route::post('role', 'RoleController@postRole');

    Route::put('role/{role_id}', 'RoleController@putRole');

    Route::delete('role/{role_id}', 'RoleController@deleteRole');
});

Route::group(['prefix' => 'permission'], function () {
    Route::get('permissions', 'PermissionController@getPermissions');

    Route::post('permission', 'PermissionController@postPermission');

    Route::put('permission/{permission_id}', 'PermissionController@putPermission');

    Route::delete('permission/{permission_id}', 'PermissionController@deletePermission');
});

Route::group(['prefix' => 'option'], function () {
    Route::get('options', 'SiteOptionsController@getOptions');

    Route::post('option', 'SiteOptionsController@postOption');

    Route::put('option/{option_key}', 'SiteOptionsController@putOption');

    Route::delete('option/{option_key}', 'SiteOptionsController@deleteOption');
});

