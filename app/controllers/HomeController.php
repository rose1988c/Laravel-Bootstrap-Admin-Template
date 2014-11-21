<?php
class HomeController extends BaseController
{
    protected $layout = 'layouts.index';
    
    public function index()
    {
        $this->layout->with('title', SITE_NAME);
        $this->layout->content = View::make('index');
    }
}