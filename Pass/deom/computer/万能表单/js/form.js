$(function(){
	var width = $('.func').width();
        $('.func').css('width', (width - 11) + "px");

        var fwidth = $('.welcome1').width();
        var a = fwidth % 120;
        var b = parseInt(fwidth / 120);
        var c = a + 360;
        var d = b - 3;
        var e = parseInt(c / d);
        $('.img1').css('margin-left', (e / 2) + 'px');
        $('.img1').css('margin-right', (e / 2) + 'px');


	$(".header_top").show();
      $(".category_list li").click(function() {
        if ($(this).hasClass("hangye")) return;

        var classname = $(this).prop("className") + "List";
        classname = classname.replace(" active", "");
        $(this).addClass("active").siblings().removeClass("active");
        $(".metismenu> li:not(:first-child)").fadeOut(300);
        $(".header_top").show();
        $(".metismenu li." + classname).fadeIn(300);
        $(".metismenu li." + classname).eq(0).addClass("active");
        $(".metismenu li." + classname).eq(0).find("ul").addClass("in");
        $(".jichuList").removeClass("active");
        $(".jichuList ul").removeClass("in");

      });
      $(".mail").hover(function() {
        $(".mail_list").fadeIn(300)
      },
      function() {
        $(".mail_list").fadeOut(300);
      })
    function autoclk(a, sa, b) {
      $(".metismenu> li").hide();
      $(".header_top").show();
      var tarc = "." + a;
      var classname = $(tarc).prop("className") + "List";
      if (b == 1) {
        $(tarc).addClass("active").siblings().removeClass("active");
        $(".metismenu li." + classname).fadeIn(300);
        $(".metismenu li." + classname + " active").find("ul").addClass("in");
      } else {
        $(tarc).addClass("active").siblings().removeClass("active");
        $(".metismenu li." + classname).fadeIn(300);
        $(".jichuList").removeClass("active");
        $(".jichuList ul").removeClass("in");
      }
    }


    //保存
	  $("#saveButon").click(function() {
	    var title = $("input[name=title]").val();
	    var keyword = $("input[name=keyword]").val();
	    var address = $("input[name=address]").val();
	    var longitude = $("input[name=longitude]").val();
	    var latitude = $("input[name=latitude]").val();
	    var tel = $("input[name=tel]").val();
	    var fixphone = $("input[name=fixphone]").val();
	    var email_notice = $("input[name=email_notice]").prop('checked');
	    var open_notice_sms = $("input[name=open_notice_sms]").prop('checked');
	    var open_notice = $("input[name=open_notice]").prop('checked');
	    var reg_phone = /^([0-9]){6,}$/;
	    var reg_tel = /^\d{3,4}(-\d{3})?-\d{4,}$/;
	    var msg = '';
	    var is_pay = $("input[name=is_pay]:checked").val();
	    var pprice = $("#price").val();

	    if (title == "") {
	      msg += '标题必填\n';
	    }
	    if (keyword == "") {
	      msg += '关键词必填\n';
	    }
	    if (tel == "" && fixphone == "") {
	      msg += '手机号和固话必须选一项填写\n';
	    }
	    if (tel != "" && !reg_phone.test(tel)) {
	      msg += '手机号格式不正确\n';
	    }
	    if (fixphone != "" && !reg_tel.test(fixphone)) {
	      msg += '固话格式不正确\n';
	    }
	    if (address == "") {
	      msg += '位置信息必填\n';
	    }
	    if (longitude == "") {
	      msg += '经度必填\n';
	    }
	    if (latitude == "") {
	      msg += '纬度必填\n';
	    }
	    if (open_notice == true) {
	      if (email_notice == true) {
	        var email_adds = $("input[name=email_adds]").val();
	        if (email_adds == "") {
	          msg += '开启了邮箱提醒，接受者邮箱必填\n';
	        } else {
	          if (email_adds.indexOf(",") != -1) {
	            var email_count = email_adds.match(/,/g).length;
	            if (email_count > 3) {
	              msg += '接收者邮箱最多填写3个\n';
	            }
	          }
	        }
	        var email_name = $("input[name=email_name]").val();
	        if (email_name == "") {
	          msg += '开启了邮箱提醒，接受者名称必填\n';
	        } else {
	          if (email_name.indexOf(",") != -1) {
	            var name_count = email_name.match(/,/g).length;
	            if (name_count > 3) {
	              msg += '接收邮件者的称呼最多填写3个\n';
	            }
	          }
	        }
	        var public_email = $("input[name=public_email]").val();
	        var public_password = $("input[name=public_password]").val();
	        if (public_email == "") {
	          msg += '开启了邮箱提醒，公用邮箱账号不能为空\n';
	        }
	        if (public_password == "") {
	          msg += '开启了邮箱提醒，公用邮箱密码不能为空\n';
	        }
	      }
	      if (open_notice_sms == true) {
	        var notice_phone = $("input[name=notice_phone]").val();
	        if (notice_phone == "") {
	          msg += '开启了短信提醒，接收的手机号不能为空\n';
	        } else {
	          if (notice_phone.indexOf(",") != -1) {
	            var phone_count = notice_phone.match(/,/g).length;
	            if (phone_count > 3) {
	              msg += '短信提醒最多填写3个\n';
	            }
	          }
	        }
	      }
	    }
	    if (msg != "") {
	      alert(msg);
	      return false;
	    }
	    var set_id = $("input[name=set_id]").val();
	    if (is_pay == 1 && !(set_id > 0)) {
	      if (! (pprice > 0)) {
	        alert('支付价格必须填写大于0的数值！');
	        return false;
	      }
	    }
	    componentlist(); //获取小页面展示中的所有组件数据
	    $("#custom_form").submit();
	  })

	  //预览
	  $("#previewButton").click(function() {
	    componentlist();
	    $.ajax({
	      type: 'POST',
	      url: "index.php?g=User&m=Custom&a=preview",
	      data: $("#custom_form").serialize(),
	      success: function(data) {
	        $('#formPreviewPage').attr('src', $('#formPreviewPage').attr('src'));
	      }
	    })

	  }); $(function() {
	    var limit_time = '';
	    var limit_nums_total = '';
	    var limit_once_total = '';
	    var limit_nums = '';
	    var limit_once = '';
	    var open_notice = '';
	    var email_notice = '';
	    var open_notice_sms = '';
	    var open_notice_weixin = '';
	    var notice_phone_once = '';
	    var pay_notice_more = '';
	    var pay_notice = '';
	    if (limit_time == 0) {
	      $("#term-permanent").parent().addClass('checked');
	      $("#term-permanent").prop('checked', true);
	    } else if (limit_time == 1) {
	      $("#term-short").parent().addClass('checked');
	      $("#term-short").prop('checked', true);
	      $(".set-expiryDate").removeClass('hide');
	    }
	    if (limit_nums_total == 1) {
	      $(".icheckbox_minimal-green").eq(0).addClass('checked');
	      $("input[name='limit_nums_total']").prop('checked', true);
	    }
	    if (limit_once_total == 1) {
	      $(".icheckbox_minimal-green").eq(1).addClass('checked');
	      $("input[name='limit_once_total']").prop('checked', true);
	    }
	    if (limit_nums == 1) {
	      $(".icheckbox_minimal-green").eq(2).addClass('checked');
	      $("input[name='limit_nums']").prop('checked', true);
	    }
	    if (limit_once == 1) {
	      $(".icheckbox_minimal-green").eq(3).addClass('checked');
	      $("input[name='limit_once']").prop('checked', true);
	    }
	    if (open_notice == 1) {
	      $(".icheckbox_minimal-green").eq(4).addClass('checked');
	      $("input[name='open_notice']").prop('checked', true);
	      $(".allNotice").removeClass('hide');
	    }
	    if (email_notice == 1) {
	      $(".icheckbox_minimal-green").eq(5).addClass('checked');
	      $("input[name='email_notice']").prop('checked', true);
	      $(".noticeSet-email").removeClass('hide');
	    }
	    if (open_notice_sms == 1) {
	      $(".icheckbox_minimal-green").eq(6).addClass('checked');
	      $("input[name='open_notice_sms']").prop('checked', true);
	      $(".noticeSet-text").removeClass('hide');
	    }
	    if (open_notice_weixin == 1) {
	      $(".icheckbox_minimal-green").eq(7).addClass('checked');
	      $("input[name='open_notice_weixin']").prop('checked', true);
	    }
	    if (notice_phone_once == 1) {
	      $(".icheckbox_minimal-green").eq(8).addClass('checked');
	      $("input[name='notice_phone_once']").prop('checked', true);
	    }
	    if (pay_notice_more == 1) {
	      $(".icheckbox_minimal-green").eq(9).addClass('checked');
	      $("input[name='pay_notice_more']").prop('checked', true);
	    }
	    if (pay_notice == 1) {
	      $(".icheckbox_minimal-green").eq(10).addClass('checked');
	      $("input[name='pay_notice']").prop('checked', true);
	    }
	  })

	  function recoveryimg(id) {
	    var imgstr = 'http://s.404.cn/tpl/static/custom/wap/images/i' + id + '.png';
	    $("#icon" + id + '_src').attr('src', imgstr);
	    $("#icon" + id).val("");
	  }
	var follow = {
        allstr: [],
        instr: [],
        _init: function() {
          if (this.status == 1) {
            return;
          }
          this.allstr = [{
            name: 'is_attention',
            prent: 'tr'
          },
          {
            name: 'is_subhelp',
            prent: 'tr'
          },
          {
            name: 'follow',
            prent: 'div.formRow'
          },
          {
            name: 'need_attention',
            prent: 'tr'
          },
          {
            name: 'is_help',
            prent: 'tr'
          },
          {
            name: 'is_follow',
            prent: 'tr'
          },
          {
            name: 'need_follow',
            prent: 'tr'
          },
          {
            name: 'guanzhu',
            prent: 'tr'
          },
          {
            name: 'focus',
            prent: 'tr'
          },
          {
            name: 'sub_is_need',
            prent: 'tr'
          },
          {
            name: 'is_attention',
            prent: 'div.formRow'
          },
          {
            name: 'ishelp_attention',
            prent: 'div.formRow'
          },
          {
            name: 'action_is_attention',
            prent: 'tr'
          },
          {
            name: 'state_subscribe',
            prent: 'tr'
          }];
          this._in();
          this._check();
        },
        _in: function() {
          $.each(this.allstr,
          function(i, d) { ($('input[name="' + d.name + '"]').parents(d.prent).length > 0) && ((follow.instr).push(d));
          });
        },
        _check: function() {
          $.each(this.instr,
          function(i, d) {
            $('input[name="' + d.name + '"]').parents(d.prent).remove();
          });
        }
      }
    follow._init();


    // 更换图片
	$(".upload_IMG1").click(function () {
		$(".upload_IMG1").on("change",function(){
			var x = $(this),
				objUrl = getObjectURL(this.files[0]) ; 
			if (objUrl) {
				x.closest('.putWrap').find('img').attr("src", objUrl) ; 
				$('.imgList #banner1_src_src') .attr("src", objUrl) ;

			}
		});
	});
	$(".upload_IMG2").click(function () {
		$(".upload_IMG2").on("change",function(){
			var x = $(this),
				objUrl = getObjectURL(this.files[0]) ; 
			if (objUrl) {
				x.closest('.putWrap').find('img').attr("src", objUrl) ; 
				$('.imgList #banner2_src_src') .attr("src", objUrl) ;

			}
		});
	});
	$(".upload_IMG3").click(function () {
		$(".upload_IMG3").on("change",function(){
			var x = $(this),
				objUrl = getObjectURL(this.files[0]) ; 
			if (objUrl) {
				x.closest('.putWrap').find('img').attr("src", objUrl) ;
				$('.imgList #banner3_src_src') .attr("src", objUrl) ;
			}
		});
	});
	$(".choice_IMG").click(function () {
		$(".choice_IMG").on("change",function(){
			var x = $(this),
				objUrl = getObjectURL(this.files[0]) ; 
			if (objUrl) {
				x.closest('.formRow').find('img').attr("src", objUrl) ; 
			}
		});
	});
	$(".input_file").click(function () {
		$(".input_file").on("change",function(){
			var x = $(this),
				objUrl = getObjectURL(this.files[0]) ; 
			if (objUrl) {
				$('.title_field img').attr("src", objUrl) ; 
			}
		});
	});

	function getObjectURL(file) {
	    var url = null ;
	    if (window.createObjectURL!=undefined) { // basic
	      url = window.createObjectURL(file) ;
	    }else if (window.URL!=undefined) { // mozilla(firefox)
	      url = window.URL.createObjectURL(file) ;
	    }else if (window.webkitURL!=undefined) { // webkit or chrome
	      url = window.webkitURL.createObjectURL(file) ;
	    }
	    return url ;
	}
	// 恢复图片
	$('.recovery').click(function(){
		var x = $(this),
			IMG = x.closest('.putWrap').find('.real_img').val(),
			find = x.closest('.putWrap').find('img');
		find.attr("src", IMG);
	})

	
});