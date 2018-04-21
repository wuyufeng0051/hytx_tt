// getjax方法
function getloginstatus(){ //只查看登录状态。已经登录，返回userid，未登录返回 0；
	var rec=getajax(website+'',{g:'status'});
	return rec;
}
function getuser(username,nc){//设置页面上的登录状态 username存在，显示登录后的状态。否则获取登录注册框
	var url=website+'';
	return getajax(url+'getuser',{username:username,nc:nc});
}
function ajaxalert(url,data,msgw) {// ajax方式获取显示内容的简易弹出对话框
var str=getajax(url,data);
myalert(str,msgw);
}
function myalert(str,msgw){
	var bgdiv='alertshowbgdiv';
	var msgdiv='alertshowmsgdiv';
	var left=4;
	var winwidth=$(window).width();
	if(msgw=='undefined' || !msgw)msgw=winwidth-10;//提示框宽度
	else{
		left=(winwidth-msgw)/2;
	}
	var winh=$('body').height();//窗口高度
	var h=$(window).height();
	if(h<winh)h=winh;
	
  	$('body').append('<div id="'+bgdiv+'"></div>');
	obj=$('#'+bgdiv);
	
	obj.append('<div id="'+msgdiv+'"></div>');
	msgobj=$('#'+msgdiv);
	msgobj.css('position',"fixed");
	msgobj.css('left','0px');
	msgobj.css('top',"0px");
	msgobj.css('width',"100%");
	msgobj.css('height',"100%");
	msgobj.css('z-index',"88");

	msgobj.css('background','url('+website+'image/alp_b_30.png) repeat 0 0');
	msgobj.html(str);
}

function closealert(formid){//移除盒子，一般用于关闭简易弹出对话框
	var f='#'+formid;
	$(f).remove();
}
function showhtml(formid,url,data){//ajax方式获取数据并且显示数据
	var f='#'+formid;
	var rec=getajax(url,data);
	$(f).html(rec);
}
function getajax(url,data){//ajax方式获取数据
	// var rec='';
	/*$.ajax({
		   async:false,
		   type:"POST",
		   url:url,
		   data:data,
		   dataType:'html',
		   success:function(data){
			   rec=data;
		   }
	});*/
	return 90
}





// 校验qq号码输入是否符合规则
function ckuserqq(){	
	var res=1;
	msg='正在输入...';
	var str=$('#user_qq').val();
	if (str=='') {
		msg='请填写您的QQ号';
		res=0;
	}
	checkstr(str,'qq');
	
	return res;
}

function ckusertname(){
	var res=1;
	msg='正在输入...';
	var r=checkstr($('#ZE_usertname').val(),'chinese');
	var str=$("#ZE_usertname").val();
	if (str=='') {
		msg='请填写您的网名';
		res=0;
	}
 	if(r){
		return 1;
 	}else{
		return 0;
	}
}

function ckuserwx(){
	var res=1;
	msg='正在输入...';
	var str=$("#aliwangwang").val();
	
	if (str=='') {
		msg='请填写您的微信账号';
		res=0;
	}
	return res;
}

function ckuserphone(){
	var res=1;
	msg='正在输入...';
	var str=$('#user_phone').val();	
	var phonelength = str.length;
	if (str=='') {
		msg='请填您的手机号码';
		res=0;
	}

	if(phonelength==3){
		c = /^(13[0-9]|14[0-9]|15[0-9]|17[0-9]|18[0-9])$/;
		if (c.test(str) == false) {
			msg='您输入的号码格式有误';
			return false;
		}
	}else if(phonelength>=11){
		var r=checkstr(str,'phone');
		var onurl=website+''; 
		if(typeof userid == 'undefined'){
			r=getajax(onurl,{table:'user',fd:'user_phone',v:str});
		}
		else{
			r=getajax(onurl,{table:'user',fd:'user_phone',v:str,fdid:'user_id',id:userid});
		}
		if(r=='90'){
			msg='手机号已经存在';
			res=0;
		}else if(r!='99'){
			msg='核查失败,请刷新';
			res=0;
		}	
	}else res=0;
	return res;
}

function ckuseremail(){
	var res=1;
	var str=$('#user_email').val();
	msg='正在输入...';
	var r=checkstr(str,'email');
	var onurl=website+'';
	if(r){
		if(typeof userid == 'undefined')r=getajax(onurl,{table:'user',fd:'user_email',v:str});
		else r=getajax(onurl,{table:'user',fd:'user_email',v:str,fdid:'user_id',id:userid});
		if(r=='90'){
			msg='邮箱已经存在';
			res=0;
		}else if(r!='99'){
			msg='核查失败,请刷新';
			res=0;
		}	
	}else res=0;
	return res;
}

function ckuserpw(){
	var res=1;
	var str=$("#user_pw").val();
	msg='正在输入...';
	if (str=='') {
		msg='请填写密码';
		res=0;
	}else if(str.length<6 || str.length>20){
		msg='密码6到20位';
		res=0;
	}
	if(res==1){
		$("#user_pws").html(ok);
	}
	return res;
}

