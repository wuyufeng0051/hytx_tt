$(function(){


  //下拉菜单
  $('.demo-test-select').scroller(
    $.extend({preset: 'select'})
  );


  //年月日
  $('.demo-test-date').scroller(
  	$.extend({preset: 'date', dateFormat: 'yyyy-mm-dd'})
  );


  //二级菜单
  $('.demo-select-opt').scroller(
  	$.extend({
      preset: 'select',
      group: true
    })
  );


	// 如果是修改，设置类别
	if(id && typeid){
		var s = $('#typename'), type1 = s.val();
		// getType(s,type1,typeid);
		$('#citybtn').attr({'data-ids':type1+' '+typeid,'data-id':typeid})
	}

	// 个人列表
  $(".tab").click(function(){
      if( $(".lead .tab-list").css("display")=='none' ) {
          $(".lead .tab-list").show();
      }else{
          $(".lead .tab-list").hide();
      }
  });

	// 选择分类
	$('label.type').delegate("select","change",function(){
		var s = $(this), id = s.val();
		// getType(s,id);
	})

	// 上传海报
	var upbtn = $('#litpicBtn');
	upbtn.click(function(){
		if(upbtn.hasClass('disabled')) return;
		$('#Filedata').click();
	})

	// $('#Filedata').change(function(){
	// 	mysub();
	// })


	$('#city').click(function(){
		console.log('kkkk')
	})

	$('.turn').click(function(){
		var btn = $(this);
		if(btn.hasClass('close')){
			btn.removeClass('close').addClass('open');
			$('.baomingend').show();
			$('#baoming').val(1);
		}else{
			btn.removeClass('open').addClass('close');
			$('.baomingend').hide()
			$('#baoming').val(0);
		}
	})

	// 切换费用类型
	$('.pricetype input').click(function(){
		var t =$(this), val = t.closest('label').find('a').data('id');
		if(val == 0){
			$('.max').removeClass('fn-hide');
			$('.fee_body').addClass('fn-hide');
		}else{
			$('.max').addClass('fn-hide');
			$('.fee_body').removeClass('fn-hide');
		}
		$('#fee').val(val);
	})

	//增加电子票
	var feeTemp = '<div class="fee_item fn-clear"><span class="t1"><input type="text" name="fee_title[]" placeholder="费用名称"></span><span class="t2"><input type="text" name="fee_price[]" placeholder="免费请填0"></span><span class="t3"><input type="text" onkeyup="value=value.replace(/[^\\d.]/g, \'\')" name="fee_max[]" placeholder="留空不限"></span><span class="t4"><a href="javascript:;" class="del">删除</a></span></div>';
	$("#feeAdd").bind("click", function(){
		$(this).before(feeTemp);
		$(".fee_con .t4 a").show();
	});

	//删除电子票
	$(".fee_con").delegate(".t4 a", "click", function(){
		if($(".fee_con .fee_item").length > 1){
			$(this).closest(".fee_item").remove();

			if($(".fee_con .fee_item").length == 1){
				$(".fee_con .t4 a").hide();
			}
		}
	});



	$('#submit').click(function(){
		var tj = $(this), action = $('#fabuForm').attr("action");

		$('#fabuForm label').removeClass('haserror');

		if(tj.hasClass('disabled')) return;

		var typeid = $('#typeid');
		if(typeid.val() == 0){
			errmsg(typeid,'请选择活动分类');
			$(window).scrollTop(0);
			return false;
		}

		$('#typeid').val(typeid.val());

		var litpic = $('#litpic');
		if(litpic.val() == ''){
			errmsg(litpic,'请上传活动海报');
			$(window).scrollTop(0);
			return false;
		}

		var title = $('#title');
		if(title.val() == 0){
			errmsg(title,'请输入活动主题！');
			title.focus();
			return false;
		}

		var began = $("#began");
		if(began.val() == ""){
			errmsg(began, "请选择开始时间！");
			return false;
		}

		var end = $("#end");
		if(end.val() == ""){
			errmsg(end, "请选择结束时间！");
			return false;
		}

		var baomingend = $("#baomingend");
		if(baomingend.val() == "" && $(".inpbox .turn").hasClass("open")){
			errmsg(baomingend, "请选择报名截止时间！");
			return false;
		}

		var addrid = $("#addrid");
		if(addrid.val() == "" || addrid.val() == 0){
			errmsg(addrid, "请选择活动区域！");
			return false;
		}

		var address = $("#address");
		if(address.val() == ""){
			errmsg(address, "请输入活动详细地址！");
			return false;
		}

		var body = $("#body");
		if(body.val() == ""){
			errmsg(body, "请输入活动详情！");
			return false;
		}

		//费用验证
		if(id == 0 && reg == 0){
			var fee = $("#fee").val(), feeCount = 0;
			if(fee == 1){
				$(".fee_con .fee_item").each(function(){
					var th = $(this), tit = th.find(".t1 input").val(), price = parseFloat(th.find(".t2 input").val()), max = th.find(".t3 input").val();
					if(tit != "" && price != NaN){
						feeCount++
					}
				});
				console.log(feeCount);
				if(feeCount == 0){
					errmsg($(".fee_body"), "请填写电子票内容！");
					return false;
				}
			}else{
				var max = $("#max");
				if(max.val() == "" || max.val() == 0){
					errmsg(max, "请输入人数上限！");
					return false;
				}
			}
		}

		var contact = $("#contact");
		if(contact.val() == ""){
			errmsg(contact, "请输入主办方联系方式！");
			return false;
		}

		tj.addClass("disabled").text("提交中...");

		var data = $("#fabuForm").serialize();
		if(id != 0){
			data += "&id="+id;
		}

		$.ajax({
			url: action,
			data: data,
			type: "POST",
			dataType: "json",
			success: function (data) {
				if(data && data.state == 100){

					fabuPay.check(data, document.URL, tj);

				}else{
					alert(data.info);
					tj.removeClass("disabled").text("重新提交");
				}
			},
			error: function(){
				alert(data.info);
				tj.removeClass("disabled").text("重新提交");
			}
		});
	})

	// 错误提示
	function errmsg(obj,str){
		var o = $(".error");
		o.html('<p>'+str+'</p>').show();
		if(obj.is('textarea') || (obj.is('input') && obj.is(':visible') && obj.attr('readonly') != "true")){
			obj.focus();
			console.log('1')
		}else{
			$('html,body').animate({
			},10);
		}

		obj.closest('label').addClass('haserror');
		setTimeout(function(){o.hide()},1000);
	}


})




// <input type="text" name="type" id="type" placeholder="活动分类" readonly="true">
