<!DOCTYPE html>
<html >
<head>
  	<meta charset="UTF-8">
  	<title>Login Sistem Informasi Perpustakaan</title>
  	<link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css'>
 	 <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>

<body>
 	<div class="login-form">
	<h1>{ Perpus }</h1>

	<div class="form-group ">
		<form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
		  {{ csrf_field() }}
	   	<input type="email" name="email" class="form-control" placeholder="Email " id="UserName">
	   	<i class="fa fa-user"></i>
	</div>

		@if ($errors->any())
			<div class="form-group  {{ $errors->has('password') ? 'has-error' : 'has-success' }}">
		@else
			<div class="form-group">
		@endif
		    <input type="password" name="password" class="form-control" placeholder="Password" id="Passwod">
		    <i class="fa fa-lock"></i>
		@if ($errors->has('password'))
			<span class="help-block">{{ $errors->first('password') }}</span>
			{{-- <span class="alert">Password tidak sesuai !!!</span> --}}
		@endif
	</div>

	  	<a class="link" href="{{asset('/')}}"> Tidak punya akun? Kembali ! </a>
	 	<button type="submit" class="log-btn" >Log in</button>
   	</div>

<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="{{asset('js/index.js')}}"></script>

</body>
</html>
