<!DOCTYPE html>
    <!--[if IE 8]><html class="no-js lt-ie9" lang="en" > <![endif]-->
    <!--[if gt IE 8]><!--> <html class="no-js" lang="en" > <!--<![endif]-->
    <head>
        <meta charset="utf-8" />
        <title>RJN</title>

        <meta name="description" content="RJN">
        <meta name="author" content="Cindy Leschaud">
        <meta name="viewport" content="width=device-width">

        <!-- CSS Files
        ================================================== -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,400italic,600,600italic,700italic,700,800,800italic,300italic,300' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" type="text/css" href="<?php echo asset('css/style.css');?>" media="screen" />
        <link rel="stylesheet" type="text/css" href="<?php echo asset('css/blog.css');?>" media="screen" />
        <link rel="stylesheet" type="text/css" href="<?php echo asset('css/color-red.css');?>" media="screen" />
        <link rel="stylesheet" type="text/css" href="<?php echo asset('css/responsive.css');?>" media="screen" />
        <link rel="stylesheet" type="text/css" href="<?php echo asset('css/select.css');?>">
        <link rel="stylesheet" type="text/css" href="<?php echo asset('css/select2.css');?>">

        <!-- Javascript Files
        ================================================== -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="http://code.jquery.com/jquery-migrate-1.0.0.js"></script>
        <script src="<?php echo asset('js/custom.js');?>"></script>
        <script src="<?php echo asset('js/header.js');?>"></script>
        <script src="<?php echo asset('js/contact-form-validate.js');?>"></script>

        @if(isset($required))

            <link href="<?php echo asset('js/vendor/angular/angular-notify.css');?>" rel="stylesheet">
            <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.0-rc.1/angular.js"></script>
            <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.2.8/angular-route.js"></script>
            <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.2.8/angular-resource.js"></script>
            <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.2.1/angular-sanitize.js"></script>
            <script src="<?php echo asset('js/vendor/angular/dirPagination.js');?>"></script>
            <script type="text/javascript" src="<?php echo asset('js/select.js');?>"></script>
            <script type="text/javascript" src="<?php echo asset('js/filter.js');?>"></script>

        @endif

    </head>

    <body id="top">

        <div id="wrapper">

            <!-- START HEADER -->
            <div id="header-wrapper">
                <div class="header clear">

                    <div class="one-third">
                        <div id="logo">
                            <a href="index.html">Droit du <strong>travail</strong></a>
                        </div><!--END LOGO-->
                    </div>

                    <div class="one-third">
                        <!-- Navigation  -->
                        @include('partials.navigation')
                    </div>

                    <div class="one-third last logos">
                        <a target="_blank" href="http://www2.unine.ch/droit"><img src="<?php echo asset('images/logo.png');?>" alt="" /></a>
                        <a target="_blank" href="http://www2.unine.ch/cemaj"><img src="<?php echo asset('images/logos/cemaj.jpg');?>" alt="" /></a>
                        <a target="_blank" href="http://www2.unine.ch/cert"><img src="<?php echo asset('images/logos/cert.jpg');?>" alt="" /></a>
                    </div>

                </div><!--END HEADER-->
            </div><!--END HEADER-WRAPPER-->
            <!-- END HEADER -->

            <!-- START BLOG -->
            <div id="content-wrapper">

                <!-- Contenu -->
                @yield('content')
                <!-- Fin contenu -->

            </div><!--END CONTENT-WRAPPER-->
            <!-- END BLOG -->

        </div><!--END WRAPPER-->

        <!-- START FOOTER -->
        <div id="footer">
            <div class="section">
                <div class="one text-align-center">Faculté de droit, Avenue du 1er-Mars 26, 2000 Neuchâtel</div><!--END ONE-->
                <div class="one text-align-center">
                    <p class="copyright">Copyright &copy; RJN <?php echo date('Y'); ?>. Tous droits réservés.</p>
                </div><!--END ONE-->
            </div><!--END SECTION-->
        </div><!--END FOOTER-->
        <!-- END FOOTER -->

        <a href="#" id="back-top">Top</a>

    </body>
</html>