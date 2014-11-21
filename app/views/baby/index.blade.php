@section('content')

<div class="contentpanel">
	<div id="babylist" class="row"></div>
	<!-- row -->
</div>

@stop @section('css') {{ HTML::style('assets/simplex/css/bloglist.css?'.
date("Ymd") . '.css') }}

<!-- Add fancyBox -->
{{ HTML::style('packages/fancybox/source/jquery.fancybox.css?v=2.1.5')
}} @stop @section('ext')

{{HTML::script('assets/bracket/js/masonry.pkgd.min.js')}}

<!-- Add fancyBox -->
{{HTML::script('packages/fancybox/source/jquery.fancybox.pack.js?v=2.1.5')}}

{{HTML::script('packages/baby/babyindex.js?xx'. date("Ymd") . '.js') }} @stop
