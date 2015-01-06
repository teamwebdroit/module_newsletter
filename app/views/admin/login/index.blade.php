<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Droit du travail</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Droit du travail | login">
    <meta name="author" content="Cindy Leschaud | @DesignPond">

    <link rel="stylesheet" href="<?php echo asset('admin/css/styles.css?=121');?>">
    <link rel="stylesheet" href="<?php echo asset('admin/css/login.css?=121');?>">
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600' rel='stylesheet' type='text/css'>

</head>
<body class="focusedform">

<div class="verticalcenter">

    @if( $errors->has() || Session::has('status'))
    <div class="row">
        <div class="col-sm-12">
            <div class="alert alert-{{ Session::get('status') }}">

                @foreach($errors->all() as $message)
                <p>{{ $message }}</p>
                @endforeach

                @if(Session::has('message'))
                {{ Session::get('message') }}
                @endif

            </div>
        </div>
    </div>
    @endif

    <div id="logo"><a href="{{ url('/') }}">Droit du <strong>travail</strong>.ch</a></div>
    <div class="panel panel-primary">

        {{ Form::open(array(
            'method'        => 'POST',
            'data-validate' => 'parsley',
            'class'         => 'validate-form form-horizontal',
            'url'           => array('login')))
        }}

        <div class="panel-body">
            <h4 class="text-center" style="margin-bottom: 25px;">Log in</h4>
            <form action="#" class="form-horizontal" style="margin-bottom: 0px !important;">
                <div class="form-group">
                    <div class="col-sm-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input type="text" class="form-control" id="username" name="email" placeholder="email">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            <input type="password" class="form-control" id="password" name="password" placeholder="mot de passe">
                        </div>
                    </div>
                </div>
                <div class="clearfix">
                    <div class="pull-right"><label><input type="checkbox" style="margin-bottom: 20px" checked=""> Remember Me</label></div>
                </div>
        </div>
        <div class="panel-footer">
            <a href="extras-forgotpassword.htm" class="pull-left btn btn-link" style="padding-left:0">Mot de passe perdu?</a>
            <div class="pull-right">
                <a href="{{ url('/') }}" class="btn btn-default">Retour au site</a>
                <button type="submit" class="btn btn-primary">Log In</button>
            </div>
        </div>
        {{ Form::close() }}
    </div>
</div>

</body>
</html>