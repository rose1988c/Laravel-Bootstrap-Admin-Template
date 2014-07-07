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
class ManageController extends BaseController
{
    protected $layout = 'layouts.manage';
    protected $data = array();
    
    public function index()
    {
        $this->layout->with('title', '后台管理');
        $this->layout->content = View::make('manage.index');
    }
}