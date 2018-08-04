<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Pembayaran Denda</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  {!! Html::style("assets/bootstrap/css/bootstrap.min.css") !!}
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  {!! Html::style("assets/dist/css/AdminLTE.min.css") !!}

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body onload="window.print();">
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
    <div class="col-xs-12">
      <h2 class="page-header">
      <i class="fa fa-globe"></i> SMK PALAPA SEMARANG
      <small class="pull-right">Tanggal Cetak : {{date("d-m-Y")}}</small>
      </h2>
    </div>
    <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info"> 
    <div class="col-sm-4 invoice-col">         
      <address>
      <table border="0">
      <tr>
        <thead>
        <tr>
          <td><strong>Peminjam </strong> </td>
          <td></td>
        </tr>
        <tr>
          <td> <strong>{{ $data2->nama_anggota}}</strong><br></td>
        </tr>
        <tr>
          <td>Tanggal Pinjam </td>
          <td>:</td>
          <td>{{ $data2->tgl_pinjam}}<br></td>
        </tr>
        <tr>
          <td>Tanggal Kembali <br></td>
          <td>:</td>
          <td>{{ $data2->tgl_kembali }}</td>
        </tr>
        <tr>
          <td>Durasi</td>
          <td>:</td>
          <td>
            <?php 
              $tgl        = strtotime($data2->tgl_kembali) ;
              $tgl_skrng  = strtotime(date("Y-m-d"));
              $durasi      = ($tgl - $tgl_skrng) / 86400 ;
            ?>
            @if ($durasi < 0 )
              ( Durasi Habis / {{ $durasi }} Hari )
            @else
              ( {{ $durasi }} Hari )
            @endif
          <br>
          </td>
        </tr>
        <tr>
          <td>Telepon/HP</td>
          <td>:</td>
          <td> {{$data2->telepon}}</td>
        </tr>
        </thead>
      </tr>
      </table>
      
      </address>
    </div>
    <!-- /.col -->
    <div class="col-sm-2 invoice-col">
    </div>
    <!-- /.col -->
    <div class="col-sm-5 invoice-col">
      <table>
      <tr bgcolor=#46f0d1>
        <th>
          <h1><b>Kode #{{ $data2->kode }}<br>

            @foreach($data3 as $row)
               {{-- {{$row->total}} --}}
            @endforeach
            <?php 
              // $total_buku  
              $total_buku = $row->total;
            ?>                                      
              @if($durasi<0)
                <?php $denda = abs($durasi)*500*$total_buku; ?>
                   Denda: RP. {{$denda}},00
               @else
                 Denda: RP. 0,00
              @endif 
            </b>
          </h1>
            <br>
          <br>
        </th>
      </tr>
      </table>
    <br>
    </div>
    <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
    <div class="col-xs-12 table-responsive">
      <table class="table table-striped" id="table">
      <thead>
      <tr bgcolor="#d0d96a">
        <th>No.</th>
        <th>Judul</th>
        <th>Penulis</th>
        <th>Penerbit</th>
        <th>Tahun</th>
      </tr>
      </thead>
      <tbody>  
      <?php $no = 1 ?>                                
        @foreach ($data1 as $buku)
                  
      <tr>  
        <td>{{ $no }}</td>                                      
        <td>{{ $buku->judul }}</td>
        <td>{{ $buku->nm_penulis }}</td>
        <td>{{ $buku->nm_penerbit }}</td>
        <td>{{ $buku->tahun }}</td>                                      
        <td>  

          @if(  $total_buku > 1)

            {!! Form::open(array('url' => 'peminjaman/'.$buku->id_peminjaman.'/buku/'.$buku->id_buku.'/hapus','method'=>'GET', 'class' => 'horizontal-form', 'role' => 'form')) !!}

            <input type="hidden" name="id_peminjaman" value="{{ $buku->id_peminjaman }}">
            <input type="hidden" name="id_buku" value="{{ $buku->id_buku }}">
            <input type="hidden" name="stok" value="{{ $buku->stok }}">
            <input type="hidden" name="buku" value="{{ $buku->judul }}">

            {{-- <button type="submit" class="btn btn-xs btn-danger glyphicon glyphicon-remove" onclick = "return ConfirmDelete()" > Hapus </button> --}}

            {{-- {{ link_to('peminjaman/'.$buku->id_peminjaman.'/buku/'.$buku->id_buku.'/hapus',' Hapus',['class'=>'btn btn-xs btn-danger glyphicon glyphicon-remove']) }} --}}

            {!! Form::close() !!}

          @endif
        
                 
        </td>
      </tr>  
      <?php $no++ ?>                                  
        @endforeach 
                              
    </tbody>             
      </table>
    </div>
    <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
    <!-- accepted payments column -->
    <div class="col-xs-6">
      <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
      PERINGATAN !!! Keterlambatan pengembalian buku akan dikenakan denda sebesar                           "RP. 500,00 ( LIMA RATUS RUPIAH)" per buku tiap harinya.
      </p>
    </div>
    <!-- /.col -->
    
    </div>
    <!-- /.row -->

</div>
<!-- ./wrapper -->
</body>
</html>
