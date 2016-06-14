@extends('layouts.adminMaster')

@section('style')
    <link href="/js/advanced-datatable/css/demo_page.css" rel="stylesheet" />
    <link href="/js/advanced-datatable/css/demo_table.css" rel="stylesheet" />
    <link rel="stylesheet" href="/js/data-tables/DT_bootstrap.css" />

    <style type="text/css">

        .col-md-3 a{
                color:#fff;
            }
        .col-md-3 a:hover{
            color: #fff;
        }    

   </style>
@endsection

@section('body-content')
    
    <div class="row">
        @include('errMsg')
        <div class="col-md-12">
            <section class="panel">
            <header class="panel-heading">
               Email Address / Phone Number Change Request Query List
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
                <th>Username</th>
                <th>Upline ID</th>
                <th>Old Email</th>
                <th>Req Email</th>
                <th>Old Phone</th>
                <th>Req Phone</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            {{--*/ $i=1 /* --}}  <!-- don't delete it -->
            @foreach($ccRequests as $ccRequest)
            <tr>
                <td>{{ $i++ }}</td>
                <td> {{ FindUserName::userName($ccRequest->user_id) }} </td>
                <td> {{ FindUserName::userName($ccRequest->upline_id) }} </td>
                <td> 
                    
                    @if($ccRequest->email != NULL )
                        {{ $ccRequest->email }}
                    @else 
                        {{ '--' }}
                    @endif

                </td>
                <td> 

                    @if($ccRequest->req_email != NULL )
                        {{ $ccRequest->req_email }}
                    @else 
                        {{ '--' }}
                    @endif

                </td>

                <td> 
                    
                    @if($ccRequest->phone != NULL )
                        {{ $ccRequest->phone }}
                    @else 
                        {{ '--' }}
                    @endif

                </td>
                <td> 

                    @if($ccRequest->req_phone != NULL )
                        {{ $ccRequest->req_phone }}
                    @else 
                        {{ '--' }}
                    @endif

                </td>
                
                <td> 
                    @if ($ccRequest->status==0)
                        {{ 'Pending' }} 
                    @else 
                      {{ 'Updated' }}
                    @endif      
                </td>
                <td>
                    <a href="{{ url('/admin/ccRequest/update/'.$ccRequest->id) }}" class="btn btn-md btn-info">Update</a>

                    
                </td>
            </tr>
            @endforeach
            </tbody>
            </table>
            </div>
            </div>
            </section>
        </div> {{-- ccRequestQuery table end --}}
    </div>

    

@endsection


@section('script')
    {!! Html::script('js/advanced-datatable/js/jquery.dataTables.js') !!}
    {!! Html::script('js/data-tables/DT_bootstrap.js') !!}
    <!--dynamic table initialization -->
    {!! Html::script('/js/dynamic_table_init.js') !!}
@endsection

