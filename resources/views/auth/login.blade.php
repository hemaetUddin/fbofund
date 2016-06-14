<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

    <meta name="description" content="">

    <link rel="shortcut icon" href="#" type="image/png">



    <title>Login</title>



    {!! Html::style('/css/style.css') !!}

    {!! Html::style('/css/style-responsive.css') !!}

    {!! Html::style('/css/custom.css') !!}



    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

    <!--[if lt IE 9]>

    {!! Html::script('js/html5shiv.js') !!}

    {!! Html::script('js/respond.min.js') !!}

    <![endif]-->



</head>



<body class="login-body">





<div class="row">


    <div class="container">

        <div class="login">
            <div class="row pmargin">
                <div class="col-md-4 col-md-offset-4">
                    @include('errMsg') 

                    @if (count($errors) > 0)

                        <div class="alert alert-danger">

                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                            <ul>

                                @foreach ($errors->all() as $error)

                                    <li>{{ $error }}</li>

                                @endforeach

                            </ul>

                        </div>

                    @endif
                    @if(Session::get('warning'))

                        <div class="alert alert-danger">

                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                            <ul>

                                <li>{{ Session::get('warning') }}</li>

                            </ul>

                        </div>

                    @endif
                </div>
            </div>

    
            {!! Form::open(['url'=>'auth/login', 'class'=>'form-signin', 'method'=>'post']) !!}
            

                {!! csrf_field() !!}

                <div class="form-signin-heading text-center">

                    {{-- <h1 class="sign-title">Sign In</h1> --}}

                    {!! Html::image('/images/login-logo.png') !!}

                </div>

                <div class="login-wrap">

                    {!! Form::text('username','',['class'=>'form-control log-input','placeholder'=>'User ID', 'autofocus'=>'autofocus']) !!}

                    {!! Form::password('password',['class'=>'form-control log-input','placeholder'=>'Password']) !!}

                    {!! Form::submit('log in',['class'=>'btn btn-lg btn-login btn-block']) !!}

                    

                    {{-- <button class="btn btn-lg btn-login btn-block" type="submit">

                        <i class="fa fa-check"></i>

                    </button> --}}



                    <div class="registration">

                        

                        <a data-toggle="modal" href="#myModal"> Forgot Password?</a>

                    </div>

                    <label class="checkbox">

                        <span class="pull-right">

                            

                        </span>

                    </label>



                </div>



                

            {!! Form::close() !!}

        </div>

    </div>

</div> 
<!-- <div class="row">
    <div class="col-md-4 col-md-offset-4">
        
    
        
    </div>
</div> 
 -->



<!-- Modal -->

<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                <h4 class="modal-title">Forgot Password ?</h4>

            </div>

            <div class="modal-body">

                

                {!! Form::open(['url' => 'password/reset']) !!}

                

                <div class="form-group">

                    <p>Enter Username</p>

                <input type="text" name="username" placeholder="Username" autocomplete="off" class="form-control placeholder-no-fix">

                </div>



                

                <p>Enter your e-mail address below to reset your password.</p>

                <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">



            </div>

            <div class="modal-footer">

                <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>

                {{-- <button class="btn btn-primary" type="button">Submit</button> --}}

                <input class="btn btn-primary" type="submit" name="submit" value="Submit">

            </div>

            {!! Form::close() !!}

        </div>

    </div>

</div>

<!-- modal -->









<!-- Placed js at the end of the document so the pages load faster -->



<!-- Placed js at the end of the document so the pages load faster -->

{!! Html::script('/js/jquery-1.10.2.min.js') !!}

{!! Html::script('/js/bootstrap.min.js') !!}

{!! Html::script('/js/modernizr.min.js') !!}



</body>

</html>

