<!DOCTYPE html> 
<html lang="{{ app()->getLocale() }}"> 
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sistem Informasi Perpustakaan SMK Palapa</title>
  <!-- CSRF Token -->
  <meta name="_token" content="{{ csrf_token() }}">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  {!! Html::style("assets/bootstrap/css/bootstrap.min.css") !!}
  <!-- toastr.min.css -->
  {!! Html::style("assets/bootstrap/css/toastr.min.css") !!}
  {{-- jqueryUI --}}
  {!! Html::style("/assets/plugins/jquery-ui/jquery-ui.css") !!}

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

   <!-- DataTables -->
   {!! Html::style("assets/plugins/datatables/dataTables.bootstrap.css") !!}
  <!-- daterange picker -->
  {!! Html::style("assets/plugins/daterangepicker/daterangepicker.css") !!}
  <!-- bootstrap datepicker -->
   {!! Html::style("assets/plugins/datepicker/datepicker3.css") !!}
  <!-- iCheck for checkboxes and radio inputs -->
	{!! Html::style("assets/plugins/iCheck/all.css") !!}
  <!-- Bootstrap Color Picker -->
  {!! Html::style("assets/plugins/colorpicker/bootstrap-colorpicker.min.css") !!}
  <!-- Bootstrap time Picker -->
  {!! Html::style("assets/plugins/timepicker/bootstrap-timepicker.min.css") !!}
  <!-- Select2 -->
   {!! Html::style("assets/plugins/select2/select2.min.css") !!}
  <!-- Theme style -->
  {!! Html::style("assets/dist/css/AdminLTE.min.css") !!} 
  <!-- AdminLTE Skins. Choose a skin from the css/skins
	   folder instead of downloading all of them to reduce the load. -->
  {!! Html::style("assets/dist/css/skins/_all-skins.min.css") !!}
  {{-- chart --}}
  {!! Charts::assets() !!}


  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>


<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">

  <header class="main-header">
	<!-- Logo -->
	<a href="{{asset('/')}}" class="logo">
		<!-- mini logo for sidebar mini 50x50 pixels -->
		<span class="logo-mini"><b>P</b>P</span>
		<!-- logo for regular state and mobile devices -->
		<span class="logo-lg"><img class="user-image" src="{{asset('gambar/logo.png')}}"></span>
	</a>
	<!-- Header Navbar: style can be found in header.less -->
	<nav class="navbar navbar-static-top">
		<!-- Sidebar toggle button-->
		<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
			<span class="sr-only">Toggle navigation</span>
		</a>

		{{-- Menu LOGIN --}}
		<div class="navbar-custom-menu">
			<ul class="nav navbar-nav">
				<!-- Authentication Links -->
					@if (Auth::guest())
						<li class="dropdown user user-menu">
							<a href="{{ route('login') }}" class="logo-mini"><i class="fa fa-power-off"></i> Login</a>
						</li>
					@else

				<!-- User Account: style can be found in dropdown.less -->
				<li class="dropdown user user-menu">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<img src="{{asset('fotouser/'.Auth::user()->foto) }}" class="user-image" alt="User Image">
						{{ Auth::user()->name }}
						@endif
					</a>
				
			<ul class="dropdown-menu">
				<!-- User image -->
				@if (Auth::user())				
					<li class="user-header">
						<img src="{{asset('fotouser/'.Auth::user()->foto) }}" class="img-circle" alt="User Image">
						<p>
					  
						<small>User Sejak {{ Auth::user()->created_at->format('d-m-Y')}}</small>
						</p>
				@endif
			  </li>
			  <!-- Menu Footer-->
			  <li class="user-footer">
					<div class="pull-left">
						{{-- <a href="#" class="btn btn-default btn-flat">Profile</a> --}}
					</div>
					<div class="pull-right">
						<!-- Authentication Links -->
						@if (Auth::user())
						  	<a href="{{ route('logout') }}" class="btn btn-danger btn-flat"
								onclick="event.preventDefault();
								document.getElementById('logout-form').submit();">

						  			Sign out

							</a> 
							<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
									{{ csrf_field() }}
							</form>
				   
						@endif		  

					</div>
			  	</li>
			</ul>
		 </li>
	</ul>
