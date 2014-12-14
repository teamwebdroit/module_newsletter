@extends('layouts.master')
@section('content')

<div class="page-header text-align-left">
    <h1 class="title uppercase">Désinscription</h1>
</div><!--END PAGE-HEADER-->

<div class="content">
    <div class="section">

        <div id="inner-content">

            @include('partials.message')

            <p>Désinscription de la newsletter en droit du travail.</p>
            <form action="{{ url('inscription/unsubscribe') }}" method="post" id="unsub-form" role="form">
                <p class="form-email-unsub">
                    <label for="email">Votre email</label>
                    <input id="email" class="requiredField email" type="email" size="30"  name="email">
                </p>
                <p class="form-submit-unsub">
                    <input type="hidden" name="newsletter_id" value="{{ $campagne->id  }}">
                    <input id="submitted" class="submit button medium grey" type="submit" value="Se désinscrire">
                </p>
            </form>

        </div>

        <!-- Sidebar  -->
        <div id="sidebar">
            @include('partials.newsletter')
        </div>
        <!-- END Sidebar  -->

    </div><!--END SECTION-->
</div><!--END CONTENT-->

@stop
