<!-- Bootstrap Core CSS -->
<link href="{{ asset('theme/css/bootstrap.min.css') }}" rel="stylesheet">
<!-- Custom CSS -->
{!! Html::script("/theme/js/jquery-2.1.0.js") !!}  
{!! Html::script("/theme/js/bootstrap.min.js") !!}  

<!-- Global stylesheets -->  
<link href="{{asset('assets/select2/css/icons/icomoon/styles.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('assets/select2/css/components.css')}}" rel="stylesheet" type="text/css">  
 <!-- Core JS files -->
<script type="text/javascript" src="{{asset('assets/select2/js/core/libraries/jquery.min.js')}}"></script>
<!-- /core JS files -->
<!-- Theme JS files -->  
<script type="text/javascript" src="{{asset('assets/select2/js/plugins/forms/selects/select2.min.js')}}"></script>   
<script type="text/javascript" src="{{asset('assets/select2/js/pages/form_select2.js')}}"></script>
<!-- /theme JS files -->

<br>
<div class="page-header">
    <h1 align="center">Cetak/Download</h1>
        </div></div>
            <div class="row">
                <div class="col-sm-2">
                    <div hidden="" class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"></h3>
                        </div>                    
            </div>                        
        </div>
        <!-- /.col-sm-4 -->
        <div class="row">
            <div class="col-sm-4">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">Anggota</h3>
                    </div>
                <div class="panel-body">
                                                                     
                {!! Form::open(['url' => 'anggota/dwn_pdfAnggota', 'method'=>'GET']) !!}

                <div class="form-group">
                    <label>Pilih Anggota</label>
                       <select class="select-search" data-placeholder=""  name="kata_kunci" >
                            <option></option>
                            @foreach($anggota_list as $anggota){
                            <option value="{{ $anggota->jenis_kelamin }}">{{ $anggota->jenis_kelamin }}</option>
                            } 
                            @endforeach              
                        </select>
                        <br>
                    <br>
                <br>
            <br>
        <br>
                </div>              
                    <div class="col-md-6">

                        {!! Form::submit('Proses', ['class' => 'btn btn-primary form-control']) !!}
                    </div>

                {!! Form::close() !!}

    <div class="col-md-6">
        {!! Form::open(['url' => 'anggota/semua_pdfAnggota', 'method'=>'GET']) !!}
            {!! Form::submit('Semua', ['class' => 'btn btn-primary form-control']) !!}
        {!! Form::close() !!}
    </div>
    </div>
    </div>
</div>


    {{-- kartu anggota perpus --}}
        <!-- /.col-sm-4 -->
        <div class="row">
            <div class="col-sm-4">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">Kartu Anggota Perpus</h3>
                    </div>
                <div class="panel-body">
                                                                     
                {!! Form::open(['url' => 'anggota/dwn_pdfKartuAnggota', 'method'=>'GET']) !!}

                <div class="form-group">
                    <label>Pilih NIS</label>
                       <select class="select-search" data-placeholder=""  name="kata_kunci1" >
                            <option></option>
                            @foreach($anggota_list1 as $anggota){
                            <option value="{{ $anggota->nis }}">{{ $anggota->nis }}</option>
                            } 
                            @endforeach              
                        </select>
                        @if($errors->has('kata_kunci1'))
                              <span class="help-block" style="color:red;">{{ $errors->first('kata_kunci1') }}</span>
                        @endif
                </div>   

                 <div class="form-group">
                    <label>s/d</label>
                       <select class="select-search" data-placeholder=""  name="kata_kunci2" >
                            <option></option>
                            @foreach($anggota_list1 as $anggota){
                            <option value="{{ $anggota->nis }}">{{ $anggota->nis }}</option>
                            } 
                            @endforeach              
                        </select>
                        @if($errors->has('kata_kunci2'))
                              <span class="help-block" style="color:red;">{{ $errors->first('kata_kunci2') }}</span>
                        @endif
                </div>     


                    <div class="col-md-6">
                        {!! Form::submit('Proses', ['class' => 'btn btn-primary form-control']) !!}
                    </div>

                {!! Form::close() !!}

    <div class="col-md-6">
        {!! Form::open(['url' => 'anggota/semua_pdfKartuAnggota', 'method'=>'GET']) !!}
            {!! Form::submit('Semua', ['class' => 'btn btn-primary form-control']) !!}
        {!! Form::close() !!}
    </div> 
   
                               

                                    
                   
 