function ckcpw(){
	var res=1;
	var str=$("#cpw").val();
	msg='输入正确';//先检查密码正确性
	if (str=='') {
		msg='请再次输入密码';
		res=0;
	}else if(str.length<6 || str.length>20){
		msg='密码6到20位';
		res=0;
	}
	else if($("#cpw").val()!=$("#user_pw").val()){
		msg='两次密码不一致';
		res=0;
	}
	return res;
}

function ckusername(){
	var res=1;
	var str=$('#user_name').val();
	msg='正在输入...';
	var r=checkstr(str,'username');
	var onurl=website+'';
	if(r){
		r=getajax(onurl,{table:'user',fd:'user_name',v:str});
		if(r=='90'){
			msg='用户名已经存在';
			res=0;
		}else if(r!='99'){
			msg='核查失败,请刷新';
			res=0;
		}
	}
	else{
		res=0;	
	}
	return res;
}

function cktjname(){ //检查推荐人是否存在，
	var res=1;
	var str=$('#ZE_usernametj').val();msg='输入正确';
	var r=checkstr(str,'tjusername');
	var onurl=website+'';
	if (str=='') {
		msg='没有推荐编号不能注册！';
		res=0;
	}
	if(r){
		r=getajax(onurl,{table:'user',fd:'user_name',v:str});
		if(r=='99'){
			msg='推荐人账号不存在';
			res=0;
		}else if(r!='90'){
			msg='核查失败,请刷新';
			res=0;
		}
	}
	else{
		res=0;	
	}
	return res;
}

function checkstr(str,type){
	if(str==''){
		msg='不能为空';
		return false;
	}
	var p='';
	switch(type){
		case 'username':
			p = /^[A-Za-z0-9]+$/;
			if (p.test(str) == false) {
				msg='推荐人账号不存在';
				return false;
			}
		break;
		case 'tjusername':
			p = /^[A-Za-z0-9]+$/;
			if (p.test(str) == false) {
				msg='推荐人账号不存在';
				return false;
			}
		break;
		case 'email':
			p = /^[-_A-Za-z0-9]+@([_A-Za-z0-9]+\.)+[a-z]{2,3}$/;
			if (p.test(str) == false) {
				msg='邮箱格式不正确';
				return false;
			}
			else if(str.substr(str.length-7)!='@qq.com' && str.substr(str.length-12)!='@foxmail.com'){
				msg='请使用QQ邮箱注册';
				return false;
			}
		break;
		case 'qq':
			p= /^[0-9]{5,10}$/;
			if (p.test(str) == false) {
				msg='请填写5到10位的QQ号';
				return false;
			}
		break;
		case 'phone':
			p = /^(13[0-9]|14[0-9]|15[0-9]|17[0-9]|18[0-9])\d{8}$/;
			if (p.test(str) == false) {
				msg='您输入的号码有错误';
				return false;
			}
		break;
		case 'chinese':
			p = /^[\u4e00-\u9fa5]{2,5}$/;
			if (p.test(str) == false) {
				msg='网名仅限中文，并且是2位到5位';
				return false;
			}
		break;
		default:
			return false;
		break;
	}
	return true;
}

// 注册提示部分
$('#user_qq').focus(function(){
	$('#ZE_regmenupoptip01').show();
	$('#user_qqs').html('正在输入...');						  
});
$('#user_qq').blur(function(){
	$('#ZE_regmenupoptip01').hide();
});

$('#ZE_usertname').focus(function(){
	$('#ZE_regmenupoptip02').show();
	$('#ZE_usertnames').html('正在输入...');						  
});
$('#ZE_usertname').blur(function(){
	$('#ZE_regmenupoptip02').hide();
});

$('#aliwangwang').focus(function(){
	$('#ZE_regmenupoptip03').show();
	$('#aliwangwangs').html('正在输入...');						  
});
$('#aliwangwang').blur(function(){
	$('#ZE_regmenupoptip03').hide();
});

$('#user_pw').focus(function(){
	$('#ZE_regmenupoptip04').show();
	$('#user_pws').html('正在输入...');						  
});
$('#user_pw').blur(function(){
	$('#ZE_regmenupoptip04').hide();
});

$('#cpw').focus(function(){
	$('#ZE_regmenupoptip05').show();
	$('#cpws').html('正在输入...');						  
});
$('#cpw').blur(function(){
	$('#ZE_regmenupoptip05').hide();
});

$('#user_phone').focus(function(){
	$('#ZE_regmenupoptip06').show();
	$('#user_phones').html('正在输入...');						  
});
$('#user_phone').blur(function(){
	$('#ZE_regmenupoptip06').hide();
});

$('#ZE_usernametj').focus(function(){
	$('#regmenu_poptip09').show();
	$('#tjnames').html('正在输入...');						  
});
$('#ZE_usernametj').blur(function(){
	$('#regmenu_poptip09').hide();
});

// 监听输入是否正确并提示  下面的写法不支持ie8
function Inputqq(event){
   ckuserqq();$('#user_qqs').html(msg);
}

