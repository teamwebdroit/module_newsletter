(function ($) {



})(jQuery);


var Filter = angular.module('filter', ["ngResource", 'ui.select','ngSanitize']).config(function($interpolateProvider){
    $interpolateProvider.startSymbol('{[{').endSymbol('}]}');
}).config(function(uiSelectConfig) {
    uiSelectConfig.theme = 'select2';
});;

/**
 * Retrive all arrets blocs for bloc arret
 */
Filter.factory('Arrets', ['$http', '$q', function($http, $q) {
    return {
        query: function() {
            var deferred = $q.defer();
            $http.get('/arrets').success(function(data) {
                    deferred.resolve(data);
                }).error(function(data) {
                    deferred.reject(data);
                });
            return deferred.promise;
        }
    };
}]);

/**
 * Retrive all arrets blocs for bloc arret
 */
Filter.factory('Categories', ['$http', '$q', function($http, $q) {
    return {
        query: function() {
            var deferred = $q.defer();
            $http.get('/categories').success(function(data) {
                deferred.resolve(data);
            }).error(function(data) {
                deferred.reject(data);
            });
            return deferred.promise;
        }
    };
}]);

Filter.controller('ArretController', ['$scope','$http','Arrets',function($scope,$http,Blocs){

}]);


/**
 * AngularJS default filter with the following expression:
 * "person in people | filter: {name: $select.search, age: $select.search}"
 * performs a AND between 'name: $select.search' and 'age: $select.search'.
 * We want to perform a OR.
 */
Filter.filter('propsFilter', function() {
    return function(items, props) {
        var out = [];
        if (angular.isArray(items)) {
            items.forEach(function(item) {
                var itemMatches = false;
                var keys = Object.keys(props);
                for (var i = 0; i < keys.length; i++) {
                    var prop = keys[i];
                    var text = props[prop].toLowerCase();
                    if (item[prop].toString().toLowerCase().indexOf(text) !== -1) {
                        itemMatches = true;
                        break;
                    }
                }
                if (itemMatches) {
                    out.push(item);
                }
            });
        } else {
            // Let the output be the input untouched
            out = items;
        }
        return out;
    };
});

/**
 * Select arret controller, select an arret and display's it
 */
Filter.controller('FilterController', ['$scope','$http', '$sce','Categories',function($scope,$http,$sce,Categories){

    this.disabled      = undefined;
    this.searchEnabled = undefined;

    this.enable = function() {
        this.disabled = false;
    };

    this.disable = function() {
        this.disabled = true;
    };

    this.enableSearch = function() {
        this.searchEnabled = true;
    }

    this.disableSearch = function() {
        this.searchEnabled = false;
    }

    this.trustAsHtml = function(value) {
        return $sce.trustAsHtml(value);
    };

    this.clear = function() {
        this.categorie.selected = undefined;
    };

    this.counter = 0;

    this.someFunction = function (item, model){
        this.counter++;
        this.eventResult = {item: item, model: model};
    };

    this.removed = function (item, model) {
        this.lastRemoved = {
            item: item,
            model: model
        };
    };

    this.selectedCategories = {};
    this.categorie = {};
    this.categories = [];

    /* capture this (the controller scope ) as self */
    var self = this;

    /* function for refreshing the asynchronus retrival of blocs */
    this.refresh = function() {
        Categories.query()
            .then(function (data) {
                self.categories = data;
            });
    }

    this.refresh();

    /* When one categorie is selected in the dropdown */
    this.changed = function(){ };

}]);

Filter.directive('isotope', function($timeout) {
    return {
        restrict: "EA",
        scope: false,
        link: function (scope, element, attrs) {

            $('.isotope').isotope({ itemSelector: 'post'});

            scope.$watch('selectedCategories', function(newVal, oldVal){
                $timeout(function(){
                    console.log('changed!');
                    $('.isotope').isotope( 'reloadItems' ).isotope({ filter: scope.selectedCategories  });
                });
            },true);
        }
    };
});

