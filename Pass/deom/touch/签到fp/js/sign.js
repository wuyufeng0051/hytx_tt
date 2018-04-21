$(function(){

    //初始化ajax获取日历json数据
    var signList=[{"signDay":"09"},{"signDay":"11"},{"signDay":"12"},{"signDay":"13"}];
    var RetroList=[{"RetroDay":"10"},{"RetroDay":"02"}];
    var SpecialList = [[11, 09]];
    calUtil.init(signList,RetroList,SpecialList);
    // 今日签到
    $('.ClickSign , .today').click(function(){
      $('.disk').show();
      $('.QianBox').show();
      $(".today").addClass('on');
      $(".today .TodayTips").removeClass('TodayTips');
    })
    // 补签
    $('.bu').click(function(){
      $('.disk').show();
      $(".SureBox").show();
    })
    // 签到规则弹出层
    $(".Rules").click(function(){
      $(".disk").show();
      $(".RulesBox").show();
    })
    // 关闭弹出层
    $(".close").click(function(){
      $('.disk').hide();
      $('.SuccessBox').hide();
      $('.flower').hide();
      $('.RulesBox').hide();
    })
    $('.cancle').click(function(){
      $('.disk').hide();
      $(".SureBox").hide();
    })
  });


// 日历加载主要代码
var calUtil = {

  eventName:"load",
  //初始化日历
  init:function(signList,RetroList,SpecialList){
    calUtil.setMonthAndDay();
    calUtil.draw(signList,RetroList,SpecialList);
    calUtil.bindEnvent();
  },
  draw:function(signList,RetroList,SpecialList){
    //绑定日历
    var str = calUtil.drawCal(calUtil.showYear,calUtil.showMonth,signList,RetroList,SpecialList);
    $("#calendar").html(str);
    //绑定日历表头
    var calendarName=calUtil.showYear+"年"+calUtil.showMonth+"月";
    $(".calendar_month_span").html(calendarName);  
  },
  //绑定事件
  bindEnvent:function(){
    //绑定上个月事件
    $(".calendar_month_prev").click(function(){
      var nowMonth=$(".calendar_month_span").html().split("年")[1].split("月")[0];
      var TrueMonth = new Date().getMonth() + 1;
      // 限制只能翻近两个月
      if (nowMonth == TrueMonth ) {
        //翻页时ajax获取日历json数据
        var signList=[{"signDay":"10"},{"signDay":"11"},{"signDay":"12"},{"signDay":"13"}];

        calUtil.eventName="prev";
        calUtil.init(signList);
      }else if(nowMonth ==  TrueMonth+1){
        //翻页时ajax获取日历json数据
        var signList=[{"signDay":"09"},{"signDay":"11"},{"signDay":"12"},{"signDay":"13"}];
        var RetroList=[{"RetroDay":"10"},{"RetroDay":"02"}];
        var SpecialList = [[11, 09]];

        calUtil.eventName="prev";
        calUtil.init(signList,RetroList,SpecialList);
      }
      
    });
    //绑定下个月事件
    $(".calendar_month_next").click(function(){
      var nowMonth=$(".calendar_month_span").html().split("年")[1].split("月")[0];
      var TrueMonth = new Date().getMonth() + 1;
      // 限制只能翻近两个月
      if (nowMonth == TrueMonth ) {
        //翻页时ajax获取日历json数据
        var signList=[{"signDay":"10"},{"signDay":"11"},{"signDay":"12"},{"signDay":"13"}];

          calUtil.eventName="next";
          calUtil.init(signList);
        }else if(nowMonth ==  TrueMonth-1){
          //翻页时ajax获取日历json数据
        var signList=[{"signDay":"09"},{"signDay":"11"},{"signDay":"12"},{"signDay":"13"}];
        var RetroList=[{"RetroDay":"10"},{"RetroDay":"02"}];
        var SpecialList = [[11, 09]];

          calUtil.eventName="next";
        calUtil.init(signList,RetroList,SpecialList);
        }
      });

  },
  //获取当前选择的年月
  setMonthAndDay:function(){
    switch(calUtil.eventName)
    {
      case "load":
        var current = new Date();
        calUtil.showYear=current.getFullYear();
        calUtil.showMonth=current.getMonth() + 1;
        break;
      case "prev":
        var nowMonth=$(".calendar_month_span").html().split("年")[1].split("月")[0];
        calUtil.showMonth=parseInt(nowMonth)-1;
        if(calUtil.showMonth==0)
        {
            calUtil.showMonth=12;
            calUtil.showYear-=1;
        }
        break;
      case "next":
        var nowMonth=$(".calendar_month_span").html().split("年")[1].split("月")[0];
        calUtil.showMonth=parseInt(nowMonth)+1;
        if(calUtil.showMonth==13)
        {
            calUtil.showMonth=1;
            calUtil.showYear+=1;
        }
        break;
    }
  },
  getDaysInmonth : function(iMonth, iYear){
   var dPrevDate = new Date(iYear, iMonth, 0);
   return dPrevDate.getDate();
  },
  bulidCal : function(iYear, iMonth) {
   var aMonth = new Array();
   aMonth[0] = new Array(7);
   aMonth[1] = new Array(7);
   aMonth[2] = new Array(7);
   aMonth[3] = new Array(7);
   aMonth[4] = new Array(7);
   aMonth[5] = new Array(7);
   aMonth[6] = new Array(7);
   var dCalDate = new Date(iYear, iMonth - 1, 1);
   var iDayOfFirst = dCalDate.getDay();
   var iDaysInMonth = calUtil.getDaysInmonth(iMonth, iYear);
   var iVarDate = 1;
   var d, w;
   aMonth[0][0] = "日";
   aMonth[0][1] = "一";
   aMonth[0][2] = "二";
   aMonth[0][3] = "三";
   aMonth[0][4] = "四";
   aMonth[0][5] = "五";
   aMonth[0][6] = "六";
   for (d = iDayOfFirst; d < 7; d++) {
    aMonth[1][d] = iVarDate;
    iVarDate++;
   }
   for (w = 2; w < 7; w++) {
    for (d = 0; d < 7; d++) {
     if (iVarDate <= iDaysInMonth) {
      aMonth[w][d] = iVarDate;
      iVarDate++;
     }
    }
   }
   return aMonth;
  },
  ifHasSigned : function(signList,day){
   var signed = false;
   $.each(signList,function(index,item){
    if(item.signDay == day) {
     signed = true;
     return false;
    }
   });
   return signed ;
  },
  Retroactive : function(RetroList,day){
   var Retro = false;
   $.each(RetroList,function(index,item){
    if(item.RetroDay == day) {
     Retro = true;
     return false;
    }
   });
   return Retro ;
  },
  SpecialData : function(SpecialList,Month,day){
   var Retro = false;
   $.each(SpecialList,function(index,item){
    if (item[0] == Month) {
      if(item[1] == day) {
       Retro = true;
       return false;
      }
    }
   });
   return Retro;
  },
  TodayData : function(TrueMonth,TrueDay,Month,day){
   var Retro = false;
    if(TrueMonth == Month && TrueDay == day) {
       Retro = true;
    }
   return Retro;
  },
  drawCal : function(iYear,iMonth ,signList ,RetroList, SpecialList) {
   var myMonth = calUtil.bulidCal(iYear, iMonth);
   var TrueDay =  new Date().getDate(),
       TrueMonth =  new Date().getMonth()+1;
   var htmls = new Array();
   htmls.push("<div class='sign_main' id='sign_layer'>");
   htmls.push("<div class='sign_succ_calendar_title'>");
   htmls.push("<div class='calendar_month_next'></div>");
   htmls.push("<div class='calendar_month_prev'></div>");
   htmls.push("<div class='calendar_month_span'></div>");
   htmls.push("</div>");
   htmls.push("<div class='sign' id='sign_cal'>");
   htmls.push("<table valign='top'>");
   htmls.push("<tr>");
   htmls.push("<th>周" + myMonth[0][0] + "</th>");
   htmls.push("<th>周" + myMonth[0][1] + "</th>");
   htmls.push("<th>周" + myMonth[0][2] + "</th>");
   htmls.push("<th>周" + myMonth[0][3] + "</th>");
   htmls.push("<th>周" + myMonth[0][4] + "</th>");
   htmls.push("<th>周" + myMonth[0][5] + "</th>");
   htmls.push("<th>周" + myMonth[0][6] + "</th>");
   htmls.push("</tr>");
   var d, w;

   for (w = 1; w < 7; w++) {
    htmls.push("<tr  class='WeekDay'>");  
    for (d = 0; d < 7; d++) {

     // 当前日期高亮提示
     var TodayData = calUtil.TodayData(TrueMonth,TrueDay,iMonth,myMonth[w][d]);
     // 已签到日期循环对号
     var ifHasSigned = calUtil.ifHasSigned(signList,myMonth[w][d]);
     // 补签日期循环对号
     if (RetroList != undefined) {
       var Retroactive = calUtil.Retroactive(RetroList,myMonth[w][d]);
     }
     // 特殊日期循环对号
     if (SpecialList != undefined) {
       var SpecialData = calUtil.SpecialData(SpecialList,iMonth,myMonth[w][d]);
     }

     if(ifHasSigned){
        if (SpecialData) {
          htmls.push("<td class='on special'>" + (!isNaN(myMonth[w][d]) ? myMonth[w][d] : " ") + " <i></i><span>补签</span><p>双十一</p></td>");
        }else{
          htmls.push("<td class='on'>" + (!isNaN(myMonth[w][d]) ? myMonth[w][d] : " ") + " <i></i><span>补签</span></td>");
        }
     } else if(Retroactive) {
        if (SpecialData) {
          htmls.push("<td class='bu special'>" + (!isNaN(myMonth[w][d]) ? myMonth[w][d] : " ") + " <i></i><span>补签</span><p>双十一</p></td>");
        }else{
          htmls.push("<td class='bu'>" + (!isNaN(myMonth[w][d]) ? myMonth[w][d] : " ") + " <i></i><span>补签</span></td>");
        }
     }else{
        if (SpecialData) {
          if(TodayData){
            htmls.push("<td class='today special'><div class='TodayTips'>" + (!isNaN(myMonth[w][d]) ? myMonth[w][d] : " ") + "</div> <i></i><span>补签</span><p>双十一</p></td>");
          }else{
            htmls.push("<td class='special'>" + (!isNaN(myMonth[w][d]) ? myMonth[w][d] : " ") + " <i></i><span>补签</span><p>双十一</p></td>");
          }
        }else{
          if(TodayData){
            htmls.push("<td class='today'><div class='TodayTips'>" + (!isNaN(myMonth[w][d]) ? myMonth[w][d] : " ") + "</div> <i></i><span>补签</span></td>");
          }else{
            htmls.push("<td>" + (!isNaN(myMonth[w][d]) ? myMonth[w][d] : " ") + " <i></i><span>补签</span></td>");
          }
        }
     }
    }
    htmls.push("</tr>");
   }
   htmls.push("</table>");
   htmls.push("</div>");
   htmls.push("</div>");
   return htmls.join('');
  }
};