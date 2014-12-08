
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

}).config(function(uiSelectConfig) { uiSelectConfig.theme = 'select2'; });

/**
 * Service to pass the selected categories from filter to ArretController
 * and set correct pagination on list
 */
Filter.service('selectionFilter',  function ($rootScope) {

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
                var res = cat.split(" ");
                res.filter(Boolean);

                $.arrayIntersect = function(a, b){
                    return $.grep(a, function(i){
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
 * Retrive all arrets for posts
 * and prepare them in controller
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
 * Retrive all annees for posts filter
 */
Filter.factory('Annees', ['$http', '$q', function($http, $q) {
    return {
        query: function() {
            var deferred = $q.defer();
            $http.get('/preparedAnnees')
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

Filter.controller('ArretController', ['$scope','$timeout','$http','Arrets','selectionFilter',  function($scope,$timeout,$http,Arrets,selectionFilter){

    /* Set loading to true to hide all arrets during loading from server */
    this.loading  = true;

    /* capture this (the controller scope ) as self */
    var self     = this;

    /* empty all posts to empty array will be populated later */
    this.allpost = [];

    /* number of items per page for pagination */
    this.itemsPerPage  = 5;

    /* the current page in scope so we can watch it! */
    $scope.currentPage = 0;

    /* prev page button */
    this.prevPage = function() {
        if ($scope.currentPage > 0) {
           // $scope.currentPage--;
        }
    };

    /* prev page button disabled if 0  */
    this.prevPageDisabled = function() {
        //return $scope.currentPage === 0 ? "disabled" : "";
    };

    /* test if we are on the current page for styles in pagination links  */
    this.isCurrentPage = function(page) {
        //return $scope.currentPage === page ? "current" : "";
    };

    /* next page button  */
    this.nextPage = function() {
        if ($scope.currentPage < self.pageCount() - 1) {
            //$scope.currentPage++;
        }
    };

    /* next page button disabled if 0  */
    this.nextPageDisabled = function() {
        //return $scope.currentPage === self.pageCount() - 1 ? "disabled" : "";
    };

    /* calculate page count from total and itemPerPage  */
    this.pageCount = function() {
        //return Math.ceil(self.getTotal()/self.itemsPerPage);
    };

    /* *
     * If the currentPage variable changes:
     * slice items to be displayed from allposts array from offset to limit
     * set total variable to change pagination
     * Go to top page
     */
    $scope.$watch("currentPage", function(newValue) {

/*        self.pagedItems = self.get(newValue * self.itemsPerPage, self.itemsPerPage);
        self.total = self.getTotal();
        $('body,html').animate({ scrollTop: 0 }, 600);*/

    });

    $scope.$on('ngRepeatFinished', function(ngRepeatFinishedEvent) {
        var innerHeight = jQuery('#inner-content').outerHeight();
        innerHeight = innerHeight + 30;
        jQuery('#sidebar').css('height',innerHeight);
        console.log('height' + innerHeight);
    });

    /* set current page  */
    this.setPage = function(n) {
        if (n > 0 && n < self.pageCount() || n == 0) {
            $scope.currentPage = n;
        }
    };

    /**
     * Range of pagination
     * If we have less thant 5 pages set the rang to the pagecount
     * or else we have negative values :(
     */
    this.range = function() {
        var rangeSize = (self.pageCount() > 5 ? 5 : self.pageCount() );
        var ret = [] , start;
        start = $scope.currentPage;
        if ( start > self.pageCount() - rangeSize ) { start = self.pageCount() - rangeSize; }
        for (var i = start; i < start + rangeSize; i++) {
            ret.push(i);
        }
        return ret;
    };

    /* slice portion of allpost  */
    this.get = function(offset, limit) {
        return self.allpost.slice(offset, offset + limit);
    };

    /* get total of allpost  */
    this.getTotal = function() {
        return self.allpost.length;
    };

    this.isEmpty = function(){
        //return (self.pagedItems.length == 0 ? true : false);
    };

    /**
     * Async get of allposts
     * then refresh the variable to display all arrets
     * hide loader
     * get portion of all post for pagination
    */
    this.refresh = function() {
        Arrets.query().then(function (data) {
            self.allpost    = data;
            self.loading    = false;
            //self.pagedItems = self.get($scope.currentPage,self.itemsPerPage);
        });
    }

    /* refresh all the things!  */
    this.refresh();

    /**
     *  if the selected categories in filter is updated in service
     *  query again allposts and filter with categories
     *  set current page to 0
     *  get new total for pagination
     */
    $scope.$on('selected:updated', function() {

        var selectedCat = (selectionFilter.getSelected().length > 0 ? selectionFilter.getSelected() : null );

    /*
        Arrets.query(selectedCat).then(function (data) {
            self.allpost    = data;
            self.pagedItems = self.get(0 * self.itemsPerPage, self.itemsPerPage);
            $scope.currentPage = 0;
            self.total = self.getTotal();
        });
    */

    });

    /* filter posts with selected categories */
    this.isSelected = function(cat){
        return selectionFilter.isSelected(cat);
    };

}]);

/**
 * Select arret controller, select an arret and display's it
 */
Filter.controller('FilterController', ['$scope','$http', '$sce','Categories','Annees','selectionFilter', function($scope,$http,$sce,Categories,Annees,selectionFilter){

    /* set variables  */
    this.disabled      = undefined;
    this.searchEnabled = undefined;
    this.counter = 0;

    $scope.selectedCategories = {};
    this.categorie = {};
    this.categories = [];

    this.annee    = {};
    $scope.annees = [];

    /**
     * Change checkboxes values when change
     * Push new year in filter if year is selected
     */
    $scope.change = function (annee) {

        // remove current year in filter if there is any
        var selected  = $scope.removeAnnee(selectionFilter.getSelected());

        // Delects all checkboxes
        angular.forEach($scope.annees, function(item) {
            item.checked = false;
        });

        // Set current selected year to true
        annee.checked = true;

        // push new year in filter
        if(annee.checked)
        {
            selected.push('year-' + annee.year);
        }

        // update master filter with new value
        selectionFilter.setSelected(selected);

    };

    /**
     * Update checkbox value on click
     * if already checked set to false and remove it from filter
     */
    $scope.update = function(annee){

       var id = annee.id;

       if( $scope.annees[annee.id].checked)
       {
           $scope.annees[id].checked = false;
           var selected  = $scope.removeAnnee(selectionFilter.getSelected());
           selectionFilter.setSelected(selected);
       }
    };

    /* remove current annee in master filter */
    $scope.removeAnnee = function(selected){

        for (i=0;i < selected.length;i++)
        {
            if (selected[i].indexOf('year-') > -1) {
                selected.splice(i,1);
            }
        }
        return selected;
    }

    /* remove current categories for update in master filter */
    $scope.removeCategory = function(selected){

        for (i=0;i < selected.length;i++)
        {
            if (selected[i].indexOf('cat-') > -1) {
                selected.splice(i,1);
            }
        }
        return selected;
    }

    /* filter is enabled */
    this.enable = function() {
        this.disabled = false;
    };

    /* filter is disabled */
    this.disable = function() {
        this.disabled = true;
    };

    /* search on filter is enable */
    this.enableSearch = function() {
        this.searchEnabled = true;
    }

    /* search on filter is disabled */
    this.disableSearch = function() {
        this.searchEnabled = false;
    }

    /* last removed categories */
    this.removed = function (item, model) {
        this.lastRemoved = {item: item, model: model
        };
    };

    /* capture this (the controller scope ) as self */
    var self = this;

    /* function for refreshing the asynchronus retrival of categorie */
    this.refresh = function() {
        Categories.query()
            .then(function (data) {
                self.categories = data;
            });

        Annees.query()
            .then(function (data) {
                $scope.annees = data;
            });
    }

    /* refresh all the things!  */
    this.refresh();

    /* set selected categorie in service  */
    this.filterFunction = function(element) {

        var select   = $scope.removeCategory(selectionFilter.getSelected());
        var prefixed = self.addPrefix(element);
        var selected = select.concat(prefixed);

        // filter unique values
        selected = $.grep(selected, function(v, k){ return $.inArray(v ,selected) === k; });

        selectionFilter.setSelected(selected);
    };

    this.addPrefix = function(array){
        var cats = [];

        $.each(array, function(index, value) {
            var prefix = 'cat-' + value;
            cats.push(prefix);
        });

        return cats;
    }
}]);

Filter.directive('onFinishRender', function ($timeout) {
    return {
        restrict: 'A',
        link: function (scope, element, attr) {
            if (scope.$last === true) {
                $timeout(function () {
                    scope.$emit('ngRepeatFinished');
                });
            }
        }
    }
});

/**
 * post directive
 */
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
/*Filter.filter('pagination', function()
{
    return function(input, start)
    {
        start = +start;
        return input.slice(start);
    };
});*/

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

