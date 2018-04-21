<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-06-09 09:30:52
         compiled from "D:\ServerWwwroot\www.lwm.com\admin\templates\wechat\wechatConfig.html" */ ?>
<?php /*%%SmartyHeaderCode:107295939fa4c5d4883-44646375%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6d9bdc116329b20a7b62f96ca3a690b23526af51' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\admin\\templates\\wechat\\wechatConfig.html',
      1 => 1496971488,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '107295939fa4c5d4883-44646375',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'cfg_soft_lang' => 0,
    'cssFile' => 0,
    'thumbSize' => 0,
    'thumbType' => 0,
    'adminPath' => 0,
    'token' => 0,
    'typeState' => 0,
    'typeStateChecked' => 0,
    'typeStateNames' => 0,
    'cfg_basehost' => 0,
    'wechatToken' => 0,
    'wechatAppid' => 0,
    'wechatAppsecret' => 0,
    'wechatName' => 0,
    'wechatCode' => 0,
    'wechatQr' => 0,
    'jsFile' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5939fa4c5ff812_85007436',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5939fa4c5ff812_85007436')) {function content_5939fa4c5ff812_85007436($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_radios')) include 'D:\\ServerWwwroot\\www.lwm.com\\include\\tpl\\plugins\\function.html_radios.php';
?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $_smarty_tpl->tpl_vars['cfg_soft_lang']->value;?>
" />
<title>微信基本设置</title>
<?php echo $_smarty_tpl->tpl_vars['cssFile']->value;?>

<?php echo '<script'; ?>
>
var thumbSize = <?php echo $_smarty_tpl->tpl_vars['thumbSize']->value;?>
, thumbType = "<?php echo $_smarty_tpl->tpl_vars['thumbType']->value;?>
";
var adminPath = "<?php echo $_smarty_tpl->tpl_vars['adminPath']->value;?>
", action = "wechat";
<?php echo '</script'; ?>
>
<style media="screen">
    .thead {margin: 20px 10px;}
    .weixinQr img{width: 94px; height: 94px; margin-left: -4px;}.editform dt{width: 180px;}.editform dt label.sl{margin-top: -10px;}.editform dt small{display: block; margin: -8px 12px 0 0;}.editform dt small i{font-style: normal;}
</style>
</head>

<body>
<div class="alert alert-success" style="margin:10px 10px 0;"><button type="button" class="close" data-dismiss="alert">×</button>微信配置教程：<a href="http://help.ikuman.cn/help-50-9.html" target="_blank">http://help.ikuman.cn/help-50-9.html</a></div>

<form action="" method="post" name="editform" id="editform" class="editform">
  <input type="hidden" name="token" id="token" value="<?php echo $_smarty_tpl->tpl_vars['token']->value;?>
" />
  <div class="thead" style="margin-top: 0;">&nbsp;&nbsp;服务器配置</div>
    <dl class="clearfix hide">
      <dt><label>登录确认：</label></dt>
      <dd class="radio">
        <?php echo smarty_function_html_radios(array('name'=>"wechatType",'values'=>$_smarty_tpl->tpl_vars['typeState']->value,'checked'=>$_smarty_tpl->tpl_vars['typeStateChecked']->value,'output'=>$_smarty_tpl->tpl_vars['typeStateNames']->value,'separator'=>"&nbsp;&nbsp;"),$_smarty_tpl);?>

      </dd>
    </dl>
    <dl class="clearfix">
      <dt><label>服务器URL：</label></dt>
      <dd style="padding-top: 10px;">
        <span style="font-size: 14px;"><?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
/api/weixin/</span>
      </dd>
    </dl>
    <dl class="clearfix">
      <dt><label for="wechatToken">服务器Token：</label></dt>
      <dd>
        <input class="input-xlarge" type="text" name="wechatToken" id="wechatToken" value="<?php echo $_smarty_tpl->tpl_vars['wechatToken']->value;?>
" data-regex=".*" />
        <span class="input-tips"><s></s>请输入服务器配置Token</span>
      </dd>
    </dl>
    <dl class="clearfix">
      <dt><label for="wechatAppid">开发者AppID：</label></dt>
      <dd>
        <input class="input-xlarge" type="text" name="wechatAppid" id="wechatAppid" value="<?php echo $_smarty_tpl->tpl_vars['wechatAppid']->value;?>
" data-regex=".*" />
        <span class="input-tips"><s></s>请输入开发者AppID</span>
      </dd>
    </dl>
    <dl class="clearfix">
      <dt><label for="wechatAppsecret">开发者AppSecret：</label></dt>
      <dd>
        <input class="input-xlarge" type="text" name="wechatAppsecret" id="wechatAppsecret" value="<?php echo $_smarty_tpl->tpl_vars['wechatAppsecret']->value;?>
" data-regex=".*" />
        <span class="input-tips"><s></s>请输入开发者AppSecret</span>
      </dd>
    </dl>
  <div class="thead" style="margin-top: 20px;">&nbsp;&nbsp;基本配置</div>
  <dl class="clearfix">
    <dt><label for="wechatName" class="sl">公众号名称：</label><small><i>{</i><i>#$</i>cfg_weixinName<i>#}</i></small></dt>
    <dd>
      <input class="input-xlarge" type="text" name="wechatName" id="wechatName" value="<?php echo $_smarty_tpl->tpl_vars['wechatName']->value;?>
" data-regex=".*" />
      <span class="input-tips"><s></s>请输入公众号名称</span>
    </dd>
  </dl>
  <dl class="clearfix">
    <dt><label for="wechatCode" class="sl">微信号：</label><small><i>{</i><i>#$</i>cfg_weixinCode<i>#}</i></small></dt>
    <dd>
      <input class="input-xlarge" type="text" name="wechatCode" id="wechatCode" value="<?php echo $_smarty_tpl->tpl_vars['wechatCode']->value;?>
" data-regex=".*" />
      <span class="input-tips"><s></s>请输入微信号</span>
    </dd>
  </dl>
  <dl class="clearfix">
    <dt><label class="sl">二维码：</label><small><i>{</i><i>#$</i>cfg_weixinQr<i>#}</i></small></dt>
    <dd class="weixinQr">
      <input name="wechatQr" type="hidden" id="wechatQr" value="<?php echo $_smarty_tpl->tpl_vars['wechatQr']->value;?>
" />
      <div class="spic<?php if ($_smarty_tpl->tpl_vars['wechatQr']->value=='') {?> hide<?php }?>">
        <div class="sholder"><?php if ($_smarty_tpl->tpl_vars['wechatQr']->value) {?><img src="/include/attachment.php?f=<?php echo $_smarty_tpl->tpl_vars['wechatQr']->value;?>
" /><?php }?></div>
        <a href="javascript:;" class="reupload"<?php if ($_smarty_tpl->tpl_vars['wechatQr']->value) {?> style="display: inline-block;"<?php }?>>重新上传</a>
      </div>
      <iframe src ="/include/upfile.inc.php?mod=siteConfig&type=card&obj=wechatQr" style="width:100%; height:25px;<?php if ($_smarty_tpl->tpl_vars['wechatQr']->value) {?> display:none;<?php }?>" scrolling="no" frameborder="0" marginwidth="0" marginheight="0" ></iframe>
    </dd>
  </dl>
  <dl class="clearfix formbtn">
    <dt>&nbsp;</dt>
    <dd>
        <input class="btn btn-large btn-success" type="submit" name="submit" id="btnSubmit" value="确认提交" />
    </dd>
  </dl>
</form>

<?php echo $_smarty_tpl->tpl_vars['jsFile']->value;?>

</body>
</html>
<?php }} ?>
