@extends('layouts.adminMaster')


@section('style')
	{!! Html::style('css/custom.css') !!}
@endsection

@section('page-heading')
@endsection

@section('body-content')
	@include('depoMsg')
	@include('errMsg')
	@include('user.reports.tables.earningTable')
	<div class="col-md-4">
		@include('partials.right-sidebar')
	</div>
@endsection

@section('script')

	<!--dynamic table-->
{!! Html::script('js/advanced-datatable/js/jquery.dataTables.js') !!}
{!! Html::script('js/data-tables/DT_bootstrap.js') !!}
<!--dynamic table initialization -->
{!! Html::script('js/dynamic_table_init.js') !!}

@endsection 

