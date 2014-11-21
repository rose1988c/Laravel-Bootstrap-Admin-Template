<?php
Route::get('/flush', array('before' => 'cache.flush', 'uses' => function(){
    return Redirect::intended('/');
}));

//------------------------------- 本地使用 -------------------------------
Route::group(array('before' => 'dev'), function()
{
    Route::get('/env', function(){
        
        echo '<pre>';
        print_r(Session::get('mybabys'));
        echo '</pre>';
        
        return app::environment();
    });
});