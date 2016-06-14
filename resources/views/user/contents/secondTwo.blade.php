<div class="col-md-8">

    <section class="panel">

    

    <header class="panel-heading">

        MONTHLY RETERN OF INVEST (ROI) SCHEDULE

        <span class="tools pull-right">

            <a href="javascript:;" class="fa fa-chevron-down"></a>

            <a href="javascript:;" class="fa fa-times"></a>

         </span>

    </header>

    <div class="panel-body" id="roiPanel">

    <div class="noroitable">

        <p> You have not yet deposited, deposit in FBO Corporation. To Start getting tremendious ROI on Schedule. </p>

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

        {!! Html::image('/images/technical.png','' ,['class' => 'support-img img-responsive']) !!}

        {!! Form::open(['url'=>'user/support']) !!}

            <div class="form-group">

                {{-- <label>Subject</label> --}}

                <input type="text" name="subject" id="" class="form-control" placeholder="Subject">

            </div>

            <div class="form-group">

                {{-- <label>Problem Details</label> --}}

                <textarea class="form-control support-msg" name="problem_details" placeholder="Problem details"></textarea>

            </div>

        <div class="form-group text-center">

            <button class="btn btn-info btn-lg text-center"><i class="fa fa-paper-plane-o"></i> &nbsp; Submit</button>

        </div> 

        {!! Form::close() !!}

    </div>

    </section>

</div>



