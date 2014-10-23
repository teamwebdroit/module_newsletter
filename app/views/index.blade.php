
@extends('layouts.master')
@section('content')

<div class="page-header text-align-left">
    <h1 class="title uppercase">Nouveautés dans le domaine du droit du travail</h1>
</div><!--END PAGE-HEADER-->

<div class="content">

    <div class="section">

        <div id="inner-content">

            <div class="one" id="about">
                <img width="100%" alt="Droit du travail" src="{{ asset('images/header.jpg') }}" />
            </div><!--END SECTION-->

            <div class="clear"></div>

            <div class="one">
                <h3 class="title">Droit du travail</h3>
                <p><strong>Etiam mattis tellus mltrices pretium. Donec phar maximus orci ultrices pretium. Donec pharets nisi</strong></p>
                <p>
                    Etiam mattis tellus maximus orci ultrices pretium. Donec pharetra massa id sem scelerisque, ac laoreet purus
                    ultricies. Ut viverra enim sed congue faucibus. Etiam consequat cursus nisi, id varius nisi sagittis sed.
                    Phasellus non finibus ligula. Etiam bibendum et enim sed porttitor. Aenean id ultricies sem. Integer
                    fermentum massa vitae massa finibus tempor. In eget elementum lacus.
                </p>
            </div><!--END ONE-THIRD-->

            <div class="clear"></div>
            <div class="divider-border"></div>

            <div class="one-half">
                <h3 class="title">Etiam mattis tellus</h3>
                <p><strong>Etiam mattis tellus mltrices pretium. Donec phar maximus orci ultrices pretium. Donec pharets nisi</strong></p>
                <p>Etiam mattis tellus maximus orci ultrices pretium. Donec pharetra massa id sem scelerisque, ac laoreet purus
                    ultricies. Ut viverra enim sed congue faucibus. Etiam consequat cursus Aenean id ultricies sem. Integer
                    fermentum massa vitae massa finibus tempor.  </p>
            </div><!--END ONE-THIRD-->

            <div class="one-half last">
                <h3 class="title">Perspiciatis unde omnist</h3>
                <p><strong>Etiam eget mi enim, non ultricies nisi voluptatem, illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo nemo enim ipsam voluptatem.</strong></p>
                <p>Etiam consequat cursus nisi, id varius nisi sagittis sed.
                    Phasellus non finibus ligula. Etiam bibendum et enim sed porttitor. Aenean id ultricies sem. Integer
                    fermentum massa vitae massa finibus tempor. In eget elementum lacus.</p>
            </div><!--END ONE-THIRD-->

            <div class="divider-noborder"></div>
        </div>

        <!-- Sidebar  -->
        <div id="sidebar">
            @include('partials.newsletter')
            @include('partials.latest')
        </div>
        <!-- END Sidebar  -->

    </div><!--END SECTION-->

</div><!--END CONTENT-->

@stop