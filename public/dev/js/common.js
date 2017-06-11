var app = angular.module('app',['ui.router', 'ui.bootstrap', 'ngTagsInput']);
app.config(['$stateProvider',function($stateProvider){
    $stateProvider
      .state('login', {
        url: '/login',
        templateUrl: 'login.html'
      })
      .state('index', {
        url: '/index',
        templateUrl: 'index.html'
      })
      .state('list', {
        url: '/list',
        templateUrl: 'list.html'
      })
      .state('input', {
        url: '/input',
        templateUrl: 'input.html'
      })
      .state('input_complete', {
        url: '/input/complete',
        templateUrl: 'input_complete.html'
      })
      .state('edit', {
        url: '/edit',
        templateUrl: 'edit.html'
      })
      .state('edit_complete', {
        url: '/edit/complete',
        templateUrl: 'edit_complete.html'
      })
}])
.config(function ($logProvider) {
    // logger enabled.
    $logProvider.debugEnabled(true);
})
//.config(['uibPaginationConfig', function(uibPaginationConfig){
//    uibPaginationConfig.previousText = "‹";
//    uibPaginationConfig.nextText     = "›";
//    uibPaginationConfig.firstText    = "«";
//    uibPaginationConfig.lastText     = "»";
//}])
.controller('mainController', ['$scope', '$http', '$interval', '$state', '$filter', function($scope, $http, $interval, $state, $filter){

    //init
    $scope.input     = {};
    $scope.status    = "";
    $scope.message   = "";
    $scope.now       = "";

    // validation rule
    $scope.number    = /^\d+$/;
    $scope.zipcode1  = /^[0-9]{3}$/;
    $scope.zipcode2  = /^[0-9]{4}$/;
    $scope.tel       = /^0[0-9]{8,9}$/;
    $scope.mobiletel = /^0[7-9]0[0-9]{7,8}$/;
    $scope.katakana  = /^[ァ-ヶー]{1}[ァ-ヶー 　]+$/u;
    $scope.hiragana  = /^[ぁ-んー$]{1}[ぁ-んー 　]+$/u;
    $scope.hankaku   = /^[ -~｡-ﾟ]*$/u;
    $scope.zenkaku   = /^[^ -~｡-ﾟ]*$/u;
    $scope.email     = /^[^@]{1,64}@[^@]{1,255}$/; // RFC822

    $scope.m_message = {
        'required'  : '必須項目のため、必ず入力してください。',
        'tel'       : '形式が正しくありません。',
        'mobiletel' : '形式が正しくありません。',
        'zipcode'   : '形式が正しくありません。',
        'katakana'  : '形式が正しくありません。',
        'hiragana'  : '形式が正しくありません。',
        'date'      : '日付を正しく入力してください。',
        'email'     : 'メールアドレスを正しく入力してください。',
        'max'       : '%s 文字以内で入力してください。',
        'min'       : '%s 文字以上で入力してください。',
        'size'      : '%s MB以内のファイルを選択してください。',
        'accept'    : '「jpg, png, gif」形式のファイルを選択してください。',
        'same'      : '入力値が一致していません。',
        'cx_tablet' : 'その他を選択した場合は、ご利用の端末名称入力してください。',
    };

    //array for option
    $scope.themes      = ["Yellow","Black","Pink"];
    $scope.m_status    = {1:"利用可能",
                          2:"利用不可",
                         };
    $scope.displayFlg  = ["表示する"];
    $scope.m_tablet    = {'01':"持っていない",
                          '02':"iPad",
                          '03':"Surface",
                          '04':"Xperia",
                          '05':"fire HD",
                          '06':"Nexus",
                          '07':"Galaxy",
                          '08':"ZenPad",
                          '09':"Arrows Tab",
                          '10':"Regza Tablet",
                          '11':"Kindle",
                          '12':"Kobo",
                          '99':"その他",
                         };
    // for preview modal setting, do not change field name '$scope.options'
    $scope.options = {color:             'rgba(0,0,0,0.9)', // Define background color. HEX, HSL, RGB, RBA
                      animatedIn:        'fadeIn',  // Transition when the modal goes in
                      animatedOut:       'fadeOut', // Transition when the modal goes out
                      animationDuration: '1s',     // Animation duration in seconds
                      overflow:          'auto'     // This makes your modal scrollable or not
                     };

    $scope.sortingOrder  = 'number';//sortingOrder;
    $scope.reverse       = false;
    $scope.filteredItems = [];
    $scope.groupedItems  = [];
    $scope.itemsPerPage  = 10;
    $scope.pagedItems    = [];
    $scope.maxSize       = 10;
    $scope.input.currentPage   = 1;
    $scope.bigTotalItems = 10000;

    // get data from database
    $scope.items = [];
    var items = '';
    console.log('ajax request [getList.php]');
    $http.get('./getList.php',{}).
    success(function(data, status) {
        //list       = data;
        // $scope.totalItems = data.length;
        //$scope.itemsPerPage  = $scope.input.count;
        $scope.items = data;
        $scope.totalItems = data.length;
        $scope.search();
    }).
    error(function(data, status) {
        alert('Request to get Data failed.');
    });

    var searchMatch = function (haystack, needle) {
        if (!needle) {
            return true;
        }
        return haystack.toLowerCase().indexOf(needle.toLowerCase()) !== -1;
    };

    // init the filtered items
    $scope.search = function () {
        //console.log($scope.list);
        $scope.filteredItems = $filter('filter')($scope.items, function (item) {
            for(var attr in item) {
                if (searchMatch(item[attr], $scope.input.query))
                    return true;
            }
            return false;
        });
        $scope.groupToPages();
    };

    // calculate page in place
    $scope.groupToPages = function () {
        $scope.pagedItems = [];
        //console.log('scope.filteredItems.length: ' + $scope.filteredItems.length);
        $scope.totalItems = $scope.filteredItems.length;
        for (var i = 0; i < $scope.filteredItems.length; i++) {
            if (i % $scope.itemsPerPage === 0) {
                $scope.pagedItems[Math.floor(i / $scope.itemsPerPage)+1] = [$scope.filteredItems[i]];
            } else {
                $scope.pagedItems[Math.floor(i / $scope.itemsPerPage)+1].push($scope.filteredItems[i]);
            }
        }
        console.log($scope.pagedItems);
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
            //console.log('sort reverse icon changed.');
            $('th.th_'+orderId+' i').removeClass().addClass('fa-sort-up');
        } else {
            //console.log('sort icon changed.');
            $('th.th_'+orderId+' i').removeClass().addClass('fa-sort-down');
        }
    };

    $scope.changeCount = function(num) {
        //console.log('change view count [' + num + ']');
        //$scope.currentPage  = 1;
        $scope.itemsPerPage = num;
        $scope.search();
    }

//    $scope.setPage = function (pageNo) {
//        $scope.currentPage = pageNo;
//    };
//
//    $scope.pageChanged = function(num) {
//        console.log('Page changed to: ' + num);
//        $scope.pageNum = num;
//    }

    // current time display
    $scope.now = new Date();
    console.log($scope.now);
    $interval(function(){
      $scope.now = new Date();
    }, 1000);

    // routing
    $scope.changePage = function(page) {
      console.log("change page [" + page + "].");
     //console.log(location.pathname);
     //console.log('if url is editpage, [' + location.hash + ']');
     // when edit-page displayed, set default value
     if (page == 'edit'){
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
         $scope.input.imageSrc                = './Uploads/DsvVAS.jpg';
         $scope.input.cardSrc                 = 'BRHv7E.pdf';
         $scope.input.display_flg             = true;
         $scope.input.tablet                  = {'02':true, '10':true, '99':true};
         $scope.input.other_tablet            = 'AsusPad';
         $scope.input.tag                     = [{text: "Apple"}, {text: "Orange"}];
         $scope.input.public_date             = '2016/01/03';
         $scope.input.start_date              = '2016/12/01 10:00';
         $scope.input.body                    = '自己紹介文は後ほど記載します。';
         $scope.input.description             = '補足事項は特にはありません。';
     };

      $state.go(page);
    }
    // Initual display page
    //console.log('if url is initual page [' + location.hash + ']');
    if (location.hash == '') {
      $state.go('index');
    }

    // delete record
    $scope.removeUser = function(index) {
        console.log('No.'+index+' delete ok.');
        $('#row-'+index).remove();
        alert('削除が完了しました。');
    };

    // checkboxes selected at least one for tablet field
    $scope.someSelected=function(){
        //console.log($scope.input.tablet);
        //console.log($scope.input.other_tablet);
        var flag=false;

        for(var key in $scope.input.tablet){
            //console.log('Key -' +key +' val- '+$scope.input.tablet[key]);
            if($scope.input.tablet[key]){
                flag=true;
                // change to touched.
                $scope.input.tablet.$setTouched();
            }
        }
        if(!flag){
            $scope.input.tablet=undefined;
        }
    };

    // array for option from database
    $http.get('./getMPref.php',{}).
    success(function(data, status) {
        $scope.m_pref = data;
    }).
    error(function(data, status) {
      alert('Request to get Prefecture failed.');
      $scope.m_pref = data || [];
    });

    // prefSearch button clicked.
    $scope.prefSearch = function() {
      $http.post("./getAddrFromZipcode.php", {'zipcode1':$scope.input.zipcode1, 'zipcode2':$scope.input.zipcode2}).
      success(function(data, status) {
        $scope.input.pref = data.pref;
        $scope.input.addr = data.addr;
      }).
      error(function(data, status) {
        alert('Request to get Address using zipcode failed.');
      });
    };
    // logout button clicked.
    $scope.logout = function() {
      //alert(JSON.stringify($scope.input));
      $http.post("./logout.php", JSON.stringify($scope.input),{}).
      success(function(data, status) {
        $scope.data   = data;
        $scope.status = status;
        window.location.href = './login.html';
      }).
      error(function(data, status) {
        alert("Ajax Request failed.");
        $scope.data = data || "Request failed";
        $scope.status = status;
        $scope.message = data.message;
      });
    };
    // submit button clicked.
    $scope.submit = function() {
      //alert(JSON.stringify($scope.input));
      $http.post("./submit.php", JSON.stringify($scope.input),{}).
      success(function(data, status) {
        $scope.data   = data;
        $scope.status = status;
        $("body").animate({scrollTop: 0}, "slow");
        $state.go('input_complete');
      }).
      error(function(data, status) {
        alert("Ajax Request failed.");
        $scope.data = data || "Request failed";
        $scope.status = status;
        $scope.message = data.message;
      });
    };

    // update button clicked.
    $scope.update = function() {
      //alert(JSON.stringify($scope.input));
      $http.post("./submit.php", JSON.stringify($scope.input),{}).
      success(function(data, status) {
        $scope.data   = data;
        $scope.status = status;
        $("body").animate({scrollTop: 0}, "slow");
        $state.go('edit_complete');
      }).
      error(function(data, status) {
        alert("Ajax Request failed.");
        $scope.data = data || "Request failed";
        $scope.status = status;
        $scope.message = data.message;
      });
    };

//    // image selected
//    $scope.$watch("image", function (image) {
//        $scope.imageSrc = undefined;
////console.log(!$scope.inputForm.image.$valid);
////console.log(!image);
//console.log(image);
//console.log($scope.inputForm.image.$valid);
//        if (!image) {
//            $scope.input.imageSrc      = '';
//            $scope.input.imageFilename = '';
//            return;
//        }
//     //   console.log($scope.inputForm.image.$pristine);
//     //   console.log($scope.inputForm.image.$valid);
//     //   console.log($scope.inputForm.image);
//        if ($scope.inputForm.image.$invalid) {
//    //      console.log('NG');
//          $scope.input.imageSrc      = '';
//          $scope.input.imageFilename = '';
//          return;
//        } else {
//     //     console.log('OK');
//
//        }
//        var reader = new FileReader();
//        reader.onload = function () {
//
//            // save in temporary folder.
//            $.ajax({
//                type: 'POST',
//                url: './upload.php',
//                data: {file: reader.result},
//                success: function(res, status){
//                    //$_img.attr('src', event.target.result);
//                    $scope.$apply(function () {
//                        $scope.input.imageSrc      = reader.result;
//                        $scope.input.imageFilename = res;
//                    });
//                },
//                error: function(res, status, error){
//                    alert('FileUpload failed.');
//                    console.log(a, b, c);
//                }
//            });
//        };
//        reader.readAsDataURL(image);
//    });

//   // card selected
//  $scope.$watch("card", function (card) {
//      $scope.cardSrc = undefined;
//      if (!card) {
//          return;
//      }
//      var reader = new FileReader();
//      reader.onload = function () {

//          // save in temporary folder.
//          $.ajax({
//              type: 'POST',
//              url: './upload.php',
//              data: {file: reader.result},
//              success: function(res, status){
//                  //$_img.attr('src', event.target.result);
//                  $scope.$apply(function () {
//                      $scope.input.cardSrc      = reader.result;
//                      $scope.input.cardFilename = res;
//                  });
//              },
//              error: function(res, status, error){
//                  alert('FileUpload failed.');
//              }
//          });
//      };
//      reader.readAsDataURL(card);
//  });

    $scope.calIcon = function(id) {
      //console.log("datetimepicker button clicked.");
      $('#'+id).datetimepicker('show');
    };

    $scope.tinymceOptions = {
        selector : "textarea.wysiwyg",
        //language : 'ja',
        language_url : './js/tinymce_langs/ja.js',
        plugins  : ["autolink searchreplace textcolor textpattern colorpicker table paste image imagetools legacyoutput contextmenu lists charmap code codesample link media anchor hr preview tabfocus template visualblocks"],
        toolbar  : "undo redo | styleselect | bold italic forecolor backcolor | table | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | code",
        table_grid: true,
        table_appearance_options: true,
        table_toolbar: "tableprops tabledelete | tableinsertrowbefore tableinsertrowafter tabledeleterow | tableinsertcolbefore tableinsertcolafter tabledeletecol",
        paste_data_images: true,
        paste_as_text: false,
        paste_remove_styles_if_webkit: false,
        forced_root_block: '',
        relative_urls: false,
        templates: [
          {title: 'テンプレート①', description: '文章のみの汎用テンプレートです', url: "/info/contents/template/template1.html"},
          {title: 'テンプレート②', description: 'テーブル表を含んだ汎用テンプレートです', url: "/info/contents/template/template2.html"}
        ],
        file_browser_callback: RoxyFileBrowser
    };
}]);

