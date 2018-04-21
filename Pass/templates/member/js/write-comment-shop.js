$(function(){

  //评分
	var star_text= {
		score1: {r0:{text:''},r1:{text:langData['siteConfig'][25][5]},r2:{text:langData['siteConfig'][25][6]},r3:{text:langData['siteConfig'][25][7]},r4:{text:langData['siteConfig'][25][8]},r5:{text:langData['siteConfig'][25][9]}},
		score2: {r0:{text:''},r1:{text:langData['siteConfig'][25][10]},r2:{text:langData['siteConfig'][25][11]},r3:{text:langData['siteConfig'][25][12]},r4:{text:langData['siteConfig'][25][13]},r5:{text:langData['siteConfig'][25][14]}},
		score3: {r0:{text:''},r1:{text:langData['siteConfig'][25][20]},r2:{text:langData['siteConfig'][25][21]},r3:{text:langData['siteConfig'][25][1]},r4:{text:langData['siteConfig'][25][2]},r5:{text:langData['siteConfig'][25][22]}}
	};

	$('.pingfen').mousemove(function (e) {
		var sender = $(this);
		var id= sender.attr('data-id');
		var width = sender.width();
		var left = sender.offset().left;
		var percent = (e.pageX - left) / width * 100;
		var stars = Math.ceil((percent > 100 ? 100 : percent) / 100 * 5);
		sender.find('.pingfen_selected').css({ width: stars * 20 + '%' });
		var starcfg = star_text && star_text[id] && star_text[id]['r' + stars] ? star_text[id]['r' + stars] : null;
		if (starcfg) {
			sender.next('.pingfen_tip')
				.text(starcfg.text)
				.fadeIn(100);
		}
		if(stars == 0){
			sender.next('.pingfen_tip').stop().fadeOut();
		}
	}).click(function(e){
		e.preventDefault();
		var sender = $(this);
		var id= sender.attr('data-id');
		var name= sender.attr('data-sync');
		var data_rating = $('#'+ name);
		var width = sender.width();
		var left = sender.offset().left;
		var percent = (e.pageX - left) / width * 100;
		var stars = Math.ceil((percent > 100 ? 100 : percent) / 100 * 5);
		if(data_rating.length) data_rating.val(parseInt(stars));
		var starcfg = star_text && star_text[id] && star_text[id]['r' + stars] ? star_text[id]['r' + stars] : null;
		sender.next('.pingfen_tip')
			.text(starcfg ? starcfg.text : sender.attr('title'))
			.fadeIn(100);
		if(stars == 0){
			sender.next('.pingfen_tip').stop().fadeOut();
		}
	}).mouseleave(function(e){
		e.preventDefault();
		var sender = $(this);
		var id= sender.attr('data-id');
		var name= sender.attr('data-sync');
		var data_rating = $('#'+ name);
		var width = sender.width();
		var val= data_rating.val();
		var stars = (val && val.length ? val : 0);
		var starcfg = star_text && star_text[id] && star_text[id]['r' + stars] ? star_text[id]['r' + stars] : null;
		sender.find('.pingfen_selected').css({ width: val * 10 * 2 + '%' });
		sender.next('.pingfen_tip')
			.text(starcfg.text)
			.fadeIn(100);
		if(stars == 0){
			sender.next('.pingfen_tip').stop().fadeOut();
		}
	});

	//删除已上传图片
	var delAtlasPic = function(b){
		var g = {
			mod: "shop",
			type: "delAtlas",
			picpath: b,
			randoms: Math.random()
		};
		$.ajax({
			type: "POST",
			url: "/include/upload.inc.php",
			data: $.param(g)
		})
  };

  $(".uploader-list").dragsort({dragSelector: "li", dragSelectorExclude: ".file-panel", placeHolderTemplate: '<li class="thumbnail"></li>'});

	//从队列删除
	$(".uploader-list").delegate(".cancel", "click", function(){
		var t = $(this), li = t.closest("li");
		delAtlasPic(li.find("img").attr("data-val"));
    li.remove();
	});

  //上传图片
  function mysub(obj, id){

  	if(obj.find(".uploader-list li").length >= 5){
  		alert(langData['siteConfig'][20][582]);
  		return false;
  	}

    var id = "upload_"+id;
    obj.find(".uploader-list").append('<li id="'+id+'"><div class="loading"></div></li>');

    var data = [];
    data['mod']  = "shop";
    data['type'] = "atlas";

    var fileId = obj.find("input[type=file]").attr("id");

    $.ajaxFileUpload({
      url: "/include/upload.inc.php",
      fileElementId: fileId,
      dataType: "json",
      data: data,
      success: function(m, l) {
        if (m.state == "SUCCESS") {

        	$(".holder").html("<s></s>"+langData['siteConfig'][6][136]);
        	$("#"+id).append('<img data-val="'+m.url+'" src="'+huoniao.changeFileSize(m.turl, "small")+'" /><div class="file-panel"><span class="cancel">×</span></div>');
          $("#"+id).find(".loading").remove();

        } else {
          uploadError(m.state, id);
        }
      },
      error: function() {
        uploadError(langData['siteConfig'][20][183], id);
      }
    });

  }

  function uploadError(info, id){
    alert(info);
    $("#"+id).remove();
  }

  $(".Filedata").bind("change", function(){
    if ($(this).val() == '') return;

    var id = new Date().getTime();
    var obj = $(this).closest(".widgt");
    mysub(obj, id);
  });


	//字数限制
	var commonChange = function(t){
		var val = t.val(), maxLength = 500, tip = t.next(".lim-count");
		var charLength = val.replace(/<[^>]*>|\s/g, "").replace(/&\w{2,4};/g, "a").length;
		var surp = maxLength - charLength;
		surp = surp <= 0 ? 0 : surp;
		var txt = langData['siteConfig'][23][63].replace("1", "<strong>" + surp + "</strong>");
		tip.html(txt);

		if(surp <= 0){
			t.val(val.substr(0, maxLength));
		}
	}

  $("textarea").each(function(){
    commonChange($(this));
  });

	$("textarea").focus(function(){
		commonChange($(this));
	});
	$("textarea").keyup(function(){
		commonChange($(this));
	});
	$("textarea").keydown(function(){
		commonChange($(this));
	});
	$("textarea").bind("paste", function(){
		commonChange($(this));
	});


  //提交评价
  $("#commonBtn").bind("click", function(){

    var idArr = [], ratingArr = [], score1Arr = [], score2Arr = [], score3Arr = [], noteArr = [], imgArr = [], t = $(this), tj = true;

    $(".comment").each(function(){
      var obj = $(this), pid = obj.data("id"), speid = obj.data("speid"), specation = obj.data("specation"),
          rating = obj.find("input[name=rating"+pid+"_"+speid+"]:checked").val(),
          score1 = obj.find("input[name=score"+pid+"_"+speid+"1]").val(),
          score2 = obj.find("input[name=score"+pid+"_"+speid+"2]").val(),
          score3 = obj.find("input[name=score"+pid+"_"+speid+"3]").val(),
          note   = obj.find("textarea").val();

      var img = [];
      obj.find('.uploader-list li').each(function(){
        img.push($(this).find("img").attr("data-val"));
      });

      if(rating == undefined){
        alert(langData['siteConfig'][20][583]);
        tj = false;
        return false;
      }

      if(score1 == ""){
        alert(langData['shop'][4][30]);
        tj = false;
        return false;
      }

      if(score1 == ""){
        alert(langData['shop'][4][31]);
        tj = false;
        return false;
      }

      if(score1 == ""){
        alert(langData['shop'][4][32]);
        tj = false;
        return false;
      }

      if(note == ""){
        alert(langData['shop'][4][33]);
        tj = false;
        return false;
      }

      //idArr.push("id[]="+pid);
      ratingArr.push("rating["+pid+"_"+speid+"]="+rating);
      score1Arr.push("score1["+pid+"_"+speid+"]="+score1);
      score2Arr.push("score2["+pid+"_"+speid+"]="+score2);
      score3Arr.push("score3["+pid+"_"+speid+"]="+score3);
      noteArr.push("note["+pid+"_"+speid+"]="+note);
      imgArr.push("img["+pid+"_"+speid+"]="+img.join(","));
    });

    if(tj){
      var data = "orderid=" + id + "&" + ratingArr.join("&") + "&" + score1Arr.join("&") + "&" + score2Arr.join("&") + "&" + score3Arr.join("&") + "&" + noteArr.join("&") + "&" + imgArr.join("&");

      t.attr("disabled", true).html(langData['siteConfig'][6][35]+"...");

  		$.ajax({
  			url: masterDomain+"/include/ajax.php?service=shop&action=sendCommon",
  			data: data,
  			type: "POST",
  			dataType: "jsonp",
  			success: function (data) {
  				if(data && data.state == 100){
  					alert(langData['siteConfig'][20][196]);
            location.reload();
  				}else{
  					alert(data.info);
  					t.attr("disabled", false).html(langData['siteConfig'][8][3]);
  				}
  			},
  			error: function(){
  				alert(langData['siteConfig'][20][183]);
  				t.attr("disabled", false).html(langData['siteConfig'][8][3]);
  			}
  		});

    }

  });



});
