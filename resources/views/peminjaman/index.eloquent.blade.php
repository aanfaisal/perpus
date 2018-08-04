@extends('template')

@section('navbar')

    <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Data Peminjaman
                        </h1>
                        <ol class="breadcrumb">
                            <li class="inactive">
                                <i class="fa fa-dashboard"></i>
                                    <a href="{{asset('/dashboard') }}">Dashboard</a> 
                            </li>
                            <li class="active">
                                Peminjaman
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
@stop

@section('main')

{{-- @include('buku.form_pencarian') --}}
@include('_partial.flash_message_tambah')
@include('_partial.flash_message_edit')
@include('_partial.flash_delete')
@include('_partial.flash_message_hapus')

 <div class="panel panel-primary ">
    <div class="panel-heading">
        <h3 class="panel-title">Peminjaman</h3>
    </div>
        <div class="panel-body"> 
        <!-- /.box-header -->
            <table id="table" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>                                                         
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Tgl Pinjam</th>
                        <th>Tgl Kembali</th>
                        <th>Waktu</th>
                        <th>Jml</th>
                        <th>Denda</th>
                        <th>Aksi</th>                        
                    </tr>
                </thead>
                <tbody>
                @foreach ($peminjaman_list as $peminjaman)                                  
                        <tr>                                          
                            <td>{{ $peminjaman->kode }} </td>
                            <td>{{ $peminjaman->anggota->nama_anggota }}</td>
                            <td>{{ $peminjaman->tgl_pinjam->format('d-m-Y') }}</td>
                            <td>{{ $peminjaman->tgl_kembali->format('d-m-Y') }}</td>
                            <td>
                                <?php 
                                    $tgl        = strtotime($peminjaman->tgl_kembali) ;
                                    $tgl_skrng  = strtotime(date("d-m-Y"));
                                    $durasi      = ($tgl - $tgl_skrng) / 86400 ;
                                ?>

                                @if ($durasi < 0 )
                                    Durasi Habis / {{ $durasi }} Hari
                                @else
                                    {{ $durasi }} Hari
                                 @endif
                                </td>
                                <td>
                                    <?php $total_buku=0; ?>
                                        @foreach($peminjaman->buku as $data)  
                                            <?php $total_buku++;?>
                                        @endforeach
                                    {{$total_buku}}
                                </td>
                                <td>                                     
                                    @if($durasi<0)
                                        <?php $denda = abs($durasi)*500*$total_buku; ?>
                                            {{$denda}}
                                    @else
                                        0
                                    @endif
                                </td>
                                <td>   
                                    {{ link_to('peminjaman/' . $peminjaman->id . '/detail',' Detail ',['class'=>'btn btn-xs bg-olive glyphicon glyphicon-info-sign']) }}
                                  
                                    {{ link_to('peminjaman/' . $peminjaman->id . '/edit',' Edit ',['class'=>'btn btn-xs bg-orange glyphicon glyphicon-edit']) }}
                                                                
                                    {{ link_to('peminjaman/' . $peminjaman->id . '/hapus',' Hapus ',['class'=>'btn btn-xs bg-maroon glyphicon glyphicon-remove','onclick'=>'return ConfirmDelete()']) }}                                                   
                                </td>
                            </tr>                                    
                @endforeach   
                </tbody>              
            </table>               
                               
{{ link_to('peminjaman/tambah',' Tambah Buku',['class'=>'btn btn-xs bg-blue glyphicon glyphicon-edit']) }}

{{ link_to('peminjaman/cari_pdf',' Cetak',['class'=>'btn btn-xs bg-blue glyphicon glyphicon-print','target'=>'_blank']) }}
                        
@stop

