<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-05-25 10:27:27
         compiled from "D:\ServerWwwroot\www.lwm.com\admin\templates\member\memberEdit.html" */ ?>
<?php /*%%SmartyHeaderCode:258465926410fdc2d45-59909007%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '547e5c579ef654def2b368a77434f42e6af3a4aa' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\admin\\templates\\member\\memberEdit.html',
      1 => 1494490298,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '258465926410fdc2d45-59909007',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'cfg_soft_lang' => 0,
    'cssFile' => 0,
    'photoSize' => 0,
    'photoType' => 0,
    'adminPath' => 0,
    'id' => 0,
    'token' => 0,
    'username' => 0,
    'from' => 0,
    'logincount' => 0,
    'online' => 0,
    'money' => 0,
    'freeze' => 0,
    'point' => 0,
    'mtype' => 0,
    'mtypeChecked' => 0,
    'mtypeNames' => 0,
    'discount' => 0,
    'nickname' => 0,
    'email' => 0,
    'emailCheck' => 0,
    'phone' => 0,
    'phoneCheck' => 0,
    'qq' => 0,
    'photo' => 0,
    'thumbSize' => 0,
    'cfg_attachment' => 0,
    'sex' => 0,
    'sexChecked' => 0,
    'sexNames' => 0,
    'birthday' => 0,
    'addrName' => 0,
    'addrListArr' => 0,
    'addrlist' => 0,
    'addr' => 0,
    'realname' => 0,
    'idcard' => 0,
    'idcardFront' => 0,
    'idcardBack' => 0,
    'certifyState' => 0,
    'certifyStateChecked' => 0,
    'certifyStateNames' => 0,
    'certifyInfo' => 0,
    'company' => 0,
    'address' => 0,
    'license' => 0,
    'licenseState' => 0,
    'licenseStateChecked' => 0,
    'licenseStateNames' => 0,
    'licenseInfo' => 0,
    'state' => 0,
    'stateChecked' => 0,
    'stateNames' => 0,
    'stateinfo' => 0,
    'recid' => 0,
    'recname' => 0,
    'regtime' => 0,
    'regip' => 0,
    'lastlogintime' => 0,
    'lastloginip' => 0,
    'jsFile' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5926410fe91df3_30799061',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5926410fe91df3_30799061')) {function content_5926410fe91df3_30799061($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_radios')) include 'D:\\ServerWwwroot\\www.lwm.com\\include\\tpl\\plugins\\function.html_radios.php';
?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $_smarty_tpl->tpl_vars['cfg_soft_lang']->value;?>
" />
<title>修改会员</title>
<?php echo $_smarty_tpl->tpl_vars['cssFile']->value;?>

<?php echo '<script'; ?>
>
var photoSize = <?php echo $_smarty_tpl->tpl_vars['photoSize']->value;?>
, photoType = "<?php echo $_smarty_tpl->tpl_vars['photoType']->value;?>
", adminPath = "<?php echo $_smarty_tpl->tpl_vars['adminPath']->value;?>
";
<?php echo '</script'; ?>
>
</head>

<body>
<form action="" method="post" name="editform" id="editform" class="editform">
  <input type="hidden" name="id" id="id" value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" />
  <input type="hidden" name="token" id="token" value="<?php echo $_smarty_tpl->tpl_vars['token']->value;?>
" />
  <dl class="clearfix">
    <dt><label>用户名：</label></dt>
    <dd class="singel-line">
      <?php echo $_smarty_tpl->tpl_vars['username']->value;?>
&nbsp;&nbsp;（注册来源：【<?php echo $_smarty_tpl->tpl_vars['from']->value;?>
】，共登录：【<?php echo $_smarty_tpl->tpl_vars['logincount']->value;?>
次】，当前状态：【<?php echo $_smarty_tpl->tpl_vars['online']->value;?>
】）
    </dd>
  </dl>
  <dl class="clearfix">
    <dt><label>帐户信息：</label></dt>
    <dd class="singel-line">
      余额：<strong class="text-success" style="font-size:18px;">&yen;<span id="moneyObj"><?php echo $_smarty_tpl->tpl_vars['money']->value;?>
</span></strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      冻结：<strong class="text-success" style="font-size:18px;">&yen;<span id="freezeObj"><?php echo $_smarty_tpl->tpl_vars['freeze']->value;?>
</span></strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      积分：<strong class="text-success" style="font-size:18px;"><span id="pointObj"><?php echo $_smarty_tpl->tpl_vars['point']->value;?>
</span></strong>
    </dd>
  </dl>
  <div class="btn-group config-nav" data-toggle="buttons-radio" style="margin-bottom:15px;">
    <button type="button" class="btn active" data-type="info">基本信息</button>
    <button type="button" class="btn" data-type="money">余额操作</button>
    <button type="button" class="btn" data-type="point">积分操作</button>
  </div>
  <div class="item">
    <dl class="clearfix">
      <dt><label>会员类型：</label></dt>
      <dd class="radio">
        <?php echo smarty_function_html_radios(array('name'=>"mtype",'values'=>$_smarty_tpl->tpl_vars['mtype']->value,'checked'=>$_smarty_tpl->tpl_vars['mtypeChecked']->value,'output'=>$_smarty_tpl->tpl_vars['mtypeNames']->value,'separator'=>"&nbsp;&nbsp;"),$_smarty_tpl);?>

      </dd>
    </dl>
    <dl class="clearfix">
      <dt><label for="password">新密码：</label></dt>
      <dd>
        <input class="input-large" type="text" name="password" id="password" data-regex=".{5,}" maxlength="60" value="" />
        <span class="input-tips" style="display:inline-block;"><s></s>最少5个字符。如不更改密码，留空即可！</span>
      </dd>
    </dl>
    <dl class="clearfix">
      <dt><label for="discount">打折卡号：</label></dt>
      <dd>
        <input class="input-large" type="text" name="discount" id="discount" data-regex=".*" maxlength="60" value="<?php echo $_smarty_tpl->tpl_vars['discount']->value;?>
" />
        <span class="input-tips"><s></s>请输入打折卡号。</span>
      </dd>
    </dl>
    <dl class="clearfix">
      <dt><label for="nickname">昵称：</label></dt>
      <dd>
        <input class="input-large" type="text" name="nickname" id="nickname" data-regex=".{2,35}" maxlength="35" value="<?php echo $_smarty_tpl->tpl_vars['nickname']->value;?>
" />
        <span class="input-tips"><s></s>请输入会员昵称，2-10个字符。</span>
      </dd>
    </dl>
    <dl class="clearfix">
      <dt><label for="email">邮箱：</label></dt>
      <dd>
        <input class="input-large" type="text" name="email" id="email" data-regex="\w+((-w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+" maxlength="60" value="<?php echo $_smarty_tpl->tpl_vars['email']->value;?>
" />
        <label><input type="checkbox" name="emailCheck" id="emailCheck" value="1"<?php if ($_smarty_tpl->tpl_vars['emailCheck']->value==1) {?>checked="checked"<?php }?> />已验证</label>
        <span class="input-tips"><s></s>请正确输入邮箱地址。</span>
      </dd>
    </dl>
    <dl class="clearfix">
      <dt><label for="phone">手机：</label></dt>
      <dd>
        <input class="input-large" type="text" name="phone" id="phone" data-regex="0?(13|14|15|17|18)[0-9]{9}" maxlength="60" value="<?php echo $_smarty_tpl->tpl_vars['phone']->value;?>
" />
        <label><input type="checkbox" name="phoneCheck" id="phoneCheck" value="1"<?php if ($_smarty_tpl->tpl_vars['phoneCheck']->value==1) {?>checked="checked"<?php }?> />已验证</label>
        <span class="input-tips"><s></s>请正确输入手机号码。</span>
      </dd>
    </dl>
    <dl class="clearfix">
      <dt><label for="paypwd">支付密码：</label></dt>
      <dd>
        <input class="input-large" type="text" name="paypwd" id="paypwd" data-regex=".{0,10}" maxlength="20" value="" />
        <span class="input-tips" style="display:inline-block;"><s></s>20个字符以内。如不更改密码，留空即可！</span>
      </dd>
    </dl>
    <dl class="clearfix">
      <dt><label for="qq">QQ：</label></dt>
      <dd>
        <input class="input-large" type="number" name="qq" id="qq" data-regex="[1-9]*[1-9][0-9]*" maxlength="11" value="<?php echo $_smarty_tpl->tpl_vars['qq']->value;?>
" />
        <span class="input-tips"><s></s>请输入联系QQ，数字型。</span>
      </dd>
    </dl>
    <dl class="clearfix">
      <dt>头像：</dt>
      <dd class="thumb fn-clear listImgBox">
  			<div class="uploadinp filePicker thumbtn<?php if ($_smarty_tpl->tpl_vars['photo']->value!='') {?> hide<?php }?>" id="filePicker1" data-type="thumb"  data-count="1" data-size="<?php echo $_smarty_tpl->tpl_vars['thumbSize']->value;?>
" data-imglist=""><div></div><span></span></div>
  			<?php if ($_smarty_tpl->tpl_vars['photo']->value!='') {?>
  			<ul id="listSection1" class="listSection thumblist fn-clear" style="display:inline-block;"><li id="WU_FILE_0_1"><a href='<?php echo $_smarty_tpl->tpl_vars['cfg_attachment']->value;
echo $_smarty_tpl->tpl_vars['photo']->value;?>
' target="_blank" title=""><img alt="" src="<?php echo $_smarty_tpl->tpl_vars['cfg_attachment']->value;
echo $_smarty_tpl->tpl_vars['photo']->value;?>
" data-val="<?php echo $_smarty_tpl->tpl_vars['photo']->value;?>
"/></a><a class="reupload li-rm" href="javascript:;">删除图片</a></li></ul>
  			<?php } else { ?>
  			<ul id="listSection1" class="listSection thumblist fn-clear"></ul>
  			<?php }?>
  			<input type="hidden" name="litpic" value="<?php echo $_smarty_tpl->tpl_vars['photo']->value;?>
" class="imglist-hidden" id="litpic">
  		</dd>
    </dl>
    <dl class="clearfix">
      <dt><label>性别：</label></dt>
      <dd class="radio">
        <?php echo smarty_function_html_radios(array('name'=>"sex",'values'=>$_smarty_tpl->tpl_vars['sex']->value,'checked'=>$_smarty_tpl->tpl_vars['sexChecked']->value,'output'=>$_smarty_tpl->tpl_vars['sexNames']->value,'separator'=>"&nbsp;&nbsp;"),$_smarty_tpl);?>

      </dd>
    </dl>
    <dl class="clearfix">
      <dt><label for="birthday">出生日期：</label></dt>
      <dd><input class="input-small" type="text" name="birthday" id="birthday" value="<?php echo $_smarty_tpl->tpl_vars['birthday']->value;?>
" /></dd>
    </dl>
    <dl class="clearfix">
      <dt><label>所在区域：</label></dt>
      <dd style="overflow:visible;" id="addrList">
        <div class="btn-group" style="margin-left:10px;">
          <button class="btn dropdown-toggle" type="button" data-toggle="dropdown"><?php echo $_smarty_tpl->tpl_vars['addrName']->value;?>
<span class="caret"></span></button>
          <ul class="dropdown-menu">
            <li><a href="javascript:;" data-id="0">请选择</a></li>
            <?php  $_smarty_tpl->tpl_vars['addrlist'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['addrlist']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['addrListArr']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['addrlist']->key => $_smarty_tpl->tpl_vars['addrlist']->value) {
$_smarty_tpl->tpl_vars['addrlist']->_loop = true;
?>
            <li><a href="javascript:;" data-id="<?php echo $_smarty_tpl->tpl_vars['addrlist']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['addrlist']->value['typename'];?>
</a></li>
            <?php } ?>
          </ul>
        </div>
        <input type="hidden" name="addr" id="addr" value="<?php echo $_smarty_tpl->tpl_vars['addr']->value;?>
" />
        <span class="input-tips"><s></s>请选择所在区域</span>
      </dd>
    </dl>
    <dl class="clearfix">
      <dt><label for="realname">真实姓名：</label></dt>
      <dd>
        <input class="input-large" type="text" name="realname" id="realname" data-regex=".{2,10}" maxlength="10" value="<?php echo $_smarty_tpl->tpl_vars['realname']->value;?>
" />
        <span class="input-tips"><s></s>请输入真实姓名，2-10个字符。</span>
      </dd>
    </dl>
    <dl class="clearfix">
      <dt><label for="idcard">身份证号码：</label></dt>
      <dd>
        <input class="input-large" type="text" name="idcard" id="idcard" data-regex="[1-9][0-9]{16}(x|[0-9])" maxlength="18" value="<?php echo $_smarty_tpl->tpl_vars['idcard']->value;?>
" />
        <span class="input-tips"><s></s>请输入身份证号码，18位。</span>
      </dd>
    </dl>
    <dl class="clearfix">
      <dt><label>身份证正面：</label></dt>
      <dd class="thumb fn-clear listImgBox">
  			<div class="uploadinp filePicker thumbtn<?php if ($_smarty_tpl->tpl_vars['idcardFront']->value!='') {?> hide<?php }?>" id="filePicker2" data-type="thumb"  data-count="1" data-size="<?php echo $_smarty_tpl->tpl_vars['thumbSize']->value;?>
" data-imglist=""><div></div><span></span></div>
  			<?php if ($_smarty_tpl->tpl_vars['idcardFront']->value!='') {?>
  			<ul id="listSection2" class="listSection thumblist fn-clear" style="display:inline-block;"><li id="WU_FILE_1_1"><a href='<?php echo $_smarty_tpl->tpl_vars['cfg_attachment']->value;
echo $_smarty_tpl->tpl_vars['idcardFront']->value;?>
' target="_blank" title=""><img alt="" src="<?php echo $_smarty_tpl->tpl_vars['cfg_attachment']->value;
echo $_smarty_tpl->tpl_vars['idcardFront']->value;?>
&type=middle" data-val="<?php echo $_smarty_tpl->tpl_vars['idcardFront']->value;?>
"/></a><a class="reupload li-rm" href="javascript:;">删除图片</a></li></ul>
  			<?php } else { ?>
  			<ul id="listSection2" class="listSection thumblist fn-clear"></ul>
  			<?php }?>
  			<input type="hidden" name="idcardFront" value="<?php echo $_smarty_tpl->tpl_vars['idcardFront']->value;?>
" class="imglist-hidden" id="idcardFrontObj">
  		</dd>
    </dl>
    <dl class="clearfix">
      <dt><label>身份证反面：</label></dt>
      <dd class="thumb fn-clear listImgBox">
  			<div class="uploadinp filePicker thumbtn<?php if ($_smarty_tpl->tpl_vars['idcardBack']->value!='') {?> hide<?php }?>" id="filePicker3" data-type="thumb"  data-count="1" data-size="<?php echo $_smarty_tpl->tpl_vars['thumbSize']->value;?>
" data-imglist=""><div></div><span></span></div>
  			<?php if ($_smarty_tpl->tpl_vars['idcardBack']->value!='') {?>
  			<ul id="listSection3" class="listSection thumblist fn-clear" style="display:inline-block;"><li id="WU_FILE_2_1"><a href='<?php echo $_smarty_tpl->tpl_vars['cfg_attachment']->value;
echo $_smarty_tpl->tpl_vars['idcardBack']->value;?>
' target="_blank" title=""><img alt="" src="<?php echo $_smarty_tpl->tpl_vars['cfg_attachment']->value;
echo $_smarty_tpl->tpl_vars['idcardBack']->value;?>
&type=middle" data-val="<?php echo $_smarty_tpl->tpl_vars['idcardBack']->value;?>
"/></a><a class="reupload li-rm" href="javascript:;">删除图片</a></li></ul>
  			<?php } else { ?>
  			<ul id="listSection3" class="listSection thumblist fn-clear"></ul>
  			<?php }?>
  			<input type="hidden" name="idcardBack" value="<?php echo $_smarty_tpl->tpl_vars['idcardBack']->value;?>
" class="imglist-hidden" id="idcardBackObj">
  		</dd>
    </dl>
    <dl class="clearfix">
      <dt><label>实名认证：</label></dt>
      <dd class="radio">
        <?php echo smarty_function_html_radios(array('name'=>"certifyState",'values'=>$_smarty_tpl->tpl_vars['certifyState']->value,'checked'=>$_smarty_tpl->tpl_vars['certifyStateChecked']->value,'output'=>$_smarty_tpl->tpl_vars['certifyStateNames']->value,'separator'=>"&nbsp;&nbsp;"),$_smarty_tpl);?>

      </dd>
    </dl>
    <?php if ($_smarty_tpl->tpl_vars['certifyStateChecked']->value==2) {?>
    <dl class="clearfix">
    <?php } else { ?>
    <dl class="clearfix hide">
    <?php }?>
      <dt><label for="certifyInfo">审核备注：</label></dt>
      <dd>
        <textarea name="certifyInfo" id="certifyInfo" class="input-xxlarge" data-regex=".*" rows="2"><?php echo $_smarty_tpl->tpl_vars['certifyInfo']->value;?>
</textarea>
        <span class="input-tips"><s></s>请输入认证失败的原因。</span>
      </dd>
    </dl>
    <?php if ($_smarty_tpl->tpl_vars['mtypeChecked']->value==2) {?>
    <div id="companyobj" style="background:#f5f5f5; padding:5px 0;">
    <?php } else { ?>
    <div id="companyobj" class="hide" style="background:#f5f5f5; padding:5px 0;">
    <?php }?>
      <dl class="clearfix">
        <dt><label for="company">公司名称：</label></dt>
        <dd>
          <input class="input-xlarge" type="text" name="company" id="company" data-regex=".{0,100}" maxlength="100" value="<?php echo $_smarty_tpl->tpl_vars['company']->value;?>
" />
          <span class="input-tips"><s></s>请输入公司名称。</span>
        </dd>
      </dl>
      <dl class="clearfix">
        <dt><label for="address">详细地址：</label></dt>
        <dd>
          <input class="input-xlarge" type="text" name="address" id="address" data-regex=".*" maxlength="100" value="<?php echo $_smarty_tpl->tpl_vars['address']->value;?>
" />
          <span class="input-tips"><s></s>请输入公司详细地址。</span>
        </dd>
      </dl>
      <dl class="clearfix">
        <dt><label>营业执照：</label></dt>
        <dd class="thumb fn-clear listImgBox">
    			<div class="uploadinp filePicker thumbtn<?php if ($_smarty_tpl->tpl_vars['license']->value!='') {?> hide<?php }?>" id="filePicker4" data-type="thumb"  data-count="1" data-size="<?php echo $_smarty_tpl->tpl_vars['thumbSize']->value;?>
" data-imglist=""><div></div><span></span></div>
    			<?php if ($_smarty_tpl->tpl_vars['license']->value!='') {?>
    			<ul id="listSection4" class="listSection thumblist fn-clear" style="display:inline-block;"><li id="WU_FILE_3_1"><a href='<?php echo $_smarty_tpl->tpl_vars['cfg_attachment']->value;
echo $_smarty_tpl->tpl_vars['license']->value;?>
' target="_blank" title=""><img alt="" src="<?php echo $_smarty_tpl->tpl_vars['cfg_attachment']->value;
echo $_smarty_tpl->tpl_vars['license']->value;?>
&type=middle" data-val="<?php echo $_smarty_tpl->tpl_vars['license']->value;?>
"/></a><a class="reupload li-rm" href="javascript:;">删除图片</a></li></ul>
    			<?php } else { ?>
    			<ul id="listSection4" class="listSection thumblist fn-clear"></ul>
    			<?php }?>
    			<input type="hidden" name="license" value="<?php echo $_smarty_tpl->tpl_vars['license']->value;?>
" class="imglist-hidden" id="licenseObj">
    		</dd>
      </dl>
      <dl class="clearfix">
        <dt><label>审核状态：</label></dt>
        <dd class="radio">
          <?php echo smarty_function_html_radios(array('name'=>"licenseState",'values'=>$_smarty_tpl->tpl_vars['licenseState']->value,'checked'=>$_smarty_tpl->tpl_vars['licenseStateChecked']->value,'output'=>$_smarty_tpl->tpl_vars['licenseStateNames']->value,'separator'=>"&nbsp;&nbsp;"),$_smarty_tpl);?>

        </dd>
      </dl>
      <?php if ($_smarty_tpl->tpl_vars['licenseStateChecked']->value==2) {?>
      <dl class="clearfix">
      <?php } else { ?>
      <dl class="clearfix hide">
      <?php }?>
        <dt><label for="licenseInfo">审核备注：</label></dt>
        <dd>
          <textarea name="licenseInfo" id="licenseInfo" class="input-xxlarge" data-regex=".*" rows="2"><?php echo $_smarty_tpl->tpl_vars['licenseInfo']->value;?>
</textarea>
          <span class="input-tips"><s></s>请输入认证失败的原因。</span>
        </dd>
      </dl>
    </div>
    <dl class="clearfix">
      <dt><label>会员状态：</label></dt>
      <dd class="radio">
        <?php echo smarty_function_html_radios(array('name'=>"state",'values'=>$_smarty_tpl->tpl_vars['state']->value,'checked'=>$_smarty_tpl->tpl_vars['stateChecked']->value,'output'=>$_smarty_tpl->tpl_vars['stateNames']->value,'separator'=>"&nbsp;&nbsp;"),$_smarty_tpl);?>

      </dd>
    </dl>
    <?php if ($_smarty_tpl->tpl_vars['stateChecked']->value==2) {?>
    <dl class="clearfix">
    <?php } else { ?>
    <dl class="clearfix hide">
    <?php }?>
      <dt><label for="stateinfo">审核备注：</label></dt>
      <dd>
        <textarea name="stateinfo" id="stateinfo" class="input-xxlarge" data-regex=".*" rows="2"><?php echo $_smarty_tpl->tpl_vars['stateinfo']->value;?>
</textarea>
        <span class="input-tips"><s></s>请输入审核拒绝的原因。</span>
      </dd>
    </dl>
    <?php if ($_smarty_tpl->tpl_vars['recid']->value!=0) {?>
    <dl class="clearfix">
      <dt><label>推荐会员：</label></dt>
      <dd class="singel-line">
      <a href="javascript:;" class="userinfo" data-id=<?php echo $_smarty_tpl->tpl_vars['recid']->value;?>
><?php echo $_smarty_tpl->tpl_vars['recname']->value;?>
</a>
      </dd>
    </dl>
    <?php }?>
    <dl class="clearfix">
      <dt><label>注册信息：</label></dt>
      <dd class="singel-line">
        注册时间：<?php echo $_smarty_tpl->tpl_vars['regtime']->value;?>
&nbsp;&nbsp;注册IP：<?php echo $_smarty_tpl->tpl_vars['regip']->value;?>

      </dd>
    </dl>
    <dl class="clearfix">
      <dt><label>最后登录信息：</label></dt>
      <dd class="singel-line">
        <?php if ($_smarty_tpl->tpl_vars['lastlogintime']->value==''&&$_smarty_tpl->tpl_vars['lastloginip']->value=='') {?>
        还未登录
        <?php } else { ?>
        登录时间：<?php echo $_smarty_tpl->tpl_vars['lastlogintime']->value;?>
&nbsp;&nbsp;登录IP：<?php echo $_smarty_tpl->tpl_vars['lastloginip']->value;?>

        <?php }?>
      </dd>
    </dl>
    <dl class="clearfix formbtn">
      <dt>&nbsp;</dt>
      <dd><button class="btn btn-large btn-success" type="submit" name="button" id="btnSubmit">确认提交</button></dd>
    </dl>
  </div>
  <div class="item hide" style="padding-left:40px;">
    <dl style="margin:0 40px 15px 10px; padding-top:5px; background:#f5f5f5">
      <dd>
        <label><input type="radio" name="moneyOpera" value="1" checked="true" />增加</label>&nbsp;&nbsp;
        <label><input type="radio" name="moneyOpera" value="0" />减少</label>&nbsp;&nbsp;
        <input type="text" class="input-mini" name="operaMoney" />元&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <label>操作原因：<input type="text" class="input-xlarge" name="operaMoneyInfo" /></label>
        <input type="button" class="btn btn-success" id="operaMoney" value="提交" />
      </dd>
    </dl>
    <div class="filter clearfix" style="margin-right:40px;">
      <div class="btn-group" id="selectBtn">
        <button class="btn dropdown-toggle" data-toggle="dropdown"><span class="check"></span><span class="caret"></span></button>
        <ul class="dropdown-menu">
          <li><a href="javascript:;" data-id="1">全选</a></li>
          <li><a href="javascript:;" data-id="0">不选</a></li>
        </ul>
      </div>&nbsp;&nbsp;
      <a href="javascript:;" class="btn btn-primary" id="delMoney">删除选定</a>&nbsp;
      <a href="javascript:;" class="btn btn-danger" id="ClearMoney">清空记录</a>
    </div>
    <ul class="thead clearfix" style="margin-right:40px;">
      <li class="row3">&nbsp;</li>
      <li class="row15 left">收支</li>
      <li class="row15 left">金额</li>
      <li class="row40 left">原因</li>
      <li class="row20 left">时间</li>
      <li class="row7">操作</li>
    </ul>
    <div class="list common mt124" id="list" data-totalpage="1" data-atpage="1" style="margin-right:30px;"><table><tbody></tbody></table><div id="loading" class="loading hide"></div></div>
    <div id="pageInfo" class="pagination pagination-centered" style="margin-right:40px;"></div>
  </div>
  <div class="item hide" style="padding-left:40px;">
    <dl style="margin:0 40px 15px 10px; padding-top:5px; background:#f5f5f5">
      <dd>
        <label><input type="radio" name="pointOpera" value="1" checked="true" />增加</label>&nbsp;&nbsp;
        <label><input type="radio" name="pointOpera" value="0" />减少</label>&nbsp;&nbsp;
        <input type="text" class="input-mini" name="operaPoint" />分&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <label>操作原因：<input type="text" class="input-xlarge" name="operaPointInfo" /></label>
        <input type="button" class="btn btn-success" id="operaPoint" value="提交" />
      </dd>
    </dl>
    <div class="filter clearfix" style="margin-right:40px;">
      <div class="btn-group" id="selectBtn_">
        <button class="btn dropdown-toggle" data-toggle="dropdown"><span class="check"></span><span class="caret"></span></button>
        <ul class="dropdown-menu">
          <li><a href="javascript:;" data-id="1">全选</a></li>
          <li><a href="javascript:;" data-id="0">不选</a></li>
        </ul>
      </div>&nbsp;&nbsp;
      <a href="javascript:;" class="btn btn-primary" id="delPoint">删除选定</a>&nbsp;
      <a href="javascript:;" class="btn btn-danger" id="ClearPoint">清空记录</a>
    </div>
    <ul class="thead clearfix" style="margin-right:40px;">
      <li class="row3">&nbsp;</li>
      <li class="row15 left">收支</li>
      <li class="row15 left">积分</li>
      <li class="row40 left">原因</li>
      <li class="row20 left">时间</li>
      <li class="row7">操作</li>
    </ul>
    <div class="list common mt124" id="list_" data-totalpage="1" data-atpage="1" style="margin-right:30px;"><table><tbody></tbody></table><div id="loading_" class="loading hide"></div></div>
    <div id="pageInfo_" class="pagination pagination-centered" style="margin-right:40px;"></div>
  </div>
</form>

<?php echo $_smarty_tpl->tpl_vars['jsFile']->value;?>

</body>
</html>
<?php }} ?>
