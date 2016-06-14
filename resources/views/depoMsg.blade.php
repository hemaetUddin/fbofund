{{-- <div class="row"> --}}
	{{-- <div class="col-md-8 col-md-offset-2"> --}}
		@if(session('depoMessage'))
			<div class="alert alert-danger fade in">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				{{ Session::get('depoMessage') }}
			</div>
		@endif
	{{-- </div> --}}
{{-- </div> --}}