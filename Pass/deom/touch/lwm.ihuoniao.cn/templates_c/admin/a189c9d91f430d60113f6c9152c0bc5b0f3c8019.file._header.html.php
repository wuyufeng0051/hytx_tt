<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-06-22 15:06:03
         compiled from "D:\ServerWwwroot\www.lwm.com\wmsj\templates\_header.html" */ ?>
<?php /*%%SmartyHeaderCode:24577594b6c5b329572-59013232%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a189c9d91f430d60113f6c9152c0bc5b0f3c8019' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\wmsj\\templates\\_header.html',
      1 => 1497935585,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '24577594b6c5b329572-59013232',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'pageTitle' => 0,
    'cssFile' => 0,
    'val' => 0,
    'adminPath' => 0,
    'cfg_attachment' => 0,
    'pageCurr' => 0,
    'HUONIAOADMIN' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_594b6c5b35c201_98939351',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_594b6c5b35c201_98939351')) {function content_594b6c5b35c201_98939351($_smarty_tpl) {?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>乐外卖 - <?php echo $_smarty_tpl->tpl_vars['pageTitle']->value;?>
</title>
  <link rel="stylesheet" type="text/css" href="/static/css/wmsj/jquery-ui.css" />
  <link rel="stylesheet" type="text/css" href="/static/css/wmsj/styles.css" />
  <link rel="stylesheet" href="/static/css/ui/jquery.chosen.css" />
  <link rel="stylesheet" href="/static/css/wmsj/ace-fonts.min.css" />
  <link rel="stylesheet" href="/static/css/wmsj/select.css">
  <link rel="stylesheet" href="/static/css/wmsj/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
  <link rel="stylesheet" href="/static/css/wmsj/bootstrap.css" type="text/css" />
  <link rel="stylesheet" href="/static/css/wmsj/animate.css" type="text/css" />
  <link rel="stylesheet" href="/static/css/wmsj/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="/static/css/wmsj/simple-line-icons.css" type="text/css" />
  <link rel="stylesheet" href="/static/css/wmsj/font.css" type="text/css" />
  <link rel="stylesheet" href="/static/css/wmsj/app.css" type="text/css" />
  <?php if ($_smarty_tpl->tpl_vars['cssFile']->value) {?>
  <?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['val']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['cssFile']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value) {
$_smarty_tpl->tpl_vars['val']->_loop = true;
?>
  <?php if (substr($_smarty_tpl->tpl_vars['val']->value,0,1)=="/") {?>
  <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['val']->value;?>
" type="text/css" />
  <?php } else { ?>
  <link rel="stylesheet" href="/static/css/wmsj/<?php echo $_smarty_tpl->tpl_vars['val']->value;?>
" type="text/css" />
  <?php }?>
  <?php } ?>
  <?php }?>
  <!-- jQuery -->
  <?php echo '<script'; ?>
 src="/static/js/wmsj/jquery.min.js"><?php echo '</script'; ?>
>
  <?php echo '<script'; ?>
 src="/static/js/wmsj/bootstrap.js"><?php echo '</script'; ?>
>
  <?php echo '<script'; ?>
>
    var adminPath = "<?php echo $_smarty_tpl->tpl_vars['adminPath']->value;?>
", cfg_attachment = '<?php echo $_smarty_tpl->tpl_vars['cfg_attachment']->value;?>
';
  <?php echo '</script'; ?>
>
</head>

<body>
  <div class="app app-header-fixed app-aside-fixed" id="app">
    <div class="app-header navbar">
      <div class="navbar-header bg-dark">
        <a href="javascript:;" class="navbar-brand text-lt"><span class="hidden-folded">外卖系统管理后台</span></a>
      </div>
    </div>

    <!-- menu -->
    <div class="app-aside hidden-xs bg-dark">
      <div class="aside-wrap">
        <div class="navi-wrap">

          <!-- 左侧树形菜单 -->
          <nav ui-nav class="navi">
            <ul class="nav">

                <li<?php if ($_smarty_tpl->tpl_vars['pageCurr']->value=="index"||$_smarty_tpl->tpl_vars['pageCurr']->value=='') {?> class="active"<?php }?>><a href="<?php echo $_smarty_tpl->tpl_vars['HUONIAOADMIN']->value;?>
index.php"><i class="glyphicon glyphicon-home icon"></i>后台首页</a></li>


                <li<?php if (strstr($_smarty_tpl->tpl_vars['pageCurr']->value,"statistics/")) {?> class="active"<?php }?>>
                  <a href="javascript:;" class="auto">
                    <span class="pull-right text-muted"><i class="fa fa-fw fa-angle-right text"></i><i class="fa fa-fw fa-angle-down text-active"></i></span>
                    <i class="glyphicon glyphicon-stats icon"></i>
                    数据统计
                  </a>
                  <ul class="nav nav-sub dk">
                    <li<?php if (strstr($_smarty_tpl->tpl_vars['pageCurr']->value,"/waimaiStatistics")) {?> class="active"<?php }?>><a href="<?php echo $_smarty_tpl->tpl_vars['HUONIAOADMIN']->value;?>
statistics/waimaiStatisticsChartrevenue.php">外卖统计</a></li>
                  </ul>
                </li>


                <li<?php if (strstr($_smarty_tpl->tpl_vars['pageCurr']->value,"shop/")) {?> class="active"<?php }?>>
                  <a href class="auto">
                    <span class="pull-right text-muted"><i class="fa fa-fw fa-angle-right text"></i><i class="fa fa-fw fa-angle-down text-active"></i></span>
                    <i class="glyphicon glyphicon-inbox icon"></i>
                    店铺管理
                  </a>
                  <ul class="nav nav-sub dk">
                    <li<?php if (strstr($_smarty_tpl->tpl_vars['pageCurr']->value,"shop/waimaiShop")||strstr($_smarty_tpl->tpl_vars['pageCurr']->value,"shop/add")) {?> class="active"<?php }?>><a href="<?php echo $_smarty_tpl->tpl_vars['HUONIAOADMIN']->value;?>
shop/waimaiShop.php">店铺管理</a></li>
                  </ul>
                </li>
  
                

                <li<?php if (strstr($_smarty_tpl->tpl_vars['pageCurr']->value,"order/")) {?> class="active"<?php }?>>
                  <a href class="auto">
                    <span class="pull-right text-muted"><i class="fa fa-fw fa-angle-right text"></i><i class="fa fa-fw fa-angle-down text-active"></i></span>
                    <i class="glyphicon glyphicon-leaf icon"></i>
                    外卖订单
                  </a>
                  <ul class="nav nav-sub dk">
                    <li<?php if (strstr($_smarty_tpl->tpl_vars['pageCurr']->value,"waimaiOrder")&&strstr($_smarty_tpl->tpl_vars['pageCurr']->value,"waimaiOrderSearch")===false) {?> class="active"<?php }?>><a href="<?php echo $_smarty_tpl->tpl_vars['HUONIAOADMIN']->value;?>
order/waimaiOrder.php">订单管理</a></li>
                    <!-- <li><a>订单搜索</a></li> -->
                    <li<?php if (strstr($_smarty_tpl->tpl_vars['pageCurr']->value,"waimaiOrderSearch")) {?> class="active"<?php }?>><a href="<?php echo $_smarty_tpl->tpl_vars['HUONIAOADMIN']->value;?>
order/waimaiOrderSearch.php">导出订单</a></li>
                  </ul>
                </li>

                <!-- <li>
                  <a href class="auto">
                    <span class="pull-right text-muted"><i class="fa fa-fw fa-angle-right text"></i><i class="fa fa-fw fa-angle-down text-active"></i></span>
                    <i class="glyphicon glyphicon-bullhorn icon"></i>
                    店内下单
                  </a>
                  <ul class="nav nav-sub dk">
                    <li><a>店内下单订单</a></li>
                    <li><a>店内下单订单搜素</a></li>
                    <li><a>店内下单订单设置</a></li>
                  </ul>
                </li> -->
                
                

                

                <li<?php if (strstr($_smarty_tpl->tpl_vars['pageCurr']->value,"message/")) {?> class="active"<?php }?>>
                  <a href class="auto">
                    <span class="pull-right text-muted"><i class="fa fa-fw fa-angle-right text"></i><i class="fa fa-fw fa-angle-down text-active"></i></span>
                    <i class="glyphicon glyphicon-comment icon"></i>
                    顾客交流
                  </a>
                  <ul class="nav nav-sub dk">
                    <!-- <li><a>店铺留言</a></li> -->
                    <li<?php if (strstr($_smarty_tpl->tpl_vars['pageCurr']->value,"waimaiCommon")) {?> class="active"<?php }?>><a href="<?php echo $_smarty_tpl->tpl_vars['HUONIAOADMIN']->value;?>
message/waimaiCommon.php">评论管理</a></li>
                  </ul>
                </li>

                

                


            </ul>
          </nav>
          <!-- nav -->

        </div>
      </div>
    </div>
    <!-- / menu -->

    <!-- content -->
    <div class="app-content">
      <div class="app-content-body fade-in-up">
        <!-- COPY the content from "tpl/" -->
<?php }} ?>
