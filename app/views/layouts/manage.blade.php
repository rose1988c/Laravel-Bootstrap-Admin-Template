<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <title>{{$title=isset($title)?$title:''}}</title>
    <meta name="description" content="@yield('description')"/>
    <meta name="author" content="rose1988.c@gmail.com">
    <meta name="keywords" content="@yield('keywords')"/>
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.png')}}" type="image/png">

    {{ HTML::style('assets/bracket/css/style.default.css?' . date("Ymd", time()) . '.css') }}
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
   
<!-- Preloader -->
<div id="preloader">
    <div id="status"><i class="fa fa-spinner fa-spin"></i></div>
</div>

<section>
  
  <div class="leftpanel">
    
    <!-- logopanel -->
    <div class="logopanel">
        <h1><span>[</span>{{$title}}<span>]</span></h1>
    </div>
    
    <!--  leftpanelinner -->
    <div class="leftpanelinner">    
        
        <!-- This is only visible to small devices -->
        <div class="visible-xs hidden-sm hidden-md hidden-lg">   
            <div class="media userlogged">
                <img alt="" src="{{asset('/assets/bracket/images/photos/loggeduser.png')}}" class="media-object">
                <div class="media-body">
                    <h4>{{Auth::user()->username}}</h4>
                    <span>"Life is so..."</span>
                </div>
            </div>
          
            <h5 class="sidebartitle actitle">Account</h5>
            <ul class="nav nav-pills nav-stacked nav-bracket mb30">
              <li><a href="profile.html"><i class="fa fa-user"></i> <span>Profile</span></a></li>
              <li><a href=""><i class="fa fa-cog"></i> <span>Account Settings</span></a></li>
              <li><a href=""><i class="fa fa-question-circle"></i> <span>Help</span></a></li>
              <li><a href="signout.html"><i class="fa fa-sign-out"></i> <span>Sign Out</span></a></li>
            </ul>
        </div>
          
        <h5 class="sidebartitle">Navigation</h5>
        <ul class="nav nav-pills nav-stacked nav-bracket">
        <?php
            $parentnav = array();
            $currentnav = array();
        ?>
        @foreach ($menu as $value)
            <?php if ( $value['nav-active'] ) { $parentnav = $value; } ?>
            <li class="{{$value['is_active']}} {{$value['is_parent']}} {{$value['nav-active']}}">
                <a href="{{url($value['url'])}}"><i class="{{$value['icons']}}"></i> <span>{{$value['name']}}</span></a>
                @if ($value['submenu'])
                <ul class="children" style="<?php if($value['is_active']) { echo 'display:block;'; }?>">
                    @foreach ($value['submenu'] as $val)
                        <?php if ($val['is_active']) { $currentnav = $val; } ?>
                        <li class="{{$val['is_active']}}"><a href="{{url($val['url'])}}"><i class="fa fa-caret-right"></i>{{$val['name']}}</a></li>
                    @endforeach        
                </ul>                    
                @endif
            </li>
        @endforeach
        </ul>
    </div><!-- leftpanelinner -->
  </div><!-- leftpanel -->
  
  <div class="mainpanel">
    <div class="headerbar">
      <a class="menutoggle"><i class="fa fa-bars"></i></a>
      
<!--       <form class="searchform" action="index.html" method="post"> -->
<!--         <input type="text" class="form-control" name="keyword" placeholder="Search here..." /> -->
<!--       </form> -->
      
      <div class="header-right">
        <ul class="headermenu">
