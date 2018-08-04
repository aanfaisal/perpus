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
                            	 <i class="fa fa-check-circle"></i>
                                    <a href="{{asset('/peminjaman') }}">Peminjaman</a> 
                            </li>
                            <li class="active">
                            	Edit Peminjaman</a> 
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
                    <h3 class="panel-title">Edit Peminjaman</h3>
                </div>
    <div class="panel-body">                                 

        {!! Form::model($peminjaman, ['method' => 'PATCH', 'action' => ['PeminjamanController@update', $peminjaman->id]]) !!}
            
            
			@if (isset($peminjaman))
			    {!! Form::hidden('id', $peminjaman->id) !!}
			@endif


			@if ($errors->any())
			    <div class="form-group {{ $errors->has('kode') ? 'has-error' : 'has-success' }}">
			@else
			    <div class="form-group">
			@endif
			   <label class="control-label"> Kode :</label>

		  	 {!! Form::text('kode',null, array('class' => 'form-control', 'readonly' => true)) !!}
			    @if ($errors->has('nama_anggota'))
			        <span class="help-block">{{ $errors->first('nama_anggota') }}</span>
			    @endif
			</div>


			@if ($errors->any())
			    <div class="form-group {{ $errors->has('nama_anggota') ? 'has-error' : 'has-success' }}">
			@else
			    <div class="form-group">
			@endif
			   <label class="control-label"> Nama Anggota :</label>

			   {!! Form::select('id_anggota', $anggota_list, null, array('class' => 'form-control select2', 'id' => 'id_anggota','placeholder' => 'Pilih Anggota..')) !!}
			    @if ($errors->has('nama_anggota'))
			        <span class="help-block">{{ $errors->first('nama_anggota') }}</span>
			    @endif
			</div>

			{{-- @if ($errors->any())
			<div class="form-group {{ $errors->has('peminjaman_buku') ? 'has-error' : 'has-success' }}">
			@else
			    <div class="form-group">
			@endif
			   <label class="control-label"> Nama Buku :</label>
			{!! Form::select('peminjaman_buku[]',$buku_list,null, array('class' => 'form-control select2','disable'=>true,'multiple'=>'multiple' ,  'data-placeholder' => 'Pilih Buku..' )) !!}
			@if ($errors->has('peminjaman_buku'))
			        <span class="help-block">{{ $errors->first('peminjaman_buku') }}</span>
			    @endif
			    	<div> --}}


			@if ($errors->any())
			    <div class="form-group {{ $errors->has('penerbit') ? 'has-error' : 'has-success' }}">
			@else
			    <div class="form-group">
			@endif
			   <label class="control-label">Tanggal Pinjam :</label>
			    {!! Form::date('tgl_pinjam',$peminjaman->tgl_pinjam, array('class' => 'form-control')) !!}
			    @if ($errors->has('tgl_pinjam'))
			        <span class="help-block">{{ $errors->first('tgl_pinjam') }}</span>
			    @endif
			</div>

			@if ($errors->any())
			    <div class="form-group {{ $errors->has('tgl_kembali') ? 'has-error' : 'has-success' }}">
			@else
			    <div class="form-group">
			@endif
			   <label class="control-label">Tanggal Kembali :</label>
			   {!! Form::date('tgl_kembali', $peminjaman->tgl_kembali, array('class' => 'form-control')) !!}
			    @if ($errors->has('tgl_kembali'))
			        <span class="help-block">{{ $errors->first('tgl_kembali') }}</span>
			    @endif
			</div>			

 				</div>
			</div>
		</div>

			<div class="col-md-2">
			    {!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
			</div>
		
        {!! Form::close() !!}
   

                       <br>
                   <br>
                <br>
    		<br>
    	<br>
@stop


<script type="text/javascript">
	$('#nama_buku').select2({
    placeholder: "Pilih Buku...",
    minimumInputLength: 2,
    ajax: {
        url: '/buku/find',
        dataType: 'json',
        data: function (params) {
            return {
                q: $.trim(params.term)
            };
        },
        processResults: function (data) {
            return {
                results: data
            };
        },
        cache: true
    }
});
</script>

