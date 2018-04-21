<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-06-09 11:50:17
         compiled from "D:\ServerWwwroot\www.lwm.com\templates\shop\default\detail.html" */ ?>
<?php /*%%SmartyHeaderCode:30195593a1af9dc9905-48641553%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'be7ab3fe9bdacdc5e09d5d2c5fc141244936db29' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\templates\\shop\\default\\detail.html',
      1 => 1494490887,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '30195593a1af9dc9905-48641553',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'detail_title' => 0,
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
    'detail_id' => 0,
    'detail_price' => 0,
    'detail_limit' => 0,
    'detail_litpic' => 0,
    'detail_flag' => 0,
    'detail_btime' => 0,
    'detail_etime' => 0,
    'detail_specificationArr' => 0,
    'spe' => 0,
    'item' => 0,
    'detail_specification' => 0,
    'detail_typename' => 0,
    'k' => 0,
    'detail_typeids' => 0,
    'typename' => 0,
    'detail_pics' => 0,
    'pic' => 0,
    'detail_logisticNote' => 0,
    'detail_mprice' => 0,
    'detail_volume' => 0,
    'detail_weight' => 0,
    'detail_inventory' => 0,
    'detail_body' => 0,
    'detail_rating' => 0,
    'detail_score1' => 0,
    'detail_score2' => 0,
    'detail_score3' => 0,
    'detail_store' => 0,
    '_bindex' => 0,
    'row' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_593a1af9e989c1_90963131',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_593a1af9e989c1_90963131')) {function content_593a1af9e989c1_90963131($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_replace')) include 'D:\\ServerWwwroot\\www.lwm.com\\include\\tpl\\plugins\\modifier.replace.php';
?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=EDGE">
<title><?php echo $_smarty_tpl->tpl_vars['detail_title']->value;?>
-<?php echo $_smarty_tpl->tpl_vars['shop_title']->value;?>
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
css/businessD.css" media="all"/>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
js/core/jquery-1.8.3.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript">
	var masterDomain = '<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
', channelDomain = '<?php echo $_smarty_tpl->tpl_vars['shop_channelDomain']->value;?>
', cfg_staticPath = staticPath = '<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
';

	var criticalPoint = 1240, criticalClass = "w1200";
	$("html").addClass($(window).width() > criticalPoint ? criticalClass : "");

	var hideFileUrl = <?php echo $_smarty_tpl->tpl_vars['cfg_hideUrl']->value;?>
, cookiePre = '<?php echo $_smarty_tpl->tpl_vars['cfg_cookiePre']->value;?>
', cookieDomain = '<?php echo $_smarty_tpl->tpl_vars['cfg_cookieDomain']->value;?>
';

	var detailID = <?php echo $_smarty_tpl->tpl_vars['detail_id']->value;?>
;     //当前信息ID
	var detailTitle = '<?php echo $_smarty_tpl->tpl_vars['detail_title']->value;?>
';
	var detailPrice = <?php echo $_smarty_tpl->tpl_vars['detail_price']->value;?>
;
	var maxCount = <?php echo $_smarty_tpl->tpl_vars['detail_limit']->value;?>
;  //最多购买数量
	var detailThumb = '<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['detail_litpic']->value;?>
<?php $_tmp1=ob_get_clean();?><?php echo changeFileSize(array('url'=>$_tmp1,'type'=>'small'),$_smarty_tpl);?>
';   //当前商品缩略图
	var detailUrl = '<?php echo getUrlPath(array('service'=>"shop",'template'=>"detail",'id'=>$_smarty_tpl->tpl_vars['detail_id']->value),$_smarty_tpl);?>
';
	var date = [];
	<?php if (strpos($_smarty_tpl->tpl_vars['detail_flag']->value,"3")!==false) {?>
	date = [<?php echo time();?>
, <?php echo $_smarty_tpl->tpl_vars['detail_btime']->value;?>
, <?php echo $_smarty_tpl->tpl_vars['detail_etime']->value;?>
];
	<?php }?>

	//商品信息-商品颜色和尺寸
	var sku_conf = {

			//属性表
			"property": [
				<?php  $_smarty_tpl->tpl_vars['spe'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['spe']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['detail_specificationArr']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['spe']->key => $_smarty_tpl->tpl_vars['spe']->value) {
$_smarty_tpl->tpl_vars['spe']->_loop = true;
?>
				{
					"name": "<?php echo $_smarty_tpl->tpl_vars['spe']->value['typename'];?>
",
					"options": [
						<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['spe']->value['item']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
						{"id": <?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
,	"name": "<?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
"},
						<?php } ?>
					]
				},
				<?php } ?>
			]

			//属性值
			,"data": {

				<?php  $_smarty_tpl->tpl_vars['spe'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['spe']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['detail_specification']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['spe']->key => $_smarty_tpl->tpl_vars['spe']->value) {
$_smarty_tpl->tpl_vars['spe']->_loop = true;
?>
				<?php if ($_smarty_tpl->tpl_vars['spe']->value['price'][2]>0) {?>
				"<?php echo smarty_modifier_replace($_smarty_tpl->tpl_vars['spe']->value['spe'],"-",";");?>
": {price: <?php echo $_smarty_tpl->tpl_vars['spe']->value['price'][1];?>
, mprice: <?php echo $_smarty_tpl->tpl_vars['spe']->value['price'][0];?>
, stock: <?php echo $_smarty_tpl->tpl_vars['spe']->value['price'][2];?>
},
				<?php }?>
				<?php } ?>
			}
	};

	//商品规格选择
<?php echo '</script'; ?>
>
</head>

<body>
<?php echo $_smarty_tpl->getSubTemplate ("top.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<div class="bread">
	<p><a href="<?php echo $_smarty_tpl->tpl_vars['shop_channelDomain']->value;?>
" target="_blank">首页</a> >
		<?php  $_smarty_tpl->tpl_vars['typename'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['typename']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['detail_typename']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['typename']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['typename']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['typename']->key => $_smarty_tpl->tpl_vars['typename']->value) {
$_smarty_tpl->tpl_vars['typename']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['typename']->key;
 $_smarty_tpl->tpl_vars['typename']->iteration++;
 $_smarty_tpl->tpl_vars['typename']->last = $_smarty_tpl->tpl_vars['typename']->iteration === $_smarty_tpl->tpl_vars['typename']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['foo']['last'] = $_smarty_tpl->tpl_vars['typename']->last;
?>
		<a href="<?php echo getUrlPath(array('service'=>'shop','template'=>'list','param'=>"typeid=".((string)$_smarty_tpl->tpl_vars['detail_typeids']->value[$_smarty_tpl->tpl_vars['k']->value])),$_smarty_tpl);?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['typename']->value;?>
</a>
		<?php if (!$_smarty_tpl->getVariable('smarty')->value['foreach']['foo']['last']) {?>><?php }?>
		<?php } ?>
	</p>
</div>

<div class="content clearfix">
	<div class="left sjLeft">
		<form action="<?php echo getUrlPath(array('service'=>'shop','template'=>'confirm-order'),$_smarty_tpl);?>
" id="buyForm" method="post">
			<input type="hidden" name="pros[]" id="pros" value="" />
			<dl class="singleGoods clearfix">
				<dt>
					<div class="box">
						<div class="tb-booth tb-pic tb-s310">
							<a href="<?php echo $_smarty_tpl->tpl_vars['detail_pics']->value[0]['path'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['detail_pics']->value[0]['path'];?>
" rel="<?php echo $_smarty_tpl->tpl_vars['detail_pics']->value[0]['path'];?>
" class="jqzoom" /></a>
						</div>
						<ul class="tb-thumb" id="thumblist">
							<?php  $_smarty_tpl->tpl_vars['pic'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['pic']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['detail_pics']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['pic']->key => $_smarty_tpl->tpl_vars['pic']->value) {
$_smarty_tpl->tpl_vars['pic']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['pic']->key;
?>
							<?php if ($_smarty_tpl->tpl_vars['k']->value<5) {?>
							<li<?php if ($_smarty_tpl->tpl_vars['k']->value==0) {?> class="tb-selected"<?php }?>>
								<div class="tb-pic tb-s40"><a href="javascript:;">
									<img src="<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['pic']->value['path'];?>
<?php $_tmp2=ob_get_clean();?><?php echo changeFileSize(array('url'=>$_tmp2,'type'=>'small'),$_smarty_tpl);?>
" mid="<?php echo $_smarty_tpl->tpl_vars['pic']->value['path'];?>
" big="<?php echo $_smarty_tpl->tpl_vars['pic']->value['path'];?>
"></a>
								</div>
							</li>
							<?php }?>
							<?php } ?>
						</ul>
					</div>
				</dt>
				<dd class="title"><p><?php echo $_smarty_tpl->tpl_vars['detail_title']->value;?>
</p><em><?php echo $_smarty_tpl->tpl_vars['detail_logisticNote']->value;?>
</em></dd>
				<dd class="info">
					<ul>
						<em>请选择商品信息</em>
						<li><span>原价：</span><s>&yen;<?php echo $_smarty_tpl->tpl_vars['detail_mprice']->value;?>
</s></li>
						<li><span>现价：</span><font>&yen;<?php echo $_smarty_tpl->tpl_vars['detail_price']->value;?>
</font></li>
						<?php if ($_smarty_tpl->tpl_vars['detail_volume']->value>0) {?><li><span>体积：</span><label><?php echo $_smarty_tpl->tpl_vars['detail_volume']->value;?>
m³</label></li><?php }?>
						<?php if ($_smarty_tpl->tpl_vars['detail_weight']->value>0) {?><li><span>重量：</span><label><?php echo $_smarty_tpl->tpl_vars['detail_weight']->value;?>
kg</label></li><?php }?>
						<?php if (strpos($_smarty_tpl->tpl_vars['detail_flag']->value,"3")!==false) {?>
						<li><span>抢购：</span><label class="expiry"></label></li>
						<?php }?>
						<?php if ($_smarty_tpl->tpl_vars['detail_inventory']->value>0) {?>
						<li class="count"><span>数量：</span>
							<div class="num"><input type="text" value="1" readonly ><i class="up"></i><i class="down"></i></div><dfn class="left">件</dfn><var class="left" style="margin-left:20px; font-size: 12px;">库存<b><?php echo $_smarty_tpl->tpl_vars['detail_inventory']->value;?>
</b>件</var><cite style="display: none;">超过当前库存</cite>
						</li>
						<?php }?>
					</ul>
				</dd>
				<?php if ($_smarty_tpl->tpl_vars['detail_inventory']->value<=0) {?>
				<dd class="cartBuy"><a class="btn" href="javascript:;">已售完</a></dd>
				<?php } else { ?>
				<dd class="cartBuy"><a class="buyNow" href="javascript:;">立即购买</a><a class="cart" href="javascript:;">加入购物车</a></dd>
				<?php }?>
			</dl>
		</form>

		<div class="detailComment">
			<div class="left">
				<a class="on" href="javascript:;">商品详情</a>
				<a href="javascript:;">商品评价</a>
			</div>
			<div class="right">
				<span style="float: left; vertical-align: middle; line-height: 28px;">分享到：</span>
				<div class="bdsharebuttonbox">
					<a href="#" class="bds_more" data-cmd="more"></a>
					<a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a>
					<a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a>
					<a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a>
					<a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a>
				</div>
			</div>
		</div>
		<div class="allCon">
			<div class="con detailCon">
				<?php echo $_smarty_tpl->tpl_vars['detail_body']->value;?>

			</div>
			<div class="con comentCon"  style="display: none;">
				<div class="rate">
					<div class="left score"><span><?php echo $_smarty_tpl->tpl_vars['detail_rating']->value*100;?>
<em>%</em></span><i></i></div>
					<div class="left percent">
						<dl><dt>描述(<?php echo $_smarty_tpl->tpl_vars['detail_score1']->value*20;?>
%)</dt><dd><span style=" width: <?php echo $_smarty_tpl->tpl_vars['detail_score1']->value/5*100;?>
%;"></span></dd></dl>
						<dl><dt>服务(<?php echo $_smarty_tpl->tpl_vars['detail_score2']->value*20;?>
%)</dt><dd><span style=" width: <?php echo $_smarty_tpl->tpl_vars['detail_score2']->value/5*100;?>
%;"></span></dd></dl>
						<dl><dt>质量(<?php echo $_smarty_tpl->tpl_vars['detail_score3']->value*20;?>
%)</dt><dd><span style=" width: <?php echo $_smarty_tpl->tpl_vars['detail_score3']->value/5*100;?>
%;"></span></dd></dl>
					</div>
				</div>
				<div class="all-comment">
					<div class="left commentSel">
						<a class="on" href="javascript:;" data-filter="">全部评价</a>
						<a href="javascript:;" data-filter="h">好评</a>
						<a href="javascript:;" data-filter="z">中评</a>
						<a href="javascript:;" data-filter="c">差评</a>
					</div>
				</div>
				<div class="comment-list">
					<p class="loading"><img src="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
/static/images/loading_h8.gif"></p>
					<ul  id="comment-list"></ul>
					<div class="pagination fn-clear"></div>
				</div>
			</div>
		</div>
	</div>
	<div class="right sjRight">
		<?php if ($_smarty_tpl->tpl_vars['detail_store']->value) {?>
		<div class="sjInfo">
			<i class="icon"></i>
			<h3>商家基本信息</h3>
			<div class="sjLogo">
				<a href="<?php echo $_smarty_tpl->tpl_vars['detail_store']->value['domain'];?>
" target="_blank"><s></s><img src="<?php echo $_smarty_tpl->tpl_vars['detail_store']->value['logo'];?>
"></a>
			</div>
			<p><em><a href="<?php echo $_smarty_tpl->tpl_vars['detail_store']->value['domain'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['detail_store']->value['title'];?>
</a></em></p>
			<span><font class="left">联&nbsp;&nbsp;系&nbsp;人：</font><em><?php echo $_smarty_tpl->tpl_vars['detail_store']->value['people'];?>
</em></span>
			<span><font class="left">电&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;话：</font><em><?php echo $_smarty_tpl->tpl_vars['detail_store']->value['tel'];?>
</em></span>
			<span><font class="left">地&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;址：</font><em><?php echo $_smarty_tpl->tpl_vars['detail_store']->value['addr'][0];?>
 <?php echo $_smarty_tpl->tpl_vars['detail_store']->value['addr'][1];?>
 <?php echo $_smarty_tpl->tpl_vars['detail_store']->value['address'];?>
</em></span>
			<span><font class="left">经营产品：</font><em><?php echo $_smarty_tpl->tpl_vars['detail_store']->value['project'];?>
</em></span>
		</div>
		<?php } else { ?>
		<div class="sjInfo">
			<i class="icon"></i>
			<h3>商家基本信息</h3>
			<div class="sjLogo"><br />官方直营</div>
		</div>
		<?php }?>

		<div class="sjInfo hot">
			<h3>热卖商品排行</h3>
			<ul>
				<?php $_smarty_tpl->smarty->_tag_stack[] = array('shop', array('action'=>"slist",'flag'=>"2",'orderby'=>"1",'page'=>"1",'pageSize'=>"10")); $_block_repeat=true; echo shop(array('action'=>"slist",'flag'=>"2",'orderby'=>"1",'page'=>"1",'pageSize'=>"10"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

				<li><i<?php if ($_smarty_tpl->tpl_vars['_bindex']->value['row']<4) {?> class="red"<?php }?>><?php echo $_smarty_tpl->tpl_vars['_bindex']->value['row'];?>
</i><p<?php if ($_smarty_tpl->tpl_vars['_bindex']->value['row']==1) {?> class="on"<?php }?>><?php echo $_smarty_tpl->tpl_vars['row']->value['title'];?>
</p>
					<dl<?php if ($_smarty_tpl->tpl_vars['_bindex']->value['row']==1) {?> class="on"<?php }?>><dt><a href="<?php echo $_smarty_tpl->tpl_vars['row']->value['url'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['row']->value['title'];?>
"><img src="<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['row']->value['litpic'];?>
<?php $_tmp3=ob_get_clean();?><?php echo changeFileSize(array('url'=>$_tmp3,'type'=>'small'),$_smarty_tpl);?>
" alt="<?php echo $_smarty_tpl->tpl_vars['row']->value['title'];?>
" /></a></dt><dd class="t"><a href="<?php echo $_smarty_tpl->tpl_vars['row']->value['url'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['row']->value['title'];?>
"><?php echo $_smarty_tpl->tpl_vars['row']->value['title'];?>
</a></dd><dd>&yen;<?php echo $_smarty_tpl->tpl_vars['row']->value['price'];?>
</dd></dl>
				</li>
				<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo shop(array('action'=>"slist",'flag'=>"2",'orderby'=>"1",'page'=>"1",'pageSize'=>"10"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

			</ul>
		</div>
	</div>
</div>

<?php echo $_smarty_tpl->getSubTemplate ("bottom.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
js/ui/jquery.SuperSlide.2.1.1.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
js/ui/jquery.imagezoom.min.js"><?php echo '</script'; ?>
>
<!--[if lte IE 9]>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
js/ui/requestAnimationFrame.js"><?php echo '</script'; ?>
>
<![endif]-->
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
js/ui/jquery.fly.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
js/goodsD.js?v=1"><?php echo '</script'; ?>
>
</body>
</html>
<?php }} ?>
