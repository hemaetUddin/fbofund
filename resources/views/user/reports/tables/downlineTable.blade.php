<div class="col-md-8">
    <section class="panel">
    
    <header class="panel-heading">
        Downline Members
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
        <th>Left Member</th>
        <th>Referrar</th>
        <th>Right Member</th>
        <th>Referrar</th>
        <th>Joining Date</th>
        <th>Deposit Amount</th>
    </tr>
    </thead>
    <tbody>
    {{--*/ $i=1 /* --}}  <!-- don't delete it -->
    
    {!! $tdata !!}

    </tbody>
    <!-- <tfoot>
    <tr>
        <th>Total Earned</th>
        <td>{{ "Hello" }}</td>
        <td>--</td>
        <td class="hidden-phone">--</td>
    </tr>
    </tfoot> -->
    </table>
    </div>
    </div>
    </section>
</div>