@extends('layouts.adminMaster')
	
@section('style')
	{!! Html::style( 'css/custom.css' ) !!}
	

@endsection

@section('page-heading')
	@include('partials.top-heading')
@endsection

@section('body-content')
	@include('depoMsg')
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
		    <div class="panel yellow-bg">
		        <div class="panel-body">
		            <div class="row">
		            	    {!! Form::open() !!}
				                <span>Your Payment Information</span>
				                {{-- <p><span>Deposit Amount</span> {{ $data[0] }}</p> --}}
				                <p><span>Account No.</span> {{ $data[1] }}</p>
				                {{-- <button class="">Confirm</button> --}}
				                
				                <input type="hidden" name="PAYEE_ACCOUNT" value="U10637983">
				                <input type="hidden" name="PAYEE_NAME" value="FBO Corporation">
				                <input type="hidden" name="PAYMENT_ID" value="deposit">
                Deposit Amount: <input type="text" name="PAYMENT_AMOUNT" value="{{ $data[0] }}"><BR>
				                <input type="hidden" name="PAYMENT_UNITS" value="USD">
				                <input type="hidden" name="STATUS_URL" value="arabhi_fx@yahoo.com">
				                <input type="hidden" name="PAYMENT_URL" value="http://apachenetwork.net/fbopayment.php">
				                <input type="hidden" name="PAYMENT_URL_METHOD" value="POST">
				                <input type="hidden" name="NOPAYMENT_URL" value="http://apachenetwork.net/fbopayment.php">
				                <input type="hidden" name="NOPAYMENT_URL_METHOD" value="POST">
				                <input type="hidden" name="SUGGESTED_MEMO" value="">
				                <input type="hidden" name="MEMBERACCOUNT" value="U5208266">
				                <input type="hidden" name="BAGGAGE_FIELDS" value="MEMBERACCOUNT">
				                <input type="submit" class="btn btn-info btn-lg" name="PAYMENT_METHOD" value="Confirm">
				                </form> 
		                </form>
		            </div>
		        </div>
		    </div>
		</div>
	</div>
@endsection

@section('script')
@endsection