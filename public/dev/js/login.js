var app = angular.module('app',[]);
app.config(function ($logProvider) {
    // logger enabled.
    $logProvider.debugEnabled(true);
})
.controller('mainController', ['$scope', '$http', function($scope, $http){

    //init
    $scope.input     = {};
    $scope.status    = "";
    $scope.message   = "";

    $scope.m_message = {
        'required'  : '必須項目のため、必ず入力してください。',
    };

    // login button clicked.
    $scope.login = function() {
      $http.post("./login.php", JSON.stringify($scope.input),{}).
      success(function(data, status) {
        $scope.data   = data;
        $scope.status = status;
        window.location.href = './';
      }).
      error(function(data, status) {
        //alert("Ajax Request failed.");
        $scope.data = data || "Request failed";
        $scope.status = status;
        $scope.message = data.message;
      });
    };

}]);
