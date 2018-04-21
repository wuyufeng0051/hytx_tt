<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-05-15 08:54:27
         compiled from "D:\ServerWwwroot\www.lwm.com\templates\siteConfig\footer1.html" */ ?>
<?php /*%%SmartyHeaderCode:236095918fc433d57f3-52239071%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f32f380bd07454bfe217807b1772c90feda5c3a6' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\templates\\siteConfig\\footer1.html',
      1 => 1494490711,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '236095918fc433d57f3-52239071',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'row' => 0,
    'type' => 0,
    'type1' => 0,
    'cfg_powerby' => 0,
    'cfg_statisticscode' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5918fc43489311_81335299',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5918fc43489311_81335299')) {function content_5918fc43489311_81335299($_smarty_tpl) {?><!-- 底部 s -->
<div class="footer">
	<div class="wrap">
		<div class="about">
			<div class="links">
				<dl>
					<dt>关于我们<s></s></dt>
					<?php $_smarty_tpl->smarty->_tag_stack[] = array('siteConfig', array('action'=>"singel",'pageSize'=>"5")); $_block_repeat=true; echo siteConfig(array('action'=>"singel",'pageSize'=>"5"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

					<dd><a href="<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['row']->value['id'];?>
<?php $_tmp5=ob_get_clean();?><?php echo getUrlPath(array('service'=>'siteConfig','template'=>'about','id'=>$_tmp5),$_smarty_tpl);?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['row']->value['title'];?>
</a></dd>
					<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo siteConfig(array('action'=>"singel",'pageSize'=>"5"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

				</dl>
				<?php $_smarty_tpl->smarty->_tag_stack[] = array('siteConfig', array('action'=>'helpsType','return'=>'type','pageSize'=>"5")); $_block_repeat=true; echo siteConfig(array('action'=>'helpsType','return'=>'type','pageSize'=>"5"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

				<dl>
					<dt><?php echo $_smarty_tpl->tpl_vars['type']->value['typename'];?>
<s></s></dt>
					<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['type']->value['id'];?>
<?php $_tmp6=ob_get_clean();?><?php $_smarty_tpl->smarty->_tag_stack[] = array('siteConfig', array('action'=>'helpsType','type'=>$_tmp6,'return'=>'type1','pageSize'=>"5")); $_block_repeat=true; echo siteConfig(array('action'=>'helpsType','type'=>$_tmp6,'return'=>'type1','pageSize'=>"5"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

					<dd><a href="<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['type1']->value['id'];?>
<?php $_tmp7=ob_get_clean();?><?php echo getUrlPath(array('service'=>'siteConfig','template'=>'help','id'=>$_tmp7),$_smarty_tpl);?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['type1']->value['typename'];?>
</a></dd>
					<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo siteConfig(array('action'=>'helpsType','type'=>$_tmp6,'return'=>'type1','pageSize'=>"5"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

				</dl>
				<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo siteConfig(array('action'=>'helpsType','return'=>'type','pageSize'=>"5"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

			</div>
		</div>
		<div class="frinedlink">
			<div class="links">
				<div class="box fn-clear">
					<?php echo $_smarty_tpl->tpl_vars['cfg_powerby']->value;?>

        		</div>
			</div>
		</div>
	</div>
</div>
<!-- 底部 e -->
<?php echo $_smarty_tpl->tpl_vars['cfg_statisticscode']->value;?>

<?php }} ?>
