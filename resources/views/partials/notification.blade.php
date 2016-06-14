<!--notification menu start -->

<div class="menu-right">

    <ul class="notification-menu">

    @if(Auth::user()->roles()->first()->name == 'user')
        {{-- <li>

            <a href="#" class="btn btn-default dropdown-toggle info-number" data-toggle="dropdown">

                <i class="fa fa-tasks"></i>

                <span class="badge">8</span>

            </a>

            <div class="dropdown-menu dropdown-menu-head pull-right">

                <h5 class="title">You have 8 pending task</h5>

                <ul class="dropdown-list user-list">

                    <li class="new">

                        <a href="#">

                            <div class="task-info">

                                <div>Database update</div>

                            </div>

                            <div class="progress progress-striped">

                                <div style="width: 40%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" role="progressbar" class="progress-bar progress-bar-warning">

                                    <span class="">40%</span>

                                </div>

                            </div>

                        </a>

                    </li>

                    <li class="new">

                        <a href="#">

                            <div class="task-info">

                                <div>Dashboard done</div>

                            </div>

                            <div class="progress progress-striped">

                                <div style="width: 90%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="90" role="progressbar" class="progress-bar progress-bar-success">

                                    <span class="">90%</span>

                                </div>

                            </div>

                        </a>

                    </li>

                    <li>

                        <a href="#">

                            <div class="task-info">

                                <div>Web Development</div>

                            </div>

                            <div class="progress progress-striped">

                                <div style="width: 66%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="66" role="progressbar" class="progress-bar progress-bar-info">

                                    <span class="">66% </span>

                                </div>

                            </div>

                        </a>

                    </li>

                    <li>

                        <a href="#">

                            <div class="task-info">

                                <div>Mobile App</div>

                            </div>

                            <div class="progress progress-striped">

                                <div style="width: 33%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="33" role="progressbar" class="progress-bar progress-bar-danger">

                                    <span class="">33% </span>

                                </div>

                            </div>

                        </a>

                    </li>

                    <li>

                        <a href="#">

                            <div class="task-info">

                                <div>Issues fixed</div>

                            </div>

                            <div class="progress progress-striped">

                                <div style="width: 80%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="80" role="progressbar" class="progress-bar">

                                    <span class="">80% </span>

                                </div>

                            </div>

                        </a>

                    </li>

                    <li class="new"><a href="">See All Pending Task</a></li>

                </ul>

            </div>

        </li> --}} {{-- pending task --}}

       {{--  <li>

            <a href="#" class="btn btn-default dropdown-toggle info-number" data-toggle="dropdown">

                <i class="fa fa-envelope-o"></i>

                <span class="badge">5</span>

            </a>

            <div class="dropdown-menu dropdown-menu-head pull-right">

                <h5 class="title">You have 5 Mails </h5>

                <ul class="dropdown-list normal-list">

                    <li class="new">

                        <a href="">

                            <span class="thumb">{!! Html::image('images/photos/user1.png') !!}</span>

                            <span class="desc">

                              <span class="name">John Doe <span class="badge badge-success">new</span></span>

                              <span class="msg">Lorem ipsum dolor sit amet...</span>

                            </span>

                        </a>

                    </li>

                    <li>

                        <a href="">

                            <span class="thumb">{!! Html::image('images/photos/user2.png') !!}</span>

                            <span class="desc">

                              <span class="name">Jonathan Smith</span>

                              <span class="msg">Lorem ipsum dolor sit amet...</span>

                            </span>

                        </a>

                    </li>

                    <li>

                        <a href="">

                            <span class="thumb">{!! Html::image('images/photos/user3.png') !!}</span>

                            <span class="desc">

                              <span class="name">Jane Doe</span>

                              <span class="msg">Lorem ipsum dolor sit amet...</span>

                            </span>

                        </a>

                    </li>

                    <li>

                        <a href="">

                            <span class="thumb">{!! Html::image('images/photos/user4.png') !!}</span>

                            <span class="desc">

                              <span class="name">Mark Henry</span>

                              <span class="msg">Lorem ipsum dolor sit amet...</span>

                            </span>

                        </a>

                    </li>

                    <li>

                        <a href="">

                            <span class="thumb">{!! Html::image('images/photos/user5.png') !!}</span>

                            <span class="desc">

                              <span class="name">Jim Doe</span>

                              <span class="msg">Lorem ipsum dolor sit amet...</span>

                            </span>

                        </a>

                    </li>

                    <li class="new"><a href="">Read All Mails</a></li>

                </ul>

            </div>

        </li> --}}

        <li>
                

            @if(count( SupportHelper::supports(Auth::id()) ) !=0 )
                <a href="#" class="btn btn-default dropdown-toggle info-number" data-toggle="dropdown">

                <i class="fa fa-bell-o"></i>

                <span class="badge">{{ count( SupportHelper::supports(Auth::id()) )}}</span>

                </a>
            @else 
                <a href="#" class="btn btn-default dropdown-toggle info-number" data-toggle="dropdown">

                <i class="fa fa-bell-o"></i>

                </a>
            @endif

            <div class="dropdown-menu dropdown-menu-head pull-right">

                <h5 class="title">Notifications</h5>

                <ul class="dropdown-list normal-list">

                
                    
                    @foreach(SupportHelper::supports(Auth::id()) as $support)
                    
                    <li class="new">

                        <a href="{{ url('user/support/view/'.$support->id) }}">

                            <span class="label label-danger"><i class="fa fa-bolt"></i></span>

                            <span class="name">{{ $support->subject }} </span>

                            {{-- <em class="small"> {{ \Carbon\Carbon::now()->subDays(2)->diffForHumans() }}</em> --}}

                        </a>

                    </li>
                    @endforeach

                    <!-- <li class="new">
                    
                        <a href="">
                    
                            <span class="label label-danger"><i class="fa fa-bolt"></i></span>
                    
                            <span class="name">Server #3 overloaded.  </span>
                    
                            <em class="small">1 hrs</em>
                    
                        </a>
                    
                    </li>
                    
                    <li class="new">
                    
                        <a href="">
                    
                            <span class="label label-danger"><i class="fa fa-bolt"></i></span>
                    
                            <span class="name">Server #5 overloaded.  </span>
                    
                            <em class="small">4 hrs</em>
                    
                        </a>
                    
                    </li>
                    
                    <li class="new">
                    
                        <a href="">
                    
                            <span class="label label-danger"><i class="fa fa-bolt"></i></span>
                    
                            <span class="name">Server #31 overloaded.  </span>
                    
                            <em class="small">4 hrs</em>
                    
                        </a>
                    
                    </li> -->

                    <li class="new"><a href="{{ url('user/support/allnotification')}}">See All Notifications</a></li>

                </ul>

            </div>

        </li>

        @endif

        <li>

            <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown">

                {{-- {!! Html::image('images/photos/user-avatar.png') !!} --}}

                <span><i class="fa fa-user fa-2x"></i> </span>

                @if(Auth::user())

                {{ Auth::user()->username }}

                @endif



                <span class="caret"></span>

            </a>

            <ul class="dropdown-menu dropdown-menu-usermenu pull-right">

                <li><a href="{{ url( 'profile' )}}"><i class="fa fa-user"></i>  Profile</a></li>

                {{-- <li><a href="#"><i class="fa fa-cog"></i>  Settings</a></li> --}}

                <li><a href="{{ url('auth/logout') }}"><i class="fa fa-sign-out"></i> Log Out</a></li>

            </ul>

        </li>



    </ul>

</div>

<!--notification menu end -->