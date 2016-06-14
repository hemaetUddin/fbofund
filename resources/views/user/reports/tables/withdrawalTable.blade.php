<div class="col-md-8">
    <section class="panel">
    
    <header class="panel-heading">
        Withdrawal History Report
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
        <th>Request Date</th>
        <th>Approval Date</th>
        <th>Amount</th>
        <th>Withdrawal Amount</th>
        <th>Status</th>
    </tr>
    </thead>
    <tbody>

     
     {{--*/ $i = 1 /*--}}
    @foreach( $withdrawInfos as $withdrawInfo)
    
    <tr class="gradeC">
        <td> {{ $i++ }} </td>
        <td> {{ date('F d, Y', strtotime($withdrawInfo->request_date)) }} </td>
        <td> {{ date('F d, Y', strtotime($withdrawInfo->response_date)) }} </td>
        <td> USD {{ number_format( $withdrawInfo->amount,2 ) }} </td>
        <td> USD {{ number_format( $withdrawInfo->amount,2 ) }} </td>

        @if($withdrawInfo->status==0)
            <td> {{ 'Pending' }} </td>
        @else
            <td> {{ 'Accepted' }} </td>
        @endif
    </tr>
    
   
    @endforeach

   
    </table>
    </div>
    </div>
    </section>
</div>