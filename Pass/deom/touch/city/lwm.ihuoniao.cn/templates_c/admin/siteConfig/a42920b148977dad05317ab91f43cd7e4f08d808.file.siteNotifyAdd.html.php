<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-05-25 15:40:12
         compiled from "D:\ServerWwwroot\www.lwm.com\admin\templates\siteConfig\siteNotifyAdd.html" */ ?>
<?php /*%%SmartyHeaderCode:619359268a5c9dbee1-25632994%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a42920b148977dad05317ab91f43cd7e4f08d808' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\admin\\templates\\siteConfig\\siteNotifyAdd.html',
      1 => 1494490283,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '619359268a5c9dbee1-25632994',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'cfg_soft_lang' => 0,
    'pagetitle' => 0,
    'cssFile' => 0,
    'adminPath' => 0,
    'dopost' => 0,
    'id' => 0,
    'token' => 0,
    'title' => 0,
    'system' => 0,
    'email_state' => 0,
    'email_title' => 0,
    'email_body' => 0,
    'sms_state' => 0,
    'sms_tempid' => 0,
    'sms_body' => 0,
    'wechat_state' => 0,
    'wechat_tempid' => 0,
    'wechat_body' => 0,
    'site_state' => 0,
    'site_title' => 0,
    'site_body' => 0,
    'app_state' => 0,
    'app_title' => 0,
    'app_body' => 0,
    'state' => 0,
    'jsFile' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_59268a5ca2df74_60299566',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59268a5ca2df74_60299566')) {function content_59268a5ca2df74_60299566($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $_smarty_tpl->tpl_vars['cfg_soft_lang']->value;?>
" />
<title><?php echo $_smarty_tpl->tpl_vars['pagetitle']->value;?>
</title>
<?php echo $_smarty_tpl->tpl_vars['cssFile']->value;?>

<?php echo '<script'; ?>
>
var adminPath = "<?php echo $_smarty_tpl->tpl_vars['adminPath']->value;?>
";
<?php echo '</script'; ?>
>
</head>

<body>
<form action="" method="post" name="editform" id="editform" class="editform">
  <input type="hidden" name="dopost" id="dopost" value="<?php echo $_smarty_tpl->tpl_vars['dopost']->value;?>
" />
  <input type="hidden" name="id" id="id" value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" />
  <input type="hidden" name="token" id="token" value="<?php echo $_smarty_tpl->tpl_vars['token']->value;?>
" />
  <dl class="clearfix">
    <dt><label for="title">消息名称：</label></dt>
    <dd>
      <input class="input-xlarge" type="text" name="title" id="title" data-regex=".{1,}" value="<?php echo $_smarty_tpl->tpl_vars['title']->value;?>
"<?php if ($_smarty_tpl->tpl_vars['system']->value==1) {?> readonly<?php }?> />
      <span class="input-tips"><s></s>请输入消息名称</span>
    </dd>
  </dl>
  <dl class="clearfix">
    <dt>通知方式：</dt>
    <dd>
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab0">电子邮件</a></li>
            <li><a href="#tab1">手机短信</a></li>
            <li><a href="#tab2">微信公众号</a></li>
            <li><a href="#tab3">网页即时消息</a></li>
            <li><a href="#tab4">APP推送</a></li>
        </ul>
        <div class="tagsList">
            <div class="tag-list" id="tab0">
                <dl class="clearfix">
                  <dt><label for="email_state">状态：</label></dt>
                  <dd class="radio">
                    <label><input type="checkbox" id="email_state" name="email_state" value="1"<?php if ($_smarty_tpl->tpl_vars['email_state']->value==1) {?> checked<?php }?> /> 启用</label>
                  </dd>
                </dl>
                <dl class="clearfix">
                  <dt><label for="email_title">邮件标题：</label></dt>
                  <dd>
                    <input class="input-xxlarge" type="text" name="email_title" id="email_title" value="<?php echo $_smarty_tpl->tpl_vars['email_title']->value;?>
" />
                  </dd>
                </dl>
                <dl class="clearfix">
                  <dt><label for="email_body">邮件模板：</label></dt>
                  <dd>
                    <textarea name="email_body" id="email_body" class="input-xxlarge" rows="10"><?php echo $_smarty_tpl->tpl_vars['email_body']->value;?>
</textarea>
                  </dd>
                </dl>
            </div>
            <div class="tag-list hide" id="tab1">
                <dl class="clearfix">
                  <dt><label for="sms_state">状态：</label></dt>
                  <dd class="radio">
                    <label><input type="checkbox" id="sms_state" name="sms_state" value="1"<?php if ($_smarty_tpl->tpl_vars['sms_state']->value==1) {?> checked<?php }?> /> 启用</label>
                  </dd>
                </dl>
                <dl class="clearfix">
                  <dt><label for="sms_tempid">平台模板ID：</label></dt>
                  <dd>
                    <input class="input-xlarge" type="text" name="sms_tempid" id="sms_tempid" value="<?php echo $_smarty_tpl->tpl_vars['sms_tempid']->value;?>
" />
                    &nbsp;&nbsp;<a href="http://help.ikuman.cn/help-48-6.html" target="_blank">配置教程</a>
                  </dd>
                </dl>
                <dl class="clearfix">
                  <dt><label for="sms_body">短信模板：</label></dt>
                  <dd>
                    <textarea name="sms_body" id="sms_body" class="input-xxlarge" rows="10"><?php echo $_smarty_tpl->tpl_vars['sms_body']->value;?>
</textarea>
                  </dd>
                </dl>
            </div>
            <div class="tag-list hide" id="tab2">
                <dl class="clearfix">
                  <dt><label for="wechat_state">状态：</label></dt>
                  <dd class="radio">
                    <label><input type="checkbox" id="wechat_state" name="wechat_state" value="1"<?php if ($_smarty_tpl->tpl_vars['wechat_state']->value==1) {?> checked<?php }?> /> 启用</label>
                  </dd>
                </dl>
                <dl class="clearfix">
                  <dt><label for="wechat_tempid">微信模板ID：</label></dt>
                  <dd>
                    <input class="input-xxlarge" type="text" name="wechat_tempid" id="wechat_tempid" value="<?php echo $_smarty_tpl->tpl_vars['wechat_tempid']->value;?>
" />
                    &nbsp;&nbsp;<a href="http://help.ikuman.cn/help-48-7.html" target="_blank">配置教程</a>
                  </dd>
                </dl>
                <dl class="clearfix">
                  <dt><label for="wechat_body">微信模板配置：</label></dt>
                  <dd>
                    <textarea name="wechat_body" id="wechat_body" class="input-xxlarge" rows="10"><?php echo $_smarty_tpl->tpl_vars['wechat_body']->value;?>
</textarea>
                  </dd>
                </dl>
            </div>
            <div class="tag-list hide" id="tab3">
                <dl class="clearfix">
                  <dt><label for="site_state">状态：</label></dt>
                  <dd class="radio">
                    <label><input type="checkbox" id="site_state" name="site_state" value="1"<?php if ($_smarty_tpl->tpl_vars['site_state']->value==1) {?> checked<?php }?> /> 启用</label>
                  </dd>
                </dl>
                <dl class="clearfix">
                  <dt><label for="site_title">消息标题：</label></dt>
                  <dd>
                    <input class="input-xxlarge" type="text" name="site_title" id="site_title" value="<?php echo $_smarty_tpl->tpl_vars['site_title']->value;?>
" />
                  </dd>
                </dl>
                <dl class="clearfix">
                  <dt><label for="site_body">消息内容：</label></dt>
                  <dd>
                    <textarea name="site_body" id="site_body" class="input-xxlarge" rows="10"><?php echo $_smarty_tpl->tpl_vars['site_body']->value;?>
</textarea>
                  </dd>
                </dl>
            </div>
            <div class="tag-list hide" id="tab4">
                <dl class="clearfix">
                  <dt><label for="app_state">状态：</label></dt>
                  <dd class="radio">
                    <label><input type="checkbox" id="app_state" name="app_state" value="1"<?php if ($_smarty_tpl->tpl_vars['app_state']->value==1) {?> checked<?php }?> /> 启用</label>
                  </dd>
                </dl>
                <dl class="clearfix">
                  <dt><label for="app_title">推送标题：</label></dt>
                  <dd>
                    <input class="input-xxlarge" type="text" name="app_title" id="app_title" value="<?php echo $_smarty_tpl->tpl_vars['app_title']->value;?>
" />
                  </dd>
                </dl>
                <dl class="clearfix">
                  <dt><label for="app_body">推送内容：</label></dt>
                  <dd>
                    <textarea name="app_body" id="app_body" class="input-xxlarge" rows="10"><?php echo $_smarty_tpl->tpl_vars['app_body']->value;?>
</textarea>
                  </dd>
                </dl>
            </div>
        </div>
    </dd>
  </dl>
  <dl class="clearfix">
    <dt><label for="state">状态：</label></dt>
    <dd class="radio">
      <label><input type="checkbox" id="state" name="state" value="1"<?php if ($_smarty_tpl->tpl_vars['state']->value==1) {?> checked<?php }?> /> 启用</label>
    </dd>
  </dl>
  <dl class="clearfix formbtn">
    <dt>&nbsp;</dt>
    <dd><button class="btn btn-large btn-success" type="submit" name="button" id="btnSubmit">确认提交</button></dd>
  </dl>
  <dl class="clearfix" style="margin-top: 50px;">
    <dt>系统公共参数：</dt>
    <dd class="systemLabel">
        <div class="input-prepend input-append">
          <span class="add-on">网站域名：</span>
          <input class="span2" disabled style="cursor: text; background: #fff;" type="text" value="$basehost">
        </div>
        <div class="input-prepend input-append">
          <span class="add-on">网站名称：</span>
          <input class="span2" disabled style="cursor: text; background: #fff;" type="text" value="$webname">
        </div>
        <div class="input-prepend input-append">
          <span class="add-on">网站简称：</span>
          <input class="span2" disabled style="cursor: text; background: #fff;" type="text" value="$shortname">
        </div>
        <div class="input-prepend input-append">
          <span class="add-on">网站Logo：</span>
          <input class="span2" disabled style="cursor: text; background: #fff;" type="text" value="$weblogo">
        </div><br />
        <div class="input-prepend input-append">
          <span class="add-on">400电话：</span>
          <input class="span2" disabled style="cursor: text; background: #fff;" type="text" value="$hotline">
        </div>
        <div class="input-prepend input-append">
          <span class="add-on">当前时间：</span>
          <input class="span2" disabled style="cursor: text; background: #fff;" type="text" value="$time">
        </div>
        <div class="input-prepend input-append">
          <span class="add-on">验证码：</span>
          <input class="span2" disabled style="cursor: text; background: #fff;" type="text" value="$code">
        </div>
        <div class="input-prepend input-append">
          <span class="add-on">用户名：</span>
          <input class="span2" disabled style="cursor: text; background: #fff;" type="text" value="$username">
        </div><br />
        <div class="input-prepend input-append">
          <span class="add-on">信息标题：</span>
          <input class="span2" disabled style="cursor: text; background: #fff;" type="text" value="$title">
        </div>
        <div class="input-prepend input-append">
          <span class="add-on">信息URL：</span>
          <input class="span2" disabled style="cursor: text; background: #fff;" type="text" value="$url">
        </div>
        <div class="input-prepend input-append">
          <span class="add-on">状态：</span>
          <input class="span2" disabled style="cursor: text; background: #fff;" type="text" value="$status">
        </div>

        <br />
        <p class="text-warning"><small>请根据实际情况使用系统公共参数！</small></p>
    </dd>
  </dl>
</form>

<?php echo $_smarty_tpl->tpl_vars['jsFile']->value;?>

</body>
</html>
<?php }} ?>
