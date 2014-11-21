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
namespace App\Controllers\Manage;

use BaseController;
use View;
use \BabyModel;
use Input;

class BabyController extends BaseController
{

    protected $layout = 'layouts.manage';
    
    // restfull
    /**
     * Display a listing of the resource.
     * GET /tags
     *
     * @return Response
     */
    public function index()
    {
        $babys = BabyModel::all()->toArray();
        $this->layout->with('title', '宝宝列表');
        $this->layout->content = View::make('manage.baby.index')->with(compact('babys'));
    }

    /**
     * Show the form for creating a new resource.
     * GET /user/create
     *
     * @return Response
     */
    public function create()
    {
        return View::make('manage.baby.create');
    }

    /**
     * Store a newly created resource in storage.
     * POST /tags
     *
     * @return Response
     */
    public function store()
    {
        if (is_super_admin()) {
            $res = BabyModel::create(Input::all());
            $code = is_object($res) ? 0 : 1;
            return $this->toJson('创建成功!', $code);
        } else {
            return $this->toJson('您没有权限!', 1);
        }
    }

    /**
     * Display the specified resource.
     * GET /user/{id}
     *
     * @param int $id            
     * @return Response
     */
    public function show($id)
    {}

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
        
        return View::make('manage.baby.edit')->with(compact('baby'));
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
        if (is_super_admin()) {
            $res = BabyModel::where('id', $id)->update(Input::all());
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
        if (is_super_admin()) {
            $res = BabyModel::where('id', '=', $id)->forceDelete();
            
            \PhotoModel::where('bid', $id)->forceDelete();
            
            $code = $res > 0 ? 0 : 1;
            return $this->toJson('删除成功!', $code);
        } else {
            return $this->toJson('您没有权限!', 1);
        }
    }
}