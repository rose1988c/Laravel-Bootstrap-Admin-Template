<?php
/**
 * BabyRepository.php
 * 
 * @author: Cyw
 * @email: chenyunwen01@bianfeng.com
 * @created: 2014-9-27 下午4:51:00
 * @logs: 
 *       
 */
namespace Service\Repository;
use BabyModel;
use Auth;
use Session;
class BabyRepository
{
    public static function setUserBabys()
    {
        if (Auth::check()){
            $mybabys = BabyModel::where('userid', Auth::user()->id)->get()->toArray();
            Session::put('mybabys', $mybabys);
        }
    }
}