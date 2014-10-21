<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Administration | RJN</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="RJN administration">
	<meta name="author" content="DesignPond">

    <link rel="stylesheet" href="<?php echo asset('admin/css/styles.css?=121');?>">
    <link rel="stylesheet" href="<?php echo asset('js/vendor/redactor/redactor.css'); ?>">
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600' rel='stylesheet' type='text/css'>

    <link rel='stylesheet' type='text/css' href="<?php echo asset('admin/plugins/datatables/dataTables.css');?>" />
    <link rel='stylesheet' type='text/css' href="<?php echo asset('admin/plugins/form-multiselect/css/multi-select.css');?>" />

    <link href='assets/demo/variations/default.css' rel='stylesheet' type='text/css' media='all' id='styleswitcher'>
    <link href='assets/demo/variations/default.css' rel='stylesheet' type='text/css' media='all' id='headerswitcher'>

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries. Placeholdr.js enables the placeholder attribute -->
	<!--[if lt IE 9]>
        <link rel="stylesheet" href="<?php echo asset('admin/css/styles.ie8.css');?>">
		<script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/respond.js/1.1.0/respond.min.js"></script>
	<![endif]-->

    <link rel='stylesheet' type='text/css' href='<?php echo asset('admin/plugins/form-toggle/toggles.css');?>' />

</head>

<body class="">

    <header class="navbar navbar-inverse navbar-fixed-top" role="banner">

        <a id="leftmenu-trigger" class="tooltips" data-toggle="tooltip" data-placement="right" title="Toggle Sidebar"></a>

        <div class="navbar-header pull-left"><a class="navbar-brand" href="{{ url('/')  }}">RJN</a></div>

        <ul class="nav navbar-nav pull-right toolbar">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle username" data-toggle="dropdown"><span class="hidden-xs">John McCartney <i class="fa fa-caret-down"></i></span></a>
                <ul class="dropdown-menu userinfo arrow">
                    <li class="username">
                        <a href="#"><div class="pull-right"><h5>Howdy, John!</h5><small>Logged in as <span>john2751212121</span></small></div></a>
                    </li>
                    <li class="userlinks">
                        <ul class="dropdown-menu">
                            <li><a href="#" class="text-right">Sign Out</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>
    </header>

    <div id="page-container">

        <!-- Navigation  -->
        @include('admin.partials.navigation')

        <div id="page-content">
            <div id='wrap'>

                <!-- Breadcrumbs  -->
                @include('admin.partials.breadcrumbs')

                <div id="page-heading"><h1>{{ $pageTitle or 'Administration' }}</h1></div>

                <div class="container">

                    <!-- Contenu -->
                    @yield('content')
                    <!-- Fin contenu -->

                </div> <!-- container -->
            </div> <!--wrap -->
        </div> <!-- page-content -->

        <footer role="contentinfo">
            <div class="clearfix">
                <ul class="list-unstyled list-inline pull-left">
                    <li>RJN &copy; <?php echo date('Y'); ?></li>
                </ul>
                <button class="pull-right btn btn-inverse-alt btn-xs hidden-print" id="back-to-top"><i class="fa fa-arrow-up"></i></button>
            </div>
        </footer>

    </div> <!-- page-container -->

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>

    <script type="text/javascript" src="<?php echo asset('admin/js/bootstrap.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo asset('admin/js/enquire.js');?>"></script>
    <script type="text/javascript" src="<?php echo asset('admin/js/jquery.cookie.js');?>"></script>
    <script type="text/javascript" src="<?php echo asset('admin/js/jquery.nicescroll.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo asset('admin/plugins/form-toggle/toggle.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo asset('admin/js/placeholdr.js');?>"></script>
    <script type="text/javascript" src="<?php echo asset('js/vendor/redactor/redactor.js');?>"></script>
    <script type='text/javascript' src="<?php echo asset('admin/plugins/form-multiselect/js/jquery.multi-select.min.js');?>"></script>
    <script type='text/javascript' src="<?php echo asset('admin/plugins/datatables/jquery.dataTables.min.js');?>"></script>
    <script type='text/javascript' src="<?php echo asset('admin/plugins/datatables/dataTables.bootstrap.js');?>"></script>
    <script type="text/javascript" src="<?php echo asset('admin/js/datatables.js');?>"></script>
    <script type="text/javascript" src="<?php echo asset('admin/js/application.js');?>"></script>

</body>
</html>