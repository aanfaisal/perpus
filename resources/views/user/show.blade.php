@extends('template')

@section('navbar')

    <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Data user 
                        </h1>
                        <ol class="breadcrumb">
                            <li class="inactive">
                                <i class="fa fa-dashboard"></i>
                                    <a href="{{asset('/dashboard') }}">Dashboard</a> 
                            </li>
                            <li class="inactive">
                            	 <i class="fa fa-user"></i>
                                    <a href="{{asset('/user') }}">user</a> 
                              
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
                    <h3 class="panel-title">Detail Admin</h3>
                </div>
                <div class="panel-body"> 

                    <div class="col-md-12">
                    <!-- Widget: user widget style 1 -->
                    <div class="box box-widget widget-user">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header bg-aqua-active">
                            <h3 class="widget-user-username">{{ $user->name}}</h3>
                            <h5 class="widget-user-desc">Admin</h5>
                        </div>
                    <div class="widget-user-image">

                    {{-- <img class="img-circle" src="../dist/img/user1-128x128.jpg" alt="User Avatar"> --}}
                    @if(isset($user->foto))
                        <img style="text-align:justify;" class="img-circle zoom" src="{{asset('fotouser/'.$user->foto)}}">
                        @else
                        <img class="img-circle zoom"  src="{{asset('fotouser/dummymale.jpg')}}">
                    @endif
            </div>
            <div class="box-footer">
              <div class="row">
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header">Email</h5>
                    <span>{{ $user->email }}</span>
                  </div>
                  <!-- /.description-block -->
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

