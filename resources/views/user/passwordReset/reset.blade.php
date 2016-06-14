<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

    <meta name="description" content="">

    <link rel="shortcut icon" href="#" type="image/png">



    <title>FBO::Password Reset</title>



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

            {!! Form::open(['url' => 'resetpassword/save' ,'class'=>'form-signin', 'method'=>'post']) !!}

                {!! csrf_field() !!}

                <div class="form-signin-heading text-center">

                    

                    {!! Html::image('/images/login-logo.png') !!}

                </div>

                <div class="login-wrap">

                   <div class="reset-form">
                   	<h4 class="text-center">Reset Your Password</h4>
                   	

                   	{!! Form::hidden('username', $uname) !!} <br/>
                   	
                   	
                   	
                   	{!! Form::password('password',['class'=>'form-control log-input','placeholder'=>'Password']) !!}

                   	
                   	

                   	{!! Form::password('rpassword',['class'=>'form-control log-input','placeholder'=>'Confirm Password']) !!}



                   	{!! Form::submit('submit', ['class'=>'btn btn-lg btn-login btn-block']) !!}                	
                   	

                   	{!! Form::close() !!}
                   </div>

        		</div>

    </div>

</div> 
<div class="row">
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














<!-- Placed js at the end of the document so the pages load faster -->



<!-- Placed js at the end of the document so the pages load faster -->

{!! Html::script('/js/jquery-1.10.2.min.js') !!}

{!! Html::script('/js/bootstrap.min.js') !!}

{!! Html::script('/js/modernizr.min.js') !!}



</body>

</html>

