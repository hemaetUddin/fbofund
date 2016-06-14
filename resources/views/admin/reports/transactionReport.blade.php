
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
	    Transaction Reports
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
	    <th>Transacted Amount</th>
	    <th>Sign</th>
	    <th>Purpose</th>
	    <th>Form/To</th>
	    <th>Request Date</th>
	</tr>
	</thead>
	<tbody>
	
	{{--*/ $i=1 /* --}}  <!-- don't delete it -->
		
	@foreach( $transactionReports as $transactionReport)
		<tr>
	    <td>{{ $i++ }}</td>
	    <td>{{ FindUserName::userName($transactionReport->user_id) }}</td>
	    <td>{{ $transactionReport->amount }}</td>
	    <td>{{ $transactionReport->sign }}</td>
	    <td>{{ AppHelper::transactionType($transactionReport->purpose) }}</td>
	    <td>
	    	@if($transactionReport->related_id !=0)
	    		{{FindUserName::userName($transactionReport->related_id)}}
	    	@else 
	    		{{ '-- '}}
	    	@endif
	    </td>
	    <td>
	    	{{ date('Y-m-d', strtotime($transactionReport->date)) }}
	    </td>
	</tr>
	
	
	@endforeach
	</tbody>
	<tfoot>
        <tr>
            <th colspan="2">Total Transacted Amount</th>
            <th>USD{{ $total }}</th>
            <th>--</th>
            <th>--</th>
            <th>--</th>
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