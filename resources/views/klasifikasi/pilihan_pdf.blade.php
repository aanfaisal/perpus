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
                        <h3 class="panel-title">Semua</h3>
                    </div>
                <div class="panel-body">
            <div class="col-md-6">
                {!! Form::open(['url' => 'klasifikasi/semua_pdfKlasifikasi', 'method'=>'GET']) !!}
                    {!! Form::submit('Semua', ['class' => 'btn btn-primary form-control']) !!}
                {!! Form::close() !!}
            </div>      
            </div>                         
                                            
                                        
                                      
                               

                                    
                   
 