{{-- <div class="row">
	<div class="col-md-8 col-md-offset-2">
 --}}		@if(session('message'))
			<div class="alert alert-danger fade in">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				{{ Session::get('message') }}
			</div>
		@endif
		@if(session('smessage'))
			<div class="alert alert-success fade in">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				{{ Session::get('smessage') }}
			</div>
		@endif
{{-- 	</div>
</div> --}}