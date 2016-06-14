<div class="col-md-8">

    <section class="panel">

    

    <header class="panel-heading">

        MONTHLY RETERN OF INVEST (ROI) SCHEDULE 

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

        {{-- <th>Deposited Amount</th> --}}

        <th>Payable Amount</th>

        <th>Next Payment Date</th>

        <th>ROI Terms</th>

        <th>Status</th>

    </tr>

    </thead>

    <tbody>

    @if($roiSchedules)

        @foreach( $roiSchedules as $roiSchedule)

            <tr>

                <td>{{ $roiSchedule->amount }}</td>

                <td>{{  date('F d, Y', strtotime($roiSchedule->pmnt_date)) }}</td>

                <td>{{ $roiSchedule->terms }}</td>

                <td>

                    @if($roiSchedule->status == 0)

                    {{ 'Unpaid'}}

                    @else

                    {{ 'Paid' }}

                    @endif

                </td>

            </tr>

        @endforeach

    @else 

    {{ 'NOTHING'}}

    @endif

    


    </tbody>

    </table>

    </div>

    </div>

    </section>

</div>

<div class="col-md-4">
    <section class="panel">
    
    <header class="panel-heading">
        Support Tickets
        <span class="tools pull-right">
            <a href="javascript:;" class="fa fa-chevron-down"></a>
            <a href="javascript:;" class="fa fa-times"></a>
         </span>
    </header>
    <div class="panel-body">
    @include('formErr')
        {!! Html::image('/images/technical.png','' ,['class' => 'support-img img-responsive']) !!}
        {!! Form::open(['url'=>'user/support']) !!}
            <div class="form-group">
                {{-- <label>Subject</label> --}}
                <input type="text" name="subject" id="" class="form-control" placeholder="Subject">
            </div>
            <div class="form-group">
                {{-- <label>Problem Details</label> --}}
                <textarea class="form-control sup-msg" name="problem_details" placeholder="Problem details"></textarea>
            </div>
        <div class="form-group text-center">
            <button class="btn btn-info btn-lg text-center"><i class="fa fa-paper-plane-o"></i> &nbsp; Submit</button>

        </div> 
        {!! Form::close() !!}
    </div>
    </section>
</div>




