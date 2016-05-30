@extends('layouts.master')
@section('content')


<div class="row">
    <div class="col-md-12">
        <div class="page-header text-align-left">

            <div class="row">
                <div class="col-md-8">
                    <h1 class="title uppercase">Contactez-nous</h1>
                    <h2 class="subtitle">Une question? Une demande? N'hésitez pas à nous écrire.</h2>
                </div>
                <div class="col-md-4 text-right">
                    @include('partials.soutien')
                </div>
            </div>

        </div><!--END PAGE-HEADER-->
    </div>
</div>

<div class="row">

    <div id="inner-contact" class="col-md-12">

        <div class="row">
            <div class="col-md-4 col-sx-12">
                <h2 class="title">Faculté de droit</h2>
                <p><strong>Adresse</strong>: Avenue du 1er-Mars 26, 2000 Neuchâtel<br>
                    <strong>Telephone</strong>: +41 32 / 718 12 22<br>
                    <strong>Email</strong>: droit.formation@unine.ch
                </p>
            </div><!--END ONE-HALF-->

            <div class="col-md-8 col-sx-12">
                <form action="{{ url('sendMessage') }}" id="contact-form" class="form" method="post">
                    <p class="form-name">
                        <label for="name">Nom <em>(*)</em></label>
                        <input id="name" name="nom" type="text" value="" size="30" class="requiredField" />
                    </p>
                    <p class="form-email">
                        <label for="email">Email <em>(*)</em></label>
                        <input id="email" name="email" type="email" value="" size="30" class="requiredField email" />
                    </p>
                    <p class="form-message">
                        <label for="remarque">Message</label>
                        <textarea id="remarque" name="remarque" cols="45" rows="8" class="requiredField"></textarea>
                    </p>
                    <p class="form-submit">
                        <input id="submitted" value="Envoyer" class="submit button medium grey" type="submit" />
                    </p>
                </form><!--END CONTACT FORM-->
            </div><!--END ONE-HALF LAST-->
        </div><!--END row-->

    </div><!--END row-->

</div><!--END CONTENT-->

@stop
