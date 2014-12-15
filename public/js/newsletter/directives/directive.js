var Newsletter = angular.module('newsletter');

/**
 * Build directive, display all types of content
 */
Newsletter.directive("buildingBlocs", function() {
    return {
        restrict: "EA",
        scope:true,
        templateUrl: "building-blocs"
    };
});

Newsletter.directive("newsletterView", ['Content' ,function(Content) {
    return {
        template: '<ng-include src="template"/>',
        restrict: 'E',
        controller: function($scope) {
            var campagne = $('#campagne_id').val();
            //function used on the ng-include to resolve the template
            $scope.template = 'admin/campagne/view/' + campagne;
            // Refresh include on add content
            $scope.$on('newsletter:updated', function() {
                var random = Math.random();
                $scope.template = 'admin/campagne/view/' + campagne + '?' + random;
            });
            /* assign empty values for blocs */
            this.contentBloc = {};
            /* capture this (the controller scope ) as self */
            var self = this;
            $scope.getContent = function(id){
                Content.query(id)
                    .then(function (data) {
                        self.contentBloc = data;
                        console.log(self.contentBloc);
                    });
            };
        }
    };
}]);


/* =========================
    Templates for creation
  ========================= */

/*
Newsletter.directive("arret", function() {
    return {
        restrict: "EA",
        templateUrl: "arret"
    };
});
*/

Newsletter.directive("imageLeftText", function() {
    return {
        restrict: "EA",
        scope   :{ngModel: '='},
        templateUrl: "image-left-text"
    };
});

Newsletter.directive("imageRightText", function() {
    return {
        restrict: "EA",
        scope   :{ngModel: '='},
        templateUrl: "image-right-text"
    };
});

Newsletter.directive("imageText", function() {
    return {
        restrict: "EA",
        scope   :{ngModel: '='},
        templateUrl: "image-text"
    };
});

Newsletter.directive("imageAlone", function() {
    return {
        restrict: "EA",
        scope   :{ngModel: '='},
        templateUrl: "image"
    };
});

Newsletter.directive("textAlone", function() {
    return {
        restrict: "EA",
        scope   :{ngModel: '='},
        templateUrl: "text"
    };
});

/* =========================
 Templates for edition
 ========================= */

Newsletter.directive("arretEdit", function() {
    return {
        restrict: "EA",
        templateUrl: "arret-edit"
    };
});

Newsletter.directive("imageLeftTextEdit", function() {
    return {
        restrict: "EA",
        templateUrl: "image-left-text-edit"
    };
});

Newsletter.directive("imageRightTextEdit", function() {
    return {
        restrict: "EA",
        templateUrl: "image-right-text-edit"
    };
});

Newsletter.directive("imageTextEdit", function() {
    return {
        restrict: "EA",
        templateUrl: "image-text-edit"
    };
});

Newsletter.directive("imageAloneEdit", function() {
    return {
        restrict: "EA",
        templateUrl: "image-edit"
    };
});

Newsletter.directive("textAloneEdit", function() {
    return {
        restrict: "EA",
        templateUrl: "text-edit"
    };
});
