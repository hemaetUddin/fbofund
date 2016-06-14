<div class="row">

    <div class="col-md-12">

        <div class="panel panel-custom">

            <div class="panel-heading">

                <a href="{{ url('userReports/transaction') }}" class="right-menu"><span><i class="fa fa-credit-card"></i></span>&nbsp; Transaction History</a>

                <span class="tools pull-right"></span>

            </div>

        </div>

    </div>

</div>

<div class="row">

    <div class="col-md-12">

        <div class="panel panel-custom">

            <div class="panel-heading">

                <a href="{{ url('userReports/withdrawal') }}" class="right-menu"><span><i class="fa fa-check-square-o"></i></span>&nbsp; Withdrawal History</a>

                <span class="tools pull-right">

                    {{-- <a href="javascript:;" class="fa fa-chevron-down"></a> --}}

                    {{-- <a href="javascript:;" class="fa fa-times"></a> --}}

                 </span>

            </div>

            {{-- <div class="panel-body">

                <div class="widthdraw-form">

                    Panel Contents

                </div>

            </div> --}}

        </div>

    </div>

</div>



<div class="row">

    

    <div class="col-md-12">

        <div class="panel panel-custom">

            <div class="panel-heading">

                <a href="{{ url('user/transfer') }}" class="right-menu"><span><i class="fa fa-exchange"></i></span> &nbsp; Balance Transfer </a>

                <span class="tools pull-right">

                </span>

            </div>

            

        </div>

    </div> 

</div>

<div class="row">

	<div class="col-md-12">

		<div class="account-overview">

			<table class="table">

				<thead>

					<tr>

						<td colspan="1"> <p class="t-tile">Account Over View</p></td>

					</tr>

				</thead>

				<tbody>

					<tr>

						<td>User Name</td>

						<td>{{ Auth::user()->username }}</td>

					</tr>

					<tr>

						<td>Account Status</td>

						@if( Auth::user()->status == 0)

							<td>{{ 'Inactive' }}</td>

						@else 

							<td>{{ 'Active' }}</td>

						@endif

					</tr>

					<tr>

						<td>Last Sign In </td>

						<td>{{ date('Y-m-d / H.i', strtotime(Auth::user()->last_login_time))  }} (UTC)</td>

					</tr>

				</tbody>

			</table>

		</div>

	</div>

</div> {{-- Acccount overview end --}}

<div class="row margin-top">

	<div class="col-md-12">

		<section class="panel">

			

			<header class="panel-heading">

				Support Tickets

				<span class="tools pull-right">

					<a href="javascript:;" class="fa fa-chevron-down"></a>

					<a href="javascript:;" class="fa fa-times"></a>

				</span>

			</header>

			<div class="panel-body">

				
				{!! Html::image('images/technical.png','',['class' => 'support-img img-responsive']) !!}

				{!! Form::open(['url'=>'user/support', 'class'=>'form-horizontasl']) !!}

				<div class="form-group">

					{{-- <label>Subject</label> --}}

					{!! Form::text('subject','',['id'=>'subject','class'=>'form-control support-sub','placeholder' => 'Subject', 'required'=>'required']) !!}


				</div>

				<div class="form-group">

					{{-- <label>Problem Details</label> --}}

					<textarea class="form-control support-msg" name="problem_details" placeholder="Problem details" required="required"></textarea>
					{{-- {!! Form::textarea('problem_details',['form-control support-msg','placeholder'=>'Problem details','required'=>'required']) !!} --}}

				</div>

				<div class="form-group text-center">

					<button class="btn btn-info btn-lg text-center"><i class="fa fa-paper-plane-o"></i> &nbsp; Submit</button>

				</div> 

				{!! Form::close() !!}

			</div>

		</section>

	</div>

</div>