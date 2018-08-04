 <!-- Bootstrap Core CSS -->
    {!! Html::style("assets/bootstrap/css/bootstrap.min.css") !!}
    <!-- Custom CSS -->

 {{-- <div class="panel panel-primary "> --}}
        <div align="center">
            <img src="{{asset('gambar/kop.png') }}">
        </div>
        <div align="center">
            <h3>DATA KEUANGAN PERPUSTAKAAN</h3>
        </div>
       
            <div class="panel-body">
                {{-- <h2>Data Buku</h2> --}} 
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped" width="100%">
                            <thead>
                                <tr bgcolor="#e6e6e6"> 
                                    <th width="20">No.</th>                                       
                                    <th>Kode Pinjam</th>
                                    <th>Nama Anggota</th>
                                    <th>Judul Buku</th>
                                    <th>Tanggal</th>
                                    <th>Denda</th>                                     
                                    </tr>
                            </thead>
                            <tbody> 
                                <?php
                                 $no = 1; 
                                 $dendaTotal = 0;
                                 ?>   
                                @foreach ($keuangan_list as $keuangan)
                                  
                                <tr>      
                                    <td> {{ $no }}</td>                                    
                                    <td>{{ $keuangan->id_pinjam }}</td>
                                    <td>{{ $keuangan->anggota->nama_anggota }}</td>
                                    <td>{{ $keuangan->buku->judul }}</td>
                                    <td>{{ $keuangan->created_at }}</td>
                                    <td>{{ $keuangan->denda }}</td>                        
        
                                <?php 
                                $no++ ;
                                $denda = $keuangan->denda;
                                $dendaTotal += $denda;
                                ?>

                                @endforeach

                                 <tr>      
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