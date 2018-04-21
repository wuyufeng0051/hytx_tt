$(function(){
    // 提交成功弹出层
    // $('.cheng p span').click(function(){
    //   $('.cheng').hide();
    //   $('.disk').hide();
    // })
    $('.disk').click(function(){
      $('.cheng').hide();
      $('.disk').hide();
      $('.delete').hide();
    })
	  //年月日
	  var currYear = (new Date()).getFullYear();  
	  var opt={};
	  opt.date = {preset : 'date'};
	  opt.datetime = {preset : 'datetime'};
	  opt.time = {preset : 'time'};
	  opt.default = {
	    theme: 'android-holo light', //皮肤样式
	    display: 'bottom', //显示方式 
	    mode: 'scroller', //日期选择模式
	    dateFormat: 'yyyy-mm-dd',
	    lang: 'zh',
	    showNow: true,
	    nowText: "今天",
	    stepMinute: 1,
	    startYear: currYear-2, //开始年份
	    endYear: currYear +2//结束年份
	  };
    $("#EndDate").mobiscroll($.extend(opt['date'], opt['default']));
    $("#EndTime").mobiscroll($.extend(opt['date'], opt['default']));
    
    $('.delete .cancel').click(function(){
      $('.delete').hide();
      $('.disk').hide();
    })
    $('.disk').click(function(){
      $('.delete').hide();
      $('.disk').hide();
    })
})
