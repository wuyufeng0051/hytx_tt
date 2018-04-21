<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-06-28 18:18:04
         compiled from "D:\wwwroot\deom\touch\lwm.ihuoniao.cn\templates\siteConfig\public_top_v1.html" */ ?>
<?php /*%%SmartyHeaderCode:163645953825cb1cd27-38165245%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '42bfaa9d43e84018870877490658f3309e3f403b' => 
    array (
      0 => 'D:\\wwwroot\\deom\\touch\\lwm.ihuoniao.cn\\templates\\siteConfig\\public_top_v1.html',
      1 => 1494490712,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '163645953825cb1cd27-38165245',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'HUONIAOROOT' => 0,
    'cfg_basehost' => 0,
    'cfg_webname' => 0,
    'cfg_weblogo' => 0,
    'cfg_shortname' => 0,
    'keywords' => 0,
    '_bindex' => 0,
    'hotkeywords' => 0,
    'installModuleArr' => 0,
    'article_channelDomain' => 0,
    'atype' => 0,
    'info_channelDomain' => 0,
    'tuan_channelDomain' => 0,
    'house_channelDomain' => 0,
    'job_channelDomain' => 0,
    'renovation_channelDomain' => 0,
    'build_channelDomain' => 0,
    'home_channelDomain' => 0,
    'furniture_channelDomain' => 0,
    'marry_channelDomain' => 0,
    'dating_channelDomain' => 0,
    'tieba_channelDomain' => 0,
    'business_channelDomain' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5953825cb53831_77905821',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5953825cb53831_77905821')) {function content_5953825cb53831_77905821($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['HUONIAOROOT']->value)."/templates/siteConfig/top1.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<!-- 导航 s -->
<div class="fixedwrap">
	<div class="fixedpane">
		<!-- head s -->
		<div class="wrap header fn-clear">
			<div class="logo">
				<a href="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
" title="<?php echo $_smarty_tpl->tpl_vars['cfg_webname']->value;?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['cfg_weblogo']->value;?>
" alt="<?php echo $_smarty_tpl->tpl_vars['cfg_webname']->value;?>
"><h2><?php echo $_smarty_tpl->tpl_vars['cfg_shortname']->value;?>
</h2></a>
			</div>
			<div class="kefu"><?php echo '<script'; ?>
 src="/include/json.php?action=adjs&id=156" language="javascript"><?php echo '</script'; ?>
></div>
			<div class="searchwrap">
				<div class="search">
					<form action="<?php echo getUrlPath(array('service'=>'business','template'=>'list'),$_smarty_tpl);?>
">
						<div class="type">
							<dl>
								<dt><a href="javascript:;" class="keytype">商家</a><em></em></dt>
								<dd>
									<a href="javascript:;" class="active curr">商家</a>
									<a href="javascript:;">店铺</a>
								</dd>
							</dl>
						</div>
						<div class="inputbox">
							<div class="inpbox"><input name="keywords" type="text" class="searchkey" value="<?php echo $_smarty_tpl->tpl_vars['keywords']->value;?>
" /></div>
							<div class="hotkey">
								<?php $_smarty_tpl->smarty->_tag_stack[] = array('siteConfig', array('module'=>"index",'action'=>"hotkeywords",'return'=>"hotkeywords")); $_block_repeat=true; echo siteConfig(array('module'=>"index",'action'=>"hotkeywords",'return'=>"hotkeywords"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

								<?php if ($_smarty_tpl->tpl_vars['_bindex']->value['hotkeywords']<=3) {?>
								<a href="<?php echo $_smarty_tpl->tpl_vars['hotkeywords']->value['href'];?>
"<?php if ($_smarty_tpl->tpl_vars['hotkeywords']->value['target']==0) {?> target="_blank"<?php }?>><?php echo $_smarty_tpl->tpl_vars['hotkeywords']->value['keyword'];?>
</a>
								<?php }?>
								<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo siteConfig(array('module'=>"index",'action'=>"hotkeywords",'return'=>"hotkeywords"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

							</div>
						</div>
						<input type="submit" class="submit" value="搜索">
					</form>
				</div>
			</div>
		</div>
		<!-- head e -->

		<!-- 导航 s -->
		<div class="nav">
			<div class="wrap">
				<ul class="mainnav fn-clear">
					<li><a href="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
" class="nav-m">首页</a></li>
					<?php if (in_array("article",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?>
					<li class="dropdown">
						<div class="dropbox">
							<dl>
								<dt><a href="<?php echo $_smarty_tpl->tpl_vars['article_channelDomain']->value;?>
" class="nav-m" target="_blank">新闻资讯</a><i class="picon picon-down2"></i></dt>
								<dd>
									<?php $_smarty_tpl->smarty->_tag_stack[] = array('article', array('action'=>"type",'return'=>"atype",'pageSize'=>"5")); $_block_repeat=true; echo article(array('action'=>"type",'return'=>"atype",'pageSize'=>"5"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

									<a href="<?php echo $_smarty_tpl->tpl_vars['atype']->value['url'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['atype']->value['typename'];?>
</a>
									<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo article(array('action'=>"type",'return'=>"atype",'pageSize'=>"5"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

								</dd>
							</dl>
						</div>
					</li>
					<?php }?>
					<?php if (in_array("info",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?><li><a href="<?php echo $_smarty_tpl->tpl_vars['info_channelDomain']->value;?>
" class="nav-m" target="_blank">跳蚤市场</a></li><?php }?>
					<?php if (in_array("tuan",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?><li><a href="<?php echo $_smarty_tpl->tpl_vars['tuan_channelDomain']->value;?>
" class="nav-m" target="_blank">团购秒杀<i class="picon picon-hui"></i></a></li><?php }?>
					<?php if (in_array("house",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?>
					<li class="dropdown">
						<div class="dropbox">
							<dl>
								<dt><a href="<?php echo $_smarty_tpl->tpl_vars['house_channelDomain']->value;?>
" class="nav-m" target="_blank">房屋租售</a><i class="picon picon-down2"></i></dt>
								<dd>
									<a href="<?php echo getUrlPath(array('service'=>'house','template'=>'zu'),$_smarty_tpl);?>
" target="_blank">找出租房</a>
									<a href="<?php echo getUrlPath(array('service'=>'house','template'=>'sale'),$_smarty_tpl);?>
" target="_blank">找出售房</a>
									<a href="<?php echo getUrlPath(array('service'=>'house','template'=>'map','action'=>'loupan'),$_smarty_tpl);?>
" target="_blank">地图找房</a>
									<a href="<?php echo getUrlPath(array('service'=>'house','template'=>'loupan','param'=>'from=subway'),$_smarty_tpl);?>
" target="_blank">地铁找房</a>
								</dd>
							</dl>
						</div>
					</li>
					<?php }?>
					<?php if (in_array("job",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?>
					<li class="dropdown">
						<div class="dropbox">
							<dl>
								<dt><a href="<?php echo $_smarty_tpl->tpl_vars['job_channelDomain']->value;?>
" class="nav-m" target="_blank">招聘求职</a><i class="picon picon-down2"></i></dt>
								<dd>
									<a href="<?php echo getUrlPath(array('service'=>'job','template'=>'zhaopin'),$_smarty_tpl);?>
" target="_blank">最新职位</a>
									<a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'job','action'=>'resume'),$_smarty_tpl);?>
" target="_blank">我要找工作</a>
									<a href="<?php echo getUrlPath(array('service'=>'job','template'=>'company'),$_smarty_tpl);?>
" target="_blank">企业招聘</a>
									<a href="<?php echo getUrlPath(array('service'=>'job','template'=>'resume'),$_smarty_tpl);?>
" target="_blank">最新简历</a>
								</dd>
							</dl>
						</div>
					</li>
					<?php }?>
					<?php if (in_array("renovation",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?>
					<li class="dropdown">
						<div class="dropbox">
							<dl>
								<dt><a href="<?php echo $_smarty_tpl->tpl_vars['renovation_channelDomain']->value;?>
" class="nav-m" target="_blank">装修市场</a><i class="picon picon-down2"></i></dt>
								<dd>
									<a href="<?php echo $_smarty_tpl->tpl_vars['build_channelDomain']->value;?>
" target="_blank">建材商城</a>
									<a href="<?php echo $_smarty_tpl->tpl_vars['home_channelDomain']->value;?>
" target="_blank">家居商城</a>
									<a href="<?php echo getUrlPath(array('service'=>'renovation','template'=>'zb'),$_smarty_tpl);?>
" target="_blank">装修招标</a>
									<a href="<?php echo $_smarty_tpl->tpl_vars['furniture_channelDomain']->value;?>
" target="_blank">家具商城</a>
								</dd>
							</dl>
						</div>
					</li>
					<?php }?>
					<?php if (in_array("marry",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?><li><a href="<?php echo $_smarty_tpl->tpl_vars['marry_channelDomain']->value;?>
" class="nav-m" target="_blank">婚嫁<i class="picon picon-join"></i></a></li><?php }?>
					<?php if (in_array("dating",$_smarty_tpl->tpl_vars['installModuleArr']->value)) {?><li><a href="<?php echo $_smarty_tpl->tpl_vars['dating_channelDomain']->value;?>
" class="nav-m" target="_blank">交友</a></li><?php }?>
					<li><a href="<?php echo $_smarty_tpl->tpl_vars['tieba_channelDomain']->value;?>
" class="nav-m" target="_blank">贴吧社区</a></li>
                  	<li><a href="<?php echo $_smarty_tpl->tpl_vars['business_channelDomain']->value;?>
" class="nav-m" target="_blank">商家<i class="picon picon-latest"></i></a></li>
				</ul>
				<div class="changeSkin" title="点击切换导航颜色"></div>
			</div>
		</div>
	</div>
</div>
<!-- 导航 e -->
<?php }} ?>
