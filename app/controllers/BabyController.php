<?php

/**
 * BabyController.php
 * 
 * @author: Cyw
 * @email: chenyunwen01@bianfeng.com
 * @created: 2014-9-1 下午1:53:40
 * @logs: 
 *       
 */
use \Service\Repository\PhotoRepository;
class BabyController extends BaseController
{
    protected $layout = 'layouts.index';
    
    // restfull
    /**
     * Display a listing of the resource.
     * GET /tags
     *
     * @return Response
     */
    public function index()
    {
        $this->layout->with('title', '我的宝宝');
        $this->layout->content = View::make('baby.index');
    }
    
    /**
     * Show the form for creating a new resource.
     * GET /user/create
     *
     * @return Response
     */
    public function create()
    {
        return View::make('baby.create');
    }
    
    /**
     * Store a newly created resource in storage.
     * POST /tags
     *
     * @return Response
     */
    public function store()
    {
        $res = BabyModel::create(array_merge(Input::all(), array(
            'userid' => Auth::user()->id 
        )));
        $code = is_object($res) ? 0 : 1;
        
        \Service\Repository\BabyRepository::setUserBabys();
        
        return $this->toJson('创建成功!', $code);
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
        $baby = BabyModel::find($id)->toArray();
        
        return View::make('baby.edit')->with(compact('baby'));
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
        if (is_super_admin()){
            $res = BabyModel::where('id', $id)->update(Input::all());
            $code = $res > 0 ? 0 : 1;
            return $this->toJson('更新成功!', $code);
        } else{
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
        if (is_super_admin()){
            $res = BabyModel::where('id', $id)->first();
            $res = $res->forceDelete();
            $code = $res > 0 ? 0 : 1;
            return $this->toJson('删除成功!', $code);
        } else{
            return $this->toJson('您没有权限!', 1);
        }
    }
}