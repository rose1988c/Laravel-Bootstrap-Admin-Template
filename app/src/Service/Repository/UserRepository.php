<?php
/**
 * UserRepository.php
 * 
 * @author: rose1988c
 * @email: rose1988.c@gmail.com
 * @created: 2014-7-3 上午10:16:17
 * @logs: 
 *       
 */
namespace Service\Repository;
class UserRepository {
    
    /**
     * 获取后台登陆用户的菜单
     */
    public static function getAuthMenus()
    {
        $meaus = array();
        
        if (\Auth::check()){
            // 当前用户可赋予的权限
            $userRoleId = \Auth::user()->getAuthRoleId();
            
            if ($userRoleId == USER_ROLE_SUPER_ADMIN)
            {
                $userRole['mid'] = 'all';
            } else {
                $userRole = \RoleModel::find($userRoleId)->toArray();
            }
            
            $meaus = explode(',', $userRole['mid']);
        }
        
        return $meaus;
    }
}