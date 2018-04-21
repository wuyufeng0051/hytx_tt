$(function(){
  
	//导航
  $('.header-r .screen').click(function(){
    var nav = $('.nav'), t = $('.nav').css('display') == "none";
    if (t) {nav.show();}else{nav.hide();}
  });

  (function ($) {
   $.getUrlParam = function (name) {
    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
    var r = window.location.search.substr(1).match(reg);
    if (r != null) return unescape(r[2]); return null;
   }
  })(jQuery);
   var rates = $.getUrlParam('rates');
   console.log(rates)


   if (rates == 1) {
     $('.common').show();
   }

  //  评价
   $('#suggestion').click(function(){
     $('.common').show();
   })

  // 退款
  $('.apply-refund-link').click(function(){
    var t = $(this);
    $('.layer').addClass('show').animate({"left":"0"},100);
  })

  // 隐藏退款
  $('#typeback').click(function(){
    $('.layer').animate({"left":"100%"},100);
    setTimeout(function(){
      $('.layer').removeClass('show');
    }, 100)
  })



  // 店铺评分
  $('.pingfen i').click(function(){
    var t = $(this);
    t.addClass('on');
    t.prevAll().addClass('on');
    t.nextAll().removeClass('on');
  })


  //提交评价
	$("#commonBtn").bind("click", function(){
		var t           = $(this),
			rating      = $("#rating .on").length,
			score1      = $("#score1 .on").length,
			score2      = $("#score2 .on").length,
			score3      = $("#score3 .on").length,
			commentText = $("#commentText").val();

		if(t.hasClass('disabled')) return;

		if(rating == "0"){
			alert("请选择总体评价！");
			return;
		}
		if(score1 == "0"){
			alert("请选择描述评价！");
			return;
		}
		if(score2 == "0"){
			alert("请选择服务评价！");
			return;
		}
		if(score3 == "0"){
			alert("请选择环境评价！");
			return;
		}
		if(commentText == "" || commentText.length < 15){
			alert("评价内容至少15个字！");
			return;
		}

		var pics = [];
		$("#litpic li.item").each(function(){
			var val = $(this).find("img").attr("data-val");
			if(val != ""){
				pics.push(val);
			}
		});

		var data = {
			id: id,
			rating: rating,
			score1: score1,
			score2: score2,
			score3: score3,
			pics: pics.join(","),
			content: commentText
		}

		t.addClass("disabled").html("提交中...");

		$.ajax({
			url: masterDomain+"/include/ajax.php?service=tuan&action=sendCommon",
			data: data,
			type: "POST",
			dataType: "jsonp",
			success: function (data) {
				if(data && data.state == 100){
					alert("评价成功！");
					t.removeClass("disabled").html("修改评价");
				}else{
					alert(data.info);
					t.removeClass("disabled").html("重新发表");
				}
			},
			error: function(){
				alert("网络错误，请重试！");
				t.addClass("disabled").html("重新发表");
			}
		});


	});


  //提交申请退款
	$("#submit").bind("click", function(){
		var t       = $(this),
			type    = $("#type").val(),
			content = $("#textarea").val();

		if(t.hasClass('disabled')) return;

		if(type == 0 || type == ""){
			alert("请选择退款原因");
			return;
		}

		if(content == "" || content.length < 15){
			alert("说明内容至少15个字！");
			return;
		}

		var pics = [];

		$("#litpic li.item").each(function(){
			var val = $(this).find("img").attr("data-val");
			if(val != ""){
				pics.push(val);
			}
		});

		var data = {
			id: id,
			type: type,
			content: content,
			pics: pics.join(",")
		}

		t.addClass("disabled").html("提交中...");

		$.ajax({
			url: masterDomain+"/include/ajax.php?service=tuan&action=refund",
			data: data,
			type: "POST",
			dataType: "jsonp",
			success: function (data) {
				if(data && data.state == 100){
					alert("提交成功，请耐心等待申请结果！");
					location.reload();
				}else{
					alert(data.info);
					t.removeClass("disabled").html("重新提交");
				}
			},
			error: function(){
				alert("网络错误，请重试！");
				t.removeClass("disabled").html("重新提交");
			}
		});
	});



})