</div>
{{-- /menulogin --}}

</nav>
  	</header>

	<!-- Left side column. contains the logo and sidebar -->
	<aside class="main-sidebar">
		<!-- sidebar: style can be found in sidebar.less -->
		<section class="sidebar">

			<!-- Sidebar user panel -->
			<div class="user-panel">
				@if (Auth::user())
					<div class="pull-left image">
						<img src="{{asset('fotouser/'.Auth::user()->foto) }}" class="img-circle" alt="User Image">
					</div>
					<div class="info">
						<p>{{Auth::user()->name}}</p>
						<a href="#"><i class="fa fa-circle text-success"></i> User</a>
					</div>
				@endif
			</div>          

		<!-- sidebar menu: : style can be found in sidebar.less -->
		<ul class="sidebar-menu">
			<li class="header">MAIN NAVIGATION</li>

				@if (Auth::user())
					<li class ="{{ active_check('dashboard') }}">
						<a href="{{asset('dashboard') }}"><i class="fa  fa-dashboard "></i> <span>Dashboard</span></a>
					</li> 
				@endif               

				{{-- Master Data  --}}
			

				@if (Auth::user())
					<li class="treeview {{ active_check(['anggota','penulis','penerbit','klasifikasi','tahun_terbit','buku','user'],true ) }}" >
						<a href="#">
							<i class="fa  fa-server"></i>
							<span>Master Data</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu"> 
							<li class="{{ active_check('buku',true) }}">
								<a href="{{asset('buku') }}"> <i class="fa fa-circle-o"></i>Buku</a>
							</li>                           
							<li class="{{ active_check('anggota',true) }}">
								<a href="{{asset('anggota') }}"> <i class="fa fa-circle-o"></i>Anggota</a>
							</li>  
							<li class="{{ active_check('klasifikasi',true) }}">
								<a href="{{asset('klasifikasi') }}"> <i class="fa fa-circle-o"></i>Klasifikasi</a>
							</li>                            
							<li class="{{ active_check('penulis',true) }}">
								<a href="{{asset('penulis') }}"> <i class="fa fa-circle-o"></i>Penulis</a>
							</li>                           
							<li class="{{ active_check('penerbit',true) }}">
								<a href="{{asset('penerbit') }}"> <i class="fa fa-circle-o"></i>Penerbit</a>
							</li>                            
							<li class="{{ active_check('tahun_terbit',true) }}">
								<a href="{{asset('tahun_terbit') }}"> <i class="fa fa-circle-o"></i>Tahun Terbit</a>
							</li> 
							<li class="{{ active_check('user',true) }}">
								<a href="{{asset('user') }}"> <i class="fa fa-circle-o"></i>User</a>
							</li> 	                                        
						</ul>
					</li>
				@else

					{{-- <li class ="{{ active_check('buku') }}">
						<a href="{{asset('buku') }}"><i class="fa fa-circle-o"></i> <span>Buku</span></a>
					</li>   --}}

				@endif  

				{{-- Data transaksi --}}
				@if (Auth::user())
					<li class="treeview {{ active_check(['bk_masuk','peminjaman'],true ) }}">
						<a href="#">
						<i class="fa  fa-exchange"></i>
						<span>Transaksi</span>
						<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
						</span>
						</a>
						<ul class="treeview-menu">                            
							{{-- <li class="{{active_check('bk_masuk',true)}}">
								<a href="{{asset('bk_masuk') }}"> <i class="fa fa-circle-o"></i>Buku Masuk</a>
							</li>   --}}                          
							<li class="{{ active_check('peminjaman',true) }}">
								<a href="{{asset('peminjaman') }}"> <i class="fa fa-circle-o"></i>Peminjaman</a>
							</li>                            
						</ul>
					</li>    
				 
					<li class ="{{ active_check('telegram') }}">
						<a href="{{asset('telegram') }}"><i class="fa fa-send-o"></i> <span>Telegram</span></a>
					</li>        
				<li class="header">LAPORAN</li>
					<li><a href="{{ asset('anggota/cari_pdf') }}" target="_blank"><i class="fa fa-circle-o text-aqua"></i> <span>Anggota</span></a></li>
					<li><a href="{{ asset('buku/cari_pdf')}}" target="_blank"><i class="fa fa-circle-o text-aqua"></i> <span>Buku</span></a></li>
					<li><a href="{{asset('peminjaman/cari_pdf')}}" target="_blank"><i class="fa fa-circle-o text-aqua"></i> <span>Peminjaman</span></a></li>
					<li><a href="{{asset('keuangan/cari_pdf')}}" target="_blank"><i class="fa fa-circle-o text-aqua"></i> <span>Keuangan</span></a></li>
					<li><a href="{{asset('rekap_lap/cari_pdf')}}" target="_blank"><i class="fa fa-circle-o text-aqua"></i> <span>Rekap Laporan</span></a>
				</li>
			@endif
		</ul>
	</section>
	<!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
	<!-- Main content -->
	<section class="content">
	  <!-- Main row -->
	  <div class="row">

	  @yield('navbar') 
	  @yield('main')  
		
	  </div>
	  <!-- /.row (main row) -->
	</section>
	<!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
	<div class="pull-right hidden-xs">
	  <b>Version</b> 1.0
	</div>
	<strong>Copyright &copy; 2018 Perpussmkpalapa</strong>
  </footer>
  <!-- Add the sidebar's background. This div must be placed
	   immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->