function Inputtname(event){
   ckusertname();$('#ZE_usertnames').html(msg);
}

function Inputwx(event){
   ckuserwx();$('#aliwangwangs').html(msg);
}

function Inputpw(event){
   ckuserpw();$('#user_pws').html(msg);
}

function Inputpws(event){
   ckcpw();$('#cpws').html(msg);
}

function Inputsj(event){
   ckuserphone();$('#user_phones').html(msg);
}

function Inputtj(event){
   cktjname();$('#tjnames').html(msg);
}

// 支持ie8的写法
function IeInputqq(event){
   if (event.propertyName.toLowerCase() == "value"){
      ckuserqq();$('#user_qqs').html(msg);
   }
}

function IeInputtname(event){
   if (event.propertyName.toLowerCase() == "value"){
      ckusertname();$('#ZE_usertnames').html(msg);
   }
}

function IeInputwx(event){
   if (event.propertyName.toLowerCase() == "value"){
      ckuserwx();$('#aliwangwangs').html(msg);
   }
}

function IeInputpw(event){
   if (event.propertyName.toLowerCase() == "value"){
   	ckuserpw();$('#user_pws').html(msg);
   }
}

function IeInputpws(event){
   if (event.propertyName.toLowerCase() == "value"){
      ckcpw();$('#cpws').html(msg);
   }
}

function IeInputsj(event){
   if (event.propertyName.toLowerCase() == "value"){
      ckuserphone();$('#user_phones').html(msg);
   }
}

function IeInputtj(event){
   if (event.propertyName.toLowerCase() == "value"){
      cktjname();$('#tjnames').html(msg);
   }
}
// 提示部分结束

function showecimgcode(linkurl,username,size,lv,mg){
	var url=website+'';		//ajax方式获取数据
	var data={username:username,url:linkurl,size:size,lv:lv,mg:mg}
	var rec='';
	$.ajax({
	   async:true,
	   type:"POST",
	   url:url,
	   data:data,
	   dataType:'html',
	   success:function(d){
		  $('#ecimgcode').attr('src',d);
	   }
	});
	return rec;
}

function showa(){
	var url=website+'';
	showfee();
	aid=$("#area_a").val();
	showhtml('area_as',url,{aid:aid});
}

function showb(){
	var bid=$("#area_b").val();
	var url=website+'';
	showhtml('area_bs',url,{bid:bid});
}
// 注册提示
      var msg = '';
      var ok = '<i>输入正确</i>';
      var url = website + '';
      var sec = 90;
      var comtype = 'tg';
      var comid = '0';

      $('#btn_phone_code').click(function() {
        //获取手机验证码
        if (sec >= 90) {
          var phone = $('#user_phone').val();
          var r = checkstr(phone, 'phone');
          if (r) {
            var onurl = website + '';
            var v = getajax(onurl, {
              table: 'user',
              fd: 'user_phone',
              v: phone
            });
            if (v == '90') {
              alert('手机号已经存在');
              return false;
            }
            var url = website + '';
            var data = {
              phone: phone
            };
            $.post(url, data,
            function(s) {
              if (s == 0) {
                talert('验证码已经发送到手机上，请注意查收', 1);
                uptimephonecode();
              } else alert(s);
            });

          } else talert('请输入正确的手机号码');
        } else talert('请于' + sec + '秒以后重新获取');
      });
      function uptimephonecode() {
        if (sec <= 0) {
          sec = 90;
          $('#btn_phone_code').val('获取验证码');
        } else {
          sec--;
          $('#btn_phone_code').val(sec + 's后重新获取');
          setTimeout(uptimephonecode, 1000);
        }
      }

      // 幻灯片js
      jQuery(function() {
        jQuery(window).load(function() {
          var tupiankd = $("div.MN_mainimage img").height();
          $("div.MN_mainvisual,div.MN_mainimage,div.MN_mainimage ul,div.MN_mainimage ul li").css("height", tupiankd + 'px');
        });
      });

      $('#submit').click(function() {
        if (!ckusertname()) {
          alert(msg);
          $('#ZE_usertname').focus();
          return false;
        }
        if (!ckuserqq()) {
          alert(msg);
          $('#user_qq').focus();
          return false;
        }
        if (!ckuserwx()) {
          alert(msg);
          $('#aliwangwang').focus();
          return false;
        }
        if (!ckuserphone()) {
          alert(msg);
          $('#user_phone').focus();
          return false;
        }
        if (!ckuserpw()) {
          alert(msg);
          $('#user_pw').focus();
          return false;
        }
        if (!ckcpw()) {
          alert(msg);
          $('#cpw').focus();
          return false;
        }
        if (!cktjname()) {
          alert(msg);
          $('#ZE_usernametj').focus();
          return false;
        }
        return true;
      });
// 注册滚到指定地区

$(function(){
	function goto_top(){
		console.log('aa')
		$('html,body').animate({
			"scrollTop":768
			
		},300)
	}
	$('.BG_gongyongbg .BG_new').click(function(){
		goto_top();
	})         
})


