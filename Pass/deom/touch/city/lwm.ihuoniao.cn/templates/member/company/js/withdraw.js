$(function(){

	var regu = "(^[1-9]([0-9]?)+[\.][0-9]{1,2}?$)|(^[1-9]([0-9]+)?$)|(^[0][\.][0-9]{1,2}?$)";
	var re = new RegExp(regu);

	//选择支付方式
	$("input[name=type]").bind("click", function(){
		var t = $(this), val = Number(t.val());
		$(".mitem").hide();
		$("#type"+val).show();
	});


	//卡号
	$("#cardnum").inputmask("9999 9999 9999 9999 9999", {placeholder: ""});


	//隐藏表单提示信息
	$(".inp").bind("input click focus", function(){
		$(this).removeClass("error").siblings(".tip-inline").removeClass().addClass("tip-inline").hide();
	});


	//文本框错误提示
	function inpErr(obj, txt){
		var obj = $("#"+obj), tip = obj.siblings(".tip-inline");
		tip.removeClass().addClass("tip-inline error").show();
		if(txt){
			tip.html('<s></s>'+txt);
		}
		obj.addClass("error");
	}


	//表单验证
	$(".inp").bind("blur", function(){
		var t = $(this), val = t.val(), id = t.attr("id"), tip = t.siblings(".tip-inline"), tiptxt = tip.html(), tj = false;		

		//金额验证
		if(id == "amount"){
			tj = !re.test(val) || val > money || val == "" ? false : true;
		}else{
			tj = val == "" ? false : true;
		}

		if(tj){
			t.removeClass("error");
			tip.removeClass().addClass("tip-inline ok").show();
		}else{
			tip.removeClass().addClass("tip-inline error").show();
			t.addClass("error");

			if(id == "amount"){
				if(val > money){
					inpErr("amount", "您最多可提现 &yen;"+money);
				}else{
					inpErr("amount", "金额必须为整数或小数，小数点后不超过2位。");
				}
			}
		}

	});


	//历史记录浮动层
	function historyPopup(data, type){
		var obj = $("#showHistoryExtend .history-main");
		if(data){

			var list = [];
			for(var i = 0; i < data.length; i++){

				var body = data[i].bank+'(...'+data[i].cardnum.substr(data[i].cardnum.length-4)+')';
				if(type == "alipay"){
					body = data[i].cardnum;
				}
				list.push('<li><a href="javascript:;" data-id="'+data[i].id+'" data-bank="'+data[i].bank+'" data-cardnum="'+data[i].cardnum+'" data-cardname="'+data[i].cardname+'"><strong>'+data[i].cardname+'</strong>&nbsp;&nbsp;'+body+'<em title="删除此条记录">&times;</em></a></li>');
			}
			obj.html('<ul>'+list.join("")+'</ul>');

		}else{
			obj.html('<div class="empty">您还没有提现记录。</div>');
		}
	}


	//获取历史记录
	function showHistory(obj, type){
		var pos = obj.offset(), left = pos.left, top = pos.top + 33, pop = "showHistoryExtend";
		$("#"+pop).size() > 0 ? $("#"+pop).remove() : null;
		$('<div class="history-list fn-hide" id="'+pop+'"><div class="history-main"><div class="load">加载中...</div></div></div>').appendTo("body");
		$("#"+pop).css({"left": left, "top": top}).show();

		$.ajax({
			url: masterDomain+"/include/ajax.php?service=member&action=withdraw_card&type="+type,
			dataType: "jsonp",
			success: function (data) {
				if(data && data.state == 100){
					historyPopup(data.info, type);
				}else{
					$("#"+pop).find(".history-main").html('<div class="empty">您还没有提现记录。</div>');
				}
			}
		});
	}


	//银行卡历史记录
	$(".historyBank").bind("click", function(){
		var t = $(this);
		showHistory(t, "");
		return false;
	});


	//支付宝历史记录
	$(".historyAlipay").bind("click", function(){
		var t = $(this);
		showHistory(t, "alipay");
		return false;
	});


	//删除记录
	$("body").delegate("#showHistoryExtend a em", "click", function(){
		var t = $(this).parent(), li = t.parent(), ul = li.parent(), id = t.data("id");
		li.slideUp(300, function(){
			li.remove();

			if(ul.find("li").length == 0){
				obj = $("#showHistoryExtend .history-main").html('<div class="empty">您还没有提现记录。</div>');
			}
		});
		$.ajax({
			url: masterDomain+"/include/ajax.php?service=member&action=withdraw_card_del",
			type: "POST",
			data: "id="+id,
			dataType: "jsonp"
		});
		return false;
	});

	//选择历史记录
	$("body").delegate("#showHistoryExtend a", "click", function(){
		var t = $(this), bank = t.data("bank"), cardnum = t.data("cardnum"), cardname = t.data("cardname");
		if(bank != "alipay"){
			$("#bank").val(bank);
			$("#cardnum").val(cardnum);
			$("#cardname").val(cardname);
		}else{
			$("#alipaynum").val(cardnum);
			$("#alipayname").val(cardname);
		}

		$("#bank").removeClass("error").siblings(".tip-inline").removeClass("error").addClass("ok");
		$("#cardnum").removeClass("error").siblings(".tip-inline").removeClass("error").addClass("ok");
		$("#cardname").removeClass("error").siblings(".tip-inline").removeClass("error").addClass("ok");
		$("#alipaynum").removeClass("error").siblings(".tip-inline").removeClass("error").addClass("ok");
		$("#alipayname").removeClass("error").siblings(".tip-inline").removeClass("error").addClass("ok");
	});

	$(document).click(function (e) {
		$("#showHistoryExtend").hide();
	});


	//提交申请
	$("#tj").bind("click", function(event){
		var t = $(this), data = [];

		var type = Number($("input[name=type]:checked").val()),
				amount = $("#amount").val();

		//银行卡
		if(type == 1){
			var bank = $.trim($("#bank").val()),
					cardnum = $.trim($("#cardnum").val()).replace(/\s/g, ""),
					cardname = $.trim($("#cardname").val());

			if(bank == ""){
				inpErr("bank");
				return false;
			}

			if(cardnum == ""){
				inpErr("cardnum");
				return false;
			}

			if(cardname == ""){
				inpErr("cardname");
				return false;
			}

			data.push("bank="+bank);
			data.push("cardnum="+cardnum);
			data.push("cardname="+cardname);
		
		//支付宝
		}else if(type == 2){
			var alipaynum = $("#alipaynum").val(),
					alipayname = $("#alipayname").val();

			if(alipaynum == ""){
				inpErr("alipaynum");
				return false;
			}

			if(alipayname == ""){
				inpErr("alipayname");
				return false;
			}

			data.push("bank=alipay");
			data.push("cardnum="+alipaynum);
			data.push("cardname="+alipayname);

		}

		if(!re.test(amount)){
			inpErr("amount", "金额必须为整数或小数，小数点后不超过2位。");
			return false;
		}

		if(amount > money){
			inpErr("amount", "您最多可提现 &yen;"+money);
			return false;
		}

		data.push("amount="+amount);

		if(!$("#agree").is(":checked")){
			alert("您必须同意并接受《火鸟软件提现服务协议》");
			return false;
		}

		t.attr("disabled", true).val("提交中...");


		$.ajax({
			url: masterDomain+"/include/ajax.php?service=member&action=withdraw",
			type: "POST",
			data: data.join("&"),
			dataType: "jsonp",
			success: function (data) {
				if(data && data.state == 100){
					var url = withdrawLog.replace("%id%", data.info);
					location.href = url;
				}else{
					alert(data.info);
					t.attr("disabled", false).val("申请提现");
				}
			},
			error: function(){
				alert("网络错误，请稍候重试！");
				t.attr("disabled", false).val("申请提现");
			}
		});
		

	});

});