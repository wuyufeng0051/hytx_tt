<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-05-24 11:08:22
         compiled from "D:\ServerWwwroot\www.lwm.com\templates\member\touch\top.html" */ ?>
<?php /*%%SmartyHeaderCode:284765924f92659e6b2-09752965%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b12b9c31bc4dc25448afbacf5d50b2d355c2a036' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\templates\\member\\touch\\top.html',
      1 => 1494490903,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '284765924f92659e6b2-09752965',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'backUrl' => 0,
    'templets_skin' => 0,
    'pageTitle' => 0,
    'module' => 0,
    'template' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5924f9265b5db0_72682172',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5924f9265b5db0_72682172')) {function content_5924f9265b5db0_72682172($_smarty_tpl) {?>
  <!-- 头部 s -->
  <div class="header">
    <div class="header-l">
      <?php if ($_smarty_tpl->tpl_vars['backUrl']->value!='undefined'&&$_smarty_tpl->tpl_vars['backUrl']->value!='') {?>
      <a href="<?php echo $_smarty_tpl->tpl_vars['backUrl']->value;?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/back-r.png"></a>
      <?php } else { ?>
      <a href="javascript:;" onclick="history.go(-1)"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/back-r.png"></a>
      <?php }?>
    </div>
    <div class="header-c"><?php echo $_smarty_tpl->tpl_vars['pageTitle']->value;?>
</div>
    <?php if ($_smarty_tpl->tpl_vars['module']->value=="resume") {?>
    <div class="header-r">
      <a href="javascript:;" class="look">预览</a>
    </div>
    <?php } elseif ($_smarty_tpl->tpl_vars['template']->value=='protrait') {?>
    <div class="header-r">
      <a href="javascript:;" class="reset">换一张</a><a href="javascript:;" id="save" class="disabled">保存</a>
    </div>
    <?php } elseif ($_smarty_tpl->tpl_vars['template']->value=='dating-album') {?>
    <div class="header-r">
      <a href="<?php echo getUrlPath(array('service'=>"member",'type'=>"user",'template'=>"dating-album-add"),$_smarty_tpl);?>
" class="reset">上传</a>
    </div>
    <?php } elseif ($_smarty_tpl->tpl_vars['template']->value=='dating-review-detail') {?>
    <div class="header-r">
      <a href="javascript:;" class="reply">回复</a>
    </div>
    <?php } else { ?>
    <div class="header-r">
      <a href="javascript:;" class="screen"><img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
images/screen.png"></a>
    </div>
    <?php }?>

    <div class="nav">
      <ul class="fn-clear">
        <?php $_smarty_tpl->smarty->_tag_stack[] = array('siteConfig', array('action'=>"siteModule",'return'=>"module")); $_block_repeat=true; echo siteConfig(array('action'=>"siteModule",'return'=>"module"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

        <li><a href="<?php echo $_smarty_tpl->tpl_vars['module']->value['url'];?>
" target="_blank"><span><?php echo $_smarty_tpl->tpl_vars['module']->value['name'];?>
</span></a></li>
        <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo siteConfig(array('action'=>"siteModule",'return'=>"module"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

      </ul>
    </div>
  </div>
  <!-- 头部 s -->
<?php }} ?>
