<a id="{{ bloc.template }}" ng-click="build.clicked(bloc)" ng-model="bloc.titre">
    <img ng-src="<?php echo asset("images/blocs/{{ bloc.image }}"); ?>" alt="{{ bloc.titre }}" />
    <span>{{ bloc.titre }}</span>
</a>