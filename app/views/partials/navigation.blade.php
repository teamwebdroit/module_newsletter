<div id="primary-menu">
    <ul class="menu">
        <li>{{ link_to('/', 'Accueil' , array('class' => Request::is( '/') ? 'active' : '') ) }}</li>
        <li><a href="#">About</a></li>
        <li><a href="#">Work</a></li>
        <li><a href="#" class="current">Blog</a></li>
        <li><a href="#">Contact</a></li>
    </ul><!--END UL-->
</div><!--END PRIMARY MENU-->