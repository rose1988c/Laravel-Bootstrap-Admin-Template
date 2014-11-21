<?php
//------------------------------- 后台管理 -------------------------------
Route::group(array('namespace' => 'App\Controllers\Manage', 'prefix' => 'manage', 'before' => 'auth.manage'),function() {

    // 后台首页
    Route::get('/', 'ManageController@index');

    // 用户管理
    Route::group(array('prefix' => 'user'),function() {
        Route::get('list/ajax', 'UserController@userList_ajax');
    });
    Route::resource('user', 'UserController');

    // 菜单管理
    Route::resource('menus', 'MenusController');

    // 角色管理
    Route::resource('roles', 'RolesController');

    // baby
    Route::resource('baby', 'BabyController');

    // baby photo
    Route::resource('photo', 'PhotoController');

    Route::group(array('after' => 'cache.flush'), function () {
        Route::post('photo/upload/{bid}', 'PhotoController@upload');
        Route::post('photo/delete-image', 'PhotoController@deleteImage');
    });
});