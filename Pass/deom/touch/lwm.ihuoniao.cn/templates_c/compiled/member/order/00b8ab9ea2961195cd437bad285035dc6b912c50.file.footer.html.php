<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-05-23 17:13:33
         compiled from "D:\ServerWwwroot\www.lwm.com\templates\member\footer.html" */ ?>
<?php /*%%SmartyHeaderCode:198895923fd3d137065-00197745%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '00b8ab9ea2961195cd437bad285035dc6b912c50' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\templates\\member\\footer.html',
      1 => 1494490894,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '198895923fd3d137065-00197745',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'cfg_shortname' => 0,
    'cfg_basehost' => 0,
    'cfg_staticPath' => 0,
    'templets_skin' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5923fd3d142be8_95148580',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5923fd3d142be8_95148580')) {function content_5923fd3d142be8_95148580($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'D:\\ServerWwwroot\\www.lwm.com\\include\\tpl\\plugins\\modifier.date_format.php';
if (!is_callable('smarty_modifier_replace')) include 'D:\\ServerWwwroot\\www.lwm.com\\include\\tpl\\plugins\\modifier.replace.php';
?><div class="wrap footer">
	<p><a href="#" target="_blank">关于<?php echo $_smarty_tpl->tpl_vars['cfg_shortname']->value;?>
</a>  |  <a href="#" target="_blank">服务条款</a>  |  <a href="#" target="_blank">广告服务</a>  |  <a href="#" target="_blank">联系客服</a></p>
	<p>Copyright &copy; <?php echo smarty_modifier_date_format(time(),"%Y");?>
 <a href="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
" target="_blank"><?php echo smarty_modifier_replace($_smarty_tpl->tpl_vars['cfg_basehost']->value,"http://",'');?>
</a>  版权所有</p>
</div>

<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
js/common.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
js/ui/jquery.dialog-4.2.0.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
js/ui/jquery.SuperSlide.2.1.1.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
js/public.js"><?php echo '</script'; ?>
>
<?php }} ?>
