<!Doctype htnl>
<html>
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel='stylesheet' href="{{ asset('/admin-ui/css/bootstrap.css') }}">
  @yield('styles')
</head>
<body>
<div class="container">
  <div class="jumbotron">
    <h1>Congratulation!!!!</h1>
    <p>Please wait manager for giving you your role........</p>
		<p>you are not {{Auth::user()->name}} ? <a href="{{ url('auth/logout') }}"> Login using a diffrent account.</a></p>
  </div>
</div>
</body>

</html>
