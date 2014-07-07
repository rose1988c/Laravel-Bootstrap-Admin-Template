@section('content')

<div class="signinpanel">
        
        <div class="row">
            
            <div class="col-md-7">
                
                <div class="signin-info">
                    <div class="logopanel">
                        <h1><span>[</span> 登录 <span>]</span></h1>
                    </div><!-- logopanel -->
                
                    <div class="mb20"></div>
                
                    <h5><strong>欢迎来到未知的世界!</strong></h5>
                    <ul>
                        <li><i class="fa fa-arrow-circle-o-right mr5"></i> 全新布局</li>
                        <li><i class="fa fa-arrow-circle-o-right mr5"></i> 功能齐全</li>
                        <li><i class="fa fa-arrow-circle-o-right mr5"></i> 自动化</li>
                    </ul>
                    <div class="mb20"></div>
                    <strong>没有账号？<a href="{{route('signup')}}">注册</a></strong>
                </div><!-- signin0-info -->
            
            </div><!-- col-sm-7 -->
            
            <div class="col-md-5">
                
                <form method="post" action="<?php echo Request::server('REQUEST_URI');?>">
                    <h4 class="nomargin">登录</h4>
                    <p class="mt5 mb20">登录到你的账户.</p>
                    <div class="mb10">
                    {{-- include the errors partial --}}
                    @include('partials.errors')
                    </div>
                    <input type="text" class="form-control uname" name="username" required placeholder="用户名" />
                    <input type="password" class="form-control pword" name="password" required placeholder="密码" />
                    
                    <div class="mb10">
                        <label for="remember">
                            <input type="checkbox" id="remember" name="remember" value="1" />记住密码
                        </label>
                        <a class="pull-right" href="javascript:void(0);"><small>忘记密码 ?</small></a>
                    </div>
                    
                    <button data-content="" data-container="body" class="btn btn-success btn-block" data-placement="right" type="submit">登录</button>
                    
                </form>
            </div><!-- col-sm-5 -->
            
        </div><!-- row -->
        
        <div class="signup-footer">
            <div class="pull-left">
                &copy; 2014. All Rights Reserved.
            </div>
            <div class="pull-right">
            </div>
        </div>
        
    </div><!-- signin -->
    
@stop
    
@section('footer')
@stop