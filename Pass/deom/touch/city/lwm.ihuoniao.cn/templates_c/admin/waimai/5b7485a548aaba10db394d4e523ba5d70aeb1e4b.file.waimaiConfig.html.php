<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-05-12 16:12:10
         compiled from "D:\ServerWwwroot\www.lwm.com\admin\templates\waimai\waimaiConfig.html" */ ?>
<?php /*%%SmartyHeaderCode:121959156e5a35b745-73073337%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5b7485a548aaba10db394d4e523ba5d70aeb1e4b' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\admin\\templates\\waimai\\waimaiConfig.html',
      1 => 1494490308,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '121959156e5a35b745-73073337',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'cfg_soft_lang' => 0,
    'channelname' => 0,
    'cssFile' => 0,
    'thumbSize' => 0,
    'thumbType' => 0,
    'action' => 0,
    'adminPath' => 0,
    'cfg_basehost' => 0,
    'token' => 0,
    'articleLogo' => 0,
    'articleLogoChecked' => 0,
    'articleLogoNames' => 0,
    'articleLogoUrl' => 0,
    'cfg_attachment' => 0,
    'subdomain' => 0,
    'subdomainChecked' => 0,
    'subdomainNames' => 0,
    'channeldomain' => 0,
    'channelswitch' => 0,
    'channelswitchChecked' => 0,
    'channelswitchNames' => 0,
    'closecause' => 0,
    'title' => 0,
    'keywords' => 0,
    'description' => 0,
    'hotlineVal' => 0,
    'hotlineChecked' => 0,
    'hotlineNames' => 0,
    'hotline' => 0,
    'mapList' => 0,
    'mapSelected' => 0,
    'defaultMap' => 0,
    'tplList' => 0,
    'articleTemplate' => 0,
    'tplItem' => 0,
    'touchTplList' => 0,
    'touchTemplate' => 0,
    'articleUpload' => 0,
    'articleUploadChecked' => 0,
    'articleUploadNames' => 0,
    'uploadDir' => 0,
    'softSize' => 0,
    'softType' => 0,
    'thumbType_' => 0,
    'atlasSize' => 0,
    'atlasType' => 0,
    'brandSmallWidth' => 0,
    'brandSmallHeight' => 0,
    'brandMiddleWidth' => 0,
    'brandMiddleHeight' => 0,
    'brandLargeWidth' => 0,
    'brandLargeHeight' => 0,
    'thumbSmallWidth' => 0,
    'thumbSmallHeight' => 0,
    'thumbMiddleWidth' => 0,
    'thumbMiddleHeight' => 0,
    'thumbLargeWidth' => 0,
    'thumbLargeHeight' => 0,
    'atlasSmallWidth' => 0,
    'atlasSmallHeight' => 0,
    'photoCutType' => 0,
    'photoCutPostion' => 0,
    'quality' => 0,
    'articleFtp' => 0,
    'articleFtpChecked' => 0,
    'articleFtpNames' => 0,
    'ftpType' => 0,
    'ftpTypeChecked' => 0,
    'ftpTypeNames' => 0,
    'ftpStateType' => 0,
    'ftpStateChecked' => 0,
    'ftpStateNames' => 0,
    'ftpSSL' => 0,
    'ftpSSLChecked' => 0,
    'ftpSSLNames' => 0,
    'ftpPasv' => 0,
    'ftpPasvChecked' => 0,
    'ftpPasvNames' => 0,
    'ftpUrl' => 0,
    'ftpServer' => 0,
    'ftpPort' => 0,
    'ftpDir' => 0,
    'ftpUser' => 0,
    'ftpPwd' => 0,
    'ftpTimeout' => 0,
    'OSSUrl' => 0,
    'OSSBucket' => 0,
    'OSSKeyID' => 0,
    'OSSKeySecret' => 0,
    'articleMark' => 0,
    'articleMarkChecked' => 0,
    'articleMarkNames' => 0,
    'thumbMarkState' => 0,
    'thumbMarkStateChecked' => 0,
    'thumbMarkStateNames' => 0,
    'atlasMarkState' => 0,
    'atlasMarkStateChecked' => 0,
    'atlasMarkStateNames' => 0,
    'editorMarkState' => 0,
    'editorMarkStateChecked' => 0,
    'editorMarkStateNames' => 0,
    'waterMarkWidth' => 0,
    'waterMarkHeight' => 0,
    'waterMarkPostion' => 0,
    'waterMarkType' => 0,
    'waterMarkTypeChecked' => 0,
    'waterMarkTypeNames' => 0,
    'markText' => 0,
    'markFontfamily' => 0,
    'markFontfamilySelected' => 0,
    'HUONIAOINC' => 0,
    'markFontsize' => 0,
    'markFontColor' => 0,
    'markFile' => 0,
    'markFileSelected' => 0,
    'markPadding' => 0,
    'transparent' => 0,
    'markQuality' => 0,
    'jsFile' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_59156e5a461303_42035169',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59156e5a461303_42035169')) {function content_59156e5a461303_42035169($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_replace')) include 'D:\\ServerWwwroot\\www.lwm.com\\include\\tpl\\plugins\\modifier.replace.php';
if (!is_callable('smarty_function_html_radios')) include 'D:\\ServerWwwroot\\www.lwm.com\\include\\tpl\\plugins\\function.html_radios.php';
if (!is_callable('smarty_function_html_options')) include 'D:\\ServerWwwroot\\www.lwm.com\\include\\tpl\\plugins\\function.html_options.php';
?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $_smarty_tpl->tpl_vars['cfg_soft_lang']->value;?>
" />
<title><?php echo $_smarty_tpl->tpl_vars['channelname']->value;?>
设置</title>
<?php echo $_smarty_tpl->tpl_vars['cssFile']->value;?>

<?php echo '<script'; ?>
>
var thumbSize = <?php echo $_smarty_tpl->tpl_vars['thumbSize']->value;?>
, thumbType = "<?php echo $_smarty_tpl->tpl_vars['thumbType']->value;?>
", action = "<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
", adminPath = "<?php echo $_smarty_tpl->tpl_vars['adminPath']->value;?>
";
<?php echo '</script'; ?>
>
<style>body {height: auto;}</style>
</head>

<body>
<div class="btn-group config-nav" data-toggle="buttons-radio">
  <button type="button" class="btn active" data-type="site">基本设置</button>
  <button type="button" class="btn" data-type="temp">风格管理</button>
  <button type="button" class="btn" data-type="upload">上传设置</button>
  <button type="button" class="btn" data-type="ftp">远程附件</button>
  <button type="button" class="btn" data-type="mark">水印设置</button>
</div>

<div class="info-tips hide" id="infoTip"></div>

<form action="waimaiConfig.php" method="post" name="editform" id="editform" class="editform">
  <input type="hidden" name="configType" value="site" />
  <input type="hidden" id="basehost" value="<?php echo smarty_modifier_replace($_smarty_tpl->tpl_vars['cfg_basehost']->value,"www.",'');?>
" />
  <input type="hidden" name="token" id="token" value="<?php echo $_smarty_tpl->tpl_vars['token']->value;?>
" />
  <div class="item">
    <dl class="clearfix">
      <dt><label for="channelname">名称：</label></dt>
      <dd>
        <input class="input-large" type="text" name="channelname" id="channelname" data-regex=".{2,20}" maxlength="20" value="<?php echo $_smarty_tpl->tpl_vars['channelname']->value;?>
" />
        <span class="input-tips"><s></s>请输入名称，2-20个汉字</span>
      </dd>
    </dl>
    <dl class="clearfix">
      <dt>LOGO：</dt>
      <dd class="radio">
        <?php echo smarty_function_html_radios(array('name'=>"articleLogo",'values'=>$_smarty_tpl->tpl_vars['articleLogo']->value,'checked'=>$_smarty_tpl->tpl_vars['articleLogoChecked']->value,'output'=>$_smarty_tpl->tpl_vars['articleLogoNames']->value,'separator'=>"&nbsp;&nbsp;"),$_smarty_tpl);?>

      </dd>
    </dl>
    <?php if ($_smarty_tpl->tpl_vars['articleLogoChecked']->value==1) {?>
    <dl class="clearfix">
    <?php } else { ?>
    <dl class="clearfix hide">
    <?php }?>
      <dt>&nbsp;</dt>
      <dd class="thumb fn-clear listImgBox">
        <div class="uploadinp filePicker thumbtn<?php if ($_smarty_tpl->tpl_vars['articleLogoUrl']->value!='') {?> hide<?php }?>" id="filePicker1" data-type="thumb"  data-count="1" data-size="<?php echo $_smarty_tpl->tpl_vars['thumbSize']->value;?>
" data-imglist=""><div></div><span></span></div>
        <?php if ($_smarty_tpl->tpl_vars['articleLogoUrl']->value!='') {?>
        <ul id="listSection1" class="listSection thumblist fn-clear" style="display:inline-block;"><li id="WU_FILE_0_1"><a href='<?php echo $_smarty_tpl->tpl_vars['cfg_attachment']->value;
echo $_smarty_tpl->tpl_vars['articleLogoUrl']->value;?>
' target="_blank" title=""><img alt="" src="<?php echo $_smarty_tpl->tpl_vars['cfg_attachment']->value;
echo $_smarty_tpl->tpl_vars['articleLogoUrl']->value;?>
" data-val="<?php echo $_smarty_tpl->tpl_vars['articleLogoUrl']->value;?>
"/></a><a class="reupload li-rm" href="javascript:;">删除图片</a></li></ul>
        <?php } else { ?>
        <ul id="listSection1" class="listSection thumblist fn-clear"></ul>
        <?php }?>
        <input type="hidden" name="litpic" value="<?php echo $_smarty_tpl->tpl_vars['articleLogoUrl']->value;?>
" class="imglist-hidden" id="litpic">
      </dd>
    </dl>
    <dl class="clearfix">
      <dt><label>访问方式：</label></dt>
      <dd class="radio">
        <?php echo smarty_function_html_radios(array('name'=>"subdomain",'values'=>$_smarty_tpl->tpl_vars['subdomain']->value,'checked'=>$_smarty_tpl->tpl_vars['subdomainChecked']->value,'output'=>$_smarty_tpl->tpl_vars['subdomainNames']->value,'separator'=>"&nbsp;&nbsp;"),$_smarty_tpl);?>

      </dd>
    </dl>
    <dl class="clearfix">
      <dt>&nbsp;</dt>
      <dd>
        <div class="input-prepend input-append">
          <span class="add-on"></span>
          <input class="input-large" type="text" name="channeldomain" id="channeldomain" value="<?php echo $_smarty_tpl->tpl_vars['channeldomain']->value;?>
" />
          <span class="add-on"></span>
        </div>
      </dd>
    </dl>
    <dl class="clearfix">
      <dt><label>开关：</label></dt>
      <dd class="radio">
        <?php echo smarty_function_html_radios(array('name'=>"channelswitch",'values'=>$_smarty_tpl->tpl_vars['channelswitch']->value,'checked'=>$_smarty_tpl->tpl_vars['channelswitchChecked']->value,'output'=>$_smarty_tpl->tpl_vars['channelswitchNames']->value,'separator'=>"&nbsp;&nbsp;"),$_smarty_tpl);?>

      </dd>
    </dl>
    <?php if ($_smarty_tpl->tpl_vars['channelswitchChecked']->value==0) {?>
    <dl class="clearfix hide">
    <?php } else { ?>
    <dl class="clearfix">
    <?php }?>
      <dt><label for="closecause">关闭原因：</label></dt>
      <dd>
        <textarea name="closecause" id="closecause" class="input-xxlarge" rows="5" placeholder="站点关闭时出现的提示信息"><?php echo $_smarty_tpl->tpl_vars['closecause']->value;?>
</textarea>
      </dd>
    </dl>
    <dl class="clearfix">
      <dt><label for="title">seo标题：</label></dt>
      <dd>
        <input class="input-xxlarge" type="text" name="title" id="title" data-regex=".{0,80}" maxlength="80" placeholder="一般不超过80个字符" value="<?php echo $_smarty_tpl->tpl_vars['title']->value;?>
" />
        <span class="input-tips"><s></s>一般不超过80个字符</span>
      </dd>
    </dl>
    <dl class="clearfix">
      <dt><label for="keywords">关键字：</label></dt>
      <dd>
        <input class="input-xxlarge" type="text" name="keywords" id="keywords" data-regex=".{0,100}" maxlength="100" placeholder="一般不超过100个字符" value="<?php echo $_smarty_tpl->tpl_vars['keywords']->value;?>
" />
        <span class="input-tips"><s></s>一般不超过100个字符</span>
      </dd>
    </dl>
    <dl class="clearfix">
      <dt><label for="description">描述：</label></dt>
      <dd>
        <textarea name="description" id="description" placeholder="一般不超过200个字符" data-regex=".{0,200}"><?php echo $_smarty_tpl->tpl_vars['description']->value;?>
</textarea>
        <span class="input-tips"><s></s>一般不超过200个字符</span>
      </dd>
    </dl>
    <dl class="clearfix">
      <dt><label>咨询热线：</label></dt>
      <dd class="radio">
        <?php echo smarty_function_html_radios(array('name'=>"hotline_rad",'values'=>$_smarty_tpl->tpl_vars['hotlineVal']->value,'checked'=>$_smarty_tpl->tpl_vars['hotlineChecked']->value,'output'=>$_smarty_tpl->tpl_vars['hotlineNames']->value,'separator'=>"&nbsp;&nbsp;"),$_smarty_tpl);?>

        <input class="input-large"<?php if ($_smarty_tpl->tpl_vars['hotlineChecked']->value==0) {?> style="display:none;"<?php }?> type="text" name="hotline" id="hotline" value="<?php echo $_smarty_tpl->tpl_vars['hotline']->value;?>
" placeholder="请输入频道咨询热线" />
      </dd>
    </dl>
    <dl class="clearfix">
      <dt><label for="map">地图配置：</label></dt>
      <dd>
        <select name="map" id="map">
          <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['mapList']->value,'selected'=>$_smarty_tpl->tpl_vars['mapSelected']->value),$_smarty_tpl);?>

        </select>
        <span class="input-tips" style="display:inline-block;"><s></s>系统默认为：<?php echo $_smarty_tpl->tpl_vars['defaultMap']->value;?>
</span>
      </dd>
    </dl>
  </div>
  <div class="item hide" id="tplList">
    <div class="tpl-list">
      <h5 class="stit"><span class="label label-info">电脑端：</span></h5>
      <ul class="clearfix">
        <?php  $_smarty_tpl->tpl_vars['tplItem'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['tplItem']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['tplList']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['tplItem']->key => $_smarty_tpl->tpl_vars['tplItem']->value) {
$_smarty_tpl->tpl_vars['tplItem']->_loop = true;
?>
        <li<?php if ($_smarty_tpl->tpl_vars['articleTemplate']->value==$_smarty_tpl->tpl_vars['tplItem']->value['directory']) {?> class="current"<?php }?>>
          <a href="javascript:;" data-id="<?php echo $_smarty_tpl->tpl_vars['tplItem']->value['directory'];?>
" data-title="<?php echo $_smarty_tpl->tpl_vars['tplItem']->value['tplname'];?>
" class="img" title="模板名称：<?php echo $_smarty_tpl->tpl_vars['tplItem']->value['tplname'];?>
&#10;版权所有：<?php echo $_smarty_tpl->tpl_vars['tplItem']->value['copyright'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['adminPath']->value;?>
../templates/<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['tplItem']->value['directory'];?>
/preview.jpg" /></a>
          <p>
            <span title="<?php echo $_smarty_tpl->tpl_vars['tplItem']->value['tplname'];?>
"><?php echo $_smarty_tpl->tpl_vars['tplItem']->value['tplname'];?>
</span><br />
            <a href="javascript:;" class="choose">选择</a><br />
            <a href="javascript:;" class="edit">编辑模板</a><br />
            <?php if ($_smarty_tpl->tpl_vars['articleTemplate']->value!=$_smarty_tpl->tpl_vars['tplItem']->value['directory']) {?><a href="javascript:;" class="del">卸载</a><?php } else { ?><a href="javascript:;" class="del hide">卸载</a><?php }?>
          </p>
        </li>
      	<?php } ?>
      </ul>
      <input type="hidden" name="articleTemplate" id="articleTemplate" value="<?php echo $_smarty_tpl->tpl_vars['articleTemplate']->value;?>
" />
    </div>
    <div class="tpl-list touch">
      <h5 class="stit"><span class="label label-warning">移动端：</span></h5>
      <ul class="clearfix">
        <?php  $_smarty_tpl->tpl_vars['tplItem'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['tplItem']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['touchTplList']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['tplItem']->key => $_smarty_tpl->tpl_vars['tplItem']->value) {
$_smarty_tpl->tpl_vars['tplItem']->_loop = true;
?>
        <li<?php if ($_smarty_tpl->tpl_vars['touchTemplate']->value==$_smarty_tpl->tpl_vars['tplItem']->value['directory']) {?> class="current"<?php }?>>
          <a href="javascript:;" data-id="<?php echo $_smarty_tpl->tpl_vars['tplItem']->value['directory'];?>
" data-title="<?php echo $_smarty_tpl->tpl_vars['tplItem']->value['tplname'];?>
" class="img" title="模板名称：<?php echo $_smarty_tpl->tpl_vars['tplItem']->value['tplname'];?>
&#10;版权所有：<?php echo $_smarty_tpl->tpl_vars['tplItem']->value['copyright'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['adminPath']->value;?>
../templates/<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
/touch/<?php echo $_smarty_tpl->tpl_vars['tplItem']->value['directory'];?>
/preview.jpg" /></a>
          <p>
            <span title="<?php echo $_smarty_tpl->tpl_vars['tplItem']->value['tplname'];?>
"><?php echo $_smarty_tpl->tpl_vars['tplItem']->value['tplname'];?>
</span><br />
            <a href="javascript:;" class="choose">选择</a><br />
            <a href="javascript:;" class="edit">编辑模板</a><br />
            <?php if ($_smarty_tpl->tpl_vars['touchTemplate']->value!=$_smarty_tpl->tpl_vars['tplItem']->value['directory']) {?><a href="javascript:;" class="del">卸载</a><?php } else { ?><a href="javascript:;" class="del hide">卸载</a><?php }?>
          </p>
        </li>
      	<?php } ?>
      </ul>
      <input type="hidden" name="touchTemplate" id="touchTemplate" value="<?php echo $_smarty_tpl->tpl_vars['touchTemplate']->value;?>
" />
    </div>
  </div>
  <div class="item hide">
    <dl class="clearfix">
      <dt>上传设置：</dt>
      <dd class="radio">
        <?php echo smarty_function_html_radios(array('name'=>"articleUpload",'values'=>$_smarty_tpl->tpl_vars['articleUpload']->value,'checked'=>$_smarty_tpl->tpl_vars['articleUploadChecked']->value,'output'=>$_smarty_tpl->tpl_vars['articleUploadNames']->value,'separator'=>"&nbsp;&nbsp;"),$_smarty_tpl);?>

      </dd>
    </dl>
    <?php if ($_smarty_tpl->tpl_vars['articleUploadChecked']->value==1) {?>
    <div>
    <?php } else { ?>
    <div class="hide">
    <?php }?>
      <dl class="clearfix">
        <dt><label for="uploadDir">上传目录：</label></dt>
        <dd>
          <input class="input-large" type="text" name="uploadDir" id="uploadDir" value="<?php echo $_smarty_tpl->tpl_vars['uploadDir']->value;?>
" data-regex=".*" />
          <span class="input-tips"><s></s>&nbsp;</span>
        </dd>
      </dl>
      <dl class="clearfix">
        <dt><label for="softSize">附件上传限制：</label></dt>
        <dd>
          <input class="input-small" type="number" name="softSize" id="softSize" data-regex="[0-9]\d*" min="0" value="<?php echo $_smarty_tpl->tpl_vars['softSize']->value;?>
" />kb
          <span class="input-tips"><s></s>上传附件限制大小，如果超过这个大小将不能上传，只能填写数字</span>
        </dd>
      </dl>
      <dl class="clearfix">
        <dt><label for="softType">附件类型限制：</label></dt>
        <dd>
          <input class="input-xxlarge" type="text" name="softType" id="softType" placeholder="多个用“|”分开" value="<?php echo $_smarty_tpl->tpl_vars['softType']->value;?>
" data-regex=".*" />
          <span class="input-tips"><s></s>&nbsp;</span>
        </dd>
      </dl>
      <dl class="clearfix">
        <dt><label for="thumbSize">缩略图上传限制：</label></dt>
        <dd>
          <input class="input-small" type="number" name="thumbSize" id="thumbSize" data-regex="[0-9]\d*" min="0" value="<?php echo $_smarty_tpl->tpl_vars['thumbSize']->value;?>
" />kb
          <span class="input-tips"><s></s>上传图片限制大小，如果超过这个大小将不能上传，只能填写数字</span>
        </dd>
      </dl>
      <dl class="clearfix">
        <dt><label for="thumbType">缩略图类型限制：</label></dt>
        <dd>
          <input class="input-xxlarge" type="text" name="thumbType" id="thumbType" placeholder="多个用“|”分开" value="<?php echo $_smarty_tpl->tpl_vars['thumbType_']->value;?>
" data-regex=".*" />
          <span class="input-tips"><s></s>&nbsp;</span>
        </dd>
      </dl>
      <dl class="clearfix">
        <dt><label for="atlasSize">图集上传限制：</label></dt>
        <dd>
          <input class="input-small" type="number" name="atlasSize" id="atlasSize" data-regex="[0-9]\d*" min="0" value="<?php echo $_smarty_tpl->tpl_vars['atlasSize']->value;?>
" />kb
          <span class="input-tips"><s></s>上传图片限制大小，如果超过这个大小将不能上传，只能填写数字</span>
        </dd>
      </dl>
      <dl class="clearfix">
        <dt><label for="atlasType">图集类型限制：</label></dt>
        <dd>
          <input class="input-xxlarge" type="text" name="atlasType" id="atlasType" placeholder="多个用“|”分开" value="<?php echo $_smarty_tpl->tpl_vars['atlasType']->value;?>
" data-regex=".*" />
          <span class="input-tips"><s></s>&nbsp;</span>
        </dd>
      </dl>
      <dl class="clearfix">
        <dt><label>品牌LOGO缩图：</label></dt>
        <dd>
          小图：
          <div class="input-prepend input-append">
            <span class="add-on">宽</span>
            <input class="span1" id="brandSmallWidth" name="brandSmallWidth" type="text" value="<?php echo $_smarty_tpl->tpl_vars['brandSmallWidth']->value;?>
" />
            <span class="add-on">px</span>
          </div>
          &times;
          <div class="input-prepend input-append">
            <span class="add-on">高</span>
            <input class="span1" id="brandSmallHeight" name="brandSmallHeight" type="text" value="<?php echo $_smarty_tpl->tpl_vars['brandSmallHeight']->value;?>
" />
            <span class="add-on">px</span>
          </div><br />
          中图：
          <div class="input-prepend input-append">
            <span class="add-on">宽</span>
            <input class="span1" id="brandMiddleWidth" name="brandMiddleWidth" type="text" value="<?php echo $_smarty_tpl->tpl_vars['brandMiddleWidth']->value;?>
" />
            <span class="add-on">px</span>
          </div>
          &times;
          <div class="input-prepend input-append">
            <span class="add-on">高</span>
            <input class="span1" id="brandMiddleHeight" name="brandMiddleHeight" type="text" value="<?php echo $_smarty_tpl->tpl_vars['brandMiddleHeight']->value;?>
" />
            <span class="add-on">px</span>
          </div><br >
          大图：
          <div class="input-prepend input-append">
            <span class="add-on">宽</span>
            <input class="span1" id="brandLargeWidth" name="brandLargeWidth" type="text" value="<?php echo $_smarty_tpl->tpl_vars['brandLargeWidth']->value;?>
" />
            <span class="add-on">px</span>
          </div>
          &times;
          <div class="input-prepend input-append">
            <span class="add-on">高</span>
            <input class="span1" id="brandLargeHeight" name="brandLargeHeight" type="text" value="<?php echo $_smarty_tpl->tpl_vars['brandLargeHeight']->value;?>
" />
            <span class="add-on">px</span>
          </div>
        </dd>
      </dl>
      <dl class="clearfix">
        <dt><label>缩略图缩图：</label></dt>
        <dd>
          小图：
          <div class="input-prepend input-append">
            <span class="add-on">宽</span>
            <input class="span1" id="thumbSmallWidth" name="thumbSmallWidth" type="text" value="<?php echo $_smarty_tpl->tpl_vars['thumbSmallWidth']->value;?>
" />
            <span class="add-on">px</span>
          </div>
          &times;
          <div class="input-prepend input-append">
            <span class="add-on">高</span>
            <input class="span1" id="thumbSmallHeight" name="thumbSmallHeight" type="text" value="<?php echo $_smarty_tpl->tpl_vars['thumbSmallHeight']->value;?>
" />
            <span class="add-on">px</span>
          </div><br />
          中图：
          <div class="input-prepend input-append">
            <span class="add-on">宽</span>
            <input class="span1" id="thumbMiddleWidth" name="thumbMiddleWidth" type="text" value="<?php echo $_smarty_tpl->tpl_vars['thumbMiddleWidth']->value;?>
" />
            <span class="add-on">px</span>
          </div>
          &times;
          <div class="input-prepend input-append">
            <span class="add-on">高</span>
            <input class="span1" id="thumbMiddleHeight" name="thumbMiddleHeight" type="text" value="<?php echo $_smarty_tpl->tpl_vars['thumbMiddleHeight']->value;?>
" />
            <span class="add-on">px</span>
          </div><br >
          大图：
          <div class="input-prepend input-append">
            <span class="add-on">宽</span>
            <input class="span1" id="thumbLargeWidth" name="thumbLargeWidth" type="text" value="<?php echo $_smarty_tpl->tpl_vars['thumbLargeWidth']->value;?>
" />
            <span class="add-on">px</span>
          </div>
          &times;
          <div class="input-prepend input-append">
            <span class="add-on">高</span>
            <input class="span1" id="thumbLargeHeight" name="thumbLargeHeight" type="text" value="<?php echo $_smarty_tpl->tpl_vars['thumbLargeHeight']->value;?>
" />
            <span class="add-on">px</span>
          </div>
        </dd>
      </dl>
      <dl class="clearfix">
        <dt><label>图集缩图：</label></dt>
        <dd>
          小图：
          <div class="input-prepend input-append">
            <span class="add-on">宽</span>
            <input class="span1" id="atlasSmallWidth" name="atlasSmallWidth" type="text" value="<?php echo $_smarty_tpl->tpl_vars['atlasSmallWidth']->value;?>
" />
            <span class="add-on">px</span>
          </div>
          &times;
          <div class="input-prepend input-append">
            <span class="add-on">高</span>
            <input class="span1" id="atlasSmallHeight" name="atlasSmallHeight" type="text" value="<?php echo $_smarty_tpl->tpl_vars['atlasSmallHeight']->value;?>
" />
            <span class="add-on">px</span>
          </div>
        </dd>
      </dl>
      <dl class="clearfix">
        <dt><label>图片裁剪方法：</label></dt>
        <dd>
          <label style="display:block;"><input type="radio" name="photoCutType" value="force"<?php if ($_smarty_tpl->tpl_vars['photoCutType']->value=="force") {?> checked<?php }?> />按规定尺寸强制变形</label>
          <label style="display:block;"><input type="radio" name="photoCutType" value="scale"<?php if ($_smarty_tpl->tpl_vars['photoCutType']->value=="scale") {?> checked<?php }?> />等比例裁剪（此方法不会导致图片变形，但是输出的图像大小不完全等于设置的尺寸）</label>
          <label style="display:block;"><input type="radio" name="photoCutType" value="scale_fill"<?php if ($_smarty_tpl->tpl_vars['photoCutType']->value=="scale_fill") {?> checked<?php }?> />按比例在规定尺寸内缩放，空白处将以白色填充</label>
          <label style="display:block;"><input type="radio" name="photoCutType" value="position"<?php if ($_smarty_tpl->tpl_vars['photoCutType']->value=="position") {?> checked<?php }?> />从指定位置截取</label>
          <?php if ($_smarty_tpl->tpl_vars['photoCutType']->value=="position") {?>
          <div id="photoCutPosition">
          <?php } else { ?>
          <div id="photoCutPosition" class="hide">
          <?php }?>
            <ul class="clearfix watermarkpostion">
              <li<?php if ($_smarty_tpl->tpl_vars['photoCutPostion']->value=="north_west") {?> class="current"<?php }?> data-id="north_west"><a href="javascript:;">左上</a></li>
              <li<?php if ($_smarty_tpl->tpl_vars['photoCutPostion']->value=="north") {?> class="current"<?php }?> data-id="north"><a href="javascript:;">中上</a></li>
              <li<?php if ($_smarty_tpl->tpl_vars['photoCutPostion']->value=="north_east") {?> class="current"<?php }?> data-id="north_east"><a href="javascript:;">右上</a></li>
              <li<?php if ($_smarty_tpl->tpl_vars['photoCutPostion']->value=="west") {?> class="current"<?php }?> data-id="west"><a href="javascript:;">左中</a></li>
              <li<?php if ($_smarty_tpl->tpl_vars['photoCutPostion']->value=="center") {?> class="current"<?php }?> data-id="center"><a href="javascript:;">中心</a></li>
              <li<?php if ($_smarty_tpl->tpl_vars['photoCutPostion']->value=="east") {?> class="current"<?php }?> data-id="east"><a href="javascript:;">右中</a></li>
              <li<?php if ($_smarty_tpl->tpl_vars['photoCutPostion']->value=="south_west") {?> class="current"<?php }?> data-id="south_west"><a href="javascript:;">左下</a></li>
              <li<?php if ($_smarty_tpl->tpl_vars['photoCutPostion']->value=="south") {?> class="current"<?php }?> data-id="south"><a href="javascript:;">中下</a></li>
              <li<?php if ($_smarty_tpl->tpl_vars['photoCutPostion']->value=="south_east") {?> class="current"<?php }?> data-id="south_east"><a href="javascript:;">右下</a></li>
            </ul>
            <input type="hidden" name="photoCutPostion" value="<?php echo $_smarty_tpl->tpl_vars['photoCutPostion']->value;?>
" />
          </div>
        </dd>
      </dl>
      <dl class="clearfix">
        <dt><label for="quality">图片质量：</label></dt>
        <dd>
          <input class="input-small" type="number" name="quality" id="quality" data-regex="(([0-9]\d?)|(100)|(0))" min="0" max="100" value="<?php echo $_smarty_tpl->tpl_vars['quality']->value;?>
" />
          <span class="input-tips"><s></s>数字越大越清晰，最高100，建议设置85</span>
        </dd>
      </dl>
    </div>
  </div>
  <div class="item hide">
    <dl class="clearfix">
      <dt>FTP设置：</dt>
      <dd class="radio">
        <?php echo smarty_function_html_radios(array('name'=>"articleFtp",'values'=>$_smarty_tpl->tpl_vars['articleFtp']->value,'checked'=>$_smarty_tpl->tpl_vars['articleFtpChecked']->value,'output'=>$_smarty_tpl->tpl_vars['articleFtpNames']->value,'separator'=>"&nbsp;&nbsp;"),$_smarty_tpl);?>

      </dd>
    </dl>
    <?php if ($_smarty_tpl->tpl_vars['articleFtpChecked']->value==1) {?>
    <div>
    <?php } else { ?>
    <div class="hide">
    <?php }?>
      <dl class="clearfix">
        <dt><label for="ftpType">远程服务器类型：</label></dt>
        <dd>
          <?php echo smarty_function_html_radios(array('name'=>"ftpType",'values'=>$_smarty_tpl->tpl_vars['ftpType']->value,'checked'=>$_smarty_tpl->tpl_vars['ftpTypeChecked']->value,'output'=>$_smarty_tpl->tpl_vars['ftpTypeNames']->value,'separator'=>"&nbsp;&nbsp;"),$_smarty_tpl);?>

        </dd>
      </dl>
      <div id="ftpType0" class="hide ftpType">
        <dl class="clearfix">
          <dt><label for="ftpStateType">启用远程附件：</label></dt>
          <dd>
            <?php echo smarty_function_html_radios(array('name'=>"ftpStateType",'values'=>$_smarty_tpl->tpl_vars['ftpStateType']->value,'checked'=>$_smarty_tpl->tpl_vars['ftpStateChecked']->value,'output'=>$_smarty_tpl->tpl_vars['ftpStateNames']->value,'separator'=>"&nbsp;&nbsp;"),$_smarty_tpl);?>

          </dd>
        </dl>
        <div id="ftpConfig">
          <dl class="clearfix">
            <dt><label for="ftpSSL">启用SSL连接：</label></dt>
            <dd>
              <?php echo smarty_function_html_radios(array('name'=>"ftpSSL",'values'=>$_smarty_tpl->tpl_vars['ftpSSL']->value,'checked'=>$_smarty_tpl->tpl_vars['ftpSSLChecked']->value,'output'=>$_smarty_tpl->tpl_vars['ftpSSLNames']->value,'separator'=>"&nbsp;&nbsp;"),$_smarty_tpl);?>

            </dd>
          </dl>
          <dl class="clearfix">
            <dt><label for="ftpPasv">被动模式连接：</label></dt>
            <dd>
              <?php echo smarty_function_html_radios(array('name'=>"ftpPasv",'values'=>$_smarty_tpl->tpl_vars['ftpPasv']->value,'checked'=>$_smarty_tpl->tpl_vars['ftpPasvChecked']->value,'output'=>$_smarty_tpl->tpl_vars['ftpPasvNames']->value,'separator'=>"&nbsp;&nbsp;"),$_smarty_tpl);?>

            </dd>
          </dl>
          <dl class="clearfix">
            <dt><label for="ftpUrl">远程附件地址：</label></dt>
            <dd>
              <input class="input-large" type="text" name="ftpUrl" id="ftpUrl" value="<?php echo $_smarty_tpl->tpl_vars['ftpUrl']->value;?>
" data-regex=".*" />
              <span class="input-tips"><s></s>&nbsp;</span>
            </dd>
          </dl>
          <dl class="clearfix">
            <dt><label for="ftpServer">FTP服务器地址：</label></dt>
            <dd>
              <input class="input-large" type="text" name="ftpServer" id="ftpServer" value="<?php echo $_smarty_tpl->tpl_vars['ftpServer']->value;?>
" data-regex=".*" />
              <span class="input-tips"><s></s>&nbsp;</span>
            </dd>
          </dl>
          <dl class="clearfix">
            <dt><label for="ftpPort">FTP服务器端口：</label></dt>
            <dd>
              <input class="input-large" type="text" name="ftpPort" id="ftpPort" value="<?php echo $_smarty_tpl->tpl_vars['ftpPort']->value;?>
" data-regex="[0-9]\d*" />
              <span class="input-tips"><s></s>请正确输入，类型为数字</span>
            </dd>
          </dl>
          <dl class="clearfix">
            <dt><label for="ftpDir">FTP上传目录：</label></dt>
            <dd>
              <input class="input-large" type="text" name="ftpDir" id="ftpDir" value="<?php echo $_smarty_tpl->tpl_vars['ftpDir']->value;?>
" data-regex=".*" />
              <span class="input-tips"><s></s>&nbsp;</span>
            </dd>
          </dl>
          <dl class="clearfix">
            <dt><label for="ftpUser">FTP帐号：</label></dt>
            <dd>
              <input class="input-large" type="text" name="ftpUser" id="ftpUser" value="<?php echo $_smarty_tpl->tpl_vars['ftpUser']->value;?>
" data-regex=".*" />
              <span class="input-tips"><s></s>&nbsp;</span>
            </dd>
          </dl>
          <dl class="clearfix">
            <dt><label for="ftpPwd">FTP密码：</label></dt>
            <dd>
              <input class="input-large" type="text" name="ftpPwd" id="ftpPwd" value="<?php echo $_smarty_tpl->tpl_vars['ftpPwd']->value;?>
" data-regex=".*" />
              <span class="input-tips"><s></s>&nbsp;</span>
            </dd>
          </dl>
          <dl class="clearfix">
            <dt><label for="ftpTimeout">FTP超时：</label></dt>
            <dd>
              <input class="input-large" type="text" name="ftpTimeout" id="ftpTimeout" value="<?php echo $_smarty_tpl->tpl_vars['ftpTimeout']->value;?>
" data-regex="[0-9]\d*" />秒
              <span class="input-tips"><s></s>请正确输入，类型为数字</span>
            </dd>
          </dl>
        </div>
      </div>
      <div id="ftpType1" class="hide ftpType">
        <dl class="clearfix">
          <dt><label for="OSSUrl">服务器地址：</label></dt>
          <dd>
            <input class="input-large" type="text" name="OSSUrl" id="OSSUrl" value="<?php echo $_smarty_tpl->tpl_vars['OSSUrl']->value;?>
" data-regex=".*" />
            <span class="input-tips" style="display:inline-block;"><s></s>&nbsp;完整的Http地址。如果没有绑定域名地址为：（Bucket name）.oss.aliyuncs.com</span>
          </dd>
        </dl>
        <dl class="clearfix">
          <dt><label for="OSSBucket">Bucket名称：</label></dt>
          <dd>
            <input class="input-large" type="text" name="OSSBucket" id="OSSBucket" value="<?php echo $_smarty_tpl->tpl_vars['OSSBucket']->value;?>
" data-regex=".*" />
            <span class="input-tips"><s></s>&nbsp;</span>
          </dd>
        </dl>
        <dl class="clearfix">
          <dt><label for="OSSKeyID">Access Key ID：</label></dt>
          <dd>
            <input class="input-large" type="text" name="OSSKeyID" id="OSSKeyID" value="<?php echo $_smarty_tpl->tpl_vars['OSSKeyID']->value;?>
" data-regex=".*" />
            <span class="input-tips"><s></s>&nbsp;</span>
          </dd>
        </dl>
        <dl class="clearfix">
          <dt><label for="OSSKeySecret">Access Key Secret：</label></dt>
          <dd>
            <input class="input-large" type="text" name="OSSKeySecret" id="OSSKeySecret" value="<?php echo $_smarty_tpl->tpl_vars['OSSKeySecret']->value;?>
" data-regex=".*" />
            <span class="input-tips"><s></s>&nbsp;</span>
          </dd>
        </dl>
      </div>
    </div>
    <dl class="clearfix">
      <dt>状态：</dt>
      <dd class="singel-line">
        <a href="javascript:;" id="checkFtpConn">点击检测是否可用</a>
      </dd>
    </dl>
  </div>
  <div class="item hide">
    <dl class="clearfix">
      <dt>水印设置：</dt>
      <dd class="radio">
        <?php echo smarty_function_html_radios(array('name'=>"articleMark",'values'=>$_smarty_tpl->tpl_vars['articleMark']->value,'checked'=>$_smarty_tpl->tpl_vars['articleMarkChecked']->value,'output'=>$_smarty_tpl->tpl_vars['articleMarkNames']->value,'separator'=>"&nbsp;&nbsp;"),$_smarty_tpl);?>

      </dd>
    </dl>
    <?php if ($_smarty_tpl->tpl_vars['articleMarkChecked']->value==1) {?>
    <div>
    <?php } else { ?>
    <div class="hide">
    <?php }?>
      <dl class="clearfix">
        <dt><label for="thumbMarkState">缩略图水印：</label></dt>
        <dd>
          <?php echo smarty_function_html_radios(array('name'=>"thumbMarkState",'values'=>$_smarty_tpl->tpl_vars['thumbMarkState']->value,'checked'=>$_smarty_tpl->tpl_vars['thumbMarkStateChecked']->value,'output'=>$_smarty_tpl->tpl_vars['thumbMarkStateNames']->value,'separator'=>"&nbsp;&nbsp;"),$_smarty_tpl);?>

        </dd>
      </dl>
      <dl class="clearfix">
        <dt><label for="atlasMarkState">图集水印：</label></dt>
        <dd>
          <?php echo smarty_function_html_radios(array('name'=>"atlasMarkState",'values'=>$_smarty_tpl->tpl_vars['atlasMarkState']->value,'checked'=>$_smarty_tpl->tpl_vars['atlasMarkStateChecked']->value,'output'=>$_smarty_tpl->tpl_vars['atlasMarkStateNames']->value,'separator'=>"&nbsp;&nbsp;"),$_smarty_tpl);?>

        </dd>
      </dl>
      <dl class="clearfix">
        <dt><label for="editorMarkState">编辑器水印：</label></dt>
        <dd>
          <?php echo smarty_function_html_radios(array('name'=>"editorMarkState",'values'=>$_smarty_tpl->tpl_vars['editorMarkState']->value,'checked'=>$_smarty_tpl->tpl_vars['editorMarkStateChecked']->value,'output'=>$_smarty_tpl->tpl_vars['editorMarkStateNames']->value,'separator'=>"&nbsp;&nbsp;"),$_smarty_tpl);?>

        </dd>
      </dl>
      <dl class="clearfix">
        <dt><label>水印尺寸限制：</label></dt>
        <dd>
          <div class="input-prepend input-append">
            <span class="add-on">宽</span>
            <input class="span1" id="waterMarkWidth" name="waterMarkWidth" type="text" value="<?php echo $_smarty_tpl->tpl_vars['waterMarkWidth']->value;?>
" />
            <span class="add-on">px</span>
          </div>
          &times;
          <div class="input-prepend input-append">
            <span class="add-on">高</span>
            <input class="span1" id="waterMarkHeight" name="waterMarkHeight" type="text" value="<?php echo $_smarty_tpl->tpl_vars['waterMarkHeight']->value;?>
" />
            <span class="add-on">px</span>
          </div>
        </dd>
      </dl>
      <dl class="clearfix">
        <dt><label>水印位置：</label></dt>
        <dd>
          <ul class="clearfix watermarkpostion">
            <li<?php if ($_smarty_tpl->tpl_vars['waterMarkPostion']->value==1) {?> class="current"<?php }?> data-id="1"><a href="javascript:;">左上</a></li>
            <li<?php if ($_smarty_tpl->tpl_vars['waterMarkPostion']->value==2) {?> class="current"<?php }?> data-id="2"><a href="javascript:;">中上</a></li>
            <li<?php if ($_smarty_tpl->tpl_vars['waterMarkPostion']->value==3) {?> class="current"<?php }?> data-id="3"><a href="javascript:;">右上</a></li>
            <li<?php if ($_smarty_tpl->tpl_vars['waterMarkPostion']->value==4) {?> class="current"<?php }?> data-id="4"><a href="javascript:;">左中</a></li>
            <li<?php if ($_smarty_tpl->tpl_vars['waterMarkPostion']->value==5) {?> class="current"<?php }?> data-id="5"><a href="javascript:;">中心</a></li>
            <li<?php if ($_smarty_tpl->tpl_vars['waterMarkPostion']->value==6) {?> class="current"<?php }?> data-id="6"><a href="javascript:;">右中</a></li>
            <li<?php if ($_smarty_tpl->tpl_vars['waterMarkPostion']->value==7) {?> class="current"<?php }?> data-id="7"><a href="javascript:;">左下</a></li>
            <li<?php if ($_smarty_tpl->tpl_vars['waterMarkPostion']->value==8) {?> class="current"<?php }?> data-id="8"><a href="javascript:;">中下</a></li>
            <li<?php if ($_smarty_tpl->tpl_vars['waterMarkPostion']->value==9) {?> class="current"<?php }?> data-id="9"><a href="javascript:;">右下</a></li>
          </ul>
          <span class="input-tips" style="display:inline-block;"><s></s>不选则随机生成水印位置</span>
          <input type="hidden" name="waterMarkPostion" id="waterMarkPostion" value="<?php echo $_smarty_tpl->tpl_vars['waterMarkPostion']->value;?>
" />
        </dd>
      </dl>
      <dl class="clearfix">
        <dt><label>水印类型：</label></dt>
        <dd>
          <?php echo smarty_function_html_radios(array('name'=>"waterMarkType",'values'=>$_smarty_tpl->tpl_vars['waterMarkType']->value,'checked'=>$_smarty_tpl->tpl_vars['waterMarkTypeChecked']->value,'output'=>$_smarty_tpl->tpl_vars['waterMarkTypeNames']->value,'separator'=>"&nbsp;&nbsp;"),$_smarty_tpl);?>

        </dd>
      </dl>
      <?php if ($_smarty_tpl->tpl_vars['waterMarkTypeChecked']->value==1) {?>
      <div id="markType1">
      <?php } else { ?>
      <div id="markType1" class="hide">
      <?php }?>
        <dl class="clearfix">
          <dt><label for="markText">水印文字：</label></dt>
          <dd>
            <input class="input-large" type="text" name="markText" id="markText" value="<?php echo $_smarty_tpl->tpl_vars['markText']->value;?>
" data-regex=".*" />
          <span class="input-tips"><s></s>&nbsp;</span>
          </dd>
        </dl>
        <dl class="clearfix">
          <dt><label for="markFontfamily">水印字体：</label></dt>
          <dd>
            <select name="markFontfamily" id="markFontfamily">
              <?php echo smarty_function_html_options(array('values'=>$_smarty_tpl->tpl_vars['markFontfamily']->value,'selected'=>$_smarty_tpl->tpl_vars['markFontfamilySelected']->value,'output'=>$_smarty_tpl->tpl_vars['markFontfamily']->value),$_smarty_tpl);?>

            </select>
            <span class="input-tips" style="display:inline-block;"><s></s>水印文件存放在<?php echo $_smarty_tpl->tpl_vars['HUONIAOINC']->value;?>
/data/fonts下</span>
          </dd>
        </dl>
        <dl class="clearfix">
          <dt><label for="markFontsize">水印文字大小：</label></dt>
          <dd>
            <input class="input-small" type="number" min="0" name="markFontsize" id="markFontsize" data-regex="[0-9]\d*" value="<?php echo $_smarty_tpl->tpl_vars['markFontsize']->value;?>
" />
            <span class="input-tips"><s></s>水印文字大小，类型为数字</span>
          </dd>
        </dl>
        <dl class="clearfix">
          <dt><label>文字颜色：</label></dt>
          <dd>
            <div class="color_pick" style="margin:0; border:1px solid #ccc;"><em style="background:<?php echo $_smarty_tpl->tpl_vars['markFontColor']->value;?>
;"></em></div>
            <input type="hidden" name="markFontColor" id="markFontColor" value="<?php echo $_smarty_tpl->tpl_vars['markFontColor']->value;?>
" />
          </dd>
        </dl>
      </div>
      <?php if ($_smarty_tpl->tpl_vars['waterMarkTypeChecked']->value==1) {?>
      <div id="markType2" class="hide">
      <?php } else { ?>
      <div id="markType2">
      <?php }?>
        <dl class="clearfix">
          <dt><label for="markFile">水印文件：</label></dt>
          <dd>
            <select name="markFile" id="markFile">
              <?php echo smarty_function_html_options(array('values'=>$_smarty_tpl->tpl_vars['markFile']->value,'selected'=>$_smarty_tpl->tpl_vars['markFileSelected']->value,'output'=>$_smarty_tpl->tpl_vars['markFile']->value),$_smarty_tpl);?>

            </select>
            <span class="input-tips" style="display:inline-block;"><s></s>水印文件存放在<?php echo $_smarty_tpl->tpl_vars['HUONIAOINC']->value;?>
/data/mark下</span>
          </dd>
        </dl>
      </div>
      <dl class="clearfix">
        <dt><label for="markPadding">水印边距：</label></dt>
        <dd>
          <input class="input-small" type="number" min="0" name="markPadding" id="markPadding" data-regex="[0-9]\d*" value="<?php echo $_smarty_tpl->tpl_vars['markPadding']->value;?>
" />
          <span class="input-tips"><s></s>水印位置与周边距离</span>
        </dd>
      </dl>
      <dl class="clearfix">
        <dt><label for="transparent">水印透明度：</label></dt>
        <dd>
          <input class="input-small" type="number" name="transparent" id="transparent" data-regex="(([0-9]\d?)|(100)|(0))" min="0" max="100" maxlength="3" value="<?php echo $_smarty_tpl->tpl_vars['transparent']->value;?>
" />
          <span class="input-tips"><s></s>数值越大，图标越清晰，值得范围0到100</span>
        </dd>
      </dl>
      <dl class="clearfix">
        <dt><label for="markQuality">水印质量：</label></dt>
        <dd>
          <input class="input-small" type="number" name="markQuality" id="markQuality" data-regex="(([0-9]\d?)|(100)|(0))" min="0" max="100" maxlength="3" value="<?php echo $_smarty_tpl->tpl_vars['markQuality']->value;?>
" />
          <span class="input-tips"><s></s>数字越大越清晰，最高100，建议设置85</span>
        </dd>
      </dl>
    </div>
  </div>
  <dl class="clearfix formbtn">
    <dt>&nbsp;</dt>
    <dd><input class="btn btn-large btn-success" type="submit" name="submit" id="btnSubmit" value="确认提交" /></dd>
  </dl>
</form>

<?php echo $_smarty_tpl->tpl_vars['jsFile']->value;?>

</body>
</html>
<?php }} ?>
