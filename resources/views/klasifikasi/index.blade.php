@extends('template')

@section('navbar') 

    <div id="page-wrapper">

            <div class="container-fluid"> 

                <!-- Page Heading -->
                <div class="row"> 
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Data Klasifikasi Buku
                        </h1>
                        <ol class="breadcrumb">
                            <li class="inactive">
                                <i class="fa fa-dashboard"></i>
                                    <a href="{{asset('/dashboard') }}">Dashboard</a> 
                            </li>
                            <li class="active">
                                Klasifikasi
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
@stop
 
@section('main')

 <div class="panel panel-primary ">
    <div class="panel-heading">
        <h3 class="panel-title">Klasifikasi</h3>
    </div>
        <div class="panel-body">
        <!-- /.box-header -->
            <table id="tKlasifikasi" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>                                                         
                        <th>Kelas</th>
                        <th>Keterangan</th>
                        <th >Aksi</th>                            
                    </tr>
                </thead>                
        </table> 
         
        @push('scripts')
            <script>
            $(function() {
                $('#tKlasifikasi').DataTable({
                    processing: true,
                    serverSide: true,
                    searching : true,
                    autoWidth : true,
                    ajax: '{!! url ('klasifikasiData') !!}',
                    columns: [
                        {data: 'kelas'},
                        {data: 'ket'},
                        {data: 'action', orderable: false, searchable: false}
                    ]
                });
            });
            </script> 

            <script src="{{asset('assets/app/klasifikasi.js')}}"></script>
        @endpush  


    <div class="pull-left">
        <button id="btn_add" name="btn_add" class="btn btn-xs bg-blue glyphicon glyphicon-plus pull-right"> Tambah</button>
    </div>&nbsp;
                

    {{ link_to('klasifikasi/semua_pdf',' Cetak',['class'=>'btn btn-xs bg-blue glyphicon glyphicon-print','target'=>'_blank']) }}

                

        {{-- MODAL TAMBAH/EDIT SECTION --}}
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-title" id="myModalLabel">Data Klasifikasi Buku</h4>
                    </div>
                <div class="modal-body">

                <form id="frmKlasifikasi">

                    {!! csrf_field() !!}

                    {{-- id --}}
                    <input type="hidden" name="id_klasifikasi" id="id_klasifikasi" value="0">
                    
                    {{-- kelas --}}
                    <div class="form-group" >
                        <label class="control-label">Kelas</label>
                        <input class="form-control" type="text" name="kelas" id="kelas" placeholder="kelas">  
                        <p class="errorKelas text-center alert alert-danger hidden"></p>
                    </div>

                    {{-- Keterangan --}}
                    <div class="form-group" >
                        <label class="control-label">Keterangan</label>
                        <input class="form-control" type="text" name="ket" id="ket" placeholder="keterangan">
                         <p class="errorKet text-center alert alert-danger hidden"></p>

                    </div>
                    
                </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary fa fa-save" id="btn-save" value="add"> Simpan</button>
         
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
                    <h4 class="modal-title" id="myModalLabel">Data Klasifikasi</h4>
                </div>
                <div class="modal-body">
                     <h4 class="modal-title" id="myModalLabel">Apa Anda yakin menghapus data ini ?</h4>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn bg-orange glyphicon glyphicon-remove" id="btn-batal" value="batal"> Batal</button>
                    <button type="button" class="btn bg-maroon glyphicon glyphicon-trash" id="btn-hapus" value="hapus"> Hapus</button>
                    {{-- id --}}
                    <input type="hidden" name="id_klasifikasi1" id="id_klasifikasi1" value="0">
         
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

