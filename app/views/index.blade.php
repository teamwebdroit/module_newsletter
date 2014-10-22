
@extends('layouts.master')
@section('content')

<div class="content">

    <div class="section">

        <div id="inner-content">

            <div class="one" id="about"></div><!--END SECTION-->

            <div class="clear"></div>

            <div class="one-half">
                <h3 class="title">RJN</h3>
                <p><strong>Etiam mattis tellus mltrices pretium. Donec phar maximus orci ultrices pretium. Donec pharets nisi</strong></p>
                <p>Le Recueil de jurisprudence neuchâteloise porte sur la jurisprudence de l’ensemble des sections du Tribunal cantonal,
                du Tribunal administratif, du Tribunal fiscal et des tribunaux de district neuchâtelois rendue en 2013. On y trouve aussi
                des articles de doctrine et des analyses critiques d’arrêts. </p>
                <p>
                    Etiam mattis tellus maximus orci ultrices pretium. Donec pharetra massa id sem scelerisque, ac laoreet purus
                    ultricies. Ut viverra enim sed congue faucibus. Etiam consequat cursus nisi, id varius nisi sagittis sed.
                    Phasellus non finibus ligula. Etiam bibendum et enim sed porttitor. Aenean id ultricies sem. Integer
                    fermentum massa vitae massa finibus tempor. In eget elementum lacus.
                </p>
            </div><!--END ONE-THIRD-->

            <div class="one-half last">
                <h3 class="title">Perspiciatis unde omnist</h3>
                <p><strong>Etiam eget mi enim, non ultricies nisi voluptatem, illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo nemo enim ipsam voluptatem.</strong></p>
                <p>Sed ut perspiciatis unde omnis iste natus sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab i</p>
                <p>
                    Etiam mattis tellus mltrices pretium. Donec pharetra massa id sem scelerisque, ac laoreet purus
                    ultricies. Ut viverra enim sed conaximus orci ugue faucibus. Etiam consequat cursus nisi, id varius nisi sagittis sed.
                    Phasellus non finibus ligula. Etiam bibendum et enim sed porttitor. Aenean id ultricies sem. Integer
                    fermentum massa vitae massa finibus tempor. In eget elementum lacus.
                </p>
            </div><!--END ONE-THIRD-->
        </div>

        <!-- Sidebar  -->
        <div id="sidebar">
            @include('partials.sidebar')
        </div>
        <!-- END Sidebar  -->

    </div><!--END SECTION-->

</div><!--END CONTENT-->

@stop