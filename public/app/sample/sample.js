'use strict';

angular.module('app.sample', [
  'ui.router',
  'ui.bootstrap',
  'ngTagsInput',
  'app.sample.sample_directive',
])

.config(['$stateProvider', function($stateProvider) {
  $stateProvider
  .state('layout.sample', {
    url: '/sample/list',
    templateUrl: 'app/sample/list.html',
    controller: 'SampleCtrl'
  })
  .state('layout.sample_input', {
    url: '/sample/input',
    templateUrl: 'app/sample/input.html',
    controller: 'SampleCtrl'
  })
  .state('layout.sample_inputcomplete', {
    url: '/sample/input_complete',
    templateUrl: 'app/sample/input_complete.html',
    controller: 'SampleCtrl'
  })
  .state('layout.sample_edit', {
    url: '/sample/edit/{id:[0-9].*}',
    templateUrl: 'app/sample/edit.html',
    controller: 'SampleCtrl'
  })
  .state('layout.sample_editcomplete', {
    url: '/sample/edit_complete',
    templateUrl: 'app/sample/edit_complete.html',
    controller: 'SampleCtrl'
  })
  ;
}])

.controller('SampleCtrl', ['$scope', '$http', '$interval', '$state', '$filter','$log', 'config',  function($scope, $http, $interval, $state, $filter, $log, config){
    console.log('execute SampleCtrl.');

    //init
    $scope.input     = {};
    $scope.search    = {};
    $scope.status    = "";
    $scope.message   = "";
    $scope.now       = "";
    $scope.page       = "";

    $scope.rule      = config.ValidationRule;
    $scope.m_message = config.ValidationMessage;

    //array for option
    $scope.themes      = ["Yellow","Black","Pink"];
    $scope.m_status    = {1:"利用可能",
                          2:"利用不可",
                         };
    $scope.displayFlg  = ["表示する"];
    $scope.m_tablet    = { 1:"持っていない",
                           2:"iPad",
                           3:"Surface",
                           4:"Xperia",
                           5:"fire HD",
                           6:"Nexus",
                           7:"Galaxy",
                           8:"ZenPad",
                           9:"Arrows Tab",
                          10:"Regza Tablet",
                          11:"Kindle",
                          12:"Kobo",
                          99:"その他",
                         };
    // for preview modal setting, do not change field name '$scope.options'
    $scope.options = {color:             'rgba(0,0,0,0.9)',
                      animatedIn:        'fadeIn',
                      animatedOut:       'fadeOut',
                      animationDuration: '1s',
                      overflow:          'auto'
                     };

    $scope.sortingOrder  = 'number';//sortingOrder;
    $scope.reverse       = false;
    $scope.filteredItems = [];
    $scope.groupedItems  = [];
    $scope.itemsPerPage  = 10;
    $scope.pagedItems    = [];
    $scope.maxSize       = 10;
    if ($scope.currentPage == undefined) {
        console.log('currentPage: '+$scope.currentPage);
        $scope.currentPage   = 1;
    }
    
    $scope.search.pageNum   = 1;
    
    $scope.bigTotalItems = 10000;

    // get data from database
    $scope.items = [];
    var items = '';
    $log.debug('ajax request [getList.php]');
    $http.get('./scripts/getList.php',{}).
    success(function(data, status) {
        $scope.items = data;
        $scope.totalItems = data.length;
        $scope.search();
    }).
    error(function(data, status) {
        $log.error('Request to get Data failed.');
        alert('Request to get Data failed.');
    });

    var searchMatch = function (haystack, needle) {
        if (!needle) {
            return true;
        }
        return haystack.toLowerCase().indexOf(needle.toLowerCase()) !== -1;
    };

    // initual value setting.
    $log.debug('location pathname [' + location.pathname + ']');
    $log.debug('location hash [' + location.hash + ']');
    console.log($scope.id);
    var pageHash = location.hash;

    if (pageHash.match('#/sample/edit/[0-9].*')) {
        $scope.input.id                      = pageHash.replace('#/sample/edit/', '');
        $scope.input.mail                    = 'tanaka.ichiro@hoge.com';
        $scope.input.name01                  = '田中一郎';
        $scope.input.kana01                  = 'タナカイチロウ';
        $scope.input.password                = '12345678';
        $scope.input.password_confirmation   = '12345678';
        $scope.input.status                  = '2';
        $scope.input.theme                   = 'Black';
        $scope.input.zipcode1                = '550';
        $scope.input.zipcode2                = '0001';
        $scope.input.pref                    = '27';
        $scope.input.addr                    = '大阪市北区';
        $scope.input.imageSrc                = './uploads/DsvVAS.jpg';
        $scope.input.cardSrc                 = 'BRHv7E.pdf';
        $scope.input.display_flg             = true;
        $scope.input.tablet                  = {'2':true, '10':true, '99':true};
        $scope.isCheckTablet                 = true;
        $scope.input.other_tablet            = 'AsusPad';
        $scope.input.tag                     = [{text: "Apple"}, {text: "Orange"}];
        $scope.input.public_date             = '2016/01/03';
        $scope.input.start_date              = '2016/12/01 10:00';
        $scope.input.body                    = '自己紹介文は後ほど記載します。';
        $scope.input.description             = '補足事項は特にはありません。';

        $state.go('layout.sample_edit');

    } else if (pageHash.match('#/sample/input$')) {
        //$scope.input = {};
        $scope.isCheckTablet                 = false;
        $scope.isCheckTabletInit             = true;
        //$log.debug('isCheckTablet- '+$scope.isCheckTablet + ' isCheckTabletInit- '+$scope.isCheckTabletInit);
        
        $state.go('layout.sample_input');
    };

    // init the filtered items
    $scope.pageChanged = function (num) {
        $log.debug('pager: ' + num);
    };

    // init the filtered items
    $scope.search = function () {
        //$log.debug($scope.list);
        $scope.filteredItems = $filter('filter')($scope.items, function (item) {
            for(var attr in item) {
                if (searchMatch(item[attr], $scope.search.query))
                    return true;
            }
            return false;
        });
        $scope.groupToPages();
    };

    // calculate page in place
    $scope.groupToPages = function () {
        $scope.pagedItems = [];
        $log.debug('scope.filteredItems.length: ' + $scope.filteredItems.length);
        $scope.totalItems = $scope.filteredItems.length;
        for (var i = 0; i < $scope.filteredItems.length; i++) {
            if (i % $scope.itemsPerPage === 0) {
                $scope.pagedItems[Math.floor(i / $scope.itemsPerPage)+1] = [$scope.filteredItems[i]];
            } else {
                $scope.pagedItems[Math.floor(i / $scope.itemsPerPage)+1].push($scope.filteredItems[i]);
            }
        }
    };

    // functions have been describe process the data for display
    $scope.search();

    // change sort order
    $scope.sortBy = function(orderId) {
        if ($scope.sortingOrder == orderId)
            $scope.reverse = !$scope.reverse;

        $scope.sortingOrder = orderId;
        
        // icon setup
        $('th i').each(function(){
            // icon reset
            $(this).removeClass('fa-sort');
            $(this).removeClass('fa-sort-up');
            $(this).removeClass('fa-sort-down');
        });
        if ($scope.reverse) {
            $log.debug('sort icon changed to reverse.');
            $('th.th_'+orderId+' i').removeClass().addClass('fa-sort-up');
        } else {
            $log.debug('sort icon changed.');
            $('th.th_'+orderId+' i').removeClass().addClass('fa-sort-down');
        }
        
    };

    $scope.changeCount = function(num) {
        $log.debug('change view count [' + num + ']');
        $scope.itemsPerPage = num;
        $scope.search();
    }

    // delete record
    $scope.removeUser = function(index) {
        $log.debug('No.'+index+' delete ok.');
        $('#row-'+index).remove();
        alert('削除が完了しました。');
    };

    // checkboxes selected at least one for tablet field
    $scope.someSelected = function(){
        $scope.isCheckTablet = false;
        for(var key in $scope.input.tablet){
            //$log.debug('input.tablet: Key -' +key +' val- '+$scope.input.tablet[key]);
            if($scope.input.tablet[key]){
                $scope.isCheckTablet = true;
                $scope.isCheckTabletInit = false;
                //$log.debug('input.tablet: Key -' +key +' isCheckTablet- '+$scope.isCheckTablet + ' isCheckTabletInit- '+$scope.isCheckTabletInit);
            }
        }
    };

    // array for option from database
    $log.debug('ajax request [getMPref.php]');
    $http.get('./scripts/getMPref.php',{}).
    success(function(data, status) {
        $scope.m_pref = data;
    }).
    error(function(data, status) {
      $log.error('Request to get Prefecture failed.');
      alert('Request to get Prefecture failed.');
      $scope.m_pref = data || [];
    });

    // prefSearch button clicked.
    $log.debug('ajax request [getAddrFromZipcode.php]');
    $scope.prefSearch = function() {
      $http.post("./scripts/getAddrFromZipcode.php", {'zipcode1':$scope.input.zipcode1, 'zipcode2':$scope.input.zipcode2}).
      success(function(data, status) {
        $scope.input.pref = data.pref;
        $scope.input.addr = data.addr;
      }).
      error(function(data, status) {
        $log.error('Request to get Address using zipcode failed.');
        alert('Request to get Address using zipcode failed.');
      });
    };

    // submit button clicked.
    $scope.submit = function() {
      $log.debug('ajax request [submit.php]');
      $log.debug(JSON.stringify($scope.input));
      $http.post("/v3/sample/store", JSON.stringify($scope.input),{}).
      success(function(data, status) {
        $scope.data   = data;
        $scope.status = status;
        $("body").animate({scrollTop: 0}, "slow");
        window.location.href = '#/sample/input_complete';
      }).
      error(function(data, status) {
        $log.error('Ajax Request failed.');
        alert("Ajax Request failed.");
        $scope.data = data || "Request failed";
        $scope.status = status;
        $scope.message = data.message;
      });
    };

    // update button clicked.
    $scope.update = function() {
      $log.debug('ajax request [update.php]');
      $log.debug(JSON.stringify($scope.input));
      $http.post("/v3/sample/update", JSON.stringify($scope.input), {}).
      success(function(data, status) {
        $scope.data   = data;
        $scope.status = status;
        console.log($scope.input);
        $("body").animate({scrollTop: 0}, "slow");
        window.location.href = '#/sample/edit_complete';
      }).
      error(function(data, status) {
        $log.error('Ajax Request failed.');
        alert("Ajax Request failed.");
        $scope.data = data || "Request failed";
        $scope.status = status;
        $scope.message = data.message;
      });
    };
}]);