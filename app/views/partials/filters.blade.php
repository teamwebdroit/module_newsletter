<?php  $custom = new \Custom; ?>

<div id="sidebar" ng-controller="FilterController as filter">

    <div class="widget">
        <h3 class="title">Catégories</h3>

          <ui-select ng-change="filter.filterFunction(filter.selectedCategories)" multiple ng-model="filter.selectedCategories" theme="select2" ng-disabled="disabled" style="width: 220px;">
             <ui-select-match placeholder="Filter par catégorie...">{[{$item.title}]}</ui-select-match>
             <ui-select-choices repeat="categorie.id as categorie in filter.categories | propsFilter: {title: $select.search}">
                <div ng-bind-html="categorie.title | highlight: $select.search"></div>
             </ui-select-choices>
          </ui-select>

    </div><!--END WIDGET-->

    <div class="widget">
        <h3 class="title">Années</h3>

        <div ng-repeat="annee in annees">
            <input type="checkbox" ng-model="annee.checked" ng-click="update(annee)" ng-change="change(annee)">
            <label>{[{annee.year}]}</label>
        </div>

    </div><!--END WIDGET-->

</div><!--END SIDEBAR-->
