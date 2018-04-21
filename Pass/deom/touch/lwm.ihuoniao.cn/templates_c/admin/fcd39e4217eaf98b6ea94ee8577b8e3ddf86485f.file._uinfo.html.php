<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-06-22 15:06:03
         compiled from "D:\ServerWwwroot\www.lwm.com\wmsj\templates\_uinfo.html" */ ?>
<?php /*%%SmartyHeaderCode:24230594b6c5b367d88-60075338%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fcd39e4217eaf98b6ea94ee8577b8e3ddf86485f' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\wmsj\\templates\\_uinfo.html',
      1 => 1497858977,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '24230594b6c5b367d88-60075338',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_594b6c5b36bc04_49336711',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_594b6c5b36bc04_49336711')) {function content_594b6c5b36bc04_49336711($_smarty_tpl) {?><!-- nabar right -->
<ul class="nav navbar-nav navbar-right">
  <li class="dropdown">
    <a href="#" data-toggle="dropdown" class="dropdown-toggle clear" data-toggle="dropdown">
      <span class="hidden-sm hidden-md">管理员</span> <b class="caret"></b>
    </a>
    <!-- dropdown -->
    <ul class="dropdown-menu animated fadeInRight">
      <li><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user'),$_smarty_tpl);?>
" target="_blank">会员中心</a></li>
      <li><a href="<?php echo getUrlPath(array('service'=>'member'),$_smarty_tpl);?>
" target="_blank">商户中心</a></li>
      <li><a href="/logout.html">安全退出</a></li>
    </ul>
    <!-- / dropdown -->
  </li>
</ul>
<!-- / navbar right -->
<?php }} ?>
