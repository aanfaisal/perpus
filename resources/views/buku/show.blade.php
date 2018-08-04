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
                            <li class="inactive">
                            	 <i class="fa fa-book"></i>
                                    <a href="{{asset('/buku') }}">Buku</a> 
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
                                <h3 class="panel-title">Detail Buku</h3>
                            </div>
                            
                            @if(isset($buku->cover))
                                <img class="profile-user-img img-responsive img-circle" src="{{asset('coverbuku/'.$buku->cover)}}">
                            @else
                                <img class="profile-user-img img-responsive img-circle" src="{{asset('coverbuku/placeholder.jpg')}}" >
                            @endif

                            <div class="panel-body">
                                <table>
                                    <tr>
                                        <th class="col-xs-3">Judul Buku </th>
                                        <td>: {{ $buku-> judul}}</td>
                                    </tr>   
                                    <tr>
                                        <th class="col-xs-3">Penulis</th>
                                        <td>: {{ $buku->penulis->nm_penulis}}</td>
                                    </tr>                                
                                    <tr>
                                        <th class="col-xs-3">Penerbit</th>
                                        <td>: {{ $buku->penerbit->nm_penerbit}}</td>
                                    </tr>
                                    <tr>
                                        <th class="col-xs-3">Tahun Terbit</th>
                                        <td>: {{ $buku->tahun_terbit->tahun }}</td>
                                    </tr>
                                    <tr>
                                        <th class="col-xs-3">Klasifikasi</th>
                                        <td>: {{ $buku->klasifikasi->kelas}} ( {{$buku->klasifikasi->ket}} )</td>
                                    </tr>
                                    <tr>
                                        <th class="col-xs-3">Jumlah</th>
                                        <td>: {{ $buku->jumlah }}</td>
                                    </tr>
                                    <tr>
                                        <th class="col-xs-3">Stok</th>
                                        <td>: {{ $buku->stok }}</td>
                                    </tr>
                                    <tr>
                                        <th class="col-xs-3">Deskripsi</th>
                                        <td>: {{ $buku->deskripsi}}  </td>
                                    </tr>
                                    
                                    
                                </table>
                            </div>
                        </div>
                    

@stop
