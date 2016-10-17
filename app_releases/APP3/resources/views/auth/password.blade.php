@extends('auth')

@section('title')
Reset Password
@endsection

@section('content')
<h3 class="form-title form-title-first"><i class="fa fa-lock"></i> Reset Password</h3>
@if (count($errors) > 0)
	<div class="alert alert-danger">
		<strong>Whoops!</strong> There were some problems with your input.<br><br>
		<ul>
			@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@elseif (session('status'))
	<div class="alert alert-success">
		{{ session('status') }}
	</div>
@else
<form action="" role="form" method="POST" action="{{ url('/password/email') }}" >
	<input type="hidden" name="_token" value="{{ csrf_token() }}">

	<div class="form-group">
		<label>E-Mail Address</label>
		<input type="email" class="form-control" name="email" value="{{ old('email') }}">
	</div>
	<button type="submit" class="btn btn-primary">Send Password Reset Link</button>
</form>
@endif

@endsection
