<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-06-28 18:18:04
         compiled from "D:\wwwroot\deom\touch\lwm.ihuoniao.cn\templates\siteConfig\default\index.html" */ ?>
<?php /*%%SmartyHeaderCode:288985953825c869607-89905012%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '730ecc563373ab2c454ca98a90899e43eeb006ec' => 
    array (
      0 => 'D:\\wwwroot\\deom\\touch\\lwm.ihuoniao.cn\\templates\\siteConfig\\default\\index.html',
      1 => 1494495301,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '288985953825c869607-89905012',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'cfg_webname' => 0,
    'cfg_keywords' => 0,
    'cfg_description' => 0,
    'cfg_basehost' => 0,
    'templets_skin' => 0,
    'cfg_staticPath' => 0,
    'cfg_hideUrl' => 0,
    'alist' => 0,
    'blist' => 0,
    '_bindex' => 0,
    'article_channelDomain' => 0,
    'clist' => 0,
    'dlist' => 0,
    'installModuleArr' => 0,
    'info_channelDomain' => 0,
    'ilist' => 0,
    'house_channelDomain' => 0,
    'loupan' => 0,
    'sale' => 0,
    'zu' => 0,
    'job_channelDomain' => 0,
    'company' => 0,
    'post' => 0,
    'tuan_channelDomain' => 0,
    'list' => 0,
    'shop_channelDomain' => 0,
    'waimai_channelDomain' => 0,
    'store' => 0,
    'store1' => 0,
    'renovation_channelDomain' => 0,
    'rcase' => 0,
    'team' => 0,
    'diary' => 0,
    'build_channelDomain' => 0,
    'news' => 0,
    'member_busiDomain' => 0,
    'buildBrand' => 0,
    'home_channelDomain' => 0,
    'renovationNews' => 0,
    'renovationNews1' => 0,
    'renovationNews2' => 0,
    'marry_channelDomain' => 0,
    'dating_channelDomain' => 0,
    'story' => 0,
    'activity' => 0,
    'member' => 0,
    'car_channelDomain' => 0,
    'flink' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5953825cb05613_75474694',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5953825cb05613_75474694')) {function content_5953825cb05613_75474694($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_truncate')) include 'D:\\wwwroot\\deom\\touch\\lwm.ihuoniao.cn\\include\\tpl\\plugins\\modifier.truncate.php';
?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=EDGE">
<title><?php echo $_smarty_tpl->tpl_vars['cfg_webname']->value;?>
</title>
<meta name="keywords" content="<?php echo $_smarty_tpl->tpl_vars['cfg_keywords']->value;?>
" />
<meta name="description" content="<?php echo $_smarty_tpl->tpl_vars['cfg_description']->value;?>
" />
<link rel="shortcut icon" href="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
/favicon.ico" type="image/x-icon" />
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
css/base.css?v=1" media="all" />
<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
css/index_public.css?v=1" />
<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
css/index.css?v=1" />
<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
css/kf.css?v=1" />
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
js/core/jquery-1.8.3.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript">
	var masterDomain = '<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
';
	var criticalPoint = 1240, criticalClass = "w1200";
	$("html").addClass($(window).width() > criticalPoint ? criticalClass : "");
	var hideFileUrl = <?php echo $_smarty_tpl->tpl_vars['cfg_hideUrl']->value;?>
;
<?php echo '</script'; ?>
>
</head>

<body>

<?php echo $_smarty_tpl->getSubTemplate ("../public_top_v1.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<!-- 资讯 s -->
<div class="wrap">
	<div class="outwrap fn-clear">
		<div class="box-col">
			<!-- 焦点图 s -->
			<div class="picFocus mainpicfocus">
				<div class="slideBox slideBox1">
					<div class="slidewrap">
						<div class="slide">
							<div class="bd">
								<div class="slideobj"><?php echo getMyAd(array('id'=>"157",'type'=>"slide"),$_smarty_tpl);?>
</div>
							</div>
							<div class="hd"><ul></ul></div>
						</div>
					</div>
				</div>
			</div>
			<!-- 焦点图 e -->
			<!-- 调查 s -->
			<div class="survey">
				<div class="mhd">
					<h2>全民大调查</h2>
					<a href="" target="_blank">网友心声</a>
				</div>
				<div class="mbd fn-clear">
					<dl>
						<dt><i class="iicon"></i>高校退档视力问题考生的做法合适吗？</dt>
						<dd class="des">即日起，仍然在使用苹果手机的公司员工请更换手机品牌，公司将给予相应补贴；凡购买iPhone7的公司员工...</dd>
						<dd class="total fn-clear">
							<div class="support iicon"><a href="javascript:;" class="supportbtn">支持</a></div>
							<div class="progress"><span class="pro-support"><em id="supportNum">19870</em></span><span class="pro-against"><em id="againstNum">3576</em></span></div>
							<div class="against iicon"><a href="javascript:;" class="againsttbtn">反对</a></div>
							<p class="info animated flash">感谢您的参与！</p>
						</dd>
					</dl>
				</div>
			</div>
			<!-- 调查 e -->
			<!-- 专题策划 s -->
			<div class="module zuanti">
				<div class="mhd">
					<h2>专题策划</h2>
					<a href="<?php echo getUrlPath(array('service'=>'article','template'=>'list','typeid'=>'34'),$_smarty_tpl);?>
" class="more">更多>></a>
				</div>
				<div class="mbd">
					<?php $_smarty_tpl->smarty->_tag_stack[] = array('article', array('action'=>"alist",'return'=>"alist",'typeid'=>"34",'flag'=>"h",'thumb'=>"1",'pageSize'=>"1")); $_block_repeat=true; echo article(array('action'=>"alist",'return'=>"alist",'typeid'=>"34",'flag'=>"h",'thumb'=>"1",'pageSize'=>"1"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

					<dl class="fn-clear">
						<dt><a href="<?php echo $_smarty_tpl->tpl_vars['alist']->value['url'];?>
" target="_blank"><img src="<?php echo changeFileSize(array('url'=>((string)$_smarty_tpl->tpl_vars['alist']->value['litpic']),'type'=>"small"),$_smarty_tpl);?>
" alt="<?php echo $_smarty_tpl->tpl_vars['alist']->value['title'];?>
"></a></dt>
						<dd>
							<p class="title"><a href="<?php echo $_smarty_tpl->tpl_vars['alist']->value['url'];?>
" target="_blank" title="<?php echo $_smarty_tpl->tpl_vars['alist']->value['title'];?>
"><?php echo $_smarty_tpl->tpl_vars['alist']->value['title'];?>
</a></p>
							<p class="des"><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['alist']->value['description'],30);?>
<a href="<?php echo $_smarty_tpl->tpl_vars['alist']->value['url'];?>
" target="_blank">[详细]</a></p>
						</dd>
					</dl>
					<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo article(array('action'=>"alist",'return'=>"alist",'typeid'=>"34",'flag'=>"h",'thumb'=>"1",'pageSize'=>"1"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

					<ul class="txtinfo fn-clear">
						<?php $_smarty_tpl->smarty->_tag_stack[] = array('article', array('action'=>"alist",'return'=>"alist",'typeid'=>"34",'flag'=>"r",'pageSize'=>"4")); $_block_repeat=true; echo article(array('action'=>"alist",'return'=>"alist",'typeid'=>"34",'flag'=>"r",'pageSize'=>"4"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

						<li><a href="<?php echo $_smarty_tpl->tpl_vars['alist']->value['url'];?>
" target="_blank" title="<?php echo $_smarty_tpl->tpl_vars['alist']->value['title'];?>
"><?php echo $_smarty_tpl->tpl_vars['alist']->value['title'];?>
</a></li>
						<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo article(array('action'=>"alist",'return'=>"alist",'typeid'=>"34",'flag'=>"r",'pageSize'=>"4"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

					</ul>
				</div>
			</div>
			<!-- 专题策划 e -->
		</div>
		<div class="box-col">
			<!-- 实时动态 s -->
			<div class="realtime">
				<?php $_smarty_tpl->smarty->_tag_stack[] = array('article', array('action'=>"alist",'return'=>"blist",'flag'=>"h,r",'pageSize'=>"2")); $_block_repeat=true; echo article(array('action'=>"alist",'return'=>"blist",'flag'=>"h,r",'pageSize'=>"2"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

				<dl class="first">
					<dt><span><?php echo $_smarty_tpl->tpl_vars['blist']->value['typeName'][0];?>
<i class="iicon"></i></span><a href="<?php echo $_smarty_tpl->tpl_vars['blist']->value['url'];?>
" target="_blank" title="<?php echo preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['blist']->value['title']);?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['blist']->value['title'];?>
</a></dt>
					<dd><?php echo smarty_modifier_truncate(preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['blist']->value['description']),50);?>
<a href="<?php echo $_smarty_tpl->tpl_vars['blist']->value['url'];?>
" target="_blank">详细</a></dd>
				</dl>
				<?php if ($_smarty_tpl->tpl_vars['_bindex']->value['blist']==1) {?><div class="dotline"></div><?php }?>
				<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo article(array('action'=>"alist",'return'=>"blist",'flag'=>"h,r",'pageSize'=>"2"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

				<div class="ad"><?php echo '<script'; ?>
 src="/include/json.php?action=adjs&id=158" language="javascript"><?php echo '</script'; ?>
></div>
			</div>
			<!-- 实时动态 e -->
			<!-- 新闻推荐 s -->
			<div class="module newstj">
				<div class="mhd">
					<h2>新闻推荐</h2><a href="<?php echo $_smarty_tpl->tpl_vars['article_channelDomain']->value;?>
" class="more">更多>></a>
				</div>
				<div class="mbd">
					<ul class="txtinfo">
						<?php $_smarty_tpl->smarty->_tag_stack[] = array('article', array('action'=>"alist",'return'=>"clist",'flag'=>"r",'pageSize'=>"12")); $_block_repeat=true; echo article(array('action'=>"alist",'return'=>"clist",'flag'=>"r",'pageSize'=>"12"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

						<li<?php if ($_smarty_tpl->tpl_vars['_bindex']->value['clist']==1||$_smarty_tpl->tpl_vars['_bindex']->value['clist']==7) {?> class="first"<?php }?>><a href="<?php echo $_smarty_tpl->tpl_vars['clist']->value['url'];?>
" target="_blank" title="<?php echo preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['clist']->value['title']);?>
"><?php echo $_smarty_tpl->tpl_vars['clist']->value['title'];?>
</a></li>
						<?php if ($_smarty_tpl->tpl_vars['_bindex']->value['clist']==6) {?>
					</ul>
					<div class="dotline"></div>
					<ul class="txtinfo">
						<?php }?>
						<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo article(array('action'=>"alist",'return'=>"clist",'flag'=>"r",'pageSize'=>"12"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

					</ul>
				</div>
			</div>
			<!-- 新闻推荐 e -->
		</div>
		<div class="box-col">
			<!-- 报料 s -->
			<div class="exposure">
				<div class="mhd fn-clear">
					<h2>爆料台</h2><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'fabu','action'=>'article'),$_smarty_tpl);?>
" class="more iicon" target="_blank">我要报料</a>
				</div>
				<div class="mbd">
					<?php $_smarty_tpl->smarty->_tag_stack[] = array('article', array('action'=>"alist",'return'=>"alist",'typeid'=>"31",'flag'=>"h",'thumb'=>"1",'pageSize'=>"1")); $_block_repeat=true; echo article(array('action'=>"alist",'return'=>"alist",'typeid'=>"31",'flag'=>"h",'thumb'=>"1",'pageSize'=>"1"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

					<dl>
						<dt><a href="<?php echo $_smarty_tpl->tpl_vars['alist']->value['url'];?>
" target="_blank" title="<?php echo preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['alist']->value['title']);?>
"><?php echo $_smarty_tpl->tpl_vars['alist']->value['title'];?>
</a></dt>
						<dd><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['alist']->value['description'],45);?>
 <a href="<?php echo $_smarty_tpl->tpl_vars['alist']->value['url'];?>
" target="_blank">详细</a></dd>
					</dl>
					<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo article(array('action'=>"alist",'return'=>"alist",'typeid'=>"31",'flag'=>"h",'thumb'=>"1",'pageSize'=>"1"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

					<div class="dotline"></div>
					<ul class="txtinfo fn-clear">
						<?php $_smarty_tpl->smarty->_tag_stack[] = array('article', array('action'=>"alist",'return'=>"alist",'typeid'=>"31",'flag'=>"r",'pageSize'=>"4")); $_block_repeat=true; echo article(array('action'=>"alist",'return'=>"alist",'typeid'=>"31",'flag'=>"r",'pageSize'=>"4"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

						<li><a href="<?php echo $_smarty_tpl->tpl_vars['alist']->value['url'];?>
" target="_blank" title="<?php echo preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['alist']->value['title']);?>
"><?php echo $_smarty_tpl->tpl_vars['alist']->value['title'];?>
</a></li>
						<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo article(array('action'=>"alist",'return'=>"alist",'typeid'=>"31",'flag'=>"r",'pageSize'=>"4"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

					</ul>
				</div>
			</div>
			<!-- 报料 e -->
			<!-- 便民工具 s -->
			<div class="tools">
				<div class="mhd fn-clear">
					<h2>在线便民工具</h2>
				</div>
				<div class="mbd">
					<div class="toolpos">
						<ul class="fn-clear">
							<li><a href="" target="_blank"><i class="tool-1"></i><span>缴水费</span></a></li>
							<li><a href="" target="_blank"><i class="tool-2"></i><span>缴电费</span></a></li>
							<li><a href="" target="_blank"><i class="tool-3"></i><span>缴燃气费</span></a></li>
							<li><a href="" target="_blank"><i class="tool-4"></i><span>缴暖气费</span></a></li>
							<li><a href="" target="_blank"><i class="tool-5"></i><span>话费充值</span></a></li>
							<li><a href="" target="_blank"><i class="tool-6"></i><span>有线电视费</span></a></li>
							<li><a href="" target="_blank"><i class="tool-7"></i><span>缴宽带费</span></a></li>
							<li><a href="" target="_blank"><i class="tool-8"></i><span>交通违章</span></a></li>
						</ul>
					</div>
				</div>
			</div>
			<!-- 便民工具 e -->
			<!-- 视频新闻 s -->
			<div class="module videonews">
				<div class="mhd fn-clear">
					<h2>视频新闻</h2>
					<ul class="slideItem"></ul>
				</div>
				<div class="mbd">
					<div class="slidewrap">
						<ul class="slide">
							<?php $_smarty_tpl->smarty->_tag_stack[] = array('article', array('action'=>"alist",'return'=>"alist",'typeid'=>"2",'flag'=>"h",'thumb'=>"1",'pageSize'=>"10")); $_block_repeat=true; echo article(array('action'=>"alist",'return'=>"alist",'typeid'=>"2",'flag'=>"h",'thumb'=>"1",'pageSize'=>"10"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

							<li>
								<div class="pic"><a href="<?php echo $_smarty_tpl->tpl_vars['alist']->value['url'];?>
" target="_blank"><img src="<?php echo changeFileSize(array('url'=>((string)$_smarty_tpl->tpl_vars['alist']->value['litpic']),'type'=>"small"),$_smarty_tpl);?>
" alt="<?php echo preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['alist']->value['title']);?>
"><i class="iicon"></i></a></div>
								<div class="title"><a href="<?php echo $_smarty_tpl->tpl_vars['alist']->value['url'];?>
" target="_blank" title="<?php echo preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['alist']->value['title']);?>
"><?php echo $_smarty_tpl->tpl_vars['alist']->value['title'];?>
</a></div>
							</li>
							<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo article(array('action'=>"alist",'return'=>"alist",'typeid'=>"2",'flag'=>"h",'thumb'=>"1",'pageSize'=>"10"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

						</ul>
					</div>
					<div class="dotline"></div>
					<ul class="morevideo fn-clear">
						<?php $_smarty_tpl->smarty->_tag_stack[] = array('article', array('action'=>"alist",'return'=>"alist",'typeid'=>"2",'flag'=>"r",'pageSize'=>"6")); $_block_repeat=true; echo article(array('action'=>"alist",'return'=>"alist",'typeid'=>"2",'flag'=>"r",'pageSize'=>"6"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

						<li><a href="<?php echo $_smarty_tpl->tpl_vars['alist']->value['url'];?>
" target="_blank" title="<?php echo preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['alist']->value['title']);?>
"><?php echo $_smarty_tpl->tpl_vars['alist']->value['title'];?>
</a></li>
						<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo article(array('action'=>"alist",'return'=>"alist",'typeid'=>"2",'flag'=>"r",'pageSize'=>"6"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

					</ul>
				</div>
			</div>
			<!-- 视频新闻 e -->
		</div>
	</div>
</div>
<!-- 资讯 e -->
<!-- 图片新闻 s -->
<div class="wrap">
	<div class="part fn-clear">
		<div class="module picnews">
			<div class="mhd">
				<h2>图片新闻</h2><a href="<?php echo getUrlPath(array('service'=>'article','template'=>'list','typeid'=>'10'),$_smarty_tpl);?>
" class="more" target="_blank">更多</a>
			</div>
			<div class="mbd">
				<div class="picwrap">
					<ul>
						<?php $_smarty_tpl->smarty->_tag_stack[] = array('article', array('action'=>"alist",'return'=>"dlist",'typeid'=>"10",'thumb'=>"1",'orderby'=>"2",'pageSize'=>"11")); $_block_repeat=true; echo article(array('action'=>"alist",'return'=>"dlist",'typeid'=>"10",'thumb'=>"1",'orderby'=>"2",'pageSize'=>"11"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

						<li<?php if ($_smarty_tpl->tpl_vars['_bindex']->value['dlist']==1) {?> class="first"<?php }?>>
							<a href="<?php echo $_smarty_tpl->tpl_vars['dlist']->value['url'];?>
" target="_blank" title="<?php echo preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['dlist']->value['title']);?>
">
								<?php if ($_smarty_tpl->tpl_vars['_bindex']->value['dlist']==1) {?>
								<div class="pic"><img src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
images/blank.gif" data-url="<?php echo changeFileSize(array('url'=>((string)$_smarty_tpl->tpl_vars['dlist']->value['litpic']),'type'=>"o_large"),$_smarty_tpl);?>
" alt=""></div>
								<?php } else { ?>
								<div class="pic"><img src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
images/blank.gif" data-url="<?php echo changeFileSize(array('url'=>((string)$_smarty_tpl->tpl_vars['dlist']->value['litpic']),'type'=>"middle"),$_smarty_tpl);?>
" alt=""></div>
								<?php }?>
								<span><?php echo $_smarty_tpl->tpl_vars['dlist']->value['title'];?>
</span>
							</a>
						</li>
						<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo article(array('action'=>"alist",'return'=>"dlist",'typeid'=>"10",'thumb'=>"1",'orderby'=>"2",'pageSize'=>"11"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- 图片新闻 e -->
<!-- 二手 房源 招聘 e -->
<div class="wrap">
	<div class="outwrap fn-clear">

		<?php if (in_array("info",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?>
		<div class="box-col">
			<!-- 二手信息 s -->
			<div class="module secondhand">
				<div class="mhd mhdfwb">
					<ul class="panehead">
						<li><h2><font>二手</font><span>信息</span></h2></li>
					</ul>
					<a href="<?php echo $_smarty_tpl->tpl_vars['info_channelDomain']->value;?>
" class="more" target="_blank">更多>></a>
				</div>
				<div class="mbd">
					<div class="panebody">
						<ul class="list">
							<li>
								<?php $_smarty_tpl->smarty->_tag_stack[] = array('info', array('action'=>"ilist",'return'=>"ilist",'orderby'=>"1",'top'=>"1",'thumb'=>"1",'page'=>"1",'pageSize'=>"1")); $_block_repeat=true; echo info(array('action'=>"ilist",'return'=>"ilist",'orderby'=>"1",'top'=>"1",'thumb'=>"1",'page'=>"1",'pageSize'=>"1"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

								<div class="pic">
									<a href="<?php echo $_smarty_tpl->tpl_vars['ilist']->value['url'];?>
" target="_blank" title="<?php echo $_smarty_tpl->tpl_vars['ilist']->value['title'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
images/blank.gif" data-url="<?php echo changeFileSize(array('url'=>((string)$_smarty_tpl->tpl_vars['ilist']->value['litpic']),'type'=>"small"),$_smarty_tpl);?>
" alt="<?php echo $_smarty_tpl->tpl_vars['ilist']->value['title'];?>
"><div class="title"><p><?php echo $_smarty_tpl->tpl_vars['ilist']->value['title'];?>
</p><i></i></div></a>
								</div>
								<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo info(array('action'=>"ilist",'return'=>"ilist",'orderby'=>"1",'top'=>"1",'thumb'=>"1",'page'=>"1",'pageSize'=>"1"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

								<ul class="txtinfo">
									<?php $_smarty_tpl->smarty->_tag_stack[] = array('info', array('action'=>"ilist",'return'=>"ilist",'orderby'=>"1",'fire'=>"1",'page'=>"1",'pageSize'=>"4")); $_block_repeat=true; echo info(array('action'=>"ilist",'return'=>"ilist",'orderby'=>"1",'fire'=>"1",'page'=>"1",'pageSize'=>"4"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

									<li><a href="<?php echo $_smarty_tpl->tpl_vars['ilist']->value['url'];?>
" target="_blank" title="<?php echo $_smarty_tpl->tpl_vars['ilist']->value['title'];?>
"><?php echo $_smarty_tpl->tpl_vars['ilist']->value['title'];?>
</a></li>
									<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo info(array('action'=>"ilist",'return'=>"ilist",'orderby'=>"1",'fire'=>"1",'page'=>"1",'pageSize'=>"4"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

								</ul>
							</li>
							<li class="dotline"></li>
							<li>
								<?php $_smarty_tpl->smarty->_tag_stack[] = array('info', array('action'=>"ilist",'return'=>"ilist",'orderby'=>"1",'top'=>"1",'thumb'=>"1",'page'=>"2",'pageSize'=>"1")); $_block_repeat=true; echo info(array('action'=>"ilist",'return'=>"ilist",'orderby'=>"1",'top'=>"1",'thumb'=>"1",'page'=>"2",'pageSize'=>"1"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

								<div class="pic">
									<a href="<?php echo $_smarty_tpl->tpl_vars['ilist']->value['url'];?>
" target="_blank" title="<?php echo $_smarty_tpl->tpl_vars['ilist']->value['title'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
images/blank.gif" data-url="<?php echo changeFileSize(array('url'=>((string)$_smarty_tpl->tpl_vars['ilist']->value['litpic']),'type'=>"small"),$_smarty_tpl);?>
" alt="<?php echo $_smarty_tpl->tpl_vars['ilist']->value['title'];?>
"><div class="title"><p><?php echo $_smarty_tpl->tpl_vars['ilist']->value['title'];?>
</p><i></i></div></a>
								</div>
								<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo info(array('action'=>"ilist",'return'=>"ilist",'orderby'=>"1",'top'=>"1",'thumb'=>"1",'page'=>"2",'pageSize'=>"1"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

								<ul class="txtinfo">
									<?php $_smarty_tpl->smarty->_tag_stack[] = array('info', array('action'=>"ilist",'return'=>"ilist",'orderby'=>"1",'fire'=>"1",'page'=>"2",'pageSize'=>"4")); $_block_repeat=true; echo info(array('action'=>"ilist",'return'=>"ilist",'orderby'=>"1",'fire'=>"1",'page'=>"2",'pageSize'=>"4"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

									<li><a href="<?php echo $_smarty_tpl->tpl_vars['ilist']->value['url'];?>
" target="_blank" title="<?php echo $_smarty_tpl->tpl_vars['ilist']->value['title'];?>
"><?php echo $_smarty_tpl->tpl_vars['ilist']->value['title'];?>
</a></li>
									<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo info(array('action'=>"ilist",'return'=>"ilist",'orderby'=>"1",'fire'=>"1",'page'=>"2",'pageSize'=>"4"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

								</ul>
							</li>
							<li class="dotline"></li>
						</ul>
					</div>
					<ul class="list2 txtinfo">
						<?php $_smarty_tpl->smarty->_tag_stack[] = array('info', array('action'=>"ilist",'return'=>"ilist",'orderby'=>"1",'rec'=>"1",'page'=>"1",'pageSize'=>"5")); $_block_repeat=true; echo info(array('action'=>"ilist",'return'=>"ilist",'orderby'=>"1",'rec'=>"1",'page'=>"1",'pageSize'=>"5"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

						<li><?php if ($_smarty_tpl->tpl_vars['ilist']->value['price']) {?><span class="time"><font><?php echo $_smarty_tpl->tpl_vars['ilist']->value['price'];?>
</font>元</span><?php }?><a href="<?php echo $_smarty_tpl->tpl_vars['ilist']->value['url'];?>
" target="_blank" title="<?php echo $_smarty_tpl->tpl_vars['ilist']->value['title'];?>
"><?php echo $_smarty_tpl->tpl_vars['ilist']->value['title'];
if ($_smarty_tpl->tpl_vars['ilist']->value['pcount']) {?><span>[<?php echo $_smarty_tpl->tpl_vars['ilist']->value['pcount'];?>
图]</span><?php }?></a></li>
						<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo info(array('action'=>"ilist",'return'=>"ilist",'orderby'=>"1",'rec'=>"1",'page'=>"1",'pageSize'=>"5"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

					</ul>
				</div>
			</div>
			<!-- 二手信息 e -->
		</div>
		<?php }?>

		<?php if (in_array("house",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?>
		<div class="box-col">
			<!-- 房源 s -->
			<div class="module house inBox">
				<div class="mhd mhdfwb">
					<ul class="panehead inHd">
						<li class="on"><h2><font>新房</font><span>楼盘</span></h2></li>
						<li><h2><font>出售</font><span>房源</span></h2></li>
					</ul>
					<a href="<?php echo $_smarty_tpl->tpl_vars['house_channelDomain']->value;?>
" class="more" target="_blank">更多>></a>
				</div>
				<div class="mbd">
					<div class="panebody inBd">
						<ul>
							<?php $_smarty_tpl->smarty->_tag_stack[] = array('house', array('action'=>"loupanList",'return'=>"loupan",'pageSize'=>"2")); $_block_repeat=true; echo house(array('action'=>"loupanList",'return'=>"loupan",'pageSize'=>"2"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

							<li class="fn-clear">
								<div class="pic">
									<a href="<?php echo $_smarty_tpl->tpl_vars['loupan']->value['url'];?>
" target="_blank" title="<?php echo $_smarty_tpl->tpl_vars['loupan']->value['title'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
images/blank.gif" data-url="<?php echo changeFileSize(array('url'=>((string)$_smarty_tpl->tpl_vars['loupan']->value['litpic']),'type'=>"small"),$_smarty_tpl);?>
" alt=""><?php if ($_smarty_tpl->tpl_vars['loupan']->value['imgCount']) {?><div class="num"><span>共<?php echo $_smarty_tpl->tpl_vars['loupan']->value['imgCount'];?>
张</span><i></i></div><?php }?></a>
								</div>
								<div class="txt">
									<p class="title"><a href="<?php echo $_smarty_tpl->tpl_vars['loupan']->value['url'];?>
" target="_blank" title="<?php echo $_smarty_tpl->tpl_vars['loupan']->value['title'];?>
"><?php echo $_smarty_tpl->tpl_vars['loupan']->value['title'];?>
</a><span class="sta s<?php echo $_smarty_tpl->tpl_vars['loupan']->value['salestate'];?>
"><?php if ($_smarty_tpl->tpl_vars['loupan']->value['salestate']==0) {?>新盘待售<?php } elseif ($_smarty_tpl->tpl_vars['loupan']->value['salestate']==1) {?>在售<?php } elseif ($_smarty_tpl->tpl_vars['loupan']->value['salestate']==2) {?>尾盘<?php } elseif ($_smarty_tpl->tpl_vars['loupan']->value['salestate']==3) {?>售完<?php }?></span></p>
									<p class="price"><span><?php echo $_smarty_tpl->tpl_vars['loupan']->value['price'];?>
</span>元/㎡</p>
									<p class="place"><?php echo $_smarty_tpl->tpl_vars['loupan']->value['addr'][0];?>
-<?php echo $_smarty_tpl->tpl_vars['loupan']->value['addr'][1];?>
-<?php echo $_smarty_tpl->tpl_vars['loupan']->value['protype'];?>
</p>
									<p class="des"><a href="<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['loupan']->value['id'];?>
<?php $_tmp1=ob_get_clean();?><?php echo getUrlPath(array('service'=>'house','template'=>'loupan-pic','id'=>$_tmp1),$_smarty_tpl);?>
" target="_blank" title="查看楼盘图片">图片(<?php echo $_smarty_tpl->tpl_vars['loupan']->value['piccount'];?>
)</a><span>|</span><a href="<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['loupan']->value['id'];?>
<?php $_tmp2=ob_get_clean();?><?php echo getUrlPath(array('service'=>'house','template'=>'loupan-hx','id'=>$_tmp2),$_smarty_tpl);?>
" target="_blank" title="查看楼盘户型">户型(<?php echo $_smarty_tpl->tpl_vars['loupan']->value['hxcount'];?>
)</a></p>
								</div>
							</li>
							<li class="dotline"></li>
							<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo house(array('action'=>"loupanList",'return'=>"loupan",'pageSize'=>"2"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

						</ul>
						<ul>
							<?php $_smarty_tpl->smarty->_tag_stack[] = array('house', array('action'=>"saleList",'return'=>"sale",'pageSize'=>"2")); $_block_repeat=true; echo house(array('action'=>"saleList",'return'=>"sale",'pageSize'=>"2"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

							<li class="fn-clear">
								<div class="pic">
									<a href="<?php echo $_smarty_tpl->tpl_vars['sale']->value['url'];?>
" target="_blank" title="<?php echo $_smarty_tpl->tpl_vars['sale']->value['title'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
images/blank.gif" data-url="<?php echo changeFileSize(array('url'=>((string)$_smarty_tpl->tpl_vars['sale']->value['litpic']),'type'=>"small"),$_smarty_tpl);?>
" alt=""><?php if ($_smarty_tpl->tpl_vars['sale']->value['imgCount']) {?><div class="num"><span>共<?php echo $_smarty_tpl->tpl_vars['sale']->value['imgCount'];?>
张</span><i></i></div><?php }?></a>
								</div>
								<div class="txt">
									<p class="title"><a href="<?php echo $_smarty_tpl->tpl_vars['sale']->value['url'];?>
" target="_blank" title="<?php echo $_smarty_tpl->tpl_vars['sale']->value['title'];?>
"><?php echo $_smarty_tpl->tpl_vars['sale']->value['title'];?>
</a></p>
									<p class="price"><span><?php echo $_smarty_tpl->tpl_vars['sale']->value['price'];?>
</span>万</p>
									<p class="place"><?php echo $_smarty_tpl->tpl_vars['sale']->value['addr'][0];?>
-<?php echo $_smarty_tpl->tpl_vars['sale']->value['addr'][1];?>
-<?php if ($_smarty_tpl->tpl_vars['sale']->value['communityid']) {?><a href="<?php echo $_smarty_tpl->tpl_vars['sale']->value['communityUrl'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['sale']->value['community'];?>
</a><?php } else {
echo $_smarty_tpl->tpl_vars['sale']->value['community'];
}?></p>
									<p class="des"><?php echo $_smarty_tpl->tpl_vars['sale']->value['buildage'];?>
年<span>|</span><?php echo $_smarty_tpl->tpl_vars['sale']->value['room'];?>
<span>|</span><?php echo $_smarty_tpl->tpl_vars['sale']->value['area'];?>
㎡<span>|</span><?php echo $_smarty_tpl->tpl_vars['sale']->value['bno'];?>
/<?php echo $_smarty_tpl->tpl_vars['sale']->value['floor'];?>
层</p>
								</div>
							</li>
							<li class="dotline"></li>
							<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo house(array('action'=>"saleList",'return'=>"sale",'pageSize'=>"2"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

						</ul>
					</div>
					<ul class="txtinfo">
						<?php $_smarty_tpl->smarty->_tag_stack[] = array('house', array('action'=>"zuList",'return'=>"zu",'pageSize'=>"5")); $_block_repeat=true; echo house(array('action'=>"zuList",'return'=>"zu",'pageSize'=>"5"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

						<li><a href="<?php echo $_smarty_tpl->tpl_vars['zu']->value['url'];?>
" target="_blank" title="<?php echo $_smarty_tpl->tpl_vars['zu']->value['title'];?>
"><?php echo $_smarty_tpl->tpl_vars['zu']->value['title'];?>
</a><span><?php echo $_smarty_tpl->tpl_vars['zu']->value['price'];?>
元/月</span></li>
						<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo house(array('action'=>"zuList",'return'=>"zu",'pageSize'=>"5"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

					</ul>
				</div>
			</div>
			<!-- 房源 e -->
		</div>
		<?php }?>

		<?php if (in_array("job",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?>
		<div class="box-col">
			<!-- 名企招聘 s -->
			<div class="module job">
				<div class="mhd mhdfwb">
					<ul class="panehead">
						<li><h2><font>名企</font><span>招聘</span></h2></li>
					</ul>
					<a href="<?php echo $_smarty_tpl->tpl_vars['job_channelDomain']->value;?>
" class="more" target="_blank">更多>></a>
				</div>
				<div class="mbd">

					<div class="panebody">
						<ul class="list fn-clear">
							<?php $_smarty_tpl->smarty->_tag_stack[] = array('job', array('action'=>"company",'return'=>"company",'property'=>"m",'pageSize'=>"6")); $_block_repeat=true; echo job(array('action'=>"company",'return'=>"company",'property'=>"m",'pageSize'=>"6"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

							<li><a href="<?php echo $_smarty_tpl->tpl_vars['company']->value['url'];?>
" target="_blank"><img src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
images/blank.gif" data-url="<?php echo $_smarty_tpl->tpl_vars['company']->value['logo'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['company']->value['title'];?>
"><p><?php echo $_smarty_tpl->tpl_vars['company']->value['title'];?>
</p></a></li>
							<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo job(array('action'=>"company",'return'=>"company",'property'=>"m",'pageSize'=>"6"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

						</ul>
					</div>
					<div class="list2">
						<table class="table">
							<thead>
								<tr>
									<th class="t1"></th>
									<th class="t2"><span>企业名称</span></th>
									<th class="t3"><span>招聘职位</span></th>
								</tr>
							</thead>
							<tbody>
								<tr class="place"><td></td></tr>
								<?php $_smarty_tpl->smarty->_tag_stack[] = array('job', array('action'=>"company",'return'=>"company",'property'=>"u",'pageSize'=>"5")); $_block_repeat=true; echo job(array('action'=>"company",'return'=>"company",'property'=>"u",'pageSize'=>"5"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

								<tr>
									<td class="t1"><i></i></td>
									<td class="t2"><span><a href="<?php echo $_smarty_tpl->tpl_vars['company']->value['url'];?>
" target="_blank" title="<?php echo $_smarty_tpl->tpl_vars['company']->value['title'];?>
"><?php echo $_smarty_tpl->tpl_vars['company']->value['title'];?>
</a></span></td>
									<?php $_smarty_tpl->smarty->_tag_stack[] = array('job', array('action'=>"post",'return'=>"post",'pageSize'=>"1",'company'=>((string)$_smarty_tpl->tpl_vars['company']->value['id']))); $_block_repeat=true; echo job(array('action'=>"post",'return'=>"post",'pageSize'=>"1",'company'=>((string)$_smarty_tpl->tpl_vars['company']->value['id'])), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

									<td class="t3"><span><a href="<?php echo $_smarty_tpl->tpl_vars['post']->value['url'];?>
#jobDetail" target="_blank" title="<?php echo $_smarty_tpl->tpl_vars['post']->value['title'];?>
"><?php echo $_smarty_tpl->tpl_vars['post']->value['title'];?>
</a></span></td>
									<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo job(array('action'=>"post",'return'=>"post",'pageSize'=>"1",'company'=>((string)$_smarty_tpl->tpl_vars['company']->value['id'])), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

								</tr>
								<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo job(array('action'=>"company",'return'=>"company",'property'=>"u",'pageSize'=>"5"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

							</tbody>
						</table>
					</div>

				</div>
			</div>
			<!-- 名企招聘 e -->
		</div>
		<?php }?>

	</div>
</div>
<!-- 二手 房源 招聘 e -->

<div class="wrap tladv"><?php echo '<script'; ?>
 src="/include/json.php?action=adjs&id=159" language="javascript"><?php echo '</script'; ?>
></div>

<!-- 团购 打折 美食 e -->
<div class="wrap">
	<div class="outwrap fn-clear">

		<?php if (in_array("tuan",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?>
		<div class="box-col">
			<!-- 团购 s -->
			<div class="module tuan">
				<div class="mhd mhdfwb">
					<h2><font>团购</font><span>秒杀</span></h2>
					<a href="<?php echo $_smarty_tpl->tpl_vars['tuan_channelDomain']->value;?>
" class="more" target="_blank">更多>></a>
				</div>
				<div class="mbd">
					<div class="miaobox">
						<div class="pic"><div class="load">加载中...</div></div>
						<div class="countdown fn-clear">
							<div class="inner">
								<label><i class="iicon"></i><span class="ts1">距离秒杀时间还剩：</span><span class="ts2">距离秒杀：</span></label>
								<ul class="times fn-clear" id="countDown">
									<li class="h1 time">0</li>
									<li class="h2 time">0</li>
									<li class="t">时</li>
									<li class="m1 time">0</li>
									<li class="m2 time">0</li>
									<li class="t">分</li>
									<li class="s1 time">0</li>
									<li class="s2 time">0</li>
									<li class="t">秒</li>
									<li class="ms time">0</li>
								</ul>
							</div>
						</div>
					</div>
					<ul class="list fn-clear">
						<?php $_smarty_tpl->smarty->_tag_stack[] = array('tuan', array('action'=>"tlist",'return'=>'list','all'=>"1",'rec'=>"1",'pageSize'=>"2")); $_block_repeat=true; echo tuan(array('action'=>"tlist",'return'=>'list','all'=>"1",'rec'=>"1",'pageSize'=>"2"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

						<li>
							<a href="<?php echo $_smarty_tpl->tpl_vars['list']->value['url'];?>
" target="_blank">
								<div class="pic">
									<img src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
images/blank.gif" data-url="<?php echo changeFileSize(array('url'=>((string)$_smarty_tpl->tpl_vars['list']->value['litpic']),'type'=>"small"),$_smarty_tpl);?>
" alt="">
									<p class="title"><?php echo $_smarty_tpl->tpl_vars['list']->value['title'];?>
</p>
									<div class="bg"></div>
								</div>
								<div class="info">
									<div class="price">
										<span class="new"><em>&yen;</em><font><?php echo $_smarty_tpl->tpl_vars['list']->value['price'];?>
</font>元</span>
									</div>
									<span class="salenum">已售<?php echo $_smarty_tpl->tpl_vars['list']->value['sale'];?>
</span>
								</div>
							</a>
						</li>
						<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo tuan(array('action'=>"tlist",'return'=>'list','all'=>"1",'rec'=>"1",'pageSize'=>"2"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

					</ul>
				</div>
			</div>
			<!-- 团购 e -->
		</div>
		<?php }?>

		<?php if (in_array("shop",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?>
		<div class="box-col">
			<!-- 打折 s -->
			<div class="module discount">
				<div class="mhd mhdfwb">
					<h2><font>打折</font><span>优惠</span></h2>
					<a href="" class="more" target="_blank">更多>></a>
				</div>
				<div class="mbd">
					<div class="list1">
						<h3 id="discountTitle"><a href="" target="_blank">爱鲜蜂 200 元优惠券 新鲜美食 1小时送达</a></h3>
						<ul id="discountList">
							<li>
								<span class="no">1</span>
								<a href="" target="_blank">
									<div class="show1">爱鲜蜂 200 元优惠券 新鲜美食 1小时送达</div>
									<div class="show2">
										<div class="bg bgl"></div><div class="bg bgr"></div>
										<div class="logo"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
upfile/dazhe_comllogo.jpg" alt=""></div>
										<p><span class="name">爱鲜蜂</span><br>&yen;<font>200</font>元优惠券</p>
									</div>
								</a>
							</li>
							<li>
								<span class="no">2</span>
								<a href="" target="_blank">
									<div class="show1">母婴会员日，免费领取10元/5元无门槛券</div>
									<div class="show2">
										<div class="bg bgl"></div><div class="bg bgr"></div>
										<div class="logo"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
upfile/dazhe_comllogo.jpg" alt=""></div>
										<p><span class="name">母婴会员日</span><br>&yen;<font>200</font>元优惠券</p>
									</div>
								</a>
							</li>
							<li>
								<span class="no">3</span>
								<a href="" target="_blank">
									<div class="show1">
									飞科商城7-9月优惠券，15元无限制优惠券</div>
									<div class="show2">
										<div class="bg bgl"></div><div class="bg bgr"></div>
										<div class="logo"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
upfile/dazhe_comllogo.jpg" alt=""></div>
										<p><span class="name">飞科商城</span><br>&yen;<font>50</font>元优惠券</p>
									</div>
								</a>
							</li>
							<li>
								<span class="no">4</span>
								<a href="" target="_blank">
									<div class="show1">薇诺娜优惠券，满1100减130元优惠券</div>
									<div class="show2">
										<div class="bg bgl"></div><div class="bg bgr"></div>
										<div class="logo"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
upfile/dazhe_comllogo.jpg" alt=""></div>
										<p><span class="name">薇诺娜</span><br>&yen;<font>100</font>元优惠券</p>
									</div>
								</a>
							</li>
							<li>
								<span class="no">5</span>
								<a href="" target="_blank">
									<div class="show1">佐卡伊珠宝抵扣券，满5000减388元抵扣券</div>
									<div class="show2">
										<div class="bg bgl"></div><div class="bg bgr"></div>
										<div class="logo"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
upfile/dazhe_comllogo.jpg" alt=""></div>
										<p><span class="name">佐卡伊</span><br>&yen;<font>500</font>元优惠券</p>
									</div>
								</a>
							</li>
						</ul>
					</div>
					<div class="line"></div>
					<div class="inBox">
						<div class="ihd fn-clear">
							<ul class="inHd fn-clear">
								<li>推荐</li>
								<li>特价</li>
								<li>热卖</li>
							</ul>
							<a href="<?php echo $_smarty_tpl->tpl_vars['shop_channelDomain']->value;?>
" class="more" target="_blank">全部商品<i class="iicon"></i></a>
						</div>
						<div class="inBd">
							<ul class="fn-clear">
								<?php $_smarty_tpl->smarty->_tag_stack[] = array('shop', array('action'=>"slist",'return'=>"list",'flag'=>"0",'pageSize'=>"4")); $_block_repeat=true; echo shop(array('action'=>"slist",'return'=>"list",'flag'=>"0",'pageSize'=>"4"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

								<li>
									<a href="<?php echo $_smarty_tpl->tpl_vars['list']->value['url'];?>
" target="_blank" title="<?php echo $_smarty_tpl->tpl_vars['list']->value['title'];?>
">
										<div class="pic"><img src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
images/blank.gif" data-url="<?php echo changeFileSize(array('url'=>((string)$_smarty_tpl->tpl_vars['list']->value['litpic']),'type'=>"small"),$_smarty_tpl);?>
" alt="<?php echo $_smarty_tpl->tpl_vars['list']->value['title'];?>
"></div>
										<span><?php echo $_smarty_tpl->tpl_vars['list']->value['title'];?>
</span>
									</a>
								</li>
								<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo shop(array('action'=>"slist",'return'=>"list",'flag'=>"0",'pageSize'=>"4"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

							</ul>
							<ul class="fn-clear">
								<?php $_smarty_tpl->smarty->_tag_stack[] = array('shop', array('action'=>"slist",'return'=>"list",'flag'=>"1",'pageSize'=>"4")); $_block_repeat=true; echo shop(array('action'=>"slist",'return'=>"list",'flag'=>"1",'pageSize'=>"4"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

								<li>
									<a href="<?php echo $_smarty_tpl->tpl_vars['list']->value['url'];?>
" target="_blank" title="<?php echo $_smarty_tpl->tpl_vars['list']->value['title'];?>
">
										<div class="pic"><img src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
images/blank.gif" data-url="<?php echo changeFileSize(array('url'=>((string)$_smarty_tpl->tpl_vars['list']->value['litpic']),'type'=>"small"),$_smarty_tpl);?>
" alt="<?php echo $_smarty_tpl->tpl_vars['list']->value['title'];?>
"></div>
										<span><?php echo $_smarty_tpl->tpl_vars['list']->value['title'];?>
</span>
									</a>
								</li>
								<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo shop(array('action'=>"slist",'return'=>"list",'flag'=>"1",'pageSize'=>"4"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

							</ul>
							<ul class="fn-clear">
								<?php $_smarty_tpl->smarty->_tag_stack[] = array('shop', array('action'=>"slist",'return'=>"list",'flag'=>"2",'pageSize'=>"4")); $_block_repeat=true; echo shop(array('action'=>"slist",'return'=>"list",'flag'=>"2",'pageSize'=>"4"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

								<li>
									<a href="<?php echo $_smarty_tpl->tpl_vars['list']->value['url'];?>
" target="_blank" title="<?php echo $_smarty_tpl->tpl_vars['list']->value['title'];?>
">
										<div class="pic"><img src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
images/blank.gif" data-url="<?php echo changeFileSize(array('url'=>((string)$_smarty_tpl->tpl_vars['list']->value['litpic']),'type'=>"small"),$_smarty_tpl);?>
" alt="<?php echo $_smarty_tpl->tpl_vars['list']->value['title'];?>
"></div>
										<span><?php echo $_smarty_tpl->tpl_vars['list']->value['title'];?>
</span>
									</a>
								</li>
								<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo shop(array('action'=>"slist",'return'=>"list",'flag'=>"2",'pageSize'=>"4"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

							</ul>
						</div>
					</div>
				</div>
			</div>
			<!-- 打折 e -->
		</div>
		<?php }?>

		<?php if (in_array("waimai",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?>
		<div class="box-col">
			<!-- 美食 s -->
			<div class="module waimai">
				<div class="mhd mhdfwb">
					<h2><font>美食</font><span>外卖</span></h2>
					<a href="<?php echo $_smarty_tpl->tpl_vars['waimai_channelDomain']->value;?>
" class="more" target="_blank">更多>></a>
				</div>
				<div class="mbd">
					<ul class="list1">
					<?php $_smarty_tpl->smarty->_tag_stack[] = array('waimai', array('action'=>'store','return'=>'store','peisong'=>'1','orderby'=>'1','pageSize'=>'2')); $_block_repeat=true; echo waimai(array('action'=>'store','return'=>'store','peisong'=>'1','orderby'=>'1','pageSize'=>'2'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

						<li>
							<div class="pic">
								<a href="<?php echo $_smarty_tpl->tpl_vars['store']->value['url'];?>
" target="_blank"><img src="<?php echo $_smarty_tpl->tpl_vars['store']->value['logo'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['store']->value['title'];?>
"></a>
							</div>
							<div class="txt">
								<p class="title"><a href="<?php echo $_smarty_tpl->tpl_vars['store']->value['url'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['store']->value['title'];?>
</a></p>
								<p class="type">
									<span class="price"><font><?php echo $_smarty_tpl->tpl_vars['store']->value['price'];?>
</font>元起送</span><?php if ($_smarty_tpl->tpl_vars['store']->value['online']) {?><span class="onlinepay tag">在线支付</span><?php }
if ($_smarty_tpl->tpl_vars['store']->value['yy']) {?><span class="inbusiness tag">营业中</span><?php } else { ?><span class="offline tag">打烊了</span><?php }?>
								</p>
								<p class="other"><span class="price2">配送费&nbsp;<?php echo $_smarty_tpl->tpl_vars['store']->value['peisong'];?>
元</span><span class="time">平均送达速度&nbsp;<?php echo $_smarty_tpl->tpl_vars['store']->value['times'];?>
分钟</span></p>
								<p class="place">地址：<?php echo $_smarty_tpl->tpl_vars['store']->value['address'];?>
</p>
							</div>
						</li>
						<?php if ($_smarty_tpl->tpl_vars['_bindex']->value['store']==1) {?><li class="dotline"></li><?php }?>
					<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo waimai(array('action'=>'store','return'=>'store','peisong'=>'1','orderby'=>'1','pageSize'=>'2'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

					</ul>
					<div class="ihd fn-clear">
						<h2><strong>最新</strong>加盟外卖商家<i class="iicon animated bounce animatloop"></i></h2>
						<ul class="slideItem"></ul>
					</div>
					<div class="ibd">
						<div class="slidewrap">
							<div class="slide">
								<ul class="txtinfo fn-clear">
									<?php $_smarty_tpl->smarty->_tag_stack[] = array('waimai', array('action'=>'store','return'=>'store1','pageSize'=>'30')); $_block_repeat=true; echo waimai(array('action'=>'store','return'=>'store1','pageSize'=>'30'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

									<li><a href="<?php echo $_smarty_tpl->tpl_vars['store1']->value['url'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['store1']->value['title'];?>
</a></li>
								<?php if ($_smarty_tpl->tpl_vars['_bindex']->value['store1']!=30&&!($_smarty_tpl->tpl_vars['_bindex']->value['store1']%10)) {?>
								</ul>
								<ul class="txtinfo fn-clear">
								<?php }?>
									<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo waimai(array('action'=>'store','return'=>'store1','pageSize'=>'30'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- 美食 e -->
		</div>
		<?php }?>

	</div>
</div>
<!-- 团购 打折 美食 e -->

<div class="wrap tladv"><?php echo '<script'; ?>
 src="/include/json.php?action=adjs&id=160" language="javascript"><?php echo '</script'; ?>
></div>

<!-- 装修 建材 家居 e -->
<div class="wrap">
	<div class="outwrap fn-clear">

		<?php if (in_array("renovation",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?>
		<div class="box-col">
			<!-- 装修设计 s -->
			<div class="module renovation">
				<div class="mhd mhdfwb">
					<h2><font>装修</font><span>设计</span></h2>
					<a href="<?php echo $_smarty_tpl->tpl_vars['renovation_channelDomain']->value;?>
" class="more" target="_blank">更多&gt;&gt;</a>
				</div>
				<div class="mbd">
					<div class="list1">
						<ul class="fn-clear">
							<li><a href="<?php echo getUrlPath(array('service'=>'renovation','template'=>'company'),$_smarty_tpl);?>
" target="_blank"><span><i class="company"></i></span>装修公司</a></li>
							<li><a href="<?php echo getUrlPath(array('service'=>'renovation','template'=>'case'),$_smarty_tpl);?>
" target="_blank"><span><i class="case"></i></span>样板案例</a></li>
							<li><a href="<?php echo getUrlPath(array('service'=>'renovation','template'=>'designer'),$_smarty_tpl);?>
" target="_blank"><span><i class="designer"></i></span>设计师</a></li>
							<li><a href="<?php echo getUrlPath(array('service'=>'renovation','template'=>'entrust'),$_smarty_tpl);?>
" target="_blank"><span><i class="price"></i></span>设计报价</a></li>
							<li><a href="<?php echo getUrlPath(array('service'=>'renovation','template'=>'raiders'),$_smarty_tpl);?>
" target="_blank"><span><i class="strategy"></i></span>装修攻略</a></li>
						</ul>
					</div>
					<!-- 公司展示 s -->
					<div class="conpmayShow slideBox2">
						<div class="slidewrap">
							<div class="slide">
								<div class="bd">
									<ul class="fn-clear">
										<?php $_smarty_tpl->smarty->_tag_stack[] = array('renovation', array('action'=>"store",'return'=>"store",'pageSize'=>"3")); $_block_repeat=true; echo registerPluginBlockNull(array('action'=>"store",'return'=>"store",'pageSize'=>"3"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

										<li>
											<h3><a href="<?php echo $_smarty_tpl->tpl_vars['store']->value['url'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['store']->value['company'];?>
</a></h3>
											<p class="taglist">
												<?php if ($_smarty_tpl->tpl_vars['store']->value['license']==1) {?>
												<span class="tag tag-ying" title="该公司营业执照已认证">营</span>
												<?php } else { ?>
												<span class="tag tag-ying no" title="该公司营业执照未认证">营</span>
												<?php }?>

												<?php if ($_smarty_tpl->tpl_vars['store']->value['certi']==1) {?>
												<span class="tag tag-ren" title="认证公司">认</span>
												<?php } else { ?>
												<span class="tag tag-ren no">认</span>
												<?php }?>

												<?php if ($_smarty_tpl->tpl_vars['store']->value['saleCount']>0) {?>
												<a href="#" target="_blank"><span class="tag tag-hui" title="该公司有装修优惠,点击查看">惠</span></a>
												<?php } else { ?>
												<span class="tag tag-hui no">惠</span>
												<?php }?>

												<?php if ($_smarty_tpl->tpl_vars['store']->value['safeguard']>0) {?>
												<span class="tag tag-jin" title="该公司已交<?php echo $_smarty_tpl->tpl_vars['store']->value['safeguard'];?>
元保障金">金</span>
												<font><?php echo $_smarty_tpl->tpl_vars['store']->value['safeguard'];?>
元</font>
												<?php } else { ?>
												<span class="tag tag-jin no">金</span>
												<?php }?>

												<?php if ($_smarty_tpl->tpl_vars['store']->value['caseCount']>0) {?>
												<a href="#" target="_blank"><span class="tag tag-she" title="设计方案">设</span></a>
												<font><?php echo $_smarty_tpl->tpl_vars['store']->value['caseCount'];?>
套</font>
												<?php } else { ?>
												<span class="tag tag-she no">设</span>
												<?php }?>

												<?php if ($_smarty_tpl->tpl_vars['store']->value['diaryCount']>0) {?>
												<a href="#" target="_blank"><span class="tag tag-gong" title="施工案例">工</span></a>
												<em><?php echo $_smarty_tpl->tpl_vars['store']->value['diaryCount'];?>
个</em>
												<?php } else { ?>
												<span class="tag tag-gong no">工</span>
												<?php }?>

												<?php if ($_smarty_tpl->tpl_vars['store']->value['guestCount']>0) {?>
												<a href="#" target="_blank"><span class="tag tag-ping" title="公司评价">评</span></a>
												<em><?php echo $_smarty_tpl->tpl_vars['store']->value['guestCount'];?>
次</em>
												<?php } else { ?>
												<span class="tag tag-ping no">评</span>
												<?php }?>
											</p>

											<p class="place"><i class="iicon"></i><?php echo $_smarty_tpl->tpl_vars['store']->value['addr'];?>
 <?php echo $_smarty_tpl->tpl_vars['store']->value['address'];?>
</p>
											<div class="smallpic fn-clear">
												<?php $_smarty_tpl->smarty->_tag_stack[] = array('renovation', array('action'=>"rcase",'return'=>"rcase",'company'=>((string)$_smarty_tpl->tpl_vars['store']->value['id']),'pageSize'=>"4")); $_block_repeat=true; echo registerPluginBlockNull(array('action'=>"rcase",'return'=>"rcase",'company'=>((string)$_smarty_tpl->tpl_vars['store']->value['id']),'pageSize'=>"4"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

												<div class="item">
													<a href="<?php echo $_smarty_tpl->tpl_vars['rcase']->value['url'];?>
" target="_blank" title="<?php echo $_smarty_tpl->tpl_vars['rcase']->value['title'];?>
">
														<img src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
images/blank.gif" _src="<?php echo changeFileSize(array('url'=>((string)$_smarty_tpl->tpl_vars['rcase']->value['litpic']),'type'=>"small"),$_smarty_tpl);?>
" alt="<?php echo $_smarty_tpl->tpl_vars['rcase']->value['title'];?>
">
														<p><span class="name"><?php echo $_smarty_tpl->tpl_vars['rcase']->value['title'];?>
</span><span class="bg"></span></p>
													</a>
												</div>
												<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo registerPluginBlockNull(array('action'=>"rcase",'return'=>"rcase",'company'=>((string)$_smarty_tpl->tpl_vars['store']->value['id']),'pageSize'=>"4"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

											</div>
                      <?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['store']->value['id'];?>
<?php $_tmp3=ob_get_clean();?><?php $_smarty_tpl->smarty->_tag_stack[] = array('renovation', array('action'=>"team",'return'=>"team",'company'=>$_tmp3,'pageSize'=>"1")); $_block_repeat=true; echo registerPluginBlockNull(array('action'=>"team",'return'=>"team",'company'=>$_tmp3,'pageSize'=>"1"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                      <?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['team']->value['id'];?>
<?php $_tmp4=ob_get_clean();?><?php $_smarty_tpl->smarty->_tag_stack[] = array('renovation', array('action'=>"diary",'return'=>'diary','designer'=>$_tmp4,'pageSize'=>'1')); $_block_repeat=true; echo registerPluginBlockNull(array('action'=>"diary",'return'=>'diary','designer'=>$_tmp4,'pageSize'=>'1'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

											<div class="bigpic"><a href="<?php echo $_smarty_tpl->tpl_vars['diary']->value['url'];?>
" target="_blank" title="<?php echo $_smarty_tpl->tpl_vars['diary']->value['title'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
images/blank.gif" _src="<?php echo changeFileSize(array('url'=>((string)$_smarty_tpl->tpl_vars['diary']->value['litpic']),'type'=>"o_large"),$_smarty_tpl);?>
" alt="<?php echo $_smarty_tpl->tpl_vars['diary']->value['title'];?>
"></a></div>
                      <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo registerPluginBlockNull(array('action'=>"diary",'return'=>'diary','designer'=>$_tmp4,'pageSize'=>'1'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

											<div class="desiginer">
												<a href="<?php echo $_smarty_tpl->tpl_vars['team']->value['url'];?>
" target="_blank"><img src="<?php echo $_smarty_tpl->tpl_vars['team']->value['photo'];?>
" class="userphoto animated" alt="<?php echo $_smarty_tpl->tpl_vars['team']->value['name'];?>
"></a>
												<p class="p1"><span class="name"><a href="<?php echo $_smarty_tpl->tpl_vars['team']->value['url'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['team']->value['name'];?>
</a></span><?php echo $_smarty_tpl->tpl_vars['team']->value['post'];?>
<span class="year"><?php echo $_smarty_tpl->tpl_vars['team']->value['works'];?>
年</span></p>
												<p class="p2">擅长: <?php echo $_smarty_tpl->tpl_vars['team']->value['style'];?>
</p>
											</div>
                      <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo registerPluginBlockNull(array('action'=>"team",'return'=>"team",'company'=>$_tmp3,'pageSize'=>"1"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

										</li>
										<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo registerPluginBlockNull(array('action'=>"store",'return'=>"store",'pageSize'=>"3"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

									</ul>
								</div>
								<a class="prev btn iicon" href="javascript:void(0)"><i></i></a>
								<a class="next btn iicon" href="javascript:void(0)"><i></i></a>
							</div>
						</div>
					</div>
					<!-- 公司展示 e -->
					<div class="registration fn-clear">
						<div class="fhd">
							<span><strong>免费登记</strong>坐等装修公司联系您</span>
						</div>
						<div class="fbd">
							<p class="info"></p>
							<form action="">
								<div class="row"><input type="text" placeholder="您的称呼" class="inp name"></div>
								<div class="row"><input type="text" placeholder="您的电话" class="inp phone"></div>
								<div class="row" id="addrlist">
									<select class="prov" name="addrid[]">
										<option value="0">请选择</option>
										<option value="1">北京</option>
										<option value="2">天津</option>
										<option value="3">河北</option>
										<option value="4">山西</option>
										<option value="5">内蒙古</option>
										<option value="6">辽宁</option>
										<option value="7">吉林</option>
										<option value="8">黑龙江</option>
										<option value="9">上海</option>
										<option value="10">江苏</option>
										<option value="11">浙江</option>
										<option value="12">安徽</option>
										<option value="13">福建</option>
										<option value="14">江西</option>
										<option value="15">山东</option>
										<option value="16">河南</option>
										<option value="17">湖北</option>
										<option value="18">湖南</option>
										<option value="19">广东</option>
										<option value="20">广西</option>
										<option value="21">海南</option>
										<option value="22">重庆</option>
										<option value="23">四川</option>
										<option value="24">贵州</option>
										<option value="25">云南</option>
										<option value="26">西藏</option>
										<option value="27">陕西</option>
										<option value="28">甘肃</option>
										<option value="29">青海</option>
										<option value="30">宁夏</option>
										<option value="31">新疆</option>
										<option value="33">香港</option>
										<option value="34">澳门</option>
										<option value="32">台湾</option>
									</select>
								</div>
								<div class="row">
									<input type="submit" value="免费帮您推荐靠谱公司" class="submit">
								</div>
							</form>
						</div>
						<div class="people"></div>
					</div>
				</div>
			</div>
		</div>
		<?php }?>

		<?php if (in_array("build",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?>
		<div class="box-col">
			<!-- 建材家具 s -->
			<div class="module furniture">
				<div class="mhd mhdfwb">
					<h2><font>建材</font><span>家具</span></h2>
					<a href="<?php echo $_smarty_tpl->tpl_vars['build_channelDomain']->value;?>
" class="more" target="_blank">更多&gt;&gt;</a>
				</div>
				<div class="mbd">
					<div class="topjx">
						<span class="iicon">精选</span>
						<div class="pic"><?php echo '<script'; ?>
 src="/include/json.php?action=adjs&id=161" language="javascript"><?php echo '</script'; ?>
></div>
					</div>
					<div class="list1">
						<ul class="txtinfo">
              <?php $_smarty_tpl->smarty->_tag_stack[] = array('build', array('action'=>"news",'return'=>"news",'pageSize'=>"6")); $_block_repeat=true; echo registerPluginBlockNull(array('action'=>"news",'return'=>"news",'pageSize'=>"6"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

							<li<?php if ($_smarty_tpl->tpl_vars['_bindex']->value['news']==1) {?> class="first"<?php }?>><a href="<?php echo $_smarty_tpl->tpl_vars['news']->value['url'];?>
" target="_blank" title="<?php echo $_smarty_tpl->tpl_vars['news']->value['title'];?>
"><?php echo $_smarty_tpl->tpl_vars['news']->value['title'];?>
</a></li>
              <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo registerPluginBlockNull(array('action'=>"news",'return'=>"news",'pageSize'=>"6"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

						</ul>
					</div>
					<div class="inBox2 slideGroup">
						<div class="ihd fn-clear">
							<ul class="inHd fn-clear">
								<li>新品</li>
								<li>推荐</li>
								<li>热卖</li>
								<li>促销</li>
							</ul>
						</div>
						<div class="inBd">
							<div class="slidewrap">
								<div class="slide">
									<div class="slideBox3">
										<div class="hd"><ul class="slideItem"></ul></div>
										<div class="bd">
											<ul class="fn-clear">
                        <?php $_smarty_tpl->smarty->_tag_stack[] = array('build', array('action'=>"blist",'return'=>"list",'flag'=>"n",'pageSize'=>"9")); $_block_repeat=true; echo registerPluginBlockNull(array('action'=>"blist",'return'=>"list",'flag'=>"n",'pageSize'=>"9"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

												<li>
													<a href="<?php echo $_smarty_tpl->tpl_vars['list']->value['url'];?>
" target="_blank" title="<?php echo $_smarty_tpl->tpl_vars['list']->value['title'];?>
">
														<div class="pic"><img src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
images/blank.gif" _src="<?php echo changeFileSize(array('url'=>((string)$_smarty_tpl->tpl_vars['list']->value['litpic']),'type'=>"small"),$_smarty_tpl);?>
" alt="<?php echo $_smarty_tpl->tpl_vars['list']->value['title'];?>
"></div>
														<p class="title"><?php echo $_smarty_tpl->tpl_vars['list']->value['title'];?>
</p>
														<p class="price">&yen;&nbsp;<?php echo $_smarty_tpl->tpl_vars['list']->value['price'];?>
元</p>
													</a>
												</li>
                        <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo registerPluginBlockNull(array('action'=>"blist",'return'=>"list",'flag'=>"n",'pageSize'=>"9"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

											</ul>
										</div>
									</div>
									<div class="slideBox3">
										<div class="hd"><ul class="slideItem"></ul></div>
										<div class="bd">
											<ul class="fn-clear">
                        <?php $_smarty_tpl->smarty->_tag_stack[] = array('build', array('action'=>"blist",'return'=>"list",'flag'=>"r",'pageSize'=>"9")); $_block_repeat=true; echo registerPluginBlockNull(array('action'=>"blist",'return'=>"list",'flag'=>"r",'pageSize'=>"9"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

												<li>
													<a href="<?php echo $_smarty_tpl->tpl_vars['list']->value['url'];?>
" target="_blank" title="<?php echo $_smarty_tpl->tpl_vars['list']->value['title'];?>
">
														<div class="pic"><img src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
images/blank.gif" _src="<?php echo changeFileSize(array('url'=>((string)$_smarty_tpl->tpl_vars['list']->value['litpic']),'type'=>"small"),$_smarty_tpl);?>
" alt="<?php echo $_smarty_tpl->tpl_vars['list']->value['title'];?>
"></div>
														<p class="title"><?php echo $_smarty_tpl->tpl_vars['list']->value['title'];?>
</p>
														<p class="price">&yen;&nbsp;<?php echo $_smarty_tpl->tpl_vars['list']->value['price'];?>
元</p>
													</a>
												</li>
                        <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo registerPluginBlockNull(array('action'=>"blist",'return'=>"list",'flag'=>"r",'pageSize'=>"9"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

											</ul>
										</div>
									</div>
									<div class="slideBox3">
										<div class="hd"><ul class="slideItem"></ul></div>
										<div class="bd">
											<ul class="fn-clear">
                        <?php $_smarty_tpl->smarty->_tag_stack[] = array('build', array('action'=>"blist",'return'=>"list",'flag'=>"h",'pageSize'=>"9")); $_block_repeat=true; echo registerPluginBlockNull(array('action'=>"blist",'return'=>"list",'flag'=>"h",'pageSize'=>"9"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

												<li>
													<a href="<?php echo $_smarty_tpl->tpl_vars['list']->value['url'];?>
" target="_blank" title="<?php echo $_smarty_tpl->tpl_vars['list']->value['title'];?>
">
														<div class="pic"><img src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
images/blank.gif" _src="<?php echo changeFileSize(array('url'=>((string)$_smarty_tpl->tpl_vars['list']->value['litpic']),'type'=>"small"),$_smarty_tpl);?>
" alt="<?php echo $_smarty_tpl->tpl_vars['list']->value['title'];?>
"></div>
														<p class="title"><?php echo $_smarty_tpl->tpl_vars['list']->value['title'];?>
</p>
														<p class="price">&yen;&nbsp;<?php echo $_smarty_tpl->tpl_vars['list']->value['price'];?>
元</p>
													</a>
												</li>
                        <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo registerPluginBlockNull(array('action'=>"blist",'return'=>"list",'flag'=>"h",'pageSize'=>"9"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

											</ul>
										</div>
									</div>
									<div class="slideBox3">
										<div class="hd"><ul class="slideItem"></ul></div>
										<div class="bd">
											<ul class="fn-clear">
                        <?php $_smarty_tpl->smarty->_tag_stack[] = array('build', array('action'=>"blist",'return'=>"list",'flag'=>"c",'pageSize'=>"9")); $_block_repeat=true; echo registerPluginBlockNull(array('action'=>"blist",'return'=>"list",'flag'=>"c",'pageSize'=>"9"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

												<li>
													<a href="<?php echo $_smarty_tpl->tpl_vars['list']->value['url'];?>
" target="_blank" title="<?php echo $_smarty_tpl->tpl_vars['list']->value['title'];?>
">
														<div class="pic"><img src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
images/blank.gif" _src="<?php echo changeFileSize(array('url'=>((string)$_smarty_tpl->tpl_vars['list']->value['litpic']),'type'=>"small"),$_smarty_tpl);?>
" alt="<?php echo $_smarty_tpl->tpl_vars['list']->value['title'];?>
"></div>
														<p class="title"><?php echo $_smarty_tpl->tpl_vars['list']->value['title'];?>
</p>
														<p class="price">&yen;&nbsp;<?php echo $_smarty_tpl->tpl_vars['list']->value['price'];?>
元</p>
													</a>
												</li>
                        <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo registerPluginBlockNull(array('action'=>"blist",'return'=>"list",'flag'=>"c",'pageSize'=>"9"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="store slideBox4">
						<div class="title hd">
							<h2>建材<span>品牌</span>商家</h2>
							<a href="<?php echo $_smarty_tpl->tpl_vars['member_busiDomain']->value;?>
" class="join" target="_blank">加盟店铺</a>
							<a class="prev iicon btn" href="javascript:void(0)"></a>
							<a class="next iicon btn" href="javascript:void(0)"></a>
						</div>
						<div class="bd">
							<div class="slidewrap">
								<ul class="fn-clear">
                  <?php $_smarty_tpl->smarty->_tag_stack[] = array('build', array('action'=>"brand",'return'=>"buildBrand",'rec'=>"1",'pageSize'=>"16")); $_block_repeat=true; echo registerPluginBlockNull(array('action'=>"brand",'return'=>"buildBrand",'rec'=>"1",'pageSize'=>"16"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

									<li><a href="<?php echo $_smarty_tpl->tpl_vars['buildBrand']->value['url'];?>
" target="_blank" title="<?php echo $_smarty_tpl->tpl_vars['buildBrand']->value['title'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
images/blank.gif" _src="<?php echo $_smarty_tpl->tpl_vars['buildBrand']->value['logo'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['buildBrand']->value['title'];?>
"></a></li>
                  <?php if (!($_smarty_tpl->tpl_vars['_bindex']->value['buildBrand']%9)) {?>
                </ul>
                <ul class="fn-clear">
                  <?php }?>
                  <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo registerPluginBlockNull(array('action'=>"brand",'return'=>"buildBrand",'rec'=>"1",'pageSize'=>"16"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php }?>

		<?php if (in_array("home",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?>
		<div class="box-col">
			<!-- 家居商城 s -->
			<div class="module home">
				<div class="mhd mhdfwb">
					<h2><font>家居</font><span>商城</span></h2>
					<a href="<?php echo $_smarty_tpl->tpl_vars['home_channelDomain']->value;?>
" class="more" target="_blank">更多&gt;&gt;</a>
				</div>
				<div class="mbd">

          <div class="slideBox5">
						<div class="bd">
						<div class="slidewrap">
							<div class="slide">
								<ul class="fn-clear">
                  <?php $_smarty_tpl->smarty->_tag_stack[] = array('home', array('action'=>"hlist",'return'=>"list",'flag'=>"r",'pageSize'=>"9")); $_block_repeat=true; echo registerPluginBlockNull(array('action'=>"hlist",'return'=>"list",'flag'=>"r",'pageSize'=>"9"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

									<li>
										<div class="pic"><a href="<?php echo $_smarty_tpl->tpl_vars['list']->value['url'];?>
" target="_blank" title="<?php echo $_smarty_tpl->tpl_vars['list']->value['title'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
images/blank.gif" data-url="<?php echo $_smarty_tpl->tpl_vars['list']->value['litpic'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['list']->value['title'];?>
"></a></div>
										<div class="txt">
											<p class="name"><a href="<?php echo $_smarty_tpl->tpl_vars['list']->value['url'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['list']->value['title'];?>
</a></p>
											<p class="price">&yen;&nbsp;<?php echo $_smarty_tpl->tpl_vars['list']->value['price'];?>
元</p>
										</div>
									</li>
                  <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo registerPluginBlockNull(array('action'=>"hlist",'return'=>"list",'flag'=>"r",'pageSize'=>"9"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

								</ul>
								</div>
							</div>
						</div>
						<div class="hd"><ul></ul></div>
					</div>
					<div class="dotline"></div>
					<div class="list2">
						<ul class="txtinfo fn-clear">
              <?php $_smarty_tpl->smarty->_tag_stack[] = array('home', array('action'=>"hlist",'return'=>"list",'flag'=>"c",'pageSize'=>"6")); $_block_repeat=true; echo registerPluginBlockNull(array('action'=>"hlist",'return'=>"list",'flag'=>"c",'pageSize'=>"6"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

							<li><a href="<?php echo $_smarty_tpl->tpl_vars['list']->value['url'];?>
" target="_blank" title="<?php echo $_smarty_tpl->tpl_vars['list']->value['title'];?>
"><?php echo $_smarty_tpl->tpl_vars['list']->value['title'];?>
</a></li>
              <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo registerPluginBlockNull(array('action'=>"hlist",'return'=>"list",'flag'=>"c",'pageSize'=>"6"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

						</ul>
					</div>



					<div class="store">
						<h3 class="title">推荐品牌实体店铺</h3>
						<div class="sbody">
							<ul class="pics fn-clear">
								<li><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
upfile/jiaju_dp1.jpg" alt=""></li>
								<li><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
upfile/jiaju_dp2.jpg" alt=""></li>
								<li><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
upfile/jiaju_dp3.jpg" alt=""></li>
							</ul>
							<ul class="txt">
								<li>服务电话：	0512-69577355</li>
								<li>营业时间：	9:00-18:00(节假日20:00)</li>
								<li>本馆地址：	江苏省苏州市相城区相城大道833号凯翔大厦北楼一楼（中翔小商品城对面）</li>
							</ul>
							<p class="do">
								<a href="" class="gostore" target="_blank"><i class="iicon"></i>进入店铺</a>
								<a href="" class="sendphone" target="_blank"><i class="iicon"></i>发送到手机</a>
							</p>
						</div>
					</div>
					<div class="knowledge inBox">
						<div class="fxb"><i class="iicon"></i><span>装修风向标</span></div>
						<ul class="inHd fn-clear">
							<li>装修准备</li>
							<li>装修进行时</li>
							<li>入驻阶段</li>
						</ul>
						<div class="inBd">
							<ul>
                <?php $_smarty_tpl->smarty->_tag_stack[] = array('renovation', array('action'=>'news','return'=>"renovationNews",'typeid'=>'2','pageSize'=>'6')); $_block_repeat=true; echo registerPluginBlockNull(array('action'=>'news','return'=>"renovationNews",'typeid'=>'2','pageSize'=>'6'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                <li<?php if ($_smarty_tpl->tpl_vars['_bindex']->value['renovationNews']==1) {?> class="first"<?php }?>><a href="<?php echo $_smarty_tpl->tpl_vars['renovationNews']->value['url'];?>
" target="_blank" title="<?php echo $_smarty_tpl->tpl_vars['renovationNews']->value['title'];?>
"><?php echo $_smarty_tpl->tpl_vars['renovationNews']->value['title'];?>
</a></li>
                <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo registerPluginBlockNull(array('action'=>'news','return'=>"renovationNews",'typeid'=>'2','pageSize'=>'6'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

							</ul>
							<ul>
                <?php $_smarty_tpl->smarty->_tag_stack[] = array('renovation', array('action'=>'news','return'=>"renovationNews1",'typeid'=>'8','pageSize'=>'6')); $_block_repeat=true; echo registerPluginBlockNull(array('action'=>'news','return'=>"renovationNews1",'typeid'=>'8','pageSize'=>'6'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                <li<?php if ($_smarty_tpl->tpl_vars['_bindex']->value['renovationNews1']==1) {?> class="first"<?php }?>><a href="<?php echo $_smarty_tpl->tpl_vars['renovationNews1']->value['url'];?>
" target="_blank" title="<?php echo $_smarty_tpl->tpl_vars['renovationNews1']->value['title'];?>
"><?php echo $_smarty_tpl->tpl_vars['renovationNews1']->value['title'];?>
</a></li>
                <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo registerPluginBlockNull(array('action'=>'news','return'=>"renovationNews1",'typeid'=>'8','pageSize'=>'6'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

							</ul>
							<ul>
                <?php $_smarty_tpl->smarty->_tag_stack[] = array('renovation', array('action'=>'news','return'=>"renovationNews2",'typeid'=>'17','pageSize'=>'6')); $_block_repeat=true; echo registerPluginBlockNull(array('action'=>'news','return'=>"renovationNews2",'typeid'=>'17','pageSize'=>'6'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                <li<?php if ($_smarty_tpl->tpl_vars['_bindex']->value['renovationNews2']==1) {?> class="first"<?php }?>><a href="<?php echo $_smarty_tpl->tpl_vars['renovationNews2']->value['url'];?>
" target="_blank" title="<?php echo $_smarty_tpl->tpl_vars['renovationNews2']->value['title'];?>
"><?php echo $_smarty_tpl->tpl_vars['renovationNews2']->value['title'];?>
</a></li>
                <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo registerPluginBlockNull(array('action'=>'news','return'=>"renovationNews2",'typeid'=>'17','pageSize'=>'6'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php }?>

	</div>
</div>
<!-- 装修 建材 家居 e -->
<div class="wrap">
	<div class="secondadv">
		<a href=""><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
upfile/zx_ad1.jpg" alt=""></a><a href=""><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
upfile/zx_ad2.jpg" alt=""></a>
	</div>
</div>
<!-- 婚嫁 交友 汽车 s -->
<div class="wrap">
	<div class="outwrap fn-clear">

		<?php if (in_array("marry",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?>
		<div class="box-col">
			<!-- 婚嫁 s -->
			<div class="module marry">
				<div class="mhd mhdfwb">
					<h2><font>婚嫁</font><span>摄影</span></h2>
					<a href="<?php echo $_smarty_tpl->tpl_vars['marry_channelDomain']->value;?>
" class="more" target="_blank">更多&gt;&gt;</a>
				</div>
				<div class="mbd">
					<ul class="list">
						<li>
							<div class="pic">
								<a href="" target="_blank"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
/upfile/hjsy_1.jpg" alt=""><div class="title"><p>宴会厅3个</p><i></i></div></a>
							</div>
							<div class="txt">
								<p class="title"><a href="" target="_blank">苏州博览婚礼中心</a><span class="tag tag-gift">礼</span><span class="tag tag-pay">付</span></p>
								<p class="price"><em>价格：</em><span><font>&yen;&nbsp;2888-5888</font>&nbsp;元/桌</span></p>
								<p class="des">星级酒店<span class="pice">|</span>可容纳120桌</p>
								<p class="place">地址：工业园区现代大道博览广场</p>
							</div>
						</li>
						<li class="dotline"></li>
						<li>
							<div class="pic">
								<a href="" target="_blank"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
/upfile/hjsy_2.jpg" alt=""><div class="title"><p>宴会厅6个</p><i></i></div></a>
							</div>
							<div class="txt">
								<p class="title"><a href="" target="_blank">半城湾海鲜大酒店</a><span class="tag tag-gift">礼</span><span class="tag tag-pay">付</span></p>
								<p class="price"><em>价格：</em><span><font>&yen;&nbsp;1388-2500</font>&nbsp;元/桌</span></p>
								<p class="des">星级酒店<span class="pice">|</span>可容纳70桌</p>
								<p class="place">地址：工业园区李公堤</p>
							</div>
						</li>
						<li class="dotline"></li>
					</ul>
					<ul class="list2 txtinfo">
						<li><a href="" target="_blank">火鸟婚嫁斩获2016第四届 TopDigital创新专项奖</a></li>
						<li><a href="" target="_blank">炎炎夏日清凉备婚 “到喜啦”一站轻松定</a></li>
						<li><a href="" target="_blank">火鸟婚嫁助力第四届中国婚庆喜宴产业发展论坛顺利召开</a></li>
						<li><a href="" target="_blank">梁总受邀参加头脑风暴，现场互动不断反响热烈</a></li>
						<li><a href="" target="_blank">上火鸟婚嫁找结婚管家轻松开启备婚模式</a></li>
					</ul>

					<div class="marrycar">
						<div class="shd fn-clear">
							<h3>推荐婚车</h3><a href="" class="more" target="_blank">更多车型</a>
						</div>
						<div class="sbd">
							<ul class="list3 fn-clear">
								<li>
									<a href="" target="_blank">
										<img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
/upfile/marrycar_1.jpg" alt="">
										<div>
											<p><span class="name">劳斯莱斯幻影</span><span class="price">&yen;&nbsp;10888/半天</span></p>
											<i></i>
										</div>
									</a>
								</li>
								<li>
									<a href="" target="_blank">
										<img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
/upfile/marrycar_2.jpg" alt="">
										<div>
											<p><span class="name">特斯拉</span><span class="price">&yen;&nbsp;1800/半天</span></p>
											<i></i>
										</div>
									</a>
								</li>
								<li>
									<a href="" target="_blank">
										<img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
/upfile/marrycar_3.jpg" alt="">
										<div>
											<p><span class="name">宝马3敞篷</span><span class="price">&yen;&nbsp;1900/半天</span></p>
											<i></i>
										</div>
									</a>
								</li>
								<li>
									<a href="" target="_blank">
										<img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
/upfile/marrycar_4.jpg" alt="">
										<div>
											<p><span class="name">宝马7系</span><span class="price">&yen;&nbsp;1150/半天</span></p>
											<i></i>
										</div>
									</a>
								</li>
							</ul>
						</div>
					</div>

					<div class="photocompany slideBox6">
						<div class="shd fn-clear">
							<h3>摄影公司</h3>
							<ul class="slideItem"></ul>
						</div>
						<div class="sbd slidewrap">
							<div class="slide">
								<ul class="list">
									<li>
										<div class="pic">
											<a href="" target="_blank"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
/upfile/hjsy_1.jpg" alt=""><div class="title"><p>套系10个</p><i></i></div></a>
										</div>
										<div class="txt">
											<p class="title"><a href="" target="_blank">太郎花子婚纱摄影</a><span class="tag tag-gift">礼</span><span class="tag tag-discount">惠</span><span class="tag tag-pay">付</span></p>
											<p class="price"><em>价格：</em><span><font>&yen;&nbsp;2888-5888</font>&nbsp;元/桌</span></p>
											<p class="des">高品质服务<span class="pice"></span>口碑第一<span class="pice"></span>大片效果</p>
											<p class="place">地址：平江区养育巷415号产业园1栋</p>
										</div>
									</li>
									<li>
										<div class="pic">
											<a href="" target="_blank"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
/upfile/hjsy_1.jpg" alt=""><div class="title"><p>套系10个</p><i></i></div></a>
										</div>
										<div class="txt">
											<p class="title"><a href="" target="_blank">太郎花子婚纱摄影</a><span class="tag tag-gift">礼</span><span class="tag tag-discount">惠</span><span class="tag tag-pay">付</span></p>
											<p class="price"><em>价格：</em><span><font>&yen;&nbsp;2888-5888</font>&nbsp;元/桌</span></p>
											<p class="des">高品质服务<span class="pice"></span>口碑第一<span class="pice"></span>大片效果</p>
											<p class="place">地址：平江区养育巷415号产业园1栋</p>
										</div>
									</li>
									<li>
										<div class="pic">
											<a href="" target="_blank"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
/upfile/hjsy_1.jpg" alt=""><div class="title"><p>套系10个</p><i></i></div></a>
										</div>
										<div class="txt">
											<p class="title"><a href="" target="_blank">太郎花子婚纱摄影</a><span class="tag tag-gift">礼</span><span class="tag tag-discount">惠</span><span class="tag tag-pay">付</span></p>
											<p class="price"><em>价格：</em><span><font>&yen;&nbsp;2888-5888</font>&nbsp;元/桌</span></p>
											<p class="des">高品质服务<span class="pice"></span>口碑第一<span class="pice"></span>大片效果</p>
											<p class="place">地址：工业园区现代大道博览广场</p>
										</div>
									</li>
								</ul>
							</div>
						</div>
					</div>

					<div class="series">
						<div class="shd">
							<h3>推荐套系</h3><a href="" class="more" target="_blank">全部套系</a>
						</div>
						<div class="sbd">
							<ul class="list4 fn-clear">
								<li>
									<div class="pic">
										<a href="" target="_blank"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
/upfile/hjsy_4.jpg" alt=""></a>
									</div>
									<div class="txt">
										<p class="title"><a href="" target="_blank">网络闪购会-A</a></p>
										<p class="price">&yen;&nbsp;4999元</p>
									</div>
								</li>
								<li>
									<div class="pic">
										<a href="" target="_blank"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
/upfile/hjsy_5.jpg" alt=""></a>
									</div>
									<div class="txt">
										<p class="title"><a href="" target="_blank">大促活动套餐A</a></p>
										<p class="price">&yen;&nbsp;5600元</p>
									</div>
								</li>
								<li>
									<div class="pic">
										<a href="" target="_blank"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
/upfile/hjsy_6.jpg" alt=""></a>
									</div>
									<div class="txt">
										<p class="title"><a href="" target="_blank">网络闪购会-B</a></p>
										<p class="price">&yen;&nbsp;5999元</p>
									</div>
								</li>
							</ul>
						</div>
					</div>

				</div>
			</div>
		</div>
		<?php }?>

		<?php if (in_array("dating",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?>
		<div class="box-col">
			<!-- 交友 s -->
			<div class="module dating">
				<div class="mhd mhdfwb">
					<h2><font>同城</font><span>交友</span></h2>
					<a href="<?php echo $_smarty_tpl->tpl_vars['dating_channelDomain']->value;?>
" class="more" target="_blank">更多&gt;&gt;</a>
				</div>
				<div class="mbd">
					<div class="story">
						<p class="title"><span>TA</span>们都能在这成功，<font>你还犹豫什么？</font></p>
            <?php $_smarty_tpl->smarty->_tag_stack[] = array('dating', array('action'=>"story",'return'=>"story",'process'=>"2",'pageSize'=>"1")); $_block_repeat=true; echo registerPluginBlockNull(array('action'=>"story",'return'=>"story",'process'=>"2",'pageSize'=>"1"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

						<div class="pic">
							<a href="<?php echo $_smarty_tpl->tpl_vars['story']->value['url'];?>
" target="_blank" title="<?php echo $_smarty_tpl->tpl_vars['story']->value['fnickname'];?>
 & <?php if ($_smarty_tpl->tpl_vars['story']->value['tid']==0) {?>保密<?php } else {
echo $_smarty_tpl->tpl_vars['story']->value['tnickname'];
}?>">
								<img src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
images/blank.gif" data-url="<?php echo changeFileSize(array('url'=>((string)$_smarty_tpl->tpl_vars['story']->value['litpic']),'type'=>"o_large"),$_smarty_tpl);?>
" alt="">
								<p><?php echo $_smarty_tpl->tpl_vars['story']->value['fnickname'];?>
 & <?php if ($_smarty_tpl->tpl_vars['story']->value['tid']==0) {?>保密<?php } else {
echo $_smarty_tpl->tpl_vars['story']->value['tnickname'];
}?></p>
								<i></i>
							</a>
						</div>
						<p class="des"><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['story']->value['content'],80);?>
<a href="<?php echo $_smarty_tpl->tpl_vars['story']->value['url'];?>
" target="_blank">详细</a></p>
            <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo registerPluginBlockNull(array('action'=>"story",'return'=>"story",'process'=>"2",'pageSize'=>"1"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

						<ul class="list fn-clear">
              <?php $_smarty_tpl->smarty->_tag_stack[] = array('dating', array('action'=>"story",'return'=>"story",'process'=>"1",'pageSize'=>"3")); $_block_repeat=true; echo registerPluginBlockNull(array('action'=>"story",'return'=>"story",'process'=>"1",'pageSize'=>"3"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

							<li>
								<a href="<?php echo $_smarty_tpl->tpl_vars['story']->value['url'];?>
" target="_blank" title="<?php echo $_smarty_tpl->tpl_vars['story']->value['fnickname'];?>
 & <?php if ($_smarty_tpl->tpl_vars['story']->value['tid']==0) {?>保密<?php } else {
echo $_smarty_tpl->tpl_vars['story']->value['tnickname'];
}?>">
									<img src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
images/blank.gif" data-url="<?php echo changeFileSize(array('url'=>((string)$_smarty_tpl->tpl_vars['story']->value['litpic']),'type'=>"middle"),$_smarty_tpl);?>
" alt="<?php echo $_smarty_tpl->tpl_vars['story']->value['fnickname'];?>
 & <?php if ($_smarty_tpl->tpl_vars['story']->value['tid']==0) {?>保密<?php } else {
echo $_smarty_tpl->tpl_vars['story']->value['tnickname'];
}?>">
									<p><?php echo $_smarty_tpl->tpl_vars['story']->value['fnickname'];?>
 & <?php if ($_smarty_tpl->tpl_vars['story']->value['tid']==0) {?>保密<?php } else {
echo $_smarty_tpl->tpl_vars['story']->value['tnickname'];
}?></p>
									<i></i>
								</a>
							</li>
              <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo registerPluginBlockNull(array('action'=>"story",'return'=>"story",'process'=>"1",'pageSize'=>"3"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

						</ul>
					</div>
					<div class="activity inBox">
						<div class="shd inHd">
							<ul class="fn-clear">
								<li>交友活动</li>
								<!-- <li>往期回顾</li> -->
							</ul>
							<a href="<?php echo getUrlPath(array('service'=>'dating','template'=>'activity'),$_smarty_tpl);?>
" class="more" target="_blank">更多活动</a>
						</div>
						<div class="sbd inBd">
							<ul class="latest">
                <?php $_smarty_tpl->smarty->_tag_stack[] = array('dating', array('action'=>"activity",'return'=>"activity",'pageSize'=>"1")); $_block_repeat=true; echo registerPluginBlockNull(array('action'=>"activity",'return'=>"activity",'pageSize'=>"1"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

								<li>
									<p class="title"><a href="<?php echo $_smarty_tpl->tpl_vars['activity']->value['url'];?>
" target="_blank" title="<?php echo $_smarty_tpl->tpl_vars['activity']->value['title'];?>
"><?php echo $_smarty_tpl->tpl_vars['activity']->value['title'];?>
</a></p>
									<div class="fn-clear">
										<div class="pic">
											<a href="" target="_blank">
												<img src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
images/blank.gif" data-url="<?php echo changeFileSize(array('url'=>((string)$_smarty_tpl->tpl_vars['activity']->value['litpic']),'type'=>"middle"),$_smarty_tpl);?>
" alt="">
												<p>现已有&nbsp;<?php echo $_smarty_tpl->tpl_vars['activity']->value['been'];?>
&nbsp;人报名</p>
												<i></i>
											</a>
										</div>
										<div class="txt">
											<a href="<?php echo $_smarty_tpl->tpl_vars['activity']->value['url'];?>
" class="sign" target="_blank">报名</a>
											<p>邀请人数：200人</p>
											<p>活动时间：<?php echo $_smarty_tpl->tpl_vars['activity']->value['btime'];?>
</p>
											<p class="place">活动地点：<?php echo $_smarty_tpl->tpl_vars['activity']->value['address'];?>
</p>
										</div>
									</div>
								</li>
                <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo registerPluginBlockNull(array('action'=>"activity",'return'=>"activity",'pageSize'=>"1"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

							</ul>
						</div>
					</div>
					<div class="sbox">
						<div class="searchlove">
							<div class="shd fn-clear"><h3>搜索爱情</h3></div>
							<div class="sbd">
								<form action="">
									<div class="form-row fn-clear">
										<span class="tp">我要找</span>
										<div class="mp">
											<label><input type="radio" name="sex" checked="checked">女士</label>
											<label><input type="radio" name="sex">男士</label>
										</div>
									</div>
									<div class="form-row fn-clear">
										<span class="tp">年龄在</span>
										<div class="mp" id="age">
											<select name="" id="agemin">
												<option value="0">不限</option>
											</select>
											<span class="pice">~</span>
											<select name="" id="agemax">
												<option value="0">不限</option>
											</select>
										</div>
									</div>
									<div class="form-row fn-clear">
										<span class="tp">交友地</span>
										<div class="mp">
											<select name="addrid[]"><option value="0">请选择</option><option value="162">南京</option><option value="173">泰州</option><option value="172">镇江</option><option value="171">扬州</option><option value="170">盐城</option><option value="169">淮安</option><option value="168">连云港</option><option value="167">南通</option><option value="166" selected="selected">苏州</option><option value="165">常州</option><option value="164">徐州</option><option value="163">无锡</option><option value="174">宿迁</option></select>
											<span class="havephoto checked"><input type="checkbox" checked="checked"><i class="iicon"></i>有照片</span>
										</div>
									</div>
									<div class="form-row fn-clear do">
										<span class="tp">提交</span>
										<div class="mp">
											<input type="submit" class="submit btn" value="立即搜索"><a href="" class="senior btn">高级搜搜</a>
										</div>
									</div>
								</form>
							</div>
						</div>
						<div class="members">
							<div class="shd">
								<h3>同城会员推荐</h3>
								<ul class="slideItem"></ul>
							</div>
							<div class="sbd slidewrap">
								<div class="slide">
									<ul class="list2 fn-clear">

                    <?php $_smarty_tpl->smarty->_tag_stack[] = array('dating', array('action'=>"memberList",'return'=>"member",'property'=>"r",'pageSize'=>"9")); $_block_repeat=true; echo registerPluginBlockNull(array('action'=>"memberList",'return'=>"member",'property'=>"r",'pageSize'=>"9"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

										<li>
											<a href="<?php echo $_smarty_tpl->tpl_vars['member']->value['url'];?>
" target="_blank" title="<?php echo $_smarty_tpl->tpl_vars['member']->value['nickname'];?>
">
												<img src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
images/blank.gif" _src="<?php echo changeFileSize(array('url'=>((string)$_smarty_tpl->tpl_vars['member']->value['photo']),'type'=>"middle"),$_smarty_tpl);?>
" alt="<?php echo $_smarty_tpl->tpl_vars['member']->value['nickname'];?>
">
												<p><span class="name"><?php echo $_smarty_tpl->tpl_vars['member']->value['nickname'];?>
</span><span class="age"><?php echo $_smarty_tpl->tpl_vars['member']->value['age'];?>
岁</span></p>
												<i></i>
											</a>
										</li>
                    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo registerPluginBlockNull(array('action'=>"memberList",'return'=>"member",'property'=>"r",'pageSize'=>"9"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>


									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php }?>

		<?php if (in_array("car",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?>
		<div class="box-col">
			<!-- 汽车 s -->
			<div class="module car">
				<div class="mhd mhdfwb">
					<h2><font>汽车</font><span>频道</span></h2>
					<a href="<?php echo $_smarty_tpl->tpl_vars['car_channelDomain']->value;?>
" class="more" target="_blank">更多&gt;&gt;</a>
				</div>
				<div class="mbd">
					<div class="carlogo inBox">
						<div class="inHd">
							<ul class="fn-clear">
								<li>按品牌</li>
								<li>按价格</li>
								<li>按级别</li>
								<li>热门车</li>
							</ul>
						</div>
						<div class="inBd">
							<ul class="fn-clear">
								<li><a href="" target="_blank"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
upfile/1.jpg" alt=""><span>大众</span></a></li>
								<li><a href="" target="_blank"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
upfile/2.jpg" alt=""><span>丰田</span></a></li>
								<li><a href="" target="_blank"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
upfile/3.jpg" alt=""><span>福特</span></a></li>
								<li><a href="" target="_blank"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
upfile/4.jpg" alt=""><span>现代</span></a></li>
								<li><a href="" target="_blank"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
upfile/5.jpg" alt=""><span>标致</span></a></li>
								<li><a href="" target="_blank"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
upfile/6.jpg" alt=""><span>本田</span></a></li>
								<li><a href="" target="_blank"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
upfile/7.jpg" alt=""><span>宝马</span></a></li>
								<li><a href="" target="_blank"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
upfile/8.jpg" alt=""><span>吉利</span></a></li>
								<li><a href="" target="_blank"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
upfile/9.jpg" alt=""><span>奥迪</span></a></li>
								<li class="more"><a href="" target="_blank"><div><i class="iicon iicon-more"></i></div><span>更多</span></a></li>
							</ul>
							<ul class="fn-clear">
								<li><a href="" target="_blank"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
upfile/7.jpg" alt=""><span>宝马</span></a></li>
								<li><a href="" target="_blank"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
upfile/8.jpg" alt=""><span>吉利</span></a></li>
								<li><a href="" target="_blank"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
upfile/1.jpg" alt=""><span>大众</span></a></li>
								<li><a href="" target="_blank"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
upfile/2.jpg" alt=""><span>丰田</span></a></li>
								<li><a href="" target="_blank"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
upfile/3.jpg" alt=""><span>福特</span></a></li>
								<li><a href="" target="_blank"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
upfile/4.jpg" alt=""><span>现代</span></a></li>
								<li><a href="" target="_blank"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
upfile/5.jpg" alt=""><span>标致</span></a></li>
								<li><a href="" target="_blank"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
upfile/6.jpg" alt=""><span>本田</span></a></li>
								<li><a href="" target="_blank"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
upfile/9.jpg" alt=""><span>奥迪</span></a></li>
								<li class="more"><a href="" target="_blank"><div><i class="iicon iicon-more"></i></div><span>更多</span></a></li>
							</ul>
							<ul class="fn-clear">
								<li><a href="" target="_blank"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
upfile/3.jpg" alt=""><span>福特</span></a></li>
								<li><a href="" target="_blank"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
upfile/4.jpg" alt=""><span>现代</span></a></li>
								<li><a href="" target="_blank"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
upfile/5.jpg" alt=""><span>标致</span></a></li>
								<li><a href="" target="_blank"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
upfile/1.jpg" alt=""><span>大众</span></a></li>
								<li><a href="" target="_blank"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
upfile/2.jpg" alt=""><span>丰田</span></a></li>
								<li><a href="" target="_blank"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
upfile/6.jpg" alt=""><span>本田</span></a></li>
								<li><a href="" target="_blank"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
upfile/7.jpg" alt=""><span>宝马</span></a></li>
								<li><a href="" target="_blank"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
upfile/8.jpg" alt=""><span>吉利</span></a></li>
								<li><a href="" target="_blank"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
upfile/9.jpg" alt=""><span>奥迪</span></a></li>
								<li class="more"><a href="" target="_blank"><div><i class="iicon iicon-more"></i></div><span>更多</span></a></li>
							</ul>
							<ul class="fn-clear">
								<li><a href="" target="_blank"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
upfile/4.jpg" alt=""><span>现代</span></a></li>
								<li><a href="" target="_blank"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
upfile/5.jpg" alt=""><span>标致</span></a></li>
								<li><a href="" target="_blank"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
upfile/6.jpg" alt=""><span>本田</span></a></li>
								<li><a href="" target="_blank"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
upfile/4.jpg" alt=""><span>现代</span></a></li>
								<li><a href="" target="_blank"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
upfile/5.jpg" alt=""><span>标致</span></a></li>
								<li><a href="" target="_blank"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
upfile/6.jpg" alt=""><span>本田</span></a></li>
								<li><a href="" target="_blank"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
upfile/7.jpg" alt=""><span>宝马</span></a></li>
								<li><a href="" target="_blank"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
upfile/8.jpg" alt=""><span>吉利</span></a></li>
								<li><a href="" target="_blank"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
upfile/9.jpg" alt=""><span>奥迪</span></a></li>
								<li class="more"><a href="" target="_blank"><div><i class="iicon iicon-more"></i></div><span>更多</span></a></li>
							</ul>
						</div>
					</div>
					<!-- 焦点图 s -->
					<div class="picFocus">
						<div class="slideBox slideBox8 twoSizeSlide">
							<div class="bd">
                <div class="slideObj"><?php echo getMyAd(array('id'=>"162",'type'=>"slide"),$_smarty_tpl);?>
</div>
								<div class="pages"></div>
							</div>
						</div>
					</div>
					<!-- 焦点图 e -->
					<ul class="list2 fn-clear">
						<li>
							<a href="" target="_blank">
								<i class="buycar-1"></i><span>购车购</span>
							</a>
						</li>
						<li>
							<a href="" target="_blank">
								<i class="buycar-2"></i><span>购车优惠</span>
							</a>
						</li>
						<li>
							<a href="" target="_blank">
								<i class="buycar-3"></i><span>购车计算</span>
							</a>
						</li>
						<li>
							<a href="" target="_blank">
								<i class="buycar-4"></i><span>分期购车</span>
							</a>
						</li>
					</ul>
					<div class="carnews">
						<div class="shd fn-clear">
							<h3>汽车资讯</h3><a href="javascript:;" class="changegroup next"><i class="iicon iicon-change"></i>换一组</a>
						</div>
						<div class="sbd">
							<div class="slidewrap">
								<ul class="slide list3">
									<li>
										<div class="pic">
											<a href="" target="_blank"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
upfile/carnews_1.jpg" alt=""><div class="title"><p>未婚妻助阵奔驰C300</p><i></i></div></a>
										</div>
										<ul class="txtinfo">
											<li><a href="" target="_blank">正值而立之年 终情定一汽丰田RAV4</a></li>
											<li><a href="" target="_blank">梦里注定有“你” 蒙迪欧选车购车</a></li>
											<li><a href="" target="_blank">外观宽敞大气 浅谈瑞虎5提车感受</a></li>
											<li><a href="" target="_blank">空间宽敞工艺欠佳 浅谈普拉多3.5L</a></li>
										</ul>
										<div class="dotline"></div>
										<div class="pic">
											<a href="" target="_blank"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
upfile/carnews_2.jpg" alt=""><div class="title"><p>创意对杯圆形茶杯</p><i></i></div></a>
										</div>
										<ul class="txtinfo">
											<li><a href="" target="_blank">动力真的很强劲 全新途胜提车感受</a></li>
											<li><a href="" target="_blank">给老婆的礼物 奔三已婚男怒提飞度</a></li>
											<li><a href="" target="_blank">心仪已久终圆梦 森林人2.0i提车记</a></li>
											<li><a href="" target="_blank">爱车完美升级 凯迪拉克XTS终极进化</a></li>
										</ul>
										<div class="dotline"></div>
									</li>
									<li>
										<div class="pic">
											<a href="" target="_blank"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
upfile/carnews_1.jpg" alt=""><div class="title"><p>未婚妻助阵奔驰C300</p><i></i></div></a>
										</div>
										<ul class="txtinfo">
											<li><a href="" target="_blank">正值而立之年 终情定一汽丰田RAV4</a></li>
											<li><a href="" target="_blank">梦里注定有“你” 蒙迪欧选车购车</a></li>
											<li><a href="" target="_blank">外观宽敞大气 浅谈瑞虎5提车感受</a></li>
											<li><a href="" target="_blank">空间宽敞工艺欠佳 浅谈普拉多3.5L</a></li>
										</ul>
										<div class="dotline"></div>
										<div class="pic">
											<a href="" target="_blank"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
upfile/carnews_2.jpg" alt=""><div class="title"><p>创意对杯圆形茶杯</p><i></i></div></a>
										</div>
										<ul class="txtinfo">
											<li><a href="" target="_blank">动力真的很强劲 全新途胜提车感受</a></li>
											<li><a href="" target="_blank">给老婆的礼物 奔三已婚男怒提飞度</a></li>
											<li><a href="" target="_blank">心仪已久终圆梦 森林人2.0i提车记</a></li>
											<li><a href="" target="_blank">爱车完美升级 凯迪拉克XTS终极进化</a></li>
										</ul>
										<div class="dotline"></div>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="carpics">
						<div class="shd fn-clear">
							<h3>汽车图库</h3><a href="" class="more" target="_blank">更多资讯</a>
						</div>
						<div class="sbd">
							<ul class="txtinfo list4">
								<li class="first"><a href="" target="_blank">卫生间风水都不知道！后悔没早点看到！</a></li>
								<li><a href="" target="_blank">面积虽小讲究不少 小户型房屋6大风水禁忌</a></li>
								<li><a href="" target="_blank">家里装修千万别犯这十傻！装完你就得傻</a></li>
								<li><a href="" target="_blank">装修妙招：8个小技巧让你真正把钱省起来！</a></li>
								<li><a href="" target="_blank">5大客厅天花板常用材料 满足你的一切需要!</a></li>
								<li><a href="" target="_blank">家装舒适实用!小户型装修的4大原则</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php }?>

	</div>
</div>
<!-- 婚嫁 交友 汽车 e -->

<div class="wrap friendlink">
  <fieldset>
	<legend>友情链接：</legend>
    <div>
      <?php $_smarty_tpl->smarty->_tag_stack[] = array('siteConfig', array('action'=>"friendLink",'return'=>"flink",'module'=>"siteConfig")); $_block_repeat=true; echo siteConfig(array('action'=>"friendLink",'return'=>"flink",'module'=>"siteConfig"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<a href="<?php echo $_smarty_tpl->tpl_vars['flink']->value['sitelink'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['flink']->value['sitename'];?>
</a>&nbsp;<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo siteConfig(array('action'=>"friendLink",'return'=>"flink",'module'=>"siteConfig"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

    </div>
  </fieldset>
</div>

<?php echo $_smarty_tpl->getSubTemplate ("../footer1.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
js/ui/jquery.SuperSlide.2.1.1.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
js/ui/jquery.scroll.loading.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
js/ui/jquery.colorPicker.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
js/common.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
js/index.js?v=2"><?php echo '</script'; ?>
>

</body>
</html>
<?php }} ?>
