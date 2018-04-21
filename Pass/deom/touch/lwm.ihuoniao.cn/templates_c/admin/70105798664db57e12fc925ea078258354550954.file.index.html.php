<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-06-21 16:11:02
         compiled from "D:\ServerWwwroot\www.lwm.com\admin\templates\index.html" */ ?>
<?php /*%%SmartyHeaderCode:219495914219e782110-59175885%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '70105798664db57e12fc925ea078258354550954' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\admin\\templates\\index.html',
      1 => 1498029107,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '219495914219e782110-59175885',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5914219e7bcaa2_36677571',
  'variables' => 
  array (
    'cfg_soft_lang' => 0,
    'cfg_attachment' => 0,
    'cfg_basehost' => 0,
    'configData' => 0,
    'memberData' => 0,
    'businessData' => 0,
    'moduleData' => 0,
    'mobileData' => 0,
    'wechatData' => 0,
    'appData' => 0,
    'storeData' => 0,
    'hour' => 0,
    'username' => 0,
    'groupname' => 0,
    'logintime' => 0,
    'loginip' => 0,
    'gotopage' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5914219e7bcaa2_36677571')) {function content_5914219e7bcaa2_36677571($_smarty_tpl) {?><!DOCTYPE html>
<!--[if lt IE 9]>
<html class="oldie">
<![endif]-->
<!--[if gte IE 7]>
<html>
<![endif]-->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $_smarty_tpl->tpl_vars['cfg_soft_lang']->value;?>
">
<meta name="renderer" content="webkit">
<title>网站管理平台</title>
<?php echo '<script'; ?>
>
//确保页面不被iframe
if(top.location != location) top.location.href = location.href;
var cfg_attachment = '<?php echo $_smarty_tpl->tpl_vars['cfg_attachment']->value;?>
', adminPath = "../";
<?php echo '</script'; ?>
>
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
/static/css/admin/bootstrap.css?v=6" />
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
/static/css/admin/common.css?v=20" />
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
/static/css/admin/index.css?v=18" />
</head>

<body>
<div class="wrap header">
  <div class="h-left">
    <div class="business"><s></s>商业授权正版</div>
    <ul class="h-nav">
      <?php echo $_smarty_tpl->tpl_vars['configData']->value;
echo $_smarty_tpl->tpl_vars['memberData']->value;
echo $_smarty_tpl->tpl_vars['businessData']->value;
echo $_smarty_tpl->tpl_vars['moduleData']->value;
echo $_smarty_tpl->tpl_vars['mobileData']->value;
echo $_smarty_tpl->tpl_vars['wechatData']->value;
echo $_smarty_tpl->tpl_vars['appData']->value;
echo $_smarty_tpl->tpl_vars['storeData']->value;?>

    </ul>
  </div>
  <div class="h-right">
    <ul class="r-nav">
      <li class="notice hide"><a href="javascript:;" title="消息通知"><i>0</i><s>消息通知</s></a>
        <div class="noticify">
          <s class="arrow"></s>
          <div class="tit"><h3>消息通知</h3><a href="javascript:;" class="sound" title="关闭声音"></a></div>
          <div class="con clearfix"><ul></ul></div>
        </div>
      </li>
      <li class="preview sub-li"><a href="javascript:;" title="预览"><s>预览</s></a>
        <div class="sub-nav clearfix" id="preview">
          <a href="/" target="_blank">首页</a>
        </div>
      </li>
      <li class="config"><a href="javascript:;" title="系统基本参数"><s>系统基本参数</s></a></li>
      <li class="sear sub-li"><a href="javascript:;" title="功能搜索" class="sub-title"><s>功能搜索</s></a>
        <div class="sub-nav clearfix" id="search">
          <form class="form-search" style="margin:0; padding:10px 10px 10px 0" action="funSearch.php">
            <div class="input-append">
              <input type="text" class="span2 search-query" id="searchKey" placeholder="功能搜索" x-webkit-speech speech>
              <button type="submit" class="btn" id="searchBtn">搜索</button>
            </div>
            <a href="funSearch.php" id="mapsBtn" title="目录导航"><i class="icon-align-justify"></i> Maps</a>
          </form>
        </div>
      </li>
      <li class="exit"><a href="exit.php" title="安全退出"><s>安全退出</s></a></li>
    </ul>
  </div>
</div>

<div class="wrap welcome" id="welcome">
  <div id="welcome-index">
    <p><?php echo $_smarty_tpl->tpl_vars['hour']->value;?>
！欢迎回来&nbsp;<strong><?php echo $_smarty_tpl->tpl_vars['username']->value;?>
</strong>&nbsp;&nbsp;您的身份：<strong><?php echo $_smarty_tpl->tpl_vars['groupname']->value;?>
</strong><br />上次登陆时间：<?php echo $_smarty_tpl->tpl_vars['logintime']->value;?>
&nbsp;&nbsp;登录IP:<?php echo $_smarty_tpl->tpl_vars['loginip']->value;?>
 <a href="member/adminLogin.php" id="adminLogin">查看登录记录</a>&nbsp;&nbsp;如非您本人操作，存在异常情况，请在核实后尽快&nbsp;<a href="member/adminEdit.php" id="editPass">修改密码</a></p>
  </div>
</div>

<div class="wrap default-nav clearfix">
  <li class="firstnav cur" id="nav-index" data-type="index" data-listidx="false"><label>后台首页</label></li>
  <div class="navul">
    <ul class="clearfix"></ul>
  </div>
  <li class="lastnav"><s></s></li>
</div>

<ul id="menuNav" class="dropdown-menu"></ul>

<div class="wrap body" id="body">
  <div class="options">
    <a href="javascript:;" class="refresh" id="refresh" title="刷新"><s>刷新</s></a>
    <a href="javascript:;" class="full_screen" id="fullScreen" title="全屏"><s>全屏</s></a>
  </div>
  <iframe id="body-index" name="body-index" frameborder="0" src="index_body.php"></iframe>
</div>

<span id="gotopage" class="hide"><?php echo $_smarty_tpl->tpl_vars['gotopage']->value;?>
</span>


<!--[if lt IE 9]>
<div class="update-layer"></div>
<div class="update-frame">
  <h2>非常抱歉，系统暂停对IE8及以下版本浏览器的支持！</h2>
  <h3>我们强烈建议您安装新版本浏览器，点击图标即可下载。</h3>
  <p><img src="/static/images/admin/save.gif" />下列软件均通过安全检测，您可放心安装</p>
  <ul>
    <li><a href="http://dlsw.baidu.com/sw-search-sp/soft/9d/14744/ChromeStandalone_44.0.2403.130_Setup.1438755492.exe" target="_blank"><img src="/static/images/admin/browser/chrome.gif" />Chrome</a></li>
    <li><a href="http://download.firefox.com.cn/releases/stub/official/zh-CN/Firefox-latest.exe" target="_blank"><img src="/static/images/admin/browser/firefox.gif" />火狐</a></li>
    <li><a href="http://download.microsoft.com/download/3/A/2/3A2B7E95-24EF-44F6-A092-C9CF4D1878D0/IE11-Windows6.1.exe" target="_blank"><img src="/static/images/admin/browser/ie.gif" />IE11</a></li>
    <li><a href="http://down.360safe.com/se/360se7.1.1.800.exe" target="_blank"><img src="/static/images/admin/browser/360.gif" />360浏览器</a></li>
    <li><a href="http://download.ie.sogou.com/se/sogou_explorer_6.0_0806.exe" target="_blank"><img src="/static/images/admin/browser/sogou.gif" />搜狗浏览器</a></li>
    <li><a href="http://dldir1.qq.com/invc/tt/QQBrowser_Setup_9.0.2315.400.exe" target="_blank"><img src="/static/images/admin/browser/qq.gif" />QQ浏览器</a></li>
  </ul>
  <p class="tip">双核浏览器请切换至 <strong>极速模式</strong>。  <a href="http://jingyan.baidu.com/article/22a299b539f4b19e18376a5b.html" target="_blank">如何开启</a>？</p>
</div>
<!--<![endif]-->

<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
/static/js/core/jquery-1.8.3.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
/static/js/ui/bootstrap.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
/static/js/ui/jquery.dragsort-0.5.1.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
/static/js/ui/jquery.dialog-4.2.0.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
/static/js/ui/jquery.colorPicker.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
/static/js/ui/jquery-rightMenu.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
/static/js/admin/index.js?v=88"><?php echo '</script'; ?>
>
</body>
</html>
<?php }} ?>
