$(function() {

	var SKUResult = {};  //保存组合结果
	var mpriceArr = [];  //市场价格集合
	var priceArr = [];   //现价集合
	var totalStock = 0;  //总库存
	var skuObj = $("#skuObj"), priceObj = $("#price"), stockObj = $("#stock"), disabled = "disabled", selected = "active";


	//点击事件
	$('.sku').each(function() {
			var self = $(this);
			var attr_id = self.attr('attr_id');
			if(!SKUResult[attr_id]) {
				self.addClass(disabled);
			}
		}).click(function() {

			var self = $(this);


			if(self.hasClass(disabled)) return;

			//选中自己，兄弟节点取消选中
			self.toggleClass(selected).siblings().removeClass(selected);
			var spValue=parseInt($("#stock").text()),
			inputValue=parseInt($(".count").html());
			var n=$(".sys_item_specpara").length;

			if($(".color-info-ul").find("li."+selected).length==n && inputValue<spValue){
				skuObj.removeClass("on");
			}

			//已经选择的节点
			var selectedObjs = $('#skuObj .'+selected);

			if(selectedObjs.length) {
				//获得组合key价格
				var selectedIds = [];
				selectedObjs.each(function() {
					selectedIds.push($(this).attr('attr_id'));
				});
				selectedIds.sort(function(value1, value2) {
					return parseInt(value1) - parseInt(value2);
				});
				var len = selectedIds.length;

				var prices = SKUResult[selectedIds.join(';')].prices;
				var maxPrice = Math.max.apply(Math, prices);
				var minPrice = Math.min.apply(Math, prices);
				priceObj.html((maxPrice > minPrice ? minPrice.toFixed(2) + "-" + maxPrice.toFixed(2) : maxPrice.toFixed(2)));


				var mprices = SKUResult[selectedIds.join(';')].mprices;
				var maxPrice = Math.max.apply(Math, mprices);
				var minPrice = Math.min.apply(Math, mprices);


				stockObj.text(SKUResult[selectedIds.join(';')].stock);

				//获取input的值
				var inputValue=parseInt($(".count").val());
				// var inputTip=$(".singleGoods dd cite");

				if(inputValue>SKUResult[selectedIds.join(';')].stock){
					alert('库存不足')
				}else{
				}


				//用已选中的节点验证待测试节点 underTestObjs
				$(".sku").not(selectedObjs).not(self).each(function() {
					var siblingsSelectedObj = $(this).siblings('.'+selected);
					var testAttrIds = [];//从选中节点中去掉选中的兄弟节点
					if(siblingsSelectedObj.length) {
						var siblingsSelectedObjId = siblingsSelectedObj.attr('attr_id');
						for(var i = 0; i < len; i++) {
							(selectedIds[i] != siblingsSelectedObjId) && testAttrIds.push(selectedIds[i]);
						}
					} else {
						testAttrIds = selectedIds.concat();
					}
					testAttrIds = testAttrIds.concat($(this).attr('attr_id'));
					testAttrIds.sort(function(value1, value2) {
						return parseInt(value1) - parseInt(value2);
					});
					if(!SKUResult[testAttrIds.join(';')]) {
						$(this).addClass(disabled).removeClass(selected);
					} else {
						$(this).removeClass(disabled);
					}
				});
			} else {

				// init.defautx();

			}
		});

	//商品详情页--数量的加减

	//加
	$('.add').on("click",function(){
		var stockx = parseInt($(".color-info-ul em i").text()),n=$(".sys_item_specpara").length;

		var $c=$(this),value;
		value=parseInt($c.siblings(".count").html());
		if(value<stockx){
			value=value+1;
			$c.siblings(".count").html(value);
			if(value>=stockx){
			}
			var spValue=parseInt($(".color-info-ul em i").text()),
			inputValue=parseInt($(".count").val());
			if($(".color-info-ul ul").find("li.active").length==n && inputValue<spValue){
				// $(".singleGoods dd.info ul").removeClass("on");
			}
		}else{
			alert('库存不足')
		}
	})

	//减
	$(".reduce").on("click",function(){
		var stockx = parseInt($(".color-info-ul em i").text()),n=$(".sys_item_specpara").length;
		var $c=$(this),value;
		value=parseInt($c.siblings(".count").html());
		if(value>1){
			value=value-1;
			$c.siblings(".count").html(value);
			if(value<=stockx){
			}
			var spValue=parseInt($(".color-info-ul em i").text()),
			inputValue=parseInt($(".count").val());
			if($(".color-info-ul ul").find("li.active").length==n && inputValue<=spValue){
			}
		}else{
			alert('最少一件起拍哦~')
		}
	})

	// 加入购物车 或 立即购买
	$('.buy-box-cart,.buy-box-once,.add-cart,.buy-cart').click(function(){
		var $btn=$(this),
			$li=$(".sys_item_specpara"),
			// $ul=$(".singleGoods dd.info ul"),
			n=$li.length;
		if($btn.hasClass("disabled")) return false;
		var isBtnCar = $btn.hasClass('buy-box-cart');
		var isBtnBuy = $btn.hasClass('buy-box-once');
		var isBtnCar2 = $btn.hasClass('add-cart');
		var isBtnBuy2 = $btn.hasClass('buy-cart');

		var len=$li.length;
		var spValue=parseInt($("#stock").text()),	// 库存
			inputValue=parseInt($(".color-info-account .count").text());	// 购买数量

		if($(".sys_item_specpara").find(".sku."+selected).length==n && inputValue<=spValue){
			skuObj.removeClass('on');
			// 规格窗口 加入购物车
			$('.color-box').hide();

			var t=''; //该商品的属性编码 以“-”链接个属性
			$(".sys_item_specpara li.active").each(function(){
				var y=$(this).attr("attr_id");
				t=t+"-"+y;
			})
			var t=t.substr(1);

			if(isBtnCar || isBtnCar2){
				var num = parseInt($('.buy-box-num').text());
				var $b = $('<b>+'+inputValue+'</b>');
				$('.buy-box-l .bn').append($b);
				$('.buy-box-num').text(inputValue+num);
				$b.animate({
					top:'-.4rem'
				},500,function(){
					setTimeout(function(){
						$b.remove();
					},300)
				})

				var num=parseInt($(".count").text());

				//操作购物车
				var data = [];
				data.id = detailID;
				data.specation = t;
				data.count = num;
				data.title = detailTitle;
				data.url = detailUrl;
				shopInit.add(data);

			}
			// 直接购买
			else{
				var userid = $.cookie(cookiePre+"login_user");
				if(userid == null || userid == ""){
					location.href = masterDomain + '/login.html';
					return false;
				}else{
					$("#pros").val(detailID+","+t+","+inputValue);
					$("#buyForm").submit();
				}
			}

		}else{
			if(isBtnCar || isBtnBuy){
				$('.main-select').click();
				if(isBtnCar){
					$('.color-footer-cart').removeClass('dn').siblings().addClass('dn');
				}else{
					$('.color-footer-once').removeClass('dn').siblings().addClass('dn');
				}
			}
			skuObj.addClass('on');
		}
	})


});
