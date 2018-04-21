<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-06-09 11:48:53
         compiled from "D:\ServerWwwroot\www.lwm.com\admin\templates\shop\productAdd.html" */ ?>
<?php /*%%SmartyHeaderCode:22999593a1aa555a0c7-67643975%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c68aab85632dfef6ca4ac1eb8485c300ad07f373' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\admin\\templates\\shop\\productAdd.html',
      1 => 1494490290,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '22999593a1aa555a0c7-67643975',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'cfg_soft_lang' => 0,
    'cssFile' => 0,
    'thumbSize' => 0,
    'thumbType' => 0,
    'atlasSize' => 0,
    'atlasType' => 0,
    'imglist' => 0,
    'specifiVal' => 0,
    'adminPath' => 0,
    'id' => 0,
    'dopost' => 0,
    'typeid' => 0,
    'itemid' => 0,
    'token' => 0,
    'proType' => 0,
    'brandOption' => 0,
    'proItemList' => 0,
    'title' => 0,
    'storeOption' => 0,
    'mprice' => 0,
    'price' => 0,
    'logistic' => 0,
    'logisticOption' => 0,
    'volume' => 0,
    'weight' => 0,
    'specification' => 0,
    'inventory' => 0,
    'limit' => 0,
    'litpic' => 0,
    'cfg_attachment' => 0,
    'click' => 0,
    'sort' => 0,
    'stateopt' => 0,
    'state' => 0,
    'statenames' => 0,
    'flagopt' => 0,
    'flag' => 0,
    'flagnames' => 0,
    'btime' => 0,
    'etime' => 0,
    'body' => 0,
    'mbody' => 0,
    'editorFile' => 0,
    'jsFile' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_593a1aa563ca08_14023869',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_593a1aa563ca08_14023869')) {function content_593a1aa563ca08_14023869($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_radios')) include 'D:\\ServerWwwroot\\www.lwm.com\\include\\tpl\\plugins\\function.html_radios.php';
if (!is_callable('smarty_function_html_checkboxes')) include 'D:\\ServerWwwroot\\www.lwm.com\\include\\tpl\\plugins\\function.html_checkboxes.php';
if (!is_callable('smarty_modifier_replace')) include 'D:\\ServerWwwroot\\www.lwm.com\\include\\tpl\\plugins\\modifier.replace.php';
?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $_smarty_tpl->tpl_vars['cfg_soft_lang']->value;?>
" />
<title>上架新商品</title>
<?php echo $_smarty_tpl->tpl_vars['cssFile']->value;?>

<style>
.graybg {background:#f5f5f5; padding:5px 0;}
.graybg .input-ok {color:#f5f5f5;}
#specification dd label {float:left; width:140px;}
#speList .speTab {width:auto; max-height:500px; padding-right:10px; overflow:hidden; border: 0; overflow-y:auto; display:inline-block; vertical-align:middle;}
#speList table {vertical-align:middle; color:#333; font-size:14px; border-left:1px solid #d7d7d7; border-bottom:1px solid #d7d7d7;}
#speList table th {height:30px; text-align:center; vertical-align:middle; font-weight:500; border:1px solid #d7d7d7; border-left:none; border-bottom:none; background:#ededed;}
#speList table td {padding:5px; min-width:90px; text-align:center; vertical-align:middle; border:1px solid #d7d7d7; border-left:none; border-bottom:none; background:#fff; white-space:nowrap;}
#speList table td input {height:15px; margin:0;}
</style>
<?php echo '<script'; ?>
>
var thumbSize = <?php echo $_smarty_tpl->tpl_vars['thumbSize']->value;?>
, thumbType = '<?php echo $_smarty_tpl->tpl_vars['thumbType']->value;?>
',  //缩略图配置
	atlasSize = <?php echo $_smarty_tpl->tpl_vars['atlasSize']->value;?>
, atlasType = '<?php echo $_smarty_tpl->tpl_vars['atlasType']->value;?>
', atlasMax = 0;  //图集配置
var imglist = {"list1": <?php echo $_smarty_tpl->tpl_vars['imglist']->value;?>
,},
	specifiVal = <?php echo $_smarty_tpl->tpl_vars['specifiVal']->value;?>
, modelType = 'shop',
	cfg_term = "pc", adminPath = '<?php echo $_smarty_tpl->tpl_vars['adminPath']->value;?>
';
<?php echo '</script'; ?>
>
</head>

<body>
<form action="" method="post" name="editform" id="editform" class="editform">
  <input type="hidden" name="id" id="id" value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" />
  <input type="hidden" name="dopost" id="dopost" value="<?php echo $_smarty_tpl->tpl_vars['dopost']->value;?>
" />
  <input type="hidden" name="typeid" id="typeid" value="<?php echo $_smarty_tpl->tpl_vars['typeid']->value;?>
" />
  <input type="hidden" name="itemid" id="itemid" value="<?php echo $_smarty_tpl->tpl_vars['itemid']->value;?>
" />
  <input type="hidden" name="token" id="token" value="<?php echo $_smarty_tpl->tpl_vars['token']->value;?>
" />
  <dl class="clearfix">
    <dt><label>分类：</label></dt>
    <dd class="singel-line"><?php echo $_smarty_tpl->tpl_vars['proType']->value;?>
&nbsp;&nbsp;[<a id="editType" href="productAdd.php?typeid=<?php echo $_smarty_tpl->tpl_vars['typeid']->value;
if ($_smarty_tpl->tpl_vars['id']->value) {?>&id=<?php echo $_smarty_tpl->tpl_vars['id']->value;
}?>">编辑</a>]</dd>
  </dl>
  <dl class="clearfix">
    <dt><label for="brand">品牌：</label></dt>
    <dd>
      <span><select name="brand" id="brand" class="input-large"><?php echo $_smarty_tpl->tpl_vars['brandOption']->value;?>
</select></span>
      <span class="input-tips"><s></s>请选择商品品牌</span>
    </dd>
  </dl>
  <?php if ($_smarty_tpl->tpl_vars['proItemList']->value!='') {?>
  <div class="graybg" id="proItem">
    <?php echo $_smarty_tpl->tpl_vars['proItemList']->value;?>

  </div>
  <?php }?>
  <dl class="clearfix">
    <dt><label for="title">商品标题：</label></dt>
    <dd>
      <input class="input-xxlarge" type="text" name="title" id="title" data-regex=".{2,60}" maxlength="60" value="<?php echo $_smarty_tpl->tpl_vars['title']->value;?>
" />
      <span class="input-tips"><s></s>请输入标题，3-60个汉字</span>
    </dd>
  </dl>
  <dl class="clearfix">
    <dt><label for="store">所属店铺：</label></dt>
    <dd>
      <select name="store" id="store" class="input-large"><?php echo $_smarty_tpl->tpl_vars['storeOption']->value;?>
</select>
      <span class="input-tips" style="display:inline-block;"><s></s>请选择商品所属店铺</span>
    </dd>
  </dl>
  <dl class="clearfix hide" id="categoryObj">
    <dt><label for="category">店铺商品分类：</label></dt>
    <dd>
      <select name="category[]" id="category" class="input-xlarge" multiple style="height:135px;"></select>
      <span class="input-tips" style="display:inline-block;"><s></s>请选择店铺商品分类，支持多选！</span>
    </dd>
  </dl>
  <dl class="clearfix">
    <dt><label>价格：</label></dt>
    <dd>
      <div class="input-prepend input-append">
        <span class="add-on">市场价</span>
        <input class="input-mini" type="number" name="mprice" id="mprice" value="<?php echo $_smarty_tpl->tpl_vars['mprice']->value;?>
" min="0" data-regex="0|\d*\.?\d+">
        <span class="add-on">元</span>
        <span class="input-tips" style="display:inline-block;"><s></s>数字类型</span>
      </div>
      <br />
      <div class="input-prepend input-append">
        <span class="add-on">一口价</span>
        <input class="input-mini" type="number" name="price" id="price" value="<?php echo $_smarty_tpl->tpl_vars['price']->value;?>
" min="0" data-regex="0|\d*\.?\d+">
        <span class="add-on">元</span>
        <span class="input-tips" style="display:inline-block;"><s></s>数字类型</span>
      </div>
      <!-- <br />
      <div class="input-prepend input-append" style="margin:0;">
        <span class="add-on">物流费</span>
        <input class="input-mini" type="number" name="logistic" id="logistic" value="<?php echo $_smarty_tpl->tpl_vars['logistic']->value;?>
" min="0" data-regex="0|\d*\.?\d+">
        <span class="add-on">元</span>
        <span class="input-tips" style="display:inline-block;"><s></s>输入0表示免运费</span>
      </div> -->
    </dd>
  </dl>
  <dl class="clearfix">
    <dt><label for="logistic">运费设置：</label></dt>
    <dd style="padding-bottom: 10px;">
      <span><select name="logistic" id="logistic" class="input-large"><?php echo $_smarty_tpl->tpl_vars['logisticOption']->value;?>
</select></span>
      <span class="input-tips"><s></s>请选择运费模板</span>
      <br /><span id="logisticDetail" class="hide" style="padding-top: 10px;"><small></small></span>
    </dd>
  </dl>
  <dl class="clearfix">
    <dt><label>物流参数：</label></dt>
    <dd>
      <div class="input-prepend input-append">
        <span class="add-on">体积</span>
        <input class="input-mini" type="text" name="volume" id="volume" value="<?php echo $_smarty_tpl->tpl_vars['volume']->value;?>
" min="0" data-regex="0|\d*\.?\d+">
        <span class="add-on">m³</span>
      </div>
      <br />
      <div class="input-prepend input-append">
        <span class="add-on">重量</span>
        <input class="input-mini" type="text" name="weight" id="weight" value="<?php echo $_smarty_tpl->tpl_vars['weight']->value;?>
" min="0" data-regex="0|\d*\.?\d+">
        <span class="add-on">kg</span>
      </div>
    </dd>
  </dl>
  <?php if ($_smarty_tpl->tpl_vars['specification']->value!='') {?>
  <div class="graybg" id="specification">
    <?php echo $_smarty_tpl->tpl_vars['specification']->value;?>

    <div id="speList" class="hide">
      <dl class="clearfix">
        <dt>规格匹配表：</dt>
        <dd>
          <div class="speTab"><table><thead></thead><tbody></tbody></table></div>
          <span class="input-tips" style="display:inline-block;"><s></s>请补全价格和库存，字段类型为数字！</span>
        </dd>
      </dl>
    </div>
  </div>
  <?php }?>
  <dl class="clearfix">
    <dt><label for="inventory">库存：</label></dt>
    <dd>
      <div class="input-prepend input-append" style="margin:0;">
        <input class="input-mini" type="number" name="inventory" id="inventory" value="<?php echo $_smarty_tpl->tpl_vars['inventory']->value;?>
" min="0" data-regex="0|[1-9]\d*">
        <span class="add-on">件</span>
        <span class="input-tips" style="display:inline-block;"><s></s>数字类型</span>
      </div>
    </dd>
  </dl>
  <dl class="clearfix">
    <dt><label for="limit">限购数量：</label></dt>
    <dd>
      <div class="input-prepend input-append" style="margin:0;">
        <input class="input-mini" type="number" name="limit" id="limit" value="<?php echo $_smarty_tpl->tpl_vars['limit']->value;?>
" min="0" data-regex="0|[1-9]\d*">
        <span class="add-on">件</span>
        <span class="input-tips" style="display:inline-block;"><s></s>数字类型</span>
      </div>
    </dd>
  </dl>
  <dl class="clearfix">
    <dt>代表图片：</dt>
		<dd class="thumb fn-clear listImgBox">
			<div class="uploadinp filePicker thumbtn<?php if ($_smarty_tpl->tpl_vars['litpic']->value!='') {?> hide<?php }?>" id="filePicker1" data-type="thumb"  data-count="1" data-size="<?php echo $_smarty_tpl->tpl_vars['thumbSize']->value;?>
" data-imglist=""><div></div><span></span></div>
			<?php if ($_smarty_tpl->tpl_vars['litpic']->value!='') {?>
			<ul id="listSection1" class="listSection thumblist fn-clear" style="display:inline-block;"><li id="WU_FILE_0_1"><a href='<?php echo $_smarty_tpl->tpl_vars['cfg_attachment']->value;
echo $_smarty_tpl->tpl_vars['litpic']->value;?>
' target="_blank" title=""><img alt="" src="<?php echo $_smarty_tpl->tpl_vars['cfg_attachment']->value;
echo $_smarty_tpl->tpl_vars['litpic']->value;?>
" data-val="<?php echo $_smarty_tpl->tpl_vars['litpic']->value;?>
"/></a><a class="reupload li-rm" href="javascript:;">删除图片</a></li></ul>
			<?php } else { ?>
			<ul id="listSection1" class="listSection thumblist fn-clear"></ul>
			<?php }?>
			<input type="hidden" name="litpic" value="<?php echo $_smarty_tpl->tpl_vars['litpic']->value;?>
" class="imglist-hidden" id="litpic">
		</dd>
  </dl>
  <dl class="clearfix">
    <dt><label for="click">浏览次数：</label></dt>
    <dd>
      <span><input class="input-mini" type="number" name="click" min="0" id="click" value="<?php echo $_smarty_tpl->tpl_vars['click']->value;?>
" /></span>
      <label class="ml30" for="sort">排序：</label><input class="input-mini" type="number" name="sort" id="sort" min="0" data-regex="[1-9]\d*" value="<?php echo $_smarty_tpl->tpl_vars['sort']->value;?>
" />
      <span class="input-tips"><s></s>必填，排序越大，越排在前面</span>
    </dd>
  </dl>
  <dl class="clearfix">
    <dt><label for="state">显示状态：</label></dt>
    <dd class="radio">
      <?php echo smarty_function_html_radios(array('name'=>"state",'values'=>$_smarty_tpl->tpl_vars['stateopt']->value,'checked'=>$_smarty_tpl->tpl_vars['state']->value,'output'=>$_smarty_tpl->tpl_vars['statenames']->value,'separator'=>"&nbsp;&nbsp;"),$_smarty_tpl);?>

    </dd>
  </dl>
  <dl class="clearfix">
    <dt><label for="flag">自定义标签：</label></dt>
    <dd class="radio">
      <?php echo smarty_function_html_checkboxes(array('name'=>"flag",'values'=>$_smarty_tpl->tpl_vars['flagopt']->value,'checked'=>$_smarty_tpl->tpl_vars['flag']->value,'output'=>$_smarty_tpl->tpl_vars['flagnames']->value,'separator'=>"&nbsp;&nbsp;"),$_smarty_tpl);?>

    </dd>
  </dl>
  <dl class="clearfix hide" id="panicbuy"<?php if ($_smarty_tpl->tpl_vars['flag']->value&&in_array(3,$_smarty_tpl->tpl_vars['flag']->value)) {?> style="display:block;"<?php }?>>
    <dt><label>限时抢设置：</label></dt>
    <dd>
      <div class="input-prepend input-append" style="margin:0;">
        <span class="add-on">开始时间</span>
        <input class="input-medium" type="text" name="btime" id="btime" value="<?php echo $_smarty_tpl->tpl_vars['btime']->value;?>
" />
        <span class="add-on">结束时间</span>
        <input class="input-medium" type="text" name="etime" id="etime" value="<?php echo $_smarty_tpl->tpl_vars['etime']->value;?>
" />
      </div>
    </dd>
  </dl>
  <dl class="clearfix">
    <dt>商品图集：</dt>
		<dd class="listImgBox hide">
			<div class="list-holder">
				<ul id="listSection2" class="clearfix listSection piece"></ul>
				<input type="hidden" name="imglist" value='<?php echo $_smarty_tpl->tpl_vars['imglist']->value;?>
' class="imglist-hidden">
			</div>
			<div class="btn-section clearfix">
				<div class="uploadinp filePicker" id="filePicker2" data-type="album" data-count="999" data-size="<?php echo $_smarty_tpl->tpl_vars['atlasSize']->value;?>
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
    <dt>商品描述：</dt>
    <dd>
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
 id="mbody" name="mbody" type="text/plain" style="width:960px;height:500px"><?php echo $_smarty_tpl->tpl_vars['mbody']->value;?>
<?php echo '</script'; ?>
>
      </div>
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
