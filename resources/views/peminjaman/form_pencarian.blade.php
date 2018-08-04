<div id="pencarian">
	{!! Form::open(['url' => 'peminjaman/cari','role'=>'form'])  !!}
	<div class="row">	
	 	<div class="col-md-10">
			<div class="form-group input-group">
                <input type="hidden" class="form-control" name="nama" placeholder="cari.." >
                <span class="hidden input-group-btn"><button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button></span>
            </div> 
      	</div> 
      	<div class="col-md-2">
			<div class="form-group input-group">
                <input type="text" class="form-control" name="kata_kunci" placeholder="cari.." >
                <span class="input-group-btn"><button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button></span>
            </div> 
      	</div>                             
	{!! Form::close() !!}

	</div>
</div>
