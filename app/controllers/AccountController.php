<?php
/**
 * AccountController.php
 * 
 * @author: rose1988c
 * @email: rose1988.c@gmail.com
 * @created: 2014-7-1 下午4:51:33
 * @logs: 
 *       
 */
class AccountController extends BaseController
{
    protected $layout = 'layouts.account';
    
    public function signup()
    {
        $this->layout->with('title', '用户注册');
        if (Request::server('REQUEST_METHOD') == 'POST')
        {
            // rules
            $rules = array (
                'username' => 'required',
                'email' => 'required',
                'password' => 'required'
            );
            $messages = array (
                'required' => '字段 :attribute 是必填项.'
            );
            $validator = Validator::make(Input::all(), $rules, $messages);
            
            if($validator->fails()) {
                return Redirect::to(url('/signup'))->withErrors($validator)->withInput();
            }
            
            // create
            $username = HTML::entities( Input::get('username', false) );
            $password = Input::get('password', false);
            $email = HTML::entities( Input::get('email', false) );
            
            $data = array(
                'username' => $username,
                'password' => Hash::make($password),
                'email' => $email,
            );
            
            $isexits = UserModel::where('username', $username)->orWhere('email', $email)->count();
            
            if (!$isexits){
                $user = UserModel::create($data);
                if ($user) 
                {
                    Session::flash('flash_success', '注册成功!');
                    return Redirect::to(url('/login'));
                } else {
                    Session::flash('flash_error', '注册失败!');
                    return Redirect::to('signup');
                }
            } else {
                Session::flash('flash_error', '注册失败, 账号已存在!');
                return Redirect::to('signup');
            }
            
        } else {
            $this->layout->content = View::make('account.signup');
        }
    }
    
    public function login() {
        $this->layout->with('title', '用户登录');
        
        if (Request::server('REQUEST_METHOD') == 'POST')
        {
            $rules = array (
                'username' => 'required',
                'password' => 'required' 
            );
            $messages = array (
                'required' => 'The :attribute field is required.' 
            );
            $validator = Validator::make(Input::all(), $rules, $messages);
            
            if($validator->fails()) {
                return Redirect::to('login')->withErrors($validator)->withInput();
            }
            
            // 验证
            $username = HTML::entities( Input::get('username', false) );
            $password = Input::get('password', false);
            $remember = Input::get('remember', 0);
            $remember = $remember ? true : false;
            
            if (Auth::attempt(array('username' => $username, 'password' => $password), $remember))
            {
                UserModel::where('username', $username)->update(array(
                    'ip' => Request::getClientIp(),
                    'login_at' => date('Y-m-d H:i:s', Request::server('REQUEST_TIME')),
                ));
                
                //获取用户宝宝信息
                \Service\Repository\BabyRepository::setUserBabys();
                
                return Redirect::intended('/');
            } else {
                Session::flash('flash_notice', '用户或密码错误!');
                return Redirect::to('/login');
            } 
            
        } else {
            $this->layout->content = View::make('account.login');
        }
    }

    public function logout() {
        Auth::logout();
        Session::flush();
        return Redirect::intended('/');
    }
    
    public function logwait()
    {
        if (is_admin())
        {
            return Redirect::intended('/');
        }
        
        $this->layout->with('title', '访问后台需管理员审核');
        $this->layout->content = View::make('account.wait');
    }
}