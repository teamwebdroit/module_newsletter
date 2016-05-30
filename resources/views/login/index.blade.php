@extends('layouts.login')
@section('content')

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
        <a href="{{ action('RemindersController@getRemind') }}" class="pull-left btn btn-link" style="padding-left:0">Mot de passe perdu?</a>
        <div class="pull-right">
            <a href="{{ url('/') }}" class="btn btn-default">Retour au site</a>
            <button type="submit" class="btn btn-primary">Log In</button>
        </div>
    </div>
    {{ Form::close() }}

@stop