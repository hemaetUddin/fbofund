 

@if(Auth::user()->roles()->first()->name == 'user') 

 

 @extends('layouts.adminMaster')



 @section('style')

 	{!! Html::style('/css/custom.css') !!}

 	<style type="text/css">
		.dataTables_wrapper { font-size: 10px }
 	</style>

 	

 @stop



 



 @section('body-content')

	@include('depoMsg')

	@include('errMsg')

	

	@if(Session::get('message'))

		<div class="row">

			<div class="col-sm-12 col-md-12">

				

				

			</div> 

		</div>

	@endif	



 	@if(Auth::user()->status == 1)

		

 	<div class="row">

 		<div class="col-md-6">

 			<div class="row team-status">

 				<div class="col-md-6 col-xs-12 col-sm-6">

 				    <div class="panel bg-cabaret">

 				        <div class="head">

 				            Team Status

 				        </div>

 				        <div class="col-xs-6 clear">

 				        	<div class="status-value">

 				        	    <div class="value"><i class="fa fa-users fa-3x"></i></div>

 				        	    <div class="title">L. Member</div>
 				        	    
 				        	    <div class="tree-num">
				        	    	@if(!empty($datas[0]))
				        	    		{{ $datas[0] }}
				        	    	@else 
				        	    		{{ 'Blank' }}
				        	    	@endif

				        	    	{{-- {{ downline_count(28,0) }} --}}

 				        	    </div>
 				        	    <div class="title">L. Count</div>
 				        	    <div class="tree-num">
				        	    	
				        	    	{{ downline_count($datas[8],0) }}

 				        	    </div>

 				        	</div>

 				        </div>

 				         <div class="col-xs-6 clear">

 				         	<div class="status-value">

 				         	    <div class="value"><i class="fa fa-users fa-3x"></i></div>

 				         	    <div class="title">R. Members</div>

 				         	    <div class="tree-num">
									@if(!empty($datas[1]))
										{{ $datas[1] }}
						   	    	@else 
										{{ 'Blank' }}
						   	    	@endif

								{{-- {{ downline_count(0,0) }}		 --}}
 				         	    </div>

 				         	    <div class="title">R. Count</div>

 				         	    <div class="tree-num">
									
								{{ downline_count($datas[9],0) }}		
 				         	    </div>

 				         	</div>

 				         </div>

 				         <div class="title">&nbsp;</div>

 				    </div> 

 				</div>

 				<div class="col-md-6 col-xs-12 col-sm-6">

 				    <div class="panel bg-lynch">

 				        <div class="head">

 				            Business Status

 				        </div>

 				        <div class="col-xs-6 clear">

 				        	<div class="status-value">

 				        	    <div class="value"><i class="fa fa-bar-chart-o fa-5x"></i></div>

 				        	    <div class="title">Left Carry</div>

 				        	    <div class="tree-num">{{ $datas[2] }}</div>

 				        	</div>

 				        </div>

 				         <div class="col-xs-6 clear">

 				         	<div class="status-value">

 				         	    <div class="value"><i class="fa fa-bar-chart-o fa-5x"></i></div>

 				         	    <div class="title">Right Carry</div>

 				         	    <div class="tree-num">{{  $datas[3] }}</div>

 				         	</div>

 				         </div>

 				         <div class="title">&nbsp;</div>

 				    </div> 

 				</div>

 			</div> <!-- ......team status div........ --> 			

 		</div> <!-- col-md-6 div end -->



 	    <div class="col-md-6">

 	    	<!--statistics start-->

 	    	<div class="row state-overview">

 	    		<div class="col-md-6 col-xs-12 col-sm-6">

 	    			<div class="panel green">

 	    				<div class="symbol">

 	    					<i class="fa fa-google-wallet"></i>

 	    				</div>

 	    				<div class="state-value">

 	    					<div class="value">USD {{ number_format($datas[4],2) }}</div>

 	    					<div class="title"> Wallet Balance </div>

 	    				</div>

 	    			</div>

 	    		</div>

 	    		

 	    		<div class="col-md-6 col-xs-12 col-sm-6">

 	    			<div class="panel red">

 	    				<div class="symbol">

 	    					<i class="fa fa-shopping-bag"></i>

 	    				</div>

 	    				<div class="state-value">

 	    					<div class="value">USD {{ number_format($datas[5],2) }}</div>

 	    					<div class="title">ROI Balance</div>

 	    				</div>

 	    			</div>

 	    		</div>

 	    	</div>

 	    	<div class="row state-overview">

 	    		<div class="col-md-6 col-xs-12 col-sm-6">

 	    			<div class="panel blue">

 	    				<div class="symbol">

 	    					<i class="fa fa-user"></i>

 	    				</div>

 	    				<div class="state-value">

 	    					<div class="value">{{ $datas[6] }}</div>

 	    					<div class="title"> Direct referral income today</div>

 	    				</div>

 	    			</div>

 	    		</div>

 	    		<div class="col-md-6 col-xs-12 col-sm-6">

 	    			<div class="panel purple">

 	    				<div class="symbol">

 	    					<i class="fa fa-users"></i>

 	    				</div>

 	    				<div class="state-value">

 	    					<div class="value">{{ $datas[7] }}</div>

 	    					<div class="title">Step referral income today</div>

 	    				</div>

 	    			</div>

 	    		</div>

 	    	</div>

 	    	<!--statistics end-->

 	    </div> <!-- col-md-6 div end -->

 	    

 	</div> <!-- first row div end -->

 	

 	@else

 		{{-- <h2>{{ Auth::user()->status }}</h2> --}}

 		<div class="row">

 			<div class="col-md-6">

 				<div class="row team-status">

 					<div class="col-md-6 col-xs-12 col-sm-6">

 					    <div class="panel bg-cabaret">

 					        <div class="head">

 					            Team Status

 					        </div>

 					        <div class="col-xs-6 clear">

 					        	<div class="status-value">

 					        	    <div class="value"><i class="fa fa-users fa-5x"></i></div>

 					        	    <div class="title">L. Member</div>

 					        	    <div class="tree-num">
 					        	    	@if(!empty($datas[0]))
 					        	    		{{ $datas[0] }}
 					        	    	@else 
											{{ 'Blank' }}
 					        	    	@endif
 					        	    </div>

 					        	</div>

 					        </div>

 					         <div class="col-xs-6 clear">

 					         	<div class="status-value">

 					         	    <div class="value"><i class="fa fa-users fa-5x"></i></div>

 					         	    <div class="title">R. Member</div>

 					         	    <div class="tree-num">
										@if(!empty($datas[1]))
 					        	    		{{ $datas[1] }}
 					        	    	@else 
											{{ 'Blank' }}
 					        	    	@endif	
 					         	    </div>

 					         	</div>

 					         </div>

 					         <div class="title">&nbsp;</div>

 					    </div> 

 					</div>

 					<div class="col-md-6 col-xs-12 col-sm-6">

 					    <div class="panel bg-lynch">

 					        <div class="head">

 					            Business Status

 					        </div>

 					        <div class="col-xs-6 clear">

 					        	<div class="status-value">

 					        	    <div class="value"><i class="fa fa-bar-chart-o fa-5x"></i></div>

 					        	    <div class="title">Left Carry</div>

 					        	    <div class="tree-num">{{ $datas[2] }}</div>

 					        	</div>

 					        </div>

 					         <div class="col-xs-6 clear">

 					         	<div class="status-value">

 					         	    <div class="value"><i class="fa fa-bar-chart-o fa-5x"></i></div>

 					         	    <div class="title">Right Carry</div>

 					         	    <div class="tree-num">{{  $datas[3] }}</div>

 					         	</div>

 					         </div>

 					         <div class="title">&nbsp;</div>

 					    </div> 

 					</div>

 				</div> <!-- ......team status div........ --> 			

 			</div> <!-- col-md-6 div end -->



 		    <div class="col-md-6">

 		    	<!--statistics start-->

 		    	<div class="row state-overview">

 		    		<div class="col-md-6 col-xs-12 col-sm-6">

 		    			<div class="panel green">

 		    				<div class="symbol">

 		    					<i class="fa fa-google-wallet"></i>

 		    				</div>

 		    				<div class="state-value">

 		    					<div class="value">USD {{ number_format($datas[4],2) }}</div>

 		    					<div class="title"> Wallet Balance </div>

 		    				</div>

 		    			</div>

 		    		</div>

 		    		

 		    		<div class="col-md-6 col-xs-12 col-sm-6">

 		    			<div class="panel red">

 		    				<div class="symbol">

 		    					<i class="fa fa-shopping-bag"></i>

 		    				</div>

 		    				<div class="state-value">

 		    					<div class="value">USD {{ number_format($datas[5],2) }}</div>

 		    					<div class="title">ROI Balance</div>

 		    				</div>

 		    			</div>

 		    		</div>

 		    	</div>

 		    	<div class="row state-overview">

 		    		<div class="col-md-6 col-xs-12 col-sm-6">

 		    			<div class="panel blue">

 		    				<div class="symbol">

 		    					<i class="fa fa-user"></i>

 		    				</div>

 		    				<div class="state-value">

 		    					<div class="value">{{ $datas[6] }}</div>

 		    					<div class="title"> Direct referral income today</div>

 		    				</div>

 		    			</div>

 		    		</div>

 		    		<div class="col-md-6 col-xs-12 col-sm-6">

 		    			<div class="panel purple">

 		    				<div class="symbol">

 		    					<i class="fa fa-users"></i>

 		    				</div>

 		    				<div class="state-value">

 		    					<div class="value">{{ $datas[7] }}</div>

 		    					<div class="title">Step referral income today</div>

 		    				</div>

 		    			</div>

 		    		</div>

 		    	</div>

 		    	<!--statistics end-->

 		    </div> <!-- col-md-6 div end -->

 		    

 		</div> <!-- first row div end -->

 		<div class="row">

 			<div class="col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2">

 				<div class="message">

 					<div class="alert alert-danger text-center">

 						<p class="menuMsg h3"></p>

 						<p class="h3">Your account is inactive!! </p>

 						<p class="h5"> Active your account to enable available features</p>

 					</div>

 				</div>

 				<div class="text-center"><button id="activate" class="btn btn-success btn-lg pull-center">Activate</button></div>

 				<div class="payment-system">

 					<p>You must pay $25 as activation charge</p>

 					

 					<div class="row states-info">

 						<a href="{{ url('user/pay')}}">

 							<div class="col-md-6">

 							    <div class="panel green-bg">

 							        <div class="panel-body">

 							            <div class="row">

 							                <div class="col-xs-4">

 							                    <i class="fa fa-money"></i>

 							                </div>

 							                <div class="col-xs-8">

 							                    <span class="state-title">  Pay with Wallet Balance  </span>

 							                    @if($balance)

 							                    <h4>USD {{ $balance }}</h4>

 							                    @endif

 							                </div>

 							            </div>

 							        </div>

 							    </div>

 							</div>

 						</a>

 						<a href="">

 							<div class="col-md-6">

 							    <div class="panel blue-bg">

 							        <div class="panel-body">

 							            <div class="row">

 							                <div class="col-xs-4">

 							                    <i class="fa fa-usd"></i>

 							                </div>

 							                <div class="col-xs-8">

 							                    <span class="state-title">  Pay with Perfect Money  </span>

 							                    <h4>USD 25</h4>

 							                </div>

 							            </div>

 							        </div>

 							    </div>

 							</div>





							<form action="https://perfectmoney.is/api/step1.asp" method="POST" target="_blank">

							<input type="hidden" name="PAYEE_ACCOUNT" value="U10637983">

							<input type="hidden" name="PAYEE_NAME" value="FBO Corporation">

							<input type="hidden" name="PAYMENT_ID" value="acc-activation">

							<input type="hidden" name="PAYMENT_AMOUNT" value="1">

							<input type="hidden" name="PAYMENT_UNITS" value="USD">

							<input type="hidden" name="STATUS_URL" value="fbofund@gmail.com">

							<input type="hidden" name="PAYMENT_URL" value="http://fbofund.com/member/payment">

							<input type="hidden" name="PAYMENT_URL_METHOD" value="POST">

							<input type="hidden" name="NOPAYMENT_URL" value="http://fbofund.com/member/payment">

							<input type="hidden" name="NOPAYMENT_URL_METHOD" value="POST">

							<input type="hidden" name="SUGGESTED_MEMO" value="FBOC Account activation">

							<input type="hidden" name="BAGGAGE_FIELDS" value="">

						</a>

							<input type="submit" class="pmsubmit" name="PAYMENT_METHOD" value="Pay Now!">

							</form>	

 						

 					</div> {{-- row end --}}

 					





 				</div>

 			</div> 

 		</div>

 		



 	@endif



 	@if(Auth::user()->status !=0)	

 	<div class="row">

 	 	@if($roiSchedules)

	 	    @include('user.contents.second')

	 	@else 

	 		@include('user.contents.secondTwo')

	    @endif





 	</div> <!-- second row end -->



 	<div class="row">

 		

 		@include('user.contents.thirdRow')

 	</div>  {{-- third-row end --}}

 	@endif



 	

 @endsection

 {{-- body content section end  --}}





 @section('script')

 	



 <!--Morris Chart-->

 {!! Html::script('js/morris-chart/morris.js') !!}

 {!! Html::script('js/morris-chart/raphael-min.js') !!}



 <!--Calendar-->

 {!! Html::script('js/calendar/clndr.js') !!}

 {!! Html::script('js/calendar/evnt.calendar.init.js') !!}

 {!! Html::script('js/calendar/moment-2.2.1.js') !!}

 {!! Html::script('http://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.5.2/underscore-min.js') !!}

<!--Dashboard Charts-->

{!! Html::script('js/dashboard-chart-init.js') !!}



{!! Html::script('js/vticker/vticker.js') !!}

<script type="text/javascript">



</script>



<!--dynamic table-->

{!! Html::script('js/advanced-datatable/js/jquery.dataTables.js') !!}

{!! Html::script('js/data-tables/DT_bootstrap.js') !!}

<!--dynamic table initialization -->

{!! Html::script('js/dynamic_table_init.js') !!}

{!! Html::script('js/withdrawls_dataTable_init.js') !!}

{!! Html::script('js/transaction_dataTable_init.js') !!}



{!! Html::script('js/custom/useractivation.js') !!}





@endsection











@endif