@extends('auth')

@section('title')
Welcome to {{ env('APP_NAME')}}
@endsection

@section('content')

<h3 class="form-title form-title-first"><i class="fa fa-envelope"></i> your need to have an account first!</h3>

<div>

	<div class="col-md-12">
		<h4>	Dear Mr. <strong>	{{ $employee->name }} </strong></h4>
	<p>
	kindly note that you need to have an account first to take the appraisal.
	</p>
	<br />
		<div class="pull-left">
			<a class="btn btn-primary " href="{{ url('auth/employee',$employee->id) }}">Login</a>
			<a class="btn btn-default " href="{{ url('employee/register',$employee->id) }}">Register</a>
			<a class="btn btn-link" href="{{ url('/password/email') }}">Forgot Your Password?</a>
		</div>
	</div>

</div>




@endsection