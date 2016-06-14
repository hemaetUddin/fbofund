@extends('layouts.adminMaster')
	
	@section('style')
		{!! Html::style( 'css/custom.css' ) !!}
		
	@endsection

	@section('page-heading')
		@include('partials.top-heading')
	@endsection

	@section('body-content')
		
			
			<div class="col-md-8">
				@include('formErr')
				@include('errMsg')

				<div class="panel panel-info">
				    <div class="panel-heading">
				        <h3 class="panel-title">Confirm Deposit</h3>
				    </div>
				    <div class="panel-body text-center">
				        
				        	<p>Deposit Amount: USD{{ $data[1] }}</p>
				        	<p>Payment Method: Perfect Money</p>
							<form action="https://perfectmoney.is/api/step1.asp" method="POST" target="_blank">
					        	<input type="hidden" name="PAYEE_ACCOUNT" value="U10637983">
					        	<input type="hidden" name="PAYEE_NAME" value="FBO Corporation">
					        	<input type="hidden" name="PAYMENT_ID" value="adeposit">
					        	<input type="hidden" name="PAYMENT_AMOUNT" value="{{ $data[1] }}" >
					        	<input type="hidden" name="PAYMENT_UNITS" value="USD">
					        	<input type="hidden" name="STATUS_URL" value="fbofund@gmail.com">
					        	<input type="hidden" name="PAYMENT_URL" value="http://fbofund.com/member/payment">
					        	<input type="hidden" name="PAYMENT_URL_METHOD" value="POST">
					        	<input type="hidden" name="NOPAYMENT_URL" value="http://fbofund.com/member/payment">
					        	<input type="hidden" name="NOPAYMENT_URL_METHOD" value="POST">
					        	<input type="hidden" name="SUGGESTED_MEMO" value="Deposit in FBOC">
					        	<input type="hidden" name="BAGGAGE_FIELDS" value="">
					        	<input type="submit" class="btn btn-info" name="PAYMENT_METHOD" value="Pay Now!">
				        	</form>
				        
				    </div>
				</div>
			</div>
		
		 	

		 	<div class="col-md-4">
		 		@include('partials.right-sidebar')
		 	</div> <!-- right sidebar -->
		  
	@endsection

	@section('script')
		{!! Html::script('js/custom/deposit.js') !!}
		{!! Html::script('js/custom/depossit.min.js') !!}
		
	@endsection