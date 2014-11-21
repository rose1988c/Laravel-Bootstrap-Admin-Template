<?php
//------------------------------- 登录 -------------------------------
Route::any('/login',  array('as'=>'login','uses' => 'AccountController@login'));
Route::any('/signup', array('as'=>'signup','uses' => 'AccountController@signup'));
Route::get('/logout', 'AccountController@logout');
Route::any('/logwait',  'AccountController@logwait');