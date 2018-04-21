$(function(){

  //导航
  $('.header-r .more').click(function(){
    var nav = $('.nav'), t = $('.nav').css('display') == "none";
    if (t) {nav.show();}else{nav.hide();}
  })

  var rid = 0;

  // 回复
  $('.ureply').click(function(){
    var userid = $.cookie(cookiePre+"login_user");
	if(userid == null || userid == ""){
		location.href = masterDomain + "/login.html";
		return false;
	}

    var t = $(this);
    $('.layer').addClass('show').animate({"left":"0"},100);
    if (t.hasClass('imgreply')) {
      rid = 0;
      $('.editor .img').css("display","table-cell");
    }else {
      rid = t.closest(".cbox").data("id");
      $('.editor .img').hide();
    }
  })

  // 隐藏回复
  $('.top-l').click(function(){
    $('.layer').removeClass('show').animate({"left":"100%"},100);
    $('.layer .textarea').html('');
  })

  // 选择表情
  var memerySelection;
  $('.editor .emotion').click(function(){
		var t = $(this), box = $('.emotion-box');
    memerySelection = window.getSelection();
		if (box.css('display') == 'none') {
			$('.emotion-box').show();
      t.addClass('on');
			return false;
		}else {
			$('.emotion-box').hide();
      t.removeClass('on');
		}
	})

  $('.emotion-box li').click(function(){
		var t = $(this).find('img'), textarea = $('.textarea'), hfTextObj = textarea;
		hfTextObj.focus();
		pasteHtmlAtCaret('<img src="'+t.attr("src")+'" />');
	})

  //回复框
	function replyFunc(parent, name){
		var comment = $(".comment"), mlinfo = comment.closest(".ml-list-info");
		if(Number(mlinfo.attr("data-reply")) == 0){
			mlinfo.find(".reply-shou").click();
		}
		comment.remove();
		parent.find(".comment").remove();
		parent.append($("#replyTemp").html());
		parent.find(".comment").show();

		var textarea = parent.find(".textarea");

		if(name){
			textarea.html('<label contenteditable="false">回复  ' + name + '</label>&nbsp;');
		}

		set_focus(textarea);
		hfTextObj = textarea;
		textarea.bind("paste", function(e){
			clearHtml(e);
		})
		textarea.bind("keydown", function(e){
			clearShortKey(e);
		})
	}

  //根据光标位置插入指定内容
	function pasteHtmlAtCaret(html) {
      var sel, range;
      if (window.getSelection) {
          sel = memerySelection;
          if (sel.getRangeAt && sel.rangeCount) {
              range = sel.getRangeAt(0);
              range.deleteContents();
              var el = document.createElement("div");
              el.innerHTML = html;
              var frag = document.createDocumentFragment(), node, lastNode;
              while ( (node = el.firstChild) ) {
                  lastNode = frag.appendChild(node);
              }
              range.insertNode(frag);
              if (lastNode) {
                  range = range.cloneRange();
                  range.setStartAfter(lastNode);
                  range.collapse(true);
                  sel.removeAllRanges();
                  sel.addRange(range);
              }
          }
      } else if (document.selection && document.selection.type != "Control") {
          document.selection.createRange().pasteHTML(html);
      }
  }

	//光标定位到最后
	function set_focus(el){
		el=el[0];
		el.focus();
		if($.browser.msie){
			var rng;
			el.focus();
			rng = document.selection.createRange();
			rng.moveStart('character', -el.innerText.length);
			var text = rng.text;
			for (var i = 0; i < el.innerText.length; i++) {
				if (el.innerText.substring(0, i + 1) == text.substring(text.length - i - 1, text.length)) {
					result = i + 1;
				}
			}
		}else{
			var range = document.createRange();
			range.selectNodeContents(el);
			range.collapse(false);
			var sel = window.getSelection();
			sel.removeAllRanges();
			sel.addRange(range);
		}
	}

  //
  // $('.textarea').focus(function(){
  //   $('.emotion-box').hide();
  // })

  // 收藏
  $('.floatNav .shou').click(function(){
    var t = $(this), type = "add";
    if (t.hasClass('shoued')) {
      type = "del";
      t.removeClass('shoued');
      t.find('span').text('收藏');
    }else {
      t.addClass('shoued');
      t.find('span').text('已收藏');
    }
    $.post("/include/ajax.php?service=member&action=collect&module=tieba&temp=detail&type="+type+"&id="+id);
  })

  // 分享
  $('.floatNav .share').click(function(){
    var sharebox = $('.sharebox')
    if (sharebox.css('display') == "none") {
      sharebox.css("display","-webkit-box");
    }else {
      sharebox.hide();
    }
  })

  $(document).on('touchmove',function(){
    $('.sharebox').hide();
  })


  // 更多回复
  $('.rlist').delegate('.rmore', 'click', function(){
    var t = $(this), par = t.closest(".cbox"), replyMore = par.find(".rlist"), rid = Number(par.data("id")), reply = Number(par.data("reply"));
    var page = par.attr("data-page");
  	if(id && reply){
      page++;
      par.attr("data-page", page);
  	  getReply(replyMore, rid, page);
  	}
  })

  // 回复某人
  $('.rlist').delegate('li', 'click', function(){
    var t = $(this), name = t.find('.rname').text();
    $('.layer').addClass('show').animate({"left":"0"},100);
    $('.layer .textarea').html('<label contenteditable="false">回复 ' + name + '</label>')
    rid = t.closest(".cbox").data("id");
  })

  window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"1","bdSize":"24"},"share":{}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];



  //异步获取回复信息
  $(".cbox").each(function(){
	var t = $(this), replyMore = t.find(".rlist"), rid = Number(t.data("id")), reply = Number(t.data("reply"));
	if(id && reply){
      t.attr("data-page", 1);
	  getReply(replyMore, rid, 1);
	}
  });




  //发表回复
  $(".top-r").bind("click", function(){
    var t = $(this), content = $(".textarea").html();
	if(!t.hasClass("disabled") && $.trim(content) != ""){
		t.addClass("disabled");

		$.ajax({
			url: "/include/ajax.php?service=tieba&action=sendReply",
			data: "tid="+id+"&rid="+rid+"&content="+encodeURIComponent(content),
			type: "POST",
			dataType: "json",
			success: function (data) {
                t.removeClass("disabled");
				if(data && data.state == 100){
                    $(".top-l").click();
                    if(data.info.state == 1){
                        alert("回复成功！");
                        location.reload();
                    }else{
                        alert("回复成功，请等待管理员审核！");
                    }
				}else{
					alert(data.info);
				}
			},
			error: function(){
				alert("网络错误，发表失败，请稍候重试！");
				t.removeClass("disabled");
			}
		});
	}
  });

	
  //音频皮肤
  audiojs.events.ready(function() {
    audiojs.createAll();
  });



})


