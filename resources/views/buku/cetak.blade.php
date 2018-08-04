 <!-- Bootstrap Core CSS -->
    {!! Html::style("assets/bootstrap/css/bootstrap.min.css") !!}
    <!-- Custom CSS -->

 {{-- <div class="panel panel-primary "> --}}
        <div align="center">
            <img src="{{asset('gambar/kop.png') }}">
        </div>
        <div align="center">
            <h3>DATA BUKU</h3>
        </div>
       
            <div class="panel-body">
                {{-- <h2>Data Buku</h2> --}} 
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped" width="100%">
                            <thead>
                                <tr bgcolor="#e6e6e6"> 
                                    <th width="20">No.</th>                                       
                                    <th>Judul</th>
                                    <th>Penulis</th>
                                    <th>Penerbit</th>
                                    <th>Tahun</th>
                                    <th>Jumlah</th>                                   
                                    <th>Stok</th>
                                     
                                    </tr>
                            </thead>
                            <tbody> 
                                <?php $no = 1; ?>   
                                @foreach ($buku_list as $buku)
                                  
                                <tr>      
                                    <td> {{ $no }}</td>                                    
                                    <td>{{ $buku->judul }}</td>
                                    <td>{{ $buku->nm_penulis }}</td>
                                    <td>{{ $buku->nm_penerbit }}</td>
                                    <td>{{ $buku->tahun }}</td>
                                    <td>{{ $buku->jumlah }}</td>                         
                                    <td>{{ $buku->stok }}</td>                          
        
                                <?php $no++ ?>

                                @endforeach
                                
                                        
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