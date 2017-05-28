'use strict';

angular.module('app.core.core_filter', [])

// text string replace filter
.filter('replace', [function() {
    return function (str, r1, r2) {
      return str.replace(r1, r2, 'g');
    };
  }
])
// html tag replace filter
.filter('replaceTag', ['$scope', function($scope) {
    return function (str, r1, r2) {
      str = str.replace(r1, r2, 'g');
      return $scope.trustAsHtml(str);
    };
  }
]);