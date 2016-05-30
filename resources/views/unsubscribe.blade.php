@extends('layouts.master')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="page-header text-align-left">

            <div class="row">
                <div class="col-md-8">
                    <h1 class="title uppercase">Désinscription</h1>
                </div>
                <div class="col-md-4 text-right">
                    @include('partials.soutien')
                </div>
            </div>

        </div><!--END PAGE-HEADER-->
    </div>
</div>

<div class="row">
    <div id="inner-content" class="col-md-8 col-xs-12">

        @include('partials.message')

        <p>Désinscription de la newsletter en droit du travail.</p>
        {!! Form::open(array('url' => 'inscription/unsubscribe' ,'method' => 'post', 'id' => 'unsub-form')) !!}
            <p class="form-email-unsub">
                <label for="email">Votre email</label>
                <input id="email" class="requiredField email" type="email" size="30"  name="email">
            </p>
            <p class="form-submit-unsub">
                <input type="hidden" name="newsletter_id[]" value="1">
                <input id="submitted" class="submit button medium grey" type="submit" value="Se désinscrire">
            </p>
        {!! Form::close() !!}

    </div>

    <!-- Sidebar  -->
    <div id="sidebar" class="col-md-4 col-xs-12">
        @include('partials.pub')
    </div>
    <!-- END Sidebar  -->
</div><!--END CONTENT-->

@stop