function transTimes(timestamp, n){
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
    }else if(n == 4){
        return (hour+':'+minute);
    }else{
        return 0;
    }
}


var replyPageSize = 6;
//获取回复列表
function getReply(replyMore, rid, page){
    if(page == 1){
    	replyMore.html("<div class='loading'>加载中...</div>");
    }

	$.ajax({
		url: "/include/ajax.php?service=tieba&action=reply&tid="+id+"&rid="+rid+"&page="+page+"&pageSize="+replyPageSize,
		type: "GET",
		dataType: "jsonp",
		success: function (data) {
			if(data && data.state == 100){

				var list = data.info.list, pageInfo = data.info.pageInfo, html = [];
				for(var i = 0; i < list.length; i++){
					html.push('<li><span class="rname">'+list[i].member.nickname+'：</span><span class="rinfo">'+list[i].content+'</span><span class="rtime">'+transTimes(list[i].pubdate, 1)+'</span></li>')
				}

                if(page == 1){
                    replyMore.html('<ul>'+html.join("")+'</ul>');
                }else{
                    replyMore.find("ul").append(html.join(""));
                }

                var sur = pageInfo.totalCount - page * replyPageSize;
                if(sur > 0){
                    if(page == 1){
                        replyMore.append('<div class="rmore">还有'+sur+'条回复...</div>');
                    }else{
                        replyMore.find(".rmore").html('还有'+sur+'条回复...');
                    }
                }else{
                    replyMore.find(".rmore").remove();
                }

			}
		}
	});
}
