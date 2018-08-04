@extends('template')

@section('navbar')

    <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Data Penulis 
                        </h1>
                        <ol class="breadcrumb">
                            <li class="inactive">
                                <i class="fa fa-dashboard"></i>
                                    <a href="{{asset('/dashboard') }}">Dashboard</a> 
                            </li>
                            <li class="inactive">
                            	 <i class="fa fa-user"></i>
                                    <a href="{{asset('/penulis') }}">Penulis</a> 
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
                    <h3 class="panel-title">Detail penulis</h3>
                </div>
                    <div class="panel-body">
                        <table>
                            <tr>
                                <th class="col-xs-3">Nama</th>
                                <td>: {{ $penulis-> nm_penulis}}</td>
                            </tr>                                	
                            <tr>
                                <th class="col-xs-3">Telepon</th>
                                <td>: {{ $penulis->tlpn}}</td>
                            </tr>
                            <tr>
                                <th class="col-xs-3">Alamat</th>
                                <td>: {{ $penulis->alamat }}</td>
                            </tr>

                        </table>
                    </div>
            </div>

@stop

