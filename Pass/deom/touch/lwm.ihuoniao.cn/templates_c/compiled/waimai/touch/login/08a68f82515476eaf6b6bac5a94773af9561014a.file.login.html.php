<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-06-15 18:33:58
         compiled from "D:\ServerWwwroot\www.lwm.com\templates\courier\login.html" */ ?>
<?php /*%%SmartyHeaderCode:58059291850bcf6d5-30298403%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '08a68f82515476eaf6b6bac5a94773af9561014a' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\templates\\courier\\login.html',
      1 => 1496991959,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '58059291850bcf6d5-30298403',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_59291850bdb257_20239876',
  'variables' => 
  array (
    'cfg_staticPath' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59291850bdb257_20239876')) {function content_59291850bdb257_20239876($_smarty_tpl) {?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=0">
<title>配送员登录</title>
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
css/core/touchBase.css">
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
js/core/touchScale.js?v=33"><?php echo '</script'; ?>
>
<style media="screen">
body {padding-top: 2rem;}
.waiMai{height:1rem;background: #4caf50;line-height: 1rem;text-align: center;position: fixed;top: 0;right: 0;left: 0;z-index: 99;}
.waiMai p{color: #fff;font-size:0.4rem;}

/*logo*/
.logo{width: 100%;padding: .8rem 0;  text-align: center; font-size: .6rem; color: #4caf50; font-weight: 700;}
.form-box {padding: 0 5%;}
.form-box input{display: block;width: 5rem;padding: .3rem;border: none;font-size: .28rem;line-height: .4rem;-webkit-appearance: none; border-radius: 0; margin-left: .8rem;}
.form-box input.password{border-bottom: none;}
.form-box form{position: relative;}
.login-btn{margin-top: 1rem;}
.login-btn input{display: block;width: 100%;height: .9rem;color: #fff;background: #4caf50;margin: 0 auto;border-radius: .06rem;font-size: .28rem;text-align: center;line-height: .9rem;-webkit-appearance: none; padding: 0;}
.find-btn{text-align: center;font-size: .28rem;margin-top: .4rem;}
.form-newpw{display: -webkit-box;}
.form-newpw input.password{-webkit-box-flex: 1;}
.form-newpw a{display: table-cell;vertical-align: middle;height: 1rem;padding: 0 .4rem;background: #fff url(/static/images/courier/eye2.png) center center no-repeat;background-size: auto .3rem;}
.form-newpw a.show{background: #fff url(/static/images/courier/eye1.png) center center no-repeat;background-size: auto .3rem;}
.form-newpw.bb {border-bottom: 1px solid #e6e6e8;}

.inpbox{position: relative; border: 1px solid #e6e6e8; margin-bottom: .2rem;}
.inpbox .icon{position: absolute; width: .8rem; height: 1rem;}
.inpbox .icon1{background: #fff url(/static/images/courier/login_icon1.png) center center no-repeat; background-size: .4rem auto;}
.inpbox .icon2{background: #fff url(/static/images/courier/login_icon2.png) center center no-repeat; background-size: .4rem auto;}
</style>
</head>

<body>
<div class="waiMai">
    <p>配送员登录</p>
</div>
<div class="container">
    <div class="form-box">
        <form id="loginForm" action="">
            <div class="inpbox">
                <i class="icon icon1"></i>
                <input type="text" name="username" placeholder="用户名" class="phone">
            </div>
            <div class="form-newpw inpbox">
                <i class="icon icon2"></i>
                <input type="password" name="password" placeholder="密码" class="password">
                <a href="javascript:;" class="psw_img"></a>
            </div>
            <div class="login-btn"><input type="submit" value="登录"></div>
        </form>
    </div>
</div>

<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
js/core/zepto.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript">
$(function(){

    var user = $.cookie("lwm_courier_user");
    var pass = $.cookie("lwm_courier_pass");

    if(user){
        $(".phone").val(user);
    }
    if(pass){
        $(".password").val(pass);
    }

	$("#loginForm").submit(function(event){
		event.preventDefault();
		$('.login-btn input').click();
	});

	$('.login-btn input').click(function(){
		var btn      = $(this);
		var number   = $('.phone').val();
		var password = $('.password').val();

		if(number == ''){
			alert('请输入用户名');
			return false;
		}

		if(password == ''){
			alert('请输入密码~');
			return false;
		}

		btn.attr("disabled", true).val('登录中...');
		var data = [];
		data.push("username="+number);
		data.push("password="+password);

		//异步提交
		$.ajax({
			url: "/include/ajax.php?service=waimai&action=courierLogin",
			data: data.join("&"),
			type: "POST",
			dataType: "json",
			success: function (data) {
				if(data){
					if(data.state == 100){

                        $.cookie("lwm_courier_user", number, {expires: 365, path: '/'});
                        $.cookie("lwm_courier_pass", password, {expires: 365, path: '/'});

                        location.href = "/?service=waimai&do=courier&template=index";
					}else{
                        alert(data.info);
    					btn.removeAttr("disabled").val('登录');
					}
				}else{
					alert("登录失败，请重试！");
					btn.removeAttr("disabled").val('登录');
				}
			},
			error: function(){
				alert("网络错误，登录失败！");
				btn.removeAttr("disabled").val('登录');
			}
		});

	})


	// 密码可见不可见
	$('.psw_img').click(function(){
		if ($(".password").attr("type") == "password") {
			var $t = $(this);
			$t.addClass('show');
			$(".password").attr("type", "text");
		}else{
			$('.psw_img').removeClass('show');
			$(".password").attr("type", "password");
		}
	})


})
<?php echo '</script'; ?>
>
</body>
</html>
<?php }} ?>
