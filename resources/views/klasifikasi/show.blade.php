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
                            <li class="inactive">
                            	 <i class="fa fa-user"></i>
                                    <a href="{{asset('/klasifikasi') }}">Klasifikasi</a> 
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
                    <h3 class="panel-title">Detail klasifikasi Buku</h3>
                </div>
                    <div class="panel-body">
                        <table>
                            <tr>
                                <th class="col-xs-3">Kelas</th>
                                <td>: {{ $klasifikasi-> kelas}}</td>
                            </tr>                                	
                            <tr>
                                <th class="col-xs-3">Keterangan</th>
                                <td>: {{ $klasifikasi->ket}}</td>
                            </tr>

                        </table>
                    </div>
            </div>

@stop

