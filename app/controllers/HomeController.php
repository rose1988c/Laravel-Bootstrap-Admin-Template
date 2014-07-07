<?php
class HomeController extends BaseController
{
    
    /*
     * |-------------------------------------------------------------------------- | Default Home Controller |-------------------------------------------------------------------------- | | You may wish to use controllers instead of, or in addition to, Closure | based routes. That's great! Here is an example controller method to | get you started. To route to this controller, just add the route: | |	Route::get('/', 'HomeController@showWelcome'); |
     */
    public function index()
    {
        if (Auth::check ()) {
            echo Auth::user()->username . '  ';
        }
        return 'hello, everybody! <a href="/manage">传送后台</a>';
    }
}