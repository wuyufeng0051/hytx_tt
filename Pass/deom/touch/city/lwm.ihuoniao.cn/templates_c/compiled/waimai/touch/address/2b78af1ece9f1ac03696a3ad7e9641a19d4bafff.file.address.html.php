<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-05-23 16:36:25
         compiled from "D:\ServerWwwroot\www.lwm.com\templates\waimai\default\address.html" */ ?>
<?php /*%%SmartyHeaderCode:3966591e7f00903ef9-28563450%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2b78af1ece9f1ac03696a3ad7e9641a19d4bafff' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\templates\\waimai\\default\\address.html',
      1 => 1495528584,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3966591e7f00903ef9-28563450',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_591e7f0090bbf9_48957572',
  'variables' => 
  array (
    'cfg_staticPath' => 0,
    'templets_skin' => 0,
    'detail_id' => 0,
    '_bindex' => 0,
    'address' => 0,
    'addr' => 0,
    'cfg_mapCity' => 0,
    'site_map_key' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_591e7f0090bbf9_48957572')) {function content_591e7f0090bbf9_48957572($_smarty_tpl) {?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no" />
<meta name="format-detection" content="telephone=no" />
<title>选择地址</title>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
js/core/touchScale.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
js/zepto.min.js"><?php echo '</script'; ?>
>
<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
css/base.css">
<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
css/address.css">
<?php echo '<script'; ?>
 type="text/javascript">
	var shopid = <?php echo $_smarty_tpl->tpl_vars['detail_id']->value;?>
, redirectUrl = '<?php echo getUrlPath(array('service'=>"waimai",'template'=>"cart",'id'=>$_smarty_tpl->tpl_vars['detail_id']->value,'param'=>"address=#id"),$_smarty_tpl);?>
';
	var id = 0, lng = "", lat = "";
<?php echo '</script'; ?>
>
</head>

<body>
<div class="pageitem" id="main">
	<div class="lead">
		<p onclick="location.href='<?php echo getUrlPath(array('service'=>'waimai','template'=>'cart','id'=>$_smarty_tpl->tpl_vars['detail_id']->value),$_smarty_tpl);?>
';"></p><span>选择地址</span><b><a href="javascript:;">编辑</a></b>
	</div>
	<div class="new_address fn-clear">
		<a href="javascript:;" id="addNew"><em>新建地址</em><i></i></a>
	</div>
	<div class="Address_list">
		<?php $_smarty_tpl->smarty->_tag_stack[] = array('waimai', array('action'=>"getMemberAddress",'return'=>"addr")); $_block_repeat=true; echo waimai(array('action'=>"getMemberAddress",'return'=>"addr"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

		<div class="add_txt<?php if (($_smarty_tpl->tpl_vars['_bindex']->value['addr']==1&&!$_smarty_tpl->tpl_vars['address']->value)||$_smarty_tpl->tpl_vars['address']->value==$_smarty_tpl->tpl_vars['addr']->value['id']) {?> addbc<?php }?>" data-id="<?php echo $_smarty_tpl->tpl_vars['addr']->value['id'];?>
" data-person="<?php echo $_smarty_tpl->tpl_vars['addr']->value['person'];?>
" data-tel="<?php echo $_smarty_tpl->tpl_vars['addr']->value['tel'];?>
" data-street="<?php echo $_smarty_tpl->tpl_vars['addr']->value['street'];?>
" data-address="<?php echo $_smarty_tpl->tpl_vars['addr']->value['address'];?>
" data-lng="<?php echo $_smarty_tpl->tpl_vars['addr']->value['lng'];?>
" data-lat="<?php echo $_smarty_tpl->tpl_vars['addr']->value['lat'];?>
">
			<ul>
				<li>联系人：<?php echo $_smarty_tpl->tpl_vars['addr']->value['person'];?>
</li>
				<li>电话：<?php echo $_smarty_tpl->tpl_vars['addr']->value['tel'];?>
</li>
				<li>地址：<?php echo $_smarty_tpl->tpl_vars['addr']->value['street'];?>
 <?php echo $_smarty_tpl->tpl_vars['addr']->value['address'];?>
</li>
			</ul>
			<div class="dui"></div>
			<div class="edit"><a href="javascript:;"><i></i></a><b></b></div>
		</div>
		<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo waimai(array('action'=>"getMemberAddress",'return'=>"addr"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

	</div>
</div>

<div class="pageitem" id="add">
	<div class="lead">
		<p onclick="location.hash='main'"></p>
		<span>新增地址</span>
	</div>
	<div class="edit_form">
		<div class="edi">
			<em>联系人</em><input type="text" placeholder="请输入联系人。" id="person">
		</div>
		<div class="edi">
			<em>电话</em><input type="tel" placeholder="请输入联系人的电话。" id="tel">
		</div>
	</div>
	<div class="edit_form1">
		<div class="place">
			<em>街道/小区/建筑</em>
			<span id="local">
				<i><b></b></i>
				<strong>定位中...</strong>
				<a href="javascript:;">手动定位 ></a>
			</span>
		</div>
		<div class="place">
			<em>详细地址</em><input type="text" placeholder="请填写详细地址。" id="address">
		</div>
	</div>
	<div class="edi_button">
		<button id="saveAddress">保存</button>
	</div>
	<div class="warning"></div>
	<div class="wa">
		<ul>
			<li>请您确保</li>
			<li>1)手机GPS（位置信息）为开启状态;</li>
			<li>2)允许我们获取您的GPS定位（位置信息）权限;</li>
			<li>如果出现无法定位或验证地址，请及时联系商户处理，否则有可能迟到或漏送哦。</li>
		</ul>
	</div>
</div>

<div class="pageitem" id="map">
	<div class="lead">
		<p onclick="location.hash='add'"></p>
		<input type="text" id="searchAddr" placeholder="输入名称查找您所在的街道/小区/建筑等">
	</div>
	<div class="map">
		<div id="mapdiv"></div>
		<span class="mapcenter"></span>
	</div>

	<div class="mapresults">
		<ul></ul>
		<!-- <a href="javascript:;" class="elseStreet">没有找到您的建筑物？请点击这里！</a> -->
	</div>

</div>



<?php echo '<script'; ?>
 type="text/javascript">
	var mapCity = '<?php echo $_smarty_tpl->tpl_vars['cfg_mapCity']->value;?>
';
<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="http://api.map.baidu.com/getscript?v=2.0&ak=<?php echo $_smarty_tpl->tpl_vars['site_map_key']->value;?>
&services=&t=<?php echo time();?>
"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
js/address.js"><?php echo '</script'; ?>
>
</body>
</html>
<?php }} ?>
