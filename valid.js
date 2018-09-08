 angular.module('ngPatternExample', [])
    .controller('ExampleController', ['$scope', function($scope) {
      $scope.regex = /^[^`~!@#$%\^&*()_+={}|[\]\\:';"<>?,./1-9]*$/;
    }])
    .directive('myDirective', function() {
        function link(scope, elem, attrs, ngModel) {
            ngModel.$parsers.push(function(viewValue) {
              var reg = /^[^`~!@#$%\^&*()_+={}|[\]\\:';"<>?,./-]*$/;
              // if view values matches regexp, update model value
              if (viewValue.match(reg)) {
                return viewValue;
              }
              // keep the model value as it is
              var transformedValue = ngModel.$modelValue;
              ngModel.$setViewValue(transformedValue);
              ngModel.$render();
              return transformedValue;
            });
        }

        return {
            restrict: 'A',
            require: 'ngModel',
            link: link
        };      
    });
   