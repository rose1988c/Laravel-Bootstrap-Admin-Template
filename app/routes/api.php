<?php
Route::group(array('prefix' => 'api'), function () {
    Route::get('photos', 'ApiController@photos');
    Route::get('mybabyphotos', 'ApiController@mybabyphotos');
});