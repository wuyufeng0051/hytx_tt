<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-05-12 17:44:44
         compiled from "D:\ServerWwwroot\www.lwm.com\admin\templates\waimai\waimaiDivpage.html" */ ?>
<?php /*%%SmartyHeaderCode:14135591568f3eada80-87683006%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '552be1b58700d0094341cae049f72b8620b9e12b' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\admin\\templates\\waimai\\waimaiDivpage.html',
      1 => 1494582283,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14135591568f3eada80-87683006',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_591568f3ef3f91_19927199',
  'variables' => 
  array (
    'cfg_soft_lang' => 0,
    'cssFile' => 0,
    'action' => 0,
    'adminPath' => 0,
    'type' => 0,
    'title' => 0,
    'description' => 0,
    'tel' => 0,
    'share_pic' => 0,
    'cfg_attachment' => 0,
    'index_banner' => 0,
    'tubiao_nav' => 0,
    'ad1' => 0,
    'huodong_nav' => 0,
    'shopList' => 0,
    's' => 0,
    'shop' => 0,
    'jsFile' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_591568f3ef3f91_19927199')) {function content_591568f3ef3f91_19927199($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $_smarty_tpl->tpl_vars['cfg_soft_lang']->value;?>
" />
<title>微页面</title>
<?php echo $_smarty_tpl->tpl_vars['cssFile']->value;?>

<?php echo '<script'; ?>
>
var action = "<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
", adminPath = "<?php echo $_smarty_tpl->tpl_vars['adminPath']->value;?>
", imglist = [], modelType = "waimai", type = '<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
';
<?php echo '</script'; ?>
>
<style type="text/css">
.page-content-area {padding-top: 20px;}
.divpage {float: left; position: relative; width: 300px; height: 715px; background: url('/static/images/waimai_divpage.jpg');}

.field {position: relative; display: block; cursor: pointer;}
.field:after {position: absolute; z-index: 888; left: 0; top: 0; right: 0; bottom: 0; content: ""; background: rgba(255, 178, 0, .4); display: none;}
.field:hover:after {display: block;}

.page-title {height: 35px; line-height: 35px; padding: 0 60px; margin-top: 16px; text-align: center;}
.page-title h3 {position: relative; z-index: 889; color: #fff; font-size: 16px; margin: 0; padding: 0; line-height: 35px; white-space: nowrap; text-overflow: ellipsis; overflow: hidden;}


.page-banner {height: 118px;}
.page-tubiao_nav {height: 145px; margin-top: 45px;}
.page-ad1 {height: 65px;}
.page-huodong_nav {height: 125px;}
.page-shop {height: 165px;}

.content {position: relative; overflow: hidden; min-height: 700px; padding-left: 50px;}

.pubitem {padding: 10px;}
.list-holder li {width: 440px;}
.list-holder li .li-thumb {margin-top: 0;}
.list-holder li .li-input {width: 260px; padding-top: 8px;}
.list-holder li .li-input input.i-desc {display: none;}
#page_huodong_nav .list-holder li .li-input .i-name {margin-bottom: 0;}
#page_huodong_nav .list-holder li .li-input input.i-desc {display: block;}
#page_huodong_nav .list-holder li .li-input {padding-top: 0;}

.chzn-container {font-size: 14px;}

.page-content .list-holder li .li-input .i-name {margin-bottom: 0;}
</style>
</head>

<body>
<div class="main-content">

  <div class="page-content">
    <!-- /section:settings.box -->
    <div class="page-content-area clearfix">

        <div class="divpage">
            <a href="waimaiDivpage.php?type=title" class="field page-title" title="点击编辑" id="title"><h3>金点外卖 服务到家</h3></a>
            <a href="waimaiDivpage.php?type=banner" class="field page-banner" title="点击编辑" id="banner"></a>
            <a href="waimaiDivpage.php?type=tubiao_nav" class="field page-tubiao_nav" title="点击编辑" id="tubiao_nav"></a>
            <a href="waimaiDivpage.php?type=ad1" class="field page-ad1" title="点击编辑" id="ad1"></a>
            <a href="waimaiDivpage.php?type=huodong_nav" class="field page-huodong_nav" title="点击编辑" id="huodong_nav"></a>
            <a href="waimaiDivpage.php?type=shop" class="field page-shop" title="点击编辑" id="shop"></a>
        </div>

        <div class="content form-horizontal">

            <?php if ($_smarty_tpl->tpl_vars['type']->value=="title") {?>
            <!-- 标题 start -->
            <div class="page-item" id="page_title">

                <div class="form-group">
                  <label class="col-sm-1" for="title">页面标题</label>
                  <input class="col-sm-2" name="title" id="title" type="text" maxlength="200" value="<?php echo $_smarty_tpl->tpl_vars['title']->value;?>
">
                </div>
                <div class="form-group ">
                  <label class="col-sm-1"><label for="description">页面描述</label></label>
                  <textarea class="col-sm-3" rows="5" name="description" id="description"><?php echo $_smarty_tpl->tpl_vars['description']->value;?>
</textarea>
                </div>
                <div class="form-group">
                  <label class="col-sm-1" for="tel">客服电话</label>
                  <input class="col-sm-2" name="tel" id="tel" type="text" maxlength="200" value="<?php echo $_smarty_tpl->tpl_vars['tel']->value;?>
">
                </div>
                <div class="form-group">
                  <label class="col-sm-1" for="Config_share_image">分享图片</label>
                  <div class="clearfix listImgBox" style="display: none;">
                      <div class="thumb" style="width: auto;">
                          <div class="uploadinp filePicker thumbtn"<?php if ($_smarty_tpl->tpl_vars['share_pic']->value!='') {?> style="display:none;"<?php }?> id="filePicker1" data-type="thumb"  data-count="1" data-size="1024" data-imglist=""><div></div><span></span></div>
                          <?php if ($_smarty_tpl->tpl_vars['share_pic']->value!='') {?>
                          <ul id="listSection1" class="listSection thumblist clearfix" style="display:inline-block;"><li id="WU_FILE_0_1"><a href='<?php echo $_smarty_tpl->tpl_vars['cfg_attachment']->value;
echo $_smarty_tpl->tpl_vars['share_pic']->value;?>
' target="_blank" title=""><img alt="" src="<?php echo $_smarty_tpl->tpl_vars['cfg_attachment']->value;
echo $_smarty_tpl->tpl_vars['share_pic']->value;?>
" data-val="<?php echo $_smarty_tpl->tpl_vars['share_pic']->value;?>
"/></a><a class="reupload li-rm" href="javascript:;">删除图片</a></li></ul>
                          <?php } else { ?>
                          <ul id="listSection1" class="listSection thumblist clearfix"></ul>
                          <?php }?>
                          <input type="hidden" name="share_pic" value="<?php echo $_smarty_tpl->tpl_vars['share_pic']->value;?>
" class="imglist-hidden" id="litpic">
                      </div>
                  </div>
                </div>
                <div class="form-group" style="margin-top: 50px;">
                  <button class="btn btn-info tjbtn" type="button"><i class="ace-icon fa fa-check bigger-110"></i>保存</button>
                </div>

            </div>
            <!-- 标题 end -->
            <?php }?>

            <?php if ($_smarty_tpl->tpl_vars['type']->value=="banner") {?>
            <!-- banner start -->
            <div class="page-item" id="page_banner">

                <div class="form-group">

                  <div class="listImgBox">
        			<div class="list-holder">
        				<ul id="listSection" class="clearfix listSection"></ul>
        				<input type="hidden" name="banner" value='<?php echo $_smarty_tpl->tpl_vars['index_banner']->value;?>
' class="imglist-hidden">
        			</div>
        			<div class="btn-section clearfix">
        				<div class="uploadinp filePicker" id="filePicker" data-type="adv" data-count="10" data-size="1024" data-imglist=""><div id="flasHolder"></div><span>添加图片</span></div>
        				<div class="upload-tip">
        					<p><a href="javascript:;" class="deleteAllAtlas" style="display:none;">删除所有</a>&nbsp;&nbsp;<span class="fileerror"></span></p>
        				</div>
        			</div>
                  </div>

                </div>
                <div class="form-group">
                  <button class="btn btn-info tjbtn" type="button"><i class="ace-icon fa fa-check bigger-110"></i>保存</button>
                </div>

            </div>
            <div id="adBody" class="hide"><?php echo $_smarty_tpl->tpl_vars['index_banner']->value;?>
</div>
            <!-- banner end -->
            <?php }?>

            <?php if ($_smarty_tpl->tpl_vars['type']->value=="tubiao_nav") {?>
            <!-- tubiao_nav start -->
            <div class="page-item" id="page_tubiao_nav">

                <div class="form-group">

                  <div class="listImgBox">
        			<div class="list-holder">
        				<ul id="listSection" class="clearfix listSection"></ul>
        				<input type="hidden" name="tubiao_nav" value='<?php echo $_smarty_tpl->tpl_vars['tubiao_nav']->value;?>
' class="imglist-hidden">
        			</div>
        			<div class="btn-section clearfix">
        				<div class="uploadinp filePicker" id="filePicker" data-type="adv" data-count="10" data-size="1024" data-imglist=""><div id="flasHolder"></div><span>添加图片</span></div>
        				<div class="upload-tip">
        					<p><a href="javascript:;" class="deleteAllAtlas" style="display:none;">删除所有</a>&nbsp;&nbsp;<span class="fileerror"></span></p>
        				</div>
        			</div>
                  </div>

                </div>
                <div class="form-group">
                  <button class="btn btn-info tjbtn" type="button"><i class="ace-icon fa fa-check bigger-110"></i>保存</button>
                </div>

            </div>
            <div id="adBody" class="hide"><?php echo $_smarty_tpl->tpl_vars['tubiao_nav']->value;?>
</div>
            <!-- tubiao_nav end -->
            <?php }?>

            <?php if ($_smarty_tpl->tpl_vars['type']->value=="ad1") {?>
            <!-- ad1 start -->
            <div class="page-item" id="page_ad1">

                <div class="form-group">

                  <div class="listImgBox">
        			<div class="list-holder">
        				<ul id="listSection" class="clearfix listSection"></ul>
        				<input type="hidden" name="ad1" value='<?php echo $_smarty_tpl->tpl_vars['ad1']->value;?>
' class="imglist-hidden">
        			</div>
        			<div class="btn-section clearfix">
        				<div class="uploadinp filePicker" id="filePicker" data-type="adv" data-count="10" data-size="1024" data-imglist=""><div id="flasHolder"></div><span>添加图片</span></div>
        				<div class="upload-tip">
        					<p><a href="javascript:;" class="deleteAllAtlas" style="display:none;">删除所有</a>&nbsp;&nbsp;<span class="fileerror"></span></p>
        				</div>
        			</div>
                  </div>

                </div>
                <div class="form-group">
                  <button class="btn btn-info tjbtn" type="button"><i class="ace-icon fa fa-check bigger-110"></i>保存</button>
                </div>

            </div>
            <div id="adBody" class="hide"><?php echo $_smarty_tpl->tpl_vars['ad1']->value;?>
</div>
            <!-- ad1 end -->
            <?php }?>

            <?php if ($_smarty_tpl->tpl_vars['type']->value=="huodong_nav") {?>
            <!-- huodong_nav start -->
            <div class="page-item" id="page_huodong_nav">

                <div class="form-group">

                  <div class="listImgBox">
        			<div class="list-holder">
        				<ul id="listSection" class="clearfix listSection"></ul>
        				<input type="hidden" name="huodong_nav" value='<?php echo $_smarty_tpl->tpl_vars['huodong_nav']->value;?>
' class="imglist-hidden">
        			</div>
        			<div class="btn-section clearfix">
        				<div class="uploadinp filePicker" id="filePicker" data-type="adv" data-count="10" data-size="1024" data-imglist=""><div id="flasHolder"></div><span>添加图片</span></div>
        				<div class="upload-tip">
        					<p><a href="javascript:;" class="deleteAllAtlas" style="display:none;">删除所有</a>&nbsp;&nbsp;<span class="fileerror"></span></p>
        				</div>
        			</div>
                  </div>

                </div>
                <div class="form-group">
                  <button class="btn btn-info tjbtn" type="button"><i class="ace-icon fa fa-check bigger-110"></i>保存</button>
                </div>

            </div>
            <div id="adBody" class="hide"><?php echo $_smarty_tpl->tpl_vars['huodong_nav']->value;?>
</div>
            <!-- huodong_nav end -->
            <?php }?>

            <?php if ($_smarty_tpl->tpl_vars['type']->value=="shop") {?>
            <!-- 选择店铺 start -->
            <div class="page-item" id="page_shop">

                <div class="form-group">
                  <label class="col-sm-1" for="Config_share_title">选择店铺</label>

                  <select data-placeholder="选择店铺" class="chzn-select hide" multiple="multiple" name="shop[]" style="width:400px;" tabindex="4">
                      <option value=""></option>
                      <?php  $_smarty_tpl->tpl_vars['s'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['s']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['shopList']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['s']->key => $_smarty_tpl->tpl_vars['s']->value) {
$_smarty_tpl->tpl_vars['s']->_loop = true;
?>
                      <option value="<?php echo $_smarty_tpl->tpl_vars['s']->value['id'];?>
"<?php if ($_smarty_tpl->tpl_vars['shop']->value&&in_array($_smarty_tpl->tpl_vars['s']->value['id'],$_smarty_tpl->tpl_vars['shop']->value)) {?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['s']->value['shopname'];?>
</option>
                      <?php } ?>
                    </select>

                </div>
                <div class="form-group" style="margin-top: 50px;">
                  <button class="btn btn-info tjbtn" type="button"><i class="ace-icon fa fa-check bigger-110"></i>保存</button>
                </div>

            </div>
            <!-- 选择店铺 end -->
            <?php }?>




        </div>

    </div>
  </div>

 <?php echo $_smarty_tpl->tpl_vars['jsFile']->value;?>

<?php }} ?>
