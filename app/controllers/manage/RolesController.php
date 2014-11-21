<?php
namespace App\Controllers\Manage;
use BaseController;
use View;
use Datatables;
use RoleModel;
use MenuModel;
use Input;

class RolesController extends \BaseController
{
    
    protected $layout = 'layouts.manage';

    /**
     * Display a listing of the resource.
     * GET /roles
     *
     * @return Response
     */
    public function index() {
        
        $roles = RoleModel::all()->toArray();
        
        $this->layout->with('title', '角色列表');
        $this->layout->content = View::make('manage.roles.index')->with(compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     * GET /roles/create
     *
     * @return Response
     */
    public function create() {
        return View::make('manage.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     * POST /roles
     *
     * @return Response
     */
    public function store() {
        if (is_super_admin()){
            $res = RoleModel::create(array(
                'name' => e(Input::get('name')),
            ));
            $code = is_object($res) ? 0 : 1;
        
            return $this->toJson('创建成功!', $code);
        } else {
            return $this->toJson('您没有权限!', 1);
        }
    }

    /**
     * Display the specified resource.
     * GET /roles/{id}
     *
     * @param int $id            
     * @return Response
     */
    public function show($id) {
        // 当前用户可赋予的权限
        $userMids = \Service\Repository\UserRepository::getAuthMenus();
        
        // 角色
        $role = RoleModel::find($id)->toArray();
        
        // 角色对应菜单id
        $mid = isset($role['mid']) ? explode(',', $role['mid']) : array();
        
        // ztree
        $menus = MenuModel::all()->toArray();
        
        foreach ((array)$menus as $key => $value) {
            
            $menus[$key]['open'] = $value['pid'] == 0 ;// open
            $menus[$key]['checked'] = in_array($value['id'], $mid) ? true : false;// checked
            $menus[$key]['chkDisabled'] = in_array($value['id'], $mid) || in_array($value['id'], $userMids) || current($userMids) == 'all' ? false : true;// chkDisabled
            
            $menus[$key]['pId'] = $value['pid'];
            $menus[$key]['url'] = url($value['url']);
            
            // 过滤
            unset($menus[$key]['pid']);
            if ($menus[$key]['chkDisabled'] && !in_array($value['pid'], $mid))
            {
                unset($menus[$key]);
            }
        }
        $menus = array_values($menus);
        // ztree end
        
        return View::make('manage.roles.show')->with(compact('role', 'menus'));
    }

    /**
     * Show the form for editing the specified resource.
     * GET /roles/{id}/edit
     *
     * @param int $id            
     * @return Response
     */
    public function edit($id) {
        $role = RoleModel::find($id)->toArray();
        return View::make('manage.roles.edit')->with('role', $role);
    }

    /**
     * Update the specified resource in storage.
     * PUT /roles/{id}
     *
     * @param int $id            
     * @return Response
     */
    public function update($id) {
        
        if (is_admin()){
            
            $name = e(Input::get('name'));
            $mid = e(Input::get('mid'));
            
            $data = array();
            
            if ($name) {
                $data = array_merge($data, array('name' => $name));
            }
            if ($mid) {
                $data = array_merge($data, array('mid' => $mid));
            }
            
            $res = RoleModel::where('id', $id)->update($data);
            
            $code = $res > 0 ? 0 : 1;
            
            return $this->toJson('更新成功!', $code);
        } else {
            return $this->toJson('您没有权限!', 1);
        }
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /roles/{id}
     *
     * @param int $id            
     * @return Response
     */
    public function destroy($id) {
        if (is_super_admin()){
            $res = RoleModel::where('id', $id)->delete();
            $code = $res > 0 ? 0 : 1;
        
            return $this->toJson('删除成功!', $code);
        } else {
            return $this->toJson('您没有权限!', 1);
        }
    }

}