<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport"
	content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<title>{{$title=isset($title)?$title:''}}</title>
<meta name="description" content="@yield('description')" />
<meta name="author" content="rose1988.c@gmail.com">
<meta name="keywords" content="@yield('keywords')" />
<link rel="shortcut icon" href="{{asset('assets/images/favicon.png')}}" type="image/png">

{{ HTML::style('assets/simplex/css/bootstrap.min.css?' . date("Ymd", time()) . '.css') }} 
{{ HTML::style('assets/simplex/css/base.css?' .  date("Ymd", time()) . '.css') }}
{{ HTML::style('assets/bracket/css/jquery.gritter.css?' . date("Ymd", time()) . '.css') }}

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="{{asset('assets/bracket/js/html5shiv.js')}}"></script>
    <script src="{{asset('assets/bracket/js/respond.min.js')}}"></script>
    <![endif]-->
    
@section('css')
    {{-- include all required stylesheets --}}
@show

</head>
<body>

	<section>
		<div class="navbar navbar-default">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse"
						data-target=".navbar-responsive-collapse">
						<span class="icon-bar"></span> <span class="icon-bar"></span> <span
							class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="/">BabyShare</a>
				</div>
				<div class="navbar-collapse collapse navbar-responsive-collapse">
					<ul class="nav navbar-nav">
						<li @if (Route::currentRouteName() == 'index')
						    class="active"
						    @endif
						><a href="/">首页</a></li>
						<li @if (Route::currentRouteName() == 'baby.index')
						    class="active"
						    @endif
						><a href="/baby">我的宝贝</a></li>
						
						{{---
						<li class="dropdown"><a href="#" class="dropdown-toggle"
							data-toggle="dropdown">Dropdown <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="#">Action</a></li>
								<li><a href="#">Another action</a></li>
								<li><a href="#">Something else here</a></li>
								<li class="divider"></li>
								<li class="dropdown-header">Dropdown header</li>
								<li><a href="#">Separated link</a></li>
								<li><a href="#">One more separated link</a></li>
							</ul></li>
					   ---}}
					</ul>
					<ul class="nav navbar-nav navbar-right">
					
					  @if (!Auth::check())
						<li><a href="/login">登录</a></li>
						<li><a href="/signup">注册</a></li>
						@else
						<li>
    				        <a href="{{url('baby/create')}}" data-toggle="modal" data-target="#addBaby">添加宝宝</a>
    					</li>
    					
    					@foreach ((array)Session::get('mybabys') as $bb)
    					<li><a href="{{url('photo/create?bid=' . $bb['id'])}}" data-toggle="modal" data-target="#addPhoto">上传[{{$bb['nickname']}}]照片</a></li>
    					@endforeach
    					
						<li class="dropdown">
						    <a href="#" class="dropdown-toggle"	data-toggle="dropdown">{{Auth::user()->username}}<b class="caret"></b>
							</a>
							<ul class="dropdown-menu">
							  @if (is_admin())
								<li><a href="/manage">后台管理</a></li>
								@endif
								<li><a href="/baby">我的baby</a></li>
								<li class="divider"></li>
								<li><a href="/logout">退出</a></li>
							</ul></li>
						@endif
					</ul>
				</div>

			</div>
		</div>
	</section>
	
	<section class="Modal">
    	<!-- addModal -->
        <div class="modal fade" id="addBaby" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
          <div class="modal-dialog">
            <div class="modal-content">
            </div>
          </div>
        </div>
        
        <div class="modal fade" id="addPhoto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
          <div class="modal-dialog">
            <div class="modal-content">
            </div>
          </div>
        </div>
	</section>

	<div class="container">
		<section>@yield('content')</section>
	</div>

	<div class="copyrights">
		<!--start copyrights-->
		<div class="row note">
			<div class="top">
				<span><a href="/" title="">- BabyShare</a> Copyright ©
					{{date('Y')}}.</span> By <a href="mailto:rose1988.c@gmail.com">rose1988c</a>&nbsp;<a
					href="#top" class="toplink"> </a>
			</div>
		</div>
		<!--end copyrights-->
	</div>
	
	<!-- gototop -->
	<div id="backtotop" class=""><div class="bttbg"></div></div>

	<script src="{{asset('/assets/bracket/js/jquery-1.10.2.min.js')}}"></script>
	<script
		src="{{asset('/assets/bracket/js/jquery-migrate-1.2.1.min.js')}}"></script>
	<script src="{{asset('/assets/bracket/js/jquery-ui-1.10.3.min.js')}}"></script>
	<script src="{{asset('/assets/bracket/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('/assets/bracket/js/retina.min.js')}}"></script>
	<script src="{{asset('/assets/bracket/js/jquery.cookies.js')}}"></script>
	<script src="{{asset('/assets/bracket/js/jquery.gritter.min.js')}}"></script>

	
  <script type="text/javascript">
    function notify(title, content, class_name){
    	var sticky = arguments[3] || false;
    	var time = arguments[4] || '';
    	$.gritter.add({
    		title: title,
    		text: content,
        class_name: 'growl-' + class_name,
        image: '{{asset("/assets/bracket/images/screen.png")}}',
    		sticky: false,
    		time: ''
    	});
    	return false;
    };
  </script>
	
	@yield('ext')
</body>
</html>