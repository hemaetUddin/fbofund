@extends('layouts.adminMaster')



@section('style')

	{!! Html::style('/css/custom.css') !!}

	

@endsection



@section('page-heading')

@endsection



@section('body-content')

	@include('depoMsg')

	<div class="col-md-3">

		<div class="row">

			<div class="col-md-12">

				<a href="" data-toggle="modal" data-target="#myModal">

					<div class="panel">

						<div class="sunglo-bg">

							<div class="col-md-3">

								<i class="fa fa-lock fa-3x"></i>

							</div>

							<div class="col-md-9">

								<p>Password</p>

								<p>Change login pasword</p>

							</div>

							&nbsp;

						</div>

					</div>

				</a>

			</div>

		</div>



		<div class="row">

			<div class="col-md-12">

				<a href="" data-toggle="modal" data-target="#myModalPin">

					<div class="panel">

						<div class="turquoise-bg">

							<div class="col-md-3">

								<i class="fa fa-key fa-3x"></i>

							</div>

							<div class="col-md-9">

								<p>Secret PIN</p>

								<p>Change secret PIN</p>

							</div>

							&nbsp;

						</div>

					</div>

				</a>

			</div>

		</div>



		<div class="row">

			<div class="col-md-12">

				<a href="" data-toggle="modal" data-target="#myModalEmail">

					<div class="panel">

						<div class="alizarin-bg">

							<div class="col-md-3">

								<i class="fa fa-envelope fa-3x"></i>

							</div>

							<div class="col-md-9">

								<p>Email</p>

								<p>Request email change</p>

							</div>

							&nbsp;

						</div>

					</div>

				</a>

			</div>

		</div>



		<div class="row">

			<div class="col-md-12">

				<a  href="" data-toggle="modal" data-target="#myModalPhone">

					<div class="panel">

						<div class="cabaret-bg">

							<div class="col-md-3">

								<i class="fa fa-phone fa-3x"></i>

							</div>

							<div class="col-md-9">

								<p>Contact</p>

								<p>Contact number change request</p>

							</div>

							&nbsp;

						</div>

					</div>

				</a>

			</div>

		</div>

	</div> <!-- col-md-3 end -->



	<div class="col-md-5">
			<div class="row">
				@include('errMsg')
			</div>

			<!-- <div class="row">
			
				@if( Session::has('message'))
			
					@if(session('depoMessage'))
			
						<div class="alert alert-danger fade in">
			
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			
							{{ Session::get('depoMessage') }}
			
						</div>
			
					@endif
			
					@if(session('message')=='PIN change successfully')
			
						<div class="alert alert-success fade in">
			
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			
							{{ session('message')}}
			
						</div>
			
					@elseif(session('message')=='Password change successfully')
			
						<div class="alert alert-success fade in">
			
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			
							{{ session('message')}}
			
						</div>
			
					@else 
			
						<div class="alert alert-danger fade in">
			
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			
							{{ session('message')}}
			
						</div>
			
					@endif
			
					
			
				@endif
			
			</div> -->

			<div class="row">

				<div class="col-md-12">

					<div class="pro-user">

						<i class="fa fa-user fa-5x"></i> 

					</div>

				</div>

			</div>

			<div class="row pmargin">

				<div class="col-md-12">

					<div class="pro-user-info">

						<table class="table">

							<tbody>

								<tr>

									<td class="tab-title">User Name</td>

									<td class="tab-value"> {{ Auth::user()->username }}</td>

									<td>

										<a href="" class="" data-toggle="modal" data-target="#myModalNorm">

										    <i class="fa fa-edit"></i>

										</a>

									</td>	

								</tr>

								<tr>

									<td class="tab-title">Full Name</td>

									<td class="tab-value"> {{ Auth::user()->full_name }}</td>

								</tr>

								<tr>

									<td class="tab-title">Contact Number</td>

									<td class="tab-value"> {{ Auth::user()->phone_number }}</td>

								</tr>

								<tr>

									<td class="tab-title">Email</td>

									<td class="tab-value">{{ Auth::user()->email }}</td>

								</tr>

								<tr>

									<td class="tab-title">Address</td>

									<td class="tab-value"> {{ Auth::user()->address }}</td>

								</tr>

								<tr>

									<td class="tab-title">Payment Gateway Account</td>

									<td class="tab-value"> 

										@if($depAccount === 0)

											{{ 'You have not deposited yet' }}

										@else 

											{{ $depAccount }}

										@endif	

									</td>

								</tr>

							</tbody>

						</table> 

					</div>

				</div>

			</div>



			<div class="row pmargin">

				<div class="col-md-12">

					<div class="summary">

						<div class="col-md-10">

							<p class="sum-title">TOTAL <span>SALES</span></p>

							<p class="sum-sub">Monthley Summary Direct referral commision</p>

							<p class="sum-amount">

							@if( !empty($drcIncome))
							
							USD {{ $drcIncome }}
							@else 
							 USD {{ 0 }}
							@endif 

							</p>

						</div>

						<div class="col-md-2">

							&nbsp; <p class="default"><a href="#"></a></p>

							<div id="p-lead-1"></div>



						</div>

							

						&nbsp;

					</div>

				</div>

			</div>



			<div class="row pmargin">

				<div class="col-md-12">

					<div class="summary">

						<div class="col-md-10">

							<p class="sum-title">TOTAL <span>EARNING</span></p>

							<p class="sum-sub">Monthley Summary ( Direct referral commision & Step referral commision)</p>

							<p class="sum-amount">

							@if(!empty($scrIncome))
								USD {{ $srcIncome }}
							@else 
								USD {{ 0 }}
							@endif

							</p>

						</div>

						<div class="col-md-2">

							

							<div id="p-lead-3"></div>

							

						</div>
						
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<p class="default"><a href="#">&nbsp;&nbsp;&nbsp;&nbsp;</a></p>	
					</div>
						
				</div>

			</div>

			

			

		</div> 

	

	<div class="col-md-4">

		@include('partials.right-sidebar')	

	</div>

	

	{{-- space for modal		 --}}



	<!-- Modal -->

	<div class="modal fade" id="myModalNorm" tabindex="-1" role="dialog" 

	     aria-labelledby="myModalLabel" aria-hidden="true">

	    <div class="modal-dialog">

	        <div class="modal-content">

	            <!-- Modal Header -->

	            <div class="modal-header">

	                <button type="button" class="close" 

	                   data-dismiss="modal">

	                       <span aria-hidden="true">&times;</span>

	                       <span class="sr-only">Close</span>

	                </button>

	                <h4 class="modal-title" id="myModalLabel">

	                    User Information

	                </h4>

	            </div>

	            

	            <!-- Modal Body -->

	            <div class="modal-body">

	                

	                {!! Form::open(['url'=>'profile/userinfo']) !!}

	                	<div class="form-group">

	                	  <label for="">Full name</label>

	                	   <input type="text" name="full_name" class="form-control"

	                	        value="{{ Auth::user()->full_name }}" id="exampleInputPassword1" placeholder="Full name"/>

	                	</div>

	                	{!! Form::hidden('id', Auth::id())!!}

	                	

	                	<div class="form-group">

	                	  <label for="">Address</label>

	                	   <input name="address" type="text" class="form-control"

	                	        value="{{ Auth::user()->address }}" id="exampleInputPassword1" placeholder="address"/>

	                	</div>

	                	

		                <button type="submit" class="btn btn-default">Submit</button>

	                </form>

	                

	                

	            </div>

	            

	            <!-- Modal Footer -->

	            <div class="modal-footer">

	                <button type="button" class="btn btn-default"

	                        data-dismiss="modal">

	                            Close

	                </button>

	                <!-- <button type="submit" class="btn btn-primary">

	                    Save changes

	                </button> -->

	            </div>

	        </div>

	    </div>

	</div>



	{{-- second modal for change password	 --}}



	

	  <!-- Modal -->

	  <div class="modal fade" id="myModal" role="dialog">

	    <div class="modal-dialog">

	    

	      <!-- Modal content-->

	      <div class="modal-content">

	        <div class="modal-header">

	          <button type="button" class="close" data-dismiss="modal">&times;</button>

	          <h4 class="modal-title">Password Change Requests</h4>

	        </div>

	        <div class="modal-body">

	          {!! Form::open(['url' => 'profile/password']) !!}

	          		<input type="hidden" name="id" value="{{ Auth::id() }}">

	          		<div class="form-group">

	                	<label for="">Old Password</label>

	                	<input name="old_pass" type="text" class="form-control" id="oldPassword" placeholder=" Old Password"/>

	                </div>

	                <div class="errorMsgPass"></div>

	                <div class="form-group">

	                	<label for="">New Password</label>

	                	<input name="new_pass" type="password" class="form-control" id="pass" placeholder="New Password"/>

	                </div>

	                <div class="form-group">

	                	<label for="">Retype Password</label>

	                	<input name="re_pass" type="password" class="form-control" id="rePass" placeholder="Retype Password"/>

	                </div>

	                <div class="errorMsgRePass"></div>

	                	

		                <button type="submit" class="btn btn-default">Submit</button>

	          {!! Form::close() !!}

	        </div>

	        <div class="modal-footer">

	          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

	        </div>

	      </div>

	      

	    </div>

	  </div>

		    

	

