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

    <style type="text/css">
		.reset-form a:hover{
			text-decoration: none;
		}
	
    </style>



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

            <div class="form-signin">

               

                <div class="form-signin-heading text-center">

                    

                    {!! Html::image('/images/login-logo.png') !!}

                </div>

                <div class="login-wrap">

                   <div class="reset-form">
                   	<h5 class="text-center">
                        Your password reset duration has expired. Please try a new request.
                    </h5>
                   	


					<a href="{{ URL::to('/auth/login') }}"><button class="btn btn-lg btn-login btn-block">Back</button></a>
                   	             	
                   	

                   	    </div>
                   </div>

        		</div>

    </div>

</div> 















<!-- Placed js at the end of the document so the pages load faster -->



<!-- Placed js at the end of the document so the pages load faster -->

{!! Html::script('/js/jquery-1.10.2.min.js') !!}

{!! Html::script('/js/bootstrap.min.js') !!}

{!! Html::script('/js/modernizr.min.js') !!}



</body>

</html>

