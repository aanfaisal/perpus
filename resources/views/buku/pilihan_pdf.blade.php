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

<div class="page-header">
    <h1 align="center">Cetak/Download</h1>
        </div>
            <div class="row">
                <div class="col-sm-4">
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
                        <h3 class="panel-title">Buku</h3>
                    </div>
                <div class="panel-body">
                                                                     
                {!! Form::open(['url' => 'buku/dwn_pdf', 'method'=>'GET']) !!}

                <div class="form-group">
                    <label>Pilih Penulis</label>
                        <select class="select-search" data-placeholder=""  name="kata_kunci" >
                            <option></option>
                                            
                                @foreach($penulis_list as $penulis){
                                    <option value="{{$penulis->id}}">
                                    {{$penulis->nm_penulis}}
                                    </option>
                                }
                                @endforeach                          
                                                                                      
                        </select>
                </div>
                <div class="form-group">
                    <label>Pilih Penerbit</label>
                        <select class="select-search" name="kata_kunci1">
                            <option></option>                                            
                                                        
                                @foreach($penerbit_list as $penerbit){
                                    <option value="{{$penerbit->id}}">
                                        {{$penerbit->nm_penerbit}}
                                    </option>
                                }
                                @endforeach                                             
                                                                                      
                        </select>
                </div>
                <div class="form-group">
                    <label>Pilih Tahun</label>
                        <select class="select-search" name="kata_kunci2">
                            <option></option>                                            
                                @foreach($tahun_list as $tahun){
                                    <option value="{{$tahun->id}}">
                                        {{$tahun->tahun}}
                                    </option>
                                }
                                 @endforeach                                
                        
                                                                                      
                        </select>
                    </div> 
                    <div class="col-md-6">
                        {!! Form::submit('Proses', ['class' => 'btn btn-primary form-control']) !!}
                    </div>

                {!! Form::close() !!}

    <div class="col-md-6">
        {!! Form::open(['url' => 'buku/semua_pdf', 'method'=>'GET']) !!}
            {!! Form::submit('Semua', ['class' => 'btn btn-primary form-control']) !!}
        {!! Form::close() !!}
    </div>                               
                                            
                                        
                                      
                               

                                    
                   
 