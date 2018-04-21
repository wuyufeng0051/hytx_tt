/* ====================== js核心函数库 by koyshe ====================== */

var host_root = '';

//$.ajaxSettings.async = false;

//常用正则规则

var rule_phone = /^((1[0-9]{10})|(029[0-9]{8}))$/;

var rule_qq = /^[0-9]{6,12}$/;

var rule_email = /^[-_A-Za-z0-9]+@([_A-Za-z0-9]+\.)+[a-z]{2,3}$/;

var rule_zh = /^[\u4e00-\u9fa5]+$/;

var rule_abc = /^[A-Za-z0-9]+$/;

/* ====================== 操作后的信息提示框 ====================== */

//10月8日修补后的

//信息提示框开启

function msgshow(msg, showtime)

{

	if (showtime == '' || showtime == undefined) showtime = 2000;

	msg = '<div id="msgshow" style="width:300px; margin:0 auto; border:1px #98c601 solid; background:#effeb9; font-size:12px; padding:5px 10px; position:absolute; top:300px; left:30%; z-index:999999;"><div style="background:url(trueimg.gif) no-repeat; padding:8px 0 0 40px; min-height:26px; _height:26px;">' + msg + '</div></div>';	

	$("#msgshow").remove();

	$("body").append(msg);

	$("#msgshow").show();

	setTimeout(function(){$("#msgshow").fadeOut(showtime)}, showtime);

}





//全选操作(修正版) by koyshe 2012-03-09

function pe_checkall(_this, inputname) {

	var checkname = $(_this).attr("name");

	if ($(_this).is(":checked")) {

		$("input[name='"+inputname+"[]']").add("input[name='"+checkname+"']").attr("checked","checked").addClass("jiesuan_hong");


	}

	else {

		$("input[name='"+inputname+"[]']").add("input[name='"+checkname+"']").removeAttr("checked").removeClass("jiesuan_hong");;

	}

} 

//带提醒批量操作(修正版) by koyshe 2012-03-09

function pe_cfall(_this, inputname, formid, show) {

	if ($("input[name='"+inputname+"[]']").filter(":checked").length == 0) {

		alert('请先勾选需要'+show+'的信息!');

		return false;

	}

	else if (confirm('您确认执行'+show+'操作吗?')) {

		$("#"+formid).attr("action", $(_this).attr("href")).submit();

	}

	return false;

}

//带提醒单个操作(修正版) by koyshe 2012-03-09

function pe_cfone(show) {

	if (confirm('您确认执行'+show+'操作吗?')) {

		return true;

	}

	return false;

};

//带提醒单个操作(button按钮) by koyshe 2012-03-09

function pe_cfone_button(_this, show) {

	if (confirm('您确认执行'+show+'操作吗?')) {

		if (document.all) {  

			var referer_url = document.createElement('a');  

			referer_url.href = $(_this).attr("href");  

			document.body.appendChild(referer_url);  

			referer_url.click();  

		}

		else {

			window.location.href = $(_this).attr("href");

		}

	}

	return false;

};

//批量操作 by koyshe 2012-03-09

function pe_doall(_this, formid) {

	$("#"+formid).attr("action", $(_this).attr("href")).submit();

}

//dialog函数 by koyshe 2011-11-12

function pe_dialog(_this, title, width, height) {

	art.dialog.open($(_this).attr("href"), {title:title, width: width, height: height});

	return false;

}









/* ====================== jq全局操作函数 ====================== */

//全选操作(修正版) by koyshe 2011-10-31

function checkall(_this, inputclass) {

	if (_this.checked == true) {

		$("input[name='"+inputclass+"[]']").attr("checked","checked");

	}

	else {

		$("input[name='"+inputclass+"[]']").removeAttr("checked");		

	}

}

//批量操作(修正版) by koyshe 2011-11-05

function doall(_this, inputclass, formid, show) {

	if ($("input[name='"+inputclass+"[]']").filter(":checked").length == 0) {

		alert('请先勾选需要'+show+'的信息!');

		return false;

	}

	else if (confirm('您确认执行'+show+'操作吗?')) {

		$("#"+formid).attr("action", $(_this).attr("href")).submit();

	}

	return false;

}

//单个操作(修正版) by koyshe 2011-11-05

function doone(show) {

	if (confirm('您确认执行'+show+'操作吗?')) {

		return true;

	}

	return false;

};

//dialog函数 by koyshe 2011-11-12

function dialog(_this, title, width, height) {

	art.dialog.open($(_this).attr("href"), {title:title, width: width, height: height});

	return false;

}



function pe_inputdefault(id, text) {

	$("#"+id).css('color','#666').val(text);

	$("#"+id).focus(function(){

		//alert($(this).val())

		if ($(this).val() == text) {

			$(this).val('');

		}

	})

	$("#"+id).blur(function(){

		if ($(this).val() == '') {

			$(this).val(text)

		}

	})

}



function pe_inputdefault1(inputname, text) {

	$("input[name='"+inputname+"']").css('color','#666').val(text);

	$("input[name='"+inputname+"']").focus(function(){

		//alert($(this).val())

		if ($(this).val() == text) {

			$(this).val('');

		}

	})

	$("input[name='"+inputname+"']").blur(function(){

		if ($(this).val() == '') {

			$(this).val(text)

		}

	})

}



function marqeetop(objid, lh,speed,delay) {

	var p=false;

	var t;

	var o=document.getElementById(objid);

	if(!o)return;

	o.innerHTML+=o.innerHTML;

	o.style.marginTop=0;

	o.onmouseover=function(){p=true;}

	o.onmouseout=function(){p=false;}



	function start(){

		t=setInterval(scrolling,speed);

		if(!p) o.style.marginTop=parseInt(o.style.marginTop)-1+"px";

	}



	function scrolling(){

		if(parseInt(o.style.marginTop)%lh!=0){

		o.style.marginTop=parseInt(o.style.marginTop)-1+"px";

		if(Math.abs(parseInt(o.style.marginTop))>=o.scrollHeight/2) o.style.marginTop=0;

		}else{

		clearInterval(t);

		setTimeout(start,delay);

		}

	}

	setTimeout(start,delay);

}