{{-- Third Modal For Secret PIN Message --}}



		  <!-- Modal -->

		  <div class="modal fade" id="myModalPin" role="dialog">

		    <div class="modal-dialog">

		    

		      <!-- Modal content-->

		      <div class="modal-content">

		        <div class="modal-header">

		          <button type="button" class="close" data-dismiss="modal">&times;</button>

		          <h4 class="modal-title">PINs Change Request</h4>

		        </div>

		        <div class="modal-body">

		          {!! Form::open(['url' => 'profile/pin']) !!}

		          		<input type="hidden" name="id" value="{{ Auth::id() }}">

		          		<div class="form-group">

		                	<label for="">Old Secure PIN</label>

		                	<input name="old_pin" type="password" class="form-control" id="oldPin" placeholder="Old PIN"/>

		                </div>

		                <div class="errorMsgPin"></div>

		                <div class="form-group">

		                	<label for="">New Secure PIN</label>

		                	<input name="new_pin" type="password" class="form-control" id="new_pin" placeholder="New Pin"/>

		                </div>

		                	

			                <button type="submit" class="btn btn-default">Submit</button>

		          {!! Form::close() !!}

		        </div>

		        <div class="modal-footer">

		          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

		        </div>

		      </div>

		      

		    </div>

		  </div>

	

	{{-- Forth Modal For Email Change Request Message --}}



			  <!-- Modal -->

			  <div class="modal fade" id="myModalEmail" role="dialog">

			    <div class="modal-dialog">

			    

			      <!-- Modal content-->

			      <div class="modal-content">

			        <div class="modal-header">

			          <button type="button" class="close" data-dismiss="modal">&times;</button>

			          <h4 class="modal-title">Email address Change Request</h4>

			        </div>

			        <div class="modal-body">

			          {!! Form::open(['url' => 'profile/email']) !!}

			          		<input type="hidden" name="id" value="{{ Auth::id() }}">

			          		<div class="form-group">

			          			<label for="">Upline ID</label>

			          			<input name="upline_id" type="text" class="form-control" id="uplineId" placeholder="Upline ID"/>

			          		</div>

			          		<div class="form-group">

			                	<label for="">Current Email Address</label>

			                	<input name="cur_email" type="email" class="form-control" id="curEmail" placeholder="Current Email Address"/>

			                </div>

			                <div class="errorMsgEmail"></div>

			                <div class="form-group">

			                	<label for="">New Email Address</label>

			                	<input name="new_email" type="email" class="form-control" id="newEmail" placeholder="New Email Address"/>

			                </div>

			                	

				                <button type="submit" class="btn btn-default">Submit</button>

			          {!! Form::close() !!}

			        </div>

			        <div class="modal-footer">

			          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

			        </div>

			      </div>

			      

			    </div>

			  </div>	



	{{-- Fifth modal for change phone number	 --}}



	

	  <!-- Modal -->

	    <div class="modal fade" id="myModalPhone" role="dialog">

	      <div class="modal-dialog">

	      

	        <!-- Modal content-->

	        <div class="modal-content">

	          <div class="modal-header">

	            <button type="button" class="close" data-dismiss="modal">&times;</button>

	            <h4 class="modal-title">Contact Number Change Request</h4>

	          </div>

	          <div class="modal-body">

	            {!! Form::open(['url' => 'profile/phone']) !!}

	            		<input type="hidden" name="id" value="{{ Auth::id() }}">

	            		<div class="form-group">

	            			<label for="">Upline ID</label>

	            			<input name="upline_id" type="text" class="form-control" id="uplineId" placeholder="Upline ID"/>

	            		</div>

	            		<div class="form-group">

	                  	<label for="">Current Phone Number </label>

	                  	<input name="cur_phone" type="text" class="form-control" id="curPhone" placeholder="Current phone Number"/>

	                  </div>

	                  <div class="errorMsgPhone"></div>

	                  <div class="form-group">

	                  	<label for="">New Phone Numbers </label>

	                  	<input name="new_phone" type="text" class="form-control" id="newPhone" placeholder="New phone Number"/>

	                  </div>

	                  	

	  	                <button type="submit" class="btn btn-default">Submit</button>

	            {!! Form::close() !!}

	          </div>

	          <div class="modal-footer">

	            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

	          </div>

	        </div>

	        

	      </div>

	    </div>	  	  

		

