@extends('layouts.adminMaster')

@section('style')
	<link rel="stylesheet" href="/js/data-tables/DT_bootstrap.css" />

	<style type="text/css">
	.hidden-check{
		display: none;
	}

	.dd-check{
		background: #37465B;
		color: #fff;
	}

	.accept{
		display: inline;
		float: left;

	}

	.action-btn{
		float: left;
		margin-left: 5px;
	}

	.check a{
		color:#fff;
	}

	.check a:hover{
		text-decoration: none;
		color:#fff;
	}

	.withdrawl-alert{
		position: absolute;
		width: 45%;
		top: 80px;
		left: 300px;
		z-index: 9999;

	}
	
	</style>

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
	    Withdrawal Requests
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
	    <th>User ID</th>
	    <th>Account</th>
	    <th>W.Amount</th>
	    <th>Amount Type</th>
	    <th>Req Date</th>
	    <th>Action</th>
	</tr>
	</thead>
	<tbody>
	
	{{--*/ $i=1 /* --}}  <!-- don't delete it -->
	{{--*/ $id=1 /* --}}  <!-- don't delete it -->
	{{--*/ $c=1 /* --}}  <!-- don't delete it -->	
	@foreach( $withdrawalTable as $wTable)
		<tr>
	    <td>{{ $i++ }}</td>
	    <td>{{ FindUserName::userName($wTable->user_id) }}</td>
	    <td>{{ $wTable->withdraw_to }}</td>
	    <td>{{ $wTable->amount }}</td>
	    <td> 
	    	@if( $wTable->amount_type == 1)
	    		 {{ 'Wallet Balance' }} 
	    	@else 
	    		{{ 'ROI Balance' }}	  
	    	@endif	 
	    </td>
	    <td> {{ date('Y-m-d', strtotime($wTable->request_date)) }} </td>
	    <td>
	    	<div class=" action-btn btn btn-info btn-xs check" id=""><a href="{{ url('/admin/withdrawal/check/'.$wTable->id) }}">Check</a></div>

	    	<div id= "{{$wTable->id}}" class=" action-btn btn btn-danger btn-xs cancel" data-toggle="modal" data-target="#myModal">Cancel</div>
	    	{{-- <span class="btn btn-success btn-xs">Accepet</span> --}}
	    	{{-- perfect money form --}}
	    			<form action="https://perfectmoney.is/api/step1.asp" method="POST" target="_blank">

	    			<input type="hidden" name="PAYEE_ACCOUNT" value="{{$wTable->withdraw_to }}">

	    			<input type="hidden" name="PAYEE_NAME" value="{{ FindUserName::userName($wTable->user_id) }}">

	    			<input type="hidden" name="PAYMENT_ID" value="{{$wTable->tnx_id}}"> {{-- send as transaction id for withdrawal --}}

	    			{{-- <input type="hidden" name="TNX_ID" value=""> --}}

	    			{{-- <input type="hidden" name="PAYMENT_AMOUNT" value="{{ $wTable->amount }}"> --}}
	    			<input type="hidden" name="PAYMENT_AMOUNT" value="1">

	    			<input type="hidden" name="PAYMENT_UNITS" value="USD">

	    			<input type="hidden" name="STATUS_URL" value="fbofund@gmail.com">

	    			<input type="hidden" name="PAYMENT_URL" value="http://fbofund.com/member/withdrawalpayment">

	    			<input type="hidden" name="PAYMENT_URL_METHOD" value="POST">

	    			<input type="hidden" name="NOPAYMENT_URL" value="http://fbofund.com/member/withdrawalpayment">

	    			<input type="hidden" name="NOPAYMENT_URL_METHOD" value="POST">

	    			<input type="hidden" name="SUGGESTED_MEMO" value="FBOC Member withdrawal">

	    			<input type="hidden" name="BAGGAGE_FIELDS" value="">

	    		</a>

	    			<div class="action-btn"><input type="submit" id="accept" class="btn btn-success btn-xs accept" name="PAYMENT_METHOD" value="Accept"></div>

	    			</form>	
	    	{{-- perfect money form end --}}
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

	
	




	{{-- first modal for cancel withdrawl request	 --}}	

	  <!-- Modal -->

	  <div class="modal fade" id="myModal" role="dialog">

	    <div class="modal-dialog">

	    

	      <!-- Modal content-->

	      <div class="modal-content">

	        <div class="modal-header">

	          <button type="button" class="close" data-dismiss="modal">&times;</button>

	          <h4 class="modal-title">Withdrawal Request Cancel</h4>

	        </div>

	        <div class="modal-body">

	          {!! Form::open(['url' => 'admin/withdrawal/cancel']) !!}

	          		
	          		<input type="hidden" name="id" id="wid">
	          		
				
	          		<div class="form-group">

	                	<label for="">Remarks</label>

	                	{{-- <input /> --}}
	                	<textarea required="required" name="remarks" type="text" class="form-control" id="remarks" placeholder="Remarks"></textarea>

	                </div>

	                <div class="errorMsgRe"></div>

	                <button type="submit" class="btn btn-default">Submit</button>

	          {!! Form::close() !!}

	        </div>

	        <div class="modal-footer">

	          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

	        </div>

	      </div>

	      

	    </div>

	  </div>

	  {{-- End first modal for cancel withdrawal request --}}

	  


@endsection


@section('script')

	<script type="text/javascript">

		/*$(document).ready(function(){
			
			$(".check").on('click',function () {
			    
				$("#s"+this.id).toggle();
			    
			});

			$('.cancel').click(function(){
				$('#wid').val(this.id);
			});


		});*/

	</script>

	<!--dynamic table-->
	<script type="text/javascript" language="javascript" src="/js/advanced-datatable/js/jquery.dataTables.js"></script>
	<script type="text/javascript" src="/js/data-tables/DT_bootstrap.js"></script>
	<!--dynamic table initialization -->
	<script src="/js/dynamic_table_init.js"></script>

		
	

@endsection

