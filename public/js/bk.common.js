var app = angular.module('app',[]);
app.config(function ($logProvider) {
    // logger enabled.
    $logProvider.debugEnabled(true);
})
.controller('mainController', ['$scope', '$http', '$interval', '$filter', function($scope, $http, $interval, $filter){

    //init
    $scope.input     = {};
    $scope.status    = "";
    $scope.message   = "";
    $scope.now       = "";

    // array for option from database
    $http.get('/scripts/getMPref.php',{}).
    success(function(data, status) {
        $scope.m_company = data;
    }).
    error(function(data, status) {
      alert('Request to get Company failed.');
      $scope.m_company = data || [];
    });

    // array for option from database
    $http.get('/scripts/getMPref.php',{}).
    success(function(data, status) {
        $scope.m_pref = data;
    }).
    error(function(data, status) {
      alert('Request to get Prefecture failed.');
      $scope.m_pref = data || [];
    });

    // prefSearch button clicked.
    $scope.prefSearch = function() {
      $http.post("/scripts/getAddrFromZipcode.php", {zipcode:$scope.input.zipcode}).
      success(function(data, status) {
        $scope.input.zipcode1 = data.pref;
        $scope.input.zipcode2 = data.addr;
      }).
      error(function(data, status) {
        alert('Request to get Address using zipcode failed.');
      });
    };

    $scope.calIcon = function(id) {
      //console.log("datetimepicker button clicked.");
      $('#'+id).datetimepicker('show');
    };

}]);

// datepicker selected
app.directive('datepicker', function () {
    return {
        restrict: 'A',
        require: 'ngModel',
         link: function (scope, element, attrs, ctrl) {
            element.datepicker({
                dateFormat: 'yy/mm/dd',
                showOn: 'focus',
                minDate:'-80',
                maxDate:'30',
                changeMonth: true,
                changeYear: true,
                constrainInput: true,
                numberOfMonths: 3,
            });
            element.bind("change", function () {
                if (new Date(element.val()) == "Invalid Date") {
                  ctrl.$setValidity('dateCheck', true);
                } else {
                  ctrl.$setValidity('dateCheck', false);
                }
                return;
            });
        }
    };
});

// datetimepicker selected
app.directive('datetimepicker', function () {
    return {
        restrict: 'A',
        require: 'ngModel',
         link: function (scope, element, attrs, ctrl) {
            element.datetimepicker({
                timepicker:true,
                format:'Y/m/d H:i',
                minDate:'-1970/01/01',
                maxDate:'+1970/01/08',
                defaultTime:'10:00',
                validateOnBlur: false,
                allowTimes:[
                    '08:00', '09:00', '10:00', '11:00', '12:00',
                    '13:00', '14:00', '15:00', '16:00', '17:00',
                    '18:00', '19:00', '20:00', '21:00', '22:00',
                ],
            });
            element.bind("change", function () {
                if (new Date(element.val()) == "Invalid Date") {
                  ctrl.$setValidity('dateCheck', true);
                } else {
                  ctrl.$setValidity('dateCheck', false);
                }
                return;
            });
        }
    };
});

app.directive('animatedModal',function(){
  return{
    restrict: 'A',
    scope1:{
      options: '=',
      beforeOpen: '&',
      afterClose: '&'
    },
    link: function(scope1, element, attrs){
      var id="animatedmodal"+Math.floor(Math.random()*100000000);
      attrs.href=attrs.href||'animatedModal';
      //console.log(attrs.href);
      scope1.options=scope1.options||{};
      // Set element id
      element.attr('id',id);
      scope1.setting={
        modalTarget : attrs.href.replace('#','')
      }
      scope1.setting=angular.extend(scope1.setting,scope1.options);
      if(scope1.setting.modalTarget!=attrs.href.replace('#','')){
        element.attr('href','#'+scope1.setting.modalTarget);
      }
      scope1.beforeOpen=scope1.beforeOpen||function(){};
      scope1.afterClose=scope1.afterClose||function(){};

      scope1.setting.beforeOpen=function(){
        scope1.beforeOpen();
      }
      scope1.setting.afterClose=function(){
        scope1.afterClose();
      };
      $('#'+id).animatedModal(scope1.setting);
    }
  }
});
