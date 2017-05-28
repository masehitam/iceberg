'use strict';

angular.module('app.core', [
  'ui.router',
  'app.core.core_directive',
  'app.core.core_filter',
])

.controller('CoreCtrl', ['$scope', '$http', '$interval', '$state', '$log', 'AuthenticationService', function($scope, $http, $interval, $state, $log, AuthenticationService) {
    console.log('execute CoreCtrl.');

    // current time display
    $scope.now = new Date();
    console.log($scope.now);
    $interval(function(){
      $scope.now = new Date();
    }, 1000);

    $scope.calIcon = function(id) {
      $log.debug("datetimepicker button clicked.");
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
