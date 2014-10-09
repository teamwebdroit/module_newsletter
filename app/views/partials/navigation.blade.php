<div id="primary-menu">
    <ul class="menu">
        <li>{{ link_to('/', 'Accueil' , array('class' => Request::is( '/') ? 'active' : '') ) }}</li>
        <li>{{ link_to('recueil', 'RJN' , array('class' => Request::is( 'recueil') ? 'active' : '') ) }}</li>
        <li><a href="#">Work</a></li>
        <li><a href="#" class="current">Blog</a></li>
        <li>{{ link_to('contact', 'Contact' , array('class' => Request::is( 'recueil') ? 'active' : '') ) }}</li>
    </ul><!--END UL-->
</div><!--END PRIMARY MENU-->