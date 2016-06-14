<div class="col-md-4">

            <section class="panel">

            

            <header class="panel-heading">

              Withdrawals History

                <span class="tools pull-right">

                    <a href="javascript:;" class="fa fa-chevron-down"></a>

                    <a href="javascript:;" class="fa fa-times"></a>

                 </span>

            </header>

            <div class="panel-body">

            <div class="adv-table">

            <table  class="display table table-bordered table-striped" id="withdrawalTable">

            <thead>

            <tr>

                <th>Rq. Date</th>

               <!-- <th>Pr. Date</th>-->

                <th>Rq. Amount</th>

                <th>Pr. Amount</th>

                <th>Status</th>

            </tr>

            </thead>

            <tbody>




            @foreach( $withdrawInfos as $withdrawInfo)

            

            <tr class="gradeC">

                <td> {{ date('F d, Y', strtotime($withdrawInfo->request_date)) }} </td>

               <!-- <td> {{ date('F d, Y', strtotime($withdrawInfo->response_date)) }} </td>-->

                <td> USD {{ number_format( $withdrawInfo->amount,2 ) }} </td>

                <td> USD {{ number_format( $withdrawInfo->amount,2 ) }} </td>



                @if($withdrawInfo->status==0)

                    <td> {{ 'Pending' }} </td>

                @elseif($withdrawInfo->status==1) 

                    <td> {{ 'Processed' }} </td>

                @else 

                    <td> {{ 'Canceled' }} </td>    

                @endif

            </tr>

            

            

            @endforeach



            </table>

            </div>

            </div>

            </section>

        </div>



        <div class="col-md-4">

            <section class="panel">

            

            <header class="panel-heading">

                Transactions History

                <span class="tools pull-right">

                    <a href="javascript:;" class="fa fa-chevron-down"></a>

                    <a href="javascript:;" class="fa fa-times"></a>

                 </span>

            </header>

            <div class="panel-body">

            <div class="adv-table">

            <table  class="display table table-bordered table-striped" id="transactionTable">

            <thead>

            <tr>

                <th>Date</th>

                <th>Amount</th>

                <th>Purpose</th>

                <th>From/To</th>

                {{-- <th>Dr/Cr</th> --}}

            </tr>

            </thead>

            <tbody>


            @foreach( $transactionInfos as $transaction)

            <tr>

                <td> {{ $transaction->date }} </td>

                <td> USD {{ number_format($transaction->amount,2) }} </td>

                <td> {{ AppHelper::transactionType($transaction->purpose) }} </td>

                <td> {{ FindUserName::userName($transaction->related_id) }} </td>

            </tr>

            @endforeach

            </tbody>

            </table>

            </div>

            </div>

            </section>

        </div>



        



        