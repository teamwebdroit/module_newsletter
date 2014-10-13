<!DOCTYPE html>
<!--[if IE 8]><html class="no-js lt-ie9" lang="en" > <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en" > <!--<![endif]-->
<head>
    <meta charset="utf-8" />
    <title>Administration newsletter</title>

    <meta name="description" content="Administration newsletter">
    <meta name="author" content="Cindy Leschaud">
    <meta name="viewport" content="width=device-width">

    <!-- CSS Files
    ================================================== -->
    <link rel="stylesheet" href="<?php echo asset('css/main.css');?>">
    <link rel="stylesheet" href="<?php echo asset('css/bootstrap.css');?>">
    <link rel="stylesheet" href="<?php echo asset('js/vendor/redactor/redactor.css'); ?>">
    <link rel="stylesheet" href="<?php echo asset('css/newsletter.css'); ?>">
    <link href="<?php echo asset('js/vendor/jqueryui/jquery-ui.css');?>" rel="stylesheet">
    <link href="<?php echo asset('js/vendor/angular/angular-notify.css');?>" rel="stylesheet">

    <base href="/">

</head>
<body flow-prevent-drop
      flow-drag-enter="style={border: '5px solid green'}"
      flow-drag-leave="style={}"
      ng-style="style">

<div class="container">

    <div id="main" ng-app="newsletter"><!-- main div for app-->

        <div ng-controller="BuildController as build">

            <div class="row">
                <div class="col-md-12">
                    <ul id="buildingBlocs">
                        <li ng-repeat="bloc in build.blocs">
                            <buiding-blocs></buiding-blocs>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div ng-controller="DropController as dropped" id="build" data-drop="true" data-jqyoui-options jqyoui-droppable="{onDrop:'dropped'}">
                        <div class="well">
                            <image-left-text ng-if="isBloc('image-left-text')"></image-left-text>
                            <image-right-text ng-if="isBloc('image-right-text')"></image-right-text>
                            <image-text ng-if="isBloc('image-text')"></image-text>
                            <image-alone ng-if="isBloc('image')"></image-alone>
                            <text-alone ng-if="isBloc('text')"></text-alone>
                            <arret ng-if="isBloc('arret')"></arret>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div><!-- end main div for app-->

</div>

<!-- Javascript Files
================================================== -->

<script type="text/javascript" src="<?php echo asset('js/jquery.js');?>"></script>
<script type="text/javascript" src="<?php echo asset('js/bootstrap.min.js');?>"></script>
<script type="text/javascript" src="<?php echo asset('js/vendor/jqueryui/jquery-ui.js');?>"></script>
<script type="text/javascript" src="<?php echo asset('js/vendor/redactor/redactor.js');?>"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.0-rc.1/angular.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.2.8/angular-route.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.2.8/angular-resource.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.2.1/angular-sanitize.js"></script>
<script type="text/javascript" src="<?php echo asset('js/vendor/angular/angular-dragdrop.js');?>"></script>
<script type="text/javascript" src="<?php echo asset('js/vendor/angular/angular-redactor.js');?>"></script>
<script type="text/javascript" src="<?php echo asset('js/vendor/angular/angular-flow.js');?>"></script>
<script type="text/javascript" src="<?php echo asset('js/vendor/angular/angular-notify.js');?>"></script>
<script type="text/javascript" src="<?php echo asset('js/build.js');?>"></script>

</body>
</html>