@section('content')
    <div class="signuppanel">
        
        <div class="row">
            
            <div class="col-md-6">
                
                <div class="signup-info">
                    <div class="logopanel">
                        <h1><span>[</span> 注册 <span>]</span></h1>
                    </div><!-- logopanel -->
                
                    <div class="mb20"></div>
                
                    <h5><strong>注册说明</strong></h5>
                    <p>注册账号用于登录系统</p>
                    <p>请牢记的的注册信息</p>
                    <div class="mb20"></div>
                    
                    <div class="feat-list">
                        <i class="fa fa-wrench"></i>
                        <h4 class="text-success">管理</h4>
                        <p></p>
                    </div>
                    
                    <div class="feat-list">
                        <i class="fa fa-compress"></i>
                        <h4 class="text-success">集中</h4>
                        <p></p>
                    </div>
                    
                    <div class="feat-list mb20">
                        <i class="fa fa-search-plus"></i>
                        <h4 class="text-success">查询</h4>
                        <p></p>
                    </div>
                    
                    <h4 class="mb20">更多...</h4>
                
                </div><!-- signup-info -->
            
            </div><!-- col-sm-6 -->
            
            <div class="col-md-6">
                
                <form method="post" action="<?php echo Request::server('REQUEST_URI');?>">
                    
                    <h3 class="nomargin">注册</h3>
                    <p class="mt5 mb20">已有账号? <a href="{{url('/login')}}"><strong>登录</strong></a></p>
                                        
                    <div class="mb10">
                    {{-- include the errors partial --}}
                    @include('partials.errors')
                    </div>
                    
                    <div class="mb10 form-group">
                        <label class="control-label">账号<span class="asterisk">*</span></label>
                        <input type="text" name="username" required class="form-control" />
                    </div>
                    
                    <div class="mb10 form-group">
                        <label class="control-label">密码<span class="asterisk">*</span></label>
                        <input type="password" name="password" required class="form-control" />
                    </div>
                    
<!--                     <div class="mb10 form-group"> -->
<!--                         <label class="control-label">密码确认<span class="asterisk">*</span></label> -->
<!--                         <input type="password" required class="form-control" /> -->
<!--                     </div> -->
                    
                    <div class="mb10 form-group">
                        <label class="control-label">邮箱地址<span class="asterisk">*</span></label>
                        <input type="email" required name="email" class="form-control" />
                    </div>
                    
                    <br />
                    
                    <button class="btn btn-success btn-block">加入</button>     
                </form>
            </div><!-- col-sm-6 -->
            
        </div><!-- row -->
        
        <div class="signup-footer">
            <div class="pull-left">
                &copy; 2014. All Rights Reserved.
            </div>
            <div class="pull-right">
            </div>
        </div>
        
    </div><!-- signuppanel -->
@stop