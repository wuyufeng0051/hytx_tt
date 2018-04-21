$(function(){
	$('.list').slide({mainCell:".bd", titCell:".hd ul", autoPlay:true, autoPage:true,effect:"fold",prevCell:".prev",nextCell:".next"});
	$('.list-1').slide({mainCell:".bd", titCell:".hd ul", autoPlay:true, autoPage:true,effect:"fold",prevCell:".prev",nextCell:".next"});
	$('.list-2').slide({mainCell:".bd", titCell:".hd ul", autoPlay:true, autoPage:true,effect:"fold",prevCell:".prev",nextCell:".next"});
	$(".picScroll-left").slide({mainCell:".swipe-wrap  ul",autoPage:true,effect:"left",autoPlay:true,vis:5,prevCell:".prev-btn",nextCell:".next-btn"});
	//返回顶部
	$(".to_top .top").bind("click", function(){
		$('html, body').animate({scrollTop:0}, 300);
	});
	// 顶部二维码
	$('.topbarlink li').hover(function(){
		var s = $(this);
		s.find('.pop').show();
	}, function(){
		$(this).find('.pop').hide();
	})
	// 在线估价
	$('.gj').click(function(){
		var box = $('.baojia')
		if (box.css("display")=="none") {
			box.show();
			$('.disk').show();
		}else{
			box.hide();
			$('.disk').hide();
		}
	})
	$('.baojia span').click(function(){
		$('.baojia').hide();
		$('.disk').hide();
	})

	//区域
	$("#addr1").change(function(){
		var sel = $(this), id = sel.val();
		if(id != 0 && id != ""){
			$.ajax({
				type: "GET",
				url: masterDomain+"/include/ajax.php",
				data: "service=renovation&action=addr&son=0&type="+id,
				dataType: "jsonp",
				success: function(data){
					var i = 0, opt = [];
					if(data instanceof Object && data.state == 100){
						for(var key = 0; key < data.info.length; key++){
							opt.push('<option value="'+data.info[key]['id']+'">'+data.info[key]['typename']+'</option>');
						}
						$("#addr2").html('<option value="">街道</option>'+opt.join("")+'</select>');
					}else{
						$("#addr2").html('<option value="">街道</option>');
					}
				},
				error: function(msg){
					alert(msg.status+":"+msg.statusText);
				}
			});
		}else{
			$("#addr2").html('<option value="">街道</option>');
		}
	});


	$('.sqfwForm').submit(function(event){
		event.preventDefault();
		var f = $(this);
		f.find('.has-error').removeClass('has-error');
		var str = '',r = true;
		var btn = f.find(".submit");

		if(btn.hasClass("disabled")) return false;

		// 称呼
		var name = f.find('.username');
		var namev = $.trim(name.val());
		if(namev == '') {
			name.focus().addClass('has-error');
			errmsg(name, '请填写您的称呼');
			r = false;
		}

		// 手机号
		var phone = f.find('.userphone');
		var phonev = $.trim(phone.val());
		if(phonev == '') {
			phone.addClass('has-error');
			if (r) {
				phone.focus();
				errmsg(phone, '请输入手机号码');
			}
			r = false;
		} else {
			var telReg = !!phonev.match(/^(13|14|15|17|18)[0-9]{9}$/);
			if(!telReg){
			    phone.addClass('has-error');
			    if (r) {
			    	phone.focus();
			    	errmsg(phone,'请输入正确手机号码');
			    }
			    r = false;
			}
		}

		// 区域
		var addr1 = $('#addr1');
		if(addr1.val() == 0 || addr1.val() == "") {
			addr1.addClass('has-error');
			if (r) {
				errmsg(addr1, '请选择区域');
			}
			r = false;
		}

		// 街道
		var addr2 = $('#addr2');
		if(addr2.val() == 0 || addr2.val() == "") {
			addr2.addClass('has-error');
			if (r) {
				errmsg(addr2, '请选择街道');
			}
			r = false;
		}

		if(!r) {
			return false;
		}

		btn.addClass("disabled").val("申请中...");

		var data = [];
		data.push("people="+namev);
		data.push("contact="+phonev);
		data.push("addrid="+addr2.val());
		data.push("body="+$("#note").val());

		$.ajax({
			url: masterDomain+"/include/ajax.php?service=renovation&action=sendEntrust",
			data: data.join("&"),
			type: "POST",
			dataType: "jsonp",
			success: function (data) {
				btn.removeClass("disabled").val("立即申请");
				if(data && data.state == 100){
					alert("申请成功，工作人员收到您的信息后会第一时间与你联系，请保持您的手机畅通！");
				}else{
					alert(data.info);
				}
			},
			error: function(){
				alert("网络错误，请重试！");
				btn.removeClass("disabled").val("申请中...");
			}
		});

		return false;

	});


})
//数量错误提示
var errmsgtime;
function errmsg(div,str){
	$('#errmsg').remove();
	clearTimeout(errmsgtime);
	var top = div.offset().top - 33;
	var left = div.offset().left;

	var msgbox = '<div id="errmsg" style="position:absolute;top:' + top + 'px;left:' + left + 'px;height:30px;line-height:30px;text-align:center;color:#f76120;font-size:14px;display:none;z-index:99999999;background:#fff;">' + str + '</div>';
	$('body').append(msgbox);
	$('#errmsg').fadeIn(300);
	errmsgtime = setTimeout(function(){
		$('#errmsg').fadeOut(300, function(){
			$('#errmsg').remove()
		});
	},2000);
};