<!--           <li> -->
<!--             <div class="btn-group"> -->
<!--               <button class="btn btn-default dropdown-toggle tp-icon" data-toggle="dropdown"> -->
<!--                 <i class="glyphicon glyphicon-user"></i> -->
<!--                 <span class="badge">2</span> -->
<!--               </button> -->
<!--               <div class="dropdown-menu dropdown-menu-head pull-right"> -->
<!--                 <h5 class="title">2 Newly Registered Users</h5> -->
<!--                 <ul class="dropdown-list user-list"> -->
<!--                   <li class="new"> -->
<!--                     <div class="thumb"><a href=""><img src="{{asset('/assets/bracket/images/photos/user1.png')}}" alt="" /></a></div> -->
<!--                     <div class="desc"> -->
<!--                       <h5><a href="">Draniem Daamul (@draniem)</a> <span class="badge badge-success">new</span></h5> -->
<!--                     </div> -->
<!--                   </li> -->
<!--                   <li class="new"> -->
<!--                     <div class="thumb"><a href=""><img src="{{asset('/assets/bracket/images/photos/user2.png')}}" alt="" /></a></div> -->
<!--                     <div class="desc"> -->
<!--                       <h5><a href="">Zaham Sindilmaca (@zaham)</a> <span class="badge badge-success">new</span></h5> -->
<!--                     </div> -->
<!--                   </li> -->
<!--                   <li> -->
<!--                     <div class="thumb"><a href=""><img src="{{asset('/assets/bracket/images/photos/user3.png')}}" alt="" /></a></div> -->
<!--                     <div class="desc"> -->
<!--                       <h5><a href="">Weno Carasbong (@wenocar)</a></h5> -->
<!--                     </div> -->
<!--                   </li> -->
<!--                   <li> -->
<!--                     <div class="thumb"><a href=""><img src="{{asset('/assets/bracket/images/photos/user4.png')}}" alt="" /></a></div> -->
<!--                     <div class="desc"> -->
<!--                       <h5><a href="">Nusja Nawancali (@nusja)</a></h5> -->
<!--                     </div> -->
<!--                   </li> -->
<!--                   <li> -->
<!--                     <div class="thumb"><a href=""><img src="{{asset('/assets/bracket/images/photos/user5.png')}}" alt="" /></a></div> -->
<!--                     <div class="desc"> -->
<!--                       <h5><a href="">Lane Kitmari (@lane_kitmare)</a></h5> -->
<!--                     </div> -->
<!--                   </li> -->
<!--                   <li class="new"><a href="">See All Users</a></li> -->
<!--                 </ul> -->
<!--               </div> -->
<!--             </div> -->
<!--           </li> -->
<!--           <li> -->
<!--             <div class="btn-group"> -->
<!--               <button class="btn btn-default dropdown-toggle tp-icon" data-toggle="dropdown"> -->
<!--                 <i class="glyphicon glyphicon-envelope"></i> -->
<!--                 <span class="badge">1</span> -->
<!--               </button> -->
<!--               <div class="dropdown-menu dropdown-menu-head pull-right"> -->
<!--                 <h5 class="title">You Have 1 New Message</h5> -->
<!--                 <ul class="dropdown-list gen-list"> -->
<!--                   <li class="new"> -->
<!--                     <a href=""> -->
<!--                     <span class="thumb"><img src="{{asset('/assets/bracket/images/photos/user1.png')}}" alt="" /></span> -->
<!--                     <span class="desc"> -->
<!--                       <span class="name">Draniem Daamul <span class="badge badge-success">new</span></span> -->
<!--                       <span class="msg">Lorem ipsum dolor sit amet...</span> -->
<!--                     </span> -->
<!--                     </a> -->
<!--                   </li> -->
<!--                   <li> -->
<!--                     <a href=""> -->
<!--                     <span class="thumb"><img src="{{asset('/assets/bracket/images/photos/user2.png')}}" alt="" /></span> -->
<!--                     <span class="desc"> -->
<!--                       <span class="name">Nusja Nawancali</span> -->
<!--                       <span class="msg">Lorem ipsum dolor sit amet...</span> -->
<!--                     </span> -->
<!--                     </a> -->
<!--                   </li> -->
<!--                   <li> -->
<!--                     <a href=""> -->
<!--                     <span class="thumb"><img src="{{asset('/assets/bracket/images/photos/user3.png')}}" alt="" /></span> -->
<!--                     <span class="desc"> -->
<!--                       <span class="name">Weno Carasbong</span> -->
<!--                       <span class="msg">Lorem ipsum dolor sit amet...</span> -->
<!--                     </span> -->
<!--                     </a> -->
<!--                   </li> -->
<!--                   <li> -->
<!--                     <a href=""> -->
<!--                     <span class="thumb"><img src="{{asset('/assets/bracket/images/photos/user4.png')}}" alt="" /></span> -->
<!--                     <span class="desc"> -->
<!--                       <span class="name">Zaham Sindilmaca</span> -->
<!--                       <span class="msg">Lorem ipsum dolor sit amet...</span> -->
<!--                     </span> -->
<!--                     </a> -->
<!--                   </li> -->
<!--                   <li> -->
<!--                     <a href=""> -->
<!--                     <span class="thumb"><img src="{{asset('/assets/bracket/images/photos/user5.png')}}" alt="" /></span> -->
<!--                     <span class="desc"> -->
<!--                       <span class="name">Veno Leongal</span> -->
<!--                       <span class="msg">Lorem ipsum dolor sit amet...</span> -->
<!--                     </span> -->
<!--                     </a> -->
<!--                   </li> -->
<!--                   <li class="new"><a href="">Read All Messages</a></li> -->
<!--                 </ul> -->
<!--               </div> -->
<!--             </div> -->
<!--           </li> -->
<!--           <li> -->
<!--             <div class="btn-group"> -->
<!--               <button class="btn btn-default dropdown-toggle tp-icon" data-toggle="dropdown"> -->
<!--                 <i class="glyphicon glyphicon-globe"></i> -->
<!--                 <span class="badge">5</span> -->
<!--               </button> -->
<!--               <div class="dropdown-menu dropdown-menu-head pull-right"> -->
<!--                 <h5 class="title">You Have 5 New Notifications</h5> -->
<!--                 <ul class="dropdown-list gen-list"> -->
<!--                   <li class="new"> -->
<!--                     <a href=""> -->
<!--                     <span class="thumb"><img src="{{asset('/assets/bracket/images/photos/user4.png')}}" alt="" /></span> -->
<!--                     <span class="desc"> -->
<!--                       <span class="name">Zaham Sindilmaca <span class="badge badge-success">new</span></span> -->
<!--                       <span class="msg">is now following you</span> -->
<!--                     </span> -->
<!--                     </a> -->
<!--                   </li> -->
<!--                   <li class="new"> -->
<!--                     <a href=""> -->
<!--                     <span class="thumb"><img src="{{asset('/assets/bracket/images/photos/user5.png')}}" alt="" /></span> -->
<!--                     <span class="desc"> -->
<!--                       <span class="name">Weno Carasbong <span class="badge badge-success">new</span></span> -->
<!--                       <span class="msg">is now following you</span> -->
<!--                     </span> -->
<!--                     </a> -->
<!--                   </li> -->
<!--                   <li class="new"> -->
<!--                     <a href=""> -->
<!--                     <span class="thumb"><img src="{{asset('/assets/bracket/images/photos/user3.png')}}" alt="" /></span> -->
<!--                     <span class="desc"> -->
<!--                       <span class="name">Veno Leongal <span class="badge badge-success">new</span></span> -->
<!--                       <span class="msg">likes your recent status</span> -->
<!--                     </span> -->
<!--                     </a> -->
<!--                   </li> -->
<!--                   <li class="new"> -->
<!--                     <a href=""> -->
<!--                     <span class="thumb"><img src="{{asset('/assets/bracket/images/photos/user3.png')}}" alt="" /></span> -->
<!--                     <span class="desc"> -->
<!--                       <span class="name">Nusja Nawancali <span class="badge badge-success">new</span></span> -->
<!--                       <span class="msg">downloaded your work</span> -->
<!--                     </span> -->
<!--                     </a> -->
<!--                   </li> -->
<!--                   <li class="new"> -->
<!--                     <a href=""> -->
<!--                     <span class="thumb"><img src="{{asset('/assets/bracket/images/photos/user3.png')}}" alt="" /></span> -->
<!--                     <span class="desc"> -->
<!--                       <span class="name">Nusja Nawancali <span class="badge badge-success">new</span></span> -->
<!--                       <span class="msg">send you 2 messages</span> -->
<!--                     </span> -->
<!--                     </a> -->
<!--                   </li> -->
<!--                   <li class="new"><a href="">See All Notifications</a></li> -->
<!--                 </ul> -->
<!--               </div> -->
<!--             </div> -->
<!--           </li> -->
          <li>
            <div class="btn-group">
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                <img src="{{asset('/assets/bracket/images/photos/loggeduser.png')}}" alt="" />
                {{Auth::user()->username}}
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
<!--                 <li><a href=""><i class="glyphicon glyphicon-user"></i> 我的信息</a></li> -->
<!--                 <li><a href=""><i class="glyphicon glyphicon-cog"></i> 账户设置</a></li> -->
<!--                 <li><a href=""><i class="glyphicon glyphicon-question-sign"></i> 帮助</a></li> -->
                <li><a href="{{url('logout')}}"><i class="glyphicon glyphicon-log-out"></i> 退出</a></li>
              </ul>
            </div>
          </li>
