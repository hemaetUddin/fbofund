@extends('layouts.adminMaster')

@section('style')

{!! Html::style('css/custom.css') !!}

@endsection

@section('page-heading')
@endsection

@section('body-content')

	<div class="row">
		<div class="withdraw-form">
			<div class="col-md-8">
				
					<div class="row">
					<div class="col-md-12">
						@if (count($errors) > 0)
						    <div class="alert alert-danger">
						    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						        <ul>
						            @foreach ($errors->all() as $error)
						                <li class="userRegErr">{{ $error }}</li>
						            @endforeach
						        </ul>
						    </div>
						@endif
						@include('depoMsg')
						@include('errMsg')
					</div>
						
						{{-- @if(session('message')) --}}
							{{-- <div class="alert alert-success fade in"> --}}
								{{-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> --}}
								{{-- {{ Session::get('message') }} --}}
							{{-- </div> --}}
						{{-- @endif --}}
						
					</div> <!-- message row -->
					<div class="row">
					    <div class="col-md-12">
					        <div class="panel panel-info">
					            <div class="panel-heading">
					                <div class="row">
					                	<div class="col-sm-4">
					                		<p class="text-center"> Wallet Balance USD: {{ number_format($balanceAndAccountInfo[0],2) }}</p>
					                		
					                	</div>
					                	<div class="col-sm-4">
					                		<p class="text-center"> ROI Balance USD:  {{ number_format($balanceAndAccountInfo[1],2) }}</p> 
					                		
					                	</div>
					                	<div class="col-sm-4">
					                		<span class="tools pull-right">
					                		    <a href="javascript:;" class="fa fa-chevron-down"></a>
					                		    <a href="javascript:;" class="fa fa-times"></a>
					                		</span>
					                	</div>
					                </div>
					            </div>
					            <div class="panel-body">
					                <div class="widthdraw-form">
					                    {!! Form::open([ 'url' => 'user/requestWithdraw' , 'id'=>'wform', 'class' => 'form-horizontal']) !!}
					                   	<div class="form-group">
					                    		@if( FindUserPayMethod::findPayMethod(Auth::id()) == 'wb' )
					                    			<label class="col-md-3 col-sm-3 control-label">Payment Gateway</label>
					                    			<div class="col-md-9 col-sm-9">
					                    				<div class="input-group">
					                    					<div class="input-group-addon"><i class="fa fa-cc-mastercard"></i></div>
					                    					
					                    					{!! Form::select('payment_gateway',[
					                    						'pm'=>'Perfect Money',
					                    						], null, ['id'=>'payment_gateway','required'=>'required','class'=>'form-control']) !!}
					                    				</div>
					                    				<span id="errMsgpayment_gateway" class="error-msg"></span>
					                    			</div>
					                    		@else 
					                    			<label class="col-md-3 col-sm-3 control-label">Payment Gateway</label>
					                    			<div class="col-md-9 col-sm-9">
					                    				<div class="input-group">
					                    					<div class="input-group-addon"><i class="fa fa-cc-mastercard"></i></div>
					                    					
					                    					{!! Form::select('payment_gateway',[
					                    						'pm'=>'Perfect Money' 
					                    						], null, ['id'=>'payment_gateway','required'=>'required','class'=>'form-control']) !!}
					                    				</div>
					                    				<span id="errMsgpayment_gateway" class="error-msg"></span>
					                    			</div>
					                    		@endif		
					                    	</div>
					                    	<div class="form-group">
					                    		@if( FindUserPayMethod::findPayMethod(Auth::id()) == 'wb' )
					                    			<label class="col-md-3 col-sm-3 control-label">Payment Account</label>
					                    			<div class="col-md-9 col-sm-9">
					                    				<div class="input-group">
					                    					<div class="input-group-addon"><i class="fa fa-user"></i></div>
					                    					
					                    					{!! Form::text('payment_account','', ['id'=>'payment_account','class'=>'form-control', 'required'=>'required','placeholder' => 'Payment Account']) !!}
					                    				</div>
					                    				<span id="errMsgpaymentAccount" class="error-msg"></span>
					                    			</div>
					                    		@elseif(FindUserPayMethod::findPayMethod(Auth::id())==false) 
					                    			<label class="col-md-3 col-sm-3 control-label">Payment Account</label>
					                    			<div class="col-md-9 col-sm-9">
					                    				<div class="input-group">
					                    					<div class="input-group-addon"><i class="fa fa-user"></i></div>
					                    					
					                    					{!! Form::text('payment_account',FindUserPayMethod::findPayMethod(Auth::id()),['id'=>'payment_account','required'=>'required', 'class'=>'form-control']) !!}
					                    				</div>
					                    				<span id="errMsgpaymentAccount" class="error-msg"></span>
					                    			</div>
					                    		@else 
					                    			<label class="col-md-3 col-sm-3 control-label">Payment Account</label>
					                    			<div class="col-md-9 col-sm-9">
					                    				<div class="input-group">
					                    					<div class="input-group-addon"><i class="fa fa-user"></i></div>
					                    					
					                    					{!! Form::text('payment_account',FindUserPayMethod::findPayMethod(Auth::id()),['id'=>'payment_account', 'required'=>'required','readonly' => 'readonly', 'class'=>'form-control']) !!}
					                    				</div>
					                    				<span id="errMsgpaymentAccount" class="error-msg"></span>
					                    			</div>	
					                    		@endif		
					                    	</div>

					                    	<div class="form-group">
					                    		<label class="col-md-3 col-sm-3 control-label">Balance Type</label>
					                    		<div class="col-md-9 col-sm-9">
					                    			<div class="input-group">
					                    				<div class="input-group-addon"><i class="fa fa-usd"></i></div>
					                    				{!! Form::select('balance_type',[
					                    					'0' => '--Select Balance Type',
					                    					'1'=>'Wallet Balance',
					                    					'2'=>'ROI Balance' ], null, ['required'=>'required','id'=>'balanceType','class'=>'form-control']) !!}
					                    			</div>
					                    				<span id="errMsgbalanceType" class="error-msg"></span>
					                    		</div>
					                    	</div>

					                    	<div class="form-group" id="wtamount">
					                    		<label class="col-md-3 col-sm-3 control-label">Withdrawal Amount</label>
					                    		<div class="col-md-5 col-sm-5">
					                    			<div class="input-group">
					                    				<div class="input-group-addon"><i class="fa fa-usd"></i></div>
					                    				{!! Form::text('withdrawal_amount','',['required'=>'required','id'=>'withdrawal_amount','class'=>'form-control', 'autofocus' => 'true', 'placeholder'=>'Withdrawal Amount']) !!}
					                    			</div>
					                    				<span id="errMsgWithAmount" class="error-msg"></span>
					                    		</div>
					                    		<div class="col-md-4 col-sm-4" id="errMsgWamount"></div>
					                    		{!! Form::hidden('maxBalance','',['id'=>'maxBalance']) !!}
					                    	</div>



					                    	<div class="form-group">
					                    		<label class="col-md-3 col-sm-3 control-label">Secure PIN</label>
					                    		<div class="col-md-5 col-sm-5">
					                    			<div class="input-group">
					                    				<div class="input-group-addon"><i class="fa fa-lock"></i></div>
					                    				{!! Form::password('pincode',['required'=>'required','id'=>'pincode','class'=>'form-control','placeholder'=>'PIN Code']) !!}
					                    			</div>
					                    				<span id="errMsgPincode" class="error-msg"></span>
					                    		</div>
					                    		<div class="col-md-4 col-sm-4 error-msg"><p id="errMsgPin"></p></div>
					                    	</div>

											<input type="submit" id="btnSubmit" value="Withdraw" name="" class="btn btn-info finish">
					                    	

					                    {!! Form::close() !!}
					                </div>
					            </div>
					        </div>
					    </div>
					</div>
				
				
			</div> <!-- col-md-8 end -->

		</div> <!-- widthdraw form div end -->



		<div class="col-md-4">
			@include('partials.right-sidebar')
		</div> {{-- col-md-4 end --}}
	</div> <!-- row div end -->
@endsection

@section('script')
		{!! Html::script('js/custom/withdrawal.js') !!}
		{{-- {!! Html::script('js/jquery.validate.min.js') !!} --}}
		{{-- {!! Html::script('js/validatiosn-init.js') !!}  --}}
		{{-- {!! !!} --}}

	<script type="text/javascript">
	


	function fieldCheck(){
		var ids = document.getElementById('withdrawal_amount');
		if(ids.value.length == 0 || ids.value.length == null)
		{
			ids.style.color = "#f00";
		}
		else{
			ids.style.color = "#888";
		}	
	}


	</script>

@endsection