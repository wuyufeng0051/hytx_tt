$(function(){
    location.hash = "";
    $(".header-l a").attr("href",""+masterDomain +"/b/tuan.html");
        var gzAddress         = $(".gz-address"),  //选择地址页
            gzAddrHeaderBtn   = $(".gz-addr-header-btn"),  //删除按钮
            gzAddrListObj     = $(".gz-addr-list"),  //地址列表
            gzAddNewObj       = $(".mask_box"),   //新增地址页
            gzSelAddr         = $("#gzSelAddr"),     //选择地区页
            gzSelMask         = $(".gz-sel-addr-mask"),  //选择地区遮罩层
            gzAddrSeladdr     = $(".addr"),  //选择所在地区按钮
            gzSelAddrCloseBtn = $("#gzSelAddrCloseBtn"),  //关闭选择所在地区按钮
            gzSelAddrList     = $(".gz-sel-addr-list"),  //区域列表
            gzSelAddrNav      = $(".gz-sel-addr-nav"),  //区域TAB
            gzSelAddrActive   = "gz-sel-addr-active",  //选择所在地区后页面下沉样式名
            gzSelAddrHide     = "gz-sel-addr-hide",  //选择所在地区浮动层隐藏样式名
            showErrTimer      = null,
            gzAddrEditId      = 0,   //修改地址ID
            businessbtn       = $(".BusinessInput"),   //选择商圈按钮
            businessbtnHide   = "QuanBox_hide",  //选择商圈隐藏样式名
            businessBox       = $(".QuanBox"),  //选择商圈层
            busBoxCloseBtn    = $(".QuanTitle_close"),  //关闭选择所在地区按钮
            busBoxSureBtn     = $(".Quan_SureBtn"),  //确定所在地区按钮
            Subwaybtn       = $(".SubweyIupt"),   //选择地铁按钮
            SubwayBox       = $(".SubwayBox "),  //选择地铁层
            SubwaybtnHide   = "Subway_hide",  //选择地铁隐藏样式名
            SubwayCloseBtn    = $(".Subway_close"),  //关闭选择地铁按钮
            SubwaySureBtn     = $(".Subway_SureBtn"),  //确定所在地区按钮
            lng               = "",
            lat               = "",

            gzAddrInit = {



                //错误提示
                showErr: function(txt){
                        showErrTimer && clearTimeout(showErrTimer);
                $(".gzAddrErr").remove();
                $("body").append('<div class="gzAddrErr"><p>'+txt+'</p></div>');
                $(".gzAddrErr p").css({"margin-left": -$(".gzAddrErr p").width()/2, "left": "50%"});
                $(".gzAddrErr").css({"visibility": "visible"});
                showErrTimer = setTimeout(function(){
                    $(".gzAddrErr").fadeOut(300, function(){
                        $(this).remove();
                    });
                }, 1500);
                }


                //获取区域
                ,getAddrArea: function(id){

                        //如果是一级区域
                        if(!id){
                                gzSelAddrNav.html('<li class="gz-curr"><span>'+langData['siteConfig'][7][2]+'</span></li>');
                                gzSelAddrList.html('');
                        }

                        var areaobj = "gzAddrArea"+id;
                        if($("#"+areaobj).length == 0){
                                gzSelAddrList.append('<ul id="'+areaobj+'"><li class="loading">'+langData['siteConfig'][20][184]+'...</li></ul>');
                        }

                        gzSelAddrList.find("ul").hide();
                        $("#"+areaobj).show();

                        $.ajax({
                                url: masterDomain + "/include/ajax.php?service=tuan&action=addr&store=1",
                                data: "type="+id,
                                type: "GET",
                                dataType: "jsonp",
                                success: function (data) {
                                        if(data && data.state == 100){
                                                var list = data.info, areaList = [];
                                                for (var i = 0, area, lower; i < list.length; i++) {
                                                        area = list[i];
                                                        lower = area.lower == undefined ? 0 : area.lower;
                                                        areaList.push('<li data-id="'+area.id+'" data-lower=""'+(!lower ? 'class="n"' : '')+'>'+area.typename+'</li>');
                                                }
                                                $("#"+areaobj).html(areaList.join(""));
                                        }else{
                                                $("#"+areaobj).html('<li class="loading">'+data.info+'</li>');
                                        }
                                },
                                error: function(){
                                        $("#"+areaobj).html('<li class="loading">'+langData['siteConfig'][20][184]+'</li>');
                                }
                        });


                }
                ,getSecondAddrArea: function(id){

                        //如果是一级区域
                        if(!id){
                                gzSelAddrNav.html('<li class="gz-curr"><span>'+langData['siteConfig'][7][2]+'</span></li>');
                                gzSelAddrList.html('');
                        }

                        var areaobj = "gzAddrArea"+id;
                        if($("#"+areaobj).length == 0){
                                gzSelAddrList.append('<ul id="'+areaobj+'"><li class="loading">'+langData['siteConfig'][20][184]+'...</li></ul>');
                        }

                        gzSelAddrList.find("ul").hide();
                        $("#"+areaobj).show();

                        $.ajax({
                                url: masterDomain + "/include/ajax.php?service=siteConfig&action=area&type="+id,
                                data: "type="+id,
                                type: "GET",
                                dataType: "jsonp",
                                success: function (data) {
                                        if(data && data.state == 100){
                                                var list = data.info, areaList = [];
                                                for (var i = 0, area, lower; i < list.length; i++) {
                                                        area = list[i];
                                                        lower = area.lower == undefined ? 0 : area.lower;
                                                        areaList.push('<li data-id="'+area.id+'" data-lower="1"'+(!lower ? 'class="n"' : '')+'>'+area.typename+'</li>');
                                                }
                                                $("#"+areaobj).html(areaList.join(""));
                                        }else{
                                                $("#"+areaobj).html('<li class="loading">'+data.info+'</li>');
                                        }
                                },
                                error: function(){
                                        $("#"+areaobj).html('<li class="loading">'+langData['siteConfig'][20][184]+'</li>');
                                }
                        });


                }

                //隐藏选择地区浮动层&遮罩层
                ,hideNewAddrMask: function(){
                        gzAddNewObj.removeClass(gzSelAddrActive);
                        gzSelMask.fadeOut();
                        gzSelAddr.addClass(gzSelAddrHide);
                }

                // 获取商圈信息
                ,QuanList :function(){
                    var id = $('.addr').attr("data-id");
                    if(!id) return;
                    $.ajax({
            			url: masterDomain+"/include/ajax.php?service=tuan&action=circle&type="+id,
            			type: "GET",
            			dataType: "jsonp",
            			success: function (data) {
            				if(data && data.state == 100){
            					var list = data.info, html = [];
            					for(var i = 0; i < list.length; i++){
                                	html.push('<li><label><em>'+list[i].name+'</em><div class="checkbox"><input type="checkbox" name="circle[]" data-name="'+list[i].name+'" value="'+list[i].id+'"><i class="checkBtn"></i></div></label></li>');
            					}
            					$(".QuanList ul").html(html.join(""));
            					$(".Business").show();

            				}else{
            					$(".QuanList ul").html("");
            					$(".Business").hide();
            				}
            			}
            		});
                }

                // 获取地铁信息
                ,SubwayList :function(id){
                    // var id = $(this).attr("data-id");
                    // if(!id) return;
                    $.ajax({
                        url: masterDomain+"/include/ajax.php?service=siteConfig&action=subway&city="+id,
                        type: "GET",
                        dataType: "jsonp",
                        success: function (data) {
                            $(".SubwayNav").html("");
                            $(".SubChoice_box").html("");
                            if(data && data.state == 100){
                                var list = data.info, html = [];
                                for(var i = 0; i < list.length; i++){
                                    $(".SubwayNav").append('<em>'+list[i].title+'</em>');
                                    getSubwayStation(list[i].id, i);
                                }
                                $(".subwey").show();
                                $(".SubwayNav em").eq(0).addClass('subBC');
                            }else{
                                $(".subwey").hide();
                            }
                        }
                    });
                }

    }
    if ($("#lnglat").val() != "") {
        var lnglat = $("#lnglat").val().split(",");
        lng = lnglat[0];
        lat = lnglat[1];
    }
    //获取地铁站点
    function getSubwayStation(cid, index){
        $.ajax({
            url: masterDomain+"/include/ajax.php?service=siteConfig&action=subwayStation&type="+cid,
            type: "GET",
            dataType: "jsonp",
            success: function (data) {
                if(data && data.state == 100){
                    var list = data.info, html = [],subway = [];
                    $('.SubChoice_box').append('<div class="SubChoice'+cid+' sub fn-clear"></div>')
                    for(var i = 0; i < list.length; i++){
                        html.push('<label><input type="checkbox" name="subway[]" data-name="'+list[i].title+'" value="'+list[i].id+'"><i class="SubCheckbtn"></i>'+list[i].title+'</label>');
                    }
                    $(".SubChoice"+cid+"").html(html.join(""));
                    $(".SubChoice_box .sub").eq(0).show().siblings().hide();
                }
            }
        });
    }


    //选择地址
    gzAddrListObj.delegate("article .gz-linfo", "click", function(){
            var t = $(this), par = t.parent(), id = par.attr("data-id"), people = par.attr("data-people"), contact = par.attr("data-contact"), addrid = par.attr("data-addrid"), addrids = par.attr("data-addrids"), addrname = par.attr("data-addrname"), address = par.attr("data-address");
            var data = {
                    "id": id,
                    "people": people,
                    "contact": contact,
                    "addrid": addrid,
                    "addrids": addrids,
                    "addrname": addrname,
                    "address": address
            }
    });

    //选择所在地区
    gzAddrSeladdr.bind("click", function(){
            gzAddNewObj.addClass(gzSelAddrActive);
            gzSelMask.fadeIn();
            gzSelAddr.removeClass(gzSelAddrHide);

            var t = $(this), ids = t.attr("data-ids"), id = t.attr("data-id"), addrname = t.text();

            //第一次点击
            // if(ids == undefined && id == undefined){
                    gzAddrInit.getAddrArea(0);

            //已有默认数据
            // }else{
            //
            //         //初始化区域
            //         ids = ids.split(" ");
            //         addrArr = addrname.split(" ");
            //         for (var i = 0; i < ids.length; i++) {
            //                 gzAddrInit.gzAddrReset(i, ids, addrArr);
            //         }
            //         $("#gzAddrArea"+id).show();
            //
            // }

    });

    //关闭选择所在地区浮动层
    gzSelAddrCloseBtn.bind("touchend", function(){
            gzAddrInit.hideNewAddrMask();
    })
    //关闭选商圈浮动层
    busBoxCloseBtn.bind("touchend", function(){
            gzAddNewObj.removeClass(gzSelAddrActive);
            gzSelMask.fadeOut();
            businessBox.addClass(businessbtnHide);
    })
    //关闭选地铁浮动层
    SubwayCloseBtn.bind("touchend", function(){
            gzAddNewObj.removeClass(gzSelAddrActive);
            gzSelMask.fadeOut();
            SubwayBox.addClass(SubwaybtnHide);
    })
    //点击遮罩背景层关闭层
    gzSelMask.bind("touchend", function(){
            gzAddrInit.hideNewAddrMask();
            gzAddNewObj.removeClass(gzSelAddrActive);
            gzSelMask.fadeOut();
            businessBox.addClass(businessbtnHide);
            SubwayBox.addClass(SubwaybtnHide);
    });

    //选择区域
    gzSelAddrList.delegate("li", "click", function(){
            var t = $(this), id = t.attr("data-id"), addr = t.text(), lower = t.attr("data-lower"), par = t.closest("ul"), index = par.index();
            if(id && addr){

                    t.addClass("gz-curr").siblings("li").removeClass("gz-curr");
                    gzSelAddrNav.find("li:eq("+index+")").attr("data-id", id).html("<span>"+addr+"</span>");

                    //如果有下级
                    if(lower == ""){

                            //把子级清掉
                            gzSelAddrNav.find("li:eq("+index+")").nextAll("li").remove();
                            gzSelAddrList.find("ul:eq("+index+")").nextAll("ul").remove();

                            //新增一组
                            gzSelAddrNav.find("li:eq("+index+")").removeClass("gz-curr");
                            gzSelAddrNav.append('<li class="gz-curr"><span>'+langData['siteConfig'][7][2]+'</span></li>');

                            //获取新的子级区域
                            gzAddrInit.getSecondAddrArea(id);

                            // 加载地铁列表
                            gzAddrInit.SubwayList(id);
                            $('.subwey .SubweyIupt').text(langData['siteConfig'][7][2]);

                            $("#addrname0").val(addr);

                    //没有下级
                    }else{

                            var addrname = [], ids = [];
                            gzSelAddrNav.find("li").each(function(){
                                    addrname.push($(this).text());
                                    ids.push($(this).attr("data-id"));
                            });

                            gzAddrSeladdr.removeClass("gz-no-sel").attr("data-ids", ids.join(" ")).attr("data-id", id).html(addrname.join(" "));
                            $("#addrid").val(id);
                            $("#addrname1").val(addr);
                            gzAddrInit.hideNewAddrMask();
                            // 加载商圈列表
                            gzAddrInit.QuanList();
                            $('.Business .BusinessInput').text(langData['siteConfig'][7][2]);


                    }

            }
    });

    //区域切换
    gzSelAddrNav.delegate("li", "touchend", function(){
            var t = $(this), index = t.index();
            t.addClass("gz-curr").siblings("li").removeClass("gz-curr");
            gzSelAddrList.find("ul").hide();
            gzSelAddrList.find("ul:eq("+index+")").show();
    });


    //选择商圈
    businessbtn.bind("click", function(){
            gzAddNewObj.addClass(gzSelAddrActive);
            gzSelMask.fadeIn();
            businessBox.removeClass(businessbtnHide);
    });

    //确认商圈
    busBoxSureBtn.bind("click",function(){
        var quanTxT = $(".QuanList").find("input:checked").attr('data-name');
        if (quanTxT != undefined) {
            $('.Business .BusinessInput').text(langData['siteConfig'][19][881]);
        }else{
            $('.Business .BusinessInput').text(langData['siteConfig'][7][2]);
        }
        gzAddNewObj.removeClass(gzSelAddrActive);
        gzSelMask.fadeOut();
        businessBox.addClass(businessbtnHide);
    })


    //展开地铁层
    Subwaybtn.bind("click", function(){
            gzAddNewObj.addClass(gzSelAddrActive);
            gzSelMask.fadeIn();
            SubwayBox.removeClass(SubwaybtnHide);
    });

    //切换地铁线路
    SubwayBox.delegate(".SubwayNav em", "click", function(){
            var t = $(this), index = t.index();
            t.addClass("subBC").siblings().removeClass("subBC");
            $('.SubChoice_box .sub').eq(index).show().siblings().hide();
    });

    //确认地铁
    SubwaySureBtn.bind("click",function(){
        var quanTxT = $(".SubChoice_box").find("input:checked").attr('data-name');
        if (quanTxT != undefined) {
            $('.subwey .SubweyIupt').text(langData['siteConfig'][19][881]);
        }else{
            $('.subwey .SubweyIupt').text(langData['siteConfig'][7][2]);
        }
        gzAddNewObj.removeClass(gzSelAddrActive);
        gzSelMask.fadeOut();
        SubwayBox.addClass(SubwaybtnHide);
    })





    $(".LoTitle span").bind("click", function(){
		location.hash = "map";
	});
    // 地图
    //关键字搜索
	var myGeo = new BMap.Geocoder();
	var autocomplete = new BMap.Autocomplete({input: "searchAddr"});
	autocomplete.addEventListener("onconfirm", function(e) {
		var _value = e.item.value;
		myValue = _value.province +  _value.city +  _value.district +  _value.street +  _value.business;

		var options = {
			onSearchComplete: function(results){
				// 判断状态是否正确
				if (local.getStatus() == BMAP_STATUS_SUCCESS){
					var s = [];
					for (var i = 0; i < results.getCurrentNumPois(); i ++){
						if(i == 0){
							lng = results.getPoi(i).point.lng;
							lat = results.getPoi(i).point.lat;
							$("#local strong").html(_value.business);
							location.hash = "add";
						}
					}
				}else{
					alert(langData['siteConfig'][20][431]);
				}
			}
		};
		var local = new BMap.LocalSearch(map, options);
		local.search(myValue);

	});


	//点击检索结果
	$(".mapresults").delegate("li", "click", function(){
		var t = $(this), title = t.find("h5").text() ,title1 = t.find("p").text();
		lng = t.attr("data-lng");
		lat = t.attr("data-lat");
		$("#location_con").val(""+title1+""+title+"" );
        $("#lnglat").val(""+lng+","+lat+"" )
		location.hash = "";
	});


	//监听hash
	$(window).on('hashchange', function(){
        var hash = location.hash;
		$(".pageitem").hide();
		$(hash).show();
        document.title = langData['siteConfig'][6][73];

			//第一次进入自动获取当前位置
			if(lng == "" || lat == ""){
				var geolocation = new BMap.Geolocation();
			    geolocation.getCurrentPosition(function(r){
			    	if(this.getStatus() == BMAP_STATUS_SUCCESS){
			    		lat = r.point.lat;
						lng = r.point.lng;

						// var geoc = new BMap.Geocoder();
						// geoc.getLocation(r.point, function(rs){
						// 	var rs = rs.addressComponents;
						// 	$("#local strong").html(rs.street + rs.streetNumber);
						// });

                        //定位地图
            			map = new BMap.Map("mapdiv");
            			var mPoint = new BMap.Point(lng, lat);
            			map.centerAndZoom(mPoint, 16);
            			getLocation(mPoint);


            			map.addEventListener("dragend", function(e){
            			    getLocation(e.point);
            			});
			    	}
			    	else {
			    		alert('failed'+this.getStatus());
			    	}
			    },{enableHighAccuracy: true});
			}else{
                //定位地图
    			map = new BMap.Map("mapdiv");
    			var mPoint = new BMap.Point(lng, lat);
    			map.centerAndZoom(mPoint, 16);
    			getLocation(mPoint);


    			map.addEventListener("dragend", function(e){
    			    getLocation(e.point);
    			});
            }

			//周边检索
			function getLocation(point){
			    myGeo.getLocation(point, function mCallback(rs){
			        var allPois = rs.surroundingPois;
			        if(allPois == null || allPois == ""){
			            return;
			        }
					var list = [];
					for(var i = 0; i < allPois.length; i++){
						list.push('<li data-lng="'+allPois[i].point.lng+'" data-lat="'+allPois[i].point.lat+'"><h5>'+allPois[i].title+'</h5><p>'+allPois[i].address+'</p></li>');
					}

					if(list.length > 0){
						$(".mapresults ul").html(list.join(""));
						$(".mapresults").show();
					}

			    }, {
			        poiRadius: 1000,  //半径一公里
			        numPois: 50
			    });
			}


		});


    //时间选择
    var start=['01:00','02:00','03:00','04:00','05:00','06:00','07:00','08:00','09:00','10:00','11:00','12:00','13:00','14:00','15:00','16:00','17:00','18:00','19:00','20:00','21:00','22:00','23:00','24:00'];
    var end=['01:00','02:00','03:00','04:00','05:00','06:00','07:00','08:00','09:00','10:00','11:00','12:00','13:00','14:00','15:00','16:00','17:00','18:00','19:00','20:00','21:00','22:00','23:00','24:00'];
    var mobileSelect1 = new MobileSelect({
      trigger: '#StartTime',
      title: '',
      wheels: [
                  {data: start}
              ],
      position:[10] //初始化定位 打开时默认选中的哪个  如果不填默认为0
    });
    var mobileSelect1 = new MobileSelect({
      trigger: '#EndTime',
      title: '',
      wheels: [
                  {data: end}
              ],
      position:[10] //初始化定位 打开时默认选中的哪个  如果不填默认为0
    });


    // 表单提交
    $(".header-search").bind("click", function(event){

		event.preventDefault();

		var t           = $(this),
				addrid      = $("#addrid"),
				address     = $("#location_con"),
				phone       = $("#phone"),
				openStart   = $("#StartTime"),
				openEnd     = $("#EndTime");
				//note        = $("#note");

		if(t.hasClass("disabled")) return;

		//区域
		if($.trim(addrid.val()) == "" || addrid.val() == 0){
            alert(langData['siteConfig'][20][68]);
            return
		}else{
			//商圈
			if($("#QuanList ul li").length != 0){
				if($("#QuanList").find("input:checked").val() == "" || $("#QuanList").find("input:checked").val() == undefined){
                    alert(langData['siteConfig'][20][432]);
                    return
				}
			}

		}

		//地址
		if($.trim(address.val()) == "" || address.val() == 0){
            alert(langData['siteConfig'][20][69]);
            return
		}

		//电话
		if($.trim(phone.val()) == "" || phone.val() == 0){
            alert(langData['siteConfig'][20][433]);
            return
		}

		//营业时间
		if($.trim(openStart.val()) == "" || openStart.val() == 0 || $.trim(openEnd.val()) == "" || openEnd.val() == 0){
            alert(langData['siteConfig'][20][434]);
            return
		}



		var form = $("#fabuForm"), action = form.attr("action");

		$.ajax({
			url: action,
			data: form.serialize(),
			type: "POST",
			dataType: "json",
			success: function (data) {
				if(data && data.state == 100){
                    alert(langData['siteConfig'][6][39])

				}else{
                    alert(data.info)
				}
			},
			error: function(){
				alert(langData['siteConfig'][20][183]);
			}
		});


	});

})