'use strict';

angular.module('app.core.core_directive', [])

// confirm dialog for delete function
.directive('ngConfirmClick', ['$log', function($log){
    return {
        link: function (scope, element, attr) {
            var msg = attr.ngConfirmClick || "Are you sure?";
            var clickAction = attr.confirmedClick;
            element.bind('click',function (event) {
                $log.debug('Disply delete dialog message.');
                if ( window.confirm(msg) ) {
                    scope.$eval(clickAction)
                }
            });
        }
    };
}])

// datepicker selected
.directive('datepicker', ['$log', function ($log) {
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
            // validation 'date value check'
            element.bind("change", function () {
                if (new Date(element.val()) == "Invalid Date") {
                  ctrl.$setValidity('dateCheck', false);
                } else {
                  ctrl.$setValidity('dateCheck', true);
                }
                return;
            });
        }
    };
}])

// datetimepicker selected
.directive('datetimepicker', ['$log', function ($log) {
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
            // validation 'datetime value check'
            element.bind("change", function () {
                if (new Date(element.val()) == "Invalid Date") {
                  ctrl.$setValidity('dateCheck', false);
                } else {
                  ctrl.$setValidity('dateCheck', true);
                }
                return;
            });
        }
    };
}])

// custom validation 'same value check'
.directive("sameAs", ['$log', function($log) {
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
}])

.directive('animatedModal', ['$log', function($log){
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
            $log.debug('attrs.href [' + attrs.href + ']');
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
}])

/**
 * Binds a TinyMCE widget to <textarea> elements.
 */
.value('uiTinymceConfig', {})
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
