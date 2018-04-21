<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-06-22 10:46:40
         compiled from "D:\ServerWwwroot\www.lwm.com\templates\article\default\index.html" */ ?>
<?php /*%%SmartyHeaderCode:25568594b2f9099d2e4-71432311%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '40a10494a5688ee9c4fcf7c0db76277bff130c71' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\templates\\article\\default\\index.html',
      1 => 1494491181,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '25568594b2f9099d2e4-71432311',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'cfg_soft_lang' => 0,
    'article_title' => 0,
    'article_keywords' => 0,
    'article_description' => 0,
    'cfg_basehost' => 0,
    'cfg_staticPath' => 0,
    'templets_skin' => 0,
    'article_channelDomain' => 0,
    'cfg_hideUrl' => 0,
    'article_channelName' => 0,
    'article_logoUrl' => 0,
    'cfg_weatherCity' => 0,
    'article_submission' => 0,
    'alist' => 0,
    'blist' => 0,
    '_bindex' => 0,
    'ajtype' => 0,
    'ajtype1' => 0,
    'hlist' => 0,
    'clist' => 0,
    'list1' => 0,
    'list2' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_594b2f90ba4be6_14404316',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_594b2f90ba4be6_14404316')) {function content_594b2f90ba4be6_14404316($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_truncate')) include 'D:\\ServerWwwroot\\www.lwm.com\\include\\tpl\\plugins\\modifier.truncate.php';
?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=<?php echo $_smarty_tpl->tpl_vars['cfg_soft_lang']->value;?>
">
<meta http-equiv="X-UA-Compatible" content="IE=EDGE">
<title><?php echo $_smarty_tpl->tpl_vars['article_title']->value;?>
</title>
<meta name="keywords" content="<?php echo $_smarty_tpl->tpl_vars['article_keywords']->value;?>
" />
<meta name="description" content="<?php echo $_smarty_tpl->tpl_vars['article_description']->value;?>
" />
<link rel="shortcut icon" href="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
/favicon.ico" type="image/x-icon" />
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
css/core/base.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
css/common.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
css/public.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
css/index.css" media="all" />
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
js/core/jquery-1.8.3.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
js/ui/pace.js"><?php echo '</script'; ?>
> <!-- 页面加载进度 -->
<?php echo '<script'; ?>
 type="text/javascript">
	var masterDomain = '<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
', channelDomain = '<?php echo $_smarty_tpl->tpl_vars['article_channelDomain']->value;?>
';

	var criticalPoint = 1240, criticalClass = "w1200";
	$("html").addClass($(window).width() > criticalPoint ? criticalClass : "");

	var hideFileUrl = <?php echo $_smarty_tpl->tpl_vars['cfg_hideUrl']->value;?>
;
<?php echo '</script'; ?>
>
</head>

<body>
<?php echo $_smarty_tpl->getSubTemplate ("../../siteConfig/top.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<div class="wrap ad"><?php echo '<script'; ?>
 src='/include/json.php?action=adjs&id=42' language='javascript'><?php echo '</script'; ?>
></div>

<!-- LOGO s -->
<div class="wrap fn-clear">
	<h1 class="logo"><a href="<?php echo $_smarty_tpl->tpl_vars['article_channelDomain']->value;?>
" title="<?php echo $_smarty_tpl->tpl_vars['article_channelName']->value;?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['article_logoUrl']->value;?>
" alt="<?php echo $_smarty_tpl->tpl_vars['article_channelName']->value;?>
" /></a></h1>
</div>
<!-- LOGO e -->

<!-- 导航 s -->
<div class="nav">
	<ul class="wrap fn-clear">
		<li class="on current"><a href="<?php echo $_smarty_tpl->tpl_vars['article_channelDomain']->value;?>
">首页</a></li>
		<?php echo getChannel(array('service'=>"article"),$_smarty_tpl);?>

	</ul>
</div>
<!-- 导航 e -->

<!-- 天气、投稿 s -->
<div class="wrap fn-clear">
	<div class="weater">
		<span class="echotime"><?php echo getMyTime(array('format'=>"%Y"),$_smarty_tpl);?>
年<?php echo getMyTime(array('format'=>"%m"),$_smarty_tpl);?>
月<?php echo getMyTime(array('format'=>"%d"),$_smarty_tpl);?>
日</span>
		<span class="echoweek"><?php echo getMyWeek(array('prefix'=>"星期"),$_smarty_tpl);?>
</span>
		<ul class="weatherInfo fn-clear">
			<li class="weatherCity"><?php echo $_smarty_tpl->tpl_vars['cfg_weatherCity']->value;?>
</li>
		</ul>
	</div>
	<div class="tougao">
		<a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'fabu','action'=>'article'),$_smarty_tpl);?>
" target="_blank" class="online">在线投稿</a>
		<span>投稿信箱：<?php echo $_smarty_tpl->tpl_vars['article_submission']->value;?>
</span>
	</div>
</div>
<!-- 天气、投稿 e -->

<!-- 幻灯图片 s -->
<div class="wrap slideshow_1000_330">
	<div id="slideshow1000330">
		<?php echo '<script'; ?>
 src='/include/json.php?action=adjs&id=33&type=slide' language='javascript'><?php echo '</script'; ?>
>
	</div>
	<div id="slidebtn1000330" class="slidebtn"></div>
</div>
<!-- 幻灯图片 e -->

<!-- 今日头条 s -->
<div class="wrap headlines fn-clear">
	<div class="title">今日头条</div>
	<div class="headinfo">
	  <?php $_smarty_tpl->smarty->_tag_stack[] = array('article', array('action'=>"alist",'return'=>"alist",'flag'=>"h,r",'pageSize'=>"1")); $_block_repeat=true; echo article(array('action'=>"alist",'return'=>"alist",'flag'=>"h,r",'pageSize'=>"1"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

		<h2 class="ht"><a href="<?php echo $_smarty_tpl->tpl_vars['alist']->value['url'];?>
" title="<?php echo preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['alist']->value['title']);?>
"><?php echo $_smarty_tpl->tpl_vars['alist']->value['title'];?>
</a></h2>
		<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo article(array('action'=>"alist",'return'=>"alist",'flag'=>"h,r",'pageSize'=>"1"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

		<ul class="fn-clear">
		  <?php $_smarty_tpl->smarty->_tag_stack[] = array('article', array('action'=>"alist",'return'=>"alist",'flag'=>"h",'pageSize'=>"4")); $_block_repeat=true; echo article(array('action'=>"alist",'return'=>"alist",'flag'=>"h",'pageSize'=>"4"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

			<li><a href="<?php echo $_smarty_tpl->tpl_vars['alist']->value['url'];?>
" title="<?php echo preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['alist']->value['title']);?>
"><?php echo preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['alist']->value['title']);?>
</a></li>
			<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo article(array('action'=>"alist",'return'=>"alist",'flag'=>"h",'pageSize'=>"4"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

		</ul>
	</div>
</div>
<!-- 今日头条 e -->

<div class="wrap fn-clear">
	<div class="wmain">
		<!-- 头部新闻 s -->
		<div class="headnews">

			<div class="hdnews">
			  <?php $_smarty_tpl->smarty->_tag_stack[] = array('article', array('action'=>"alist",'return'=>"alist",'flag'=>"r,b",'thumb'=>"0",'pageSize'=>"1")); $_block_repeat=true; echo article(array('action'=>"alist",'return'=>"alist",'flag'=>"r,b",'thumb'=>"0",'pageSize'=>"1"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

				<h3><a href="<?php echo $_smarty_tpl->tpl_vars['alist']->value['url'];?>
" title="<?php echo preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['alist']->value['title']);?>
"><?php echo $_smarty_tpl->tpl_vars['alist']->value['title'];?>
</a></h3>
				<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo article(array('action'=>"alist",'return'=>"alist",'flag'=>"r,b",'thumb'=>"0",'pageSize'=>"1"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

				<ul class="fn-clear">
				  <?php $_smarty_tpl->smarty->_tag_stack[] = array('article', array('action'=>"alist",'return'=>"alist",'flag'=>"r",'thumb'=>"0",'pageSize'=>"6")); $_block_repeat=true; echo article(array('action'=>"alist",'return'=>"alist",'flag'=>"r",'thumb'=>"0",'pageSize'=>"6"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

					<li><a href="<?php echo $_smarty_tpl->tpl_vars['alist']->value['url'];?>
" title="<?php echo preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['alist']->value['title']);?>
"><?php echo $_smarty_tpl->tpl_vars['alist']->value['title'];?>
</a></li>
					<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo article(array('action'=>"alist",'return'=>"alist",'flag'=>"r",'thumb'=>"0",'pageSize'=>"6"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

				</ul>
				<div class="btns fn-clear">
				  <?php $_smarty_tpl->smarty->_tag_stack[] = array('article', array('action'=>"alist",'return'=>"alist",'flag'=>"r,b",'thumb'=>"0",'pageSize'=>"1")); $_block_repeat=true; echo article(array('action'=>"alist",'return'=>"alist",'flag'=>"r,b",'thumb'=>"0",'pageSize'=>"1"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

					<a href="<?php echo $_smarty_tpl->tpl_vars['alist']->value['url'];?>
#comment" class="reviewbtn" title="评论数"><?php echo $_smarty_tpl->tpl_vars['alist']->value['common'];?>
</a>
					<a href="javascript:;" class="sharebtn" data-title="<?php echo preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['alist']->value['title']);?>
" data-url="<?php echo $_smarty_tpl->tpl_vars['alist']->value['url'];?>
" data-pic="<?php echo $_smarty_tpl->tpl_vars['alist']->value['litpic'];?>
"></a>
					<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo article(array('action'=>"alist",'return'=>"alist",'flag'=>"r,b",'thumb'=>"0",'pageSize'=>"1"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

				</div>
			</div>

			<!-- 有图 -->
			<?php $_smarty_tpl->smarty->_tag_stack[] = array('article', array('action'=>"alist",'return'=>"alist",'flag'=>"r",'thumb'=>"1",'pageSize'=>"4")); $_block_repeat=true; echo article(array('action'=>"alist",'return'=>"alist",'flag'=>"r",'thumb'=>"1",'pageSize'=>"4"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

			<div class="hdnews haspic fn-clear">
				<a href="<?php echo $_smarty_tpl->tpl_vars['alist']->value['url'];?>
" class="pic"><img src="<?php echo changeFileSize(array('url'=>((string)$_smarty_tpl->tpl_vars['alist']->value['litpic']),'type'=>"small"),$_smarty_tpl);?>
" alt="<?php echo preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['alist']->value['title']);?>
"></a>
				<h3><a href="<?php echo $_smarty_tpl->tpl_vars['alist']->value['url'];?>
" title="<?php echo preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['alist']->value['title']);?>
"><?php echo preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['alist']->value['title']);?>
</a></h3>
				<ul class="fn-clear">
					<?php $_smarty_tpl->smarty->_tag_stack[] = array('article', array('action'=>"alist",'return'=>"blist",'thumb'=>"0",'title'=>((string)$_smarty_tpl->tpl_vars['alist']->value['keywords']),'pageSize'=>"2")); $_block_repeat=true; echo article(array('action'=>"alist",'return'=>"blist",'thumb'=>"0",'title'=>((string)$_smarty_tpl->tpl_vars['alist']->value['keywords']),'pageSize'=>"2"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

					<li><a href="<?php echo $_smarty_tpl->tpl_vars['blist']->value['url'];?>
" title="<?php echo preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['blist']->value['title']);?>
"><?php echo preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['blist']->value['title']);?>
</a></li>
					<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo article(array('action'=>"alist",'return'=>"blist",'thumb'=>"0",'title'=>((string)$_smarty_tpl->tpl_vars['alist']->value['keywords']),'pageSize'=>"2"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

				</ul>
				<div class="btns fn-clear">
					<a href="<?php echo $_smarty_tpl->tpl_vars['alist']->value['url'];?>
#comment" class="reviewbtn" title="评论数"><?php echo $_smarty_tpl->tpl_vars['alist']->value['common'];?>
</a>
					<a href="javascript:;" class="sharebtn" data-title="<?php echo preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['alist']->value['title']);?>
" data-url="<?php echo $_smarty_tpl->tpl_vars['alist']->value['url'];?>
" data-pic="<?php echo $_smarty_tpl->tpl_vars['alist']->value['litpic'];?>
"></a>
				</div>
			</div>
			<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo article(array('action'=>"alist",'return'=>"alist",'flag'=>"r",'thumb'=>"1",'pageSize'=>"4"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>


			<!-- 文字广告链接 -->
			<div class="txtad">
				<?php echo '<script'; ?>
 src='/include/json.php?action=adjs&id=45' language='javascript'><?php echo '</script'; ?>
>
			</div>

		</div>
		<!-- 头部新闻 e -->

		<!-- 今日关注 s -->
		<div id="jrgz">
			<div class="hdt fn-clear">
				<h4><a href="<?php echo getUrlPath(array('service'=>'article','template'=>'list','typeid'=>"32"),$_smarty_tpl);?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/jrgz.png" alt="今日关注" /></a></h4>
				<span class="more"><a href="<?php echo getUrlPath(array('service'=>'article','template'=>'list','typeid'=>"32"),$_smarty_tpl);?>
">更多</a></span>
			</div>
			<div class="hdc">
				<dl class="fn-clear">
					<dt>
					  <?php $_smarty_tpl->smarty->_tag_stack[] = array('article', array('action'=>"alist",'return'=>"alist",'typeid'=>"32",'flag'=>"h",'thumb'=>"1",'pageSize'=>"1")); $_block_repeat=true; echo article(array('action'=>"alist",'return'=>"alist",'typeid'=>"32",'flag'=>"h",'thumb'=>"1",'pageSize'=>"1"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

						<a class="img" href="<?php echo $_smarty_tpl->tpl_vars['alist']->value['url'];?>
">
							<img src="<?php echo changeFileSize(array('url'=>((string)$_smarty_tpl->tpl_vars['alist']->value['litpic']),'type'=>"middle"),$_smarty_tpl);?>
" alt="<?php echo preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['alist']->value['title']);?>
" />
							<span class="txt"><?php echo $_smarty_tpl->tpl_vars['alist']->value['title'];?>
</span>
							<span class="bg"></span>
						</a>
						<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo article(array('action'=>"alist",'return'=>"alist",'typeid'=>"32",'flag'=>"h",'thumb'=>"1",'pageSize'=>"1"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

					</dt>
					<dd>
						<?php $_smarty_tpl->smarty->_tag_stack[] = array('article', array('action'=>"alist",'return'=>"alist",'typeid'=>"32",'flag'=>"r",'pageSize'=>"1")); $_block_repeat=true; echo article(array('action'=>"alist",'return'=>"alist",'typeid'=>"32",'flag'=>"r",'pageSize'=>"1"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

						<h5><a href="<?php echo $_smarty_tpl->tpl_vars['alist']->value['url'];?>
"><?php echo $_smarty_tpl->tpl_vars['alist']->value['title'];?>
</a></h5>
						<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo article(array('action'=>"alist",'return'=>"alist",'typeid'=>"32",'flag'=>"r",'pageSize'=>"1"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

						<ul>
						  <?php $_smarty_tpl->smarty->_tag_stack[] = array('article', array('action'=>"alist",'return'=>"alist",'typeid'=>"32",'pageSize'=>"5")); $_block_repeat=true; echo article(array('action'=>"alist",'return'=>"alist",'typeid'=>"32",'pageSize'=>"5"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

							<li><a href="<?php echo $_smarty_tpl->tpl_vars['alist']->value['url'];?>
"><?php echo $_smarty_tpl->tpl_vars['alist']->value['title'];?>
</a></li>
							<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo article(array('action'=>"alist",'return'=>"alist",'typeid'=>"32",'pageSize'=>"5"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

						</ul>
					</dd>
				</dl>
				<dl class="fn-clear nob">
					<dt>
						<?php $_smarty_tpl->smarty->_tag_stack[] = array('article', array('action'=>"alist",'return'=>"alist",'typeid'=>"33",'flag'=>"h",'thumb'=>"1",'pageSize'=>"1")); $_block_repeat=true; echo article(array('action'=>"alist",'return'=>"alist",'typeid'=>"33",'flag'=>"h",'thumb'=>"1",'pageSize'=>"1"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

						<a class="img" href="<?php echo $_smarty_tpl->tpl_vars['alist']->value['url'];?>
">
							<img src="<?php echo changeFileSize(array('url'=>((string)$_smarty_tpl->tpl_vars['alist']->value['litpic']),'type'=>"middle"),$_smarty_tpl);?>
" alt="<?php echo preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['alist']->value['title']);?>
" />
							<span class="txt"><?php echo $_smarty_tpl->tpl_vars['alist']->value['title'];?>
</span>
							<span class="bg"></span>
						</a>
						<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo article(array('action'=>"alist",'return'=>"alist",'typeid'=>"33",'flag'=>"h",'thumb'=>"1",'pageSize'=>"1"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

					</dt>
					<dd>
						<?php $_smarty_tpl->smarty->_tag_stack[] = array('article', array('action'=>"alist",'return'=>"alist",'typeid'=>"33",'flag'=>"r",'pageSize'=>"1")); $_block_repeat=true; echo article(array('action'=>"alist",'return'=>"alist",'typeid'=>"33",'flag'=>"r",'pageSize'=>"1"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

						<h5><a href="<?php echo $_smarty_tpl->tpl_vars['alist']->value['url'];?>
"><?php echo $_smarty_tpl->tpl_vars['alist']->value['title'];?>
</a></h5>
						<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo article(array('action'=>"alist",'return'=>"alist",'typeid'=>"33",'flag'=>"r",'pageSize'=>"1"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

						<ul>
							<?php $_smarty_tpl->smarty->_tag_stack[] = array('article', array('action'=>"alist",'return'=>"alist",'typeid'=>"33",'pageSize'=>"5")); $_block_repeat=true; echo article(array('action'=>"alist",'return'=>"alist",'typeid'=>"33",'pageSize'=>"5"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

							<li><a href="<?php echo $_smarty_tpl->tpl_vars['alist']->value['url'];?>
"><?php echo $_smarty_tpl->tpl_vars['alist']->value['title'];?>
</a></li>
							<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo article(array('action'=>"alist",'return'=>"alist",'typeid'=>"33",'pageSize'=>"5"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

						</ul>
					</dd>
				</dl>
			</div>
		</div>
		<!-- 今日关注 e -->

		<!-- 异步新闻 s -->
		<div id="ajaxnews">
			<div class="nht">
				<ul class="fn-clear">
					<?php $_smarty_tpl->smarty->_tag_stack[] = array('article', array('action'=>"type",'return'=>'ajtype','page'=>"1",'pageSize'=>"9")); $_block_repeat=true; echo article(array('action'=>"type",'return'=>'ajtype','page'=>"1",'pageSize'=>"9"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

					<?php if ($_smarty_tpl->tpl_vars['_bindex']->value['ajtype']==1) {?>
					<li class="current"><a href="<?php echo $_smarty_tpl->tpl_vars['ajtype']->value['url'];?>
" data-id="<?php echo $_smarty_tpl->tpl_vars['ajtype']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['ajtype']->value['typename'];?>
</a></li>
					<?php } elseif ($_smarty_tpl->tpl_vars['_bindex']->value['ajtype']==9) {?>
					<li class="last">
						<a href="javascript:;" data-id="">更多<i></i></a>
						<div class="more">
							<a href="<?php echo $_smarty_tpl->tpl_vars['ajtype']->value['url'];?>
" data-id="<?php echo $_smarty_tpl->tpl_vars['ajtype']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['ajtype']->value['typename'];?>
</a>
							<?php $_smarty_tpl->smarty->_tag_stack[] = array('article', array('action'=>"type",'return'=>'ajtype1','page'=>"2",'pageSize'=>"9")); $_block_repeat=true; echo article(array('action'=>"type",'return'=>'ajtype1','page'=>"2",'pageSize'=>"9"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

							<a href="<?php echo $_smarty_tpl->tpl_vars['ajtype1']->value['url'];?>
" data-id="<?php echo $_smarty_tpl->tpl_vars['ajtype1']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['ajtype1']->value['typename'];?>
</a>
							<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo article(array('action'=>"type",'return'=>'ajtype1','page'=>"2",'pageSize'=>"9"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

						</div>
					</li>
					<?php } else { ?>
					<li><a href="<?php echo $_smarty_tpl->tpl_vars['ajtype']->value['url'];?>
" data-id="<?php echo $_smarty_tpl->tpl_vars['ajtype']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['ajtype']->value['typename'];?>
</a></li>
					<?php }?>
					<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo article(array('action'=>"type",'return'=>'ajtype','page'=>"1",'pageSize'=>"9"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

				</ul>
			</div>
			<div class="nhc" id="newsList"></div>
		</div>
		<!-- 异步新闻 e -->

		<div class="ad"><?php echo '<script'; ?>
 src='/include/json.php?action=adjs&id=34' language='javascript'><?php echo '</script'; ?>
></div>

		<!-- 视频新闻 s -->
		<div id="spxw">
			<div class="hdt fn-clear">
				<h4><a href="<?php echo getUrlPath(array('service'=>'article','template'=>'list','typeid'=>"1"),$_smarty_tpl);?>
">视频新闻</a></h4>
				<span class="more"><a href="<?php echo getUrlPath(array('service'=>'article','template'=>'list','typeid'=>"1"),$_smarty_tpl);?>
">更多</a></span>
			</div>
			<div class="hdc">
				<dl class="fn-clear">
					<dt>
					  <?php $_smarty_tpl->smarty->_tag_stack[] = array('article', array('action'=>"alist",'return'=>"alist",'typeid'=>"1",'flag'=>"h",'thumb'=>"1",'pageSize'=>"1")); $_block_repeat=true; echo article(array('action'=>"alist",'return'=>"alist",'typeid'=>"1",'flag'=>"h",'thumb'=>"1",'pageSize'=>"1"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

						<a href="<?php echo $_smarty_tpl->tpl_vars['alist']->value['url'];?>
" class="big">
							<img src="<?php echo changeFileSize(array('url'=>((string)$_smarty_tpl->tpl_vars['alist']->value['litpic']),'type'=>"middle"),$_smarty_tpl);?>
" alt="<?php echo preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['alist']->value['title']);?>
" />
							<span class="txt"><i></i><?php echo $_smarty_tpl->tpl_vars['alist']->value['title'];?>
</span>
							<span class="bg"></span>
						</a>
						<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo article(array('action'=>"alist",'return'=>"alist",'typeid'=>"1",'flag'=>"h",'thumb'=>"1",'pageSize'=>"1"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

						<ul>
						  <?php $_smarty_tpl->smarty->_tag_stack[] = array('article', array('action'=>"alist",'return'=>"alist",'typeid'=>"1",'flag'=>"r",'pageSize'=>"4")); $_block_repeat=true; echo article(array('action'=>"alist",'return'=>"alist",'typeid'=>"1",'flag'=>"r",'pageSize'=>"4"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

							<li><a href="<?php echo $_smarty_tpl->tpl_vars['alist']->value['url'];?>
"><?php echo $_smarty_tpl->tpl_vars['alist']->value['title'];?>
</a></li>
							<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo article(array('action'=>"alist",'return'=>"alist",'typeid'=>"1",'flag'=>"r",'pageSize'=>"4"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

						</ul>
					</dt>
					<dd>
						<ul class="fn-clear">
						  <?php $_smarty_tpl->smarty->_tag_stack[] = array('article', array('action'=>"alist",'return'=>"alist",'typeid'=>"1",'thumb'=>"1",'orderby'=>"2",'pageSize'=>"6")); $_block_repeat=true; echo article(array('action'=>"alist",'return'=>"alist",'typeid'=>"1",'thumb'=>"1",'orderby'=>"2",'pageSize'=>"6"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

							<li><a href="<?php echo $_smarty_tpl->tpl_vars['alist']->value['url'];?>
"><img src="<?php echo changeFileSize(array('url'=>((string)$_smarty_tpl->tpl_vars['alist']->value['litpic']),'type'=>"small"),$_smarty_tpl);?>
" alt="<?php echo preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['alist']->value['title']);?>
" /><span class="txt"><?php echo $_smarty_tpl->tpl_vars['alist']->value['title'];?>
</span><span class="bg"></span></a></li>
							<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo article(array('action'=>"alist",'return'=>"alist",'typeid'=>"1",'thumb'=>"1",'orderby'=>"2",'pageSize'=>"6"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

						</ul>
					</dd>
				</dl>
			</div>
		</div>
		<!-- 视频新闻 e -->

		<!-- 新闻分类 s -->
		<div id="xwfl" class="xwfl">
			<div class="hdt fn-clear">
				<h4><a href="<?php echo getUrlPath(array('service'=>'article','template'=>'list','typeid'=>"10"),$_smarty_tpl);?>
">图片新闻</a></h4>
				<span class="more"><a href="<?php echo getUrlPath(array('service'=>'article','template'=>'list','typeid'=>"10"),$_smarty_tpl);?>
">更多</a></span>
			</div>
			<div class="hdc">
				<dl class="fn-clear">
					<dt>
						<?php $_smarty_tpl->smarty->_tag_stack[] = array('article', array('action'=>"alist",'return'=>"alist",'typeid'=>"10",'flag'=>"h",'thumb'=>"1",'page'=>"1",'pageSize'=>"1")); $_block_repeat=true; echo article(array('action'=>"alist",'return'=>"alist",'typeid'=>"10",'flag'=>"h",'thumb'=>"1",'page'=>"1",'pageSize'=>"1"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

						<div class="big"><a href="<?php echo $_smarty_tpl->tpl_vars['alist']->value['url'];?>
"><img src="<?php echo changeFileSize(array('url'=>((string)$_smarty_tpl->tpl_vars['alist']->value['litpic']),'type'=>"middle"),$_smarty_tpl);?>
" alt="<?php echo preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['alist']->value['title']);?>
" /><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['alist']->value['title'],18);?>
</a></div>
						<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo article(array('action'=>"alist",'return'=>"alist",'typeid'=>"10",'flag'=>"h",'thumb'=>"1",'page'=>"1",'pageSize'=>"1"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

						<ul class="fn-clear">
							<?php $_smarty_tpl->smarty->_tag_stack[] = array('article', array('action'=>"alist",'return'=>"alist",'typeid'=>"10",'flag'=>"r",'pageSize'=>"4")); $_block_repeat=true; echo article(array('action'=>"alist",'return'=>"alist",'typeid'=>"10",'flag'=>"r",'pageSize'=>"4"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

							<li><a href="<?php echo $_smarty_tpl->tpl_vars['alist']->value['url'];?>
"><img src="<?php echo changeFileSize(array('url'=>((string)$_smarty_tpl->tpl_vars['alist']->value['litpic']),'type'=>"small"),$_smarty_tpl);?>
" alt="<?php echo preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['alist']->value['title']);?>
" /><?php echo $_smarty_tpl->tpl_vars['alist']->value['title'];?>
</a></li>
							<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo article(array('action'=>"alist",'return'=>"alist",'typeid'=>"10",'flag'=>"r",'pageSize'=>"4"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

						</ul>
					</dt>
					<dd>
						<ul>
							<?php $_smarty_tpl->smarty->_tag_stack[] = array('article', array('action'=>"alist",'return'=>"alist",'typeid'=>"10",'orderby'=>"2",'page'=>"1",'pageSize'=>"7")); $_block_repeat=true; echo article(array('action'=>"alist",'return'=>"alist",'typeid'=>"10",'orderby'=>"2",'page'=>"1",'pageSize'=>"7"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

							<li><a href="<?php echo $_smarty_tpl->tpl_vars['alist']->value['url'];?>
"><?php echo $_smarty_tpl->tpl_vars['alist']->value['title'];?>
</a><p><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['alist']->value['description'],30);?>
</p></li>
							<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo article(array('action'=>"alist",'return'=>"alist",'typeid'=>"10",'orderby'=>"2",'page'=>"1",'pageSize'=>"7"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

						</ul>
					</dd>
				</dl>
			</div>
		</div>
		<!-- 新闻分类 e -->

		<!-- 新闻分类 s -->
		<div id="xwfl" class="xwfl">
			<div class="hdt fn-clear">
				<h4><a href="<?php echo getUrlPath(array('service'=>'article','template'=>'list','typeid'=>"15"),$_smarty_tpl);?>
">体育新闻</a></h4>
				<span class="more"><a href="<?php echo getUrlPath(array('service'=>'article','template'=>'list','typeid'=>"15"),$_smarty_tpl);?>
">更多</a></span>
			</div>
			<div class="hdc">
				<dl class="fn-clear">
					<dt>
						<?php $_smarty_tpl->smarty->_tag_stack[] = array('article', array('action'=>"alist",'return'=>"alist",'typeid'=>"15",'flag'=>"h",'thumb'=>"1",'pageSize'=>"1")); $_block_repeat=true; echo article(array('action'=>"alist",'return'=>"alist",'typeid'=>"15",'flag'=>"h",'thumb'=>"1",'pageSize'=>"1"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

						<div class="big"><a href="<?php echo $_smarty_tpl->tpl_vars['alist']->value['url'];?>
"><img src="<?php echo changeFileSize(array('url'=>((string)$_smarty_tpl->tpl_vars['alist']->value['litpic']),'type'=>"middle"),$_smarty_tpl);?>
" alt="<?php echo preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['alist']->value['title']);?>
" /><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['alist']->value['title'],18);?>
</a></div>
						<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo article(array('action'=>"alist",'return'=>"alist",'typeid'=>"15",'flag'=>"h",'thumb'=>"1",'pageSize'=>"1"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

						<ul class="fn-clear">
							<?php $_smarty_tpl->smarty->_tag_stack[] = array('article', array('action'=>"alist",'return'=>"alist",'typeid'=>"15",'flag'=>"r",'pageSize'=>"4")); $_block_repeat=true; echo article(array('action'=>"alist",'return'=>"alist",'typeid'=>"15",'flag'=>"r",'pageSize'=>"4"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

							<li><a href="<?php echo $_smarty_tpl->tpl_vars['alist']->value['url'];?>
"><img src="<?php echo changeFileSize(array('url'=>((string)$_smarty_tpl->tpl_vars['alist']->value['litpic']),'type'=>"small"),$_smarty_tpl);?>
" alt="<?php echo preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['alist']->value['title']);?>
" /><?php echo $_smarty_tpl->tpl_vars['alist']->value['title'];?>
</a></li>
							<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo article(array('action'=>"alist",'return'=>"alist",'typeid'=>"15",'flag'=>"r",'pageSize'=>"4"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

						</ul>
					</dt>
					<dd>
						<ul>
							<?php $_smarty_tpl->smarty->_tag_stack[] = array('article', array('action'=>"alist",'return'=>"alist",'typeid'=>"15",'orderby'=>"2",'pageSize'=>"7")); $_block_repeat=true; echo article(array('action'=>"alist",'return'=>"alist",'typeid'=>"15",'orderby'=>"2",'pageSize'=>"7"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

							<li><a href="<?php echo $_smarty_tpl->tpl_vars['alist']->value['url'];?>
"><?php echo $_smarty_tpl->tpl_vars['alist']->value['title'];?>
</a><p><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['alist']->value['description'],30);?>
</p></li>
							<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo article(array('action'=>"alist",'return'=>"alist",'typeid'=>"15",'orderby'=>"2",'pageSize'=>"7"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

						</ul>
					</dd>
				</dl>
			</div>
		</div>
		<!-- 新闻分类 e -->

	</div>
	<div class="wsidebar">
		<!-- 今日话题 s -->
		<div id="jrht">
			<div class="hdt fn-clear">
				<h4><a href="<?php echo getUrlPath(array('service'=>'article','template'=>'list','typeid'=>"31"),$_smarty_tpl);?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/jrhtLogo.png" alt="今日话题" /></a></h4>
			</div>
			<div class="hdc">
				<?php $_smarty_tpl->smarty->_tag_stack[] = array('article', array('action'=>"alist",'return'=>"alist",'typeid'=>"31",'flag'=>"h",'thumb'=>"1",'pageSize'=>"1")); $_block_repeat=true; echo article(array('action'=>"alist",'return'=>"alist",'typeid'=>"31",'flag'=>"h",'thumb'=>"1",'pageSize'=>"1"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

				<h5><a href="<?php echo $_smarty_tpl->tpl_vars['alist']->value['url'];?>
"><?php echo $_smarty_tpl->tpl_vars['alist']->value['title'];?>
</a></h5>
				<dl class="fn-clear">
					<dt><a href="<?php echo $_smarty_tpl->tpl_vars['alist']->value['url'];?>
"><img src="<?php echo changeFileSize(array('url'=>((string)$_smarty_tpl->tpl_vars['alist']->value['litpic']),'type'=>"small"),$_smarty_tpl);?>
"></a></dt>
					<dd><p><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['alist']->value['description'],32);?>
<a href="<?php echo $_smarty_tpl->tpl_vars['alist']->value['url'];?>
">[详细]</a></p></dd>
				</dl>
				<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo article(array('action'=>"alist",'return'=>"alist",'typeid'=>"31",'flag'=>"h",'thumb'=>"1",'pageSize'=>"1"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

				<ul>
					<?php $_smarty_tpl->smarty->_tag_stack[] = array('article', array('action'=>"alist",'return'=>"alist",'typeid'=>"31",'flag'=>"r",'pageSize'=>"4")); $_block_repeat=true; echo article(array('action'=>"alist",'return'=>"alist",'typeid'=>"31",'flag'=>"r",'pageSize'=>"4"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

					<li><a href="<?php echo $_smarty_tpl->tpl_vars['alist']->value['url'];?>
"><?php echo $_smarty_tpl->tpl_vars['alist']->value['title'];?>
</a></li>
					<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo article(array('action'=>"alist",'return'=>"alist",'typeid'=>"31",'flag'=>"r",'pageSize'=>"4"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

				</ul>
			</div>
		</div>
		<!-- 今日话题 e -->

		<!-- 影像力 s -->
		<div id="yxl">
			<div class="hdt fn-clear">
				<h4><a href="<?php echo getUrlPath(array('service'=>'article','template'=>'list','typeid'=>"24"),$_smarty_tpl);?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/yxl.png" alt="影像力" /></a></h4>
				<span class="more"><a href="<?php echo getUrlPath(array('service'=>'article','template'=>'list','typeid'=>"24"),$_smarty_tpl);?>
">更多</a></span>
			</div>
			<div class="hdc">
				<div class="slideshow">
					<div id="slideshow_yxl">
					  <?php $_smarty_tpl->smarty->_tag_stack[] = array('article', array('action'=>"alist",'return'=>"alist",'typeid'=>"24",'flag'=>"r",'pageSize'=>"5")); $_block_repeat=true; echo article(array('action'=>"alist",'return'=>"alist",'typeid'=>"24",'flag'=>"r",'pageSize'=>"5"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

						<a class="slideshow-item" href="<?php echo $_smarty_tpl->tpl_vars['alist']->value['url'];?>
">
							<img src="<?php echo changeFileSize(array('url'=>((string)$_smarty_tpl->tpl_vars['alist']->value['litpic']),'type'=>"middle"),$_smarty_tpl);?>
" alt="<?php echo preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['alist']->value['title']);?>
" />
							<span class="txt"><?php echo $_smarty_tpl->tpl_vars['alist']->value['title'];?>
</span>
						</a>
						<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo article(array('action'=>"alist",'return'=>"alist",'typeid'=>"24",'flag'=>"r",'pageSize'=>"5"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

					</div>
					<div class="slidebtn" id="slidebtn_yxl">
						<a href="javascript:;" class="prev" id="yxl_slidebtn_prev">上一条</a>
						<span class="atpage" id="yxl_atpage">1</span><span class="tpage" id="yxl_tpage">/5</span>
						<a href="javascript:;" class="next" id="yxl_slidebtn_next">下一条</a>
					</div>
				</div>
			</div>
		</div>
		<!-- 影像力 e -->

		<!-- 新闻百科 s -->
		<div id="xwbk">
			<div class="hdt fn-clear">
				<h4><a href="<?php echo getUrlPath(array('service'=>'article','template'=>'list','typeid'=>"34"),$_smarty_tpl);?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/xwbk.png" alt="新闻百科" /></a></h4>
				<span class="more"><a href="<?php echo getUrlPath(array('service'=>'article','template'=>'list','typeid'=>"34"),$_smarty_tpl);?>
">更多</a></span>
			</div>
			<div class="hdc">
				<?php $_smarty_tpl->smarty->_tag_stack[] = array('article', array('action'=>"alist",'return'=>"alist",'typeid'=>"34",'flag'=>"h",'thumb'=>"1",'pageSize'=>"1")); $_block_repeat=true; echo article(array('action'=>"alist",'return'=>"alist",'typeid'=>"34",'flag'=>"h",'thumb'=>"1",'pageSize'=>"1"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

				<h5><a href="<?php echo $_smarty_tpl->tpl_vars['alist']->value['url'];?>
"><?php echo $_smarty_tpl->tpl_vars['alist']->value['title'];?>
</a></h5>
				<dl class="fn-clear">
					<dt><a href="<?php echo $_smarty_tpl->tpl_vars['alist']->value['url'];?>
"><img src="<?php echo changeFileSize(array('url'=>((string)$_smarty_tpl->tpl_vars['alist']->value['litpic']),'type'=>"small"),$_smarty_tpl);?>
"></a></dt>
					<dd><p><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['alist']->value['description'],32);?>
<a href="<?php echo $_smarty_tpl->tpl_vars['alist']->value['url'];?>
">[详细]</a></p></dd>
				</dl>
				<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo article(array('action'=>"alist",'return'=>"alist",'typeid'=>"34",'flag'=>"h",'thumb'=>"1",'pageSize'=>"1"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

				<ul>
					<?php $_smarty_tpl->smarty->_tag_stack[] = array('article', array('action'=>"alist",'return'=>"alist",'typeid'=>"34",'flag'=>"r",'pageSize'=>"4")); $_block_repeat=true; echo article(array('action'=>"alist",'return'=>"alist",'typeid'=>"34",'flag'=>"r",'pageSize'=>"4"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

					<li><a href="<?php echo $_smarty_tpl->tpl_vars['alist']->value['url'];?>
"><?php echo $_smarty_tpl->tpl_vars['alist']->value['title'];?>
</a></li>
					<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo article(array('action'=>"alist",'return'=>"alist",'typeid'=>"34",'flag'=>"r",'pageSize'=>"4"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

				</ul>
			</div>
		</div>
		<!-- 新闻百科 e -->

		<div class="ad"><?php echo '<script'; ?>
 src='/include/json.php?action=adjs&id=35' language='javascript'><?php echo '</script'; ?>
></div>

		<!-- 新闻视频 s -->
		<div id="xwsp">
			<div class="hdt fn-clear">
				<h4><a href="<?php echo getUrlPath(array('service'=>'article','template'=>'list','typeid'=>"2"),$_smarty_tpl);?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/xwsp.png" alt="新闻视频" /></a></h4>
				<span class="more"><a href="<?php echo getUrlPath(array('service'=>'article','template'=>'list','typeid'=>"2"),$_smarty_tpl);?>
">更多</a></span>
			</div>
			<div class="hdc">
				<ul class="vlist fn-clear">
					<?php $_smarty_tpl->smarty->_tag_stack[] = array('article', array('action'=>"alist",'return'=>"alist",'typeid'=>"2",'flag'=>"h",'thumb'=>"1",'pageSize'=>"2")); $_block_repeat=true; echo article(array('action'=>"alist",'return'=>"alist",'typeid'=>"2",'flag'=>"h",'thumb'=>"1",'pageSize'=>"2"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

					<li><a href="<?php echo $_smarty_tpl->tpl_vars['alist']->value['url'];?>
"><img src="<?php echo changeFileSize(array('url'=>((string)$_smarty_tpl->tpl_vars['alist']->value['litpic']),'type'=>"small"),$_smarty_tpl);?>
" /><i></i><p><?php echo $_smarty_tpl->tpl_vars['alist']->value['title'];?>
</p></a></li>
					<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo article(array('action'=>"alist",'return'=>"alist",'typeid'=>"2",'flag'=>"h",'thumb'=>"1",'pageSize'=>"2"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

				</ul>
				<ul class="tlist">
					<?php $_smarty_tpl->smarty->_tag_stack[] = array('article', array('action'=>"alist",'return'=>"alist",'typeid'=>"2",'flag'=>"r",'pageSize'=>"4")); $_block_repeat=true; echo article(array('action'=>"alist",'return'=>"alist",'typeid'=>"2",'flag'=>"r",'pageSize'=>"4"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

					<li><a href="<?php echo $_smarty_tpl->tpl_vars['alist']->value['url'];?>
"><?php echo $_smarty_tpl->tpl_vars['alist']->value['title'];?>
</a></li>
					<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo article(array('action'=>"alist",'return'=>"alist",'typeid'=>"2",'flag'=>"r",'pageSize'=>"4"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

				</ul>
			</div>
		</div>
		<!-- 新闻视频 e -->

		<!-- 热门专题 s -->
		<div id="rmzt">
			<div class="hdt fn-clear">
				<h4><a href="<?php echo getUrlPath(array('service'=>'article','template'=>'list','typeid'=>"3"),$_smarty_tpl);?>
">热门专题</a></h4>
				<span class="more"><a href="<?php echo getUrlPath(array('service'=>'article','template'=>'list','typeid'=>"3"),$_smarty_tpl);?>
">更多</a></span>
			</div>
			<div class="hdc">
			  <div class="slideshow">
					<div id="slideshow_rmzt">
						<?php $_smarty_tpl->smarty->_tag_stack[] = array('article', array('action'=>"alist",'return'=>"alist",'typeid'=>"3",'flag'=>"h",'thumb'=>"1",'pageSize'=>"4")); $_block_repeat=true; echo article(array('action'=>"alist",'return'=>"alist",'typeid'=>"3",'flag'=>"h",'thumb'=>"1",'pageSize'=>"4"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

						<a class="slideshow-item" href="<?php echo $_smarty_tpl->tpl_vars['alist']->value['url'];?>
">
							<img src="<?php echo changeFileSize(array('url'=>((string)$_smarty_tpl->tpl_vars['alist']->value['litpic']),'type'=>"middle"),$_smarty_tpl);?>
" alt="<?php echo preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['alist']->value['title']);?>
" />
							<span class="txt"><?php echo $_smarty_tpl->tpl_vars['alist']->value['title'];?>
</span>
							<span class="bg"></span>
						</a>
						<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo article(array('action'=>"alist",'return'=>"alist",'typeid'=>"3",'flag'=>"h",'thumb'=>"1",'pageSize'=>"4"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

					</div>
					<div class="slidebtn">
						<a href="javascript:;" class="prev" id="rmzt_slidebtn_prev">上一条</a>
						<div id="slidebtn_rmzt"></div>
						<a href="javascript:;" class="next" id="rmzt_slidebtn_next">下一条</a>
					</div>
				</div>
				<ul>
					<?php $_smarty_tpl->smarty->_tag_stack[] = array('article', array('action'=>"alist",'return'=>"alist",'typeid'=>"3",'flag'=>"r",'pageSize'=>"5")); $_block_repeat=true; echo article(array('action'=>"alist",'return'=>"alist",'typeid'=>"3",'flag'=>"r",'pageSize'=>"5"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

					<li><a href="<?php echo $_smarty_tpl->tpl_vars['alist']->value['url'];?>
"><?php echo $_smarty_tpl->tpl_vars['alist']->value['title'];?>
</a></li>
					<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo article(array('action'=>"alist",'return'=>"alist",'typeid'=>"3",'flag'=>"r",'pageSize'=>"5"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

				</ul>
			</div>
		</div>
		<!-- 热门专题 e -->

		<!-- 新闻热评 s -->
		<div id="xwrp">
			<div class="hdt fn-clear">
				<h4><a href="<?php echo getUrlPath(array('service'=>'article','template'=>'list','typeid'=>"4"),$_smarty_tpl);?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/xwrp.png" alt="新闻热评" /></a></h4>
				<span class="more"><a href="<?php echo getUrlPath(array('service'=>'article','template'=>'list','typeid'=>"4"),$_smarty_tpl);?>
">更多</a></span>
			</div>
			<div class="hdc">
				<ul class="vlist fn-clear">
					<?php $_smarty_tpl->smarty->_tag_stack[] = array('article', array('action'=>"alist",'return'=>"alist",'typeid'=>"4",'flag'=>"h",'thumb'=>"1",'pageSize'=>"2")); $_block_repeat=true; echo article(array('action'=>"alist",'return'=>"alist",'typeid'=>"4",'flag'=>"h",'thumb'=>"1",'pageSize'=>"2"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

					<li><a href="<?php echo $_smarty_tpl->tpl_vars['alist']->value['url'];?>
"><img src="<?php echo changeFileSize(array('url'=>((string)$_smarty_tpl->tpl_vars['alist']->value['litpic']),'type'=>"small"),$_smarty_tpl);?>
" /><p><?php echo $_smarty_tpl->tpl_vars['alist']->value['title'];?>
</p></a></li>
					<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo article(array('action'=>"alist",'return'=>"alist",'typeid'=>"4",'flag'=>"h",'thumb'=>"1",'pageSize'=>"2"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

				</ul>
				<ul class="tlist">
					<?php $_smarty_tpl->smarty->_tag_stack[] = array('article', array('action'=>"alist",'return'=>"alist",'typeid'=>"3",'flag'=>"r",'pageSize'=>"5")); $_block_repeat=true; echo article(array('action'=>"alist",'return'=>"alist",'typeid'=>"3",'flag'=>"r",'pageSize'=>"5"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

					<li><a href="<?php echo $_smarty_tpl->tpl_vars['alist']->value['url'];?>
"><?php echo $_smarty_tpl->tpl_vars['alist']->value['title'];?>
</a></li>
					<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo article(array('action'=>"alist",'return'=>"alist",'typeid'=>"3",'flag'=>"r",'pageSize'=>"5"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

				</ul>
			</div>
		</div>
		<!-- 新闻热评 e -->

		<!-- 热度、评论排行 s -->
		<div id="dragMark">
			<div class="hdt fn-clear">
				<p></p>
				<ul class="fn-clear">
					<li class="current"><a href="javascript:;"><i></i>热度排行</a></li>
					<li><a href="javascript:;"><i></i>评论排行</a></li>
				</ul>
			</div>
			<div class="hdc fn-clear">
				<ol>
					<?php $_smarty_tpl->smarty->_tag_stack[] = array('article', array('action'=>"alist",'return'=>"hlist",'orderby'=>"2",'pageSize'=>"10")); $_block_repeat=true; echo article(array('action'=>"alist",'return'=>"hlist",'orderby'=>"2",'pageSize'=>"10"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

					<li><i<?php if ($_smarty_tpl->tpl_vars['_bindex']->value['hlist']<4) {?> class="top"<?php }?>><?php echo $_smarty_tpl->tpl_vars['_bindex']->value['hlist'];?>
</i><a href="<?php echo $_smarty_tpl->tpl_vars['hlist']->value['url'];?>
"><?php echo $_smarty_tpl->tpl_vars['hlist']->value['title'];?>
</a></li>
					<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo article(array('action'=>"alist",'return'=>"hlist",'orderby'=>"2",'pageSize'=>"10"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

				</ol>
				<ol class="fn-hide">
					<?php $_smarty_tpl->smarty->_tag_stack[] = array('article', array('action'=>"alist",'return'=>"clist",'orderby'=>"4",'pageSize'=>"10")); $_block_repeat=true; echo article(array('action'=>"alist",'return'=>"clist",'orderby'=>"4",'pageSize'=>"10"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

					<li><i<?php if ($_smarty_tpl->tpl_vars['_bindex']->value['clist']<4) {?> class="top"<?php }?>><?php echo $_smarty_tpl->tpl_vars['_bindex']->value['clist'];?>
</i><a href="<?php echo $_smarty_tpl->tpl_vars['clist']->value['url'];?>
"><?php echo $_smarty_tpl->tpl_vars['clist']->value['title'];?>
</a></li>
					<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo article(array('action'=>"alist",'return'=>"clist",'orderby'=>"4",'pageSize'=>"10"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

				</ol>
			</div>
		</div>
		<!-- 热度、评论排行 e -->

		<div class="ad"><?php echo '<script'; ?>
 src='/include/json.php?action=adjs&id=36' language='javascript'><?php echo '</script'; ?>
></div>

		<!-- 新闻排行 s -->
		<div id="xwph">
			<div class="hdt fn-clear">
				<h4><a href="javascript:;">新闻排行</a></h4>
				<ul class="fn-clear">
					<li class="current">今天</li>
					<li>昨日</li>
					<li>一周</li>
				</ul>
			</div>
			<div class="hdc">
				<div id="xwph0">
					<ul class="vlist fn-clear">
						<?php $_smarty_tpl->smarty->_tag_stack[] = array('article', array('action'=>"alist",'return'=>"alist",'orderby'=>"2.1",'flag'=>"r",'thumb'=>"1",'pageSize'=>"2")); $_block_repeat=true; echo article(array('action'=>"alist",'return'=>"alist",'orderby'=>"2.1",'flag'=>"r",'thumb'=>"1",'pageSize'=>"2"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

						<li><a href="<?php echo $_smarty_tpl->tpl_vars['alist']->value['url'];?>
"><img src="<?php echo changeFileSize(array('url'=>((string)$_smarty_tpl->tpl_vars['alist']->value['litpic']),'type'=>"small"),$_smarty_tpl);?>
" /><p><?php echo $_smarty_tpl->tpl_vars['alist']->value['title'];?>
</p></a></li>
						<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo article(array('action'=>"alist",'return'=>"alist",'orderby'=>"2.1",'flag'=>"r",'thumb'=>"1",'pageSize'=>"2"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

					</ul>
					<ul class="tlist">
						<?php $_smarty_tpl->smarty->_tag_stack[] = array('article', array('action'=>"alist",'return'=>"alist",'orderby'=>"2.1",'pageSize'=>"5")); $_block_repeat=true; echo article(array('action'=>"alist",'return'=>"alist",'orderby'=>"2.1",'pageSize'=>"5"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

						<li><a href="<?php echo $_smarty_tpl->tpl_vars['alist']->value['url'];?>
"><?php echo $_smarty_tpl->tpl_vars['alist']->value['title'];?>
</a></li>
						<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo article(array('action'=>"alist",'return'=>"alist",'orderby'=>"2.1",'pageSize'=>"5"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

					</ul>
				</div>
				<div id="xwph1" class="fn-hide">
					<ul class="vlist fn-clear">
						<?php $_smarty_tpl->smarty->_tag_stack[] = array('article', array('action'=>"alist",'return'=>"alist",'orderby'=>"2.2",'flag'=>"r",'thumb'=>"1",'pageSize'=>"2")); $_block_repeat=true; echo article(array('action'=>"alist",'return'=>"alist",'orderby'=>"2.2",'flag'=>"r",'thumb'=>"1",'pageSize'=>"2"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

						<li><a href="<?php echo $_smarty_tpl->tpl_vars['alist']->value['url'];?>
"><img src="<?php echo changeFileSize(array('url'=>((string)$_smarty_tpl->tpl_vars['alist']->value['litpic']),'type'=>"small"),$_smarty_tpl);?>
" /><p><?php echo $_smarty_tpl->tpl_vars['alist']->value['title'];?>
</p></a></li>
						<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo article(array('action'=>"alist",'return'=>"alist",'orderby'=>"2.2",'flag'=>"r",'thumb'=>"1",'pageSize'=>"2"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

					</ul>
					<ul class="tlist">
						<?php $_smarty_tpl->smarty->_tag_stack[] = array('article', array('action'=>"alist",'return'=>"alist",'orderby'=>"2.2",'pageSize'=>"5")); $_block_repeat=true; echo article(array('action'=>"alist",'return'=>"alist",'orderby'=>"2.2",'pageSize'=>"5"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

						<li><a href="<?php echo $_smarty_tpl->tpl_vars['alist']->value['url'];?>
"><?php echo $_smarty_tpl->tpl_vars['alist']->value['title'];?>
</a></li>
						<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo article(array('action'=>"alist",'return'=>"alist",'orderby'=>"2.2",'pageSize'=>"5"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

					</ul>
				</div>
				<div id="xwph2" class="fn-hide">
					<ul class="vlist fn-clear">
						<?php $_smarty_tpl->smarty->_tag_stack[] = array('article', array('action'=>"alist",'return'=>"alist",'orderby'=>"2.3",'flag'=>"r",'thumb'=>"1",'pageSize'=>"2")); $_block_repeat=true; echo article(array('action'=>"alist",'return'=>"alist",'orderby'=>"2.3",'flag'=>"r",'thumb'=>"1",'pageSize'=>"2"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

						<li><a href="<?php echo $_smarty_tpl->tpl_vars['alist']->value['url'];?>
"><img src="<?php echo changeFileSize(array('url'=>((string)$_smarty_tpl->tpl_vars['alist']->value['litpic']),'type'=>"small"),$_smarty_tpl);?>
" /><p><?php echo $_smarty_tpl->tpl_vars['alist']->value['title'];?>
</p></a></li>
						<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo article(array('action'=>"alist",'return'=>"alist",'orderby'=>"2.3",'flag'=>"r",'thumb'=>"1",'pageSize'=>"2"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

					</ul>
					<ul class="tlist">
						<?php $_smarty_tpl->smarty->_tag_stack[] = array('article', array('action'=>"alist",'return'=>"alist",'orderby'=>"2.3",'pageSize'=>"5")); $_block_repeat=true; echo article(array('action'=>"alist",'return'=>"alist",'orderby'=>"2.3",'pageSize'=>"5"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

						<li><a href="<?php echo $_smarty_tpl->tpl_vars['alist']->value['url'];?>
"><?php echo $_smarty_tpl->tpl_vars['alist']->value['title'];?>
</a></li>
						<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo article(array('action'=>"alist",'return'=>"alist",'orderby'=>"2.3",'pageSize'=>"5"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

					</ul>
				</div>
			</div>
		</div>
		<!-- 新闻排行 e -->
	</div>
</div>

<!-- 图说天下 s -->
<div class="wrap" id="tstx">
	<div class="hdt fn-clear">
		<h4><a href="<?php echo getUrlPath(array('service'=>'article','template'=>'list','typeid'=>"10"),$_smarty_tpl);?>
">图说天下</a></h4>
		<span class="more"><a href="<?php echo getUrlPath(array('service'=>'article','template'=>'list','typeid'=>"10"),$_smarty_tpl);?>
">更多</a></span>
		<div id="slidebtn_tstx" class="slidebtn"></div>
	</div>
	<div class="hdc" id="slideshow_tstx">
		<ul class="fn-clear">
			<?php $_smarty_tpl->smarty->_tag_stack[] = array('article', array('action'=>"alist",'return'=>"list1",'typeid'=>"10",'thumb'=>"1",'orderby'=>"2",'pageSize'=>"13")); $_block_repeat=true; echo article(array('action'=>"alist",'return'=>"list1",'typeid'=>"10",'thumb'=>"1",'orderby'=>"2",'pageSize'=>"13"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

			<li class="a<?php echo $_smarty_tpl->tpl_vars['_bindex']->value['list1'];?>
"><a href="<?php echo $_smarty_tpl->tpl_vars['list1']->value['url'];?>
"><img src="<?php echo changeFileSize(array('url'=>((string)$_smarty_tpl->tpl_vars['list1']->value['litpic']),'type'=>"middle"),$_smarty_tpl);?>
"><div class="txt"><?php echo preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['list1']->value['title']);?>
</div></a></li>
			<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo article(array('action'=>"alist",'return'=>"list1",'typeid'=>"10",'thumb'=>"1",'orderby'=>"2",'pageSize'=>"13"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

		</ul>
		<ul class="fn-clear">
			<?php $_smarty_tpl->smarty->_tag_stack[] = array('article', array('action'=>"alist",'return'=>"list2",'typeid'=>"15",'thumb'=>"1",'orderby'=>"2",'pageSize'=>"13")); $_block_repeat=true; echo article(array('action'=>"alist",'return'=>"list2",'typeid'=>"15",'thumb'=>"1",'orderby'=>"2",'pageSize'=>"13"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

			<li class="a<?php echo $_smarty_tpl->tpl_vars['_bindex']->value['list2'];?>
"><a href="<?php echo $_smarty_tpl->tpl_vars['list2']->value['url'];?>
" target="_blank"><img src="<?php echo changeFileSize(array('url'=>((string)$_smarty_tpl->tpl_vars['list2']->value['litpic']),'type'=>"middle"),$_smarty_tpl);?>
"><div class="txt"><?php echo preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['list2']->value['title']);?>
</div></a></li>
			<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo article(array('action'=>"alist",'return'=>"list2",'typeid'=>"15",'thumb'=>"1",'orderby'=>"2",'pageSize'=>"13"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

		</ul>
	</div>
</div>
<!-- 图说天下 e -->

<!-- 对联广告 s-->
<?php echo '<script'; ?>
 src='/include/json.php?action=adjs&id=43' language='javascript'><?php echo '</script'; ?>
>

<?php echo $_smarty_tpl->getSubTemplate ("footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
js/ui/jquery.cycle.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
js/index.js"><?php echo '</script'; ?>
>
</body>
</html>
<?php }} ?>
