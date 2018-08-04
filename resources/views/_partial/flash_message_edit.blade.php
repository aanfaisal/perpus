@if(Session::has('flash_message_edit'))
	<div class="alert alert-info {{ Session::has('penting')? 'alert-important' : '' }}">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{Session::get('flash_message_edit')}}
    </div>
@endif