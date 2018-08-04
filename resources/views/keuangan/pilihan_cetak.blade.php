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
                        <h3 class="panel-title">Keuangan</h3>
                    </div>
                <div class="panel-body">
                                                                     
                {!! Form::open(['url' => 'keuangan_pilih', 'method'=>'GET']) !!}

                <div class="form-group">
                    <label>Pilih Anggota</label>
                        <select class="select-search" data-placeholder=""  name="kata_kunci" >
                            <option></option>
                                            
                                @foreach($anggota_list as $anggota){
                                    <option value="{{$anggota->id}}">
                                    {{$anggota->nama_anggota }} ( {{$anggota->nis}} ) 
                                    </option>
                                }
                                @endforeach                          
                                                                                      
                        </select>
                </div>

                                <div class="form-group">
                    <label>Tanggal: </label>               
                <div class="input-group date">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                {!! Form::text('tgl1', date('d-m-Y'), array('class' => 'form-control pull-right','id' => 'datepicker1')) !!}
                @if($errors->has('tgl1'))
                    <span class="help-block" style="color:red;">{{ $errors->first('tgl1') }}</span>
                @endif
            </div>
            <!-- /.input group -->
        </div>
        <!-- /.form group -->

            <div class="form-group">
                <label>s/d </label>                     
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        {!! Form::text('tgl2', date('d-m-Y'), array('class' => 'form-control pull-right','id' => 'datepicker2')) !!}
                        @if($errors->has('tgl2'))
                            <span class="help-block" style="color:red;">{{ $errors->first('tgl2') }}</span>
                        @endif
                    </div>
                    <!-- /.input group -->
                </div>
            <!-- /.form group -->

                    <div class="col-md-6">
                        {!! Form::submit('Proses', ['class' => 'btn btn-primary form-control']) !!}
                    </div>

                {!! Form::close() !!}

    <div class="col-md-6">
        {!! Form::open(['url' => 'semua_keuangan', 'method'=>'GET']) !!}
            {!! Form::submit('Semua', ['class' => 'btn btn-primary form-control']) !!}
        {!! Form::close() !!}
    </div>  

    <!-- bootstrap datepicker -->
<script src="{{ asset('assets/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<script type="text/javascript">
    //Date picker
    $('#datepicker1').datepicker({
      format: "yyyy-mm-dd",
      autoclose: true
    });
    $('#datepicker2').datepicker({
        format: "yyyy-mm-dd",
      autoclose: true
    });
</script>                                
                                            
                                        
                                      
                               

                                    
                   
 