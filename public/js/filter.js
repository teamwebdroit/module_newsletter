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

}).config(function(uiSelectConfig) { uiSelectConfig.theme = 'select2'; })
  .service('myService',  function ($rootScope) {

    var selected = [];

    return {
        getSelected : function() {
            return selected;
        },
        setSelected : function(select) {
            selected = select;
            $rootScope.$broadcast('selected:updated');
        },
        isSelected : function(cat){
            if(selected.length > 0)
            {
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
            else{ return true; }
        }
    };
});

/**
 * Retrive all arrets blocs for bloc arret
 */
Filter.factory('Arrets', ['$http', '$q', function($http, $q) {
    return {
        query: function(selected) {
            var deferred = $q.defer();
            $http.get('/preparedArrets', {
                    params: {  selected: JSON.stringify(selected) }
                })
                .success(function(data) {
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

    this.loading  = true;
    this.paginate = true;

    /* capture this (the controller scope ) as self */
    var self     = this;
    this.allpost = [];

    this.itemsPerPage  = 5;
    $scope.currentPage = 0;

    this.prevPage = function() {
        if ($scope.currentPage > 0) {
            $scope.currentPage--;
        }
    };

    this.prevPageDisabled = function() {
        return $scope.currentPage === 0 ? "disabled" : "";
    };

    this.isCurrentPage = function(page) {
        return $scope.currentPage === page ? "current" : "";
    };

    this.nextPage = function() {
        if ($scope.currentPage < self.pageCount() - 1) {
            $scope.currentPage++;
        }
    };

    this.nextPageDisabled = function() {
        return $scope.currentPage === self.pageCount() - 1 ? "disabled" : "";
    };

    this.pageCount = function() {
        return Math.ceil(this.getTotal()/self.itemsPerPage);
    };

    $scope.$watch("currentPage", function(newValue) {

        self.pagedItems = self.get(newValue * self.itemsPerPage, self.itemsPerPage);
        self.total = self.getTotal();
        $('body,html').animate({ scrollTop: 0 }, 600);

    });

    this.setPage = function(n) {
        if (n > 0 && n < self.pageCount()) {
            $scope.currentPage = n;
        }
    };

    this.range = function() {
        var rangeSize = 5;
        var ret = [];
        var start;
        start = $scope.currentPage;
        if ( start > self.pageCount()-rangeSize ) { start = self.pageCount()-rangeSize;}
        for (var i = start; i < start + rangeSize; i++) {
            ret.push(i);
        }
        return ret;
    };

    this.get = function(offset, limit) {
        return self.allpost.slice(offset, offset + limit);
    };

    this.getTotal = function() {
        return self.allpost.length;
    };

    this.refresh = function() {
        Arrets.query().then(function (data) {
            self.allpost    = data;
            self.loading    = false;
            self.pagedItems = self.get($scope.currentPage,self.itemsPerPage);
        });
    }

    this.refresh();

    $scope.$on('selected:updated', function() {

        Arrets.query(myService.getSelected()).then(function (data) {
            self.allpost    = data;
            self.pagedItems = self.get($scope.currentPage,self.itemsPerPage);
            self.total      = self.getTotal();
        });

    });

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
    };
});

/**
 * Pagination filter
 */
Filter.filter('pagination', function()
{
    return function(input, start)
    {
        start = +start;
        return input.slice(start);
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

