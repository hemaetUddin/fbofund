@extends('layouts.adminMaster')

@section('style')
	{!! Html::style('css/custom.css') !!}
@endsection

@section('page-heading')
@endsection

@section('body-content')
		@include('depoMsg')
		
		{{-- <div class="col-md-7"> --}}
			@include('user.reports.tables.depositTable')
		{{-- </div> --}}

		<div class="col-md-4 col-md-offset-1">
			@include('partials.right-sidebar')
		</div>
@endsection

@section('script')
@endsection





