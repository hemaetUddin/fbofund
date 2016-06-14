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
	    Today's Registerd Users
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
	    <th>Full Name</th>
	    <th>User Name</th>
	    <th>Phone Number</th>
	    <th>Email</th>
	    <th>Referrar ID</th>
	    <th>Upline ID</th>
	    <th>Date</th>
	</tr>
	</thead>
	<tbody>
	
	{{--*/ $i=1 /* --}}  <!-- don't delete it -->
		
	@foreach( $totalRegUsers as $totalUser)
		<tr>
	    <td>{{ $i++ }}</td>
	    <td>{{ $totalUser->full_name }}</td>
	    <td>{{ $totalUser->username }}</td>
	    <td>{{ $totalUser->phone_number }}</td>
	    <td>{{ $totalUser->email }}</td>
	    <td>{{ FindUserName::userName($totalUser->referrar_id) }}</td>
	    <td>{{ FindUserName::userName($totalUser->upline_id) }}</td>
	    <td>
	    	{{ date('Y-m-d', strtotime($totalUser->signup_date)) }}
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