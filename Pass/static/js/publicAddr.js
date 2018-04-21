try{
  var ajaxService = service;
}catch(e){
  var ajaxService = 'siteConfig';
}

var gzAddrBox, gzAddrSeladdr, gzAddrSeladdrCurr = null,
    gzAddress, gzSelAddrList, gzSelAddrNav,
    getAddrFirst = 0,
    showErrTimer = null,
    gzAddrEditId = 0;

$(function(){
        gzAddrBox         = $('.cityName'), //选择地区整体
        gzAddrSeladdr     = $(".addrBtn"),  //选择所在地区按钮
        gzAddress         = $('.city-select-box'),  //选择地址下拉框
        gzSelAddrList     = $(".city-select-content"),  //区域列表
        gzSelAddrNav      = $(".city-select-tab"),  //区域TAB
        gzAddrInit = {

            //显示选择地址页
            showChooseAddr: function(){
                var postop  = gzAddrSeladdrCurr.offset().top + gzAddrSeladdrCurr.outerHeight() - 1,
                    posleft = gzAddrSeladdrCurr.offset().left;
                gzAddress.css({'top':postop+'px','left':posleft+'px'}).show();
            }

            //隐藏选择地址页
            ,closeChooseAddr: function(){
                gzAddress.hide();
            }


            //获取区域
            ,getAddrArea: function(id){

                //如果是一级区域
                if(!id){
                    gzSelAddrNav.html('<a class="gz-curr"><span>请选择</span></a>');
                    // gzSelAddrList.html('');
                }

                var areaobj = "gzAddrArea"+id;
                if($("#"+areaobj).length == 0){
                  gzSelAddrList.append('<div class="city-select" id="'+areaobj+'"><p class="loading">加载中...</p></div>');
                }

                gzSelAddrList.find(".city-select").hide();
                $("#"+areaobj).show();


                $.ajax({
                    url: "/include/ajax.php?service="+ajaxService+"&action=addr",
                    data: "type="+id,
                    type: "GET",
                    dataType: "jsonp",
                    success: function (data) {
                      if(data && data.state == 100){
                        var list = data.info, areaList = [], sort1 = [], sort2 = [], sort3 = [], sort4 = [], sort = [];
                          if (getAddrFirst == 0) {
                            if (ajaxService == "siteConfig") {
                              gzSelAddrList.html('<div class="city-select city-first"><dl class="fn-clear city-first1"><dt>A-G</dt><dd></dd></dl><dl class="fn-clear city-first2"><dt>H-K</dt><dd></dd></dl><dl class="fn-clear city-first3"><dt>L-S</dt><dd></dd></dl><dl class="fn-clear city-first4"><dt>T-Z</dt><dd></dd></dl></div>')
                              for (var i = 0, area, lower; i < list.length; i++) {
                                  area = list[i];
                                  pinyin = list[i].pinyin;
                                  lower = area.lower == undefined ? 0 : area.lower;
                                  areaList.push([list[i].pinyin,list[i].id,list[i].typename,list[i].lower]);
                              }
                              areaList.sort();

                              for (var i = 0; i < areaList.length; i++) {
                                var py = areaList[i][0].substr(0 ,1);
                                if(py >= 'a' && py <= 'g'){
                                  sort1.push('<a href="javascript:;" data-lower="'+areaList[i][3]+'" data-id="'+areaList[i][1]+'">'+areaList[i][2]+'</a>');
                                }
                                else if(py >= 'h' && py <= 'k'){
                                  sort2.push('<a href="javascript:;" data-lower="'+areaList[i][3]+'" data-id="'+areaList[i][1]+'">'+areaList[i][2]+'</a>');
                                }
                                else if(py >= 'l' && py <= 's'){
                                  sort3.push('<a href="javascript:;" data-lower="'+areaList[i][3]+'" data-id="'+areaList[i][1]+'">'+areaList[i][2]+'</a>');
                                }
                                else if(py >= 't' && py <= 'z'){
                                  sort4.push('<a href="javascript:;" data-lower="'+areaList[i][3]+'" data-id="'+areaList[i][1]+'">'+areaList[i][2]+'</a>');
                                }
                              }
                              $(".city-first1 dd").html(sort1.join(""));
                              $(".city-first2 dd").html(sort2.join(""));
                              $(".city-first3 dd").html(sort3.join(""));
                              $(".city-first4 dd").html(sort4.join(""));
                            }else {
                              for (var i = 0, area, lower; i < list.length; i++) {
                                area = list[i];
                                lower = area.lower == undefined ? 0 : area.lower;
                                cla = "";
                                if(!lower){cla += " n";}
                                if(id == area.id){cla += " gz-curr";}
                                sort1.push('<a data-id="'+area.id+'" data-lower="'+lower+'"'+(cla != "" ? 'class="'+cla+'"' : '')+'>'+area.typename+'</a>');
                              }
                              $(".city-select").hide();
                              $(".city-first").html(sort1.join("")).show();
                            }
                          }else {
                            for (var i = 0, area, lower; i < list.length; i++) {
                              area = list[i];
                              lower = area.lower == undefined ? 0 : area.lower;
                              areaList.push('<a data-id="'+area.id+'" data-lower="'+lower+'"'+(!lower ? 'class="n"' : '')+'>'+area.typename+'</a>');
                            }
                            $("#"+areaobj).html(areaList.join("")).show();
                          }

                      }else{
                        $("#"+areaobj).html('<a class="loading">'+data.info+'</a>');
                      }
                    },
                    error: function(){
                      $("#"+areaobj).html('<a class="loading">网络错误，请重试！</a>');
                    }
                });


            }

            // 初始区域
            ,gzAddrReset: function(i, ids, addrArr){

                var gid = i == 0 ? 0 : ids[i-1];
                var id = ids[i];
                var addrname = addrArr[i];

                //全国区域
                if(i == 0){
                  gzSelAddrNav.html('');
                  gzSelAddrList.html('');
                }

                var cla = i == addrArr.length - 1 ? ' class="gz-curr"' : '';
                gzSelAddrNav.append('<a data-id="'+id+'"'+cla+'><span>'+addrname+'</span></a>');

                var areaobj = "gzAddrArea"+id;
                if($("#"+areaobj).length == 0){
                  if (i == 0) {
                    var first = 0;
                    gzSelAddrList.append('<div class="city-select city-first hide"><dl class="fn-clear city-first1"><dt>A-G</dt><dd></dd></dl><dl class="fn-clear city-first2"><dt>H-K</dt><dd></dd></dl><dl class="fn-clear city-first3"><dt>L-S</dt><dd></dd></dl><dl class="fn-clear city-first4"><dt>T-Z</dt><dd></dd></dl></div>');
                  }else {
                    gzSelAddrList.append('<div class="city-select hide" id="'+areaobj+'"><p class="loading">加载中...</p></div>');
                  }
                }
                $.ajax({
                    url: "/include/ajax.php?service="+ajaxService+"&action=addr",
                    data: "type="+gid,
                    type: "GET",
                    dataType: "jsonp",
                    success: function (data) {
                      if(data && data.state == 100){
                        var list = data.info, areaList = [], sort1 = [], sort2 = [], sort3 = [], sort4 = [], sort = [];
                        // 当只选择第一个的时候
                        if ($('.city-select').length == 1) {
                          $('.city-select').removeClass('hide');
                        }
                        if (first == 0) {
                          if (ajaxService == 'siteConfig') {
                            first++;
                            for (var i = 0, area, cla, lower; i < list.length; i++) {
                              area = list[i];
                              pinyin = list[i].pinyin;
                              lower = area.lower == undefined ? 0 : area.lower;
                              areaList.push([list[i].pinyin,list[i].id,list[i].typename,list[i].lower]);
                            }
                            areaList.sort();
                            for (var i = 0; i < areaList.length; i++) {
                              var py = areaList[i][0].substr(0 ,1), cla = "";
                              if(id == areaList[i][1]){
                                cla += " gz-curr";
                              }
                              if(py >= 'a' && py <= 'g'){
                                sort1.push('<a href="javascript:;" data-lower="'+areaList[i][3]+'" data-id="'+areaList[i][1]+'"'+(cla != "" ? 'class="'+cla+'"' : '')+'>'+areaList[i][2]+'</a>');
                              }
                              else if(py >= 'h' && py <= 'k'){
                                sort2.push('<a href="javascript:;" data-lower="'+areaList[i][3]+'" data-id="'+areaList[i][1]+'"'+(cla != "" ? 'class="'+cla+'"' : '')+'>'+areaList[i][2]+'</a>');
                              }
                              else if(py >= 'l' && py <= 's'){
                                sort3.push('<a href="javascript:;" data-lower="'+areaList[i][3]+'" data-id="'+areaList[i][1]+'"'+(cla != "" ? 'class="'+cla+'"' : '')+'>'+areaList[i][2]+'</a>');
                              }
                              else if(py >= 't' && py <= 'z'){
                                sort4.push('<a href="javascript:;" data-lower="'+areaList[i][3]+'" data-id="'+areaList[i][1]+'"'+(cla != "" ? 'class="'+cla+'"' : '')+'>'+areaList[i][2]+'</a>');
                              }
                            }
                            $(".city-first1 dd").html(sort1.join(""));
                            $(".city-first2 dd").html(sort2.join(""));
                            $(".city-first3 dd").html(sort3.join(""));
                            $(".city-first4 dd").html(sort4.join(""));
                          }else {
                            for (var i = 0, area, lower; i < list.length; i++) {
                              area = list[i];
                              lower = area.lower == undefined ? 0 : area.lower;
                              cla = "";
                              if(!lower){cla += " n";}
                              if(id == area.id){cla += " gz-curr";}
                              sort1.push('<a data-id="'+area.id+'" data-lower="'+lower+'"'+(cla != "" ? 'class="'+cla+'"' : '')+'>'+area.typename+'</a>');
                            }
                            $(".city-first").html(sort1.join(""));
                          }
                        }else {
                          for (var i = 0, area, cla, lower; i < list.length; i++) {
                            area = list[i];
                            lower = area.lower == undefined ? 0 : area.lower;
                            cla = "";
                            if(!lower){cla += " n";}
                            if(id == area.id){cla += " gz-curr";}
                            areaList.push('<a data-id="'+area.id+'" data-lower="'+lower+'"'+(cla != "" ? 'class="'+cla+'"' : '')+'>'+area.typename+'</a>');
                          }
                          $("#"+areaobj).html(areaList.join(""));
                        }
                      }else{
                        $("#"+areaobj).html('<a class="loading">'+data.info+'</a>');
                      }
                    },
                    error: function(){
                      $("#"+areaobj).html('<a class="loading">网络错误，请重试！</a>');
                    }
                });

            }

        }



    // 选择地区下拉框
    gzAddrBox.bind("click", function(){
      return false;
    })

    gzAddrSeladdr.each(function(){
      var t = $(this), ids = t.attr("data-ids"), id = t.attr("data-id"), addrname = t.text();
      if(ids == ""){
        if (id == "" || id == "0") {
          getAddrFirst = 0;
          gzAddrInit.getAddrArea(0);
        }else {
          gzAddrSeladdr.html('请选择');
          gzAddrSeladdr.attr('data-id', "");
        }
      }
    })


    //选择所在地区
    gzAddrSeladdr.on("click", function(){
        gzAddrSeladdrCurr = $(this);
        gzAddrInit.showChooseAddr();
        var t = $(this), ids = t.attr("data-ids"), id = t.attr("data-id"), addrname = t.text();

        //第一次点击
        if(ids == "" && id == "0"){
          getAddrFirst = 0;
          gzAddrInit.getAddrArea(0);
        //已有默认数据
        }else{

            //初始化区域
            ids = ids.split(" ");
            addrArr = addrname.split("/");
            for (var i = 0; i < ids.length; i++) {
              gzAddrInit.gzAddrReset(i, ids, addrArr);
            }
            $("#gzAddrArea"+id).show();

        }

    });


    //选择区域
    gzSelAddrList.delegate("a", "click", function(){
        var t = $(this), id = t.attr("data-id"), addr = t.text(), lower = t.attr("data-lower"), par = t.closest(".city-select"), index = par.index(); getAddrFirst = 1;
        if(id && addr){

            t.closest('.city-select').find('a').removeClass("gz-curr");
            t.addClass("gz-curr");
            gzSelAddrNav.find("a:eq("+index+")").attr("data-id", id).html("<span>"+addr+"</span>");


            //把子级清掉
            gzSelAddrNav.find("a:eq("+index+")").nextAll("a").remove();
            gzSelAddrList.find(".city-select").eq(index).nextAll(".city-select").remove();


            var addrname = [], ids = [];
            gzSelAddrNav.find("a").each(function(){
                addrname.push($(this).text());
                ids.push($(this).attr("data-id"));
            });

            gzAddrSeladdrCurr.removeClass("gz-no-sel").attr("data-ids", ids.join(" ")).attr("data-id", id).html(addrname.join("/"));


            //如果有下级
            if(lower != "0"){

                //新增一组
                gzSelAddrNav.find("a:eq("+index+")").removeClass("gz-curr");
                gzSelAddrNav.append('<a class="gz-curr"><span>请选择</span></a>');

                //获取新的子级区域
                gzAddrInit.getAddrArea(id);

            //没有下级
            }else{

                gzAddrInit.closeChooseAddr();

            }

        }
    });

    //区域切换
    gzSelAddrNav.delegate("a", "click", function(){
        var t = $(this), index = t.index();
        t.addClass("gz-curr").siblings("a").removeClass("gz-curr");
        gzSelAddrList.find(".city-select").hide();
        gzSelAddrList.find(".city-select").eq(index).show();
    });

    $(document).click(function (e) {
        var s = e.target;
        if (!$.contains(gzAddress.get(0), s)) {
            gzAddress.hide();
        }
    });

    // 滚动时下拉框隐藏
    $('.main').scroll(function(){
      gzAddress.hide();
    })
    $(window).scroll(function(){
      gzAddress.hide();
    })

    gzAddrSeladdr.each(function(){
      // gzAddrSeladdrCurr = $(this);

    })

    $('.cityName').show();
});

