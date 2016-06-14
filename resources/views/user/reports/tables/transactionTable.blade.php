<div class="col-md-8">
    <section class="panel">
    
    <header class="panel-heading">
        Transaction Details Report
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
        <th>Transaction Date</th>
        <th>Amount</th>
        <th>Purpose</th>
        <th>Form / To Member</th>
        <th>DR / CR </th>
    </tr>
    </thead>
    <tbody>

     
     {{--*/ $i = 1 /*--}}
    @foreach( $transactionInfos as $transactionInfo)
    
    <tr class="gradeC">
        <td> {{ $i++ }} </td>
        <td> {{ $transactionInfo->date }} </td>
        <td> USD {{ number_format($transactionInfo->amount,2) }} </td>
        <td> {{ AppHelper::transactionType($transactionInfo->purpose) }} </td>
        <td> {{ FindUserName::userName($transactionInfo->related_id) }} </td>
        @if($transactionInfo->sign== '+')
            <td> {{ 'Cr' }} </td>
        @else
            <td> {{ 'Dr' }} </td>
        @endif
    </tr>
    
   
    @endforeach

    <!-- <tr class="gradeA">
        <td>Trident</td>
        <td>Internet
            Explorer 5.5</td>
        <td>Win 95+</td>
        <td class="center hidden-phone">5.5</td>
        <td class="center hidden-phone">A</td>
        <td>Trident</td>
    </tr>
    
    </tbody>
    <tfoot>
    <tr>
        <th>Rendering engine</th>
        <th>Browser</th>
        <th>Platform(s)</th>
        <td>Trident</td>
        <th class="hidden-phone">Engine version</th>
        <th class="hidden-phone">CSS grade</th>
    </tr>
    </tfoot> -->
    </table>
    </div>
    </div>
    </section>
</div>