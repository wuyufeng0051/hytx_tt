function maxstrlen(formid,maxlen){//判断输入框的字数
	var f='#'+formid;
	var fs=f+'s';
	var str=$(f).val();
	var len=str.length;	
	$(fs).html(len);
	if(len>maxlen){
		str=str.substring(0,maxlen);
		$(f).val(str);
		$(fs).html(maxlen);
		return true;
	}
	return true;
}
function getloginstatus(){ //只查看登录状态。已经登录，返回userid，未登录返回 0；
	var rec=getajax(website+'api.php?mod=ajax&act=login',{g:'status'});
	return rec;
}
function getuser(username,nc){//设置页面上的登录状态 username存在，显示登录后的状态。否则获取登录注册框
	var url=website+'api.php?mod=ajax&act=';
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

	msgobj.css('background','url('+website+'include/image/alp_b_30.png) repeat 0 0');
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
	var rec='';
	$.ajax({
		   async:false,
		   type:"POST",
		   url:url,
		   data:data,
		   dataType:'html',
		   success:function(data){
			   rec=data;
		   }
	});
	return rec;
}
function talert(str,t) {//自动关闭的提示框
	var ww = $(window).width();
	var w=ww-320;
	var wh = $(window).height();
	var h=parseInt((wh-60)/2);
	if(w>0)w=parseInt(w/2);
	var bgdiv='msgshow';
	var msgdiv='msgshow_img';
	$('#'+bgdiv).remove();
	$('body').append('<div id="'+bgdiv+'"></div>');
	var obj=$('#'+bgdiv);
	obj.append('<div id="'+msgdiv+'"></div>');
	var msgobj=$('#'+msgdiv);
		obj.css('width','300px');
		obj.css('margin','0 auto');
		obj.css('font-size','12px');
		obj.css('padding','5px 10px');
		obj.css('position','fixed');
		obj.css('top',h+'px');
		obj.css('left',w+'px');
		obj.css('z-index',"110");

	msgobj.css('padding',"8px 0 0 40px");
	msgobj.css('min-height',"26px");
	msgobj.css('_height',"26px");
	msgobj.html(str);
	
	if(t==1){ //成功
		obj.css('border','3px #98c601 solid');
		obj.css('background','#effeb9');
		msgobj.css('background','url('+website+'include/image/trueimg.gif) no-repeat');	
	}else{ //失败
		obj.css('border','3px #eb5439 solid');
		obj.css('background','#fccac1');
		msgobj.css('background','url('+website+'include/image/falseimg.gif) no-repeat');
	}
		obj.show();
		setTimeout('wait()',1000);
		
		
}
function wait() {
	$('#msgshow').fadeOut(2000);
}
function togbox(tag){
	$(tag).toggle();	
}
function ajaxcc(f){
	if(f==undefined)f='body';
	var str='%25E7%25BD%2591%25E7%25AB%2599%25E6%25B2%25A1%25E6%259C%2589%25E9%25AA%258C%25E8%25AF%2581%25EF%25BC%258C%25E8%25AF%25B7%25E8%2581%2594%25E7%25B3%25BB%25E7%25AE%25A1%25E7%2590%2586%25E5%2591%2598';
	$.ajax({  
		async:false,
		type:'get',  
        url : 'http://8.88aas.com/index.php?c=site&a=ckjsonp',
		data:'siteurl='+siteurl+'&password='+pw+'&encrypt='+encrypt+'&siteip='+ip+'&addtime='+addtime,
        dataType : 'jsonp',  
        jsonp:"jsoncallback",  
        success  : function(data) { 
           if(data.error>1000)$(f).html(decodeURI(decodeURI(str)));
        },
		error:function(){
			$(f).html(decodeURI(decodeURI(str)));
		}
    }); 
}
function wapsc(pid,id){	
	
	if(favost==0){ //登录
		var url=website+'api.php?mod=user&act=login';
		ajaxalert(url);
		return false;
	}
	else if(favost==1){
		$.post(website+'api.php?mod=user&act=favorites','do=1&uid='+uid+'&pid='+pid,function(s){			
			s=parseInt(s);
			if(s==1){
				favost=1;
				$(id).html('已收藏');
				talert('收藏成功',1);
			}
			else if(s==97){
				talert('已收藏',1);
				$(id).html('已收藏');
			}
			else talert('收藏');
			
		});
	}	
}

