<div class="col-md-6">
    <section class="panel">
    
    <header class="panel-heading">
        Deposit History Report
        <span class="tools pull-right">
            <a href="javascript:;" class="fa fa-chevron-down"></a>
            <a href="javascript:;" class="fa fa-times"></a>
         </span>
    </header>
    <div class="panel-body">
            @if( $depositHistory)
                <div class="adv-table">
                    <table  class="display table table-bordered table-striped" id="dynamic-table">
                        <tr>
                            <th>Date</th>
                            <td>{{ date('F d, Y', strtotime( $depositHistory->rcvd_date )) }}</td>
                        </tr>
                        <tr>
                            <th>Amount</th>
                            <td> {{ $depositHistory->amount }}</td>
                        </tr>
                        <tr>
                            <th>Deposit With</th>
                            @if( $depositHistory->pmnt_account == 'Wallet Balance')
                            <td> {{ $depositHistory->pmnt_account }} </td>
                            @else
                            <td> {{ $depositHistory->pmnt_account }} (pm) </td>
                            @endif
                        </tr>                    
                    </table>
                </div>
            @else 
            @if( $depositHistory ==0 )
            <div class="adv-table">
                <div class="noroitable">
                    <p>You have not yet deposited, deposit in FBO Corporation. To Start getting tremendious ROI on Schedule.</p>
                </div>                    
                
            </div>
            @endif
            @endif    

        
    </div>
    </section>
</div>