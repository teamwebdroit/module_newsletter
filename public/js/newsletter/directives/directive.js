var Newsletter = angular.module('newsletter');

/**
 * Build directive, display all types of content
 */
Newsletter.directive("buidingBlocs", function() {
    return {
        restrict: "EA",
        scope:true,
        template: "templates/building-blocs.php"
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

Newsletter.directive("arret", function() {
    return {
        restrict: "EA",
        templateUrl: "arret"
    };
});

Newsletter.directive("imageLeftText", function() {
    return {
        restrict: "EA",
        scope   :{ngModel: '='},
        templateUrl: "templates/create/image-left-text.php"
    };
});

Newsletter.directive("imageRightText", function() {
    return {
        restrict: "EA",
        scope   :{ngModel: '='},
        templateUrl: "templates/create/image-right-text.php"
    };
});

Newsletter.directive("imageText", function() {
    return {
        restrict: "EA",
        scope   :{ngModel: '='},
        templateUrl: "templates/create/image-text.php"
    };
});

Newsletter.directive("imageAlone", function() {
    return {
        restrict: "EA",
        scope   :{ngModel: '='},
        templateUrl: "templates/create/image.php"
    };
});

Newsletter.directive("textAlone", function() {
    return {
        restrict: "EA",
        scope   :{ngModel: '='},
        templateUrl: "templates/create/text.php"
    };
});

/* =========================
 Templates for edition
 ========================= */

Newsletter.directive("arretEdit", function() {
    return {
        restrict: "EA",
        templateUrl: "templates/edit/arret.php"
    };
});

Newsletter.directive("imageLeftTextEdit", function() {
    return {
        restrict: "EA",
        templateUrl: "templates/edit/image-left-text.php"
    };
});

Newsletter.directive("imageRightTextEdit", function() {
    return {
        restrict: "EA",
        templateUrl: "templates/edit/image-right-text.php"
    };
});

Newsletter.directive("imageTextEdit", function() {
    return {
        restrict: "EA",
        templateUrl: "templates/edit/image-text.php"
    };
});

Newsletter.directive("imageAloneEdit", function() {
    return {
        restrict: "EA",
        templateUrl: "templates/edit/image.php"
    };
});

Newsletter.directive("textAloneEdit", function() {
    return {
        restrict: "EA",
        templateUrl: "templates/edit/text.php"
    };
});
