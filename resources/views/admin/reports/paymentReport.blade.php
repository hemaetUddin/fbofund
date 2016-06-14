
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
	    Monthly Payment Reports
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
	    <th>Date</th>
	    <th>Record Count</th>
	    <th>DRC Amount</th>
	    <th>SRC Amount</th>
	    <th>ROI Amount</th>
	</tr>
	</thead>
	<tbody>
	
	{{--*/ $i=1 /* --}}  <!-- don't delete it -->
		
	@foreach( $monthlyPayments as $monthlyPayment)
		<tr>
			
		    <td>{{ $i++ }}</td>
		    <td>
		    	{{ date('Y-m-d', strtotime($monthlyPayment->day)) }}
		    </td>
		    <td>
		    	{{ $monthlyPayment->countPurpose }}
		    </td>
		    <td>
		    	@if( $monthlyPayment->purpose == 12)
					{{ $monthlyPayment->totalAmount }}
				@else
					{{ '0' }} 	
		    	@endif
		    </td>
		    <td>
		    	@if( $monthlyPayment->purpose == 1)
					{{ $monthlyPayment->totalAmount }}
				@else
					{{ '0' }} 	
		    	@endif
		    </td>
		    <td>
		    	@if( $monthlyPayment->purpose == 17)
					{{ $monthlyPayment->totalAmount }}
				@else
					{{ '0' }} 	
		    	@endif
		    </td>
		        
		</tr>
	
	
	@endforeach
	</tbody>
    <tfoot>
        <tr>
            <th colspan="3">Montly Payment Total</th>
            <th>USD{{ number_format($total[0], 2) }}</th>
            <th>USD{{ number_format($total[1], 2) }}</th>
            <th>USD{{ number_format($total[2], 2) }}</th>
            
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