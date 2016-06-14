 {{-- left side start --}}

<div class="left-side sticky-left-side">



    <!--logo and iconic logo start-->

    <div class="logo">

        {!! Html::image('images/logo.png') !!}

    </div>



    <div class="logo-icon text-center">

        {!! Html::image('images/logo_icon.png') !!}

    </div>

    <!--logo and iconic logo end-->



    <div class="left-side-inner">



        <!-- visible to small devices only -->

       


        <!--sidebar nav start-->

        <ul class="nav nav-pills nav-stacked custom-nav">

            

            @if(Auth::user()->roles()->first()->name == 'admin')

            

            <li class="active"><a href="{!! url('admin') !!}"><i class="fa fa-home"></i> <span> Admin Dashboard</span></a>

                <!-- <ul class="sub-menu-list">

                   @if(Auth::user()->roles()->first()->name == 'user') 

                    <li><a href="{!! url('user') !!}"> User Dashboard</a></li>

                   @elseif(Auth::user()->roles()->first()->name == 'admin') 

                    <li class="active"><a href="{!! url('admin') !!}"> Admin Dashboard</a></li>

                   @endif 

                </ul> -->

            </li>



            @elseif(Auth::user()->roles()->first()->name == 'user') 

            <li class="active"><a href="{!! url('user') !!}"><i class="fa fa-home"></i> <span> User Dashboard</span></a></li>

            @endif

            

            <li class="menu-list"><a href=""><i class="fa fa-money"></i> <span class="hide-anchor">Accounts</span></a>

                

                @if(Auth::user()->roles()->first()->name == 'admin')

                

                <ul class="sub-menu-list">

                    <li><a href="{{ url('admin/withdrawal') }}"> Confirm Withdrawal</a></li>

                    <li><a href="{{ url('admin/transfer') }}"> Internal Transfer</a></li>

                    <li><a href="{{ url('admin/roiprocess') }}"> ROI Process</a></li>

                    <li><a href="{{ url('admin/stepreferral') }}"> Step Referral Comission</a></li>

                </ul>

                

                @elseif(Auth::user()->roles()->first()->name == 'user')

                    @if(Auth::user()->status != 0)
                    

                        <ul class="sub-menu-list">

                            <li><a href="{{ url('user/deposit') }}"> Make Deposit</a></li>

                            <li><a href="{{ url('user/withdrawal') }}"> Request Withdrawal</a></li>

                            <li><a href="{{ url('user/transfer') }}"> Internal Transfer</a></li>

                        </ul>
                    

                    @endif



                @endif



            </li>

            <li class="menu-list"><a href=""><i class="fa fa-flag-checkered"></i> <span class="hide-anchor">Reports</span></a>

                @if(Auth::user()->roles()->first()->name == 'admin')



                <ul class="sub-menu-list">

                    <li><a href="{{ url('/admin/reports/deposit') }}"> Deposit History</a></li>

                    <li><a href="{{ url('/admin/reports/withdrawl') }}"> Withdrawal History</a></li>

                    <li><a href="{{ url('/admin/reports/transaction') }}"> Transaction Details </a></li>

                    <li><a href="{{ url('/admin/reports/drc') }}"> Direct Referral Comission History</a></li>

                    <li><a href="{{ url('/admin/reports/src') }}"> Step Referral Comission History</a></li>

                    <li><a href="{{ url('/admin/reports/payment') }}"> Monthly Payments History</a></li>

                </ul>



                @elseif(Auth::user()->roles()->first()->name == 'user')

                    @if(Auth::user()->status != 0)

                    <ul class="sub-menu-list">

                        <li><a href="{{ url('userReports/deposit') }}"> Deposit History</a></li>

                        <li><a href="{{ url('userReports/withdrawal') }}"> Withdrawal History</a></li>

                        <li><a href="{{ url('userReports/transaction') }}"> Transaction Details </a></li>

                        <li><a href="{{ url('userReports/earning') }}"> Earning Details</a></li>

                        <li><a href="{{ url('userReports/drcreport') }}"> Direct Referral Commission</a></li>

                        <li><a href="{{ url('userReports/srcreport') }}"> Step Referral Commission</a></li>

                        <li><a href="{{ url('userReports/downline') }}"> Downline Members</a></li>

                    </ul>

                    @endif



                @endif



            </li>

            {{-- <li class="menu-list"><a href=""><i class="fa fa-cogs"></i> <span>Components</span></a>

                <ul class="sub-menu-list">

                    <li><a href="grids.html"> Grids</a></li>

                    <li><a href="gallery.html"> Media Gallery</a></li>

                    <li><a href="calendar.html"> Calendar</a></li>

                    <li><a href="tree_view.html"> Tree View</a></li>

                    <li><a href="nestable.html"> Nestable</a></li>



                </ul>

            </li> --}}



            @if(Auth::user()->roles()->first()->name == 'admin')

                <li class="menu-list"><a href=""><i class="fa fa-user"></i> <span>Manage User</span></a>
                    <ul class="sub-menu-list">

                        <li><a href="{{ url('admin/manage/uesr')}}"> Email/Phone Change Request</a></li>

                        <li><a href="{{ url('/admin/manage/uplinechange') }}">Upline ID Change</a></li>

                    </ul>
                </li>    

                <li><a href="{{ url('referralTree/'.Auth::user()->username) }}"><i class="fa fa-group"></i> <span>Referral Tree</span></a></li>



                {{-- <li><a href="{{ url('user/register')}}"><i class="fa fa-user"></i> <span>Join a Member</span></a></li> --}}

                



                {{-- <li><a href="fontawesome.html"><i class="fa fa-briefcase"></i> <span>Business Concept</span></a></li> --}}



                <li><a href="fontawesome.html"><i class="fa fa-briefcase"></i> <span>User Permission</span></a></li>

            

            @elseif(Auth::user()->roles()->first()->name == 'user')



                <li><a href="{{ url('referralTree/'.Auth::user()->username) }}"><i class="fa fa-group"></i> <span>Referral Tree</span></a></li>


                <li><a href="{{ url('user/register')}}"><i class="fa fa-user"></i> <span>Join a Member</span></a></li>


            @endif


        </ul>

        <!--sidebar nav end-->



    </div>

</div>

<!-- left side end