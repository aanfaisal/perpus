@extends('template')

@section('navbar')

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
                            <i class="fa fa-book"></i>
                                <a href="{{asset('/buku') }}">Buku</a>      
                        </li>
                            <li class="active">
                            	Tambah Buku</a>         
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
@stop

@section('main')

	<div class="row">
        <div class="col-sm-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Tambah Buku</h3>
                </div>
    <div class="panel-body">
                               
        {!! Form::open(['url' => 'buku', 'files' => true]) !!}
            
			@if (isset($buku))
			    {!! Form::hidden('id', $buku->id) !!}
			@endif

			{{-- nama --}}
			@if ($errors->any())
			    <div class="form-group {{ $errors->has('nama') ? 'has-error' : 'has-success' }}">
			@else
			    <div class="form-group">
			@endif
			   <label class="control-label">Nama :</label>
			   {!! Form::text('nama',null,['class' => 'form-control','placeholder'=>'nama']) !!}
			    @if ($errors->has('nama'))
			        <span class="help-block">{{ $errors->first('nama') }}</span>
			    @endif
			</div>

			{{-- penulis --}}
			@if ($errors->any())
			    <div class="form-group {{ $errors->has('id_penulis') ? 'has-error' : 'has-success' }}">
			@else
			    <div class="form-group">
			@endif
	            <label>Penulis :</label>
	            {!! Form::select('id_penulis', $penulis_list,null,['class' => 'form-control select2','id' => 'id_penulis','placeholder' => 'Pilih Penulis..']) !!}
				@if ($errors->has('id_penulis'))
				    <span class="help-block">{{ $errors->first('id_penulis') }}</span>
				@endif
			</div>

			{{-- penerbit --}}
			@if ($errors->any())
			    <div class="form-group {{ $errors->has('id_penerbit') ? 'has-error' : 'has-success' }}">
			@else
			    <div class="form-group">
			@endif
	            <label>Penerbit :</label>
	            {!! Form::select('id_penerbit', $penerbit_list,null,['class' => 'form-control select2','id' => 'id_penerbit','placeholder' => 'Pilih Penerbit..']) !!}
				@if ($errors->has('id_penerbit'))
				    <span class="help-block">{{ $errors->first('id_penerbit') }}</span>
				@endif
			</div>

			{{-- tahun --}}
			@if ($errors->any())
			    <div class="form-group {{ $errors->has('id_tahun') ? 'has-error' : 'has-success' }}">
			@else
			    <div class="form-group">
			@endif
	            <label>Tahun :</label>
	            {!! Form::select('id_tahun', $tahun_list,null,['class' => 'form-control select2','id' => 'id_tahun','placeholder' => 'Pilih Tahun..']) !!}
				@if ($errors->has('id_tahun'))
				    <span class="help-block">{{ $errors->first('id_tahun') }}</span>
				@endif
			</div>

			{{-- stok --}}
			@if ($errors->any())
			    <div class="form-group {{ $errors->has('stok') ? 'has-error' : 'has-success' }}">
			@else
			    <div class="form-group">
			@endif
			    {!! Form::label('stok', 'Stok :', ['class' => 'control-label']) !!}
			    {!! Form::number('stok', null, ['class' => 'form-control','placeholder'=>'stok']) !!}
			    @if ($errors->has('stok'))
			        <span class="help-block">{{ $errors->first('stok') }}</span>
			    @endif
			</div>

			{{-- deskripsi --}}
			@if ($errors->any())
			    <div class="form-group {{ $errors->has('deskripsi') ? 'has-error' : 'has-success' }}">
			@else
			    <div class="form-group">
			@endif
			    {!! Form::label('deskripsi', 'Deskripsi:', ['class' => 'control-label']) !!}
			    {!! Form::textarea('deskripsi', null, ['class' => 'form-control']) !!}
			    @if ($errors->has('deskripsi'))
			        <span class="help-block">{{ $errors->first('deskripsi') }}</span>
			    @endif
			</div>
 		</div>

<div class="col-md-2">
	<button type="submit" class="btn bg-blue fa fa-save "> Simpan</button>
</div>
		
{!! Form::close() !!}
		<br>
	<br>
<br>

@stop

			
{{-- 
			@if ($errors->any())
			    <div class="form-group {{ $errors->has('jenis_kelamin') ? 'has-error' : 'has-success' }}">
			@else
			    <div class="form-group">
			@endif
			    {!! Form::label('jenis_kelamin', 'Jenis Kelamin:', ['class' => 'control-label']) !!}
			    <div class="radio">
			        <label>{!! Form::radio('jenis_kelamin', 'L') !!} Laki-laki</label>
			    </div>
			    <div class="radio">
			        <label>{!! Form::radio('jenis_kelamin', 'P') !!} Perempuan</label>
			    </div>
			    @if ($errors->has('jenis_kelamin'))
			        <span class="help-block">{{ $errors->first('jenis_kelamin') }}</span>
			    @endif
			</div>

			@if ($errors->any())
			    <div class="form-group {{ $errors->has('nomor_telepon') ? 'has-error' : 'has-success' }}">
			@else
			    <div class="form-group">
			@endif
			    {!! Form::label('nomor_telepon', 'Telepon:', ['class' => 'control-label']) !!}
			    {!! Form::text('nomor_telepon', null, ['class' => 'form-control']) !!}
			    @if ($errors->has('nomor_telepon'))
			        <span class="help-block">{{ $errors->first('nomor_telepon') }}</span>
			    @endif
			</div>

			
 --}}
