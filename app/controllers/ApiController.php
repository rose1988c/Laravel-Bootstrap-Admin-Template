<?php
/**
 * ApiController.php
 * 
 * @author: Cyw
 * @email: chenyunwen01@bianfeng.com
 * @created: 2014-9-29 下午3:35:53
 * @logs: 
 *       
 */
use Service\Repository\PhotoRepository;
class ApiController extends BaseController
{
    /**
     * cat photos
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function photos()
    {
        $page = Input::get('page', 1);
        $perpage = Input::get('perpage', 20);
        $data = PhotoRepository::getPhotos($page, $perpage);
        
        foreach ($data as $key => $photo) {
            $data[$key]->largeImg = QiniuImageViewUrl($photo->path);
            $data[$key]->smallImg = QiniuImageViewUrl($photo->path, array(2, 'w', 263));
            $data[$key]->baby = $photo->baby;
        }
        
        return $this->success($data, 'success', array(
            'page' => $page,
            'perpage' => $perpage,
        ));
    }
    
    public function mybabyphotos()
    {
        $page = Input::get('page', 1);
        $perpage = Input::get('perpage', 20);
        $userid = Auth::id();
        $data = PhotoRepository::getUserPhotos($userid, $page, $perpage);
        
        foreach ($data as $key => $photo) {
            $data[$key]->largeImg = QiniuImageViewUrl($photo->path);
            $data[$key]->smallImg = QiniuImageViewUrl($photo->path, array(2, 'w', 263));
            $data[$key]->baby = $photo->baby;
        }
        
        return $this->success($data, 'success', array(
            'page' => $page,
            'perpage' => $perpage,
        ));
    }
}