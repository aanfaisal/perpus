{{-- <div class="panel panel-primary "> --}}
     <style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg .tg-x13o{font-weight:bold;font-size:24px;font-family:Arial, Helvetica, sans-serif !important;;text-align:center;vertical-align:top}
.tg .tg-9hbo{font-weight:bold;vertical-align:top}
.tg .tg-yw4l{vertical-align:top}
</style>
  <div align="center">
  <img src="{{asset('gambar/kop.png')}}" width="566">  
  </div>
<!DOCTYPE html>
<html>
<head>
</head>
<body onload="window.print();">
<table align="center" class="tg" style="undefined;table-layout: fixed; width: 566px">
<colgroup>
<col style="width: 35px">
<col style="width: 107px">
<col style="width: 66px">
<col style="width: 47px"> 
<col style="width: 245px">
<col style="width: 66px">
</colgroup>
  <tr>
     <th class="tg-x13o" colspan="6" rowspan="3">DATA REKAP LAPORAN</th>
    

  <tr>
  </tr>
  <tr>
  </tr>
  <tr>
    <td class="tg-9hbo">NO</td>
    <td class="tg-9hbo">URAIAN DATA</td>
    <td class="tg-9hbo">Total</td>
    <td class="tg-9hbo">SAT</td>
    <td class="tg-9hbo">TRANSAKSI</td>
    <td class="tg-9hbo">Jumlah</td>
  </tr>
  <tr>
    <td class="tg-9hbo">1.</td>
    <td class="tg-yw4l">BUKU</td>
    <td class="tg-yw4l">{{$buku_total}}</td>
    <td class="tg-yw4l">buah</td>
    <td class="tg-yw4l">stok</td>
    <td class="tg-yw4l">{{$buku_stok}}</td>
  </tr>
  <tr>
    <td class="tg-9hbo"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l">dipinjam</td>
    <td class="tg-yw4l">{{$buku_pinjam}}</td>
  </tr>
  <tr>
    <td class="tg-9hbo"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-9hbo">Total</td>
    <td class="tg-9hbo">{{$buku_total}}</td>
  </tr>
  <tr>
    <td class="tg-9hbo">2.</td>
    <td class="tg-yw4l">SISWA</td>
    <td class="tg-yw4l">{{$anggota_total}}</td>
    <td class="tg-yw4l">siswa</td>
    <td class="tg-yw4l">laki-laki</td>
    <td class="tg-9hbo">{{$anggota_jkl}}</td>
  </tr>
  <tr>
    <td class="tg-9hbo"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l">perempuan</td>
    <td class="tg-9hbo">{{$anggota_jkp}}</td>
  </tr>
  <tr>
    <td class="tg-9hbo"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-9hbo">Total</td>
    <td class="tg-9hbo">{{$anggota_total}}</td>
  </tr>
  <tr>
    <td class="tg-9hbo"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
  </tr>
  <tr>
    <td class="tg-9hbo">3.</td>
    <td class="tg-yw4l">PEMINJAMAN</td>
    <td class="tg-yw4l">{{$peminjaman_jumlah}}</td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l">jumlah</td>
    <td class="tg-9hbo">{{$peminjaman_jumlah}}</td>
  </tr>

</table><br>

<table align="center">
  <tr>
    <th>Semarang, <?php echo date('d F Y'); ?></th>
  </tr>
  <tr>
    <td>Dibuat Oleh<br></td>
  </tr>
  <tr>
    <td>Penjaga Perpustakaan<br><br><br></td>
  </tr>
  <tr>
    <td></td>
  </tr>
  <tr>
    <td></td>
  </tr>
  <tr>
    <td>...................................</td>
  </tr>
  <tr>
    <td>Pustakawan</td>
  </tr>
</table>
</body>
</html>