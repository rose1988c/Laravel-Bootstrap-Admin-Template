<?php

/**
 * BaseController.php
 * 
 * @author: rose1988c
 * @email: rose1988.c@gmail.com
 * @created: 2014-7-2 下午4:55:51
 * @logs: 
 *       
 */
class BaseController extends Controller
{

    protected function setupLayout()
    {
        if (! is_null($this->layout)) {
            $this->layout = View::make($this->layout, array(
                'menu' => $this->initMenu()
            ));
        }
    }

    /**
     * 初始化菜单
     *
     * @return array menu
     */
    private function initMenu()
    {
        // 控制器名字
        // $name = strtolower(substr(get_class($this), 0, - 10));
        
        // 菜单
        $menu = MenuModel::where('pid', 0)->orderBy('sorts', 'DESC')
            ->get()
            ->toArray();
        $menus = \Service\Common\Util::ArrayColumn($menu, 'id', 'id,pid,name,url,icons');
        
        // userMids
        $userMids = Service\Repository\UserRepository::getAuthMenus();
        
        $menus = array_filter($menus, function ($v) use($userMids)
        {
            if (in_array($v['id'], $userMids) || in_array($v['pid'], $userMids) || current($userMids) == 'all') {
                return true;
            }
        });
        
        foreach ($menus as $pid => &$parendval) {
            // 定义
            $parendval['is_active'] = '';
            $parendval['is_parent'] = '';
            $parendval['nav-active'] = '';
            
            // 顶级菜单
            if ($parendval['pid'] == 0) {
                
                $parendval['submenu'] = MenuModel::where('pid', $pid)->get()->toArray();
                $parendval['is_parent'] = empty($parendval['submenu']) ? '' : 'nav-parent';
                
                // 只有一级处理
                if (empty($parendval['submenu']) && $parendval['url'] === Request::path()) {
                    $parendval['is_active'] = 'active';
                    $parendval['is_parent'] = 'nav-parent';
                }
                
                // 子菜单
                foreach ($parendval['submenu'] as &$subval) {
                    $subval['is_active'] = '';
                    if ($subval['url'] === Request::path()) {
                        $subval['is_active'] = 'active';
                        $parendval['is_active'] = 'active';
                    }
                }
                
                unset($subval);
            }
            
            // nav-active
            if ($parendval['is_active'] && $parendval['is_parent']) {
                $parendval['nav-active'] = 'nav-active';
            }
        }
        unset($parendval);
        return $menus;
    }

    /**
     * 返回方法
     *
     * @param String $msg            
     * @param int $code            
     */
    protected function toJson($msg, $code, $data = false)
    {
        return Response::json(array(
            'code' => $code,
            'message' => $msg,
            'data' => $data
        ));
    }

    /**
     * 组装JSON数据返回
     *
     * @param intval $code            
     * @param string $message            
     * @param array $data            
     */
    protected function success($data = array(), $message = 'SUCCESS', $criteria = array())
    {
        $data = array(
            'code' => 0,
            'message' => $message,
            'data' => $data
        );
        $data = array_merge($data, $criteria);
        return $this->setContent($data);
    }

    /**
     * 组装JSON数据返回
     *
     * @param intval $code            
     * @param string $message            
     * @param array $data            
     */
    protected function error($code = 0, $message = 'ERROR', $data = array())
    {
        return $this->setContent([
            'code' => $code,
            'message' => $message,
            'data' => $data
        ]);
    }

    public function setContent($data)
    {
        return Response::json($data);
    }
}