//angular.module('hoge', []).directive('autoNgModel', function() {
//  return {
//    compile: function(element, attrs) {
//      // auto-ng-modelが設定されている要素以下のinput要素にng-modelを設定します。
//      function setNgModel(e) {
//        if (e.getAttribute('ng-model')) return;
//        e.setAttribute('ng-model', (attrs.autoNgModel ? attrs.autoNgModel + '.' : '') + e.name);
//      }
//      angular.forEach(element.find('input'), setNgModel);
//      angular.forEach(element.find('select'), setNgModel);
//      angular.forEach(element.find('textarea'), setNgModel);
//    }
//  };
//});

//app.directive('time', function() {
//    return {
//        restrict: 'E',
//        scope: false,
//        template: '<time id="auto_time">aaa</time>',
//        //controller: function($scope) {
//        //  $scope.now = 'aaaa';//new Date();
//        //  //$scope.now = $scope.now | date:'yyyy/MM/dd @ h:mm:ss a' | lowercase
//        //  //console.log(new Date());
//        //}
//    }
//});

//function curTime($scope, $interval) {
//  $scope.now = new Date();
//  var updateT = function() {
//    $scope.now = new Date();
//  }
//  $interval(updateT, 1000);
//}

// confirm dialog for delete function
app.directive('registPageChange', [
    function(){
        return {
            //template: '<div class="contRight" ng-include="contentUrl"></div>',
            link: function (scope, element, attr) {
                element.bind('click',function (event) {
                    console.log('The Url to registPage Clicked.');
                        $http.get('./add.php',{}).
                        success(function(data, status) {
                            template: '<div class="contRight" ng-include="contentUrl"></div>';
                        }).
                        error(function(data, status) {
                          alert('Request to get Data failed.');
                          list = data || [];
                        });

                    //template: '<div class="contRight" ng-include="./article/add.html"></div>';
                    //return scope.contentUrl = "./article/add.html";
                });

            }
        };
}]);

