var ue = UE.getEditor('body', {'enterTag': ''});

$(function(){

    // 设置tab切换
    $('.tt li').click(function(){
        var  u = $(this);
        var index = u.index();
        $('.tab-content .tt_1').eq(index).addClass('active');
        $('.tab-content .tt_1').eq(index).siblings().removeClass('active');
        u.addClass('active');
        u.siblings('li').removeClass('active');
    })

    $('.yy li').click(function(){
      var  u = $(this);
      var index = u.index();
      $('.tab-content .yy_1').eq(index).addClass('active');
      $('.tab-content .yy_1').eq(index).siblings().removeClass('active');
      u.addClass('active');
      u.siblings('li').removeClass('active');
    })

    $('[data-rel="tooltip"]').tooltip();
    $('[data-rel="popover"]').popover();
    $('.chooseTime').timepicker($.extend($.datepicker.regional['zh-cn'], {'timeFormat':'hh:mm','hour':'09','minute':'40'}));

      jQuery('#StatisticsForm_beginDate').datepicker(jQuery.extend({
          showMonthAfterYear: false
      },
      jQuery.datepicker.regional['zh_cn'], {
          'showSecond': true,
          'changeMonth': true,
          'changeYear': true,
          'tabularLevel': null,
          'yearRange': '2013:2020',
          'minDate': new Date(2013, 1, 1, 00, 00, 00),
          'timeFormat': 'hh:mm:ss',
          'dateFormat': 'yy-mm-dd',
          'timeText': '时间',
          'hourText': '时',
          'minuteText': '分',
          'secondText': '秒',
          'currentText': '当前时间',
          'closeText': '关闭',
          'showOn': 'focus'
      }));
      jQuery('#StatisticsForm_endDate').datepicker(jQuery.extend({
          showMonthAfterYear: false
      },
      jQuery.datepicker.regional['zh_cn'], {
          'showSecond': true,
          'changeMonth': true,
          'changeYear': true,
          'tabularLevel': null,
          'yearRange': '2013:2020',
          'minDate': new Date(2013, 1, 1, 00, 00, 00),
          'timeFormat': 'hh:mm:ss',
          'dateFormat': 'yy-mm-dd',
          'timeText': '时间',
          'hourText': '时',
          'minuteText': '分',
          'secondText': '秒',
          'currentText': '当前时间',
          'closeText': '关闭',
          'showOn': 'focus'
      }));


      var tagenum = 100;
      $('body').delegate('.deletefield', 'click',function(){
          $(this).parents('.fatherblock').remove();
      });
      $('body').delegate('.sondeletefield', 'click',function(){
          $(this).parent('.fatherblock').remove();
      });
      $('#addpricenature').on('click',function(){
          var lenght = $('.natureblock').length;
          if(lenght>9){
              $.dialog.alert('最多设置10个商品属性');
          }
          var string = '<div class="natureblock fatherblock"><div class="fieldblock">';
          string += '<label>属性名: <input type="text" name="nature['+tagenum+'][name]" value="" style="width:80px;"/></label>';
          string += '<div class="deletefield" style="" title="删除商品属性"> 删除 </div>';
          string += '<div class="addsonfield" title="增加属性值" onclick="addsonnaturepriceblock(this,'+tagenum+');"> 增加属性值 </div>';
          string += '</div></div>';
          $('#natureblocklist').append(string);
          tagenum++;
      });


});



//表单提交
function checkFrom(form){

    var form = $("#food-form"), action = form.attr("action"), data = form.serialize();
    var btn = $("#submitBtn");

    ue.sync();

    btn.attr("disabled", true);

    $.ajax({
        url: action,
        type: "post",
        data: data,
        dataType: "json",
        success: function(res){
            if(res.state == 100){
                location.href = "waimaiFoodList.php?sid="+sid;
            }else{
                $.dialog.alert(res.info);
                btn.attr("disabled", false);
            }
        },
        error: function(){
            $.dialog.alert("网络错误，保存失败！");
            btn.attr("disabled", false);
        }
    })

}



function addsonnaturepriceblock(obj,key){
    var string = '<div class="sonfieldblock fatherblock">';
        string += '<label>属性值: <input type="text" value="" name="nature['+key+'][value][]"/></label> ';
        string += '<label>价格: <input type="text" value="0" name="nature['+key+'][price][]"/></label>';
        string += '<div class="sondeletefield">删除</div>';
        string += '</div>	';
        $(obj).parents('.natureblock').append(string);
}
