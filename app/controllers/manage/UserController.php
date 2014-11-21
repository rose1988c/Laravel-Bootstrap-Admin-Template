<?php
/**
 * UserController.php
 * 
 * @author: rose1988c
 * @email: rose1988.c@gmail.com
 * @created: 2014-7-1 下午3:18:09
 * @logs: 
 *       
 */
namespace App\Controllers\Manage;
use BaseController;
use View;
use UserModel;
use Datatables;
use Input;

class UserController extends BaseController
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
        $this->layout->with('title', '用户列表');
        $this->layout->content = View::make('manage.user.list');
    }
    
    /**
     * Show the form for creating a new resource.
     * GET /user/create
     *
     * @return Response
     */
    public function create()
    {
        //
    }
    
    /**
     * Store a newly created resource in storage.
     * POST /tags
     *
     * @return Response
     */
    public function store()
    {
        //
    }
    
    /**
     * Display the specified resource.
     * GET /user/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
    }
    
    /**
     * Show the form for editing the specified resource.
     * GET /user/{id}/edit
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $user = UserModel::find($id)->toArray();
        
        return View::make('manage.user.edit')->with(compact('user'));
    }
    
    /**
     * Update the specified resource in storage.
     * PUT /user/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        if (is_super_admin()){
            $res = UserModel::where('id', $id)->update(array(
                'nickname' => e(Input::get('nickname')),
                'truename' => e(Input::get('truename')),
                'email' => e(Input::get('email')),
                'roleid' => e(Input::get('roleid')),
            ));
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
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        if (is_super_admin()){
            $res = UserModel::where('id', $id)->delete();
            $code = $res > 0 ? 0 : 1;
            return $this->toJson('删除成功!', $code);
        } else {
            return $this->toJson('您没有权限!', 1);
        }
	}
	
	/**
	 * datatables 获取数据
	 * 
	 * @return Ambigous <NULL, \Illuminate\Http\JsonResponse, multitype:number multitype: NULL >
	 */
	public function userList_ajax()
	{
	    $posts = UserModel::select(array('id', 'username', 'roleid', 'email', 'ip', 'login_at'));
	    
	    //->remove_column('id')
	    
	    $make = Datatables::of($posts)
            ->edit_column('login_at', '
                @if(date("Y-m-d",strtotime($login_at)) == date("Y-m-d"))
                    <span class="label label-success">{{$login_at}}</span>
                @else
                    <span class="label label-default">{{$login_at}}</span>
                @endif
            ')
            ->edit_column('roleid','
                @if($roleid == USER_ROLE_SUPER_ADMIN)
                    <span class="label label-success">{{ \Service\Common\Html::$roles [$roleid] }}</span>
                @else
                    <span class="label label-default">{{ \Service\Common\Html::$roles [$roleid] }}</span>
                @endif
        ');
	    
	    if (is_super_admin()){
	        $make->add_column('operations','
                <a href="{{ url ("manage", array("user", $id, "edit" )) }}" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"></i></a>
                <a href="#deleteModal" rel="{{$id}}" title="{{$username}}" data-toggle="modal" data-target="#deleteModal" class="delete-row"><i class="fa fa-trash-o"></i></a>
            ');
	    }
	    return $make->make();
	}
}