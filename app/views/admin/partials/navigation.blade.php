<!-- BEGIN SIDEBAR -->
<nav id="page-leftbar" role="navigation">
    <!-- BEGIN SIDEBAR MENU -->
    <ul class="acc-menu" id="sidebar">
        <!-- Recherche globale -->
        @include('admin.partials.search')

        <li class="divider"></li>
        <li class="<?php echo (Request::is('admin/dashboard') ? 'active' : '' ); ?>"><a href="{{ url('admin/dashboard') }}"><i class="fa fa-home"></i> <span>Accueil</span></a></li>
        <li class="<?php echo (Request::is('admin/arret/*') ? 'active' : '' ); ?>"><a href="{{ url('admin/arret')  }}"><i class="fa fa-edit"></i> <span>Arrêts</span></a></li>
        <li class="<?php echo (Request::is('admin/categorie/*') ? 'active' : '' ); ?>"><a href="{{ url('admin/categorie')  }}"><i class="fa fa-tasks"></i> <span>Categories</span></a></li>
        <li class="<?php echo (Request::is('admin/newsletter/*') ? 'active' : '' ); ?>"><a href="javascript:;"><i class="fa fa-envelope"></i><span>Newsletter</span></a>
            <ul class="acc-menu">
                <li><a href="{{ url('admin/campagne')  }}">Campagnes</a></li>
                <li><a href="{{ url('admin/campagne/compose')  }}">Composer</a></li>
                <li><a href="{{ url('admin/campagne/abonne')  }}">Abonnées</a></li>
            </ul>
        </li>
    </ul>
    <!-- END SIDEBAR MENU -->
</nav>