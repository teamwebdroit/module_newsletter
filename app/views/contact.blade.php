@extends('layouts.master')
@section('content')

    <div class="page-header text-align-left">
        <div class="holder">
            <h1 class="title uppercase">Contactez-nous</h1>
            <h2 class="subtitle">Une question? Une demande? N'hésitez pas à nous écrire.</h2>
        </div><!--END HOLDER-->
    </div><!--END PAGE-HEADER-->

    <div class="content">
        <div class="section">

            <div id="inner-contact">

                <div class="one-third">
                    <h2 class="title">Faculté de droit</h2>
                    <p><strong>Adresse</strong>: Avenue du 1er-Mars 26, 2000 Neuchâtel<br>
                        <strong>Telephone</strong>: +41 32 / 718 12 22<br>
                        <strong>Email</strong>: droit.formation@unine.ch
                    </p>
                </div><!--END ONE-HALF-->

                <div class="two-third last">

                    <form action="php/send.php" id="contact-form" class="form" method="post">
                        <p class="form-name">
                            <label for="name">Nom <em>(*)</em></label>
                            <input id="name" name="name" type="text" value="" size="30" class="requiredField" />
                        </p>
                        <p class="form-email">
                            <label for="email">Email <em>(*)</em></label>
                            <input id="email" name="email" type="email" value="" size="30" class="requiredField email" />
                        </p>
                        <p class="form-message">
                            <label for="message">Message</label>
                            <textarea id="message" name="message" cols="45" rows="8" class="requiredField"></textarea>
                        </p>
                        <p class="form-submit">
                            <input name="submit" id="submitted" value="Envoyer" class="submit button medium grey" type="submit" />
                        </p>
                    </form><!--END CONTACT FORM-->

                </div><!--END ONE-HALF LAST-->
            </div><!--END SECTION-->
        </div>
    </div><!--END CONTENT-->

@stop
