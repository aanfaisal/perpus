@extends('template')

@section('navbar')

    <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Data Penerbit 
                        </h1>
                        <ol class="breadcrumb">
                            <li class="inactive">
                                <i class="fa fa-dashboard"></i>
                                    <a href="{{asset('/dashboard') }}">Dashboard</a> 
                            </li>
                            <li class="inactive">
                            	 <i class="fa fa-align-center"></i>
                                    <a href="{{asset('/penerbit') }}">Penerbit</a> 
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
                                <h3 class="panel-title">Detail Penerbit</h3>
                            </div>
                            <div class="panel-body">
                                <table>
                                	<tr>
                                		<th class="col-xs-3">Nama</th>
                                		<td>: {{ $penerbit-> nm_penerbit}}</td>
                                	</tr>                                	
                                	<tr>
                                		<th class="col-xs-3">Telepon</th>
                                		<td>: {{ !empty($penerbit->tlpn)?$penerbit->tlpn: '-' }}</td>
                                	</tr>
                                    <tr>
                                        <th class="col-xs-3">Alamat</th>
                                        <td>: {{ $penerbit->alamat}}  </td>
                                    </tr>
                                	
                                </table>
                            </div>
                        </div>

@stop

