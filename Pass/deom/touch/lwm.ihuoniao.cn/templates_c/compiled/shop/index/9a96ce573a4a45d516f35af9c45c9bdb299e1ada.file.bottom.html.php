<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-06-27 18:41:05
         compiled from "D:\ServerWwwroot\www.lwm.com\templates\shop\default\bottom.html" */ ?>
<?php /*%%SmartyHeaderCode:13367595236414824b9-15084698%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9a96ce573a4a45d516f35af9c45c9bdb299e1ada' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\templates\\shop\\default\\bottom.html',
      1 => 1494490888,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13367595236414824b9-15084698',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'row' => 0,
    'cfg_powerby' => 0,
    'cfg_statisticscode' => 0,
    'cfg_staticPath' => 0,
    'templets_skin' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_595236414d83c7_09462749',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_595236414d83c7_09462749')) {function content_595236414d83c7_09462749($_smarty_tpl) {?><div class="copyright">
	<div class="wrap">
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
</div>

<div class="btntop">
  <a href="javascript:;" class="top" title="返回顶部">返回顶部</a>
  <a href="javascript:;" class="close" title="关闭">关闭</a>
</div>

<?php echo $_smarty_tpl->tpl_vars['cfg_statisticscode']->value;?>

<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
js/common.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
js/ui/jquery.scroll.loading.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
js/public.js?v=1"><?php echo '</script'; ?>
>
<?php }} ?>
