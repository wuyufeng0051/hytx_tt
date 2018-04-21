<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-05-27 09:36:21
         compiled from "D:\ServerWwwroot\www.lwm.com\admin\templates\tuan\tuanStoreAdd.html" */ ?>
<?php /*%%SmartyHeaderCode:69755928d815a01173-54802909%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bddce36d2e88302a40c45e4f6148df875d5d73b4' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\admin\\templates\\tuan\\tuanStoreAdd.html',
      1 => 1494490269,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '69755928d815a01173-54802909',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'cfg_soft_lang' => 0,
    'pagetitle' => 0,
    'cssFile' => 0,
    'adminPath' => 0,
    'cfg_mapCity' => 0,
    'typeListArr' => 0,
    'addrListArr' => 0,
    'circle' => 0,
    'dopost' => 0,
    'id' => 0,
    'token' => 0,
    'company' => 0,
    'uid' => 0,
    'typename' => 0,
    'stype' => 0,
    'addrname' => 0,
    'addrid' => 0,
    'subwaySelected' => 0,
    'subway' => 0,
    'address' => 0,
    'lnglat' => 0,
    'tel' => 0,
    'openStart' => 0,
    'openEnd' => 0,
    'note' => 0,
    'body' => 0,
    'click' => 0,
    'weight' => 0,
    'stateopt' => 0,
    'state' => 0,
    'statenames' => 0,
    'editorFile' => 0,
    'jsFile' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5928d815a47684_98521117',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5928d815a47684_98521117')) {function content_5928d815a47684_98521117($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_radios')) include 'D:\\ServerWwwroot\\www.lwm.com\\include\\tpl\\plugins\\function.html_radios.php';
?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $_smarty_tpl->tpl_vars['cfg_soft_lang']->value;?>
" />
<title><?php echo $_smarty_tpl->tpl_vars['pagetitle']->value;?>
</title>
<?php echo $_smarty_tpl->tpl_vars['cssFile']->value;?>

<?php echo '<script'; ?>
>
var adminPath = "<?php echo $_smarty_tpl->tpl_vars['adminPath']->value;?>
", modelType = 'tuan', mapCity = "<?php echo $_smarty_tpl->tpl_vars['cfg_mapCity']->value;?>
", typeListArr = <?php echo $_smarty_tpl->tpl_vars['typeListArr']->value;?>
, addrListArr = <?php echo $_smarty_tpl->tpl_vars['addrListArr']->value;?>
, circle = <?php echo $_smarty_tpl->tpl_vars['circle']->value;?>
;
<?php echo '</script'; ?>
>
</head>

<body>
<form action="" method="post" name="editform" id="editform" class="editform">
  <input type="hidden" name="dopost" id="dopost" value="<?php echo $_smarty_tpl->tpl_vars['dopost']->value;?>
" />
  <input type="hidden" name="id" id="id" value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" />
  <input type="hidden" name="token" id="token" value="<?php echo $_smarty_tpl->tpl_vars['token']->value;?>
" />
  <dl class="clearfix">
    <dt><label for="company">对应会员：</label></dt>
    <dd style="position:static;">
      <input class="input-large" type="text" name="company" id="company" value="<?php echo $_smarty_tpl->tpl_vars['company']->value;?>
" autocomplete="off" />
      <input type="hidden" name="uid" id="uid" value="<?php echo $_smarty_tpl->tpl_vars['uid']->value;?>
" />
      <span class="input-tips" style="display:inline-block;"><s></s>此会员可以管理商家信息</span>
      <div id="companyList" class="popup_key"></div>
    </dd>
  </dl>
  
  <dl class="clearfix">
    <dt>商家类别：</dt>
    <dd style="overflow:visible;">
      <div class="btn-group" id="typeBtn" style="margin-left:10px;">
        <button class="btn dropdown-toggle" type="button" data-toggle="dropdown"><?php echo $_smarty_tpl->tpl_vars['typename']->value;?>
<span class="caret"></span></button>
      </div>
      <input type="hidden" name="stype" id="stype" value="<?php echo $_smarty_tpl->tpl_vars['stype']->value;?>
" />
      <span class="input-tips"><s></s>请选择商家类别</span>
    </dd>
  </dl>

  <dl class="clearfix">
    <dt>所在地区：</dt>
    <dd style="overflow:visible;">
      <div class="btn-group" id="addrBtn" style="margin-left:10px;">
        <button class="btn dropdown-toggle" type="button" data-toggle="dropdown"><?php echo $_smarty_tpl->tpl_vars['addrname']->value;?>
<span class="caret"></span></button>
      </div>
      <input type="hidden" name="addrid" id="addrid" value="<?php echo $_smarty_tpl->tpl_vars['addrid']->value;?>
" />
      <span class="input-tips"><s></s>请选择所在地区</span>
    </dd>
  </dl>

  <dl class="clearfix">
    <dt><label for="circle">商圈：</label></dt>
    <dd id="circleList"><span class="help-inline" style="padding: 5px 0 0;">请先选择区域</span></dd>
  </dl>

  <dl class="clearfix">
    <dt><label for="subway">附近地铁站：</label></dt>
    <dd>
      <div class="selectedTags"><?php echo $_smarty_tpl->tpl_vars['subwaySelected']->value;?>
</div>
      <input type="hidden" name="subway" id="subway" value="<?php echo $_smarty_tpl->tpl_vars['subway']->value;?>
" />
      <button class="btn chooseData" type="button">选择</button>
    </dd>
  </dl>

  <dl class="clearfix">
    <dt><label for="address">详细地址：</label></dt>
    <dd>
      <input class="input-large" type="text" name="address" id="address" value="<?php echo $_smarty_tpl->tpl_vars['address']->value;?>
" maxlength="60" data-regex=".{5,60}" />
      <img src="<?php echo $_smarty_tpl->tpl_vars['adminPath']->value;?>
../static/images/admin/markditu.jpg" id="mark" style="cursor:pointer;" title="标注地图位置" />
      <span class="input-tips"><s></s>请输入详细地址，5-60位</span>
      <input type="hidden" name="lnglat" id="lnglat" value="<?php echo $_smarty_tpl->tpl_vars['lnglat']->value;?>
" />
    </dd>
  </dl>

  <dl class="clearfix">
    <dt><label for="tel">联系电话：</label></dt>
    <dd>
      <input class="input-large" type="text" name="tel" id="tel" value="<?php echo $_smarty_tpl->tpl_vars['tel']->value;?>
" maxlength="30" data-regex=".{7,30}" />
      <span class="input-tips"><s></s>请输入联系电话，7-30位</span>
    </dd>
  </dl>

  <dl class="clearfix">
    <dt>营业时间：</dt>
    <dd>
      <div class="input-prepend input-append">
        <input class="input-mini" type="text" name="openStart" id="openStart" value="<?php echo $_smarty_tpl->tpl_vars['openStart']->value;?>
" />
        <span class="add-on">到</span>
        <input class="input-mini" type="text" name="openEnd" id="openEnd" value="<?php echo $_smarty_tpl->tpl_vars['openEnd']->value;?>
" />
      </div>
    </dd>
  </dl>  

  <dl class="clearfix">
    <dt><label for="note">简介：</label></dt>
    <dd>
      <textarea class="input-xxlarge" rows="3" name="note" id="note" maxlength="250" data-regex=".{0,250}"><?php echo $_smarty_tpl->tpl_vars['note']->value;?>
</textarea>
      <span class="input-tips"><s></s>请输入商家简介，250字以内</span>
    </dd>
  </dl>

  <dl class="clearfix">
    <dt>详细介绍：</dt>
    <dd><?php echo '<script'; ?>
 id="body" name="body" type="text/plain" style="width:85%;height:500px"><?php echo $_smarty_tpl->tpl_vars['body']->value;?>
<?php echo '</script'; ?>
></dd>
  </dl>
  
  <dl class="clearfix">
    <dt><label for="click">浏览次数：</label></dt>
    <dd>
      <span><input class="input-mini" type="number" name="click" min="0" id="click" value="<?php echo $_smarty_tpl->tpl_vars['click']->value;?>
" /></span>
      <label class="ml30" for="weight">排序：</label><input class="input-mini" type="number" name="weight" id="weight" min="1" data-regex="[1-9]\d*" value="<?php echo $_smarty_tpl->tpl_vars['weight']->value;?>
" />
      <span class="input-tips"><s></s>必填，排序越大，越排在前面</span>
    </dd>
  </dl>
  <dl class="clearfix">
    <dt><label for="state">显示状态：</label></dt>
    <dd class="radio">
      <?php echo smarty_function_html_radios(array('name'=>"state",'values'=>$_smarty_tpl->tpl_vars['stateopt']->value,'checked'=>$_smarty_tpl->tpl_vars['state']->value,'output'=>$_smarty_tpl->tpl_vars['statenames']->value,'separator'=>"&nbsp;&nbsp;"),$_smarty_tpl);?>

    </dd>
  </dl>
  <dl class="clearfix formbtn">
    <dt>&nbsp;</dt>
    <dd><input class="btn btn-large btn-success" type="submit" name="submit" id="btnSubmit" value="确认提交" /></dd>
  </dl>
</form>

<?php echo $_smarty_tpl->tpl_vars['editorFile']->value;?>

<?php echo $_smarty_tpl->tpl_vars['jsFile']->value;?>

</body>
</html><?php }} ?>