@endsection



@section('script')

	<script type="text/javascript">

		$(function(){

			var host = window.location.origin;

			function encode(val){
			        var eVal;
			        if(!encodeURIComponent){
			            eVal=escape(val);
			            eVal=eVal.replace(/@/g,"%40");
			            eVal=eVal.replace(/\//g,"%2F");
			            eVal=eVal.replace(/\+/g,"%2B");
			            eVal=eVal.replace(/'/g,"%60");
			            eVal=eVal.replace(/"/g,"%22");
			            eVal=eVal.replace(/`/g,"%27");
			            eVal=eVal.replace(/&/g,"%26");
			        }else{
			            eVal=encodeURIComponent(val);
			            eVal=eVal.replace(/~/g,"%7E");
			            eVal=eVal.replace(/!/g,"%21");
			            eVal=eVal.replace(/\(/g,"%28");
			            eVal=eVal.replace(/\)/g,"%29");
			            eVal=eVal.replace(/'/g,"%27");
			            eVal=eVal.replace(/"/g,"%22");
			            eVal=eVal.replace(/`/g,"%27");
			            eVal=eVal.replace(/&/g,"%26");
			        }
			        return eVal.replace(/\%20/g,"+");
			    }

			$('#rePass').blur(function(){

				var pass = $('#pass').val();

				var rePass = $('#rePass').val();



				if( pass != rePass)

				{

					$('.errorMsgRePass').html('Retype Password does not match.');

					$('#rePass').focus();

					$('.errorMsgRePass').fadeOut(10000);

				}

			});

			

			$('#oldPassword').blur(function(){

				var oldPassword = encode($('#oldPassword').val());

				// alert(oldPassword);

				$.ajax({

					'url': host +'/ajaxPasswordCheck/'+ oldPassword,

					'type': 'get',

					'dataType': 'json'

				}).success(function(data){

					console.log(data);



					// $('.errorMsgPass').html(data);					

					if(data === 'false'){

						$('.errorMsgPass').html('Old password does not match');

						$('#oldPassword').focus();
						$('#oldPassword').val('');

						$('.errorMsgPass').fadeOut(10000);

					}

				});



			});  //passsword end



			$('#oldPin').blur(function(){

				var oldPin = $('#oldPin').val();

				$.ajax({

					'url' : host + '/ajaxPinCheck/' + oldPin,

					'type': 'get',

					'dataType': 'json'

				}).success(function(data){

					console.log(data);

					$('.errorMsgPin').html(data);

					$('.errorMsgPin').fadeOut(10000);



				});

			});  //pin change end



			$('#curEmail').blur(function(){

				var curEmail = $('#curEmail').val();

				// alert(curEmail);

				$.ajax({

					'url' : host + '/ajaxEmailChange/' + curEmail,

					'type' : 'get',

					'dataType': 'json'

				}).success(function(data){

					console.log(data);

					$('.errorMsgEmail').html(data);

					$('.errorMsgEmail').fadeOut(10000);

				});

			}); // Email change end



			$('#curPhone').blur(function(){

				var curPhone = $('#curPhone').val();

				alert(curPhone);

				$.ajax({

					'url' : host + '/ajaxPhoneChange/' + curPhone,

					'type' : 'get',

					'dataType': 'json'

				}).success(function(data){

					console.log(data);

					$('.errorMsgPhone').html(data);

					$('.errorMsgPhone').fadeOut(10000);

				});

			});

			

		});

	</script>

@endsection