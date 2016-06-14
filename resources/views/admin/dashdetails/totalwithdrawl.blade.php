@extends('layouts.adminMaster')

@section('style')
	{!! Html::style('js/data-tables/DT_bootstrap.css') !!}
@endsection

@section('body-content')
	<div class="row">
	<div class="col-sm-12">
	<div class="withdrawl-alert">
		
		    @include('errMsg')
		
	</div>
	@include('formErr')
	<section class="panel">
	<header class="panel-heading">
	    Today's Withdrawl Requests
	    <span class="tools pull-right">
	        <a href="javascript:;" class="fa fa-chevron-down"></a>
	        <a href="javascript:;" class="fa fa-times"></a>
	     </span>
	</header>
	<div class="panel-body">
	<div class="adv-table">
	<table  class="display table table-bordered table-striped" id="dynamic-table">
	<thead>
	<tr>
	    <th>SL No.</th>
	    <th>User Name</th>
	    <th>Withdrawl Amount</th>
	    <th>Payment Method</th>
	    <th>Payment Account</th>
	    <th>Request Date</th>
	</tr>
	</thead>
	<tbody>
	
	{{--*/ $i=1 /* --}}  <!-- don't delete it -->
		
	@foreach( $totalWithdRequests as $totalWithdRequest)
		<tr>
	    <td>{{ $i++ }}</td>
	    <td>{{ FindUserName::userName($totalWithdRequest->user_id) }}</td>
	    <td>{{ $totalWithdRequest->amount }}</td>
	    <td>{{ 'Perfect Money' }}</td>
	    <td>{{ $totalWithdRequest->withdraw_to }}</td>
	    <td>
	    	{{ date('Y-m-d', strtotime($totalWithdRequest->request_date)) }}
	    </td>
	</tr>
	
	
	@endforeach

	</table>
	</div>
	</div>
	</section>
	</div>

	<!-- <div class="col-md-3">
		<p class="default"><a href="#">Side Bar</a></p>
	</div> -->
	
	</div>
@endsection


@section('script')
	
	{!! Html::script('js/advanced-datatable/js/jquery.dataTables.js') !!}
	{!! Html::script('js/data-tables/DT_bootstrap.js') !!}
	{!! Html::script('js/dynamic_table_init.js') !!}

@endsection