<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-06-21 19:24:46
         compiled from "D:\ServerWwwroot\www.lwm.com\admin\templates\app\appConfig.html" */ ?>
<?php /*%%SmartyHeaderCode:2242859155f7a8a3ca4-80188151%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3ebadf8a28613b7626f6d195ecfc437a0f546352' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\admin\\templates\\app\\appConfig.html',
      1 => 1498044234,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2242859155f7a8a3ca4-80188151',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_59155f7a924b45_47215998',
  'variables' => 
  array (
    'cfg_soft_lang' => 0,
    'cssFile' => 0,
    'adminPath' => 0,
    'android_guide' => 0,
    'ios_guide' => 0,
    'token' => 0,
    'android_version' => 0,
    'ios_version' => 0,
    'logo' => 0,
    'cfg_attachment' => 0,
    'android_download' => 0,
    'ios_download' => 0,
    'atlasType' => 0,
    'ad_pic' => 0,
    'ad_link' => 0,
    'ad_time' => 0,
    'android_index' => 0,
    'cfg_basehost' => 0,
    'ios_index' => 0,
    'map_baidu_android' => 0,
    'map_baidu_ios' => 0,
    'map_set' => 0,
    'map_google' => 0,
    'jsFile' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59155f7a924b45_47215998')) {function content_59155f7a924b45_47215998($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_replace')) include 'D:\\ServerWwwroot\\www.lwm.com\\include\\tpl\\plugins\\modifier.replace.php';
?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $_smarty_tpl->tpl_vars['cfg_soft_lang']->value;?>
" />
<title>APP基本设置</title>
<?php echo $_smarty_tpl->tpl_vars['cssFile']->value;?>

<?php echo '<script'; ?>
>
var adminPath = "<?php echo $_smarty_tpl->tpl_vars['adminPath']->value;?>
";
var imglist = {
    "android_guide": <?php echo $_smarty_tpl->tpl_vars['android_guide']->value;?>
,
    "ios_guide": <?php echo $_smarty_tpl->tpl_vars['ios_guide']->value;?>

};
<?php echo '</script'; ?>
>
<style media="screen">
    .editform dt {width: 200px;}
</style>
</head>

<body>
<form action="appConfig.php" method="post" name="editform" id="editform" class="editform">
  <input type="hidden" name="token" id="token" value="<?php echo $_smarty_tpl->tpl_vars['token']->value;?>
" />
  <dl class="clearfix">
    <dt><label>最新版本：</label></dt>
    <dd class="clearfix">
		<div class="input-prepend">
          <span class="add-on">Android：</span>
          <input class="span2" id="android_version" name="android_version" type="text" value="<?php echo $_smarty_tpl->tpl_vars['android_version']->value;?>
" />
        </div>
		<div class="input-prepend">
          <span class="add-on">iOS：</span>
          <input class="span2" id="ios_version" name="ios_version" type="text" value="<?php echo $_smarty_tpl->tpl_vars['ios_version']->value;?>
" />
        </div>
	</dd>
  </dl>
  <dl class="clearfix">
    <dt><label>LOGO：<br /><small>尺寸：180*180</small>&nbsp;&nbsp;&nbsp;</label></dt>
    <dd class="thumb clearfix listImgBox">
		<div class="uploadinp filePicker thumbtn<?php if ($_smarty_tpl->tpl_vars['logo']->value!='') {?> hide<?php }?>" id="filePicker3" data-type="logo" data-count="1" data-size="5120" data-imglist=""><div></div><span></span></div>
        <?php if ($_smarty_tpl->tpl_vars['logo']->value!='') {?>
		<ul id="listSection3" class="listSection thumblist clearfix" style="display:inline-block;"><li id="WU_FILE_0_1"><a href='<?php echo $_smarty_tpl->tpl_vars['cfg_attachment']->value;
echo $_smarty_tpl->tpl_vars['logo']->value;?>
' target="_blank" title=""><img style="max-width: 150px;" alt="" src="<?php echo $_smarty_tpl->tpl_vars['cfg_attachment']->value;
echo $_smarty_tpl->tpl_vars['logo']->value;?>
" data-val="<?php echo $_smarty_tpl->tpl_vars['logo']->value;?>
"/></a><a class="reupload li-rm" href="javascript:;">删除图片</a></li></ul>
		<?php } else { ?>
		<ul id="listSection3" class="listSection thumblist clearfix"></ul>
		<?php }?>
		<input type="hidden" name="logo" value="" class="imglist-hidden" id="logo">
	</dd>
  </dl>
  <dl class="clearfix">
    <dt><label for="android_download">Android安装包下载地址：</label></dt>
    <dd><input class="input-xxlarge" type="text" name="android_download" id="android_download" value="<?php echo $_smarty_tpl->tpl_vars['android_download']->value;?>
" /></dd>
  </dl>
  <dl class="clearfix">
    <dt><label for="ios_download">iOS安装包下载地址：</label></dt>
    <dd><input class="input-xxlarge" type="text" name="ios_download" id="ios_download" value="<?php echo $_smarty_tpl->tpl_vars['ios_download']->value;?>
" /></dd>
  </dl>
  <dl class="clearfix">
    <dt><label>Android引导页：<br /><small>尺寸：720*1280</small>&nbsp;&nbsp;&nbsp;</label></dt>
    <dd class="listImgBox hide">
		<div class="list-holder">
			<ul id="listSection0" class="clearfix listSection piece"></ul>
			<input type="hidden" name="android_guide" value='<?php echo $_smarty_tpl->tpl_vars['android_guide']->value;?>
' class="imglist-hidden">
		</div>
		<div class="btn-section clearfix">
			<div class="uploadinp filePicker" id="filePicker0" data-type="single" data-count="10" data-size="5120" data-imglist="android_guide"><div id="flasHolder0"></div><span>添加图片</span></div>
			<div class="upload-tip">
				<p><a href="javascript:;" class="hide deleteAllAtlas">删除所有</a>&nbsp;&nbsp;<?php echo smarty_modifier_replace(smarty_modifier_replace($_smarty_tpl->tpl_vars['atlasType']->value,"*.",''),";","、");?>
&nbsp;&nbsp;单张最大5M<span class="fileerror"></span></p>
			</div>
		</div>
	</dd>
  </dl>
  <dl class="clearfix">
    <dt><label>iOS引导页：<br /><small>尺寸：750*1334</small>&nbsp;&nbsp;&nbsp;</label></dt>
    <dd class="listImgBox hide">
		<div class="list-holder">
			<ul id="listSection1" class="clearfix listSection piece"></ul>
			<input type="hidden" name="ios_guide" value='<?php echo $_smarty_tpl->tpl_vars['ios_guide']->value;?>
' class="imglist-hidden">
		</div>
		<div class="btn-section clearfix">
			<div class="uploadinp filePicker" id="filePicker1" data-type="single" data-count="10" data-size="5120" data-imglist="ios_guide"><div id="flasHolder1"></div><span>添加图片</span></div>
			<div class="upload-tip">
				<p><a href="javascript:;" class="hide deleteAllAtlas">删除所有</a>&nbsp;&nbsp;<?php echo smarty_modifier_replace(smarty_modifier_replace($_smarty_tpl->tpl_vars['atlasType']->value,"*.",''),";","、");?>
&nbsp;&nbsp;单张最大5M<span class="fileerror"></span></p>
			</div>
		</div>
	</dd>
  </dl>
  <dl class="clearfix">
    <dt><label>广告页：<br /><small>尺寸：640*1136</small>&nbsp;&nbsp;&nbsp;</label></dt>
    <dd class="thumb clearfix listImgBox">
		<div class="uploadinp filePicker thumbtn<?php if ($_smarty_tpl->tpl_vars['ad_pic']->value!='') {?> hide<?php }?>" id="filePicker2" data-type="card" data-count="1" data-size="5120" data-imglist=""><div></div><span></span></div>
        <?php if ($_smarty_tpl->tpl_vars['ad_pic']->value!='') {?>
		<ul id="listSection2" class="listSection thumblist clearfix" style="display:inline-block;"><li id="WU_FILE_0_1"><a href='<?php echo $_smarty_tpl->tpl_vars['cfg_attachment']->value;
echo $_smarty_tpl->tpl_vars['ad_pic']->value;?>
' target="_blank" title=""><img style="max-width: 150px;" alt="" src="<?php echo $_smarty_tpl->tpl_vars['cfg_attachment']->value;
echo $_smarty_tpl->tpl_vars['ad_pic']->value;?>
" data-val="<?php echo $_smarty_tpl->tpl_vars['ad_pic']->value;?>
"/></a><a class="reupload li-rm" href="javascript:;">删除图片</a></li></ul>
		<?php } else { ?>
		<ul id="listSection2" class="listSection thumblist clearfix"></ul>
		<?php }?>
		<input type="hidden" name="ad_pic" value="" class="imglist-hidden" id="ad_pic">
        <br /><br />
        <input class="input-xxlarge" type="text" name="ad_link" id="ad_link" value="<?php echo $_smarty_tpl->tpl_vars['ad_link']->value;?>
" placeholder="广告链接，留空表示没有链接" />
        <div class="input-prepend input-append" style="display: block; margin-top: 15px;">
          <span class="add-on">广告倒计时</span>
          <input class="span1" id="ad_time" name="ad_time" type="number" min="1" value="<?php echo $_smarty_tpl->tpl_vars['ad_time']->value;?>
" />
          <span class="add-on">秒</span>
        </div>
	</dd>
  </dl>
  <dl class="clearfix">
    <dt><label for="android_index">Android首页地址：</label></dt>
    <dd><input class="input-xxlarge" type="text" name="android_index" id="android_index" value="<?php if ($_smarty_tpl->tpl_vars['android_index']->value) {
echo $_smarty_tpl->tpl_vars['android_index']->value;
} else {
echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
/<?php }?>" /></dd>
  </dl>
  <dl class="clearfix">
    <dt><label for="ios_index">iOS首页地址：</label></dt>
    <dd><input class="input-xxlarge" type="text" name="ios_index" id="ios_index" value="<?php if ($_smarty_tpl->tpl_vars['ios_index']->value) {
echo $_smarty_tpl->tpl_vars['ios_index']->value;
} else {
echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
/<?php }?>" /></dd>
  </dl>
  <dl class="clearfix">
    <dt><label>百度地图：</label></dt>
    <dd class="clearfix">
      <div class="input-prepend">
        <span class="add-on">Android</span>
        <input class="span4" id="map_baidu_android" name="map_baidu_android" type="text" value="<?php echo $_smarty_tpl->tpl_vars['map_baidu_android']->value;?>
" />
      </div>
      <br />
      <div class="input-prepend">
        <span class="add-on">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;iOS</span>
        <input class="span4" id="map_baidu_ios" name="map_baidu_ios" type="text" value="<?php echo $_smarty_tpl->tpl_vars['map_baidu_ios']->value;?>
" />
      </div>
      <label><input type="radio" name="map_set" value="2" <?php if ($_smarty_tpl->tpl_vars['map_set']->value==2) {?>checked="checked"<?php }?>>默认</label>
    </dd>
  </dl>
  <dl class="clearfix">
    <dt><label for="map_google">谷歌地图：</label></dt>
    <dd>
      <input class="input-xxlarge" type="text" name="map_google" id="map_google" value="<?php echo $_smarty_tpl->tpl_vars['map_google']->value;?>
" />
      <label><input type="radio" name="map_set" value="1" <?php if ($_smarty_tpl->tpl_vars['map_set']->value==1) {?>checked="checked"<?php }?>>默认</label>
    </dd>
  </dl>
  <dl class="clearfix formbtn">
    <dt>&nbsp;</dt>
    <dd><input class="btn btn-large btn-success" type="submit" name="submit" id="btnSubmit" value="确认提交" /></dd>
  </dl>
</form>

<?php echo $_smarty_tpl->tpl_vars['jsFile']->value;?>

</body>
</html>
<?php }} ?>
