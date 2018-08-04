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
                                    <a href="{{asset('/peminjaman') }}">Peminjaman</a> 
                              
                            </li>
                            <li class="active">
                            	 <i class="fa fa-long-arrow-right"></i> Tambah Peminjaman</a> 
                                
                              
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
                                <h3 class="panel-title">Tambah Peminjaman</h3>
                            </div>
                            <div class="panel-body">
                               

                               	<div id="buku">
   

        {!! Form::open(['url' => 'peminjaman']) !!}

            
			@if (isset($peminjaman))
			    {!! Form::hidden('id', $peminjaman->id) !!}
			@endif


			@if ($errors->any())
			    <div class="form-group {{ $errors->has('nama_anggota') ? 'has-error' : 'has-success' }}">
			@else
			    <div class="form-group">
			@endif
			   <label class="control-label"> Kode :</label>

		  	 {!! Form::text('kode', $kode, array('class' => 'form-control', 'readonly' => true)) !!}
			    @if ($errors->has('nama_anggota'))
			        <span class="help-block">{{ $errors->first('nama_anggota') }}</span>
			    @endif
			</div>


			@if ($errors->any())
			    <div class="form-group {{ $errors->has('id_anggota') ? 'has-error' : 'has-success' }}">
			@else
			    <div class="form-group">
			@endif
			   <label class="control-label"> Nama Anggota :</label>

			   {!! Form::select('id_anggota', $anggota_list, null, array('class' => 'form-control select2','id' => 'id_anggota','placeholder' => 'Pilih Anggota..')) !!}

		   {{-- {!! Form::select('id_anggota',$anggota_list, null, ['class' => 'select','multiple'=>'multiple' ,  'data-placeholder' => 'Pilih Anggota..' ]) !!} --}}
			    @if ($errors->has('id_anggota'))
			        <span class="help-block">{{ $errors->first('id_anggota') }}</span>
			    @endif
			</div>

			@if ($errors->any())
			<div class="form-group {{ $errors->has('id_buku[]') ? 'has-error' : 'has-success' }}">
			@else
			    <div class="form-group">
			@endif
			 
			 
			<label class="control-label"> Nama Buku :</label>
			<div class="input-group">
				    {!! Form::open(['url' => 'peminjaman/cek_stok_buku']) !!}
                {!! Form::select('id_buku[]',$buku_list, null, ['class' => 'form-control select2','multiple'=>'multiple' ,  'data-placeholder' => 'Pilih Buku..' ]) !!}
                    <span class="input-group-btn">
                   

                    	{!! Form::submit('Cek Stok',['class'=>'btn bg-maroon btn-flat']) !!}
                    	{!!  Form::close() !!}
                      {{-- <a href="{{asset('peminjaman/cek_stok_buku')}}" target="_blank"><button type="button" class="btn bg-maroon btn-flat">Cari ketersediaan !</button></a> --}}
                    </span>        
              </div>
              <!-- /input-group -->
              

			   {{-- <label class="control-label"> Nama Buku :</label>
			{!! Form::select('id_buku[]',$buku_list, null, ['class' => 'form-control select2','multiple'=>'multiple' ,  'data-placeholder' => 'Pilih Buku..' ]) !!} --}}
			@if ($errors->has('id_buku[]'))
			        <span class="help-block">{{ $errors->first('id_buku[]') }}</span>
			    @endif



			{{-- @if ($errors->any())
			    <div class="form-group {{ $errors->has('nama_buku') ? 'has-error' : 'has-success' }}">
			@else
			    <div class="form-group">
			@endif
			   <label class="control-label"> Nama Buku :</label>
			   <select id="nama_buku" name="id_buku class="form-control" >
			   		<option>Data Buku</option>
			   			@foreach ($buku_list as $data )
			   				<option  value="{{ $data->id }} "> {{ $data->nama }} </option>
						@endforeach
			    </select>
			    @if ($errors->has('nama_buku'))
			        <span class="help-block">{{ $errors->first('nama_buku') }}</span>
			    @endif
			</div> --}}



			@if ($errors->any())
			    <div class="form-group {{ $errors->has('tgl_pinjam') ? 'has-error' : 'has-success' }}">
			@else
			    <div class="form-group">
			@endif
			   <label class="control-label">Tanggal Pinjam :</label>
			   <input type="date" name="tgl_pinjam" class="form-control">
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
			   <input type="date" name="tgl_kembali" class="form-control">
			    @if ($errors->has('tgl_kembali'))
			        <span class="help-block">{{ $errors->first('tgl_kembali') }}</span>
			    @endif
			</div>

			

 </div>
			</div></div>

			<div class="col-md-2">
			    {!! Form::submit('Simpan', ['class' => 'btn btn-primary form-control']) !!}
			</div>
		
        {!! Form::close() !!}
   

                       <br>
                       <br>
                      <br>
    <br><br>
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

$(".select2").select2();
</script>

