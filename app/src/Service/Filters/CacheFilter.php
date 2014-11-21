<?php 
namespace Service\Filters;

use Illuminate\Routing\Route;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Cache;
use Str;
use Session;

/**
 * Simple route caching
 *
 * USAGE:
 * Route::get('/', 'PagesController@index')->before('cache.fetch')->after('cache.set');
 */
class CacheFilter {

    /**
     * If route is cached, use that instead
     *
     * @param Route $route
     * @param Request $request
     */
    public function fetch(Route $route, Request $request) {

        $key = $this->makeCacheKey($request->url());

        if (Cache::has($key)) return Cache::get($key);
    }

    /**
     * Cache route
     *
     * @param Route $route
     * @param Request $request
     * @param Response $response
     */
    public function put(Route $route, Request $request, Response $response) {

        $key = $this->makeCacheKey($request->url());

        if (!Cache::has($key)) Cache::put($key, $response->getContent(), 60);
        
    }
    
    /**
     * 删除
     * 
     * @param Route $route
     * @param Request $request
     * @return Ambigous <mixed, \Illuminate\Cache\mixed, Closure>
     */
    public function delete(Route $route, Request $request) {

        $key = $this->makeCacheKey($request->url());

        if (Cache::has($key)) return Cache::forget($key);
    }
    
    /**
     * 删除
     * 
     * @param Route $route
     * @param Request $request
     * @return Ambigous <mixed, \Illuminate\Cache\mixed, Closure>
     */
    public function flush() {
        Session::forget('mybaby');
        Cache::flush();
        return ;
    }

    /**
     * Create a unique cache identifier/key
     *
     * @param string $url
     */
    protected function makeCacheKey($url) {

        return 'route-' . Str::slug($url);
    }
}