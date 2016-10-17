@extends('auth')

@section('content')
<div class="ie-clear"></div>
<div class="container center">
  <div class="form">
  						@if (count($errors) > 0)
							<ul style="text-align: center; color: rgb(255, 255, 255);">
								@foreach ($errors->all() as $error)
									<span  >{{ $error }}</span></br>
								@endforeach
							</ul>
					@endif
    <h1 class="title">التسجيل</h1>

					<form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/register') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label"style="color:#fff;">الأسم</label>
							<div class="col-md-8">
								<input type="text" class="form-control" name="name" value="{{ old('name') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label"style="color:#fff;">الأيميل</label>
							<div class="col-md-8">
								<input type="email" class="form-control" name="email" value="{{ old('email') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label"style="color:#fff;">الباسورد</label>
							<div class="col-md-8">
								<input type="password" class="form-control" name="password">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label"style="color:#fff;">تأكيد الباسورد</label>
							<div class="col-md-8">
								<input type="password" class="form-control" name="password_confirmation">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary"style="background-color:#4189aa !important;">
									تسجيل
								</button>
							</div>
						</div>
					</form>
				    <div class="ie-clear"></div>
  </div>
  <!--//form--> 
  
</div>
@endsection
