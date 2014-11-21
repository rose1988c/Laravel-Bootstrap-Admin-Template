<?php
/**
 * PhotoRepository.php
 * 
 * @author: Cyw
 * @email: chenyunwen01@bianfeng.com
 * @created: 2014-9-27 下午4:54:15
 * @logs: 
 *       
 */
namespace Service\Repository;
use PhotoModel;
use BabyModel;
use UserModel;
use Service\Common\Util;
class PhotoRepository
{
    /**
     * 获得所有照片
     * 
     * @param number $page
     * @param number $perpage
     * @return Ambigous <multitype:, multitype:\Illuminate\Database\Query\static , array>
     */
    public static function getPhotos($page = 1, $perpage = 20)
    {
        $photos = PhotoModel::forPage($page, $perpage)->orderBy('take_at', 'desc')->get();
        return $photos;
    }
    
    /**
     * 获得用户的照片
     * 
     * @param unknown $userid
     * @param number $page
     * @param number $perpage
     * @return Ambigous <multitype:, multitype:\Illuminate\Database\Query\static , array>
     */
    public static function getUserPhotos($userid, $page = 1, $perpage = 20)
    {
        $photos = array();
        $babys = BabyModel::select('id')->whereRaw('userid = ? ', array($userid))->lists('id');
        
        if (!empty($babys))
        {
            $criteria = array(
                'bid__in' => $babys
            );
            $query = Util::packRawCriteria($criteria);

            $photos = PhotoModel::whereRaw($query['where'], $query['data'])->forPage($page, $perpage)->orderBy('take_at', 'desc')->get();
        }
        
        return $photos;
    }
    
    /**
     * 获得用户单独宝宝的照片
     * 
     * @param array $bids
     * @param number $page
     * @param number $perpage
     * @return Ambigous <multitype:, multitype:\Illuminate\Database\Query\static , array>
     */
    public static function getBabyPhotos(array $bids, $page = 1, $perpage = 20)
    {
        $photos = array();
        
        if (!empty($bids))
        {
            $criteria = array(
                'bid__in' => $bids
            );
            $query = Util::packRawCriteria($criteria);
        
            $photos = PhotoModel::whereRaw($query['where'], $query['data'])->forPage($page, $perpage)->orderBy('take_at', 'desc')->get();
        }
        
        return $photos;
    }
}