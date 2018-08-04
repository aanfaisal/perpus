@section('main')
<div class="caption text-center">
    <h3> < Detail Buku ></h3>
    <table class="centered responsive-table">
        <tr>
            <th class="col-xs-1"></th>
            <td>
                <div class="col-xs-11">
                    <div class="thumb thumb-rounded">
                        @if(isset($buku->cover))
                            <img src="{{asset('coverbuku/'.$buku->cover)}}">
                        @else
                            <img src="{{asset('coverbuku/placeholder.jpg')}}" >
                        @endif

                    </div>
                </div>
            </td>
        </tr> 
    </table>
       
</div>
    <table class="responsive-table">
        <tr>
            <th class="col-xs-2">Judul Buku </th>
                <td>: {{ $buku-> judul}}</td>
            </tr> 
            <tr>
                <th class="col-xs-3">Penulis</th>
                <td>: {{ $buku->penulis->nm_penulis}}</td>
            </tr>                                  
            <tr>
                <th class="col-xs-3">Penerbit</th>
                    <td>: {{ $buku->penerbit->nm_penerbit}}</td>
            </tr>
            <tr>
                <th class="col-xs-3">Tahun Terbit</th>
                    <td>: {{ $buku->tahun_terbit->tahun }}</td>
            </tr>
            <tr>
                <th class="col-xs-3">Klasifikasi</th>
                    <td>: {{ $buku->klasifikasi->kelas }} ( {{ $buku->klasifikasi->ket }} )</td>
            </tr>
            <tr>
                <th class="col-xs-3">Jumlah</th>
                    <td>: {{ $buku->jumlah }}</td>
            </tr>
            <tr>
                <th class="col-xs-3">Stok</th>
                    <td>: {{ $buku->stok }}</td>
            </tr>
            <tr>
                <th class="col-xs-3">Deskripsi</th>
                    <td>: {{ $buku->deskripsi}}  </td>
            </tr>
                            
    </table>
</div>
                        
@stop
