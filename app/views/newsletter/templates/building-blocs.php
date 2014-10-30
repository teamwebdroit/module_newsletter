<a data-drag="true" id="{{ bloc.template }}" data-jqyoui-options="{revert:true}" jqyoui-draggable="{animate:true}" href="#" ng-model="bloc.titre">
    <span>{{ bloc.titre }}</span>
    <img ng-src="<?php echo asset("images/blocs/{{ bloc.image }}"); ?>" alt="{{ bloc.titre }}">
</a>