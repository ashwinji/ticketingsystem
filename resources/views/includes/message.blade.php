@if(Session::has('success'))
<div class="alert alert-success login-success"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {!! Session::get('success') !!} </div>
@endif

@if(Session::has('error'))
<div class="alert alert-danger login-danger"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {!! Session::get('error') !!} </div>
@endif

@if(Session::has('warning'))
<div class="alert alert-warning login-danger"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {!! Session::get('warning') !!} </div>
@endif

@if(Session::has('info'))
<div class="alert alert-info login-danger"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {!! Session::get('info') !!} </div>
@endif

@if ($errors->any())
<div class="alert alert-danger login-danger"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> 
	<ul class="list-unstyled">
		@foreach ($errors->all() as $error)
		<li>{{ $error }}</li>
		@endforeach
	</ul>
</div>
@endif