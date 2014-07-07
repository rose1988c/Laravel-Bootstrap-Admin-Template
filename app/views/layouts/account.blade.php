<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="{{asset('/assets/bracket/images/favicon.png')}}" type="image/png">

  <title>{{$title}}</title>

  <link href="{{asset('/assets/bracket/css/style.default.css')}}" rel="stylesheet">
  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="{{asset('/assets/bracket/js/html5shiv.js')}}"></script>
  <script src="{{asset('/assets/bracket/js/respond.min.js')}}"></script>
  <![endif]-->
</head>

<body class="signin">

<!-- Preloader -->
<div id="preloader">
    <div id="status"><i class="fa fa-spinner fa-spin"></i></div>
</div>

<section>
    @yield('content')
</section>

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

<script src="{{asset('/assets/bracket/js/jquery.validate.min.js')}}"></script>
<script type="text/javascript">
//     $("form").validate({
//         highlight: function(element) {
//           $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
//         },
//         success: function(element) {
//           $(element).closest('.form-group').removeClass('has-error');
//         }
//     });
</script>
</body>
</html>
