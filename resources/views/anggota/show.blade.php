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
                            <li class="inactive">
                            	 <i class="fa fa-user"></i>
                                    <a href="{{asset('/anggota') }}">Anggota</a> 
                              
                            </li>
                            <li class="active">
                            	Detail</a>   
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
@stop

@section('main')

	<div class="row">
        <div class="col-sm-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">Detail anggota</h3>
                </div>
                    <div class="panel-body">
                    
                    <div class="col-md-12">
                    <!-- Widget: user widget style 1 -->
                    <div class="box box-widget widget-user">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header bg-aqua-active">
                            <h3 class="widget-user-username">{{ $anggota->nis}}</h3>
                            <h5 class="widget-user-desc">Anggota</h5>
                        </div>
                    <div class="widget-user-image">

                    {{-- <img class="img-circle" src="../dist/img/user1-128x128.jpg" alt="User Avatar"> --}}
                    @if(isset($anggota->foto1))
                        <img class="img-circle zoom" src="{{asset('fotoanggota/'.$anggota->foto1)}}">
                        @else
                        <img class="img-circle zoom"  src="{{asset('fotoanggota/dummymale.jpg')}}">
                    @endif
            </div>
            <div class="box-footer">
              <div class="row">
                <div class="col-sm-4 border-right">
                  <div class="description-block">


                    <table>
                            <tr>
                                <th class="col-xs-8">Nama</th>
                                <td>: {{ $anggota->nama_anggota}}</td>
                                <th class="col-xs-8">Tanggal Lahir</th>
                                <td>: {{ $anggota->tgl_lahir->format('d-m-Y') }} </td>
                            </tr>                                 
                            
                            <tr>
                                <th class="col-xs-3">Jenis Kelamin</th>
                                <td>: {{ $anggota->jenis_kelamin }} </td>
                            </tr>
                            <tr>
                                <th class="col-xs-3">Telepon</th>
                                <td>: {{ !empty($anggota->telepon)? $anggota->telepon : '-' }} </td>
                            </tr>
                            <tr>
                                <th class="col-xs-3">Alamat</th>
                                <td>: {{ $anggota->alamat}} </td>
                            </tr>

                        </table>

                    


                </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
          </div>
          <!-- /.widget-user -->

                           </div>
        </div>
    </div>

@stop

