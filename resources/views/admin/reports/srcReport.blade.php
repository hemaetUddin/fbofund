
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
	    Step Referral Comission Reports
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
	    <th>From User</th>
	    <th>Amount</th>
	    <th>Date</th>
	</tr>
	</thead>
	<tbody>
	
	{{--*/ $i=1 /* --}}  <!-- don't delete it -->
		
	@foreach( $srcReports as $srcReport)
		<tr>
			
		    <td>{{ $i++ }}</td>
		    <td>{{ FindUserName::userName($srcReport->user_id) }}</td>
		    <td>{{ FindUserName::userName($srcReport->related_id) }}</td>
		    <td>{{ $srcReport->amount }}</td>
		    <td>
		    	{{ date('Y-m-d', strtotime($srcReport->date)) }}
		    </td>    
		</tr>
	
	
	@endforeach
	</tbody>
    <tfoot>
        <tr>
            <th colspan="3">Direct Referral Comission Total</th>
            <th>USD{{ number_format($total, 2) }}</th>
            <th>--</th>
            
        </tr>
    </tfoot>

	</table>
	</div>
	</div>
	</section>
	</div>

	
	</div>
@endsection


@section('script')
	
	{!! Html::script('js/advanced-datatable/js/jquery.dataTables.js') !!}
	{!! Html::script('js/data-tables/DT_bootstrap.js') !!}
	{!! Html::script('js/dynamic_table_init.js') !!}

@endsection