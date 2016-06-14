@extends('layouts.adminMaster')

@section('style')
	{!! Html::style('css/custom.css') !!}
@endsection



@section('body-content')
	
	<div class="row">

		<div class="col-md-8">
			<div class="row">
					<div class="col-md-12">
					    <section class="panel">
					    <header class="panel-heading">
					        All Notifications
					        <span class="tools pull-right">
					            <a href="javascript:;" class="fa fa-chevron-down"></a>
					            <a href="javascript:;" class="fa fa-times"></a>
					         </span>
					    </header>
					    <div class="panel-body">
					    <div class="adv-table">
					    <table  class="display table table-bordered table-striped" id="dynamic-table">
					    <thead>
					    <tr>
					        <th>Serial No.</th>
					        {{-- <th>Username</th> --}}
					        <th>Subject</th>
					        {{-- <th>Details</th> --}}
					        <th>Status</th>
					        <th>Actions</th>
					    </tr>
					    </thead>
					    <tbody>
					    {{--*/ $i=1 /* --}}  <!-- don't delete it -->
					    @foreach($allNots as $allnot)
					    <tr>
					        <td>{{ $i++ }}</td>
					        <td> {{ str_limit($allnot->subject,50) }} </td>
					        <td> 
					            @if ($allnot->status==0)
					                {{ 'Pending' }} 
					            @elseif($allnot->status==1) 
					              {{ 'Replied' }}
					            @else 
					            	{{ 'Viewed'}}  
					            @endif      
					        </td>
					        <td>
					            <a href="{{ url('user/support/view/'.$allnot->id) }}" class="btn btn-md btn-info">View</a>
					        </td>
					    </tr>
					    @endforeach
					    </tbody>
					    </table>
					    </div>
					    </div>
					    </section>
					</div> {{-- supportQuery table end --}}
				    
			</div>
			
			

		</div>
	    <div class="col-md-4">
	    	@include('partials.right-sidebar')
	    </div>
	</div>

@endsection



@section('script')
	{!! Html::script('js/advanced-datatable/js/jquery.dataTables.js') !!}
    {!! Html::script('js/data-tables/DT_bootstrap.js') !!}
    <!--dynamic table initialization -->
    {!! Html::script('js/dynamic_table_init.js') !!}
@endsection