<!-- jQuery 2.2.3 -->
{!! Html::script("assets/plugins/jQuery/jquery-2.2.3.min.js") !!} 
<!-- Bootstrap 3.3.6 -->
{!! Html::script("assets/bootstrap/js/bootstrap.min.js") !!} 
<!-- toastr.min.js -->
{!! Html::script("assets/bootstrap/js/toastr.min.js") !!} 

{{-- elasticsearch.js --}}
{!! Html::script("assets/bootstrap/js/elasticsearch.js") !!} 
{{-- jquery.elastic-datatables.min.js --}}
{!! Html::script("assets/bootstrap/js/jquery.elastic-datatables.min.js") !!} 

<!-- DataTables -->
{!! Html::script("assets/plugins/datatables/jquery.dataTables.min.js") !!} 
{!! Html::script("assets/plugins/datatables/dataTables.bootstrap.min.js") !!} 
<!-- Select2 -->
{!! Html::script("assets/plugins/select2/select2.full.min.js") !!} 
<!-- InputMask -->
{!! Html::script("assets/plugins/input-mask/jquery.inputmask.js") !!}
{!! Html::script("assets/plugins/input-mask/jquery.inputmask.date.extensions.js") !!}
{!! Html::script("assets/plugins/input-mask/jquery.inputmask.extensions.js") !!}
<!-- bootstrap datepicker -->
{!! Html::script("assets/plugins/datepicker/bootstrap-datepicker.js") !!}
<!-- SlimScroll 1.3.0 -->
{!! Html::script("assets/plugins/slimScroll/jquery.slimscroll.min.js") !!}
<!-- iCheck 1.0.1 -->
{!! Html::script("assets/plugins/iCheck/icheck.min.js") !!}
<!-- FastClick -->
{!! Html::script("assets/plugins/fastclick/fastclick.js") !!}
<!-- AdminLTE App -->
{!! Html::script("assets/dist/js/app.min.js") !!}
<!-- AdminLTE for demo purposes -->
{!! Html::script("assets/dist/js/demo.js") !!}
{{-- jqueryUI --}}
{!! Html::script("/assets/plugins/jquery-ui/jquery-ui.js") !!}
{!! Html::script("/js/perpus.js") !!}

@stack('scripts')

</body>
</html>
