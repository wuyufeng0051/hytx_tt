$(function(){

	$("img").scrollLoading();




	//数量增加、减少
	var timout = null;
	$(".counter button").bind("click", function(){
		var type = $(this).attr("class"), inp = $("#count"), val = Number(inp.val()), tips = $(".counter .tips");

		//减少
		if(type == "minus"){
			if(val <= 1){
				tips.html("最少 1 件起售").show();
				setTimeout(function(){
					tips.fadeOut(300, function(){
						tips.html("");
					});
				}, 5000);
				return false;
			}
			inp.val(val-1);


		//增加
		}else if(type == "add"){
			if(val > maxCount){
				tips.html("每人最多只能购买 "+maxCount+" 单").show();
				timout != null ? clearTimeout(timout) : "";
				timout = setTimeout(function(){
					tips.fadeOut(300, function(){
						tips.html("");
					});
				}, 5000);
				return false;
			}
			inp.val(val+1);

		}
	});

	$("#count").bind("input", function(){
		checkCount();
	});


	//验证数量
	function checkCount(){
		var count = $("#count"), val = Number(count.val()), tips = $(".counter .tips");

		//最小
		if(val < 1){
			tips.html("最少 1 件起售").show();
			timout != null ? clearTimeout(timout) : "";
			timout = setTimeout(function(){
				tips.fadeOut(300, function(){
					tips.html("");
				});
			}, 5000);
			return false;

		//最大
		}else if(val > maxCount){
			tips.html("每人最多只能购买 "+maxCount+" 单").show();
			timout != null ? clearTimeout(timout) : "";
			timout = setTimeout(function(){
				tips.fadeOut(300, function(){
					tips.html("");
				});
			}, 5000);
			return false;

		}else{
			return true;
		}
	}

	//立即抢购
	$(".link-buy").bind("click", function(event){
		if($(this).hasClass("disabled")) return false;
		if(!checkCount()){
			event.preventDefault();
			return false;
		}
		var url = $(this).data("url");
		if(url && url != undefined){
			url = url.replace("%count%", $("#count").val());
			location.href = url;
		}
	});

	//加入购物车
	$(".gou_2 span").bind("click", function(event){
		if($(this).hasClass("disabled")) return false;
		if(!checkCount()){
			event.preventDefault();
			return false;
		}
		var t = $(this).offset(),
				scH = $(window).scrollTop(),
				offset = $('#glocart .cartpop b').offset(),
				flyer = $('<img class="cartflyer" src="'+detailThumb+'" />'),
				start = $('.avatar').offset();
		flyer.fly({
			start: {
				left: start.left + 70,
				top: start.top
			},
			end: {
				left: offset.left,
				top: offset.top - scH,
				width: 20,
				height: 20
			},
			onEnd: function(){

				var $i = $("<b class='flyend'>").text("1");
				var x = offset.left, y = offset.top;
				$i.css({top: y - 10, left: x});

				setTimeout(function(){
					$("body").append($i);
					$i.animate({top: y - 50, opacity: 0}, 1500, function(){
						$i.remove();
					});
				}, 300);

				this.destroy();

				//操作购物车
				var data = [];
				data.id = detailID;
				data.title = detailTitle;
				data.thumb = detailThumb;
				data.price = detailPrice;
				data.count = 1;
				data.url   = detailUrl;
				tuanInit.add(data);
			}
		});
		return false;
	});

	//收藏
	$(".favorite").bind("click", function(){
		var t = $(this), type = "add", oper = "+1", txt = "已收藏";

		var userid = $.cookie(cookiePre+"login_user");
		if(userid == null || userid == ""){
			huoniao.login();
			return false;
		}

		if(!t.hasClass("curr")){
			t.addClass("curr");
		}else{
			type = "del";
			t.removeClass("curr");
			oper = "-1";
			txt = "收藏";
		}

		var $i = $("<b>").text(oper);
		var x = t.offset().left, y = t.offset().top;
		$i.css({top: y - 10, left: x + 17, position: "absolute", "z-index": "10000", color: "#E94F06"});
		$("body").append($i);
		$i.animate({top: y - 50, opacity: 0, "font-size": "2em"}, 2000, function(){
			$i.remove();
		});

		t.html("<s></s>"+txt);

		$.post("/include/ajax.php?service=member&action=collect&module=tuan&temp=detail&type="+type+"&id="+detailID);

	});



});



