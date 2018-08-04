 @extends('template')  

 @section('navbar')

<div id="page-wrapper">
	<div id="page-wrapper">
		<div class="container-fluid">
			<!-- Page Heading -->
			<div class="row">
				<div class="col-lg-12">                        
					<ol class="breadcrumb">
						<li class="inactive">
							<i class="fa fa-dashboard"></i>
								<a href="{{asset('/dashboard') }}">Dashboard</a> 
						</li>
						<li class="inactive">
							<i class="fa fa-check-circle"></i>
								<a href="{{asset('/peminjaman') }}">Peminjaman</a>                
						</li>
						<li class="active">
							Peminjaman yang dipinjam
						</li>
					</ol>
				</div>
			</div>
				<!-- /.row -->
@stop

@section('main')

@include('_partial.flash_delete')
@include('_partial.flash_message_hapus')

 <div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">Buku yang dipinjam</h3>
	</div>
		<div class="panel-body"> 
	<!-- Main content -->
	<section class="invoice">
	  <!-- title row -->
	  <div class="row">
		<div class="col-xs-12">
		  <h2 class="page-header">
			<i class="fa fa-globe"></i> SMK PALAPA SEMARANG
			<small class="pull-right">Tanggal Cetak : {{date("d-m-Y")}}</small>
		  </h2>
		</div>
		<!-- /.col -->
	  </div>
	  <!-- info row -->
	  <div class="row invoice-info"> 
		<div class="col-sm-4 invoice-col">         
		  <address>
			<table border="0">
			<tr> 
			  <thead>
				<tr>
				  <td><strong>Peminjam </strong> </td>
				  <td></td>
				</tr>
				<tr>
				  <td> <strong>{{ $data2->nama_anggota}}</strong><br></td>
				</tr>
				<tr>
				  <td>Tanggal Pinjam </td>
				  <td>:</td>
				  <td>{{ $data2->tgl_pinjam}}<br></td>
				</tr>
				<tr>
				  <td>Tanggal Kembali <br></td>
				  <td>:</td>
				  <td>{{ $data2->tgl_kembali }}</td>
				</tr>
				<tr>
				  <td>Durasi</td>
				  <td>:</td>
				  <td>
					  <?php 
						  $tgl        = strtotime($data2->tgl_kembali) ;
						  $tgl_skrng  = strtotime(date("Y-m-d"));
						  $durasi      = ($tgl - $tgl_skrng) / 86400 ;
					  ?>
					  @if ($durasi < 0 )
						  ( Durasi Habis / {{ $durasi }} Hari )
					  @else
						  ( {{ $durasi }} Hari )
					  @endif
				  <br>
				  </td>
				</tr>
				<tr>
				  <td>Telepon/HP</td>
				  <td>:</td>
				  <td> {{$data2->telepon}}</td>
				</tr>
			  </thead>
			</tr>
		  </table>
			
		  </address>
		</div>
		<!-- /.col -->
		<div class="col-sm-2 invoice-col">
		</div>
		<!-- /.col -->
		<div class="col-sm-5 invoice-col">
		  <table>
			<tr bgcolor=#46f0d1>
			  <th>
				  <h1><b>Kode #{{ $data2->kode }}<br>

					  @foreach($data3 as $row)
					  	 {{-- {{$row->total}} --}}
					  @endforeach
					  <?php 
						  // $total_buku  
						  $total_buku = $row->total;
					  ?>                                      
						  @if($durasi<0)
							  <?php $denda = abs($durasi)*500*$total_buku; ?>
								   Denda: RP. {{$denda}},00
						   @else
								 Denda: RP. 0,00
							@endif 
						</b>
					</h1>
					  <br>
				  <br>
			  </th>
			</tr>
		  </table>
		<br>
		</div>
		<!-- /.col -->
	  </div>
	  <!-- /.row -->

	  <!-- Table row -->
	  <div class="row">
		<div class="col-xs-12 table-responsive">
		  <table class="table table-striped" id="table">
			<thead>
			<tr bgcolor="#d0d96a">
			  <th>No.</th>
			  <th>Judul</th>
			  <th>Penulis</th>
			  <th>Penerbit</th>
			  <th>Tahun</th>
			  <th>Aksi</th>
			</tr>
			</thead>
			<tbody>  
			<?php $no = 1 ?>                                
				@foreach ($data1 as $buku)
								  
			<tr>  
				<td>{{ $no }}</td>                                      
				<td>{{ $buku->judul }}</td>
				<td>{{ $buku->nm_penulis }}</td>
				<td>{{ $buku->nm_penerbit }}</td>
				<td>{{ $buku->tahun }}</td>                                      
				<td>  

					@if(  $total_buku > 1)

						{!! Form::open(array('url' => 'peminjaman/'.$buku->id_peminjaman.'/buku/'.$buku->id_buku.'/hapus','method'=>'GET', 'class' => 'horizontal-form', 'role' => 'form')) !!}

						<input type="hidden" name="id_peminjaman" value="{{ $buku->id_peminjaman }}">
						<input type="hidden" name="id_buku" value="{{ $buku->id_buku }}">
						<input type="hidden" name="anggota" value="{{ $data2->id }}">
						<input type="hidden" name="durasi" value="{{ $durasi }}">
						<input type="hidden" name="stok" value="{{ $buku->stok }}">
						<input type="hidden" name="buku" value="{{ $buku->judul }}">

						<button type="submit" class="btn btn-xs btn-danger glyphicon glyphicon-remove" onclick = "return ConfirmDelete()" > Hapus </button>

						{{-- {{ link_to('peminjaman/'.$buku->id_peminjaman.'/buku/'.$buku->id_buku.'/hapus',' Hapus',['class'=>'btn btn-xs btn-danger glyphicon glyphicon-remove']) }} --}}

						{!! Form::close() !!}

					@endif
				
							   
				</td>
			</tr>  
			<?php $no++ ?>                                  
				@endforeach 
															
		</tbody>             
		  </table>
		</div>
		<!-- /.col -->
	  </div>
	  <!-- /.row -->

	  <div class="row">
		<!-- accepted payments column -->
		<div class="col-xs-6">
		  <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
			PERINGATAN !!! Keterlambatan pengembalian buku akan dikenakan denda sebesar                           "RP. 500,00 ( LIMA RATUS RUPIAH)" per buku tiap harinya.
		  </p>
		</div>
		<!-- /.col -->
		
	  </div>
	  <!-- /.row -->

	  <!-- this row will not appear when printing -->
	  <div class="row no-print">
		<div class="col-xs-12">
		  <a href="{{asset('peminjaman/'.$data2->kode.'/cetak_pinjam')}}" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
		 {{--  <a href="{{asset('peminjaman/'.$data2->kode.'/cetak_pinjam_pdf')}}" target="_blank"> 
		  <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
			<i class="fa fa-download"></i> Generate PDF
		  </button> --}}
		</div>
	  </div>
	</section>
	<!-- /.content -->
						
@stop
