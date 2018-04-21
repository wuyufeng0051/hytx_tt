<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-05-25 17:28:56
         compiled from "D:\ServerWwwroot\www.lwm.com\admin\templates\article\articleAdd.html" */ ?>
<?php /*%%SmartyHeaderCode:313115926a3d8cbaf08-85537423%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '377dcbda45627c1bfa8d0f3eb216e5487caceff6' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\admin\\templates\\article\\articleAdd.html',
      1 => 1494490306,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '313115926a3d8cbaf08-85537423',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'cfg_soft_lang' => 0,
    'pagetitle' => 0,
    'cssFile' => 0,
    'thumbSize' => 0,
    'thumbType' => 0,
    'atlasSize' => 0,
    'atlasType' => 0,
    'imglist' => 0,
    'typeListArr' => 0,
    'action' => 0,
    'adminPath' => 0,
    'cfg_staticPath' => 0,
    'dopost' => 0,
    'id' => 0,
    'token' => 0,
    'title' => 0,
    'color' => 0,
    'subtitle' => 0,
    'typename' => 0,
    'typeid' => 0,
    'flag' => 0,
    'flagList' => 0,
    'flagitem' => 0,
    'flags' => 0,
    'redirecturl' => 0,
    'click' => 0,
    'weight' => 0,
    'litpic' => 0,
    'cfg_attachment' => 0,
    'source' => 0,
    'sourceurl' => 0,
    'writer' => 0,
    'pubdate' => 0,
    'customDelLink' => 0,
    'customAutoLitpic' => 0,
    'body' => 0,
    'mbody' => 0,
    'keywords' => 0,
    'description' => 0,
    'postopt' => 0,
    'notpost' => 0,
    'postnames' => 0,
    'arcrankList' => 0,
    'arcrank' => 0,
    'editorFile' => 0,
    'jsFile' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5926a3d8d18b16_75756364',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5926a3d8d18b16_75756364')) {function content_5926a3d8d18b16_75756364($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_checkboxes')) include 'D:\\ServerWwwroot\\www.lwm.com\\include\\tpl\\plugins\\function.html_checkboxes.php';
if (!is_callable('smarty_modifier_replace')) include 'D:\\ServerWwwroot\\www.lwm.com\\include\\tpl\\plugins\\modifier.replace.php';
if (!is_callable('smarty_function_html_radios')) include 'D:\\ServerWwwroot\\www.lwm.com\\include\\tpl\\plugins\\function.html_radios.php';
if (!is_callable('smarty_function_html_options')) include 'D:\\ServerWwwroot\\www.lwm.com\\include\\tpl\\plugins\\function.html_options.php';
?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $_smarty_tpl->tpl_vars['cfg_soft_lang']->value;?>
" />
<title><?php echo $_smarty_tpl->tpl_vars['pagetitle']->value;?>
</title>
<?php echo $_smarty_tpl->tpl_vars['cssFile']->value;?>

<?php echo '<script'; ?>
>
var thumbSize = <?php echo $_smarty_tpl->tpl_vars['thumbSize']->value;?>
, thumbType = "<?php echo $_smarty_tpl->tpl_vars['thumbType']->value;?>
",  //缩略图配置
	atlasSize = <?php echo $_smarty_tpl->tpl_vars['atlasSize']->value;?>
, atlasType = "<?php echo $_smarty_tpl->tpl_vars['atlasType']->value;?>
", atlasMax = 0;  //图集配置
var imglist = {"list1": <?php echo $_smarty_tpl->tpl_vars['imglist']->value;?>
,},
	typeListArr = <?php echo $_smarty_tpl->tpl_vars['typeListArr']->value;?>
, action = '<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
', modelType = '<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
',
	cfg_term = "pc", adminPath = "<?php echo $_smarty_tpl->tpl_vars['adminPath']->value;?>
", staticPath = '<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
';
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
    <dt><label for="title">信息标题：</label></dt>
    <dd>
      <input class="input-xxlarge" type="text" name="title" id="title" data-regex=".{5,60}" maxlength="60" value="<?php echo $_smarty_tpl->tpl_vars['title']->value;?>
" />
      <div class="color_pick"><em style="background:<?php echo $_smarty_tpl->tpl_vars['color']->value;?>
;"></em></div>
      <span class="input-tips"><s></s>请输入信息标题，5-60个汉字</span>
      <input type="hidden" name="color" id="color" value="<?php echo $_smarty_tpl->tpl_vars['color']->value;?>
" />
    </dd>
  </dl>
  <dl class="clearfix">
    <dt><label for="subtitle">短标题：</label></dt>
    <dd>
      <input class="input-xlarge" type="text" name="subtitle" id="subtitle" data-regex=".{0,36}" maxlength="36" value="<?php echo $_smarty_tpl->tpl_vars['subtitle']->value;?>
" />
      <span class="input-tips"><s></s>请输入简略标题，0-36个汉字</span>
    </dd>
  </dl>
  <dl class="clearfix">
    <dt>信息分类：</dt>
    <dd style="overflow:visible;">
      <div class="btn-group" id="typeBtn" style="margin-left:10px;">
        <button class="btn dropdown-toggle" type="button" data-toggle="dropdown"><?php echo $_smarty_tpl->tpl_vars['typename']->value;?>
<span class="caret"></span></button>
      </div>
      <input type="hidden" name="typeid" id="typeid" value="<?php echo $_smarty_tpl->tpl_vars['typeid']->value;?>
" />
      <span class="input-tips"><s></s>请选择信息分类</span>
    </dd>
  </dl>
  <dl class="clearfix">
    <dt>自定义属性：</dt>
    <dd class="radio"><?php echo smarty_function_html_checkboxes(array('name'=>'flags','values'=>$_smarty_tpl->tpl_vars['flag']->value,'output'=>$_smarty_tpl->tpl_vars['flagList']->value,'selected'=>$_smarty_tpl->tpl_vars['flagitem']->value,'separator'=>"&nbsp;&nbsp;"),$_smarty_tpl);?>
</dd>
  </dl>
  <?php if (strpos($_smarty_tpl->tpl_vars['flags']->value,'t')!==false) {?>
  <dl class="clearfix" id="rDiv">
  <?php } else { ?>
  <dl class="clearfix hide" id="rDiv">
  <?php }?>
    <dt><label for="redirecturl">跳转地址：</label></dt>
    <dd>
      <input class="input-xlarge" type="text" name="redirecturl" id="redirecturl" value="<?php echo $_smarty_tpl->tpl_vars['redirecturl']->value;?>
" data-regex="[a-zA-z]+:\/\/[^\s]+" />
      <span class="input-tips"><s></s>请输入网址，以http://开头</span>
    </dd>
  </dl>
  <dl class="clearfix">
    <dt><label for="click">浏览次数：</label></dt>
    <dd>
      <span><input class="input-mini" type="number" name="click" min="0" id="click" value="<?php echo $_smarty_tpl->tpl_vars['click']->value;?>
" /></span>
      <label class="ml30" for="weight">排序：</label><input class="input-mini" type="number" name="weight" id="weight" min="1" data-regex="[1-9]\d*" value="<?php echo $_smarty_tpl->tpl_vars['weight']->value;?>
" />
      <span class="input-tips"><s></s>必填，排序越大，越排在前面</span>
    </dd>
  </dl>
  <dl class="clearfix">
    <dt>缩略图：</dt>
		<dd class="thumb clearfix listImgBox">
			<div class="uploadinp filePicker thumbtn<?php if ($_smarty_tpl->tpl_vars['litpic']->value!='') {?> hide<?php }?>" id="filePicker1" data-type="thumb"  data-count="1" data-size="<?php echo $_smarty_tpl->tpl_vars['thumbSize']->value;?>
" data-imglist=""><div></div><span></span></div>
			<?php if ($_smarty_tpl->tpl_vars['litpic']->value!='') {?>
			<ul id="listSection1" class="listSection thumblist clearfix" style="display:inline-block;"><li id="WU_FILE_0_1"><a href='<?php echo $_smarty_tpl->tpl_vars['cfg_attachment']->value;
echo $_smarty_tpl->tpl_vars['litpic']->value;?>
' target="_blank" title=""><img alt="" src="<?php echo $_smarty_tpl->tpl_vars['cfg_attachment']->value;
echo $_smarty_tpl->tpl_vars['litpic']->value;?>
" data-val="<?php echo $_smarty_tpl->tpl_vars['litpic']->value;?>
"/></a><a class="reupload li-rm" href="javascript:;">删除图片</a></li></ul>
			<?php } else { ?>
			<ul id="listSection1" class="listSection thumblist clearfix"></ul>
			<?php }?>
			<input type="hidden" name="litpic" value="<?php echo $_smarty_tpl->tpl_vars['litpic']->value;?>
" class="imglist-hidden" id="litpic">
		</dd>
  </dl>
  <dl class="clearfix">
    <dt><label for="source">来源：</label></dt>
    <dd>
      <input class="input-medium" type="text" name="source" id="source" placeholder="信息来源" value="<?php echo $_smarty_tpl->tpl_vars['source']->value;?>
" /><button type="button" class="btn chooseData" data-type="source">选择</button>
      <label class="ml30">来源网址：<input class="input-xxlarge" type="text" name="sourceurl" id="sourceurl" placeholder="来源网址" value="<?php echo $_smarty_tpl->tpl_vars['sourceurl']->value;?>
" style="width: 425px;" /></label>
    </dd>
  </dl>
  <dl class="clearfix">
    <dt><label for="writer">作者：</label></dt>
    <dd>
      <input class="input-medium" type="text" name="writer" id="writer" placeholder="信息作者" value="<?php echo $_smarty_tpl->tpl_vars['writer']->value;?>
" /></label><button type="button" class="btn chooseData" data-type="writer">选择</button>
      <span class="ml30" style="font-size: 14px;">
        发布时间：<div class="input-append form_datetime" style="margin: 0;">
          <input class="input-medium" type="text" name="pubdate" id="pubdate" date-language="ch" value="<?php echo $_smarty_tpl->tpl_vars['pubdate']->value;?>
" />
          <span class="add-on"><i class="icon-time"></i></span>
        </div>
      </span>
    </dd>
  </dl>
  <dl class="clearfix">
    <dt>信息内容：</dt>
    <dd>
      <div style="padding: 3px 0 15px;">
        <label><input name="dellink" type="checkbox" id="dellink" value="1"<?php if ($_smarty_tpl->tpl_vars['customDelLink']->value) {?> checked<?php }?> />删除非站内链接</label> <small>[<a href="javascript:;" id="allowurl">配置</a>]</small>
        <label style="margin-left:15px;"><input name="autolitpic" type="checkbox" id="autolitpic" value="1"<?php if ($_smarty_tpl->tpl_vars['customAutoLitpic']->value) {?> checked<?php }?> />提取第一张图片为缩略图</label>
		<div class="hide">
	        分页方式：<label><input name="sptype" type="radio" value="hand" id="hand" checked="1" />手动</label>
	                <label><input name="sptype" type="radio" value="auto" id="auto" />自动</label>
	        大小：<input class="input-mini" name="spsize" type="text" id="spsize" value="5" size="5" /> K
		</div>
		</div>
      <ul class="nav nav-tabs" style="margin-bottom:5px;">
        <li class="active"><a href="#pc">电脑端</a></li>
        <li><a href="#mobile">移动端</a></li>
      </ul>
      <div id="pc">
      	<?php echo '<script'; ?>
 id="body" name="body" type="text/plain" style="width:85%;height:500px"><?php echo $_smarty_tpl->tpl_vars['body']->value;?>
<?php echo '</script'; ?>
>
      </div>
      <div id="mobile" class="hide">
      	<?php echo '<script'; ?>
 id="mbody" name="mbody" type="text/plain" style="width:85%;height:500px"><?php echo $_smarty_tpl->tpl_vars['mbody']->value;?>
<?php echo '</script'; ?>
>
      </div>
    </dd>
  </dl>
  <dl class="clearfix">
    <dt>信息图集：</dt>
		<dd class="listImgBox hide">
			<div class="list-holder">
				<ul id="listSection2" class="clearfix listSection"></ul>
				<input type="hidden" name="imglist" value='<?php echo $_smarty_tpl->tpl_vars['imglist']->value;?>
' class="imglist-hidden">
			</div>
			<div class="btn-section clearfix">
				<div class="uploadinp filePicker" id="filePicker2" data-type="desc" data-count="999" data-size="<?php echo $_smarty_tpl->tpl_vars['atlasSize']->value;?>
" data-imglist="list1"><div id="flasHolder"></div><span>添加图片</span></div>
				<div class="upload-tip">
					<p><a href="javascript:;" class="hide deleteAllAtlas">删除所有</a>&nbsp;&nbsp;<?php echo smarty_modifier_replace(smarty_modifier_replace($_smarty_tpl->tpl_vars['atlasType']->value,"*.",''),";","、");?>
&nbsp;&nbsp;单张最大<?php echo $_smarty_tpl->tpl_vars['atlasSize']->value/1024;?>
M<span class="fileerror"></span></p>
				</div>
			</div>
		</dd>
  </dl>
  <dl class="clearfix">
    <dt><label for="keywords">关键字：</label></dt>
    <dd>
      <input class="input-xxlarge" type="text" name="keywords" id="keywords" data-regex=".{0,50}" maxlength="50" placeholder="用于搜索引擎，50汉字以内" value="<?php echo $_smarty_tpl->tpl_vars['keywords']->value;?>
" />
      <a href="javascript:;" class="autoget" data-type="keywords">自动获取</a>
      <span class="input-tips"><s></s>用于搜索引擎，50汉字以内</span>
    </dd>
  </dl>
  <dl class="clearfix">
    <dt><label for="description">内容摘要：</label></dt>
    <dd>
      <textarea name="description" id="description" placeholder="10~200汉字之内" data-regex=".{0,200}"><?php echo $_smarty_tpl->tpl_vars['description']->value;?>
</textarea>
      <a href="javascript:;" class="autoget" data-type="description">自动获取</a>
      <span class="input-tips"><s></s>10~200汉字之内</span>
    </dd>
  </dl>
  <dl class="clearfix">
    <dt>评论开关：</dt>
    <dd class="radio">
      <?php echo smarty_function_html_radios(array('name'=>"notpost",'values'=>$_smarty_tpl->tpl_vars['postopt']->value,'checked'=>$_smarty_tpl->tpl_vars['notpost']->value,'output'=>$_smarty_tpl->tpl_vars['postnames']->value,'separator'=>"&nbsp;&nbsp;"),$_smarty_tpl);?>

      <label for="arcrank">阅读权限：
        <select name="arcrank" id="arcrank" class="input-medium">
          <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['arcrankList']->value,'selected'=>$_smarty_tpl->tpl_vars['arcrank']->value),$_smarty_tpl);?>

        </select>
      </label>
    </dd>
  </dl>
  <dl class="clearfix formbtn">
    <dt>&nbsp;</dt>
    <dd><button class="btn btn-large btn-success" type="submit" name="button" id="btnSubmit">确认提交</button></dd>
  </dl>
</form>

<?php echo $_smarty_tpl->tpl_vars['editorFile']->value;?>

<?php echo $_smarty_tpl->tpl_vars['jsFile']->value;?>

</body>
</html>
<?php }} ?>
