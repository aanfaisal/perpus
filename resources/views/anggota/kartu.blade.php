<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sistem Informasi Perpustakaan SMK Palapa</title>
  <!-- CSRF Token -->
  <meta name="_token" content="{{ csrf_token() }}">
  <!-- Bootstrap 3.3.6 -->
  {!! Html::style("assets/bootstrap/css/bootstrap.min.css") !!}
  {!! Html::style("assets/dist/css/AdminLTE.min.css") !!} 
</head>
<body onload="window.print();">

@foreach($anggota_list as $anggota)
<br><br><br>
<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
.tg .tg-yw4l{vertical-align:top}
.tg .tg-dx8v{font-size:10px;vertical-align:top}
.tg .tg-pfz8{font-size:10px;border-color:inherit;vertical-align:top}
</style>

<table align="left" class="tg">
  <tr>
    <th class="tg-yw4l" colspan="2">PERATURAN:<br></th>
  </tr>
  <tr>
    <td class="tg-dx8v"><br>1.<br>2.<br>3.<br>4.<br>5.</td>
    <td class="tg-pfz8"><br>Kartu ini tidak boleh digunakan orang lain<br>Kartu ini harap dibawa saat meminjam buku<br>Tunjukkan ke petugas setiap kali melakukan peminjaman buku<br>Lama peminjaman buku 7 hari <br>Keterlambatan dikenakan denda Rp.500,00 perbuku<br>  </td>
  </tr>
</table>

        <div class="col-xs-6">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-aqua-active">
              <h3 class="widget-user-username">{{$anggota->nama_anggota}}</h3>
              <h5 class="widget-user-desc">{{$anggota->nis}}</h5>
            </div>
            <div class="widget-user-image">
              @if(isset($anggota->foto1))
                <img class="img-circle zoom" src="{{asset('fotoanggota/'.$anggota->foto1)}}">
              @else
                <img class="img-circle zoom"  src="{{asset('fotoanggota/dummymale.jpg')}}">
              @endif
            </div>
            <div class="box-footer">
              <div class="row">
                <div class="col-xs-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header">{{$anggota->jenis_kelamin}}</h5>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-xs-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header">ANGGOTA</h5>
                    <span class="description-text">Perpus</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                  <div class="description-block">
                    <h5 class="description-header">SMK</h5>
                    <span class="description-text">PALAPA SMG</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
          </div>
          <!-- /.widget-user -->

</div>

@endforeach

</body>
</html>
