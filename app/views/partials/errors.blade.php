<!-- check for flash messages -->
@if(Session::has('flash_notice'))
<div class="alert alert-info">{{ Session::get('flash_notice') }}</div>
@endif
@if(Session::has('flash_error'))
<div class="alert alert-danger">{{ Session::get('flash_error') }}</div>
@endif
@if(Session::has('flash_success'))
<div class="alert alert-success">{{ Session::get('flash_success') }}</div>
@endif

<!-- check for validation errors -->
<!-- might be a better way to display this, all errors actually...hmmmm -->
@if ( $errors->any() > 0 )
<div class="alert alert-danger">
@foreach ($errors->all() as $error)
   {{ $error }} <br />
@endforeach
</div>
@endif