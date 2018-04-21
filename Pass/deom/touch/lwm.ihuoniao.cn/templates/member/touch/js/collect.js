/**
 * 会员中心新闻投稿列表
 * by guozi at: 20150627
 */


var uploadErrorInfo = [],
 huoniao = {

 //转换PHP时间戳
 transTimes: function(timestamp, n){
   update = new Date(timestamp*1000);//时间戳要乘1000
   year   = update.getFullYear();
   month  = (update.getMonth()+1<10)?('0'+(update.getMonth()+1)):(update.getMonth()+1);
   day    = (update.getDate()<10)?('0'+update.getDate()):(update.getDate());
   hour   = (update.getHours()<10)?('0'+update.getHours()):(update.getHours());
   minute = (update.getMinutes()<10)?('0'+update.getMinutes()):(update.getMinutes());
   second = (update.getSeconds()<10)?('0'+update.getSeconds()):(update.getSeconds());
   if(n == 1){
     return (year+'-'+month+'-'+day+' '+hour+':'+minute+':'+second);
   }else if(n == 2){
     return (year+'-'+month+'-'+day);
   }else if(n == 3){
     return (month+'-'+day);
   }else{
     return 0;
   }
 }

 //将普通时间格式转成UNIX时间戳
 ,transToTimes: function(timestamp){
   var new_str = timestamp.replace(/:/g,'-');
    new_str = new_str.replace(/ /g,'-');
    var arr = new_str.split("-");
    var datum = new Date(Date.UTC(arr[0],arr[1]-1,arr[2],arr[3]-8,arr[4],arr[5]));
    return datum.getTime()/1000;
 }


 //判断登录成功
 ,checkLogin: function(fun){
   //异步获取用户信息
   $.ajax({
     url: masterDomain+'/getUserInfo.html',
     type: "GET",
     async: false,
     dataType: "jsonp",
     success: function (data) {
       if(data){
         fun();
       }
     },
     error: function(){
       return false;
     }
   });
 }



 //获取附件不同尺寸
 ,changeFileSize: function(url, to, from){
   if(url == "" || url == undefined) return "";
   if(to == "") return url;
   var from = (from == "" || from == undefined) ? "large" : from;
   if(hideFileUrl == 1){
     return url + "&type=" + to;
   }else{
     return url.replace(from, to);
   }
 }

 //获取字符串长度
 //获得字符串实际长度，中文2，英文1
 ,getStrLength: function(str) {
   var realLength = 0, len = str.length, charCode = -1;
   for (var i = 0; i < len; i++) {
   charCode = str.charCodeAt(i);
   if (charCode >= 0 && charCode <= 128) realLength += 1;
   else realLength += 2;
   }
   return realLength;
 }



 //删除已上传的图片
 ,delAtlasImg: function(mod, obj, path, listSection, delBtn){
   var g = {
     mod: mod,
     type: "delAtlas",
     picpath: path,
     randoms: Math.random()
   };
   $.ajax({
     type: "POST",
     cache: false,
     async: false,
     url: "/include/upload.inc.php",
     dataType: "json",
     data: $.param(g),
     success: function() {}
   });
   $("#"+obj).remove();

   if($("#"+listSection).find("li").length < 1){
     $("#"+listSection).hide();
     $("#"+delBtn).hide();
   }
 }

 //异步操作
 ,operaJson: function(url, action, callback){
   $.ajax({
     url: url,
     data: action,
     type: "POST",
     dataType: "json",
     success: function (data) {
       typeof callback == "function" && callback(data);
     },
     error: function(){

       $.post("../login.php", "action=checkLogin", function(data){
         if(data == "0"){
           huoniao.showTip("error", "登录超时，请重新登录！");
           setTimeout(function(){
             location.reload();
           }, 500);
         }else{
           huoniao.showTip("error", "网络错误，请重试！");
         }
       });

     }
   });
 }
}


