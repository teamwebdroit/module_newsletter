(function ($) {



})(jQuery);


// attach the .equals method to Array's prototype to call it on any array
Array.prototype.equals = function (array) {
    // if the other array is a falsy value, return
    if (!array)
        return false;

    // compare lengths - can save a lot of time
    if (this.length != array.length)
        return false;

    for (var i = 0, l=this.length; i < l; i++) {
        // Check if we have nested arrays
        if (this[i] instanceof Array && array[i] instanceof Array) {
            // recurse into the nested arrays
            if (!this[i].equals(array[i]))
                return false;
        }
        else if (this[i] != array[i]) {
            // Warning - two different object instances will never be equal: {x:20} != {x:20}
            return false;
        }
    }
    return true;
};

var Filter = angular.module('filtering', ["ngResource", 'ui.select','ngSanitize']).config(function($interpolateProvider){
    $interpolateProvider.startSymbol('{[{').endSymbol('}]}');
}).config(function(uiSelectConfig) {
    uiSelectConfig.theme = 'select2';
}).service('myService',  function ($rootScope) {
    var selected = [];
    return {
        getSelected : function() {
            return selected;
        },
        setSelected : function(select) {
            selected = select;
        },
        isSelected : function(cat){

            if(selected.length > 0){
                var res = cat.replace(/cat-/g, "");
                var res = res.split(" ");
                res.filter(Boolean);

                $.arrayIntersect = function(a, b)
                {
                    return $.grep(a, function(i)
                    {
                        return $.inArray(i, b) > -1;
                    });
                };

                var compare = $.arrayIntersect(selected,res);

                return (compare.equals(selected) ? true : false);
            }
            else
            {
                return true;
            }
        }
    };
});

/**
 * Retrive all arrets blocs for bloc arret
 */
Filter.factory('Arrets', ['$http', '$q', function($http, $q) {
    return {
        query: function() {
            var deferred = $q.defer();
            $http.get('/preparedArrets').success(function(data) {
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

Filter.controller('ArretController', ['$scope','$timeout','$http','Arrets','myService',function($scope,$timeout,$http,Arrets,myService){

    this.loading = true;
    /* capture this (the controller scope ) as self */
    var self     = this;
    this.allpost = [];

    this.refresh = function() {
        Arrets.query()
            .then(function (data) {
                self.allpost = data;
                self.loading = false;
            });
    }
    this.refresh();

    this.isSelected = function(cat){
        return myService.isSelected(cat);
    };

}]);

/**
 * Select arret controller, select an arret and display's it
 */
Filter.controller('FilterController', ['$scope','$http', '$sce','Categories','myService',function($scope,$http,$sce,Categories,myService){

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

    this.filterFunction = function(element) {
        myService.setSelected(element);
    };

}]);

Filter.directive('postText', function($timeout) {
    return {
        restrict: "EA",
        scope: false,
        templateUrl: "post-text"
        /*link: function (scope, element, attrs) {

            $('.isotope').isotope({ itemSelector: 'post'});

            scope.$watch('selectedCategories', function(newVal, oldVal){
                $timeout(function(){
                    console.log('changed!');
                    $('.isotope').isotope( 'reloadItems' ).isotope({ filter: scope.selectedCategories  });
                });
            },true);
        }*/
    };
});


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

