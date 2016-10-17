<!doctype html>
<html lang="en" class="no-js">
<head>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<meta name="theme-color" content="#3e454c">
		<title>korelive</title>
		<link rel="shortcut icon" href="{{ asset('/admin-ui/main_images/favicon.ico')}}">
		<link rel='stylesheet' href="{{ asset('/bower_components/datatables/media/css/jquery.dataTables.min.css') }}">
		<link rel='stylesheet' href="{{ asset('/bower_components/chosen/chosen.min.css') }}">
		<link rel='stylesheet' href="{{ asset('/bower_components/fontawesome/css/font-awesome.min.css') }}">
		<link rel='stylesheet' href="{{ asset('/admin-ui/css/datatables/bootstrap.datatables.css') }}">
		<link rel='stylesheet' href="{{ asset('/admin-ui/css/style.css') }}">
		<link rel='stylesheet' href="{{ asset('/admin-ui/css/bootstrap.min.css') }}">
		<link rel='stylesheet' href="{{ asset('/admin-ui/css/bootstrap-select.css') }}">
		<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" />
		<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
		<!-- Fonts -->
  	<link href='http://fonts.googleapis.com/css?family=Oswald:300,400,700|Open+Sans:400,700,300' rel='stylesheet' type='text/css'>
		@yield('styles')
	</head>
	<body>
			<div class="brand clearfix" style="background: #134577 !important;">
					<a href="{{ url('/') }}" class="logo" style="font-size:20px;">Koralive</a>
					<div class="toggle" style="float: right;    margin-right: 35px; margin-top: 20px;">
							<span class="tog" style="color: white; margin-left: 15px;">
									<a href="#" style="color: rgb(255, 255, 255);">welcome ,{{ Auth::user()->name }}<i class="fa fa-chevron-down" style="color: white; padding-left: 15px;"  aria-hidden="true"></i></a>
							</span>
							<ul class="ts-sidebar-menu">
									<li><a href="{{ url('/auth/logout') }}" style="font-size:20px;"> Logout</a></li>
							</ul>
					</div>
			</div>
			<div class="ts-main-content">
					<nav class="ts-sidebar" style="padding-top:30px; background-color:#000 !important;" >
							<ul class="ts-sidebar-menu">
									<a href="#" ><i class="fa fa-dashboard"></i> Admin panel</a>
							</ul>
							@if(Auth::user()->role =='Admin')
							<div class="toggle">
									<span class="tog" style="color: white; margin-left: 15px;">
										<a href="#" style="color: rgb(255, 255, 255);"><i class="fa fa-chevron-down" style="color: rgb(88, 92, 100); padding-right: 15px;"  aria-hidden="true"></i>Users</a>
								  </span>
									<ul class="ts-sidebar-menu">
											<li><a href="{{ url('users') }}"><i class="fa fa-minus"></i> Users</a></li>
									</ul>
			 				</div>
							@include('menu')
							@elseif(Auth::user()->role =='Editor')
							<div class="toggle">
									<span class="tog" style="color: white; margin-left: 15px;">
											<a href="#" style="color: rgb(255, 255, 255);">
													<i class="fa fa-chevron-down" style="color: rgb(88, 92, 100); padding-right: 15px;"  aria-hidden="true"></i>Match
											</a>
				 					</span>
									<ul class="ts-sidebar-menu">
											<li>
													<a href="{{ url('reserve_player') }}">
															<i class="fa fa-minus"></i> Reserve players
													</a>
											</li>
											<li>
													<a href="{{ url('player_match') }}">
															<i class="fa fa-minus"></i> Principle players
													</a>
											</li>
											<li>
													<a href="{{ url('change_player') }}">
															<i class="fa fa-minus"></i> Changes
													</a>
											</li>
									</ul>
							</div>
							<div class="toggle">
									<span class="tog" style="color: white; margin-left: 15px;">
												<a href="#" style="color: rgb(255, 255, 255);">
														<i class="fa fa-chevron-down" style="color: rgb(88, 92, 100); padding-right: 15px;"  aria-hidden="true"></i>مباريات اليوم
												</a>
									</span>
									<ul class="ts-sidebar-menu">
									@foreach($Allmatch as $matchdetail)
											<li>
													<a href="{{ url('now',$matchdetail->match_id) }}">
															<i class="fa fa-minus"></i>
															{{ $matchdetail->T1name }} - {{ $matchdetail->T2name }}
													</a>
											</li>
   								@endforeach
							</ul>
					</div>
					@elseif(Auth::user()->role =='Analyiser')
					<div class="toggle">
							<span class="tog" style="color: white; margin-left: 15px;">
										<a href="#" style="color: rgb(255, 255, 255);">
												<i class="fa fa-chevron-down" style="color: rgb(88, 92, 100); padding-right: 15px;"  aria-hidden="true"></i>Analysis
										</a>
 							</span>
  						<ul class="ts-sidebar-menu ">
									<li>
											<a href="{{ url('analysis') }}">
													<i class="fa fa-minus"></i> Analysis
											</a>
									</li>
  						</ul>
 					</div>
					@elseif(Auth::user()->role =='Data Entry')
					@include('menu')
					@else
					<div class="toggle">
							<span class="tog" style="color: white; margin-left: 15px;">
										<a href="#" style="color: rgb(255, 255, 255);">
												<i class="fa fa-chevron-down" style="color: rgb(88, 92, 100); padding-right: 15px;"  aria-hidden="true"></i>News
										</a>
							</span>
							<ul class="ts-sidebar-menu ">
	 								<li>
											<a href="{{ url('snew') }}">
													<i class="fa fa-minus"></i> News
											</a>
									</li>
 							</ul>
					</div>
					@endif
			</nav>
			@yield('content')
			<script type="text/javascript">
						$(document).ready(function()
						{
								$("li").closest("ul").css({"display":"none"});
								$(".toggle").click(function()
								{
										$('ul', this).toggle();
								});
						});
			</script>
			<script src="http://cdn.datatables.net/plug-ins/1.10.11/i18n/Arabic.json"></script>
			<script type="text/javascript" src="{{ asset('/admin-ui/js/bootstrap-timepicker.min.js') }}"></script>
			<script src="{{ asset('/admin-ui/css/jquery-1.7.1.min.js') }}"></script>
			<script src="{{ asset('/admin-ui/css/jquery-1.8.3.min.js') }}"></script>
			<script src="{{ asset('/bower_components/jquery/dist/jquery.min.js') }}"></script>
			<script src="{{ asset('/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
			<script src="{{ asset('/bower_components/bootstrap-validator/dist/validator.min.js') }}"></script>
			<script src="{{ asset('/bower_components/datatables/media/js/jquery.dataTables.min.js') }}"></script>
			<script src="{{ asset('/admin-ui/js/datatables/bootstrap.datatables.js') }}"></script>
			<script src="{{ asset('/bower_components/chosen/chosen.jquery.min.js') }}"></script>
			<script src="{{ asset('/bower_components/jquery-sortable/source/js/jquery-sortable-min.js') }}"></script>
			<script src="{{ asset('/bower_components/chosen/main.js') }}"></script>
			<script src="{{ asset('/admin-ui/js/application.js') }}"></script>
			<script src="{{ asset('/admin-ui/js/forms.js') }}"></script>
			<script src="{{ asset('/admin-ui/js/moment.js') }}"></script>
			<script src="{{ asset('/admin-ui/js/combodate.js') }}"></script>
@yield('scripts')
</body>
</html>
