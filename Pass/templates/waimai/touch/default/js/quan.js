$(function(){

	//加载购物车内容
	var cartHistory = utils.getStorage("wm_cart_"+shopid), food = '[';
	if(cartHistory){

		order_content = cartHistory;

		var list = [];
		for(var i = 0; i < cartHistory.length; i++){

			var price_price = cartHistory[i].price + cartHistory[i].nprice;
			food = food + '{"id": "'+cartHistory[i].id+'", "price": '+price_price * cartHistory[i].count + '},';

		}


		food = food.substr(0, food.length-1);
	}

	food = food + ']';

	function getList(){
		var data = [];
		data.push('shop='+shopid);
		data.push('food='+food);
		$.ajax({
			url: '/include/ajax.php?service=waimai&action=quanList',
			type: 'post',
			data : data.join("&"),
			dataType: 'json',
			success: function(data){
				if(data && data.state == 100){
					var list = data.info.list, len = list.length, html = [];
					for(var i = 0; i < len; i++){
						var obj = list[i], item = [];
						var shopList = obj.shopList, foodList = obj.foodList;

						var limit = [];

						if(shopList.length > 0){
							if(shopList.length > 3){
								limit.push(langData['waimai'][2][110].replace('1', shopList[0]).replace('2', shopList.length));
							}else{
								limit.push(langData['waimai'][2][111].replace('1', shopList.join("、")));
							}
						}
						if(foodList.length > 0){
							if(foodList.length > 3){
								limit.push(langData['waimai'][2][112].replace('1', foodList[0]).replace('2', foodList.length));
							}else{
								limit.push(langData['waimai'][2][111].replace('1', foodList.join("、")));
							}
						}

						limit.push(langData['waimai'][2][111].replace('1', obj.username));

						item.push('<div class="item mgb'+( obj.fail == 1 ? ' disabled' : '')+'">');
						item.push('	<a href="'+( obj.fail == 1 ? 'javascript:;' : cartUrl.replace('#quan', obj.id) )+'" class="fn-clear">');
						item.push('		<div class="fn-left countNum"><p class="mianzhi txt-red">' + echoCurrency("symbol") + '<font>'+obj.money+'</font></p><p>'+langData['waimai'][2][114].replace('1', obj.basic_price)+'</p></div>');
						item.push('		<div class="fn-left txt-info"><p class="infoTit">'+obj.name+'</p><p class="time fz22">'+obj.deadline+langData['waimai'][2][115]+'</p><p class="fz22">'+limit.join("。")+'</p></div>');

						item.push('	</a>');

						if(obj.fail == 1){
							item.push('	<div class="becourse">');
							item.push('		<div class="con">');
							item.push('			<div class="tit">'+langData['waimai'][2][116]+'<span></span></div>');
							item.push('			<div class="detail">'+obj.failnote+'</div>');
							item.push('		</div>');
							item.push('	</div>');
						}
						item.push('</div>');

						html.push(item.join(""));

					}
					$("#list").html(html.join(""));

				}else{
					$(".loading").text(langData['waimai'][2][117]);
				}
			}
		})
	}
	getList();

	$("#list").delegate(".becourse .con", "click", function(){
		$(this).toggleClass("open");
	})

	$("#list").delegate(".disabled a", "click", function(){
		alert(langData['waimai'][2][118]);
	})
})
