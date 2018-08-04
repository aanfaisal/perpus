<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Informasi Perpustakan SMK Palapa Semarang</title>

    {{-- http://materializecss.com/forms.html --}}

    <!-- Bootstrap 3.3.6 -->
    {!! Html::style("assets/bootstrap/css/bootstrap.min.css") !!}

    {{-- jqueryUI --}}
    {{-- {!! Html::style("/assets/plugins/jquery-ui/jquery-ui.css") !!} --}}

    <!-- Global stylesheets -->
    {!! Html::style("assets/bootstrap/css/bootstrap.css") !!}
    {!! Html::style("assets/bootstrap/css/core.css") !!}
    {!! Html::style("assets/bootstrap/css/components.css") !!}
    <!-- /global stylesheets -->

    {{-- materialize --}}
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    {!! Html::style("assets/bootstrap/css/materialize.min.css") !!}

    {{-- materialize-tags --}}
    {!! Html::style("assets/bootstrap/css/materialize-tags.min.css") !!}
    
</head>
<body>

    {{-- navbar --}}
    <div class="navbar-fixed">
        <nav>
            <div class="nav-wrapper teal lighten-2"> 
                <a href="{{asset('/')}}" class="brand-logo right"><img class="user-image" src="{{asset('gambar/logo.png')}}"></a>
                    <ul id="nav-mobile" class="left hide-on-med-and-down">
                        <li><a id="1" href="#">Agama</a></li>
                        <li><a id="2" href="#"">Bahasa</a></li>
                        <li><a id="3" href="#">Filsafat & Psikologi</a></li>
                        <li><a id="4" href="#">Geografi & Sejarah</a></li>
                        <li><a id="5" href="#">Ilmu Sosial</a></li>
                        <li><a id="6" href="#">Matematika</a></li>
                        <li><a id="7" href="#">Teknologi</a></li>

                        <!-- Dropdown Trigger -->
                        <li><a class="dropdown-button" href="#!" data-activates="dropdown1">Lainnya<i class="material-icons right">arrow_drop_down</i></a></li>

                        <!-- Dropdown Structure -->
                        <ul id="dropdown1" class="dropdown-content">
                            <li><a id="8" href="#">Karya Umum</a></li>
                            <li><a id="9" href="#">Kesenian, Hiburan, dan Olahraga</a></li>
                            <li><a id="10" href="#">Kesusasteraan</a></li>
                        </ul>
                        <li><a href="{{asset('admin')}}" target="_blank">Login</a></li>
                    </ul>
            </div>
        </nav>
    </div>
    <br>
    {{-- end navbar --}}

    {{-- pencarian --}}
    <h4 align="center">{ CARI KOLEKSI BUKU }</h4>    
    <form action="{{ url('buku/cari') }}" method="GET">
        <div class="row">
            <div class="col s12">
                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">search</i>
                        <input type="text" name="q" data-role="materialtags" autocomplete="off">
                        <label for="autocomplete-input">kata kunci</label>
                    </div>
                        <button type="submit" class="btn btn-flat pink accent-3 waves-effect waves-light white-text right cari">Cari <i class="material-icons right">search</i></button>
                </div>
            </div>
    </form>
    {{-- end pencarian --}}

    {{-- Page container --}}
    <div class="page-container">
        <!-- Page content -->
        <div class="page-content">
            <!-- Main content -->
            <div class="content-wrapper">
                <!-- Content area -->
                <div class="content">

                    <!-- Search results -->
                    <div class="content-group">
                        <p class="text-muted text-size-small content-group">About {{$jumlah}} results ({{$waktu}} seconds)</p>

                        <div class="search-results-list">
                            <div class="row">

                                @foreach($datas as $data)

                                <div class="col-lg-3 col-sm-6">
                                    <div class="thumbnail">
                                        <div class="thumb thumb-rounded">
                                            @if(isset($data->cover))
                                                <img src="{{asset('coverbuku/'.$data->cover)}}" >
                                                @else
                                                <img src="{{asset('coverbuku/placeholder.jpg')}}" >
                                            @endif
                                            
                                            <div class="caption-overflow">
                                                <span>
                                                <a href="#modalMd" class="btn border-white text-white btn-flat btn-icon btn-rounded ml-5 modalMd" data-toggle="modal" data-target="#modalMd" value="{{action('BukuController@showf',['id'=>$data->id])}}"><i class="icon-link2"></i>Detail</a>

                                                </span>
                                            </div>
                                        </div>
                                    
                                        <div class="caption text-center">
                                            <h6 class="text-semibold no-margin">{{ $data->judul }}<small class="display-block"> 

                                                @if($data->stok > 0)
                                                    TERSEDIA/{{$data->stok}}
                                                @else
                                                    HABIS
                                                @endif

                                                </small></h6>
                                            <ul class="icons-list mt-15">
                                                <li><a href="#" data-popup="tooltip" title="Google Drive"><i class="icon-google-drive"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                @endforeach
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- /search results -->

                    @yield('main') 
                    
                    <!-- Pagination -->
                    <div class="text-center content-group pt-20">
                        <ul class="pagination">
                             {{ $datas->links() }}
                        </ul>
                    </div>
                    <!-- /pagination -->

                </div>
                <!-- /content area -->

            </div>
            <!-- /main content -->

        </div>
        <!-- /page content -->

    </div>
    <!-- /page container -->


    <!-- jQuery 2.2.3 -->
    {!! Html::script("assets/plugins/jQuery/jquery-2.2.3.min.js") !!} 
    <!-- Bootstrap 3.3.6 -->
    {!! Html::script("assets/bootstrap/js/bootstrap.min.js") !!}
    {{-- jqueryUI --}}
    {{-- {!! Html::script("/assets/plugins/jquery-ui/jquery-ui.js") !!} --}}
    {{-- materialize --}}
    {!! Html::script("assets/bootstrap/js/materialize.min.js") !!} 
    {{-- materialize-tags --}}
    {!! Html::script("assets/bootstrap/js/materialize-tags.min.js") !!}
    <!-- Typeahead.js Bundle -->
    {!! Html::script("assets/bootstrap/js/typeahead.bundle.min.js") !!}

    <!-- autocomplete Initialization -->
    <script type="text/javascript">

        $(document).ready(function() {

            // tampil detail buku render view ================================
            $(document).on('ajaxComplete ready', function () {
                $('.modalMd').modal();

                $('.modalMd').on('click', function () {
                    $('#modalMdContent').load($(this).attr('value'));
                });
            });


            $("#1").click(function(){
                $("input:text").val("Agama");
                $("input").focus();
            });
            $("#2").click(function(){
                $("input:text").val("Bahasa");
                $("input").focus();
            });
            $("#3").click(function(){
                $("input:text").val("Filsafat & Psikologi");
                $("input").focus();
            });
            $("#4").click(function(){
                $("input:text").val("Geografi & Sejarah");
                $("input").focus();
            });
            $("#5").click(function(){
                $("input:text").val("Ilmu Sosial");
                $("input").focus();
            });
            $("#6").click(function(){
                $("input:text").val("Matematika");
                $("input").focus();
            });
            $("#7").click(function(){
                $("input:text").val("Teknologi");
                $("input").focus();
            });
            $("#8").click(function(){
                $("input:text").val("Karya Umum");
                $("input").focus();
            });
            $("#9").click(function(){
                $("input:text").val("Kesenian-Hiburan dan Olahraga");
                $("input").focus();
            });
            $("#10").click(function(){
                $("input:text").val("Kesusasteraan");
                $("input").focus();
            });

            document.onkeypress = enter;
            function enter(e) {
              if (e.which == 13) { sendform(); }
            }

            //Form to send
            function sendform() {
              document.forms[0].submit();
            }
  
            var katakunci = new Bloodhound({
                remote: {
                        url: 'buku/cari/auto?q=%QUERY%',
                        wildcard: '%QUERY%'
                    },
                datumTokenizer: Bloodhound.tokenizers.obj.whitespace('q'),
                queryTokenizer: Bloodhound.tokenizers.whitespace,

                });

            katakunci.initialize();

            $('input').typeahead({
              hint      : true,
              highlight : true,
              minLength : 1,
              searchOnFocus: true,
            },
            {
                source:katakunci.ttAdapter(),
                name        : 'buku',
                displayKey  : 'judul',
                templates   : {
                    suggestion: function (data) {
                        return '<div><strong>'+ data.judul +'</strong> ('+ data.stok +')</div>'
                    }
                }

            });

            

    });


    </script>

    <a href="#" class="back-to-top" style="display: inline;">
        <i class="material-icons">keyboard_arrow_up</i>   
    </a>


</body>
    <footer class="page-footer teal lighten-2">   
        <div class="footer-copyright">
            <div class="container">
            © 2018 Copyright Perpussmkpalapasemarang
            <a class="grey-text text-lighten-4 right" href="#!">Version 1.0</a>
            </div>
        </div>
    </footer>

</html>


<!-- Modal Structure -->
<div id="modalMd" class="modal fade modal-fixed-footer">
    <div class="modal-content">
        <div id="modalMdContent"></div>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat" data-dismiss="modal">Tutup</a>
    </div>
</div>

<style>
 
.back-to-top {
 
background: none;
 
margin: 0;
 
position: fixed;
 
bottom: 0;
 
right: 0;
 
width: 70px;
 
height: 70px;
 
z-index: 100;
 
display: none;
 
text-decoration: none;
 
/*color: #ffffff;*/
 
/*background-color: #ff9000;*/
 
}
 
  
 
.back-to-top i {
 
  font-size: 60px;
 
}
 
</style>







