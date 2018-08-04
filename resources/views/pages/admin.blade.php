@extends('template')

@section('navbar')

	<div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Beranda 
                        </h1>             
                    </div>
                </div>
                <!-- /.row -->
@stop

@section('main')
	<h1 align="center">Sistem Informasi Perpustakaan Sekolah SMK Palapa Semarang</h1><br>
    <div class="col-lg-3">
        <div class="col-lg-5">
            <table border="2">
                <tr align="center">
                    <td>
                        <img src="{{asset('gambar/images (1).jpg')}}" width="1030" height="300">
                    </td>
                </tr>
            </table>
@stop
