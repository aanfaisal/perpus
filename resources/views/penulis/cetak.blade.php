 <!-- Bootstrap Core CSS -->
    {!! Html::style("assets/bootstrap/css/bootstrap.min.css") !!}
    <!-- Custom CSS -->

 {{-- <div class="panel panel-primary "> --}}
        <div align="center">
            <img src="{{asset('gambar/kop.png') }}">
        </div>
        <div align="center">
            <h3>DATA PENULIS</h3>
        </div>
       
            <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped" width="100%">
                            <thead>
                                <tr bgcolor="c9e1f5"> 
                                    <th>No.</th>                                       
                                    <th>Nama</th>
                                    <th>Telepon</th>                                   
                                    <th>Alamat</th>                                     
                                </tr>
                            </thead>
                            <tbody> 
                                <?php $no = 1; ?>   
                                @foreach ($penulis_list as $penulis)
                                  
                                <tr>      
                                    <td> {{ $no }}</td>                                    
                                    <td>{{ $penulis->nm_penulis }}</td>
                                    <td>{{ $penulis->tlpn}}</td>                         
                                    <td>{{ $penulis->alamat}}</td>                          
        
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