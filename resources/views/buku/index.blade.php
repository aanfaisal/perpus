@extends('template')

@section('navbar')
 
    <div id="page-wrapper"> 

            <div class="container-fluid">

                <!-- Page Heading --> 
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Data Buku
                        </h1>
                        <ol class="breadcrumb">
                            @if(Auth::user())
                            <li class="inactive">
                                <i class="fa fa-dashboard"></i>
                                    <a href="{{asset('/dashboard') }}">Dashboard</a> 
                            </li>
                            @endif
                            <li class="active">
                                Buku
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
@stop

@section('main')

{{-- @include('buku.form_pencarian') --}}

 <div class="panel panel-primary ">
    <div class="panel-heading">
        <h3 class="panel-title">Buku</h3>
    </div>
        <div class="panel-body">
        <!-- /.box-header -->
            <table id="tBuku" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>                                                         
                        <th>Judul</th>
                        <th>Penulis</th>
                        <th>Penerbit</th>
                        <th>Tahun</th>
                        <th>Klasifikasi</th>
                        <th>Jumlah</th>
                        <th>Stok</th>
                        <th width="200">Aksi</th>                               
                    </tr>    
            </table> 

        @push('scripts')
            <script>
                $(function() {
                    $('#tBuku').DataTable({
                        processing: true,
                        serverSide: true,
                        searching : true,
                        autoWidth : true,
                         // paging: false,
                        // scrollY: 100,
                        // scroller: {
                        //     loadingIndicator: true
                        // },
                        // lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
                        ajax: '{!! url ('bukuData') !!}',
                        columns: [
                            {data: 'judul'},
                            {data: 'penulis'},
                            {data: 'penerbit'},
                            {data: 'tahun'},
                            {data: 'klasifikasi'},
                            {data: 'jumlah'},
                            {data: 'stok'},
                            {data: 'action', orderable: false, searchable: false}
                        ]
                    });
                });

                $(function() {
                    //Initialize Select2 Elements
                    $('#id_penulis').select2({
                        placeholder: 'Pilih Penulis',
                        // page: page
                    }); 

                    $('#id_penerbit').select2({
                        placeholder: 'Pilih Penerbit',
                        // page: page
                    });  

                    $('#id_tahun').select2({
                        placeholder: 'Pilih Tahun',
                        // page: page
                    });    

                    $('#id_klasifikasi').select2({
                        placeholder: 'Pilih Klasifikasi',
                        // page: page
                    }); 
                });

            </script> 

            <script src="{{asset('assets/app/buku.js')}}"></script>
        @endpush                 
           
@if(Auth::user())
    {{-- {{ link_to('buku/tambah',' Tambah ',['class'=>'btn btn-xs bg-blue glyphicon glyphicon-plus']) }} --}}
        <div class="pull-left">
            <button id="btn_addBuku" name="btn_addBuku" class="btn btn-xs bg-blue glyphicon glyphicon-plus pull-right"> Tambah</button>
        </div>&nbsp;

    {{ link_to('buku/cari_pdf',' Cetak ',['class'=>'btn btn-xs bg-blue glyphicon glyphicon-print','target'=>'_blank']) }}
@endif


