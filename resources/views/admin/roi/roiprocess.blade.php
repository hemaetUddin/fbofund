@extends('layouts.adminMaster')

@section('style')
	<style type="text/css">
		.step-gen{
			margin-top:10em;
			margin-bottom: 15em;

		}
		.src-icon{
			text-align: center !important;
			font-size: 4.2em;
			padding-left: 2em;
			color: #53bc94;
		}
		.message ul li{
			list-style: none;
			padding-bottom: .25em;
		}
		
	</style>
@endsection

@section('page-header')

@endsection

@section('body-content')
	<div class="step-gen">
		<div class="col-md-4 col-md-offset-4">

			@if(session('message'))
				<div class="alert alert-danger fade in message">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<ul>
					  <li>{{ session('message') }}</li>
					</ul>
				</div>
			@endif	
			@if(session('message0'))
				<div class="alert alert-success fade in message">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<ul>
					  <li>{{ session('message0') }}</li>
					  <li>{{ session('message1') }}</li>
					  <li>{{ session('message2') }}</li>
					</ul>
				</div>
			@endif
			
		</div> 
		<div class="col-md-4 col-md-offset-4">
		    <div class="panel widget-info-one">
		        <div class="avatar-img">
		            {{-- <img src="/images/gallery/image3.jpg" alt=""/> --}}
		            <span class="pull-center src-icon"><i class="fa fa-usd fa-5x"></i></span>  
		        </div>
		        <div class="inner">
		            <a href="{{url('admin/roiprocess/roigenerate')}}"><button class="btn btn-primary btn-lg">Generate Return of Invest</button></a> 
		        </div>
		        <div class="panel-footer">
		            <ul class="post-view">
		                <li>
		                    <a href="#">
		                        <i class="fa fa-calendar"></i>
		                    </a>
		                    Date
		                </li>
		                <li class="active">
		                    {{ date('Y-m-d') }}
		                </li>
		                <li>
		                    <a href="#">
		                        <i class="fa fa-clock-o"></i>
		                    </a>
		                    {{ date('H:m:s')}}
		                </li>
		            </ul>
		        </div>
		    </div>
		</div>
	</div>
@endsection

@section('script')

@endsection
