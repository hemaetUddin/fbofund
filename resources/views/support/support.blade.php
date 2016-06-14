@extends('layouts.adminMaster')

@section('style')
	{!! Html::style('css/custom.css') !!}

	<link href="/js/advanced-datatable/css/demo_page.css" rel="stylesheet" />
	<link href="/js/advanced-datatable/css/demo_table.css" rel="stylesheet" />
	<link rel="stylesheet" href="/js/data-tables/DT_bootstrap.css" />
@stop

@section('body-content')
	<div class="row">
        <div class="col-md-12">
            <section class="panel">
                <header class="panel-heading">
                    {{ $support->subject }} <br/>
                    <span class="sup-user"><i class="fa fa-user"></i> {{ FindUserName::userName( $support->user_id)}} </span>
                    <span class="sup-date"><i class="fa fa-calendar"></i> {{ date('Y-m-d', strtotime($support->request_date)) }} </span>
                    <span class="tools pull-right">
                        {{-- <a class="fa fa-chevron-down" href="javascript:;"></a> --}}
                        {{-- <a class="fa fa-times" href="javascript:;"></a> --}}
                     </span>
                </header>
                <div class="panel-body">
                     {{ $support->problem_details }}
                     <hr>

                     
                     {!! Form::open([ 'url' => 'admin/support/response', 'class' => 'form-horizontal']) !!}
                         {{-- <div class="form-group">
                             <div class="col-sm-12">
                                 <input type="text" name="subject" id="subjcet" class="form-control" placeholder="Subject">
                             </div>
                         </div> --}}
                         {!! Form::hidden('id', $support->id) !!}
                         <div class="form-group">
                             <div class="col-sm-12">
                             	{!! Form::textarea('editor1', '', ['class'=> 'form-control ckeditor', 'placeholder' => 'Type a message here...']) !!}
                             </div>

                             {{-- <div class="col-sm-12">
                                 <textarea placeholder="Type a message here..." class="form-control ckeditor" name="editor1" rows="6"></textarea>
                             </div> --}}
                         </div>
                         <div class="form-group">
                             <div class="col-sm-12">
                                 <input type="submit" value="Response" class="btn btn-primary pull-right">
                             </div>
                         </div>
                     {!! Form::close() !!}
                </div>
            </section>                        
        </div>
    </div>
@stop


@section('script')
	
    {!! Html::script('js/ckeditor/ckeditor.js') !!}
    
    
    
    

    
@stop

