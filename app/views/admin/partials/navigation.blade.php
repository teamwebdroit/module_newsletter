<!-- BEGIN SIDEBAR -->
<nav id="page-leftbar" role="navigation">
    <!-- BEGIN SIDEBAR MENU -->
    <ul class="acc-menu" id="sidebar">
        <li id="search">
            <a href="javascript:;"><i class="fa fa-search opacity-control"></i></a>
             <form>
                <input type="text" class="search-query" placeholder="Search...">
                <button type="submit"><i class="fa fa-search"></i></button>
             </form>
        </li>
        <li class="divider"></li>
        <li><a href="{{ url('/')  }}"><i class="fa fa-home"></i> <span>Accueil</span></a></li>
        <li><a href="{{ url('admin/arret')  }}"><i class="fa fa-edit"></i> <span>Arrêts</span></a></li>
        <li><a href="{{ url('admin/categorie')  }}"><i class="fa fa-tasks"></i> <span>Categories</span></a></li>
        <li><a href="javascript:;"><i class="fa fa-envelope"></i><span>Newsletter</span></a>
            <ul class="acc-menu">
                <li><a href="{{ url('admin/campagne')  }}">Campagnes</a></li>
                <li><a href="{{ url('admin/abonne')  }}">Abonnées</a></li>
            </ul>
        </li>
    </ul>
    <!-- END SIDEBAR MENU -->
</nav>