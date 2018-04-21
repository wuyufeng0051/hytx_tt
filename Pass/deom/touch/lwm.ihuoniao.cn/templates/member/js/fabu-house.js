var unitPrice = 0, zxtxt = "", istit = false;
if(id != 0) istit = true;

$(function(){

	var init = {
		//树形递归分类
		treeTypeList: function(data){
			var typeList = [], cl = "";
			for(var i = 0; i < data.length; i++){
				(function(){
					var jsonArray =arguments[0], jArray = jsonArray.lower;
					typeList.push('<a href="javascript:;" data="'+jsonArray["id"]+'">'+cl+"|--"+jsonArray["typename"]+'</a>');
					if(jArray != undefined){
						for(var k = 0; k < jArray.length; k++){
							cl += '    ';
							if(jArray[k]['lower'] != ""){
								arguments.callee(jArray[k]);
							}else{
								typeList.push('<a href="javascript:;" data="'+jArray[k]["id"]+'">'+cl+"|--"+jArray[k]["typename"]+'</a>');
							}
							if(jsonArray["lower"] == null){
								cl = "";
							}else{
								cl = cl.replace("    ", "");
							}
						}
					}
				})(data[i]);
			}
			return typeList.join("");
		}
	}

	//选择区域
	$("#selAddr").delegate("a", "click", function(){
		if($(this).text() != "不限" && $(this).attr("data-id") != $("#addrid").val()){
			var id = $(this).attr("data-id");
			$(this).closest(".sel-group").nextAll(".sel-group").remove();
			getChildAddr(id);
		}
	});

	//获取子级区域
	function getChildAddr(id){
		if(!id) return;
		$.ajax({
			url: "/include/ajax.php?service=house&action=addr&type="+id,
			type: "GET",
			dataType: "jsonp",
			success: function (data) {
				if(data && data.state == 100){
					var list = data.info, html = [];

					html.push('<div class="sel-group">');
					html.push('<button class="sel" type="button">不限<span class="caret"></span></button>');
					html.push('<ul class="sel-menu">');
					html.push('<li><a href="javascript:;" data-id="'+id+'">不限</a></li>');
					for(var i = 0; i < list.length; i++){
						html.push('<li><a href="javascript:;" data-id="'+list[i].id+'">'+list[i].typename+'</a></li>');
					}
					html.push('</ul>');
					html.push('</div>');

					$("#addrid").before(html.join(""));

				}
			}
		});
	}

	//小区模糊搜索
	if($('#community').size() > 0){
		$('#community').autocomplete({
			serviceUrl: '/include/ajax.php?service=house&action=communityList',
			paramName: 'keywords',
			dataType: 'jsonp',
			transformResult: function(data){
				var arr = [], dataArr = [];
				arr['suggestions'] = [];
				if(data && data.state == 100){
					var list = data.info.list;
					for(var i = 0; i < list.length; i++){
						dataArr[i] = [];
						dataArr[i]['id']      = list[i].id;
						dataArr[i]['title']   = list[i].title;
						dataArr[i]['address'] = list[i].address;
						dataArr[i]['price']   = list[i].price;
					}
				}

				arr['suggestions'] = $.map(dataArr, function (value, key) {
					return { value: value.title, data: value.id, address: value.address, price: value.price };
				})
				return arr;
			},
			onSelect: function(suggestion) {
				$('#communityid').val(suggestion.data);
				$("#communityAddr").html(suggestion.address + "&nbsp;&nbsp;单价："+suggestion.price+"元/㎡");
				unitPrice = suggestion.price;
				$(".community-addr").hide();
				autoTitle();
			},
			lookupFilter: function(suggestion, originalQuery, queryLowerCase) {
				var re = new RegExp('\\b' + $.Autocomplete.utils.escapeRegExChars(queryLowerCase), 'gi');
				return re.test(suggestion.value);
			}
		});
	}

	$('#community').bind("input", function(){
		$('#communityid').val(0);
		$("#selAddr button").html("请选择<span class='caret'></span>");
		$("#communityAddr").html("");
		$("#address").val("");
		$(".community-addr").hide();
		unitPrice = 0;
	})

	$("#community").bind("blur", function(){
		autoTitle();
		if(($("#communityid").val() == 0 || $("#communityid").val() =="") && $.trim($("#community").val()) != ""){
			$(".community-addr").show();
		}else{
			$(".community-addr").hide();
		}
	});

	//选择小区
	$("#chooseCommunity").bind("click", function(){
		var t = $(this);
		t.addClass("loading");

		$.ajax({
			url: "/include/ajax.php?service=house&action=addr&son=1",
			type: "GET",
			dataType: "jsonp",
			success: function (data) {
				t.removeClass("loading");
				if(data && data.state == 100){

					var content = [];

					//选地区
					content.push('<div class="choose-item" id="selectAddr"><h2>选择区域：</h2><div class="choose-container fn-clear">');
					content.push('<div class="pinp_main"><div class="pinp_main_zm">'+init.treeTypeList(data.info)+'</div></div>');
					content.push('</div></div>');

					//选小区
					content.push('<div class="choose-item" id="selectCommunity" style="width:230px;"><h2>选择小区：<span id="tCount"></span></h2><div class="choose-container fn-clear">');
					content.push('<div class="pinp_main"><div class="pinp_main_zm"><center style="line-height:335px;">没有相关小区！</center></div></div>');
					content.push('</div></div>');

					$.dialog({
						id: "chooseData",
						fixed: false,
						title: "选择小区",
						content: '<div class="chooseData fn-clear">'+content.join("")+'</div>',
						width: 590,
						okVal: "确定",
						ok: function(){

							//确定选择结果
							var obj = parent.$("#selectCommunity .cur"),
								id = obj.attr("data-id"),
								title = obj.attr("data-title"),
								address = obj.attr("data-address"),
								price = obj.attr("data-price");
							if(id != undefined && title != undefined){
								unitPrice = price;
								$("#community").val(title);
								$("#communityid").val(id);
								$("#communityAddr").html(address + "&nbsp;&nbsp;单价："+price+"元/㎡");

								$("#selAddr button").html("请选择<span class='caret'></span>");
								// $("#address").val(address);
								$(".community-addr").hide();

								$("#community").parent().find(".tip-inline").removeClass().addClass("tip-inline success")
								autoTitle();
							}else{
								alert("请先选择小区！");
								return false;
							}

						},
						cancelVal: "关闭",
						cancel: true
					});

					//选择地区
					parent.$("#selectAddr a").bind("click", function(){
						parent.$("#selectAddr a").removeClass("cur");
						$(this).addClass("cur");
						getCommunity();
					});

					//获取小区
					function getCommunity(){
						var addr = parent.$("#selectAddr .cur").attr("data");

						addr = addr != undefined ? addr : 0;

						parent.$("#selectCommunity .pinp_main_zm").html('<center style="line-height:335px;">搜索中...</center>');


						$.ajax({
							url: "/include/ajax.php?service=house&action=communityList&addrid="+addr,
							type: "GET",
							dataType: "jsonp",
							success: function (data) {
								if(data && data.state == 100){
									var list = data.info.list, community = [];
									for (var i = 0; i < list.length; i++) {
										community.push('<a href="javascript:;" data-id="'+list[i].id+'" data-title="'+list[i].title+'" data-address="'+list[i].address+'" data-price="'+list[i].price+'" title="'+list[i].title+'"> '+(i+1)+'. '+list[i].title+'</a>');
									};
									parent.$("#selectCommunity .pinp_main_zm").html(community.join(""));
									parent.$("#tCount").html("<small>"+list.length+"个</small>");
								}else{
									parent.$("#selectCommunity .pinp_main_zm").html('<center style="line-height:335px;">没有相关小区！</center>');
									parent.$("#tCount").html("");
								}
							}
						});

					}

					//选择小区
					parent.$("#selectCommunity").delegate("a", "click", function(){
						parent.$("#selectCommunity a").removeClass("cur");
			        	$(this).addClass("cur");
					});

				}
			}
		});
	});

	//楼盘模糊搜索
	if($('#loupan').size() > 0){
		$('#loupan').autocomplete({
			serviceUrl: '/include/ajax.php?service=house&action=autoCompleteLoupan&type='+type,
			paramName: 'title',
			dataType: 'jsonp',
			transformResult: function(data){
				var arr = [], dataArr = [];
				arr['suggestions'] = [];
				if(data && data.state == 100){
					var list = data.info;
					for(var i = 0; i < list.length; i++){
						dataArr[i] = [];
						dataArr[i]['loupan']   = list[i].loupan;
						dataArr[i]['address']  = list[i].address;
						dataArr[i]['addrid']   = list[i].addrid;
						dataArr[i]['addrName'] = list[i].addrName;
					}
				}

				arr['suggestions'] = $.map(dataArr, function (value, key) {
					return { value: value.loupan, address: value.address, addrid: value.addrid, addrName: value.addrName };
				})
				return arr;
			},
			onSelect: function(suggestion) {
				$('#addrid').val(suggestion.addrid);
				$("#address").val(suggestion.address);
				$("#selAddr button").html(suggestion.addrName + '<span class="caret"></span>');
				autoTitle();
			},
			lookupFilter: function(suggestion, originalQuery, queryLowerCase) {
				var re = new RegExp('\\b' + $.Autocomplete.utils.escapeRegExChars(queryLowerCase), 'gi');
				return re.test(suggestion.value);
			}
		});
	}

	$("#loupan").bind("blur", function(){
		autoTitle();
	});

	//选择楼盘
	$("#chooseLoupan").bind("click", function(){
		var t = $(this);
		t.addClass("loading");

		$.ajax({
			url: "/include/ajax.php?service=house&action=addr&son=1",
			type: "GET",
			dataType: "jsonp",
			success: function (data) {
				t.removeClass("loading");
				if(data && data.state == 100){

					var content = [];

					//选地区
					content.push('<div class="choose-item" id="selectAddr"><h2>选择区域：</h2><div class="choose-container fn-clear">');
					content.push('<div class="pinp_main"><div class="pinp_main_zm">'+init.treeTypeList(data.info)+'</div></div>');
					content.push('</div></div>');

					//选楼盘
					content.push('<div class="choose-item" id="selectLoupan" style="width:230px;"><h2>选择楼盘：<span id="tCount"></span></h2><div class="choose-container fn-clear">');
					content.push('<div class="pinp_main"><div class="pinp_main_zm"><center style="line-height:335px;">没有相关楼盘！</center></div></div>');
					content.push('</div></div>');

					$.dialog({
						id: "chooseData",
						fixed: false,
						title: "选择楼盘",
						content: '<div class="chooseData fn-clear">'+content.join("")+'</div>',
						width: 590,
						okVal: "确定",
						ok: function(){

							//确定选择结果
							var obj = parent.$("#selectLoupan .cur"),
								loupan = obj.attr("data-loupan"),
								address = obj.attr("data-address"),
								addrid = obj.attr("data-addrid"),
								addrName = obj.attr("data-addrName");
							if(loupan != undefined && address != undefined && addrid != undefined && addrName != undefined){
								$("#loupan").val(loupan);
								$("#addrid").val(addrid);
								$("#address").val(address);
								$("#selAddr button").html(addrName+"<span class='caret'></span>");
								$("#loupan").parent().find(".tip-inline").removeClass().addClass("tip-inline success")
								$("#address").siblings(".tip-inline").removeClass().addClass("tip-inline success");
								autoTitle();
							}else{
								alert("请先选择楼盘！");
								return false;
							}

						},
						cancelVal: "关闭",
						cancel: true
					});

					//选择地区
					parent.$("#selectAddr a").bind("click", function(){
						parent.$("#selectAddr a").removeClass("cur");
						$(this).addClass("cur");
						getLoupan();
					});

					//获取楼盘
					function getLoupan(){
						var addr = parent.$("#selectAddr .cur").attr("data");

						addr = addr != undefined ? addr : 0;

						parent.$("#selectLoupan .pinp_main_zm").html('<center style="line-height:335px;">搜索中...</center>');


						$.ajax({
							url: "/include/ajax.php?service=house&action=autoCompleteLoupan&addrid="+addr+"&type="+type,
							type: "GET",
							dataType: "jsonp",
							success: function (data) {
								if(data && data.state == 100){
									var list = data.info, community = [];
									for (var i = 0; i < list.length; i++) {
										community.push('<a href="javascript:;" data-loupan="'+list[i].loupan+'" data-address="'+list[i].address+'" data-addrid="'+list[i].addrid+'" data-addrName="'+list[i].addrName+'" title="'+list[i].loupan+'"> '+(i+1)+'. '+list[i].loupan+'</a>');
									};
									parent.$("#selectLoupan .pinp_main_zm").html(community.join(""));
									parent.$("#tCount").html("<small>"+list.length+"个</small>");
								}else{
									parent.$("#selectLoupan .pinp_main_zm").html('<center style="line-height:335px;">没有相关楼盘！</center>');
									parent.$("#tCount").html("");
								}
							}
						});

					}

					//选择楼盘
					parent.$("#selectLoupan").delegate("a", "click", function(){
						parent.$("#selectLoupan a").removeClass("cur");
			        $(this).addClass("cur");
					});

				}
			}
		});
	});

	//修改页面下拉菜单赋值
	if(id != 0){
		$(".selectGroup select").each(function(){
			var val = $(this).attr("data-val");
			$(this).find("option").each(function(){
				if($(this).val() == val){
					$(this).attr("selected", true);
				}
			});
		});
	}

	//自动获取交易地点
	if($("#getlnglat").size() > 0){
		var coords = $().coords();
		var transform = function(e, t) {
			coords.transform(e,	function(e, n) {
				n != null ? $("#address").val(n.street + n.streetNumber) : $.dialog.alert(e.message);
				$("#address").siblings(".tip-inline").removeClass().addClass("tip-inline success");
				var dist = n.district;
				$("#selAddr .sel-group:eq(0) li").each(function(){
					var t = $(this).find("a"), v = t.text(), i = t.attr("data-id");
					if(v.indexOf(dist) > -1){
						$("#addr").val(i);
						$("#selAddr .sel-group:eq(0)").find("button").html(v+'<span class="caret"></span>');
						$("#selAddr .sel-group:eq(0)").siblings(".sel-group").remove();
						getChildAddr(i);
					}
				});
				t.hide();
			}, true);
		};
		$("#getlnglat").bind("click", function() {
			var e = $(this);
			coords.get(function(t, n) {
				transform(n, e);
			}),
			$(this).unbind("click").html("<s></s>获取中...");
		});
	}

	var address = $("#address").val();
	if(address != ""){
		setTimeout(function(){
			$("#address").val(address);
		}, 5);
	}

});
