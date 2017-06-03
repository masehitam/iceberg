function elFinderBrowser (field_name, url, type, win) {
  tinymce.activeEditor.windowManager.open({
    file: '/elfinder/tinymce4',
    title: 'elFinder 2.0',
    width: 900,
    height: 450,
    resizable: 'yes'
  }, {
    setUrl: function (url) {
      win.document.getElementById(field_name).value = url;
    }
  });
  return false;
}

$(function($){
  $.datepicker.regional['ja'] = {
    closeText: '閉じる',
    prevText: '&#x3C;前',
    nextText: '次&#x3E;',
    currentText: '今日',
    monthNames: ['1月','2月','3月','4月','5月','6月',
    '7月','8月','9月','10月','11月','12月'],
    monthNamesShort: ['1月','2月','3月','4月','5月','6月',
    '7月','8月','9月','10月','11月','12月'],
    dayNames: ['日曜日','月曜日','火曜日','水曜日','木曜日','金曜日','土曜日'],
    dayNamesShort: ['日','月','火','水','木','金','土'],
    dayNamesMin: ['日','月','火','水','木','金','土'],
    weekHeader: '週',
    dateFormat: 'yy/mm/dd',
    firstDay: 0,
    isRTL: false,
    showMonthAfterYear: true,
    yearSuffix: '年'};
  $.datepicker.setDefaults($.datepicker.regional['ja']);
});

function datepickerSetup(){

	$('.datepick')
	.datepicker({
		dateFormat: 'yy/mm/dd',
		showOn: 'focus',
		minDate:'-80',
		maxDate:'30',
		changeMonth: true,
		changeYear: true,
		constrainInput: true,
		numberOfMonths: 3,
		onSelect: function(){
			$(this).removeClass('placeholder');
			if( $(this).val().length < 1){
				$(this).val($(this).attr('placeholder'));
				$(this).attr('used', 'false')
				$(this).addClass('placeholder');
			}else{
				$(this).attr('used', 'true')
			}
		}
	});
}

function datetimepickerSetup(){

	$('.datetimepick')
	.datetimepicker({
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
		onSelect: function(){
			$(this).removeClass('placeholder');
			if( $(this).val().length < 1){
				$(this).val($(this).attr('placeholder'));
				$(this).attr('used', 'false')
				$(this).addClass('placeholder');
			}else{
				$(this).attr('used', 'true')
			}
		}
	});
}

function prefSearch(){

    var req = '';
    req += $('#zipcode').val();

    $.ajax({
        url: "/pref",
        data: {req:req},
        cache: false,
        success: function(html){
            $this.spinner('remove');
            if (null != html.addr1 && null != html.addr2){
                $("#pref").val(html.pref).trigger("change");
                $("#addr01").val(html.addr1 + html.addr2).removeClass("placeholder").attr("used","true");
                $("#addr01").css("color","#000");
            }
        }
    });
}