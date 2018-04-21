$(function(){
	// 顶部个人关注按钮
	$('.attion').click(function(){
		var x = $(this);
		if (x.hasClass('attioned')) {
			x.removeClass('attioned').html('<em>+</em><span>关注</span>')
		}else{
			x.addClass('attioned').html('已关注')
		}
	})

  // 房产tab切换
  $('.house_nav ul li').click(function(){
    var x = $(this),
        index = x.index();
    x.addClass('HN_bc').siblings().removeClass('HN_bc');
    $('.house_box .house_list').eq(index).show().siblings().hide();
  })
  // 粉丝关注按钮
  $('.fans_list ul li .attention').click(function(){
    var x = $(this);
    if (x.hasClass('guanzhu_btn')) {
      x.removeClass('guanzhu_btn');
      x.text('关注')
    }else{
      x.addClass('guanzhu_btn');
      x.text('已关注')
    }
  })
	// 留言板评论展开
	$('.reply_btn i').click(function(){
		var x = $(this),
			find = x.closest('.reply').find('.comment_box');
		if (find.css("display") == "block") {
			find.hide();
		}else{
			find.show();
		}
	})
	var commonChange = function(t){
		var val = t.text(), maxLength = 200;
		var charLength = val.replace(/<[^>]*>|\s/g, "").replace(/&\w{2,4};/g, "a").length;
		var imglength = t.find('img').length;
		var alllength = charLength + imglength;
		var surp = maxLength - charLength - imglength;
		surp = surp <= 0 ? 0 : surp;

		t.closest('.write').find('em').text(surp);

		if(alllength > maxLength){
			t.text(val.substring(0,maxLength));
			return false;
		}
    if(alllength > 0){
      t.closest('.comment_box').find('.com_btn').css('background','#34bdf6')
    }else{
      t.closest('.comment_box').find('.com_btn').css('background','#d4d4d4')
    }

	}
	$('.txt').keyup(function(){
		memerySelection = window.getSelection();
		commonChange($(this));
	})

	

	// 表情盒子打开关闭 
	
    var memerySelection;
	$('.editor').click(function(){
		var x = $(this),
			find = x.closest('.comment_foot').find('.face_box');
		if (find.css("display") == "block") {
			find.hide();
			x.removeClass('ed_bc');
		}else{
	    memerySelection = window.getSelection();
			find.show();
			x.addClass('ed_bc');
			return false;
		}
	})
	// 选择表情

    $('.face_box ul li').click(function(){
        var t = $(this).find('img'), textarea = t.closest('.comment_box').find('.textarea'), hfTextObj = textarea;
        hfTextObj.focus();
        pasteHtmlAtCaret('<img src="'+t.attr("src")+'" />');
    })
  	

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
})