$(function(){
  var objId = $("#list");

  // 选择分类
  $('.orderbtn').click(function(){

    var t = $(this);
    if (!t.hasClass('on')) {
      t.addClass('on');
      $('.orderbox').animate({"top":".9rem"},200);
      $('.mask').show().animate({"opacity":"1"},200);
      $('body').addClass('fixed');
    }else {
      t.removeClass('on');
      $('.orderbox').animate({"top":"-100%"},200);
      $('.mask').hide().animate({"opacity":"0"},200);
      $('body').removeClass('fixed');
    }

  })

  $('.mask').click(function(){
    $('body').removeClass('fixed');
    $('.orderbtn').removeClass('on');
    $('.orderbox').animate({"top":"-100%"},200);
    $('.mask').hide().animate({"opacity":"0"},200);
  })

  if(state){
		$(".main-sub-tab li[data-id='"+state+"']").addClass("curr");
	}else{
		$(".main-sub-tab li:eq(0)").addClass("curr");
		state = $(".main-sub-tab li:eq(0)").data("id");
	}

  //状态切换
	$(".main-sub-tab li").bind("click", function(){
		var t = $(this), id = t.attr("data-id");
		if(!t.hasClass("curr") && !t.hasClass("sel")){
			state = id;
			atpage = 1;
			t.addClass("curr").siblings("li").removeClass("curr");
      objId.html("");
			getList(1);
		}
	});


  // 下拉加载
  $(window).scroll(function() {
    var h = $('.item').height();
    var allh = $('body').height();
    var w = $(window).height();
    var scroll = allh - w - h;
    if ($(window).scrollTop() > scroll && !isload) {
      atpage++;
      getList();
    };
  });


  // 删除
  objId.delegate(".del", "click", function(){
    var t = $(this), par = t.closest(".item"), id = par.attr("data-id");
    if(id){
      if(confirm('你确定要删除这条信息吗？')){
        t.siblings("a").hide();
        t.addClass("load");

        $.ajax({
          url: masterDomain+"/include/ajax.php?service=member&action=delCollect&id="+id,
          type: "GET",
          dataType: "jsonp",
          success: function (data) {
            if(data && data.state == 100){
              par.remove();
              //删除成功后移除信息层并异步获取最新列表
              objId.html('');
              getList(1)

            }else{
              alert(data.info);
              t.siblings("a").show();
              t.removeClass("load");
            }
          },
          error: function(){
            alert("网络错误，请稍候重试！");
            t.siblings("a").show();
            t.removeClass("load");
          }
        });
      }
    }
  });


  getList(1);

  function getList(is){

   isload = true;


   	if(is != 1){
   	// 	$('html, body').animate({scrollTop: $(".main-tab").offset().top}, 300);
   	}

   	objId.append('<p class="loading">加载中，请稍候...</p>');

    state = state == undefined ? "" : state;

   	$.ajax({
   		url: masterDomain+"/include/ajax.php?service=member&action=collectList&module="+module+"&temp="+state+"&page="+atpage+"&pageSize="+pageSize,
   		type: "GET",
   		dataType: "jsonp",
   		success: function (data) {
   			if(data && data.state != 200){
   				if(data.state == 101){
   					objId.html("<p class='loading'>暂无相关信息！</p>");
            $('.count span').text(0);
   				}else{
   					var list = data.info.list, pageInfo = data.info.pageInfo, html = [];

   					//拼接列表
   					if(list.length > 0){

   						var t = window.location.href.indexOf(".html") > -1 ? "?" : "&";
   						var param = t + "do=edit&id=";

   						for(var i = 0; i < list.length; i++){
   							var item        = [],
   									id          = list[i].id,
   									pubdate     = list[i].pubdate;

                  if(list[i].detail){
                    var title = list[i].detail.title,
        								url   = list[i].detail.url;

       							html.push('<div class="item" data-id="'+id+'">');
      							html.push('<div class="info-item fn-clear">');
      							html.push('<dl>');
      							html.push('<dt><a href="'+url+'">'+title+'</a></dt>');
      							html.push('<dd class="item-type-2">收藏时间：'+pubdate+'</dd>');
      							html.push('</dl>');
      							html.push('</div>');
      							html.push('<div class="o fn-clear">');
      							html.push('<a href="javascript:;" class="del">删除</a>');
      							html.push('</div>');
      							html.push('</div>');

                  //信息不存在或已删除
                  }else {
                    html.push('<div class="item" data-id="'+id+'">');
      							html.push('<div class="info-item fn-clear">');
      							html.push('<dl>');
      							html.push('<dt><a href="javascript:;" class="overtime">信息不存在或已删除</a></dt>');
      							html.push('<dd class="item-type-2">发布时间：'+pubdate+'</dd>');
      							html.push('</dl>');
      							html.push('</div>');
      							html.push('<div class="o fn-clear">');
      							html.push('<a href="javascript:;" class="del">删除</a>');
      							html.push('</div>');
      							html.push('</div>');
      							html.push('</div>');
                  }
   						}

              objId.append(html.join(""));
              $('.loading').remove();
              isload = false;

   					}else{
              $('.loading').remove();
              objId.append("<p class='loading'>已加载完全部信息！</p>");
   					}

   					switch(state){
   						case "":
   							totalCount = pageInfo.totalCount;
   							break;
   						case "0":
   							totalCount = pageInfo.gray;
   							break;
   						case "1":
   							totalCount = pageInfo.audit;
   							break;
   						case "2":
   							totalCount = pageInfo.refuse;
   							break;
   					}


            $("#total").html(pageInfo.totalCount);
    				$("#unread").html(pageInfo.unread);
    				$("#read").html(pageInfo.read);

   				}
   			}else{
   				objId.html("<p class='loading'>暂无相关信息！</p>");
          $('.count span').text(0);
   			}
   		}
   	});
   }



})
