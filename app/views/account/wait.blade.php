@section('content')

<div class="signinpanel">
        
        <div class="row">
            
            <div class="col-md-7">
                
                <div class="signin-info">
                    <div class="logopanel">
                        <h1><span>[</span> 等待审核 <span>]</span></h1>
                    </div><!-- logopanel -->
                
                    <div class="mb20"></div>
                
                    <h5><strong>欢迎来到未知的世界! 访问后台需管理员审核!</strong></h5>
                    
                    <a href="<?php echo URL::previous();?>" class="btn btn-success">返回</a>
                </div><!-- signin0-info -->
            
            </div><!-- col-sm-7 -->
            
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