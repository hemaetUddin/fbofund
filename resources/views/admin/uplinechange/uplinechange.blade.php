@extends('layouts.adminMaster')

@section('style')
	<style type="text/css">
			#result, #nresult{
				color:red;
			}

			.success{
				color:green !important;
			}
	</style>
@endsection


@section('body-content')
	<div class="row">
	        <div class="col-md-6 col-md-offset-3">
	        	@include('formErr')
	        	@include('errMsg')
	            <div class="panel panel-info">
	                <div class="panel-heading">
	                    Upline ID Change
	                </div>
	                <div class="panel-body">
	                    {!! Form::open(['url'=>'admin/manage/uplinechange/request', 'class'=>'form-horizontal bucket-form']) !!}
	                        <div class="form-group">

	                            <div class="col-md-12 col-sm-12 icheck ">
	                                <div class="square-red">
	                                    <div class="radio ">
	                                        {!! Form::radio('carry', 'flashcarries') !!}
	                                        <label>Flash Carries </label>
	                                    </div>
	                                </div>

	                                <div class="square-blue">
	                                    <div class="radio ">
	                                        {!! Form::radio('carry', 'withcarries') !!}
	                                        <label>With Carries </label>
	                                    </div>
	                                </div>

	                            </div>
	                            
	                        </div>
	                        <div class="form-group">
                                <div class="col-md-12">
                                	<label for="exampleInputEmail1">Search User</label>
                                	{!! Form::text('suser','',['id'=>'suser', 'class'=>'form-control','placeholder'=>'Search User'] )!!}

                                	<div id="result"></div>
                                </div>
                                
                            </div>
	                        <div class="form-group">
                                <div class="col-md-12">
                                	<label for="exampleInputEmail1">Existing Upline ID</label>
                                	{{-- <input type="text" class="form-control" id="eupline" name="eupline" placeholder="Existing upline ID"> --}}
                                	{!! Form::text('eupline','',['id'=>'eupline', 'class'=>'form-control','placeholder'=>'Existing upline ID','readonly'=>'readonly'] )!!}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                	<label for="exampleInputEmail1">New Upline ID</label>
                                	{!! Form::text('nupline','',['id'=>'nupline', 'class'=>'form-control','placeholder'=>'New upline ID'] )!!}
                                	<div id="nresult"></div>
                                </div>
                                <div class="col-md-6">
                                	<label for="exampleInputEmail1">Position</label>
                                	{!! Form::text('position','',['id'=>'position', 'class'=>'form-control','placeholder'=>'Position', 'readonly' => 'readonly'] )!!}
                                	<div id="nresult"></div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                            	<div class="col-md-12">
                            		<div class="text-center"><button class="btn btn-primary btn-lg text-center">Submit</button> </div>
                            	</div>
                            </div>
	                    </form>
	                </div>
	            </div>
	        </div>
	    </div>
@endsection


@section('script')
	
	<script type="text/javascript">
	$(function(){
		
		var host = window.location.origin;

		$('#suser').change(function(){
			var suser = $('#suser').val();

			$.ajax({
				'url': host + '/ajaxsearchuser/' + suser,
				'type':'get',
				'dataType' : 'json',
			}).success(function(data){

				// console.log(data);
				// alert(data);

				if(data === "User not found"){
					$('#result').removeClass('success');
					$('#result').html(data);
					$('#nresult').hide(5000);
					$('#suser').val('');
					$('#suser').focus();
				}else{
					$('#result').addClass('success');
					$('#result').html('User found');
					$('#result').hide(10000);
					$('#eupline').val(data[1]);
				}
			});
		});

		$('#nupline').change(function(){
			var nupline= $('#nupline').val();
			// alert(nupline);
			$.ajax({

				'url' : host + '/ajaxCheckNewUpline/'+nupline,
				'type' : 'get',
				'dataType' : 'json' 

			}).success(function(data){
				console.log(data);
				if(data === "User not found"){
					
					$('#nresult').html(data);
					// $('#nresult').removeClass('success');

					$('#nresult').hide(10000);
					$('#nupline').val('');
					$('#nupline').focus();

				}else{

					$('#position').val(data);
					/*$('#nresult').html(data);
					$('#nresult').addClass('success');
					$('#nresult').slideUp(5000);*/

					
				}
			});
		});
	});

	</script>
@endsection