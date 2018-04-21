$(function(){


	//数量错误提示
	var errmsgtime;
	function errmsg(div,type,num){
		$('#errmsg').remove();
		clearTimeout(errmsgtime);
		var str = type=='max' ? '最多只能购买' + num + '件' : '最少购买1件';
		var obj = div.find('.t5 div');
		var top = obj.offset().top - 36;
		var left = obj.offset().left - 20;

		var msgbox = '<div id="errmsg" style="position:absolute;top:' + top + 'px;left:' + left + 'px;width:150px;height:36px;line-height:36px;text-align:center;color:#f76120;font-size:14px;display:none;">' + str + '</div>';
		$('body').append(msgbox);
		$('#errmsg').fadeIn();
		errmsgtime = setTimeout(function(){
			$('#errmsg').remove();
		},1500);
	};


	//数量增加、减少
	$(".have").delegate(".t5 a", "click", function(){
		var t = $(this).closest("ul"), type = $(this).attr("class"), inp = t.find("input"), val = Number(inp.val());

		//减少
		if(type == "minus"){
			inp.val(val-1);
			checkCount(t);

		//增加
		}else if(type == "plus"){
			inp.val(val+1);
			checkCount(t, 1);
		}
	});


	//数量输入变化
	$(".have").delegate(".t5 input", "keyup", function(){
		checkCount($(this).closest("ul"));
	});


	//验证数量
	function checkCount(obj, t){
		var count = obj.find("input"), val = Number(count.val());

		var id = obj.data("id"),
				price = Number(obj.data("price")),
				inventory = Number(obj.data("inventory")),
				logistic = Number(obj.data("logistic"));

		//最小
		if(val < 1){
			count.val(1);
			val = 1;
			errmsg(obj,'min', 1, count);


		//超出库存
		}else if((val >= inventory && !t) || (val > inventory && t)){

			count.val(inventory);
			val = inventory;
			errmsg(obj,'max', inventory, count);

		}else{
			$('#errmsg').remove();
		}

		//同步更新购物车数量
		cartlist.find("li[data-id="+id+"]").attr("data-count", val);
		buildInit.update();

		//计算价格
		obj.find(".t6 em").html((price * val + logistic).toFixed(2));

		getTotalPrice();
	}


	//计算总价
	function getTotalPrice(){
		var totalPrice = totalCount = 0;

		$(".goods ul").each(function(){
			var t = $(this);
			if(!t.hasClass("title") && t.find(".t0 i").hasClass("on")){
				var count = t.find(".t5 input"),
						val = Number(count.val()),
						id = t.data("id"),
						price = Number(t.data("price")),
						inventory = Number(t.data("inventory")),
						logistic = Number(t.data("logistic"));

				totalCount += val;
				totalPrice += price * val + logistic;
			}
		});

		$(".sum .right em").html(totalCount);
		$(".sum .right font").html((echoCurrency('symbol'))+totalPrice.toFixed(2));

		if(totalCount > 0){
			$("#js").removeClass("disabled");
		}else{
			$("#js").addClass("disabled");
		}
	}


	//单个商品删除
	var ds = 1;
	$(".goods li.t7 a").on("click",function(){
		var $delete=$(this),allMoney;

		var confir = ds ? confirm("确定要删除吗？") : 1;
		if(confir){

			if($delete.closest(".sj").find("ul").length == 1){
				$delete.closest(".sj").remove();
			}

			//删除相应的商品
			var id=$delete.parents("ul").attr("data-id");
			var spe=$delete.parents("ul").attr("data-specation");
			cartlist.find("li[data-id="+id+"]").remove();
			buildInit.update();

			$delete.parents("ul").remove();

			var num=$(".sj").find("ul").length;
			if(num == 0){
				$(".null").show();
				$(".have").remove();
			}

			getTotalPrice();

		}
	});


	//删除
	$(".deleteSel").bind("click", function(){
		var checkCount = 0;
		$(".goods ul").each(function(){
			if($(this).find(".t0 i").hasClass("on")){
				checkCount++;
			}
		});
		if(checkCount == 0) return false;
		if(confirm("确定要删除吗？")){
			ds = 0;
			$(".goods ul").each(function(){
				if($(this).find(".t0 i").hasClass("on")){
					$(this).find(".t7 a").click();
				}
			});
			ds = 1;
		};
	});


	//全选
	$(".goods ul.title i").on("click",function(){
		var $allSel=$(this),$allSelD=$(".sum i"),$sjSel=$(".sj i");
		$allSel.hasClass("on") ? ($allSel.removeClass("on"), $allSelD.removeClass("on"), $sjSel.removeClass("on")) : ($allSel.addClass("on"), $allSelD.addClass("on"), $sjSel.addClass("on"));
		getTotalPrice();
	});

	$(".sum i").on("click",function(){
		var $allSel=$(this),$allSelD=$(".goods ul.title i"),$sjSel=$(".sj i");
		$allSel.hasClass("on") ? ($allSel.removeClass("on"), $allSelD.removeClass("on"), $sjSel.removeClass("on")) : ($allSel.addClass("on"), $allSelD.addClass("on"), $sjSel.addClass("on"));
		getTotalPrice();
	});

	//店铺选择
	$(".name i").on("click",function(){
		var $nameSel=$(this);
		$nameSel.hasClass("on") ? ($nameSel.removeClass("on"), $nameSel.parents(".name").siblings("ul").find("i").removeClass("on")) : ($nameSel.addClass("on"), $nameSel.parents(".name").siblings("ul").find("i").addClass("on"));

		//全选
		var n=$(".sj").length;
		if($(".sj .name i[class='on']").length==n){
			$(".goods ul.title i,.sum i").addClass("on");
		}else{
			$(".goods ul.title i,.sum i").removeClass("on");
		}

		getTotalPrice();

	});

	//单个选择
	$(".sj ul i").on("click",function(){
		var $singleSel=$(this),$t=$singleSel.parents("ul").siblings(".name").find("i");

		$singleSel.hasClass("on") ? $singleSel.removeClass("on") : $singleSel.addClass("on");

		//店铺
		var m=$singleSel.parents(".sj").find("ul").length;
		if($singleSel.parents(".sj").find("ul i[class='on']").length==m){
			$t.addClass("on");
		}else{
			$t.removeClass("on");
		}

		//全选
		var n=$(".sj").length;
		if($(".sj .name i[class='on']").length==n){
			$(".goods ul.title i,.sum i").addClass("on");
		}else{
			$(".goods ul.title i,.sum i").removeClass("on");
		}

		getTotalPrice();
	});



	//结算
	$("#js").bind("click", function(){
		var t = $(this);
		if(!t.hasClass("disabled")){

			//验证登录
			var userid = $.cookie(cookiePre+"login_user");
			if(userid == null || userid == ""){
				huoniao.login();
				return false;
			}

			//提交
			var data = [], pros = [], fm = t.closest("form"), url = fm.data("action"), action = fm.attr("action");
			$(".sj ul").each(function(){
				var t = $(this), id = t.data("id"), count = t.find(".t5 input").val();
				if(t.find(".t0 i").hasClass("on")){
					data.push('pros[]='+id+","+count);
					pros.push('<input type="hidden" name="pros[]" value="'+id+","+count+'" />');
				}
			});

			t.addClass("disabled").html("提交中...");

			$.ajax({
				url: url,
				data: data.join("&"),
				type: "POST",
				dataType: "jsonp",
				success: function (data) {
					if(data && data.state == 100){

						fm.append(pros.join(""));
						fm.submit();

					}else{
						alert(data.info);
						t.removeClass("disabled").html("去结算");
					}
				},
				error: function(){
					alert("网络错误，请重试！");
					t.removeClass("disabled").html("去结算");
				}
			});

		}
	});

});