<!--           <li> -->
<!--             <button id="chatview" class="btn btn-default tp-icon chat-icon"> -->
<!--                 <i class="glyphicon glyphicon-comment"></i> -->
<!--             </button> -->
<!--           </li> -->
        </ul>
      </div><!-- header-right -->
      
    </div><!-- headerbar -->
    <div class="pageheader">
      <h2>
          <i class="{{empty($parentnav) ? : $parentnav['icons']}}"></i>
          {{empty($parentnav) ? '' : $parentnav['name']}}
          <?php 
              if (!empty($currentnav))
              {
                  echo '<span>';
                  echo $currentnav['name'];
                  echo '</span>';
              }
          ?>
      </h2>
      
      <?php /*
      <div class="breadcrumb-wrapper">
        <span class="label">You are here:</span>
        <ol class="breadcrumb">
          <li><a href="{{empty($parentnav) ? '' : url($parentnav['url'])}}">{{empty($parentnav) ? : $parentnav['name']}}</a></li>
          <li class="active">{{empty($currentnav) ? '' : $currentnav['name']}}</li>
        </ol>
      </div>
      */?>
    </div>
    <?php if (isset($successMessage)) {?>
    <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <strong>成功!</strong> {{$successMessage}}.
    </div>
    <?php } ?>
    <?php if (isset($errorMessage)) {?>
    <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <strong>警告!</strong>  {{$errorMessage}}.
    </div>
    <?php } ?>
    <div class="contentpanel">
         @yield('content')
    </div><!-- contentpanel -->
    
  </div><!-- mainpanel -->
  
  <div class="rightpanel">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs nav-justified">
        <li class="active"><a href="#rp-alluser" data-toggle="tab"><i class="fa fa-users"></i></a></li>
        <li><a href="#rp-favorites" data-toggle="tab"><i class="fa fa-heart"></i></a></li>
        <li><a href="#rp-history" data-toggle="tab"><i class="fa fa-clock-o"></i></a></li>
        <li><a href="#rp-settings" data-toggle="tab"><i class="fa fa-gear"></i></a></li>
    </ul>
        
    <!-- Tab panes -->
    <div class="tab-content">
        <div class="tab-pane active" id="rp-alluser">
            <h5 class="sidebartitle">Online Users</h5>
            <ul class="chatuserlist">
                <li class="online">
                    <div class="media">
                        <a href="#" class="pull-left media-thumb">
                            <img alt="" src="{{asset('/assets/bracket/images/photos/userprofile.png')}}" class="media-object">
                        </a>
                        <div class="media-body">
                            <strong>Eileen Sideways</strong>
                            <small>Los Angeles, CA</small>
                        </div>
                    </div><!-- media -->
                </li>
                <li class="online">
                    <div class="media">
                        <a href="#" class="pull-left media-thumb">
                            <img alt="" src="{{asset('/assets/bracket/images/photos/user1.png')}}" class="media-object">
                        </a>
                        <div class="media-body">
                            <span class="pull-right badge badge-danger">2</span>
                            <strong>Zaham Sindilmaca</strong>
                            <small>San Francisco, CA</small>
                        </div>
                    </div><!-- media -->
                </li>
                <li class="online">
                    <div class="media">
                        <a href="#" class="pull-left media-thumb">
                            <img alt="" src="{{asset('/assets/bracket/images/photos/user2.png')}}" class="media-object">
                        </a>
                        <div class="media-body">
                            <strong>Nusja Nawancali</strong>
                            <small>Bangkok, Thailand</small>
                        </div>
                    </div><!-- media -->
                </li>
                <li class="online">
                    <div class="media">
                        <a href="#" class="pull-left media-thumb">
                            <img alt="" src="{{asset('/assets/bracket/images/photos/user3.png')}}" class="media-object">
                        </a>
                        <div class="media-body">
                            <strong>Renov Leongal</strong>
                            <small>Cebu City, Philippines</small>
                        </div>
                    </div><!-- media -->
                </li>
                <li class="online">
                    <div class="media">
                        <a href="#" class="pull-left media-thumb">
                            <img alt="" src="{{asset('/assets/bracket/images/photos/user4.png')}}" class="media-object">
                        </a>
                        <div class="media-body">
                            <strong>Weno Carasbong</strong>
                            <small>Tokyo, Japan</small>
                        </div>
                    </div><!-- media -->
                </li>
            </ul>
            
            <div class="mb30"></div>
            
            <h5 class="sidebartitle">Offline Users</h5>
            <ul class="chatuserlist">
                <li>
                    <div class="media">
                        <a href="#" class="pull-left media-thumb">
                            <img alt="" src="{{asset('/assets/bracket/images/photos/user5.png')}}" class="media-object">
                        </a>
                        <div class="media-body">
                            <strong>Eileen Sideways</strong>
                            <small>Los Angeles, CA</small>
                        </div>
                    </div><!-- media -->
                </li>
                <li>
                    <div class="media">
                        <a href="#" class="pull-left media-thumb">
                            <img alt="" src="{{asset('/assets/bracket/images/photos/user2.png')}}" class="media-object">
                        </a>
                        <div class="media-body">
                            <strong>Zaham Sindilmaca</strong>
                            <small>San Francisco, CA</small>
                        </div>
                    </div><!-- media -->
                </li>
                <li>
                    <div class="media">
                        <a href="#" class="pull-left media-thumb">
                            <img alt="" src="{{asset('/assets/bracket/images/photos/user3.png')}}" class="media-object">
                        </a>
                        <div class="media-body">
                            <strong>Nusja Nawancali</strong>
                            <small>Bangkok, Thailand</small>
                        </div>
                    </div><!-- media -->
                </li>
                <li>
                    <div class="media">
                        <a href="#" class="pull-left media-thumb">
                            <img alt="" src="{{asset('/assets/bracket/images/photos/user4.png')}}" class="media-object">
                        </a>
                        <div class="media-body">
                            <strong>Renov Leongal</strong>
                            <small>Cebu City, Philippines</small>
                        </div>
                    </div><!-- media -->
                </li>
                <li>
                    <div class="media">
                        <a href="#" class="pull-left media-thumb">
                            <img alt="" src="{{asset('/assets/bracket/images/photos/user5.png')}}" class="media-object">
                        </a>
                        <div class="media-body">
                            <strong>Weno Carasbong</strong>
                            <small>Tokyo, Japan</small>
                        </div>
                    </div><!-- media -->
                </li>
                <li>
                    <div class="media">
                        <a href="#" class="pull-left media-thumb">
                            <img alt="" src="{{asset('/assets/bracket/images/photos/user4.png')}}" class="media-object">
                        </a>
                        <div class="media-body">
                            <strong>Renov Leongal</strong>
                            <small>Cebu City, Philippines</small>
                        </div>
                    </div><!-- media -->
                </li>
                <li>
                    <div class="media">
                        <a href="#" class="pull-left media-thumb">
                            <img alt="" src="{{asset('/assets/bracket/images/photos/user5.png')}}" class="media-object">
                        </a>
                        <div class="media-body">
                            <strong>Weno Carasbong</strong>
                            <small>Tokyo, Japan</small>
                        </div>
                    </div><!-- media -->
                </li>
            </ul>
        </div>
        <div class="tab-pane" id="rp-favorites">
            <h5 class="sidebartitle">Favorites</h5>
            <ul class="chatuserlist">
                <li class="online">
                    <div class="media">
                        <a href="#" class="pull-left media-thumb">
                            <img alt="" src="{{asset('/assets/bracket/images/photos/user2.png')}}" class="media-object">
                        </a>
                        <div class="media-body">
                            <strong>Eileen Sideways</strong>
                            <small>Los Angeles, CA</small>
                        </div>
                    </div><!-- media -->
                </li>
                <li>
                    <div class="media">
                        <a href="#" class="pull-left media-thumb">
                            <img alt="" src="{{asset('/assets/bracket/images/photos/user1.png')}}" class="media-object">
                        </a>
                        <div class="media-body">
                            <strong>Zaham Sindilmaca</strong>
                            <small>San Francisco, CA</small>
                        </div>
                    </div><!-- media -->
                </li>
                <li>
                    <div class="media">
                        <a href="#" class="pull-left media-thumb">
                            <img alt="" src="{{asset('/assets/bracket/images/photos/user3.png')}}" class="media-object">
                        </a>
                        <div class="media-body">
                            <strong>Nusja Nawancali</strong>
                            <small>Bangkok, Thailand</small>
                        </div>
                    </div><!-- media -->
                </li>
                <li class="online">
                    <div class="media">
                        <a href="#" class="pull-left media-thumb">
                            <img alt="" src="{{asset('/assets/bracket/images/photos/user4.png')}}" class="media-object">
                        </a>
                        <div class="media-body">
                            <strong>Renov Leongal</strong>
                            <small>Cebu City, Philippines</small>
                        </div>
                    </div><!-- media -->
                </li>
                <li class="online">
                    <div class="media">
                        <a href="#" class="pull-left media-thumb">
                            <img alt="" src="{{asset('/assets/bracket/images/photos/user5.png')}}" class="media-object">
                        </a>
                        <div class="media-body">
                            <strong>Weno Carasbong</strong>
                            <small>Tokyo, Japan</small>
                        </div>
                    </div><!-- media -->
                </li>
            </ul>
        </div>
        <div class="tab-pane" id="rp-history">
            <h5 class="sidebartitle">History</h5>
            <ul class="chatuserlist">
                <li class="online">
                    <div class="media">
                        <a href="#" class="pull-left media-thumb">
                            <img alt="" src="{{asset('/assets/bracket/images/photos/user4.png')}}" class="media-object">
                        </a>
                        <div class="media-body">
                            <strong>Eileen Sideways</strong>
                            <small>Hi hello, ctc?... would you mind if I go to your...</small>
                        </div>
                    </div><!-- media -->
                </li>
                <li>
                    <div class="media">
                        <a href="#" class="pull-left media-thumb">
                            <img alt="" src="{{asset('/assets/bracket/images/photos/user2.png')}}" class="media-object">
                        </a>
                        <div class="media-body">
                            <strong>Zaham Sindilmaca</strong>
                            <small>This is to inform you that your product that we...</small>
                        </div>
                    </div><!-- media -->
                </li>
                <li>
                    <div class="media">
                        <a href="#" class="pull-left media-thumb">
                            <img alt="" src="{{asset('/assets/bracket/images/photos/user3.png')}}" class="media-object">
                        </a>
                        <div class="media-body">
                            <strong>Nusja Nawancali</strong>
                            <small>Are you willing to have a long term relat...</small>
                        </div>
                    </div><!-- media -->
                </li>
            </ul>
        </div>
        <div class="tab-pane pane-settings" id="rp-settings">
            
            <h5 class="sidebartitle mb20">Settings</h5>
            <div class="form-group">
                <label class="col-xs-8 control-label">Show Offline Users</label>
                <div class="col-xs-4 control-label">
                    <div class="toggle toggle-success"></div>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-xs-8 control-label">Enable History</label>
                <div class="col-xs-4 control-label">
                    <div class="toggle toggle-success"></div>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-xs-8 control-label">Show Full Name</label>
                <div class="col-xs-4 control-label">
                    <div class="toggle-chat1 toggle-success"></div>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-xs-8 control-label">Show Location</label>
                <div class="col-xs-4 control-label">
                    <div class="toggle toggle-success"></div>
                </div>
            </div>
            
        </div><!-- tab-pane -->
        
    </div><!-- tab-content -->
  </div><!-- rightpanel -->
  
  
