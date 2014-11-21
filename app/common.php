<?php
## defined
defined('USER_ROLE_SUPER_ADMIN') or define('USER_ROLE_SUPER_ADMIN', 1);
defined('USER_ROLE_ADMIN') or define('USER_ROLE_ADMIN', 2);
defined('USER_ROLE_USER') or define('USER_ROLE_USER', 3);

defined('SITE_NAME') or define('SITE_NAME', '宝宝分享平台');

function is_super_admin()
{
    if (Auth::check() && in_array(Auth::user()->getAuthRoleId(), array(USER_ROLE_SUPER_ADMIN))){
        return true;
    }
    return false;
}

function is_admin()
{
    $group_admin = array(
        USER_ROLE_SUPER_ADMIN,
        USER_ROLE_ADMIN,
    );
    
    if (Auth::check() && in_array(Auth::user()->getAuthRoleId(), $group_admin)){
        return true;
    }
    return false;
}