// confirm dialog for delete function
app.directive('ngConfirmClick', [
    function(){
        return {
            link: function (scope, element, attr) {
                var msg = attr.ngConfirmClick || "Are you sure?";
                var clickAction = attr.confirmedClick;
                element.bind('click',function (event) {
                    console.log('Disply delete dialog message.');
                    if ( window.confirm(msg) ) {
                        scope.$eval(clickAction)
                    }
                });
            }
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
                showOn: 'both',
                buttonImage: "./img/" + "mark_cal.png",
                buttonImageOnly: true,
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

// custom validation 'same value check'
app.directive("sameAs", function() {
    return {
        require: 'ngModel',
        link: function(scope, elm, attrs, ctrl) {
            if (!attrs.sameAs) {
              return;
            }
            scope.$watch(attrs.sameAs, function (value) {
              if (value === ctrl.$viewValue && value !== undefined) {
                ctrl.$setValidity('sameAs', true);
                ctrl.$setValidity("parse",undefined);
              } else {
                ctrl.$setValidity('sameAs', false);
              }
            });
            ctrl.$parsers.push(function (value) {
                var isValid = value === scope.$eval(attrs.sameAs);
                ctrl.$setValidity('sameAs', isValid);
                return isValid ? value : undefined;
            });
        }
    }
});

// custom validation 'date value check'
//app.directive("dateCheck", function() {
//    return {
//        require: 'ngModel',
//        link: function(scope, elm, attrs, ctrl) {
//            if (!attrs.sameAs) {
//              return;
//            }
//
//            var isErr = false;
//            console.log(element[0]);
//            console.log(ctrl);
//          // if (element[0].files[0].size>attrs.maxsize) {
//          //   ctrl.$setValidity('maxsize', false);
//          //   isErr = true;
//          // } else {
//          //   ctrl.$setValidity('maxsize', true);
//          // }
//        }
//    }
//});

// file validation and save
app.directive("fileModel", ["$parse", function ($parse) {
    return {
        restrict: "A",
        require:'ngModel',
        link: function (scope, element, attrs, ctrl) {
            var model = $parse(attrs.fileModel);
            element.bind("change", function () {
                scope.$apply(function () {
                  model.assign(scope, element[0].files[0]);
                  ctrl.$setViewValue(element.val());
                  ctrl.$render();
                });

                if (!element[0].files[0]) {
                  return;
                }
                var isErr = false;
                console.log(element[0].files[0]);
                if (element[0].files[0].size>attrs.maxsize) {
                  ctrl.$setValidity('maxsize', false);
                  isErr = true;
                } else {
                  ctrl.$setValidity('maxsize', true);
                }
                //console.log(attrs.accept);
                var found = false;
                var type  = '';
                if (attrs.accept == 'image/*') {
                  var allowed = ["jpeg", "jpg", "png", "gif"];
                  type = 'image';
                  allowed.forEach(function(extension) {
                    if (element[0].files[0].type.match('image/'+extension)) {
                      found = true;
                    }
                  });
                } else {
                  var allowed = ["pdf"];
                  type = 'pdf';
                  allowed.forEach(function(extension) {
                    if (element[0].files[0].type.match('application/'+extension)) {
                      found = true;
                    }
                  });
                }
                if(!found){
                  ctrl.$setValidity('filetype', false);
                  isErr = true;
                } else {
                  ctrl.$setValidity('filetype', true);
                }

                if (type == 'image') {

                    if (isErr) {
                        scope.input.imageSrc      = '';
                        scope.input.imageFilename = '';
                        return;
                    } else {
                        var reader = new FileReader();
                        reader.onload = function () {

                            // save in temporary folder.
                            $.ajax({
                                type: 'POST',
                                url: './upload.php',
                                data: {file: reader.result},
                                success: function(res, status){
                                    //$_img.attr('src', event.target.result);
                                    scope.$apply(function () {
                                        scope.input.imageSrc      = reader.result;
                                        scope.input.imageFilename = res;
                                    });
                                },
                                error: function(res, status, error){
                                    alert('FileUpload failed.');
                                }
                            });
                        };
                        reader.readAsDataURL(element[0].files[0]);
                    }
                } else if (type == 'pdf') {

                    if (isErr) {
                        scope.input.cardSrc      = '';
                        scope.input.cardFilename = '';
                        return;
                    } else {
                        var reader = new FileReader();
                        reader.onload = function () {

                            // save in temporary folder.
                            $.ajax({
                                type: 'POST',
                                url: './upload.php',
                                data: {file: reader.result},
                                success: function(res, status){
                                    scope.$apply(function () {
                                        scope.input.cardSrc      = element[0].files[0].name;
                                        scope.input.cardFilename = res;
                                    });
                                },
                                error: function(res, status, error){
                                    alert('FileUpload failed.');
                                }
                            });
                        };
                        reader.readAsDataURL(element[0].files[0]);
                    }
                }
            });
        }
    };
}]);

//app.directive('validFile',function(){
//  return {
//    require:'ngModel',
//    link:function(scope,element,attrs,ctrl){
//      element.bind('change',function(){
//        scope.$apply(function(){
//          ctrl.$setViewValue(element.val());
//          ctrl.$render();
//        });
//        if (element[0].files[0].size>attrs.maxsize) {
//          ctrl.$setValidity('maxsize', false);
//        }
//        var allowed = ["jpeg", "png", "gif", "jpg"];
//        var found = false;
//        allowed.forEach(function(extension) {
//          if (element[0].files[0].type.match('image/'+extension)) {
//            found = true;
//          }
//        });
//        if(!found){
//          ctrl.$setValidity('filetype', false);
//        }
//      });
//    }
//  }
//});

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

// text string replace filter
app.filter('replace', [function() {
    return function (str, r1, r2) {
      return str.replace(r1, r2, 'g');
    };
  }
]);
// html tag replace filter
app.filter('replaceTag', ['$scope', function($scope) {
    return function (str, r1, r2) {
      str = str.replace(r1, r2, 'g');
      return $scope.trustAsHtml(str);
    };
  }
]);

/**
 * Binds a TinyMCE widget to <textarea> elements.
 */
app.value('uiTinymceConfig', {})
.directive('uiTinymce', ['$rootScope', '$compile', '$timeout', '$window', '$sce', 'uiTinymceConfig', 'uiTinymceService', function($rootScope, $compile, $timeout, $window, $sce, uiTinymceConfig, uiTinymceService) {
  uiTinymceConfig = uiTinymceConfig || {};

  if (uiTinymceConfig.baseUrl) {
    tinymce.baseURL = uiTinymceConfig.baseUrl;
  }

  return {
    require: ['ngModel', '^?form'],
    priority: 599,
    link: function(scope, element, attrs, ctrls) {
      if (!$window.tinymce) {
        return;
      }

      var ngModel = ctrls[0],
        form = ctrls[1] || null;

      var expression, options = {
        debounce: true
      }, tinyInstance,
        updateView = function(editor) {
          var content = editor.getContent({format: options.format}).trim();
          content = $sce.trustAsHtml(content);

          ngModel.$setViewValue(content);
          if (!$rootScope.$$phase) {
            scope.$digest();
          }
        };

      function toggleDisable(disabled) {
        if (disabled) {
          ensureInstance();

          if (tinyInstance) {
            tinyInstance.getBody().setAttribute('contenteditable', false);
          }
        } else {
          ensureInstance();

          if (tinyInstance && !tinyInstance.settings.readonly && tinyInstance.getDoc()) {
            tinyInstance.getBody().setAttribute('contenteditable', true);
          }
        }
      }

      // fetch a unique ID from the service
      var uniqueId = uiTinymceService.getUniqueId();
      attrs.$set('id', uniqueId);

      expression = {};

      angular.extend(expression, scope.$eval(attrs.uiTinymce));

      //Debounce update and save action
      var debouncedUpdate = (function(debouncedUpdateDelay) {
        var debouncedUpdateTimer;
        return function(ed) {
        $timeout.cancel(debouncedUpdateTimer);
         debouncedUpdateTimer = $timeout(function() {
            return (function(ed) {
              if (ed.isDirty()) {
                ed.save();
                updateView(ed);
              }
            })(ed);
          }, debouncedUpdateDelay);
        };
      })(400);

      var setupOptions = {
        // Update model when calling setContent
        // (such as from the source editor popup)
        setup: function(ed) {
          ed.on('init', function() {
            ngModel.$render();
            ngModel.$setPristine();
              ngModel.$setUntouched();
            if (form) {
              form.$setPristine();
            }
          });

          // Update model when:
          // - a button has been clicked [ExecCommand]
          // - the editor content has been modified [change]
          // - the node has changed [NodeChange]
          // - an object has been resized (table, image) [ObjectResized]
          ed.on('ExecCommand change NodeChange ObjectResized', function() {
            if (!options.debounce) {
              ed.save();
              updateView(ed);
              return;
            }
            debouncedUpdate(ed);
          });

          ed.on('blur', function() {
            element[0].blur();
            ngModel.$setTouched();
            if (!$rootScope.$$phase) {
              scope.$digest();
            }
          });

          ed.on('remove', function() {
            element.remove();
          });

          if (uiTinymceConfig.setup) {
            uiTinymceConfig.setup(ed, {
              updateView: updateView
            });
          }

          if (expression.setup) {
            expression.setup(ed, {
              updateView: updateView
            });
          }
        },
        format: expression.format || 'html',
        selector: '#' + attrs.id
      };
      // extend options with initial uiTinymceConfig and
      // options from directive attribute value
      angular.extend(options, uiTinymceConfig, expression, setupOptions);
      // Wrapped in $timeout due to $tinymce:refresh implementation, requires
      // element to be present in DOM before instantiating editor when
      // re-rendering directive
      $timeout(function() {
        if (options.baseURL){
          tinymce.baseURL = options.baseURL;
        }
        var maybeInitPromise = tinymce.init(options);
        if(maybeInitPromise && typeof maybeInitPromise.then === 'function') {
          maybeInitPromise.then(function() {
            toggleDisable(scope.$eval(attrs.ngDisabled));
          });
        } else {
          toggleDisable(scope.$eval(attrs.ngDisabled));
        }
      });

      ngModel.$formatters.unshift(function(modelValue) {
        return modelValue ? $sce.trustAsHtml(modelValue) : '';
      });

      ngModel.$parsers.unshift(function(viewValue) {
        return viewValue ? $sce.getTrustedHtml(viewValue) : '';
      });

      ngModel.$render = function() {
        ensureInstance();

        var viewValue = ngModel.$viewValue ?
          $sce.getTrustedHtml(ngModel.$viewValue) : '';

        // instance.getDoc() check is a guard against null value
        // when destruction & recreation of instances happen
        if (tinyInstance &&
          tinyInstance.getDoc()
        ) {
          tinyInstance.setContent(viewValue);
          // Triggering change event due to TinyMCE not firing event &
          // becoming out of sync for change callbacks
          tinyInstance.fire('change');
        }
      };

      attrs.$observe('disabled', toggleDisable);

      // This block is because of TinyMCE not playing well with removal and
      // recreation of instances, requiring instances to have different
      // selectors in order to render new instances properly
      scope.$on('$tinymce:refresh', function(e, id) {
        var eid = attrs.id;
        if (angular.isUndefined(id) || id === eid) {
          var parentElement = element.parent();
          var clonedElement = element.clone();
          clonedElement.removeAttr('id');
          clonedElement.removeAttr('style');
          clonedElement.removeAttr('aria-hidden');
          tinymce.execCommand('mceRemoveEditor', false, eid);
          parentElement.append($compile(clonedElement)(scope));
        }
      });

      scope.$on('$destroy', function() {
        ensureInstance();

        if (tinyInstance) {
          tinyInstance.remove();
          tinyInstance = null;
        }
      });

      function ensureInstance() {
        if (!tinyInstance) {
          tinyInstance = tinymce.get(attrs.id);
        }
      }
    }
  };
}])
.service('uiTinymceService', [
  /**
   * A service is used to create unique ID's, this prevents duplicate ID's if there are multiple editors on screen.
   */
  function() {
    var UITinymceService = function() {
      var ID_ATTR = 'ui-tinymce';
    // uniqueId keeps track of the latest assigned ID
    var uniqueId = 0;
      // getUniqueId returns a unique ID
    var getUniqueId = function() {
        uniqueId ++;
        return ID_ATTR + '-' + uniqueId;
      };
      // return the function as a public method of the service
      return {
        getUniqueId: getUniqueId
      };
    };
    // return a new instance of the service
    return new UITinymceService();
  }
]);