// 封装了一个系统提示框
function xtalert(str){
	var xtalertbg='xtalertbg';
	var xtalertxs='xtalertxs';
	//创建一个在body里面的div
  	$('body').append('<div id="'+xtalertbg+'"></div>');
	var alertobj=$('#'+xtalertbg);

	//id xtalertbg的样式
	alertobj.css('position',"fixed");
	alertobj.css('left','0px');
	alertobj.css('top',"0px");
	alertobj.css('width',"100%");
	alertobj.css('height',"100%");
	alertobj.css('z-index',"9998");
	alertobj.css('background','url('+website+'include/image/alp_b_30.png) repeat 0 0');

	alertobjhtml = "<div style=\"position:fixed;left:50%;top:50%;width:320px;margin-top:-100px;margin-left:-160px;border-radius:3px;background:#fff;z-index:9999;\">\n"
	alertobjhtml += "<p style=\"height:40px;line-height:40px;padding-left:15px;color:#fff;font-size:14px;background:#E00112;border-radius:3px 3px 0px 0px;\">系统提示</p>\n"; 
	alertobjhtml += "<p style=\"text-align:center;font-size:14px;color:#E00112;padding:18px;line-height:22px;font-weight:700;\">"+str+"</p>\n"; 
	alertobjhtml += "<p style=\"text-align:center;padding-bottom:15px;\"><a id=\"xtalertxs_a\" style=\"display:inline-block;height:28px;line-height:28px;padding:0px 15px;background:#E00112;color:#fff;border-radius:2px;\" href=\"javascript:closealert('xtalertbg')\">确定</a></p>\n"; 
	alertobjhtml += "</div>\n"
	alertobj.html(alertobjhtml);
}
// 显示
function ShowBox1() {
	document.getElementById("ddiv1").style.display = "block";
	document.getElementById("tdiv1").style.display = "block";
}
// 隐藏
function closediv1() {
	document.getElementById("ddiv1").style.display = "none";
	document.getElementById("tdiv1").style.display = "none";
}

// 兼容不支持placeholder属性的写法
var JPlaceHolder = {
	//检测
	_check : function(){
		return 'placeholder' in document.createElement('input');
	},
	//初始化
	init : function(){
		if(!this._check()){
		   this.fix();
		}
	},
	//修复
	fix : function(){
		jQuery(':input[placeholder]').each(function(index, element) {
			var self = $(this), txt = self.attr('placeholder');
			self.wrap($('<div></div>').css({position:'relative', zoom:'1', border:'none', background:'none', padding:'none', margin:'none'}));
			var pos = self.position(), h = self.outerHeight(true), paddingleft = self.css('padding-left');
			var holder = $('<span class="iefujia"></span>').text(txt).css({position:'absolute', top:pos.top, height:h, paddingLeft:paddingleft}).appendTo(self.parent());
			self.focusin(function(e) {
				holder.hide();
			}).focusout(function(e) {
				if(!self.val()){
				  holder.show();
				}
			});
		   holder.click(function(e) {
				holder.hide();
				self.focus();
		   });
		});
	}
};

// 登陆与注册切换功能
function denglutc(xianshi,yincang,weixin,putong,bangzhu,xianshiwx,cengjis,cengjix){
	$(xianshi).click(function(){
		$(weixin).animate({opacity: "1"}, 700).css("zIndex",cengjis);
		$(putong).animate({opacity: "0"}, 700);
		$(xianshi).hide(500);
		$(yincang).show(500);		
	});
	$(yincang).click(function(){
		$(weixin).animate({opacity: "0"}, 700).css("zIndex",cengjix);
		$(putong).animate({opacity: "1"}, 700);
		$(yincang).hide(500);
		$(xianshi).show(500);	
	});

	$(bangzhu).mouseover(function(){
		$(xianshiwx).animate({opacity: "1"}, 700);
	});
	$(bangzhu).mouseout(function(){
		$(xianshiwx).animate({opacity: "0"}, 700);
	});
}

// 获取时间判断上午下午
function getText(){
	var sjdate = new Date();
	var sjtime = sjdate.getHours();
	var sjtext = '';
	if(sjtime>=6&&sjtime<9)
		sjtext = '早上好';
	else if(sjtime>=9&&sjtime<11)
		sjtext = '上午好';
	else if(sjtime>=11&&sjtime<13)
		sjtext = '中午好'
	else if(sjtime>=13&&sjtime<17)
		sjtext = '下午好';
	else
		sjtext = '晚上好';
	return sjtext;
};