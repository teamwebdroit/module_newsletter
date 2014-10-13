
@extends('layouts.master')
@section('content')

<div class="content">

    <div class="section parallax-background" id="about">
        <div class="holder text-align-left">
            <div class="one-half about-content">
                <h2 class="uppercase">Recueil de jurisprudence neuchâteloise 2013</h2>
                <p><a href="#" class="button small rounded grey">Acheter</a></p>
            </div>
            <div class="one-half last">
                <img alt="RJN" src="{{ asset('edition/cover.png') }}">
            </div>
        </div><!--END HOLDER-->
    </div><!--END SECTION-->

    <div class="section">

        <div class="one-third">
            <h3 class="title">RJN</h3>
            <p><strong>Format : 15 x 21.5 cm<br/>714 pages<br/>Reliure : Cousu au fil, dos arrondi<br/>ISBN : 978-2-940400-29-4</strong></p>
            <p>Le Recueil de jurisprudence neuchâteloise porte sur la jurisprudence de l’ensemble des sections du Tribunal cantonal,
            du Tribunal administratif, du Tribunal fiscal et des tribunaux de district neuchâtelois rendue en 2013. On y trouve aussi
            des articles de doctrine et des analyses critiques d’arrêts. </p>
        </div><!--END ONE-THIRD-->

        <div class="one-third">
            <h3 class="title">Perspiciatis unde omnist</h3>
            <p><strong>Etiam eget mi enim, non ultricies nisi voluptatem, illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo nemo enim ipsam voluptatem.</strong></p>
            <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo
            inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Dusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae
             ab illo inventore veritatis.</p>
        </div><!--END ONE-THIRD-->

        <div class="one-third last">
            <h3 class="title">Ultricies unde omnist</h3>
            <p><strong>Etiam eget mi enim, non ultricies nisi voluptatem, illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo nemo enim ipsam voluptatem.</strong></p>
            <p>Sed ut perspiciatis unde omnis ise vitae dicta sunt explicabo. Donec ut volutpat metus. Aliquam tortor lorem, fringilla tempor dignissim at,
             pretium et arcu. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae
             ab illo inventore veritatis.</p>
        </div><!--END ONE-THIRD-->

    </div><!--END SECTION-->

</div><!--END CONTENT-->

@stop