'use strict';

angular.module('app.sample.sample_directive', [])

// file validation and save
.directive("fileModel", ['$parse', '$log', function ($parse, $log) {
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
                $log.debug(element[0].files[0]);
                if (element[0].files[0].size>attrs.maxsize) {
                  ctrl.$setValidity('maxsize', false);
                  isErr = true;
                } else {
                  ctrl.$setValidity('maxsize', true);
                }
                $log.debug(attrs.accept);
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
                            $log.debug('ajax request image upload [upload.php]');
                            $.ajax({
                                type: 'POST',
                                url: '/app/sample/upload.php',
                                data: {file: reader.result},
                                success: function(res, status){
                                    scope.$apply(function () {
                                        //scope.imageSrc      = reader.result;
                                        //scope.imageFilename = res;
                                    });
                                },
                                error: function(res, status, error){
                                    $log.error('FileUpload failed.');
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
                            $log.debug('ajax request pdf upload [upload.php]');
                            $.ajax({
                                type: 'POST',
                                url: './scripts/upload.php',
                                data: {file: reader.result},
                                success: function(res, status){
                                    scope.$apply(function () {
                                        scope.input.cardSrc      = element[0].files[0].name;
                                        scope.input.cardFilename = res;
                                    });
                                },
                                error: function(res, status, error){
                                    $log.error('FileUpload failed.');
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