<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="description" content="">
  {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
  <meta name="_token" content="{{ csrf_token() }}"/>
  <meta name="author" content="">
  <link rel="shortcut icon" href="#" type="image/png">

  <title>FBOC Members Area</title>

  @yield('style')

  @include('partials.admin-styles')

  <style type="text/css">
    /* Top Heading*/

    .top-heading{
          background: #B3E6F9;
          padding-top: .35em;
          padding-bottom: .3em;
          text-align: center;
        }
        .top-title{
          font-size: 1em;
          color: #054056;
        }
        .top-description{
          font-size: .9em;
          display: block;
          color: #166A89;
        }

        /*Top heading end*/
  </style>


  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  {!! Html::script('js/html5shiv.js') !!}
  {!! Html::script('js/respond.min.js') !!}
  <![endif]-->
  

</head>

<body class="">

<section>
    @include('partials.left-side')
    @include('partials.notification')
    @include('partials.header')
    

        <!-- page heading start-->
        <div class="page-heading">
            @include('partials.top-heading')
        </div>
        <!-- page heading end-->

        <!--body wrapper start-->
        <div class="wrapper">

            @yield('body-content')

        </div>
        <!--body wrapper end-->

        <!--footer section start-->
        <footer>
            2010 &copy; FBO Corporation
        </footer>
        <!--footer section end-->


    </div>
    <!-- main content end-->
</section>

@include('partials.admin-scripts')
@yield('script')

</body>
</html>
