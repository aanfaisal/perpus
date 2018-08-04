 <!-- Bootstrap Core CSS -->
    {!! Html::style("assets/bootstrap/css/bootstrap.min.css") !!}
    <!-- Custom CSS -->

 {{-- <div class="panel panel-primary "> --}}
        <div align="center">
            <img src="{{asset('gambar/kop.png') }}">
        </div>
        <div align="center">
            <h3>DATA ANGGOTA</h3>
        </div>
       
            <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped" width="80">
                            <thead>
                                <tr bgcolor="#e6e6e6"> 
                                    <th width="20">No.</th>                                       
                                    <th>NIS</th>
                                    <th>Nama</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Telepon</th>                                   
                                    <th>Alamat</th>                                     
                                </tr>
                            </thead>
                            <tbody> 
                                <?php $no = 1; ?>   
                                @foreach ($anggota_list as $anggota)
                                  
                                <tr>      
                                    <td> {{ $no }}</td>                                    
                                    <td>{{ $anggota->nis }}</td>
                                    <td>{{ $anggota->nama_anggota }}</td>
                                    <td>{{ $anggota->tgl_lahir }}</td>
                                    <td>{{ $anggota->jenis_kelamin }}</td>
                                    <td>{{ $anggota->telepon}}</td>                         
                                    <td>{{ $anggota->alamat}}</td>                          
        
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

<style>
.page-break {
    page-break-after: always;
}
</style>
       