{{-- MODAL TAMBAH/EDIT SECTION --}}
        <div class="modal fade" id="ModBuku" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-title" id="myModalLabel">Data Buku</h4>
                    </div>
                <div class="modal-body">

                <form id="frmBuku">
                    
                     {!! csrf_field() !!}

                    {{-- id --}}
                    <input type="hidden" name="id_buku" id="id_buku"> 

                    {{-- judul --}}
                    <div class="form-group" >
                        <label class="control-label">Judul</label>
                        <input class="form-control" type="text" name="judul" id="judul" placeholder="Judul Buku">  
                        <p class="errorJudul text-center alert alert-danger hidden"></p>   
                    </div>

                    {{-- nama penulis --}}
                    <label class="control-label">Penulis</label>
                    <div class="form-group">
                        <select class="form-control" name="id_penulis" id="id_penulis" style="width: 100%; padding: 15px"> 
                            <option value=""></option>
                            @foreach ($penulis_list as $penulis) {
                                <option value="{{$penulis->id}}">{{$penulis->nm_penulis}}</option>
                            @endforeach
                        </select> 
                        <p class="errorNmPenulis text-center alert alert-danger hidden"></p>   
                    </div>

                    {{-- nama penerbit --}}
                    <label class="control-label">Penerbit</label>
                    <div class="form-group">
                        <select class="form-control" name="id_penerbit" id="id_penerbit" style="width: 100%; padding: 15px"> 
                            <option value=""></option>
                            @foreach ($penerbit_list as $penerbit) {
                                <option value="{{$penerbit->id}}">{{$penerbit->nm_penerbit}}</option>
                            @endforeach
                        </select> 
                        <p class="errorNmPenerbit text-center alert alert-danger hidden"></p>   
                    </div>

                    {{-- tahun --}}
                    <label class="control-label">Tahun</label>
                    <div class="form-group">
                        <select class="form-control" name="id_tahun" id="id_tahun" style="width: 100%; padding: 15px"> 
                            <option value=""></option>
                            @foreach ($tahun_list as $tahun) {
                                <option value="{{$tahun->id}}">{{$tahun->tahun}}</option>
                            @endforeach
                        </select> 
                        <p class="errorTahun text-center alert alert-danger hidden"></p>   
                    </div>

                    {{-- klasifikasi --}}
                    <label class="control-label">Klasifikasi</label>
                    <div class="form-group">
                        <select class="form-control" name="id_klasifikasi" id="id_klasifikasi" style="width: 100%; padding: 15px"> 
                            <option value=""></option>
                            @foreach ($klasifikasi_list as $klasifikasi) {
                                <option value="{{$klasifikasi->id}}">{{$klasifikasi->ket}}</option>
                            @endforeach
                        </select> 
                        <p class="errorNmPenulis text-center alert alert-danger hidden"></p>   
                    </div>

                    {{-- jumlah --}}
                    <div class="form-group" >
                        <label class="control-label">Jumlah</label>
                        <input class="form-control" type="number" name="jumlah" id="jumlah" placeholder="jumlah">  
                        <p class="errorJumlah text-center alert alert-danger hidden"></p>   
                    </div>

                    {{-- stok --}}
                    <input type="hidden" name="stok" id="stok"> 

                     {{-- deskripsi --}}
                    <div class="form-group" >
                        <label class="control-label">Deskripsi</label>
                        <textarea class="form-control" name="deskripsi" id="deskripsi" placeholder="Deskripsi Buku"> </textarea> 
                        <p class="errorDeskripsi text-center alert alert-danger hidden"></p>   
                    </div>

                    {{-- cover --}}
                    <div class="form-group">
                        <label class="control-label">Cover</label>
                        <input class="form-control" name="cover" type="file" id="cover">
                        <p class="errorCover text-center alert alert-danger hidden"></p> 
                    </div>
                    
                </form>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary fa fa-save" id="btn-save" value="add"> Simpan</button>        
                </div>

                </div>
                
                </div>
            </div>
        </div>


        {{-- MODAL HAPUS SECTION --}}
        <div class="modal fade" id="ModalHapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel">Data Buku</h4>
                </div>
                <div class="modal-body">
                     <h4 class="modal-title" id="myModalLabel">Apa Anda yakin menghapus data ini ?</h4>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn bg-orange glyphicon glyphicon-remove" id="btn-batal" value="batal"> Batal</button>
                    <button type="button" class="btn bg-maroon glyphicon glyphicon-trash" id="btn-hapus" value="hapus"> Hapus</button>
                    {{-- id --}}
                    <input type="hidden" name="id_buku1" id="id_buku1" value="0">
         
                </div>
                </div>
            </div> 
        </div>

        
        {{-- modal detail --}}
        <div class="modal fade" id="modalMd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  {{-- <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="modalMdTitle">Detail</h4>
                  </div> --}}
                  <div class="modal-body">
                      <div class="modalError"></div>
                      <div id="modalMdContent"></div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn bg-orange glyphicon glyphicon-remove" data-dismiss="modal" id="btn-tutup" value="batal"> Tutup</button>
                </div>
              </div>
          </div>
        </div>

        

        <style>
        .modal-header {
            background-color: #3e8ecf;
            padding:9px 15px;
            color:#FFF;
            font-family:Verdana, sans-serif;
            border-bottom:1px solid #eee;
            /*border-top-left-radius: 15px;
            border-top-right-radius: 15px;*/
         }
         /* .modal-body {
            background-color: #FF7171;
            padding:9px 15px;
            color:#000;
            font-family:Verdana, sans-serif;
            border-bottom:4px solid #C49F0F;
         
         } 
        .modal-footer {
            background-color: #FAEDBC;
            color:#FFF;
            border-bottom-left-radius: 15px;
            border-bottom-right-radius: 15px;
         } */
        </style>
                 
@stop

