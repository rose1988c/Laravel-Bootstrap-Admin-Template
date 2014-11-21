<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//记录 action_log
    $user = Auth::user();
    if ($user && Request::isMethod('post') ) {
        $data = array(
            'ip' => Request::getClientIp(),
            'url' => Request::url(),
            'method' => Request::getMethod(),
            'action' => Request::path(),
            'username' => is_object($user) ? $user->username : '',
        );
        ActionLogModel::create($data);
    }
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
    if (Auth::guest())
        return Redirect::guest('login');
});

Route::filter('auth.manage', function()
{
    if (Auth::guest()) {
        return Redirect::guest('login');
    } else {
        if (!is_admin())
        {
            return Redirect::to('logwait');
        }
    }
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});

Route::filter('dev', function()
{
    if (app()->environment() != 'dev') return Redirect::to(route('index'));
});

Route::filter('cache.fetch', 'Service\Filters\CacheFilter@fetch');
Route::filter('cache.put', 'Service\Filters\CacheFilter@put');
Route::filter('cache.delete', 'Service\Filters\CacheFilter@delete');
Route::filter('cache.flush', 'Service\Filters\CacheFilter@flush');