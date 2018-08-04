@extends('template')

@section('navbar')

    <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Telegram - Perpussmkpalapa
                        </h1>
                        <ol class="breadcrumb">
                            <li class="inactive">
                                <i class="fa fa-dashboard"></i>
                                    <a href="{{asset('/dashboard') }}">Dashboard</a> 
                            </li>
                            <li class="active">
                                Telegram
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
@stop

@section('main')
@if(Session::has('message'))
                    <div class="alert alert-{{ Session::get('status') }} status-box">
                        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        {{ Session::get('message') }}
                    </div>
            @endif

<div class="col-md-2"></div>
<div class="col-md-7">
 <div class="panel panel-red ">
        <div class="panel-heading">
            <h3 class="panel-title">Telegram</h3>
        </div>
            <div class="panel-body">
            <div>
            
                <form action="telegram/kirim" class="form-signin" method="post">
                    {{ csrf_field() }}
                    <h2 class="form-signin-heading">Kirim Pesan Sebagai PerpusBot</h2>
                    <label for="inputText" class="sr-only">Pesan</label>
                    <textarea rows="8" name="message" type="text" id="inputText" class="form-control" placeholder="Pesan" required autofocus ></textarea>
                    <br />

                    <button class="btn btn-lg btn-danger btn-block" type="submit">Kirim</button>
                </form>
                <br />
            </div>
        </div>


                
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                        
@stop
