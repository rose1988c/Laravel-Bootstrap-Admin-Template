<?php
/**
 * ManageController.php
 * 
 * @author: Cyw
 * @email: chenyunwen01@bianfeng.com
 * @created: 2014-6-20 下午1:38:54
 * @logs: 
 *       
 */
namespace App\Controllers\Manage;
use BaseController;
use View;

class ManageController extends BaseController
{
    protected $layout = 'layouts.manage';
    public function index()
    {
        $this->layout->with('title', '后台管理');
        $this->layout->content = View::make('manage.index');
    }
}