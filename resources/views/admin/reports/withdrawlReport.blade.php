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
	    
	    <button class="btn btn-success btn-md accepted" id="accepted">Accepted</button> 
	    <button class="btn btn-info btn-md pending" id="pending">Pending</button> 
	    <button class="btn btn-danger btn-md canceled" id="canceled">Canceled</button>
		 <span class="tab-title">Accepted Withdrawl Reports</span>

	    <span class="tools pull-right">
	        <a href="javascript:;" class="fa fa-chevron-down"></a>
	        <a href="javascript:;" class="fa fa-times"></a>
	     </span>
	</header>
	<div class="panel-body">
		
		<div class="table-accept">
			<div class="adv-table">
			    <table  class="display table table-bordered table-striped" id="dynamic-table">
			    <thead>
			    <tr>
			        <th>SL No.</th>
			        <th>User Name</th>
			        <th>Amount</th>
			        <th>Amount Type</th>
			        <th>Payment Account</th>
			        <th>Date</th>
			        <th>Status</th>
			    </tr>
			    </thead>
			    <tbody>
			    
			    {{--*/ $i=1 /* --}}  <!-- don't delete it -->
			        
			    @foreach( $withdrawlReports as $withdrawlReport)
				    @if($withdrawlReport->status == 1)
				    	<tr>
				    	    <td>{{ $i++ }}</td>
				    	    <td>{{ FindUserName::userName($withdrawlReport->user_id) }}</td>
				    	    <td>{{ $withdrawlReport->amount }}</td>
				    	    <td>
				    	    	@if($withdrawlReport->amount_type==1)
				    	    		{{ 'Wallet Balance'}}
				    	    	@else
				    	    		{{ 'ROI Balance'}}
				    	    	@endif

				    	    </td>
				    	    <td>{{ $withdrawlReport->withdraw_to }}</td>
				    	    <td>
				    	        {{ date('Y-m-d', strtotime($withdrawlReport->request_date)) }}
				    	    </td>
				    	    
	    	        	    <td>
	    	    				@if($withdrawlReport->status == 0)
	    	    					{{ 'Pending'}}
	    	    				@elseif($withdrawlReport->status == 1)
	    	    					{{ 'Accepted'}}
	    	    				@else
	    	    					{{ 'Canceled'}}
	    	    				@endif

	    	        	    </td>
				    	</tr>
				    @endif
			    @endforeach
			    <tfoot>
			        <tr>
			            <th colspan="2">Total Accepted Amount</th>
			            <th>USD{{ number_format($total[0], 2) }}</th>
			            <th>--</th>
			            <th>--</th>
			            <th>--</th>
			            <th>--</th>
			        </tr>
		        </tfoot>

			    </table>
			    </div>
		</div> 

		<div class="table-pending">
			<div class="adv-table">
			    <table  class="display table table-bordered table-striped" id="pending-table">
			    <thead>
			    <tr>
			        <th>SL No.</th>
			        <th>User Name</th>
			        <th>Amount</th>
			        <th>Amount Type</th>
			        <th>Payment Account</th>
			        <th>Date</th>
			        <th>Status</th>
			    </tr>
			    </thead>
			    <tbody>
			    
			    {{--*/ $i=1 /* --}}  <!-- don't delete it -->
			        
			    @foreach( $withdrawlReports as $withdrawlReport)
				    @if($withdrawlReport->status == 0)
				    	<tr>
				    	    <td>{{ $i++ }}</td>
				    	    <td>{{ FindUserName::userName($withdrawlReport->user_id) }}</td>
				    	    <td>{{ $withdrawlReport->amount }}</td>
				    	    <td>
				    	    	@if($withdrawlReport->amount_type==1)
				    	    		{{ 'Wallet Balance'}}
				    	    	@else
				    	    		{{ 'ROI Balance'}}
				    	    	@endif

				    	    </td>
				    	    <td>{{ $withdrawlReport->withdraw_to }}</td>
				    	    <td>
				    	        {{ date('Y-m-d', strtotime($withdrawlReport->request_date)) }}
				    	    </td>
				    	    <td>
								@if($withdrawlReport->status == 0)
									{{ 'Pending'}}
								@elseif($withdrawlReport->status == 1)
									{{ 'Accepted'}}
								@else
									{{ 'Canceled'}}
								@endif

				    	    </td>
				    	</tr>
				    @endif
			    @endforeach
			    <tfoot>
			        <tr>
			            <th colspan="2">Total Pending Amount</th>
			            <th>USD{{ number_format($total[1], 2) }}</th>
			            <th>--</th>
			            <th>--</th>
			            <th>--</th>
			            <th>--</th>
			        </tr>
		        </tfoot>
			    </table>
			    </div>
		</div>

		<div class="table-cancel">
			<div class="adv-table">
			    <table  class="display table table-bordered table-striped" id="cancel-table">
			    <thead>
			    <tr>
			        <th>SL No.</th>
			        <th>User Name</th>
			        <th>Amount</th>
			        <th>Amount Type</th>
			        <th>Payment Account</th>
			        <th>Date</th>
			        <th>Status</th>
			    </tr>
			    </thead>
			    <tbody>
			    
			    {{--*/ $i=1 /* --}}  <!-- don't delete it -->
			        
			    @foreach( $withdrawlReports as $withdrawlReport)
				    @if($withdrawlReport->status == 2)
				    	<tr>
				    	    <td>{{ $i++ }}</td>
				    	    <td>{{ FindUserName::userName($withdrawlReport->user_id) }}</td>
				    	    <td>{{ $withdrawlReport->amount }}</td>
				    	    <td>
				    	    	@if($withdrawlReport->amount_type==1)
				    	    		{{ 'Wallet Balance'}}
				    	    	@else
				    	    		{{ 'ROI Balance'}}
				    	    	@endif

				    	    </td>
				    	    <td>{{ $withdrawlReport->withdraw_to }}</td>
				    	    <td>
				    	        {{ date('Y-m-d', strtotime($withdrawlReport->request_date)) }}
				    	    </td>
				    	    <td>
								@if($withdrawlReport->status == 0)
									{{ 'Pending'}}
								@elseif($withdrawlReport->status == 1)
									{{ 'Accepted'}}
								@else
									{{ 'Canceled'}}
								@endif

				    	    </td>
				    	</tr>
				    @endif
			    @endforeach
			    <tfoot>
			        <tr>
			            <th colspan="2">Total Canceled Amount</th>
			            <th>USD{{ number_format($total[2], 2) }}</th>
			            <th>--</th>
			            <th>--</th>
			            <th>--</th>
			            <th>--</th>
			        </tr>
		        </tfoot>
			    </table>
			    </div>
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
	{!! Html::script('js/custom/pending_table_init.js') !!}
	{!! Html::script('js/custom/cancel_table_init.js') !!}

	

	<script type="text/javascript">
	$(document).ready(function(){

		
		$('.table-pending').hide();
		$('.table-cancel').hide();
		if($('#accepted').click(function(){

			$('.tab-title').html('Accepted Withdrawl Reports')
			$('.table-accept').show();
			$('.table-pending').hide();
			$('.table-cancel').hide();

		}));

		if($('#pending').click(function(){

			$('.tab-title').html('Pending Withdrawl Reports')
			$('.table-accept').hide();
			$('.table-pending').show();
			$('.table-cancel').hide();

		}));
		if($('#canceled').click(function(){

			$('.tab-title').html('Canceled Withdrawl Reports')
			$('.table-cancel').show();
			$('.table-accept').hide();
			$('.table-pending').hide();

		}));	
	});
	</script>

@endsection