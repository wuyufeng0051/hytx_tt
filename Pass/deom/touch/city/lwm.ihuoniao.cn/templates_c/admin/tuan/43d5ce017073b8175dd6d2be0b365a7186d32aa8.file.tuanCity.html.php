<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-05-27 16:25:20
         compiled from "D:\ServerWwwroot\www.lwm.com\admin\templates\tuan\tuanCity.html" */ ?>
<?php /*%%SmartyHeaderCode:1626592937f0284a39-45674448%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '43d5ce017073b8175dd6d2be0b365a7186d32aa8' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\admin\\templates\\tuan\\tuanCity.html',
      1 => 1494490268,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1626592937f0284a39-45674448',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'cfg_soft_lang' => 0,
    'cssFile' => 0,
    'customSubDomain' => 0,
    'province' => 0,
    'p' => 0,
    'domaintype' => 0,
    'domaintypeChecked' => 0,
    'domaintypeNames' => 0,
    'subdomain' => 0,
    'adminPath' => 0,
    'token' => 0,
    'domainArr' => 0,
    'defaultCity' => 0,
    'jsFile' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_592937f02c3245_52836632',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_592937f02c3245_52836632')) {function content_592937f02c3245_52836632($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_radios')) include 'D:\\ServerWwwroot\\www.lwm.com\\include\\tpl\\plugins\\function.html_radios.php';
if (!is_callable('smarty_modifier_replace')) include 'D:\\ServerWwwroot\\www.lwm.com\\include\\tpl\\plugins\\modifier.replace.php';
?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $_smarty_tpl->tpl_vars['cfg_soft_lang']->value;?>
" />
<title>团购城市管理</title>
<?php echo $_smarty_tpl->tpl_vars['cssFile']->value;?>

</head>

<body>
<div class="search">
  <div class="btn-group">
    <button class="btn dropdown-toggle" data-toggle="dropdown">批量操作<span class="caret"></span></button>
    <ul class="dropdown-menu">
      
      <?php if ($_smarty_tpl->tpl_vars['customSubDomain']->value!=2) {?><li><a href="javascript:;" data-id="1">子域名</a></li><?php }?>
      <li><a href="javascript:;" data-id="2">子目录</a></li>
    </ul>
  </div>
  <button type="button" class="btn btn-success">保存全部</button>
  <button type="button" class="btn btn-primary ml30">开通城市</button>
</div>
<ul class="thead clearfix" style="position:relative; top:0; left:0; right:0; margin:10px 10px 0;">
  <li class="row3">&nbsp;</li>
  <li class="row12 left">城市名称</li>
  <li class="row10 left">类型</li>
  <li class="row25 left">域名</li>
  <li class="row50 left">操作</li>
</ul>
<div class="list mt124" id="list"><table><tbody><tr><td style="height:200px;" align="center">加载中...</td></tr></tbody></table></div>
<div class="search">
  <div class="btn-group dropup">
    <button class="btn dropdown-toggle" data-toggle="dropdown">批量操作<span class="caret"></span></button>
    <ul class="dropdown-menu">
      
      <?php if ($_smarty_tpl->tpl_vars['customSubDomain']->value!=2) {?><li><a href="javascript:;" data-id="1">子域名</a></li><?php }?>
      <li><a href="javascript:;" data-id="2">子目录</a></li>
    </ul>
  </div>
  <button type="button" class="btn btn-success">保存全部</button>
  <button type="button" class="btn btn-primary ml30">开通城市</button>
</div>

<?php echo '<script'; ?>
 id="addCity" type="text/html">
  <form action="" class="quick-editForm" name="editForm">
    <dl class="clearfix">
      <dt>所属城市：</dt>
      <dd>
        <select id="pBtn" name="pBtn" style="width:130px;">
          <option value="">--省份--</option>
          <?php  $_smarty_tpl->tpl_vars['p'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['p']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['province']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['p']->key => $_smarty_tpl->tpl_vars['p']->value) {
$_smarty_tpl->tpl_vars['p']->_loop = true;
?>
          <option value="<?php echo $_smarty_tpl->tpl_vars['p']->value['id'];?>
" data-pinyin="<?php echo $_smarty_tpl->tpl_vars['p']->value['pinyin'];?>
"><?php echo $_smarty_tpl->tpl_vars['p']->value['typename'];?>
</option>
          <?php } ?>
        </select>
        <select id="cBtn" name="cBtn" style="width:130px;">
          <option value="">--城市--</option>
        </select>
        <select id="xBtn" name="xBtn" style="width:130px;">
          <option value="">--区县--</option>
        </select>
      </dd>
    </dl>
    <dl class="clearfix">
      <dt>域名类型：</dt>
      <dd class="clearfix">
        <?php echo smarty_function_html_radios(array('name'=>"domaintype",'values'=>$_smarty_tpl->tpl_vars['domaintype']->value,'checked'=>$_smarty_tpl->tpl_vars['domaintypeChecked']->value,'output'=>$_smarty_tpl->tpl_vars['domaintypeNames']->value,'separator'=>"&nbsp;&nbsp;"),$_smarty_tpl);?>

      </dd>
    </dl>
    <dl class="clearfix">
      <dt>绑定域名：</dt>
      <dd>
        <div class="input-prepend input-append">
          <span class="add-on">http://<?php echo smarty_modifier_replace($_smarty_tpl->tpl_vars['subdomain']->value,"www.",'');?>
</span>
          <input class="input-mini" type="text" name="domain" id="domain" />
          <span class="add-on" style="display:none;"></span>
        </div>
      </dd>
    </dl>
  </form>
<?php echo '</script'; ?>
>


<?php echo '<script'; ?>
>var adminPath = "<?php echo $_smarty_tpl->tpl_vars['adminPath']->value;?>
", subdomain = '<?php echo smarty_modifier_replace($_smarty_tpl->tpl_vars['subdomain']->value,"www.",'');?>
', customSubDomain = '<?php echo $_smarty_tpl->tpl_vars['customSubDomain']->value;?>
', token = '<?php echo $_smarty_tpl->tpl_vars['token']->value;?>
', domainArr = <?php echo $_smarty_tpl->tpl_vars['domainArr']->value;?>
, defaultCity = <?php echo $_smarty_tpl->tpl_vars['defaultCity']->value;?>
, token = '<?php echo $_smarty_tpl->tpl_vars['token']->value;?>
';<?php echo '</script'; ?>
>
<?php echo $_smarty_tpl->tpl_vars['jsFile']->value;?>

</body>
</html>
<?php }} ?>
