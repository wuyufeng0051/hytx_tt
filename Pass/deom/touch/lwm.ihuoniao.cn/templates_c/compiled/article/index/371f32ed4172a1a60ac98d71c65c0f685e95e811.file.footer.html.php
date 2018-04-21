<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-06-22 10:46:52
         compiled from "D:\ServerWwwroot\www.lwm.com\templates\article\default\footer.html" */ ?>
<?php /*%%SmartyHeaderCode:19806594b2f9c23d217-68739215%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '371f32ed4172a1a60ac98d71c65c0f685e95e811' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\templates\\article\\default\\footer.html',
      1 => 1494491182,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19806594b2f9c23d217-68739215',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'flink' => 0,
    'row' => 0,
    'cfg_powerby' => 0,
    'cfg_statisticscode' => 0,
    'cfg_staticPath' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_594b2f9c27ba26_88790091',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_594b2f9c27ba26_88790091')) {function content_594b2f9c27ba26_88790091($_smarty_tpl) {?><!-- 合作媒体 s -->
<div class="wrap">
	<div class="hzmt">
		<h4><span>合作媒体</span></h4>
		<p><?php $_smarty_tpl->smarty->_tag_stack[] = array('siteConfig', array('action'=>"friendLink",'return'=>"flink",'module'=>"article")); $_block_repeat=true; echo siteConfig(array('action'=>"friendLink",'return'=>"flink",'module'=>"article"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<a href="<?php echo $_smarty_tpl->tpl_vars['flink']->value['sitelink'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['flink']->value['sitename'];?>
</a> | <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo siteConfig(array('action'=>"friendLink",'return'=>"flink",'module'=>"article"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</p>
	</div>
</div>
<!-- 合作媒体 e -->

<!-- 版权 s -->
<div class="wrap copyright">
  <p>
		<?php $_smarty_tpl->smarty->_tag_stack[] = array('siteConfig', array('action'=>"singel")); $_block_repeat=true; echo siteConfig(array('action'=>"singel"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

		<a href="<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['row']->value['id'];?>
<?php $_tmp1=ob_get_clean();?><?php echo getUrlPath(array('service'=>'siteConfig','template'=>'about','id'=>$_tmp1),$_smarty_tpl);?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['row']->value['title'];?>
</a> |
		<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo siteConfig(array('action'=>"singel"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

		<a href="<?php echo getUrlPath(array('service'=>'siteConfig','template'=>'help'),$_smarty_tpl);?>
" target="_blank">帮助中心</a>
	</p>
	<?php echo $_smarty_tpl->tpl_vars['cfg_powerby']->value;?>

</div>
<!-- 版权 e -->

<div class="btntop">
  <a href="javascript:;" class="top" title="返回顶部">返回顶部</a>
  <a href="javascript:;" class="close" title="关闭">关闭</a>
</div>

<?php echo $_smarty_tpl->tpl_vars['cfg_statisticscode']->value;?>

<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
js/common.js"><?php echo '</script'; ?>
>
<?php }} ?>
