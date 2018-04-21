<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-06-28 18:18:11
         compiled from "D:\wwwroot\deom\touch\lwm.ihuoniao.cn\templates\siteConfig\footer1.html" */ ?>
<?php /*%%SmartyHeaderCode:16695595382638e7f23-03130254%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ffc8ff8c23f7e2c6f6e26d632fa90f52fa6ec44d' => 
    array (
      0 => 'D:\\wwwroot\\deom\\touch\\lwm.ihuoniao.cn\\templates\\siteConfig\\footer1.html',
      1 => 1494490711,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '16695595382638e7f23-03130254',
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
  'unifunc' => 'content_59538263941cb9_85442065',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59538263941cb9_85442065')) {function content_59538263941cb9_85442065($_smarty_tpl) {?><!-- 底部 s -->
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
