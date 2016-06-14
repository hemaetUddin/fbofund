<div class="col-md-8">
    <section class="panel">
    
    <header class="panel-heading">
        Earning Details Report
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
        <th>Earned Amount</th>
        <th>Purpose</th>
        <th>Referred Member</th>
        <th>Earning Date</th>
    </tr>
    </thead>
    <tbody>
    
        {{--*/ $i=1 /* --}}  <!-- don't delete it -->
    @foreach( $earningInfos as $earnInfo)
        <tr>
            <td> {{ $i++ }} </td>
            <td> USD {{ number_format($earnInfo->amount,2) }} </td>
            <td> {{ AppHelper::transactionType($earnInfo->purpose) }} </td>
            <td> {{ FindUserName::userName($earnInfo->related_id) }} </td>
            <td> {{ $earnInfo->date }} </td>
        </tr>
    @endforeach

    </tbody>
    <tfoot>
    <tr>
        <th>Total Earned</th>
        <th>USD {{ number_format($total,2) }}</th>
        <td>--</td>
        <td class="hidden-phone">--</td>
        <td class="hidden-phone">--</td>
    </tr>
    </tfoot>
    </table>
    </div>
    </div>
    </section>
</div>