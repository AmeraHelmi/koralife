@extends('auth')
@section('title')
Complete registration
@endsection
@section('content')
<h3 class="form-title form-title-first"><i class="fa fa-lock"></i> Complete registration</h3>
@if (count($errors) > 0)
<div class="alert alert-danger">
		<strong>Whoops!</strong> There were some problems with your input.<br><br>
		<ul>
			@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@endif


<form role="form" method="POST" action="{{ url('/social/complete-register') }}">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<input type="hidden" name="sid" value="{{ $data['social_id']}}">

	<div class="form-group">
		<label>Name</label>
		<input type="text" class="form-control" name="name" value="{{ $data['name'] }}">
	</div>

	<div class="form-group">
		<label>Username</label>
		<input type="text" class="form-control" name="username" value="{{ old('username') }}">
	</div>

	<div class="form-group">
		<label>E-Mail Address</label>
		<input type="email" class="form-control" name="email" value="{{ $data['email'] }}" readonly>
	</div>

	<div class="form-group">
		<label>Password</label>
		<input type="password" class="form-control" name="password">
	</div>

	<div class="form-group">
		<label>Confirm Password</label>
		<input type="password" class="form-control" name="password_confirmation">
	</div>

	<div class="form-group">
		<div class="pull-left">
			<button type="submit" class="btn btn-primary">
				Register
			</button>
		</div>
	</div>
</form>

@endsection