var addressStyle = '<style>.hide{display: none;} .cityName{position: relative; display:inline-block; height: 32px;} .addrBtn{line-height: 32px; padding-left: 10px; width: 293px; border: 1px solid #ddd; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; background: #fff; text-align: left; font-size: initial;} .city-select-box{position: absolute; top: 30px; left: 0; display: none; z-index: 999;} .city-select-tab{border: 1px solid #ccc;background: #f0f0f0; width: 303px;} .city-select-tab a { float: left; display: block; margin-bottom: -1px; padding: 8px 3px; border-right: 1px solid #ccc; border-bottom: 1px solid transparent; color: #4D4D4D; text-align: center; outline: 0; width: 68px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;} .city-select-tab a:hover{text-decoration: none;} .city-select-tab .gz-curr { background: #fff; border-bottom: 1px solid #fff; color: #f60; padding-bottom: 9px; border-right: 1px #ccc solid;} .city-select { border: 1px #ccc solid; border-top: 0; padding: 10px 15px; width: 273px; background: #fff; font-size: 12px;} .city-select dl {line-height: 2;clear: both;padding: 3px 0;margin: 0;} .city-select dt { display: inline-block; width: 25px; float: left; padding-right: 10px; font-weight: 700; text-align: right; font-size: 12px;} .city-select dd { width: 233px; display: inline; float: left; margin-left: 0; padding: 0;} .city-select a { display: inline-block; color: #4D4D4D; padding: 0 10px; outline: 0; text-decoration: none; white-space: nowrap; margin-right: 2px; cursor: pointer; line-height: 24px;} .city-select a.gz-curr{background: #f60; color: #fff; border-radius: 4px;} #selAddr{padding-bottom: 0;} .loading{text-align: center;}</style>';

var addressModal = '<div class="city-select-box"> <div class="city-select-box-wrap"> <div class="city-select-tab fn-clear"> <a href="javascript:;" class="current">省份</a> <a href="javascript:;">城市</a> <a href="javascript:;">县区</a> <a href="javascript:;">街道</a> </div> <div class="city-select-content"> <div class="city-select city-first"> <dl class="fn-clear city-first1"> <dt>A-G</dt> <dd></dd> </dl> <dl class="fn-clear city-first2"> <dt>H-K</dt> <dd></dd> </dl> <dl class="fn-clear city-first3"> <dt>L-S</dt> <dd></dd> </dl> <dl class="fn-clear city-first4"> <dt>T-Z</dt> <dd></dd> </dl> </div> </div> </div> </div>';

$('head').append(addressStyle);
$('body').append(addressModal);
