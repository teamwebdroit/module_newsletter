
@extends('layouts.master')
@section('content')

<div class="content">

    <div class="section parallax-background" id="about">
        <div class="holder text-align-left">
            <div class="one-fourth">
                <img width="180" alt="RJN" src="{{ asset('edition/rjnbook.png') }}">
            </div>
            <div class="three-fourth last">
                <h2 class="uppercase">Team with all kinds of great personalities</h2>
                <p><a href="#" class="button large rounded outline white">View our portfolio</a></p>
            </div>
        </div><!--END HOLDER-->
    </div><!--END SECTION-->

    <div class="section">

        <div class="one-third">
            <h3 class="title">Our Philosophy</h3>
            <p><strong>Etiam eget mi enim, non ultricies nisi voluptatem, illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo nemo enim ipsam voluptatem.</strong></p>
            <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Donec ut volutpat metus. Aliquam tortor lorem, fringilla tempor dignissim at, pretium et arcu. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis.</p>
        </div><!--END ONE-THIRD-->

        <div class="one-third">
            <h3 class="title">Our Mision</h3>
            <p><strong>Etiam eget mi enim, non ultricies nisi voluptatem, illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo nemo enim ipsam voluptatem.</strong></p>
            <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Donec ut volutpat metus. Aliquam tortor lorem, fringilla tempor dignissim at, pretium et arcu. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis.</p>
        </div><!--END ONE-THIRD-->

        <div class="one-third last">
            <h3 class="title">Our skills</h3>
            <ul class="skills-graph" id="example-1">
                <li><p>Web design <strong>70%</strong></p><div><span class="70"></span></div></li>
                <li><p>Wordpress <strong>100%</strong></p><div><span class="100"></span></div></li>
                <li><p>Jquery <strong>85%</strong></p><div><span class="85"></span></div></li>
                <li><p>Print <strong>31%</strong></p><div><span class="31"></span></div></li>
                <li><p>Logo design <strong>51%</strong></p><div><span class="50"></span></div></li>
                <li><p>Seo <strong>75%</strong></p><div><span class="75"></span></div></li>
            </ul><!--END SKILLS-GRAPH-->
        </div><!--END ONE-THIRD-->

        <div class="divider-border"></div>
        <div class="clear"></div>

        <h3 class="title">Meet the team</h3><br>

        <div class="one-third team text-align-center">
            <div class="team-member-info">
                <img src="http://placehold.it/350x350" class="radius-200" alt="" />
                <h2 class="title"><b>John Doe</b></h2>
                <h3 class="uppercase"><b>Developer</b></h3>
                <p>Seded ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
                <ul class="social-personal">
                    <li><a href="#">Twitter</a></li>
                    <li><a href="#">Facebook</a></li>
                    <li><a href="#">Forrst</a></li>
                    <li><a href="#">Dribbble</a></li>
                </ul>
            </div><!--END TEAM-MEMBER-INFO-->
        </div><!--END ONE-THIRD-->

        <div class="one-third team text-align-center">
            <div class="team-member-info">
                <img src="http://placehold.it/350x350" class="radius-200" alt="" />
                <h2 class="title"><b>Jane Doe</b></h2>
                <h3 class="uppercase"><b>Designer</b></h3>
                <p>Seded ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
                <ul class="social-personal">
                    <li><a href="#">Twitter</a></li>
                    <li><a href="#">Dribbble</a></li>
                    <li><a href="#">Facebook</a></li>
                </ul>
            </div><!--END TEAM-MEMBER-INFO-->
        </div><!--END ONE-THIRD-->

        <div class="one-third team text-align-center last">
            <div class="team-member-info">
                <img src="http://placehold.it/350x350" class="radius-200" alt="" />
                <h2 class="title"><b>Jane McDoe</b></h2>
                <h3 class="uppercase"><b>Co-founder</b></h3>
                <p>Seded ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
                <ul class="social-personal">
                    <li><a href="#">Twitter</a></li>
                    <li><a href="#">Forrst</a></li>
                    <li><a href="#">Dribbble</a></li>
                </ul>
            </div><!--END TEAM-MEMBER-INFO-->
        </div><!--END ONE-THIRD LAST-->

        <div class="divider-border"></div>
        <div class="clear"></div>

        <div class="one text-align-center">
            <h3 class="title uppercase">Let&#8217;s work together</h3>
            <h4>Got an interesting project and would like to work on it with us?</h4>

            <div class="one-half button-group aligncenter">
                <a href="#" class="button grey"><span class="title">Contact us</span><span class="subtitle">Let's make magic together</span></a>
                <span class="or radius-200">or</span>
                <a href="#" class="button orange"><span class="title">View our portfolio</span><span class="subtitle">We are proud of</span></a>
            </div><!--END ONE-HALF BUTTON-GROUP-->
        </div><!--END ONE-->

    </div><!--END SECTION-->

</div><!--END CONTENT-->

@stop