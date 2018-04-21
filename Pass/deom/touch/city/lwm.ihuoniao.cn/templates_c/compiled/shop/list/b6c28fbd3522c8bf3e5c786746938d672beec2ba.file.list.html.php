<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-06-27 18:41:11
         compiled from "D:\ServerWwwroot\www.lwm.com\templates\shop\default\list.html" */ ?>
<?php /*%%SmartyHeaderCode:2878359523647daf6d3-42087893%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b6c28fbd3522c8bf3e5c786746938d672beec2ba' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\templates\\shop\\default\\list.html',
      1 => 1494490888,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2878359523647daf6d3-42087893',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'seo_title' => 0,
    'shop_title' => 0,
    'shop_keywords' => 0,
    'shop_description' => 0,
    'cfg_basehost' => 0,
    'cfg_staticPath' => 0,
    'templets_skin' => 0,
    'shop_channelDomain' => 0,
    'cfg_hideUrl' => 0,
    'cfg_cookiePre' => 0,
    'cfg_cookieDomain' => 0,
    'brand' => 0,
    'pageUrl' => 0,
    'pageParam' => 0,
    'brandName' => 0,
    'typeid' => 0,
    'typeNameArr' => 0,
    'k' => 0,
    'typeIdArr' => 0,
    'typename' => 0,
    'keywords' => 0,
    'br' => 0,
    'typeArr' => 0,
    'type' => 0,
    'row' => 0,
    'itemType' => 0,
    'l' => 0,
    'itemVal' => 0,
    'specificationType' => 0,
    's' => 0,
    'specificationVal' => 0,
    'orderby' => 0,
    'price' => 0,
    'flagArr' => 0,
    'flag' => 0,
    'fg' => 0,
    'flag0' => 0,
    'flag1' => 0,
    'flag2' => 0,
    'flag3' => 0,
    'page' => 0,
    'item' => 0,
    'specification' => 0,
    'list' => 0,
    'pageInfo' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_59523648003737_54215646',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59523648003737_54215646')) {function content_59523648003737_54215646($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=EDGE">
<title><?php if ($_smarty_tpl->tpl_vars['seo_title']->value!='') {
echo $_smarty_tpl->tpl_vars['seo_title']->value;
} else { ?>商品列表<?php }?>-<?php echo $_smarty_tpl->tpl_vars['shop_title']->value;?>
</title>
<meta name="keywords" content="<?php echo $_smarty_tpl->tpl_vars['shop_keywords']->value;?>
"/>
<meta name="description" content="<?php echo $_smarty_tpl->tpl_vars['shop_description']->value;?>
"/>
<link rel="shortcut icon" href="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
/favicon.ico" type="image/x-icon"/>
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
css/core/base.css" media="all"/>
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
css/common.css" media="all"/>
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
css/public.css" media="all"/>
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
css/goods.css" media="all"/>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
js/core/jquery-1.8.3.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript">
	var masterDomain = '<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
', channelDomain = '<?php echo $_smarty_tpl->tpl_vars['shop_channelDomain']->value;?>
';

	var criticalPoint = 1240, criticalClass = "w1200";
	$("html").addClass($(window).width() > criticalPoint ? criticalClass : "");

	var hideFileUrl = <?php echo $_smarty_tpl->tpl_vars['cfg_hideUrl']->value;?>
, cookiePre = '<?php echo $_smarty_tpl->tpl_vars['cfg_cookiePre']->value;?>
', cookieDomain = '<?php echo $_smarty_tpl->tpl_vars['cfg_cookieDomain']->value;?>
';
<?php echo '</script'; ?>
>
</head>

<?php ob_start();?><?php echo getUrlPath(array('service'=>'shop','template'=>'list'),$_smarty_tpl);?>
<?php $_tmp1=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['pageUrl'] = new Smarty_variable($_tmp1, null, 0);?>

<body>
<?php echo $_smarty_tpl->getSubTemplate ("top.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<div class="bread" id="J_crumbs">
	<p class="fn-clear">
		<span class="fn-left">
			<a href="<?php echo $_smarty_tpl->tpl_vars['shop_channelDomain']->value;?>
">首页</a>
			> <a href="<?php echo getUrlPath(array('service'=>'shop','template'=>'list'),$_smarty_tpl);?>
#J_crumbs">所有商品</a>
			<?php if ($_smarty_tpl->tpl_vars['brand']->value) {?> > <a href="<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['pageUrl']->value;?>
<?php $_tmp2=ob_get_clean();?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['pageParam']->value;?>
<?php $_tmp3=ob_get_clean();?><?php echo getUrlParam(array('url'=>$_tmp2,'data'=>$_tmp3),$_smarty_tpl);?>
#J_crumbs"><?php echo $_smarty_tpl->tpl_vars['brandName']->value;?>
</a><?php }?>
			<?php if ($_smarty_tpl->tpl_vars['typeid']->value) {?>
			<?php  $_smarty_tpl->tpl_vars['typename'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['typename']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['typeNameArr']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['typename']->key => $_smarty_tpl->tpl_vars['typename']->value) {
$_smarty_tpl->tpl_vars['typename']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['typename']->key;
?>
			> <a href="<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['pageUrl']->value;?>
<?php $_tmp4=ob_get_clean();?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['pageParam']->value;?>
<?php $_tmp5=ob_get_clean();?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['typeIdArr']->value[$_smarty_tpl->tpl_vars['k']->value];?>
<?php $_tmp6=ob_get_clean();?><?php echo getUrlParam(array('url'=>$_tmp4,'data'=>$_tmp5,'typeid'=>$_tmp6,'item'=>'','specification'=>''),$_smarty_tpl);?>
#J_crumbs"><?php echo $_smarty_tpl->tpl_vars['typename']->value;?>
</a>
			<?php } ?>
			<?php }?>
		</span>

		<?php if ($_smarty_tpl->tpl_vars['keywords']->value!='') {?>
		<a href="<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['pageUrl']->value;?>
<?php $_tmp7=ob_get_clean();?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['pageParam']->value;?>
<?php $_tmp8=ob_get_clean();?><?php echo getUrlParam(array('url'=>$_tmp7,'data'=>$_tmp8,'keywords'=>''),$_smarty_tpl);?>
#J_crumbs" class="filter-item search fn-left">关键词：<?php echo $_smarty_tpl->tpl_vars['keywords']->value;?>
<span class="close">×</span></a>
		<?php }?>
	</p>
</div>

<div class="content clearfix">
	<div class="select">
		<div class="selCon">
			<span>品牌</span><font>|</font>
			<p>
				<a<?php if ($_smarty_tpl->tpl_vars['brand']->value=='') {?> class="on"<?php }?> href="<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['pageUrl']->value;?>
<?php $_tmp9=ob_get_clean();?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['pageParam']->value;?>
<?php $_tmp10=ob_get_clean();?><?php echo getUrlParam(array('url'=>$_tmp9,'data'=>$_tmp10,'brand'=>''),$_smarty_tpl);?>
#J_crumbs">不限</a>
				<?php $_smarty_tpl->smarty->_tag_stack[] = array('shop', array('action'=>"brand",'return'=>"br",'page'=>1,'pageSize'=>999999)); $_block_repeat=true; echo shop(array('action'=>"brand",'return'=>"br",'page'=>1,'pageSize'=>999999), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

				<a<?php if ($_smarty_tpl->tpl_vars['brand']->value==$_smarty_tpl->tpl_vars['br']->value['id']) {?> class="on"<?php }?> href="<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['pageUrl']->value;?>
<?php $_tmp11=ob_get_clean();?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['pageParam']->value;?>
<?php $_tmp12=ob_get_clean();?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['br']->value['id'];?>
<?php $_tmp13=ob_get_clean();?><?php echo getUrlParam(array('url'=>$_tmp11,'data'=>$_tmp12,'brand'=>$_tmp13),$_smarty_tpl);?>
#J_crumbs"><?php echo $_smarty_tpl->tpl_vars['br']->value['title'];?>
</a>
				<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo shop(array('action'=>"brand",'return'=>"br",'page'=>1,'pageSize'=>999999), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

			</p>
		</div>
		<?php if ($_smarty_tpl->tpl_vars['typeArr']->value) {?>
		<div class="selCon">
			<span>类别</span><font>|</font>
			<p>
				<a<?php if ($_smarty_tpl->tpl_vars['typeid']->value==$_smarty_tpl->tpl_vars['typeIdArr']->value[count($_smarty_tpl->tpl_vars['typeIdArr']->value)-1]) {?> class="on"<?php }?> href="<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['pageUrl']->value;?>
<?php $_tmp14=ob_get_clean();?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['pageParam']->value;?>
<?php $_tmp15=ob_get_clean();?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['typeIdArr']->value[count($_smarty_tpl->tpl_vars['typeIdArr']->value)-2];?>
<?php $_tmp16=ob_get_clean();?><?php echo getUrlParam(array('url'=>$_tmp14,'data'=>$_tmp15,'typeid'=>$_tmp16,'item'=>'','specification'=>''),$_smarty_tpl);?>
#J_crumbs">不限</a>
				<?php  $_smarty_tpl->tpl_vars['type'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['type']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['typeArr']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['type']->key => $_smarty_tpl->tpl_vars['type']->value) {
$_smarty_tpl->tpl_vars['type']->_loop = true;
?>
				<a href="<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['pageUrl']->value;?>
<?php $_tmp17=ob_get_clean();?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['pageParam']->value;?>
<?php $_tmp18=ob_get_clean();?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['type']->value['id'];?>
<?php $_tmp19=ob_get_clean();?><?php echo getUrlParam(array('url'=>$_tmp17,'data'=>$_tmp18,'typeid'=>$_tmp19,'item'=>'','specification'=>''),$_smarty_tpl);?>
#J_crumbs"><?php echo $_smarty_tpl->tpl_vars['type']->value['typename'];?>
</a>
				<?php } ?>
			</p>
		</div>
		<?php } else { ?>
		<div class="selCon">
			<span>类别</span><font>|</font>
			<p>
				<a href="<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['pageUrl']->value;?>
<?php $_tmp20=ob_get_clean();?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['pageParam']->value;?>
<?php $_tmp21=ob_get_clean();?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['typeIdArr']->value[count($_smarty_tpl->tpl_vars['typeIdArr']->value)-3];?>
<?php $_tmp22=ob_get_clean();?><?php echo getUrlParam(array('url'=>$_tmp20,'data'=>$_tmp21,'typeid'=>$_tmp22,'item'=>'','specification'=>''),$_smarty_tpl);?>
#J_crumbs">不限</a>
				<?php $_smarty_tpl->smarty->_tag_stack[] = array('shop', array('action'=>"type",'return'=>"type",'type'=>$_smarty_tpl->tpl_vars['typeIdArr']->value[count($_smarty_tpl->tpl_vars['typeIdArr']->value)-2])); $_block_repeat=true; echo shop(array('action'=>"type",'return'=>"type",'type'=>$_smarty_tpl->tpl_vars['typeIdArr']->value[count($_smarty_tpl->tpl_vars['typeIdArr']->value)-2]), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

				<a<?php if ($_smarty_tpl->tpl_vars['typeid']->value==$_smarty_tpl->tpl_vars['type']->value['id']) {?> class="on"<?php }?> href="<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['pageUrl']->value;?>
<?php $_tmp23=ob_get_clean();?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['pageParam']->value;?>
<?php $_tmp24=ob_get_clean();?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['type']->value['id'];?>
<?php $_tmp25=ob_get_clean();?><?php echo getUrlParam(array('url'=>$_tmp23,'data'=>$_tmp24,'typeid'=>$_tmp25,'item'=>'','specification'=>''),$_smarty_tpl);?>
#J_crumbs"><?php echo $_smarty_tpl->tpl_vars['type']->value['typename'];?>
</a>
				<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo shop(array('action'=>"type",'return'=>"type",'type'=>$_smarty_tpl->tpl_vars['typeIdArr']->value[count($_smarty_tpl->tpl_vars['typeIdArr']->value)-2]), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

			</p>
		</div>
		<?php }?>

		<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['typeid']->value;?>
<?php $_tmp26=ob_get_clean();?><?php $_smarty_tpl->smarty->_tag_stack[] = array('shop', array('action'=>"typeItem",'typeid'=>$_tmp26)); $_block_repeat=true; echo shop(array('action'=>"typeItem",'typeid'=>$_tmp26), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

		<div class="selCon">
			<span><?php echo $_smarty_tpl->tpl_vars['row']->value['typeName'];?>
</span><font>|</font>
			<p>
				<a<?php if (!in_array($_smarty_tpl->tpl_vars['row']->value['id'],$_smarty_tpl->tpl_vars['itemType']->value)) {?> class="on"<?php }?> href="<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['pageUrl']->value;?>
<?php $_tmp27=ob_get_clean();?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['pageParam']->value;?>
<?php $_tmp28=ob_get_clean();?><?php echo getUrlParam(array('url'=>$_tmp27,'data'=>$_tmp28,'item'=>((string)$_smarty_tpl->tpl_vars['row']->value['id']).":0"),$_smarty_tpl);?>
#J_crumbs">不限</a>
				<?php  $_smarty_tpl->tpl_vars['l'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['l']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['row']->value['listItem']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['l']->key => $_smarty_tpl->tpl_vars['l']->value) {
$_smarty_tpl->tpl_vars['l']->_loop = true;
?>
				<a<?php if (in_array($_smarty_tpl->tpl_vars['l']->value['id'],$_smarty_tpl->tpl_vars['itemVal']->value)) {?> class="on"<?php }?> href="<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['pageUrl']->value;?>
<?php $_tmp29=ob_get_clean();?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['pageParam']->value;?>
<?php $_tmp30=ob_get_clean();?><?php echo getUrlParam(array('url'=>$_tmp29,'data'=>$_tmp30,'item'=>((string)$_smarty_tpl->tpl_vars['row']->value['id']).":".((string)$_smarty_tpl->tpl_vars['l']->value['id'])),$_smarty_tpl);?>
#J_crumbs"><?php echo $_smarty_tpl->tpl_vars['l']->value['val'];?>
</a>
				<?php } ?>
			</p>
		</div>
		<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo shop(array('action'=>"typeItem",'typeid'=>$_tmp26), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>


		<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['typeid']->value;?>
<?php $_tmp31=ob_get_clean();?><?php $_smarty_tpl->smarty->_tag_stack[] = array('shop', array('action'=>"typeSpecification",'typeid'=>$_tmp31)); $_block_repeat=true; echo shop(array('action'=>"typeSpecification",'typeid'=>$_tmp31), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

		<div class="selCon">
			<span><?php echo $_smarty_tpl->tpl_vars['row']->value['typeName'];?>
</span><font>|</font>
			<p>
				<a<?php if (!in_array($_smarty_tpl->tpl_vars['row']->value['id'],$_smarty_tpl->tpl_vars['specificationType']->value)) {?> class="on"<?php }?> href="<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['pageUrl']->value;?>
<?php $_tmp32=ob_get_clean();?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['pageParam']->value;?>
<?php $_tmp33=ob_get_clean();?><?php echo getUrlParam(array('url'=>$_tmp32,'data'=>$_tmp33,'specification'=>((string)$_smarty_tpl->tpl_vars['row']->value['id']).":0"),$_smarty_tpl);?>
#J_crumbs">不限</a>
				<?php  $_smarty_tpl->tpl_vars['s'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['s']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['row']->value['listItem']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['s']->key => $_smarty_tpl->tpl_vars['s']->value) {
$_smarty_tpl->tpl_vars['s']->_loop = true;
?>
				<a<?php if (in_array($_smarty_tpl->tpl_vars['s']->value['id'],$_smarty_tpl->tpl_vars['specificationVal']->value)) {?> class="on"<?php }?> href="<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['pageUrl']->value;?>
<?php $_tmp34=ob_get_clean();?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['pageParam']->value;?>
<?php $_tmp35=ob_get_clean();?><?php echo getUrlParam(array('url'=>$_tmp34,'data'=>$_tmp35,'specification'=>((string)$_smarty_tpl->tpl_vars['row']->value['id']).":".((string)$_smarty_tpl->tpl_vars['s']->value['id'])),$_smarty_tpl);?>
#J_crumbs"><?php echo $_smarty_tpl->tpl_vars['s']->value['val'];?>
</a>
				<?php } ?>
			</p>
		</div>
		<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo shop(array('action'=>"typeSpecification",'typeid'=>$_tmp31), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

	</div>

	<div class="selectX">
		<span class="left zh<?php if ($_smarty_tpl->tpl_vars['orderby']->value==0) {?> on<?php }?>"><a href="<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['pageUrl']->value;?>
<?php $_tmp36=ob_get_clean();?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['pageParam']->value;?>
<?php $_tmp37=ob_get_clean();?><?php echo getUrlParam(array('url'=>$_tmp36,'data'=>$_tmp37,'orderby'=>''),$_smarty_tpl);?>
#J_crumbs">综合排序</a></span><font class="left">|</font>
		<span class="left"><em<?php if ($_smarty_tpl->tpl_vars['orderby']->value==1||$_smarty_tpl->tpl_vars['orderby']->value==2) {?> class="on"<?php }?>><?php if ($_smarty_tpl->tpl_vars['orderby']->value==2) {?>销量从低到高<?php } elseif ($_smarty_tpl->tpl_vars['orderby']->value==1) {?>销量从高到低<?php } else { ?>销量<?php }?></em><i class="arrow-bottom"><em></em></i>
			<ul style="display: none;">
				<?php if (($_smarty_tpl->tpl_vars['orderby']->value!=1&&$_smarty_tpl->tpl_vars['orderby']->value!=2)||$_smarty_tpl->tpl_vars['orderby']->value==1) {?>
				<li><a href="<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['pageUrl']->value;?>
<?php $_tmp38=ob_get_clean();?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['pageParam']->value;?>
<?php $_tmp39=ob_get_clean();?><?php echo getUrlParam(array('url'=>$_tmp38,'data'=>$_tmp39,'orderby'=>1),$_smarty_tpl);?>
#J_crumbs">销量从高到低</a></li>
				<li><a href="<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['pageUrl']->value;?>
<?php $_tmp40=ob_get_clean();?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['pageParam']->value;?>
<?php $_tmp41=ob_get_clean();?><?php echo getUrlParam(array('url'=>$_tmp40,'data'=>$_tmp41,'orderby'=>2),$_smarty_tpl);?>
#J_crumbs">销量从低到高</a></li>
				<?php }?>
				<?php if ($_smarty_tpl->tpl_vars['orderby']->value==2) {?>
				<li><a href="<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['pageUrl']->value;?>
<?php $_tmp42=ob_get_clean();?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['pageParam']->value;?>
<?php $_tmp43=ob_get_clean();?><?php echo getUrlParam(array('url'=>$_tmp42,'data'=>$_tmp43,'orderby'=>2),$_smarty_tpl);?>
#J_crumbs">销量从低到高</a></li>
				<li><a href="<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['pageUrl']->value;?>
<?php $_tmp44=ob_get_clean();?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['pageParam']->value;?>
<?php $_tmp45=ob_get_clean();?><?php echo getUrlParam(array('url'=>$_tmp44,'data'=>$_tmp45,'orderby'=>1),$_smarty_tpl);?>
#J_crumbs">销量从高到低</a></li>
				<?php }?>
			</ul>
		</span>
		<span class="left"><em<?php if ($_smarty_tpl->tpl_vars['orderby']->value==3||$_smarty_tpl->tpl_vars['orderby']->value==4) {?> class="on"<?php }?>><?php if ($_smarty_tpl->tpl_vars['orderby']->value==3) {?>价格从低到高<?php } elseif ($_smarty_tpl->tpl_vars['orderby']->value==4) {?>价格从高到低<?php } else { ?>价格<?php }?></em><i class="arrow-bottom"><em></em></i>
			<ul style="display:none">
				<?php if (($_smarty_tpl->tpl_vars['orderby']->value!=3&&$_smarty_tpl->tpl_vars['orderby']->value!=4)||$_smarty_tpl->tpl_vars['orderby']->value==3) {?>
				<li><a href="<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['pageUrl']->value;?>
<?php $_tmp46=ob_get_clean();?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['pageParam']->value;?>
<?php $_tmp47=ob_get_clean();?><?php echo getUrlParam(array('url'=>$_tmp46,'data'=>$_tmp47,'orderby'=>3),$_smarty_tpl);?>
#J_crumbs">价格从低到高</a></li>
				<li><a href="<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['pageUrl']->value;?>
<?php $_tmp48=ob_get_clean();?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['pageParam']->value;?>
<?php $_tmp49=ob_get_clean();?><?php echo getUrlParam(array('url'=>$_tmp48,'data'=>$_tmp49,'orderby'=>4),$_smarty_tpl);?>
#J_crumbs">价格从高到低</a></li>
				<?php }?>
				<?php if ($_smarty_tpl->tpl_vars['orderby']->value==4) {?>
				<li><a href="<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['pageUrl']->value;?>
<?php $_tmp50=ob_get_clean();?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['pageParam']->value;?>
<?php $_tmp51=ob_get_clean();?><?php echo getUrlParam(array('url'=>$_tmp50,'data'=>$_tmp51,'orderby'=>4),$_smarty_tpl);?>
#J_crumbs">价格从高到低</a></li>
				<li><a href="<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['pageUrl']->value;?>
<?php $_tmp52=ob_get_clean();?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['pageParam']->value;?>
<?php $_tmp53=ob_get_clean();?><?php echo getUrlParam(array('url'=>$_tmp52,'data'=>$_tmp53,'orderby'=>3),$_smarty_tpl);?>
#J_crumbs">价格从低到高</a></li>
				<?php }?>
			</ul>
		</span>
		<span class="mon">价格：</span>
		<div class="price"><input type="text" id="price1" value="<?php echo $_smarty_tpl->tpl_vars['price']->value[0];?>
" />&yen;</div>
		<div class="line"></div>
		<div class="price"><input type="text" id="price2" value="<?php echo $_smarty_tpl->tpl_vars['price']->value[1];?>
" />&yen;</div>
		<a href="javascript:;" id="search">确定</a>

		<?php $_smarty_tpl->tpl_vars['flag0'] = new Smarty_variable("0", null, 0);?>
		<?php $_smarty_tpl->tpl_vars['flag1'] = new Smarty_variable("1", null, 0);?>
		<?php $_smarty_tpl->tpl_vars['flag2'] = new Smarty_variable("2", null, 0);?>
		<?php $_smarty_tpl->tpl_vars['flag3'] = new Smarty_variable("3", null, 0);?>

		<?php if (in_array("0",$_smarty_tpl->tpl_vars['flagArr']->value)) {?>
		<?php $_smarty_tpl->tpl_vars['flag0'] = new Smarty_variable('', null, 0);?>
		<?php }?>

		<?php if (in_array("1",$_smarty_tpl->tpl_vars['flagArr']->value)) {?>
		<?php $_smarty_tpl->tpl_vars['flag1'] = new Smarty_variable('', null, 0);?>
		<?php }?>

		<?php if (in_array("2",$_smarty_tpl->tpl_vars['flagArr']->value)) {?>
		<?php $_smarty_tpl->tpl_vars['flag2'] = new Smarty_variable('', null, 0);?>
		<?php }?>

		<?php if (in_array("3",$_smarty_tpl->tpl_vars['flagArr']->value)) {?>
		<?php $_smarty_tpl->tpl_vars['flag3'] = new Smarty_variable('', null, 0);?>
		<?php }?>

		<?php if ($_smarty_tpl->tpl_vars['flag']->value!='') {?>
		<?php  $_smarty_tpl->tpl_vars['fg'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['fg']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['flagArr']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['fg']->key => $_smarty_tpl->tpl_vars['fg']->value) {
$_smarty_tpl->tpl_vars['fg']->_loop = true;
?>
			<?php if ($_smarty_tpl->tpl_vars['fg']->value!="0") {?>
				<?php if ($_smarty_tpl->tpl_vars['flag0']->value=='') {?>
					<?php $_smarty_tpl->tpl_vars['flag0'] = new Smarty_variable(($_smarty_tpl->tpl_vars['flag0']->value).($_smarty_tpl->tpl_vars['fg']->value), null, 0);?>
				<?php } else { ?>
					<?php $_smarty_tpl->tpl_vars['flag0'] = new Smarty_variable((($_smarty_tpl->tpl_vars['flag0']->value).(",")).($_smarty_tpl->tpl_vars['fg']->value), null, 0);?>
				<?php }?>
			<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['fg']->value!="1") {?>
				<?php if ($_smarty_tpl->tpl_vars['flag1']->value=='') {?>
					<?php $_smarty_tpl->tpl_vars['flag1'] = new Smarty_variable(($_smarty_tpl->tpl_vars['flag1']->value).($_smarty_tpl->tpl_vars['fg']->value), null, 0);?>
				<?php } else { ?>
					<?php $_smarty_tpl->tpl_vars['flag1'] = new Smarty_variable((($_smarty_tpl->tpl_vars['flag1']->value).(",")).($_smarty_tpl->tpl_vars['fg']->value), null, 0);?>
				<?php }?>
			<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['fg']->value!="2") {?>
				<?php if ($_smarty_tpl->tpl_vars['flag2']->value=='') {?>
					<?php $_smarty_tpl->tpl_vars['flag2'] = new Smarty_variable(($_smarty_tpl->tpl_vars['flag2']->value).($_smarty_tpl->tpl_vars['fg']->value), null, 0);?>
				<?php } else { ?>
					<?php $_smarty_tpl->tpl_vars['flag2'] = new Smarty_variable((($_smarty_tpl->tpl_vars['flag2']->value).(",")).($_smarty_tpl->tpl_vars['fg']->value), null, 0);?>
				<?php }?>
			<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['fg']->value!="3") {?>
				<?php if ($_smarty_tpl->tpl_vars['flag3']->value=='') {?>
					<?php $_smarty_tpl->tpl_vars['flag3'] = new Smarty_variable(($_smarty_tpl->tpl_vars['flag3']->value).($_smarty_tpl->tpl_vars['fg']->value), null, 0);?>
				<?php } else { ?>
					<?php $_smarty_tpl->tpl_vars['flag3'] = new Smarty_variable((($_smarty_tpl->tpl_vars['flag3']->value).(",")).($_smarty_tpl->tpl_vars['fg']->value), null, 0);?>
				<?php }?>
			<?php }?>
		<?php } ?>
		<?php }?>

		<div class="filter">
			<a href="<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['pageUrl']->value;?>
<?php $_tmp54=ob_get_clean();?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['pageParam']->value;?>
<?php $_tmp55=ob_get_clean();?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['flag0']->value;?>
<?php $_tmp56=ob_get_clean();?><?php echo getUrlParam(array('url'=>$_tmp54,'data'=>$_tmp55,'flag'=>$_tmp56),$_smarty_tpl);?>
#J_crumbs"<?php if (in_array('0',$_smarty_tpl->tpl_vars['flagArr']->value)) {?> class="on"<?php }?>><s></s>推荐</a>
			<a href="<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['pageUrl']->value;?>
<?php $_tmp57=ob_get_clean();?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['pageParam']->value;?>
<?php $_tmp58=ob_get_clean();?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['flag1']->value;?>
<?php $_tmp59=ob_get_clean();?><?php echo getUrlParam(array('url'=>$_tmp57,'data'=>$_tmp58,'flag'=>$_tmp59),$_smarty_tpl);?>
#J_crumbs"<?php if (in_array('1',$_smarty_tpl->tpl_vars['flagArr']->value)) {?> class="on"<?php }?>><s></s>特价</a>
			<a href="<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['pageUrl']->value;?>
<?php $_tmp60=ob_get_clean();?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['pageParam']->value;?>
<?php $_tmp61=ob_get_clean();?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['flag2']->value;?>
<?php $_tmp62=ob_get_clean();?><?php echo getUrlParam(array('url'=>$_tmp60,'data'=>$_tmp61,'flag'=>$_tmp62),$_smarty_tpl);?>
#J_crumbs"<?php if (in_array('2',$_smarty_tpl->tpl_vars['flagArr']->value)) {?> class="on"<?php }?>><s></s>热卖</a>
			<a href="<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['pageUrl']->value;?>
<?php $_tmp63=ob_get_clean();?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['pageParam']->value;?>
<?php $_tmp64=ob_get_clean();?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['flag3']->value;?>
<?php $_tmp65=ob_get_clean();?><?php echo getUrlParam(array('url'=>$_tmp63,'data'=>$_tmp64,'flag'=>$_tmp65),$_smarty_tpl);?>
#J_crumbs"<?php if (in_array('3',$_smarty_tpl->tpl_vars['flagArr']->value)) {?> class="on"<?php }?>><s></s>限时抢</a>
		</div>
		<div class="right">
			<span><em><?php echo $_smarty_tpl->tpl_vars['page']->value;?>
</em>/<label id="totalPage">1<label></label></label></span><a class="pre" href="javascript:;">&lt;</a><a class="next" href="javascript:;">&gt;</a>
		</div>
	</div>

	<ul class="list clearfix">
		<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['keywords']->value;?>
<?php $_tmp66=ob_get_clean();?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['brand']->value;?>
<?php $_tmp67=ob_get_clean();?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['typeid']->value;?>
<?php $_tmp68=ob_get_clean();?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['item']->value;?>
<?php $_tmp69=ob_get_clean();?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['specification']->value;?>
<?php $_tmp70=ob_get_clean();?><?php ob_start();
if ($_smarty_tpl->tpl_vars['price']->value) {?><?php echo (string)$_smarty_tpl->tpl_vars['price']->value[0];?><?php echo ",";?><?php echo (string)$_smarty_tpl->tpl_vars['price']->value[1];?><?php }
$_tmp71=ob_get_clean();?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['flag']->value;?>
<?php $_tmp72=ob_get_clean();?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['orderby']->value;?>
<?php $_tmp73=ob_get_clean();?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['page']->value;?>
<?php $_tmp74=ob_get_clean();?><?php $_smarty_tpl->smarty->_tag_stack[] = array('shop', array('action'=>"slist",'return'=>"list",'title'=>$_tmp66,'brand'=>$_tmp67,'typeid'=>$_tmp68,'item'=>$_tmp69,'specification'=>$_tmp70,'price'=>$_tmp71,'flag'=>$_tmp72,'orderby'=>$_tmp73,'page'=>$_tmp74,'pageSize'=>100)); $_block_repeat=true; echo shop(array('action'=>"slist",'return'=>"list",'title'=>$_tmp66,'brand'=>$_tmp67,'typeid'=>$_tmp68,'item'=>$_tmp69,'specification'=>$_tmp70,'price'=>$_tmp71,'flag'=>$_tmp72,'orderby'=>$_tmp73,'page'=>$_tmp74,'pageSize'=>100), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

		<li><div class="con"><?php if ($_smarty_tpl->tpl_vars['list']->value['hot']==1) {?><em></em><?php }?><a href="<?php echo $_smarty_tpl->tpl_vars['list']->value['url'];?>
" target="_blank"><img src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
images/blank.gif" data-url="<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['list']->value['litpic'];?>
<?php $_tmp75=ob_get_clean();?><?php echo changeFileSize(array('url'=>$_tmp75,'type'=>'middle'),$_smarty_tpl);?>
"><p><?php echo $_smarty_tpl->tpl_vars['list']->value['title'];?>
</p><span>&yen;<font><?php echo $_smarty_tpl->tpl_vars['list']->value['price'];?>
</font><s>&yen;<?php echo $_smarty_tpl->tpl_vars['list']->value['mprice'];?>
</s></span></a></div></li>
		<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo shop(array('action'=>"slist",'return'=>"list",'title'=>$_tmp66,'brand'=>$_tmp67,'typeid'=>$_tmp68,'item'=>$_tmp69,'specification'=>$_tmp70,'price'=>$_tmp71,'flag'=>$_tmp72,'orderby'=>$_tmp73,'page'=>$_tmp74,'pageSize'=>100), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

		<?php if ($_smarty_tpl->tpl_vars['pageInfo']->value['totalCount']==0) {?>
		<li class="empty">抱歉！ 暂无相关商品</li>
		<?php }?>
	</ul>

	<!--分页-->
	<?php echo getPageList(array('service'=>'shop','template'=>'list','pageType'=>'dynamic','param'=>((string)$_smarty_tpl->tpl_vars['pageParam']->value)."&page=#page##J_crumbs"),$_smarty_tpl);?>



</div>

<?php echo $_smarty_tpl->getSubTemplate ("bottom.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo '<script'; ?>
 type="text/javascript">
	var totalCount = <?php echo sprintf("%d",$_smarty_tpl->tpl_vars['pageInfo']->value['totalCount']);?>
, totalPage = <?php echo sprintf("%d",$_smarty_tpl->tpl_vars['pageInfo']->value['totalPage']);?>
, atPage = <?php echo $_smarty_tpl->tpl_vars['page']->value;?>
;
	var priceUrl = '<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['pageUrl']->value;?>
<?php $_tmp76=ob_get_clean();?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['pageParam']->value;?>
<?php $_tmp77=ob_get_clean();?><?php echo getUrlParam(array('url'=>$_tmp76,'data'=>$_tmp77,'price'=>"pricePlaceholder"),$_smarty_tpl);?>
#J_crumbs';
	var pageUrl = '<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['pageUrl']->value;?>
<?php $_tmp78=ob_get_clean();?><?php echo getUrlParam(array('url'=>$_tmp78,'data'=>((string)$_smarty_tpl->tpl_vars['pageParam']->value)."&page=pagePlaceholder"),$_smarty_tpl);?>
#J_crumbs';
<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
js/list.js?v=2"><?php echo '</script'; ?>
>
</body>
</html>
<?php }} ?>
