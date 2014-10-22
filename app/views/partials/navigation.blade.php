<div id="primary-menu">
    <ul class="menu">
        <li>{{ link_to('recueil', 'Accueil' , array('class' => Request::is( 'recueil') ? 'active' : '') ) }}</li>
        <li>{{ link_to('jurisprudence', 'Jurisprudence' , array('class' => Request::is( 'jurisprudence') ? 'active' : '') ) }}</li>
        <li>{{ link_to('newsletters', 'Newsletter' , array('class' => Request::is( 'newsletters') ? 'active' : '') ) }}</li>
        <li>{{ link_to('contact', 'Contact' , array('class' => Request::is( 'contact') ? 'active' : '') ) }}</li>
    </ul><!--END UL-->
</div><!--END PRIMARY MENU-->