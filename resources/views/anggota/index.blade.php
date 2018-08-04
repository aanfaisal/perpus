@extends('template') 

@section('navbar')

    <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Data Anggota
                        </h1>
                        <ol class="breadcrumb">
                            <li class="inactive">
                                <i class="fa fa-dashboard"></i>
                                    <a href="{{asset('/dashboard') }}">Dashboard</a> 
                            </li>
                            <li class="active">
                                Anggota
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
@stop

@section('main')

 <div class="panel panel-primary ">
    <div class="panel-heading">
        <h3 class="panel-title">Anggota</h3>
    </div>
        <div class="panel-body">
        <!-- /.box-header -->
            <table id="tAnggota" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>                                                         
                        <th>NIS</th>
                        <th>Nama</th>
                        <th>Tanggal Lahir</th>
                        <th>Jenis Kelamin</th>
                        <th>Aksi</th>                           
                    </tr>
                </thead>       
        </table> 

        @push('scripts')
        <script>
        $(function() {
            $('#tAnggota').DataTable({
                processing: true,
                serverSide: true,
                searching : true,
                autoWidth : true,
                ajax: '{!! url ('anggotaData') !!}',
                columns: [
                    {data: 'nis'},
                    {data: 'nama_anggota'},
                    {data: 'tanggal'},
                    {data: 'jenis_kelamin'},
                    {data: 'action', orderable: false, searchable: false}
                ]
            });

            $('.tgl_lahir').datepicker({
            showOn: "button",
            changeMonth: true,
            changeYear: true,
            yearRange: "-1:+0",
            dateFormat: 'dd-mm-yy',
            // maxDate: '0',
            language: 'id',
            highLight: true,
            autoclose: true
            });
        });
        </script>

        <script src="{{asset('assets/app/anggota.js')}}"></script>

        @endpush 

        <div class="table-nav">                  

                {{-- {{ link_to('anggota/tambah',' Tambah',['class'=>'btn btn-xs bg-blue glyphicon glyphicon-plus']) }} --}}

                <div class="pull-left">
                    <button id="btn_addAnggota" name="btn_addAnggota" class="btn btn-xs bg-blue glyphicon glyphicon-plus pull-right"> Tambah</button>
                </div>&nbsp;

                {{ link_to('anggota/cari_pdf',' Cetak',['class'=>'btn btn-xs bg-blue glyphicon glyphicon-print','target'=>'_blank']) }}

                {{-- {{ link_to('anggota/cari_cetak',' Cetak',['class'=>'btn btn-xs bg-blue glyphicon glyphicon-print']) }} --}}

        </div> 


        {{-- MODAL TAMBAH/EDIT SECTION --}}
        <div class="modal fade" id="ModalAnggota" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-title" id="myModalLabel">Data Anggota</h4>
                    </div>
                <div class="modal-body">

                <form id="frmAnggota">
                    
                     {!! csrf_field() !!}

                    {{-- id --}}
                    <input type="hidden" name="id_anggota" id="id_anggota"> 

                    {{-- nis --}}
                    <div class="form-group" >
                        <label class="control-label">NIS</label>
                        <input class="form-control" type="number" name="nis" id="nis" placeholder="NIS">  
                        <p class="errorNis text-center alert alert-danger hidden"></p>   
                    </div>

                    {{-- nama anggota --}}
                    <div class="form-group" >
                        <label class="control-label">Nama</label>
                        <input class="form-control" type="text" name="nama_anggota" id="nama_anggota" placeholder="nama anggota">  
                        <p class="errorNamaAnggota text-center alert alert-danger hidden"></p>   
                    </div>

                    {{-- tgl lahir --}}
                    <div class="form-group" >
                        <label class="control-label">Tanggal Lahir</label>
                        <input class="form-control tgl_lahir" type="text" name="tgl_lahir" id="tgl_lahir" placeholder="Tanggal Lahir">  
                        <p class="errorTglLahir text-center alert alert-danger hidden"></p>   
                    </div>

                    {{-- Jenis Kelamin --}}
                    <div class="form-group" >
                        <label class="control-label">Jenis Kelamin</label>
                        <div class="radio">
                            <label>
                                <input type="radio" name="jenis_kelamin" value="L" checked> Laki - Laki
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="jenis_kelamin" value="P"> Perempuan
                            </label>
                        </div>                        
                    </div>

                    {{-- telepon --}}
                    <div class="form-group" >
                        <label class="control-label">Telepon</label>
                        <input class="form-control" name="telepon" type="text" id="telepon" placeholder="telepon">
                        <p class="errorTelepon text-center alert alert-danger hidden"></p>     
                    </div>

                    {{-- alamat --}}
                    <div class="form-group" >
                        <label class="control-label">Alamat</label>
                        <textarea class="form-control" name="alamat" id="alamat" placeholder="alamat" placeholder="alamat" rows="5"></textarea> 
                        <p class="errorAlamat text-center alert alert-danger hidden"></p> 
                          
                    </div>

                    {{-- foto --}}
                    <div class="form-group">
                        <label class="control-label">Foto</label>
                        <input class="form-control" name="foto1" type="file" id="foto1">
                        <p class="errorFoto text-center alert alert-danger hidden"></p> 
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
                    <h4 class="modal-title" id="myModalLabel">Data Anggota</h4>
                </div>
                <div class="modal-body">
                     <h4 class="modal-title" id="myModalLabel">Apa Anda yakin menghapus data ini ?</h4>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn bg-orange glyphicon glyphicon-remove" id="btn-batal" value="batal"> Batal</button>
                    <button type="button" class="btn bg-maroon glyphicon glyphicon-trash" id="btn-hapus" value="hapus"> Hapus</button>
                    {{-- id --}}
                    <input type="hidden" name="id_anggota1" id="id_anggota1" value="0">
         
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

