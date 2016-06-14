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
							
							<div class="row">
							    <div class="col-md-12">
							        <div class="panel panel-info">
							            <div class="panel-heading">
							                Deposit Balance
							                <span class="tools pull-right">
							                    <a href="javascript:;" class="fa fa-chevron-down"></a>
							                    <a href="javascript:;" class="fa fa-times"></a>
							                 </span>
							            </div>
							            <div class="panel-body">
							                {!! Form::open(['url'=>'user/makedeposit', 'class'=>'form-horizontal', 'id' => 'depositForm','method' =>'POST' ]) !!}
							 					
					 						<div class="form-group">
				                              <label class="col-md-3 col-sm-3 control-label">Select Deposit Amount</label>
				                              <div class="col-md-7 col-sm-7">
					                              <div class="input-group">
					                                <div class="input-group-addon"><i class="fa fa-usd"></i></div>
					                                {!! Form::text('deposit', '',[ 'required'=>'required','placeholder' => 'Deposit Amount','id'=>'deposit','class'=>'form-control']) !!}
					                              </div>
					                              <span id="errMsgDeposit" class="error-msg"></span>
				                              </div>
				                            </div>
				                            <div class="form-group">
				                              <label class="col-md-3 col-sm-3 control-label">Select Payment Method</label>
				                              <div class="col-md-7 col-sm-7">
					                              <div class="input-group">
					                                <div class="input-group-addon"><i class="fa fa-cc-mastercard"></i></div>
					                                {!! Form::select('pmethod',[
					                                '' => '--Select payment method',
					                                'wb'=>'Wallet Balance',
					                                'pm'=>'Perfect Money',
					                                ], null, ['id'=>'pmethod','class'=>'form-control']) !!}
					                              </div>
					                              <span id="errMsgPmethod" class="error-msg"></span>
				                              </div>
				                            </div>
				                            <div class="pm-account">
				                            	<div class="form-group">
				                              <label class="col-md-3 col-sm-3 control-label">Payer Account</label>
				                              <div class="col-md-7 col-sm-7">
					                              <div class="input-group">
					                                <div class="input-group-addon"><i class="fa fa-cc-mastercard"></i></div>
					                                {!! Form::text('pmaccount', '', [ 'placeholder' => 'Payer Account','id'=>'pmaccount','class'=>'form-control']) !!}
					                              </div>
					                              <span id="errMsgPmethod" class="error-msg"></span>
				                              </div>
				                            </div>
				                            </div>





				                            
				                            

											
				                           <div class="btn-center text-center">
				                           	<input type="submit" value="Make Deposit" name="PAYMENT_METHOD" class="btn btn-info finish text-center">
				                           </div>

					 				{!! Form::close() !!}
							            </div>
							        </div>
							    </div>
							</div> <!-- .row div end -->
						</div>
		
		 	

		 	<div class="col-md-4">
		 		@include('partials.right-sidebar')
		 	</div> <!-- right sidebar -->
		  
	@endsection

	@section('script')
		{!! Html::script('js/custom/deposit.js') !!}
		{!! Html::script('js/custom/depossit.min.js') !!}
		
	@endsection