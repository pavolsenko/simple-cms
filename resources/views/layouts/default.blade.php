<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href='http://fonts.googleapis.com/css?family=Raleway:400,300,500,600,800' rel='stylesheet' type='text/css'>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" >
    <link href="css/codeon.css" rel="stylesheet" type="text/css">
    <link href="css/flexslider.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/owl.carousel.css" rel="stylesheet" type="text/css" media="screen">
    <link href="css/owl.theme.css" rel="stylesheet" type="text/css" media="screen">
    <link href="rs-plugin/css/settings.css" rel="stylesheet" type="text/css" media="screen">

    <link href="css/style.css" rel="stylesheet" type="text/css">

    <script src="//code.jquery.com/jquery-1.11.3.min.js" type="text/javascript"></script>
    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" type="text/javascript"></script>

    <!--[if lt IE 9]>
    <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->

</head>
<body>

@include('partials/defaultNavigation')

@yield('content')

<section id="footer" class="padding-80">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6 copyright">
                <span>&copy;2014.Design_mylife. All right reserved</span>
            </div>
            <div class="col-md-6 col-sm-6 footer-nav">
                <ul class="list-inline">
                    <li><a href="demo-default.html">Home</a></li>
                    <li><a href="blog-list.html">Latest news</a></li>
                    <li><a href="typography.html">Typography</a></li>
                </ul>
            </div>
        </div>
    </div>
</section><!--footer end-->
<!--back to top-->
<a href="#" class="scrollToTop"><i class="fa fa-angle-up"></i></a>
<!--back to top end-->


@include('partials/footerScripts')

</body>
</html>