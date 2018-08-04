 <!-- Bootstrap Core CSS -->
    {!! Html::style("assets/bootstrap/css/bootstrap.min.css") !!}
    <!-- Custom CSS -->

 {{-- <div class="panel panel-primary "> --}}
        <div align="center">
            <img src="{{asset('gambar/kop.png') }}">
        </div>
        <div align="center">
            <h3>DATA KLASIFIKASI</h3>
        </div>
       
            <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped" width="100%">
                            <thead>
                                <tr bgcolor="c9e1f5"> 
                                    <th>No.</th>                                       
                                    <th>Kelas</th>
                                    <th>Keterangan</th>                                           
                                </tr>
                            </thead>
                            <tbody> 
                                <?php $no = 1; ?>   
                                @foreach ($klasifikasi_list as $klasifikasi)
                                  
                                <tr>      
                                    <td> {{ $no }}</td>                                    
                                    <td>{{ $klasifikasi->kelas }}</td>
                                    <td>{{ $klasifikasi->ket }}</td>
                                    
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