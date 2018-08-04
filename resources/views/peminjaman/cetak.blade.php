 <!-- Bootstrap Core CSS -->
    <link href="theme/css/bootstrap.min.css" rel="stylesheet">
    {!! Html::style("assets/bootstrap/css/bootstrap.min.css") !!}
    <!-- Custom CSS -->

 {{-- <div class="panel panel-primary "> --}}
        <div align="center">
            <img src="{{asset('gambar/kop.png') }}">
        </div>
       
            <div class="panel-body">
                Tanggal : {{$tgl11}} s/d {{$tgl22}}<br>
                {{-- <h2>Data Buku</h2> --}}
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped" width="80">
                            <thead>
                                <tr bgcolor="c9e1f5"> 
                                    <th width="20">No.</th>                                       
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Tgl Pinjam</th>
                                    <th>Tgl Kembali</th>
                                    <th>Waktu</th>                                   
                                    <th>Jumlah</th>
                                    <th>Denda</th>                                     
                                    </tr>
                            </thead>
                            <tbody> 
                                <?php 
                                $no = 1; 
                                $dendaTotal = 0;
                                $denda=0;
                                ?>   
                                @foreach ($peminjaman_list as $peminjaman)
                                  
                                <tr>      
                                    <td> {{ $no }}</td>                                    
                                    <td>{{ $peminjaman->kode }}</td>
                                    <td>{{ $peminjaman->anggota->nama_anggota }}</td>
                                    <td>{{ $peminjaman->tgl_pinjam->format('d-m-Y') }}</td>
                                    <td>{{ $peminjaman->tgl_kembali->format('d-m-Y') }}</td>
                                    <td>
                                <?php 
                                    $tgl        = strtotime($peminjaman->tgl_kembali) ;
                                    $tgl_skrng  = strtotime(date("d-m-Y"));
                                    $durasi      = ($tgl - $tgl_skrng) / 86400 ;
                                ?>

                                @if ($durasi < 0 )
                                    Durasi Habis / {{ $durasi }} Hari
                                @else
                                    {{ $durasi }} Hari
                                 @endif
                                </td>
                                <td>
                                    {{ $peminjaman->total }}
                                </td>
                                <td>  
                                    <?php $total_buku = $peminjaman->total; ?>                                   
                                    @if($durasi<0)
                                        <?php 
                                            $denda  = abs($durasi)*500*$total_buku;
                                        ?>
                                       
                                        {{$denda}}
                                     
                                    @else
                                        0
                                    @endif

                                </td>

                                <?php 
                                    $no++;
                                    $dendaTotal += $denda;
                                ?>

                            </tr>

                        @endforeach

                                <tr>      
                                    <td></td>                                    
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>Total</td>
                                    <td> {{$dendaTotal}} </td>
                                </tr>
                                
                                        
                                </tbody>
                                                                      
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

<br>

<table align="right">
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