</section>
@yield('footer-content')

<script src="{{asset('/assets/bracket/js/jquery-1.10.2.min.js')}}"></script>
<script src="{{asset('/assets/bracket/js/jquery-migrate-1.2.1.min.js')}}"></script>
<script src="{{asset('/assets/bracket/js/jquery-ui-1.10.3.min.js')}}"></script>
<script src="{{asset('/assets/bracket/js/bootstrap.min.js')}}"></script>
<script src="{{asset('/assets/bracket/js/modernizr.min.js')}}"></script>
<script src="{{asset('/assets/bracket/js/jquery.sparkline.min.js')}}"></script>
<script src="{{asset('/assets/bracket/js/toggles.min.js')}}"></script>
<script src="{{asset('/assets/bracket/js/retina.min.js')}}"></script>
<script src="{{asset('/assets/bracket/js/jquery.cookies.js')}}"></script>
<script src="{{asset('/assets/bracket/js/jquery.gritter.min.js')}}"></script>
<script src="{{asset('/assets/bracket/js/custom.js')}}"></script>

@yield('footer')

<script type="text/javascript">
function gritterWindows(title, content, class_name) {
    jQuery.gritter.add({
        title: title,
        text:  content,
        class_name: class_name,
        image: '{{asset("/assets/bracket/images/screen.png")}}',
        sticky: false,
        time: ''
    });
};

function notify(title, text, type){
	var sticky = arguments[3] || false;
	var time = arguments[4] || '';
	$.gritter.add({
		title: title,
		text: text,
        class_name: 'growl-' + type,
		sticky: false,
		time: ''
	});
	return false;
};
</script>
</body>
</html>