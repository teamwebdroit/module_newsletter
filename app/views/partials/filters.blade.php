<?php  $custom = new \Custom; ?>

<div id="sidebar">

    <div class="widget" ng-controller="FilterController as filter">
        <h3 class="title">Catégories</h3>

          <ui-select multiple ng-model="filter.selectedCategories" theme="select2" ng-disabled="disabled" style="width: 220px;">
             <ui-select-match placeholder="Catégorie...">{[{$item.title}]}</ui-select-match>
             <ui-select-choices repeat="categorie.id as categorie in filter.categories | propsFilter: {title: $select.search}">
                <div ng-bind-html="categorie.title | highlight: $select.search"></div>
             </ui-select-choices>
          </ui-select>

          <p>Selected: {[{filter.selectedCategories}]}</p>

    </div><!--END WIDGET-->

</div><!--END SIDEBAR-->
