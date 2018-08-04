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

@include('_partial.flash_message_tambah')
@include('_partial.flash_message_edit')
@include('_partial.flash_delete')
@include('_partial.flash_message_hapus')


 <div class="panel panel-primary ">
    <div class="panel-heading">
        <h3 class="panel-title">Anggota</h3>
    </div>
        <div class="panel-body">
        <!-- /.box-header -->
            <table id="table" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>                                                         
                        <th>NIS</th>
                        <th>Nama</th>
                        <th>Tanggal Lahir</th>
                        <th>Jenis Kelamin</th>
                        <th >Aksi</th>                            
                    </tr>
                </thead>
                <tbody>
                    <?php
                    use App\Anggota; 

                    $anggotas = App\Anggota::paginate(10);

                   
                        foreach ($anggotas as $anggota) {
                    ?>
                            <tr>                                          
                                <td>{{ $anggota->nis }}</td>
                                <td>{{ $anggota->nama_anggota }}</td>
                                <td>{{ $anggota->tgl_lahir->format('d-m-Y')}}</td>
                                <td>{{ $anggota->jenis_kelamin }}</td>
                                <td>                                           
                                    <div class="box-button">
                                        {{ link_to('anggota/'. $anggota->id .'/detail',' Detail ',['class'=>'btn btn-xs bg-olive glyphicon glyphicon-info-sign']) }}                            
                                                   
                                        {{ link_to('anggota/'. $anggota->id .'/edit',' Edit ',['class'=>'btn btn-xs bg-orange glyphicon glyphicon-edit']) }}

                                        {{ link_to('anggota/'. $anggota->id .'/hapus',' Hapus ',['class'=>'btn btn-xs bg-maroon glyphicon glyphicon-remove','onclick' => 'return ConfirmDelete()']) }}

                                    </div>                                             
                                </td>
                            </tr>  
                    <?php        
                        }

                    

                    ?>
            </tbody>  
         
        </table>                
                        
        <div class="table-nav">                  

                {{ link_to('anggota/tambah',' Tambah',['class'=>'btn btn-xs bg-blue glyphicon glyphicon-plus']) }}

                {{ link_to('anggota/cari_pdf',' Cetak',['class'=>'btn btn-xs bg-blue glyphicon glyphicon-print','target'=>'_blank']) }}

                {{-- {{ link_to('anggota/cari_cetak',' Cetak',['class'=>'btn btn-xs bg-blue glyphicon glyphicon-print']) }} --}}

        </div> 
                        
@stop

