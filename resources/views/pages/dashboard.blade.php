@extends('template')

@section('navbar')
 
	<div id="page-wrapper"> 

			<div class="container-fluid">

				<!-- Page Heading -->
				<div class="row">
					<div class="col-lg-12">
						<h1 class="page-header">
							Dashboard <small>Statistics Overview</small>
						</h1>
						<ol class="breadcrumb">
							<li class="active">
								<i class="fa fa-dashboard"></i> Dashboard
							</li>
						</ol>
					</div>
				</div>
				<!-- /.row -->
@stop       

@section('main')
	
	  <!-- Small boxes (Stat box) -->
	  <div class="row">
		<div class="col-lg-3 col-xs-6">
		  <!-- small box -->
		  <div class="small-box bg-aqua">
			<div class="inner">
			  <h3>{{ $jumlah }}</h3>

			  <p>Total Koleksi Buku</p>
			</div>
			<div class="icon">
			  <i class="fa fa-book"></i>
			</div>
			<a href="{{asset('buku')}}" class="small-box-footer"> Lihat Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
		  </div>
		</div>
		<!-- ./col -->
		<div class="col-lg-3 col-xs-6">
		  <!-- small box -->
		  <div class="small-box bg-green">
			<div class="inner">
			  <h3>{{$jumlah_anggota}}</h3>

			  <p>Total Anggota</p>
			</div>
			<div class="icon">
			  {{-- <i class="ion ion-stats-bars"></i> --}}
			   <i class="fa fa-user-plus"></i>
			</div>
			<a href="{{asset('anggota')}}" class="small-box-footer">Lihat Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
		  </div>
		</div>
		<!-- ./col -->
		<div class="col-lg-3 col-xs-6">
		  <!-- small box -->
		  <div class="small-box bg-yellow">
			<div class="inner">
			  <h3>
				<?php 
					$tot_pinjam = $jumlah - $stok;
					echo "$tot_pinjam";
			   ?>                                            
				</h3>

			  <p>Total Buku Dipinjam</p>
			</div>
			<div class="icon">
			  <i class="fa fa-files-o"></i>
			</div>
			<a href="{{asset('peminjaman')}}" class="small-box-footer">Lihat Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
		  </div>
		</div>
		<!-- ./col -->
		<div class="col-lg-3 col-xs-6"> 
		  <!-- small box -->
		  <div class="small-box bg-red">
			<div class="inner">
			  <h3>{{ $jumlah_pinjam }}</h3>

			  <p>Total Peminjaman</p>
			</div>
			<div class="icon">
			  <i class="ion ion-pie-graph"></i>
			</div>
			<a href="{{asset('peminjaman')}}" class="small-box-footer">Lihat Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
		  </div>
		</div>
		<!-- ./col -->
	  </div>
	  <br>
	  <!-- /.row -->

	  {{-- chart --}}
	  {!! $chart->render() !!}
@stop

