 <!-- Bootstrap Core CSS -->
    {!! Html::style("assets/bootstrap/css/bootstrap.min.css") !!}
    <!-- Custom CSS -->

 {{-- <div class="panel panel-primary "> --}}
        <div align="center">
            <img src="{{asset('gambar/kop.png') }}">
        </div>
       
            <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped" width="80">
                            <thead>
                               <tr bgcolor="#e6e6e6"> 
                                    <th width="20">No.</th>                                       
                                    <th>Tahun</th>
                                  
                                </tr>
                            </thead>
                            <tbody> 
                                <?php $no = 1; ?>   
                                @foreach ($tahun_terbit_list as $tahun_terbit)
                                  
                                <tr>      
                                    <td> {{ $no }}</td>                                    
                                    <td>{{ $tahun_terbit->tahun }}</td>                        
        
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