function istaocan(id){
	var obj=$('#'+id);
	$('#productid').val(id);//套餐id
	$('#showtaocanscj').html(obj.attr('alt'));//更新市场价
	$('#cost_yh').html(obj.val());//优惠后价格
	$('#kcnum').html(obj.attr('data'));//库存数量
	$('#productmoney').val(obj.attr('title'));//购买价
	upnum();			
	showfee();	
}

function delnum(){	
	var fid=$('#nownum');
	var nownum=fid.val();
	if(nownum>1){
		nownum--;
		fid.val(nownum);
	}
}

function addnum(){	
	var kcnum=parseInt($('#kcnum').html());
	var fid=$('#nownum');
	var nownum=fid.val();
	if(nownum<kcnum){
		nownum++;
		fid.val(nownum);
	}
}

function upnum(){
	var kcnum=parseInt($('#kcnum').html());
	var nownum=parseInt($('#nownum').val());
	if(nownum<1)$('#nownum').val(1);
	else if(nownum>kcnum)$('#nownum').val(kcnum);	
}

function chtab(i){ //产品详情等标签切换
	$('#dgtab .tab:eq('+i+')').addClass('chanpinxq_bs').siblings().removeClass('chanpinxq_bs');
	if(i==0){
		$('#cont').show();
		$('#buy').hide();
		$('#shouhou').hide();
	}
	else if(i==1){	
		if(package_num<1)$('#buy').html('无库存');
		$('#cont').hide();
		$('#buy').show();
		$('#shouhou').hide();
	}else{
		var url=website+'api.php?mod=ajaxp&act=page&id='+pid;
		showhtml('shouhou',url);
		$('#cont').hide();
		$('#buy').hide();
		$('#shouhou').show();
	}
}

function showfee(){
	ps=parseInt(getpostfee($('#area_a').val()));
	num=parseInt($('#nownum').val());//购买数量
	yhj=parseInt($('#cost_yh').html()*100)/100;//优惠后单价
	r=parseInt(yhj*num*100)/100;
	$('#profee').html(r);
	
	// 判断是否免邮
	if(youfei_baoyou != 0 && r > youfei_baoyou){
		$('#postfeeval').val('0');
		$('#postfee').html('0');
		$('#tolfee').html(r);// 优惠以后总价
	}else if(youfei_free == 9){
		$('#postfeeval').val('0');
		$('#postfee').html('0');
		$('#tolfee').html(r);// 优惠以后总价
	}else{
		$('#postfeeval').val(ps);
		$('#postfee').html(ps);
		$('#tolfee').html(r+ps);// 优惠以后总价
	}
}

function getpostfee(areaid){ // ajax获取邮费
	var rec=10;
	if(areaid<1)return 0;
	$.ajax({
		type:"POST",
		url:website+'api.php?mod=order&act=postfee',
		data:'areaid='+areaid,
		dataType:"text",
		async:false,
		success:function(d){
			rec=d;
		}
	});
	return rec;
}

function setthumb(){
	var w=$('#pthumb').width();
	var h=$('#pthumb').height();
	var t=0;
	if(w>h){
		if(w>280){
			$('#pthumb').width(280);
			h=$('#pthumb').height();	
		}
		t=(280-h)/2;
		$('#pthumb').css('margin-top',t+'px'); 
	}else{
		if(h>280)$('#pthumb').height(280);
		else{
			t=(280-h)/2;
			$('#pthumb').css('margin-top',t+'px'); 
		}
	}
}

// 校验qq号码输入是否符合规则
function ckuserqq(){	
	var res=1;
	msg='正在输入...';
	var str=$('#user_qq').val();
	var r=checkstr(str,'qq');
	if (str=='') {
		msg='请填写您的QQ号';
		res=0;
	}
	if(r){
		var onurl=website+'api.php?mod=ajax&act=checkonly';
		if(typeof userid == 'undefined'){
			r=getajax(onurl,{table:'user',fd:'user_qq',v:str});
		}
		else{
			r=getajax(onurl,{table:'user',fd:'user_qq',v:str,fdid:'user_id',id:userid});
		}
		if(r=='90'){
			msg='QQ号码已经存在';
			res=0;
		}else if(r!='99'){
			msg='核查失败,请刷新';
			res=0;
		}	
	}else res=0;
	return res;
}

function ckusertname(){
	var res=1;
	msg='正在输入...';
	var r=checkstr($('#user_tname').val(),'chinese');
	var str=$("#user_tname").val();
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
		var onurl=website+'api.php?mod=ajax&act=checkonly'; 
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
	var onurl=website+'api.php?mod=ajax&act=checkonly';
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
	var onurl=website+'api.php?mod=ajax&act=checkonly';
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
	var str=$('#user_name_tj').val();msg='输入正确';
	var r=checkstr(str,'tjusername');
	var onurl=website+'api.php?mod=ajax&act=checkonly';
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
	$('#regmenu_poptip01').show();
	$('#user_qqs').html('正在输入...');						  
});
$('#user_qq').blur(function(){
	$('#regmenu_poptip01').hide();
});

$('#user_tname').focus(function(){
	$('#regmenu_poptip02').show();
	$('#user_tnames').html('正在输入...');						  
});
$('#user_tname').blur(function(){
	$('#regmenu_poptip02').hide();
});

$('#aliwangwang').focus(function(){
	$('#regmenu_poptip03').show();
	$('#aliwangwangs').html('正在输入...');						  
});
$('#aliwangwang').blur(function(){
	$('#regmenu_poptip03').hide();
});

$('#user_pw').focus(function(){
	$('#regmenu_poptip04').show();
	$('#user_pws').html('正在输入...');						  
});
$('#user_pw').blur(function(){
	$('#regmenu_poptip04').hide();
});

$('#cpw').focus(function(){
	$('#regmenu_poptip05').show();
	$('#cpws').html('正在输入...');						  
});
$('#cpw').blur(function(){
	$('#regmenu_poptip05').hide();
});

$('#user_phone').focus(function(){
	$('#regmenu_poptip06').show();
	$('#user_phones').html('正在输入...');						  
});
$('#user_phone').blur(function(){
	$('#regmenu_poptip06').hide();
});

$('#user_name_tj').focus(function(){
	$('#regmenu_poptip09').show();
	$('#tjnames').html('正在输入...');						  
});
$('#user_name_tj').blur(function(){
	$('#regmenu_poptip09').hide();
});

// 监听输入是否正确并提示  下面的写法不支持ie8
function Inputqq(event){
   ckuserqq();$('#user_qqs').html(msg);
}

function Inputtname(event){
   ckusertname();$('#user_tnames').html(msg);
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
      ckusertname();$('#user_tnames').html(msg);
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
	var url=website+'api.php?mod=ajax&act=ecimgcode';		//ajax方式获取数据
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
	var url=website+'api.php?mod=order&act=getarea';
	showfee();
	aid=$("#area_a").val();
	showhtml('area_as',url,{aid:aid});
}

function showb(){
	var bid=$("#area_b").val();
	var url=website+'api.php?mod=order&act=getarea';
	showhtml('area_bs',url,{bid:bid});
}