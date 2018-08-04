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
                            	Edit Buku</a>         
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
                    <h3 class="panel-title">Edit Buku</h3>
                </div>
    <div class="panel-body">

        {!! Form::model($buku) !!}
            
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
			   {!! Form::text('judul',null,['class' => 'form-control select2','placeholder'=>'judul']) !!}
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
				<div class="form-group">
	               	<label>Penulis :</label>
	               	{!! Form::select("id_penulis", $penulis_list,null,["class" => "form-control","id" => "id_penulis"]) !!}
	            </div>
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
				<div class="form-group">
	               	<label>Penerbit :</label>
	                {!! Form::select('id_penerbit', $penerbit_list,null,['class' => 'form-control','id' => 'id_penerbit']) !!}
	           	</div>
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
				<div class="form-group">
	               	<label>Tahun :</label>
	                {!! Form::select('id_tahun', $tahun_list,null,['class' => 'form-control','id' => 'id_tahun']) !!}
	           </div>
			@if ($errors->has('id_tahun'))
			    <span class="help-block">{{ $errors->first('id_tahun') }}</span>
			@endif
			</div>

			{{-- jumlah --}}
			@if ($errors->any())
			    <div class="form-group {{ $errors->has('jumlah') ? 'has-error' : 'has-success' }}">
			@else
			    <div class="form-group">
			@endif
			    {!! Form::label('jumlah', 'Jumlah :', ['class' => 'control-label']) !!}
			    {!! Form::number('jumlah', null, ['class' => 'form-control','placeholder'=>'jumlah']) !!}
			    @if ($errors->has('jumlah'))
			        <span class="help-block">{{ $errors->first('jumlah') }}</span>
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
	<button type="submit" class="btn bg-blue fa fa-save "> Update</button>
</div>

{!! Form::close() !!}

@push('scripts')
		{{--  <script>

		$(function() {
            //Initialize Select2 Elements
                $('#id_penulis').select2({
                        // placeholder: 'Pilih Penulis',
                        // page: page
                    }); 

                    $('#id_penerbit').select2({
                        // placeholder: 'Pilih Penerbit',
                        // page: page
                    });  

                    $('#id_tahun').select2({
                        // placeholder: 'Pilih Tahun',
                        // page: page
                    });    
                });
            </script> --}}

            <script type="text/javascript">
				$(document).ready(function() {
				  $("id_penulis").select2();
				});
			</script>
          @endpush 
   
		<br>
 	<br>
<br>
   
@stop
