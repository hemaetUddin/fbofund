@extends('layouts.adminMaster')
	
	@section('style')
		{!! Html::style('css/custom.css') !!}

		<style type="text/css">
				.rtwcwait{
					position: absolute;
					top: 170px;
					left: 315px;
				}
			

		</style>

		
	@endsection

	

	@section('body-content')

		
		<div class="col-md-8">

			<div class="row">
			<div class="col-md-12">
				@include('depoMsg')
				@include('errMsg')
				@if (count($errors) > 0)
				    <div class="alert alert-danger">
				        <ul>
				            @foreach ($errors->all() as $error)
				                <li class="userRegErr">{{ $error }}</li>
				            @endforeach
				        </ul>
				    </div>
				@endif
			</div>	
			</div>
			<div class="row">
			    <div class="col-md-12">

			        <div class="panel panel-info">
			            <div class="panel-heading">
			                Balance Transfer &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			                {{-- <p class="title">Balance Transfer</p> --}}
			                @if($availableBalance)
			                	
			                <span class="">Wallet Balance : <span class="sbalance"><strong>USD {{ number_format($availableBalance->balance, 2) }}</strong></span> 
			                	&nbsp;&nbsp;|| &nbsp;&nbsp; ROI Balance : <strong>USD {{ number_format($availableBalance->roi_balance, 2) }}</strong></span>
			                @endif
			                <span class="tools pull-right">
			                    {{-- <a href="javascript:;" class="fa fa-chevron-down"></a> --}}
			                    {{-- <a href="javascript:;" class="fa fa-times"></a> --}}
			                 </span>
			            </div>
			            <div class="panel-body">
			                <div class="form-body">
			                	
			                		<div class="col-md-8 col-sm-8 col-md-offset-2 col-sm-offset-2">
			                		
			                			<div id="thirdForm" class="">
			                			<div id="secondForm" class="">
			                			<div id="firstForm" class="">
			                			{!! Form::open(['class'=>'form-horizontal'])  !!}
			                				<div class="form-group">
			                					<div class = "input-group">
			                					   <span class = "input-group-addon"><i class="fa fa-money"></i></span>
			                					   {!! Form::select('transferType',[
			                					   '' => '--Select Transfer Type',
			                					   'r2w'=>'ROI to Wallet',
			                					   'r2r'=>'ROI to ROI',
			                					   'w2w'=>'Wallet to Wallet'], null, ['id'=>'transferType','class'=>'form-control']) !!}
			                					</div>	
			                				</div>
			                			{!! Form::close() !!}
			                		
			                		<div id="r2w" class="field1 current">
			                			{!! Form::open(['class'=>'form-horizontal', 'id' => 'r2wForm' ])  !!}
			                				<div class="form-group">
			                					<div class="input-group">
			                						<div class="input-group-addon"><i class="fa fa-usd"></i></div>
			                						{!! Form::text('rtwAmount','',['id'=>'rtwAmount','class'=>'form-control', 'placeholder' => 'Transfer Amount']) !!}
			                					</div>
			                					<span id="errMsgRtwAmount" class="error-msg"></span>
			                				</div>
			                				<input type="hidden" id="ptf" value="">
			                				<div class="form-group">
			                					<div class="input-group">
			                						<div class="input-group-addon"><i class="fa fa-unlock"></i></div>
			                						{!! Form::password('rtwPin',['id'=>'rtwPin','class'=>'form-control', 'placeholder' => 'Secure PIN']) !!}
			                					</div>
			                					<span id="errMsgRtwPin" class="error-msg"></span>
			                				</div>

			                				{{-- <button class="btn btn-info rtwTransfer finish">Transfer </button>	 --}}
			                				<input type="button" name="review" id="review1" class="btn btn-info review action-button" value="Continue" />
			                			{!! Form::close() !!}
			                		</div> {{-- r2w div end --}}
			                		</div> {{-- firstForm div end --}} 
			                		
			                		<div id="r2wpreview" class="field2 current">
			                			<!-- @TODO PREVIEW ALL FORM INPUTS -->
			                			{!! Form::open(['url'=>'user/rtwtransfer','class'=>'form-horizontal'])  !!}
			                				<p class="bt-title text-center">Roi to Wallet Blance Transfer</p>
			                				<div class="form-group">
			                					<div class="col-md-2 col-sm-2">
			                						<label class="label-control"> Transfer Amount</label>
			                					</div> 
			                					<div class="input-group">
			                						<div class="input-group-addon"><i class="fa fa-usd"></i></div>
			                						{!! Form::text('rtwAmount','',['id'=>'rtwAmount','class'=>'form-control', 'readonly' => 'readonly']) !!}
			                					</div>
			                				</div>
			                				<div class="form-group">
			                					<div class="col-md-2 col-sm-2">
			                						<label class="label-control"> Prcessing Fee </label>
			                					</div>
			                					<div class="input-group">
			                						<div class="input-group-addon"><i class="fa fa-usd"></i></div>
			                						{!! Form::text('ptf','',['id'=>'','class'=>'form-control','readonly' => 'readonly']) !!}
			                					</div>
			                				</div>
			                				<input type="hidden" name="rtwPin">
			                				
			                				{{-- <input type="button" name="previous" class="btn btn-warning previous action-button" value="Previous" /> --}}
			                				<input type="button" class="btn btn-warning" id="r2wPrevious" value="Previous">
			                				<button class="btn btn-info rtwTransfer finish">Confirm </button>
			                				<div class="rtwcwait"></div>

			                			{!! Form::close() !!}
			                		</div> {{-- r2wpreview DIV END --}}

			                		<div id="r2r" class="field1 current">
			                			{!! Form::open(['class'=>'form-horizontal'])  !!}
			                				<div class="form-group">
			                					<div class="input-group">
			                						<div class="input-group-addon"><i class="fa fa-usd"></i></div>
			                						{!! Form::text('rtrAmount','',['id'=>'rtrAmount','class'=>'form-control', 'placeholder' => 'Transfer Amount']) !!}
			                					</div>
			                					<span id="errMsgRtrAmount" class="error-msg"></span>
			                				</div>
			                				<div class="form-group">
			                					<div class="input-group">
			                						<div class="input-group-addon"><i class="fa fa-user"></i></div>
			                						{!! Form::text('rtrReceiverId','',['id'=>'rtrReceiverId','class'=>'form-control', 'placeholder' => 'Receiver ID']) !!}
			                					</div>
			                					<span id="errMsgRtrReceiver" class="error-msg"></span>
			                				</div>
			                				<div class="form-group">
			                					<div class="input-group">
			                						<div class="input-group-addon"><i class="fa fa-unlock"></i></div>
			                						{!! Form::password('rtrPin',['id'=>'rtrPin','class'=>'form-control','placeholder' => 'Secure PIN']) !!}
			                					</div>
			                					<span id="errMsgRtrPin" class="error-msg"></span>
			                				</div>
			                				{{-- <button class="btn btn-info finish rtrTransfer">Transfer</button> --}}
			                				<input type="button" name="review" id="review2" class="btn btn-info r2rReview action-button" value="Continue" />

			                			{!! Form::close() !!}
			                		</div> {{-- r2r div end --}}
			                		</div> {{-- ....second form... --}}

			                		<div id="r2rpreview" class="field2 current">
			                			{!! Form::open(['url'=>'user/rtrtransfer','class'=>'form-horizontal'])  !!}
			                					<p class="bt-title text-center">ROI to ROI Blance Transfer</p>
			                				<div class="form-group">
			                					<div class="input-group">
			                						<div class="input-group-addon"><i class="fa fa-usd"></i></div>
			                						{!! Form::text('rtrAmount','',['readonly'=>'readonly','id'=>'rtrAmount','class'=>'form-control']) !!}
			                					</div>
			                					
			                				</div>
			                				<div class="form-group">
			                					<div class="input-group">
			                						<div class="input-group-addon"><i class="fa fa-user"></i></div>
			                						{!! Form::text('rtrReceiverId','',['readonly'=>'readonly','id'=>'rtrReceiverId','class'=>'form-control']) !!}
			                					</div>
			                				</div>
			                				{!! Form::hidden('rtrPin','',['id'=>'rtrPin','class'=>'form-control']) !!}
			                				<div class="form-group">
			                					<div class="input-group">
			                						<div class="input-group-addon"><i class="fa fa-usd"></i></div>
			                						{!! Form::text('ptf','Free', ['readonly'=>'readonly','id'=>'ptf','class'=>'form-control']) !!}
			                					</div>
			                				</div>
			                				{{-- <button class=" action-button">Previous </button> --}}
			                				<input type="button" class="btn btn-warning rtrPrevious" id="r2rPrevious" value="Previous">
			                				<button class="btn btn-info finish rtrTransfer">Confirm</button>

			                			{!! Form::close() !!}
			                		</div> {{-- r2rpreview div end --}}

			                		<div id="w2w">
			                			{!! Form::open(['class'=>'form-horizontal'])  !!}
			                				<div class="form-group">
			                					<div class="input-group">
			                						<div class="input-group-addon"><i class="fa fa-usd"></i></div>
			                						{!! Form::text('wtwAmount','',['id'=>'wtwAmount','class'=>'form-control', 'placeholder' => 'Transfer Amount']) !!}
			                					</div>
			                					<span id="errMsgWtwAmount" class="error-msg"></span>
			                				</div>
			                				<div class="form-group">
			                					<div class="input-group">
			                						<div class="input-group-addon"><i class="fa fa-user"></i></div>
			                						{!! Form::text('wtwReceiverId','',['id'=>'wtwReceiverId','class'=>'form-control', 'placeholder' => 'Receiver ID']) !!}
			                					</div>
			                					<span id="errMsgWtwReceiver" class="error-msg"></span>
			                				</div>
			                				<div class="form-group">
			                					<div class="input-group">
			                						<div class="input-group-addon"><i class="fa fa-unlock"></i></div>
			                						{!! Form::password('wtwPin',['id'=>'wtwPin','class'=>'form-control','placeholder' => 'Secure PIN']) !!}
			                					</div>
			                					<span id="errMsgWtwPin" class="error-msg"></span>
			                				</div>
			                				<input type="button" class="btn btn-info finish wtwTransfer" id="wtwTransfer" value="Continue">
			                			{!! Form::close() !!}
			                		</div> {{-- w2w div end --}}
			                		</div> {{-- .......ThirdForm end --}}
			                		
			                		<div id="w2wpreview" class="current">
			                			{!! Form::open(['url'=>'user/wtwtransfer','class'=>'form-horizontal'])  !!}
			                				<p class="bt-title text-center">Wallet to Wallet Balance Transfer</p>
			                				<div class="form-group">
			                					<div class="input-group">
			                						<div class="input-group-addon"><i class="fa fa-usd"></i></div>
			                						{!! Form::text('wtwAmount','',['readonly'=>'readonly','id'=>'wtwAmount','class'=>'form-control', 'placeholder' => 'Transfer Amount']) !!}
			                					</div>
			                				</div>
			                				<div class="form-group">
			                					<div class="input-group">
			                						<div class="input-group-addon"><i class="fa fa-user"></i></div>
			                						{!! Form::text('wtwReceiverId','',['readonly'=>'readonly','id'=>'wtwReceiverId','class'=>'form-control', 'placeholder' => 'Receiver ID']) !!}
			                					</div>
			                				</div>
			                				{!! Form::hidden('wtwPin','',['id'=>'wtwPin','class'=>'form-control']) !!}
			                				<div class="form-group">
			                					<div class="input-group">
			                						<div class="input-group-addon"><i class="fa fa-unlock"></i></div>
			                						{!! Form::text('ptf','Free',['readonly'=>'readonly','id'=>'ptf','class'=>'form-control','placeholder' => 'Secure PIN']) !!}
			                					</div>
			                				</div>
			                				<input type="button" class="btn btn-warning rtrPrevious" id="w2wPrevious" value="Previous">
			                				<button class="btn btn-info finish wtwTransfer">Confirm</button>
			                			{!! Form::close() !!}
			                		</div>
			                		</div> {{-- col-md-8 end --}}
			                </div> {{-- form-body div --}}
			                <div class="aware-msg">
			                	<p class="aware-message">
			                		<span>*</span> Please be aware that a fee of 2% of the amount transferred will be deducted as ROI to Wallet transfer processing fee!!
			                	</p>
			                </div>
			            </div>
			        </div>
			    </div>
			</div>
		</div>

		<div class="col-md-4">
				@include('partials.right-sidebar')	
		</div> {{--  right sidebar  --}}




	@endsection

	@section('script')
		{!! Html::script('js/custom/balanceTransfer.js') !!}
		


		<script type="text/javascript">
		$(document).ready(function(){

			var btnContinue = $('#review1').val();
			$('#review1').click(function(e){
				e.preventDefault();
			});

		});

		</script>
		
		
	@endsection
