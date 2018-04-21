<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-06-22 15:06:03
         compiled from "D:\ServerWwwroot\www.lwm.com\wmsj\templates\_footer.html" */ ?>
<?php /*%%SmartyHeaderCode:4327594b6c5b377783-11007162%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7850fbe59197370dfce205759cec017070327ae6' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\wmsj\\templates\\_footer.html',
      1 => 1497858977,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4327594b6c5b377783-11007162',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'jsFile' => 0,
    'val' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_594b6c5b383305_21708663',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_594b6c5b383305_21708663')) {function content_594b6c5b383305_21708663($_smarty_tpl) {?>    <!-- PASTE above -->
  </div>
</div>
<!-- /content -->

<?php echo '<script'; ?>
 type="text/javascript" src="/static/js/wmsj/jquery.yiiactiveform.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="/static/js/wmsj/jquery.ba-bbq.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="/static/js/wmsj/jquery-migrate-1.1.0.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="/static/js/wmsj/jquery-ui.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="/static/js/wmsj/jquery.ui.touch-punch.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="/static/js/wmsj/jquery.easypiechart.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="/static/js/wmsj/jquery.sparkline.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="/static/js/wmsj/jquery-ui-i18n.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="/static/js/wmsj/apublic.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="/static/js/wmsj/public_select.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="/static/js/ui/chosen.jquery.min.js?v=60"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="/static/js/wmsj/common.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type='text/javascript' src='/static/js/wmsj/jquery.dialog-4.2.0.js?v=50'><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="/static/js/wmsj/jquery-ui-timepicker-addon.js"><?php echo '</script'; ?>
>
<?php if ($_smarty_tpl->tpl_vars['jsFile']->value) {?>
<?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['val']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['jsFile']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value) {
$_smarty_tpl->tpl_vars['val']->_loop = true;
?>
<?php if (substr($_smarty_tpl->tpl_vars['val']->value,0,1)=="/") {?>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['val']->value;?>
"><?php echo '</script'; ?>
>
<?php } else { ?>
<?php echo '<script'; ?>
 type="text/javascript" src="/static/js/wmsj/<?php echo $_smarty_tpl->tpl_vars['val']->value;?>
"><?php echo '</script'; ?>
>
<?php }?>
<?php } ?>
<?php }?>
<?php echo '<script'; ?>
 type="text/javascript">
$(function(){
    // collapse nav
    $(document).on('click', 'nav a', function (e) {
      var $this = $(e.target), $active;
      $this.is('a') || ($this = $this.closest('a'));

      $active = $this.parent().siblings(".active");
      $active && $active.toggleClass('active').find('> ul:visible').slideUp(200);

      ($this.parent().hasClass('active') && $this.next().slideUp(200)) || $this.next().slideDown(200);
      $this.parent().toggleClass('active');

      $this.next().is('ul') && e.preventDefault();

      setTimeout(function(){ $(document).trigger('updateNav'); }, 300);
    });

    $('[data-rel="tooltip"]').tooltip();
    $('[data-rel="popover"]').popover();
    jQuery('.chooseTime').timepicker(jQuery.extend(jQuery.datepicker.regional['zh-cn'], {'timeFormat':'hh:mm','hour':'09','minute':'40'}));
});
<?php echo '</script'; ?>
>
</body>
</html>
<?php }} ?>
