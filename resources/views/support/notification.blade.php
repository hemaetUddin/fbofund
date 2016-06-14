@extends('layouts.adminMaster')

@section('style')
	{!! Html::style('css/custom.css') !!}
@endsection



@section('body-content')

	<div class="row">
	    <div class="col-md-8">
	        <div class="panel panel-info">
	            <div class="panel-heading">
	                {{ $notification->subject }}
	                <span class="tools pull-right">
	                    <a href="javascript:;" class="fa fa-chevron-down"></a>
	                    <a href="javascript:;" class="fa fa-times"></a>
	                 </span>
	            </div>
	            <div class="panel-body">
	                {!! $notification->response !!}
	            </div>
	        </div>
	    </div>
	    <div class="col-md-4">
	    	@include('partials.right-sidebar')
	    </div>
	</div>

@endsection



@section('script')
@endsection