@if(Session::has('flash_message_hapus'))
	<div class="alert alert-danger {{ Session::has('penting')? 'alert-important' : '' }}">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{Session::get('flash_message_hapus')}}
    </div>
@endif