@extends('auth')

@section('title')
Login
@endsection

@section('content')

<h3 class="form-title form-title-first"><i class="fa fa-lock"></i> Login</h3>

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

<form role="form" method="POST" action="{{ url('/auth/employee') }}" >

	<input type="hidden" name="_token" value="{{ csrf_token() }}">

	<div class="form-group">
		<label>Username</label>
		<input type="text" class="form-control" name="username" value="{{ old('username') }}">
	</div>
	<div class="form-group">
		<label>Password</label>
		<input type="password" class="form-control" name="password">
	</div>
	<div class="form-group">
		<div class="checkbox">
		  <label>
			<input type="checkbox" name="remember"> Remember Me
		  </label>
		</div>
	</div>
	<div class="pull-left">
		<button type="submit" class="btn btn-primary ">Login</button>
		<a class="btn btn-default " href="{{ url('auth/register') }}">Register</a>
		<a class="btn btn-link" href="{{ url('/password/email') }}">Forgot Your Password?</a>
	</div>
</form>


@endsection
