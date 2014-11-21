<?php
/**
 * routes.php
 * 
 * @author rose1988.c@gmail.com
 * @version 1.0
 * @date 2014-6-29 下午5:05:13
 */

Route::get('/', array('as'=>'index','uses' => 'HomeController@index', //'before' => 'cache.fetch', //'after' => 'cache.put'
));

// 首页
Route::group(array('before' => 'auth'), function () {
    // baby
    Route::resource('baby', 'BabyController');
    // baby photo
    Route::resource('photo', 'PhotoController');
    Route::post('photo/upload/{bid}', 'PhotoController@upload');
    Route::post('photo/delete-image', 'PhotoController@deleteImage');
});

include (app_path( '/routes/action.php') );
include (app_path( '/routes/manage.php') );
include (app_path( '/routes/account.php') );
include (app_path( '/routes/api.php') );
