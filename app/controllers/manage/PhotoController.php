<?php
/**
 * BabyPhotoController.php
 * 
 * @author: Cyw
 * @email: chenyunwen01@bianfeng.com
 * @created: 2014-9-1 下午5:44:37
 * @logs: 
 *       
 */
namespace App\Controllers\Manage;

use BaseController;
use View;
use PhotoModel;
use BabyModel;
use Input;
use Response;

class PhotoController extends BaseController
{
    protected $layout = 'layouts.manage';
    private $resourceUrl = 'manage/photo/';
    
    protected $qiniu;
    
    public function __construct()
    {
        $this->qiniu = \Qiniu\Qiniu::create(array(
            'access_key' => \Config::get('qiniu.ak'),
            'secret_key' => \Config::get('qiniu.sk'),
            'bucket'     => \Config::get('qiniu.bk'),
        ));
    }
    
    // restfull
    /**
     * Display a listing of the resource.
     * GET /tags
     *
     * @return Response
     */
    public function index()
    {
        View::share('resourceUrl', $this->resourceUrl);
        
        $photos = PhotoModel::all()->toArray();
        $babys = \BabyModel::all()->lists('name', 'id');
        
        $this->layout->with('title', '列表');
        $this->layout->content = View::make( $this->resourceUrl . 'index' )->with(compact('photos', 'babys'));
    }

    /**
     * Show the form for creating a new resource.
     * GET /user/create
     *
     * @return Response
     */
    public function create()
    {
        $babys = BabyModel::all()->lists('nickname', 'id');
        
        $bid = Input::get('bid');
        
        return View::make($this->resourceUrl . 'create')->with(compact('babys', 'bid'));
    }

    /**
     * Store a newly created resource in storage.
     * POST /tags
     *
     * @return Response
     */
    public function store()
    {
        if (is_super_admin()){
            $res = PhotoModel::create(Input::all());
            $code = is_object($res) ? 0 : 1;
            return $this->toJson('创建成功!', $code);
        } else {
            return $this->toJson('您没有权限!', 1);
        }
    }
    
    /**
     * 上传图片
     * 
     * @param unknown $bid
     * @return \Illuminate\Http\JsonResponse
     */
    public function upload($bid)
    {
        $file = Input::file('file');
        
        //验证
        $rules = array('file' => 'mimes:jpg,jpeg,png|max:10000');
        $data = array('file' => Input::file('file'));
        
        $validation = \Validator::make($data, $rules);
        
        if ($validation->fails()) {
            return Response::json($validation->errors()->first(), 400);
        }
        
        // 上传路径
        $destinationPath = public_path() . '/upload/';
        $fileName = $file->getClientOriginalName();
        $fileSize = $file->getClientSize();
        
        $file_prefix = date('Ymd_');
        $fileName = $file_prefix . $fileName;
        
        // 上传
        $upload_success = Input::file('file')->move($destinationPath, $fileName);
        
        if ($upload_success) {
        
            // 7niu
            $res = $this->qiniu->uploadFile(sprintf('%s/%s', $destinationPath, $fileName), $fileName);
            // 7niu end
            
            \File::delete($destinationPath . $fileName);
        
            $image = new PhotoModel;
            $image->bid = $bid;
            $image->title = explode(".", $fileName)[0];
            $image->file_name = $fileName;
            $image->file_size = $fileSize;
            $image->path = $fileName;
            $image->take_at = new \DateTime();
            $image->save();
        
            return Response::json('success', 200);
        }
        
        return Response::json('error', 400);
    }
    
    /**
     * 删除图片
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteImage()
    {
        $fileName = Input::get('file');
        PhotoModel::where('file_name', '=', $fileName)->delete();
        $destinationPath = public_path() . '/upload/';
        \File::delete($destinationPath . $fileName);
        
        // 7niu
        $this->qiniu->delete($fileName);
        // 7niu end
        
        return Response::json('success', 200);
    }
    
    
    /**
     * Display the specified resource.
     * GET /user/{id}
     *
     * @param int $id            
     * @return Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     * GET /user/{id}/edit
     *
     * @param int $id            
     * @return Response
     */
    public function edit($id)
    {
        $photo = PhotoModel::find($id)->toArray();
        
        $qiniudata = $this->qiniu->stat($photo['path'])->data;
        
        if (isset($qiniudata['error']) )
        {
            $photoInfo = array('url' => '');
        } else {
            $photoInfo = $qiniudata;
        }
        
        return View::make('manage.photo.edit')->with(compact('photo', 'photoInfo'));
    }

    /**
     * Update the specified resource in storage.
     * PUT /user/{id}
     *
     * @param int $id            
     * @return Response
     */
    public function update($id)
    {
        if(is_super_admin()) {
            $res = PhotoModel::where('id', $id)->update(Input::all());
            $code = $res > 0 ? 0 : 1;
            return $this->toJson('更新成功!', $code);
        } else {
            return $this->toJson('您没有权限!', 1);
        }
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /user/{id}
     *
     * @param int $id            
     * @return Response
     */
    public function destroy($id)
    {
        if(is_super_admin()) {
            $res = PhotoModel::where('id', $id)->first();
            
            // 7niu
            $this->qiniu->delete($res->file_name);
            // 7niu end
            
            $res = $res->delete();
            $code = $res > 0 ? 0 : 1;
            return $this->toJson('删除成功!', $code);
        } else {
            return $this->toJson('您没有权限!', 1);
        }
    }
}