<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Sistem Informasi Perpustakan SMK Palapa Semarang</title>

    {{-- http://materializecss.com/forms.html --}}

	<!-- Bootstrap 3.3.6 -->
  	{{-- {!! Html::style("assets/bootstrap/css/bootstrap.min.css") !!} --}}
    <!-- materialize -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    {!! Html::style("assets/bootstrap/css/materialize.min.css") !!}

</head>
<body>

    {{-- navbar --}}
    <div class="navbar-fixed">
        <nav>
            <div class="nav-wrapper teal lighten-2">
              <a href="#" class="brand-logo right">Logo</a>
              <ul id="nav-mobile" class="left hide-on-med-and-down">
                <li><a href="sass.html">Sass</a></li>
                <li><a href="badges.html">Components</a></li>
                <li><a href="{{asset('admin')}}">Login</a></li>
              </ul>
            </div>
    </nav>
    </div>

	<h4 align="center">Cari Koleksi Buku</h4>
    {{-- <hr> --}}
    {{-- <form class="typeahead" role="search">
     	<div class="form-group">
        <input type="search" name="q" class="form-control search-input" placeholder="Cari Buku" autocomplete="off">
     	</div>
    </form> --}}

  <form action="{{ url('buku/cari') }}" method="GET">
    <div class="row">
    <div class="col s12">
      <div class="row">
        <div class="input-field col s12">
          <i class="material-icons prefix">search</i>
          <input type="text" name="q" id="autocomplete-input" class="autocomplete">
          <label for="autocomplete-input">kata kunci</label>
        </div>
        <button type="submit" class="btn btn-flat pink accent-3 waves-effect waves-light white-text right cari">Cari <i class="material-icons right">search</i></button>
      </div>
    </div>
  </div>
</form>

  <div class="section">
    @if (count($hasil))
    <div class="card-panel green white-text">Hasil pencarian : <b>{{$query}}</b></div>
        @foreach($hasil as $data)
        <div class="row">
        <div class="col s12">
          <h5>{{ $data->judul }}</h5>

                <div class="divider"></div>
                {{-- <p>{!!substr($data->isi,0,200)!!}...</p> --}}
        </div>
      </div>
      @endforeach

    </div>
    
    {{ $hasil->render() }}

    @else
   <div class="card-panel red darken-3 white-text">Oops.. Data <b>{{$query}}</b> Tidak Ditemukan</div>
    @endif
    	

    <!-- jQuery 2.2.3 -->
	{!! Html::script("assets/plugins/jQuery/jquery-2.2.3.min.js") !!} 
    {{-- materialize --}}
    {!! Html::script("assets/bootstrap/js/materialize.min.js") !!} 
    <!-- Bootstrap 3.3.6 -->
	{{-- {!! Html::script("assets/bootstrap/js/bootstrap.min.js") !!} --}}
    <!-- Typeahead.js Bundle -->
    {!! Html::script("assets/bootstrap/js/typeahead.bundle.min.js") !!}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script> --}}


    <!-- autocomplete Initialization -->
    <script>
        $(document).ready(function(){
            $('input.autocomplete').autocomplete({
                data: {
                  "Apple": null,
                  "Microsoft": null,
                  "dfhfd": null,
                  "truetert sfs": null,
                  "Google": 'https://placehold.it/250x250'
                },
                limit: 20, // The max amount of results that can be shown at once. Default: Infinity.
                onAutocomplete: function(val) {
                  // Callback function when value is autcompleted.
                },
                minLength: 1, // The minimum length of the input for the autocomplete to start. Default: 1.
            }); 
        });
    </script>

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