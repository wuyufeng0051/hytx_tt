<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-05-23 17:27:59
         compiled from "D:\ServerWwwroot\www.lwm.com\templates\member\orderdetail-tuan.html" */ ?>
<?php /*%%SmartyHeaderCode:79845924009f2331e5-95917669%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '08427771ec21b1cad13292bcf41f071b3aafc9f5' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\templates\\member\\orderdetail-tuan.html',
      1 => 1494490895,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '79845924009f2331e5-95917669',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'detail_orderstate' => 0,
    'detail_product' => 0,
    'detail_paydate' => 0,
    'detail_retState' => 0,
    'detail_expDate' => 0,
    'stateInfo' => 0,
    'detail_retOkdate' => 0,
    'detail_payurl' => 0,
    'detail_common' => 0,
    'detail_retType' => 0,
    'detail_retNote' => 0,
    'detail_retPics' => 0,
    'pics' => 0,
    'detail_retDate' => 0,
    'detail_retSnote' => 0,
    'detail_retSpics' => 0,
    'detail_retSdate' => 0,
    'atlasSize' => 0,
    'atlasType' => 0,
    'rates' => 0,
    'cfg_staticPath' => 0,
    'templets_skin' => 0,
    'atlasMax' => 0,
    'k' => 0,
    'detail_cardnum' => 0,
    'cardnum' => 0,
    'detail_now' => 0,
    'cla' => 0,
    'qtitle' => 0,
    'static' => 0,
    'detail_ordernum' => 0,
    'detail_orderdate' => 0,
    'detail_paytype' => 0,
    'detail_username' => 0,
    'detail_usercontact' => 0,
    'detail_useraddr' => 0,
    'detail_deliveryType' => 0,
    'detail_usernote' => 0,
    'id' => 0,
    'row' => 0,
    'contact' => 0,
    '_bindex' => 0,
    'useraddress' => 0,
    'addr' => 0,
    'detail_expCompany' => 0,
    'detail_expNumber' => 0,
    'detail_store' => 0,
    'detail_orderprice' => 0,
    'detail_procount' => 0,
    'detail_freight' => 0,
    'detail_totalmoney' => 0,
    'detail_point' => 0,
    'detail_balance' => 0,
    'detail_payprice' => 0,
    'cfg_pointName' => 0,
    'cfg_pointRatio' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5924009f3ae0c3_54952432',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5924009f3ae0c3_54952432')) {function content_5924009f3ae0c3_54952432($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'D:\\ServerWwwroot\\www.lwm.com\\include\\tpl\\plugins\\modifier.date_format.php';
if (!is_callable('smarty_function_math')) include 'D:\\ServerWwwroot\\www.lwm.com\\include\\tpl\\plugins\\function.math.php';
?><h2 class="subtitle">订单详情<a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'order','module'=>'tuan'),$_smarty_tpl);?>
">返回我的订单列表</a></h2>

<?php $_smarty_tpl->tpl_vars['stateInfo'] = new Smarty_variable('', null, 0);?>
<?php if ($_smarty_tpl->tpl_vars['detail_orderstate']->value==0) {?>
	<?php $_smarty_tpl->tpl_vars['stateInfo'] = new Smarty_variable("未付款", null, 0);?>
<?php } elseif ($_smarty_tpl->tpl_vars['detail_orderstate']->value==1) {?>
	<?php if ($_smarty_tpl->tpl_vars['detail_product']->value['tuantype']==2) {?>
		<?php $_smarty_tpl->tpl_vars['stateInfo'] = new Smarty_variable("已付款，等待卖家发货", null, 0);?>
	<?php } else { ?>
		<?php $_smarty_tpl->tpl_vars['stateInfo'] = new Smarty_variable("已付款，未使用", null, 0);?>
	<?php }?>
<?php } elseif ($_smarty_tpl->tpl_vars['detail_orderstate']->value==2) {?>
	<?php if ($_smarty_tpl->tpl_vars['detail_paydate']->value==0) {?>
		<?php $_smarty_tpl->tpl_vars['stateInfo'] = new Smarty_variable("未付款，已过期", null, 0);?>
	<?php } else { ?>
		<?php $_smarty_tpl->tpl_vars['stateInfo'] = new Smarty_variable("已过期", null, 0);?>
	<?php }?>
<?php } elseif ($_smarty_tpl->tpl_vars['detail_orderstate']->value==3) {?>
	<?php $_smarty_tpl->tpl_vars['stateInfo'] = new Smarty_variable("交易成功", null, 0);?>
<?php } elseif ($_smarty_tpl->tpl_vars['detail_orderstate']->value==6) {?>
	<?php if ($_smarty_tpl->tpl_vars['detail_retState']->value==1) {?>
		<?php if ($_smarty_tpl->tpl_vars['detail_expDate']->value==0) {?>
			<?php $_smarty_tpl->tpl_vars['stateInfo'] = new Smarty_variable("卖家还未发货，申请退款中", null, 0);?>
		<?php } else { ?>
			<?php $_smarty_tpl->tpl_vars['stateInfo'] = new Smarty_variable("卖家已发货，申请退款中", null, 0);?>
		<?php }?>
	<?php } else { ?>
		<?php $_smarty_tpl->tpl_vars['stateInfo'] = new Smarty_variable("已发货，等待收货", null, 0);?>
	<?php }?>
<?php } elseif ($_smarty_tpl->tpl_vars['detail_orderstate']->value==7) {?>
	<?php $_smarty_tpl->tpl_vars['stateInfo'] = new Smarty_variable("退款成功", null, 0);?>
<?php }?>
<dl class="info-section">
	<dt>
		<span class="info-title">当前订单状态：</span><em class="info-text"><?php echo $_smarty_tpl->tpl_vars['stateInfo']->value;?>
</em>
		<?php if ($_smarty_tpl->tpl_vars['detail_orderstate']->value==7) {?>
		&nbsp;&nbsp;退款时间：<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['detail_retOkdate']->value,"%Y-%m-%d %H:%M:%S");?>

		<?php }?>

		<?php if ($_smarty_tpl->tpl_vars['detail_orderstate']->value==1||($_smarty_tpl->tpl_vars['detail_orderstate']->value==2&&$_smarty_tpl->tpl_vars['detail_paydate']->value!=0)||($_smarty_tpl->tpl_vars['detail_orderstate']->value==6&&$_smarty_tpl->tpl_vars['detail_retState']->value==0)) {?><a class="apply-refund-link" href="javascript:;">申请退款</a><?php }?>
	</dt>

	
	<?php if ($_smarty_tpl->tpl_vars['detail_orderstate']->value==0) {?>
	<dd class="last">
		<p>请及时付款，不然就被抢光啦！</p>
		<div class="operation">
			<a class="btn" href="<?php echo $_smarty_tpl->tpl_vars['detail_payurl']->value;?>
">付款</a>
		</div>
	</dd>
	<?php }?>

	
	<?php if ($_smarty_tpl->tpl_vars['detail_orderstate']->value==1) {?>
	<dd class="last">
		<?php if ($_smarty_tpl->tpl_vars['detail_product']->value['tuantype']==2) {?>
		<p>卖家发货前，您支付的钱款将不会被打给卖家</p>
		<?php } else { ?>
		<p>请在团购结束（<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['detail_product']->value['enddate'],"%Y-%m-%d %H:%M:%S");?>
）前使用，以免过期无法使用！</p>
		<?php }?>
	</dd>
	<?php }?>

	
	<?php if ($_smarty_tpl->tpl_vars['detail_orderstate']->value==2&&$_smarty_tpl->tpl_vars['detail_paydate']->value!=0) {?>
	<dd class="last">
		<p>您团购的商品已经过期，您可以申请退款！</p>
	</dd>
	<?php }?>

	
	<?php if ($_smarty_tpl->tpl_vars['detail_orderstate']->value==3) {?>
	<dd class="last">
		<div class="operation">
			<a class="btn writeCommon" href="javascript:;"><?php if (count($_smarty_tpl->tpl_vars['detail_common']->value)>0) {?>修改评价<?php } else { ?>评价<?php }?></a>
		</div>
	</dd>
	<?php }?>

	
	<?php if ($_smarty_tpl->tpl_vars['detail_orderstate']->value==6||($_smarty_tpl->tpl_vars['detail_orderstate']->value==7&&$_smarty_tpl->tpl_vars['detail_paydate']->value!=0)) {?>
	<dd class="last">

		<?php if (($_smarty_tpl->tpl_vars['detail_orderstate']->value==7&&$_smarty_tpl->tpl_vars['detail_paydate']->value!=0)||$_smarty_tpl->tpl_vars['detail_retState']->value==1) {?>
		<ul class="retUl">
			<li><label>退款原因：</label><?php echo $_smarty_tpl->tpl_vars['detail_retType']->value;?>
</li>
			<li><label>退款说明：</label><?php echo $_smarty_tpl->tpl_vars['detail_retNote']->value;?>
</li>
			<?php if (count($_smarty_tpl->tpl_vars['detail_retPics']->value)>0) {?>
			<li class="retPics"><label>退款凭证：</label>
				<?php  $_smarty_tpl->tpl_vars['pics'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['pics']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['detail_retPics']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['pics']->key => $_smarty_tpl->tpl_vars['pics']->value) {
$_smarty_tpl->tpl_vars['pics']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['pics']->key;
?>
				<a href="<?php echo $_smarty_tpl->tpl_vars['pics']->value['path'];?>
" target="_blank"><img src="<?php echo changeFileSize(array('url'=>((string)$_smarty_tpl->tpl_vars['pics']->value['path']),'type'=>"small"),$_smarty_tpl);?>
" /></a>
				<?php } ?>
			</li>
			<?php }?>
			<li><label>申请时间：</label><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['detail_retDate']->value,"%Y-%m-%d %H:%M:%S");?>
</li>
		</ul>
		<?php }?>

		<?php if ($_smarty_tpl->tpl_vars['detail_retSnote']->value!='') {?>
		<ul class="retUl store">
			<li><label>卖家回复：</label><?php echo $_smarty_tpl->tpl_vars['detail_retSnote']->value;?>
</li>
			<?php if (count($_smarty_tpl->tpl_vars['detail_retSpics']->value)>0) {?>
			<li class="retPics"><label>回复凭证：</label>
				<?php  $_smarty_tpl->tpl_vars['pics'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['pics']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['detail_retSpics']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['pics']->key => $_smarty_tpl->tpl_vars['pics']->value) {
$_smarty_tpl->tpl_vars['pics']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['pics']->key;
?>
				<a href="<?php echo $_smarty_tpl->tpl_vars['pics']->value['path'];?>
" target="_blank"><img src="<?php echo changeFileSize(array('url'=>((string)$_smarty_tpl->tpl_vars['pics']->value['path']),'type'=>"small"),$_smarty_tpl);?>
" /></a>
				<?php } ?>
			</li>
			<?php }?>
			<li><label>回复时间：</label><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['detail_retSdate']->value,"%Y-%m-%d %H:%M:%S");?>
</li>
		</ul>
		<?php }?>

		<div class="operation">
			<?php if ($_smarty_tpl->tpl_vars['detail_orderstate']->value==6&&$_smarty_tpl->tpl_vars['detail_expDate']->value!=0) {?>
			<small>或者：</small><a class="btn sh" href="javascript:;">确认收货</a>
			<?php } elseif ($_smarty_tpl->tpl_vars['detail_retOkdate']->value!=0) {?>
			<!-- <a class="btn" href="javascript:;">退款去向</a> -->
			<?php }?>
		</div>
	</dd>
	<?php }?>

</dl>



<?php if ($_smarty_tpl->tpl_vars['detail_orderstate']->value==1||($_smarty_tpl->tpl_vars['detail_orderstate']->value==2&&$_smarty_tpl->tpl_vars['detail_paydate']->value!=0)||($_smarty_tpl->tpl_vars['detail_orderstate']->value==6&&$_smarty_tpl->tpl_vars['detail_retState']->value==0)) {?>
<?php echo '<script'; ?>
>
var atlasSize = <?php echo $_smarty_tpl->tpl_vars['atlasSize']->value*1024;?>
;
var atlasType = '<?php echo $_smarty_tpl->tpl_vars['atlasType']->value;?>
';
var atlasMax  = 5;
<?php echo '</script'; ?>
>
<dl class="bunch-section refund"<?php if ($_smarty_tpl->tpl_vars['rates']->value==1) {?> style="display: block;"<?php }?>>
	<dt>申请退款</dt>
	<dd>
		<div class="fn-clear">
			<label for="type"><em>*</em> 退款原因：</label>
			<div class="widgt">
				<span id="typelist">
					<select id="type" name="type">
						<option value="">请选择</option>
						<?php if ($_smarty_tpl->tpl_vars['detail_product']->value['tuantype']==2) {?>
						<option value="缺货">缺货</option>
						<option value="未按约定时间发货">未按约定时间发货</option>
						<option value="协商一致退款">协商一致退款</option>
						<option value="拍错/多拍/不想要">拍错/多拍/不想要</option>
						<option value="其他">其他</option>
						<?php } else { ?>
						<option value="买多了/买错了">买多了/买错了</option>
						<option value="过期无法使用">过期无法使用</option>
						<option value="商家营业但不接待">商家营业但不接待</option>
						<option value="商家停业/装修/转让">商家停业/装修/转让</option>
						<option value="计划有变，没时间消费">计划有变，没时间消费</option>
						<option value="预约不上">预约不上</option>
						<option value="去过了，不太满意">去过了，不太满意</option>
						<option value="朋友/网上评价不好">朋友/网上评价不好</option>
						<option value="后悔了，不想要了">后悔了，不想要了</option>
						<option value="商家说可以直接以团购价到店消费">商家说可以直接以团购价到店消费</option>
						<?php }?>
					</select>
				</span>
			</div>
		</div>
		<div class="fn-clear">
			<label for="content">退款说明：</label>
			<div class="widgt">
				<div class="textarea">
					<textarea rows="5" id="content"></textarea>
					<span class="lim-count">还可输入 <strong>500</strong> 个字。</span>
				</div>
			</div>
		</div>
		<div class="fn-clear">
			<label>上传凭证：</label>
			<div class="widgt">
				<ul class="uploader-list" id="fileList"></ul>
				<div class="uploader-btn fn-clear">
					<div id="filePicker">上传图片</div>
					<span class="utip">最多传5张，按住 Ctrl 或 Shift 可选择多张</span>
				</div>
				<p class="tips">* 请上传原创、真实、合法的图片，如果发现用户上传的图片有侵权内容，网站有权先行删除</p>
			</div>
		</div>
		<div class="fn-clear">
			<label>&nbsp;</label>
			<div class="widgt">
				<button type="button" class="cbtn" id="refundBtn">提交申请</button>
			</div>
		</div>
		<?php if ($_smarty_tpl->tpl_vars['detail_product']->value['tuantype']==0) {?>
		<div class="fn-clear">
			<label>&nbsp;</label>
			<div class="widgt tk-tips">
				<h3>退款说明：</h3>
				<p>1. 退款申请成功后，退款金额会转入您的会员帐户余额；</p>
				<p>2. 退款金额跟订单金额为何不一样？您的订单中有多张团购券，您可能只退了部分团购券，已经使用过的不可以退款；</p>
			</div>
		</div>
		<?php }?>
	</dd>
</dl>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
js/ui/jquery.dragsort-0.5.1.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
js/webuploader/webuploader.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
js/tuan-refund.js"><?php echo '</script'; ?>
>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['detail_orderstate']->value==3) {?>
<?php echo '<script'; ?>
>
var rates = <?php echo $_smarty_tpl->tpl_vars['rates']->value;?>
;
var atlasSize = <?php echo $_smarty_tpl->tpl_vars['atlasSize']->value*1024;?>
;
var atlasType = '<?php echo $_smarty_tpl->tpl_vars['atlasType']->value;?>
';
var atlasMax  = <?php echo $_smarty_tpl->tpl_vars['atlasMax']->value;?>
;
<?php echo '</script'; ?>
>
<dl class="bunch-section common">
	<dt>消费评价</dt>
	<dd>
		<div class="fn-clear">
			<label>总体评价：<input type="hidden" name="rating" id="rating" value="<?php echo $_smarty_tpl->tpl_vars['detail_common']->value['rating'];?>
" /></label>
			<div class="widgt">
				<div class="pingfen" data-sync="rating">
					<div class="pingfen_selected" style="width: <?php echo smarty_function_math(array('equation'=>"x * y",'x'=>$_smarty_tpl->tpl_vars['detail_common']->value['rating'],'y'=>20),$_smarty_tpl);?>
%;"></div>
				</div>
				<span class="pingfen_tip">请选择评分</span>
			</div>
		</div>
		<div class="fn-clear">
			<label>描述：<input type="hidden" name="score1" id="score1" value="<?php echo $_smarty_tpl->tpl_vars['detail_common']->value['score1'];?>
" /></label>
			<div class="widgt">
				<div class="pingfen" data-sync="score1">
					<div class="pingfen_selected" style="width: <?php echo smarty_function_math(array('equation'=>"x * y",'x'=>$_smarty_tpl->tpl_vars['detail_common']->value['score1'],'y'=>20),$_smarty_tpl);?>
%;"></div>
				</div>
				<span class="pingfen_tip">请选择评分</span>
			</div>
		</div>
		<div class="fn-clear">
			<label>服务：<input type="hidden" name="score2" id="score2" value="<?php echo $_smarty_tpl->tpl_vars['detail_common']->value['score2'];?>
" /></label>
			<div class="widgt">
				<div class="pingfen" data-sync="score2">
					<div class="pingfen_selected" style="width: <?php echo smarty_function_math(array('equation'=>"x * y",'x'=>$_smarty_tpl->tpl_vars['detail_common']->value['score2'],'y'=>20),$_smarty_tpl);?>
%;"></div>
				</div>
				<span class="pingfen_tip">请选择评分</span>
			</div>
		</div>
		<div class="fn-clear">
			<label>环境：<input type="hidden" name="score3" id="score3" value="<?php echo $_smarty_tpl->tpl_vars['detail_common']->value['score3'];?>
" /></label>
			<div class="widgt">
				<div class="pingfen" data-sync="score3">
					<div class="pingfen_selected" style="width: <?php echo smarty_function_math(array('equation'=>"x * y",'x'=>$_smarty_tpl->tpl_vars['detail_common']->value['score3'],'y'=>20),$_smarty_tpl);?>
%;"></div>
				</div>
				<span class="pingfen_tip">请选择评分</span>
			</div>
		</div>
		<div class="fn-clear">
			<label>晒图：</label>
			<div class="widgt">
				<ul class="uploader-list" id="fileList">
					<?php if (count($_smarty_tpl->tpl_vars['detail_common']->value['pics'])>0) {?>
					<?php  $_smarty_tpl->tpl_vars['pics'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['pics']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['detail_common']->value['pics']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['pics']->key => $_smarty_tpl->tpl_vars['pics']->value) {
$_smarty_tpl->tpl_vars['pics']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['pics']->key;
?>
					<li id="WU_FILE_<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
" class="thumbnail"><img src="<?php echo changeFileSize(array('url'=>((string)$_smarty_tpl->tpl_vars['pics']->value['path']),'type'=>"small"),$_smarty_tpl);?>
" data-val="<?php echo $_smarty_tpl->tpl_vars['pics']->value['val'];?>
" data-url="<?php echo $_smarty_tpl->tpl_vars['pics']->value['path'];?>
"><div class="file-panel"><span class="cancel">×</span><span class="left">左</span><span class="right">右</span></div></li>
					<?php } ?>
					<?php }?>
				</ul>
				<div class="uploader-btn fn-clear">
					<div id="filePicker">上传图片</div>
					<span class="utip">最多传<?php echo $_smarty_tpl->tpl_vars['atlasMax']->value;?>
张，按住 Ctrl 或 Shift 可选择多张</span>
				</div>
				<p class="tips">* 请上传原创、真实、合法的图片，如果发现用户上传的图片有侵权内容，网站有权先行删除</p>
			</div>
		</div>
		<div class="fn-clear">
			<label for="commentText">评价内容：</label>
			<div class="widgt">
				<div class="textarea">
					<textarea rows="5" id="commentText"><?php echo $_smarty_tpl->tpl_vars['detail_common']->value['content'];?>
</textarea>
					<span class="lim-count">还可输入<strong>500</strong>个字。</span>
				</div>
			</div>
		</div>
		<div class="fn-clear">
			<label>&nbsp;</label>
			<div class="widgt">
				<button type="button" class="cbtn" id="commonBtn"><?php if (count($_smarty_tpl->tpl_vars['detail_common']->value)>0) {?>修改评价<?php } else { ?>发表评价<?php }?></button>
				<span class="err-tip"><?php if (count($_smarty_tpl->tpl_vars['detail_common']->value)>0) {
if ($_smarty_tpl->tpl_vars['detail_common']->value['ischeck']==0) {?>您的评价信息还在审核中。<?php } elseif ($_smarty_tpl->tpl_vars['detail_common']->value['ischeck']==2) {?>您的评价信息审核失败，请检查您的评价内容！<?php }
}?></span>
			</div>
		</div>

	</dd>
</dl>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
js/ui/jquery.dragsort-0.5.1.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
js/webuploader/webuploader.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
js/tuan-common.js"><?php echo '</script'; ?>
>
<?php }?>


<dl class="bunch-section">

	<?php if ($_smarty_tpl->tpl_vars['detail_paydate']->value!=0&&$_smarty_tpl->tpl_vars['detail_orderstate']->value!=0) {?>

	
	<?php if ($_smarty_tpl->tpl_vars['detail_product']->value['tuantype']==0) {?>
	<dt>团购券</dt>
	<dd>
		<div class="coupon-field">
			<p class="coupon-field-tip">小提示：记下或拍下团购券密码向商家出示即可消费，无需等待短信。</p>
			<?php if (count($_smarty_tpl->tpl_vars['detail_cardnum']->value)>0) {?>
			<ul>
				<?php  $_smarty_tpl->tpl_vars['cardnum'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cardnum']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['detail_cardnum']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['cardnum']->key => $_smarty_tpl->tpl_vars['cardnum']->value) {
$_smarty_tpl->tpl_vars['cardnum']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['cardnum']->key;
?>

				
				<?php $_smarty_tpl->tpl_vars['qtitle'] = new Smarty_variable('', null, 0);?>
				<?php if (count($_smarty_tpl->tpl_vars['detail_cardnum']->value)>1) {?>
				<?php $_smarty_tpl->tpl_vars['k'] = new Smarty_variable($_smarty_tpl->tpl_vars['k']->value+1, null, 0);?>
				<?php $_smarty_tpl->tpl_vars['qtitle'] = new Smarty_variable("第".((string)$_smarty_tpl->tpl_vars['k']->value)."张", null, 0);?>
				<?php }?>

				
				<?php $_smarty_tpl->tpl_vars['cla'] = new Smarty_variable('', null, 0);?>

				<?php if ($_smarty_tpl->tpl_vars['detail_orderstate']->value==7) {?>
					<?php $_smarty_tpl->tpl_vars['static'] = new Smarty_variable("<font color='#ff0000'>已退款</font>", null, 0);?>
				<?php } else { ?>
					<?php $_smarty_tpl->tpl_vars['static'] = new Smarty_variable("未使用", null, 0);?>
				<?php }?>

				<?php if ($_smarty_tpl->tpl_vars['cardnum']->value['usedate']!=0) {?>
					<?php $_smarty_tpl->tpl_vars['cla'] = new Smarty_variable(" class='invalid'", null, 0);?>
					<?php if ($_smarty_tpl->tpl_vars['cardnum']->value['expireddate']<$_smarty_tpl->tpl_vars['detail_now']->value) {?>
						<?php $_smarty_tpl->tpl_vars['static'] = new Smarty_variable("已过期", null, 0);?>
					<?php } else { ?>
						<?php $_smarty_tpl->tpl_vars['static'] = new Smarty_variable("已使用", null, 0);?>
					<?php }?>
				<?php } else { ?>
					<?php if ($_smarty_tpl->tpl_vars['cardnum']->value['expireddate']<$_smarty_tpl->tpl_vars['detail_now']->value) {?>
						<?php if ($_smarty_tpl->tpl_vars['detail_orderstate']->value==7) {?>
							<?php $_smarty_tpl->tpl_vars['static'] = new Smarty_variable("<font color='#ff0000'>已退款</font>", null, 0);?>
						<?php } else { ?>
							<?php $_smarty_tpl->tpl_vars['static'] = new Smarty_variable("<font color='#ff0000'>未使用 已过期</font>", null, 0);?>
						<?php }?>
					<?php }?>
				<?php }?>

				<li<?php echo $_smarty_tpl->tpl_vars['cla']->value;?>
><?php echo $_smarty_tpl->tpl_vars['qtitle']->value;?>
团购券密码：<?php echo $_smarty_tpl->tpl_vars['cardnum']->value['cardnum'];?>
<span><?php echo $_smarty_tpl->tpl_vars['static']->value;?>
</span></li>

				<?php } ?>
			</ul>
			<?php } else { ?>
			<p>团购券不存在！</p>
			<?php }?>
		</div>
	</dd>

	
	<?php } elseif ($_smarty_tpl->tpl_vars['detail_product']->value['tuantype']==1) {?>
	<dt>充值卡</dt>
	<dd>
		<div class="coupon-field">
			<p class="coupon-field-tip">小提示：请到会员充值中心，选择充值卡充值，输入下方充值卡密码，即可完成充值。</p>
			<?php if (count($_smarty_tpl->tpl_vars['detail_cardnum']->value)>0) {?>
			<ul>
				<?php  $_smarty_tpl->tpl_vars['cardnum'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cardnum']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['detail_cardnum']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['cardnum']->key => $_smarty_tpl->tpl_vars['cardnum']->value) {
$_smarty_tpl->tpl_vars['cardnum']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['cardnum']->key;
?>

				<?php $_smarty_tpl->tpl_vars['qtitle'] = new Smarty_variable('', null, 0);?>
				<?php if (count($_smarty_tpl->tpl_vars['detail_cardnum']->value)>1) {?>
				<?php $_smarty_tpl->tpl_vars['k'] = new Smarty_variable($_smarty_tpl->tpl_vars['k']->value+1, null, 0);?>
				<?php $_smarty_tpl->tpl_vars['qtitle'] = new Smarty_variable("第".((string)$_smarty_tpl->tpl_vars['k']->value)."张", null, 0);?>
				<?php }?>

				
				<?php $_smarty_tpl->tpl_vars['cla'] = new Smarty_variable('', null, 0);?>
				<?php $_smarty_tpl->tpl_vars['static'] = new Smarty_variable("未使用", null, 0);?>
				<?php if ($_smarty_tpl->tpl_vars['cardnum']->value['usedate']!=0&&$_smarty_tpl->tpl_vars['cardnum']->value['expireddate']<$_smarty_tpl->tpl_vars['detail_now']->value) {?>
					<?php $_smarty_tpl->tpl_vars['cla'] = new Smarty_variable(" class='invalid'", null, 0);?>
					<?php if ($_smarty_tpl->tpl_vars['cardnum']->value['expireddate']<$_smarty_tpl->tpl_vars['detail_now']->value) {?>
						<?php $_smarty_tpl->tpl_vars['static'] = new Smarty_variable("已过期", null, 0);?>
					<?php } else { ?>
						<?php $_smarty_tpl->tpl_vars['static'] = new Smarty_variable("已使用", null, 0);?>
					<?php }?>
				<?php } else { ?>
					<?php if ($_smarty_tpl->tpl_vars['cardnum']->value['expireddate']<$_smarty_tpl->tpl_vars['detail_now']->value) {?>
						<?php $_smarty_tpl->tpl_vars['static'] = new Smarty_variable("<font color='#ff0000'>未使用 已过期</font>", null, 0);?>
					<?php }?>
				<?php }?>

				<li<?php echo $_smarty_tpl->tpl_vars['cla']->value;?>
><?php echo $_smarty_tpl->tpl_vars['qtitle']->value;?>
团购券密码：<?php echo $_smarty_tpl->tpl_vars['cardnum']->value['cardnum'];?>
<span><?php echo $_smarty_tpl->tpl_vars['static']->value;?>
</span></li>

				<?php } ?>
			</ul>
			<?php } else { ?>
			<p>充值卡不存在！</p>
			<?php }?>
		</div>
	</dd>
	<?php }?>

	<?php }?>

	<dt>订单信息</dt>
	<dd>
		<ul class="flow-list fn-clear">
			<li>订单编号：<?php echo $_smarty_tpl->tpl_vars['detail_ordernum']->value;?>
</li>
			<li>下单时间：<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['detail_orderdate']->value,"%Y-%m-%d %H:%M:%S");?>
</li>
			
			<?php if ($_smarty_tpl->tpl_vars['detail_paydate']->value!=0) {?>
			<li>付款方式：<?php echo $_smarty_tpl->tpl_vars['detail_paytype']->value;?>
</li>
			<li>付款时间：<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['detail_paydate']->value,"%Y-%m-%d %H:%M:%S");?>
</li>
			<?php }?>
		</ul>
	</dd>

	<?php if ($_smarty_tpl->tpl_vars['detail_product']->value['tuantype']==2) {?>
	<dt>配送信息</dt>
	<dd>
		<ul class="order-address">
			<li>收货人：<?php echo $_smarty_tpl->tpl_vars['detail_username']->value;?>
</li>
			<li>联系电话：<?php echo $_smarty_tpl->tpl_vars['detail_usercontact']->value;?>
</li>
			<li>送货地址：<?php echo $_smarty_tpl->tpl_vars['detail_useraddr']->value;?>
</li>
			<li>送货时间：
			<?php if ($_smarty_tpl->tpl_vars['detail_deliveryType']->value==1) {?>
			只工作日送货(双休日、假日不用送，写字楼/商用地址客户请选择)
			<?php } elseif ($_smarty_tpl->tpl_vars['detail_deliveryType']->value==2) {?>
			只双休日、假日送货(工作日不用送)
			<?php } elseif ($_smarty_tpl->tpl_vars['detail_deliveryType']->value==3) {?>
			学校地址/地址白天没人，请尽量安排其它时间送货 (特别安排可能会超出预计送货天数)
			<?php } elseif ($_smarty_tpl->tpl_vars['detail_deliveryType']->value==4) {?>
			工作日、双休日与假日均可送货
			<?php }?>
			</li>
			<li>配送说明：<?php echo $_smarty_tpl->tpl_vars['detail_usernote']->value;?>
</li>
		</ul>
		<?php if ($_smarty_tpl->tpl_vars['detail_orderstate']->value==0||($_smarty_tpl->tpl_vars['detail_orderstate']->value==1&&$_smarty_tpl->tpl_vars['detail_now']->value-$_smarty_tpl->tpl_vars['detail_paydate']->value<3600)) {?>
		<a href="javascript:;" class="editAddr">修改配送信息</a>

		<?php echo '<script'; ?>
>
		var oid = <?php echo $_smarty_tpl->tpl_vars['id']->value;?>
;
		<?php echo '</script'; ?>
>

		<!-- 修改配送信息 -->
		<div class="delivery" data-action="/include/ajax.php?service=tuan&action=editOrderAddr">
			<h4>收货地址<a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'address'),$_smarty_tpl);?>
" target="_blank">管理收货地址</a></h4>
			<ul class="radlist" id="delivery">
				<?php $_smarty_tpl->smarty->_tag_stack[] = array('member', array('action'=>"address")); $_block_repeat=true; echo member(array('action'=>"address"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>


				<?php $_smarty_tpl->tpl_vars['useraddress'] = new Smarty_variable(($_smarty_tpl->tpl_vars['row']->value['addrname']).($_smarty_tpl->tpl_vars['row']->value['address']), null, 0);?>
				<?php $_smarty_tpl->tpl_vars['contact'] = new Smarty_variable('', null, 0);?>
				<?php if ($_smarty_tpl->tpl_vars['row']->value['mobile']!='') {
$_smarty_tpl->tpl_vars['contact'] = new Smarty_variable($_smarty_tpl->tpl_vars['row']->value['mobile'], null, 0);
}?>
				<?php if ($_smarty_tpl->tpl_vars['row']->value['mobile']!=''&&$_smarty_tpl->tpl_vars['row']->value['tel']!='') {
$_smarty_tpl->tpl_vars['contact'] = new Smarty_variable((($_smarty_tpl->tpl_vars['contact']->value).(" / ")).($_smarty_tpl->tpl_vars['row']->value['tel']), null, 0);
} elseif ($_smarty_tpl->tpl_vars['row']->value['mobile']==''&&$_smarty_tpl->tpl_vars['row']->value['tel']!='') {
$_smarty_tpl->tpl_vars['contact'] = new Smarty_variable($_smarty_tpl->tpl_vars['row']->value['tel'], null, 0);
}?>

				<li<?php if (($_smarty_tpl->tpl_vars['_bindex']->value['row']==1&&$_smarty_tpl->tpl_vars['detail_useraddr']->value=='')||($_smarty_tpl->tpl_vars['detail_useraddr']->value==$_smarty_tpl->tpl_vars['useraddress']->value&&$_smarty_tpl->tpl_vars['detail_username']->value==$_smarty_tpl->tpl_vars['row']->value['person']&&$_smarty_tpl->tpl_vars['detail_usercontact']->value==$_smarty_tpl->tpl_vars['contact']->value)) {?> class="selected"<?php }?>>
					<s></s>
					<input type="radio" name="addressid" id="address_<?php echo $_smarty_tpl->tpl_vars['row']->value['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['id'];?>
"<?php if (($_smarty_tpl->tpl_vars['_bindex']->value['row']==1&&$_smarty_tpl->tpl_vars['detail_useraddr']->value=='')||($_smarty_tpl->tpl_vars['detail_useraddr']->value==$_smarty_tpl->tpl_vars['useraddress']->value&&$_smarty_tpl->tpl_vars['detail_username']->value==$_smarty_tpl->tpl_vars['row']->value['person']&&$_smarty_tpl->tpl_vars['detail_usercontact']->value==$_smarty_tpl->tpl_vars['contact']->value)) {?> checked<?php }?> />
					<label for="address_<?php echo $_smarty_tpl->tpl_vars['row']->value['id'];?>
"><s></s><?php echo $_smarty_tpl->tpl_vars['row']->value['person'];?>
，<?php echo (($_smarty_tpl->tpl_vars['row']->value['addrname']).(" ")).($_smarty_tpl->tpl_vars['row']->value['address']);?>
，<?php echo $_smarty_tpl->tpl_vars['contact']->value;?>
</label>
				</li>
				<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo member(array('action'=>"address"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

				<?php if ($_smarty_tpl->tpl_vars['row']->value) {?>
				<li>
					<s></s>
					<input type="radio" name="addressid" id="address_0" value="0" />
					<label for="address_0"><s></s>使用其它地址</label>
				</li>
				<?php }?>
			</ul>
			<div class="address-field"<?php if (!$_smarty_tpl->tpl_vars['row']->value) {?> style="display: block;"<?php }?>>
				<div class="formfield">
					<label for="addrid"><em>*</em> 所在区域：</label>
					<span id="addrlist">
						<select id="addrid" name="addrid[]">
							<option value="0">请选择区域</option>
							<?php $_smarty_tpl->smarty->_tag_stack[] = array('siteConfig', array('action'=>"addr",'return'=>"addr",'son'=>"0")); $_block_repeat=true; echo siteConfig(array('action'=>"addr",'return'=>"addr",'son'=>"0"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

							<option value="<?php echo $_smarty_tpl->tpl_vars['addr']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['addr']->value['typename'];?>
</option>
							<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo siteConfig(array('action'=>"addr",'return'=>"addr",'son'=>"0"), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

						</select>
					</span>
					<span class="input-tips"><s></s>请选择区域</span>
				</div>
				<div class="formfield">
					<label for="address"><em>*</em> 街道地址：</label>
					<input type="text" name="address" id="address" size="50" maxlength="60" />
					<span class="input-tips"><s></s>请填写街道地址，最少5个字，最多不能超过60个字，不能全部为数字</span>
				</div>
				<div class="formfield">
					<label for="person"><em>*</em> 收货人姓名：</label>
					<input type="text" name="person" id="person" size="20" maxlength="10" />
					<span class="input-tips"><s></s>请正确填写姓名，最少不能低于2个字，最多不能超过15个字</span>
				</div>
				<div class="formfield">
					<label for="mobile">手机号码：</label>
					<input type="text" name="mobile" id="mobile" size="20" maxlength="11" />
					<span class="input-tips" style="display: inline-block;"><s></s>手机号码和固定电话最少填写一项</span>
				</div>
				<div class="formfield">
					<label for="tel">固定电话：</label>
					<input type="text" name="tel" id="tel" size="20" maxlength="20" />
					<span class="input-tips"><s></s>手机号码和固定电话最少填写一项</span>
				</div>
			</div>
			<h4>希望送货时间</h4>
			<ul class="radlist">
				<li<?php if ($_smarty_tpl->tpl_vars['detail_deliveryType']->value==1||$_smarty_tpl->tpl_vars['detail_deliveryType']->value==0) {?> class="selected"<?php }?>>
					<input type="radio" name="deliveryType" id="deliveryType_1" value="1"<?php if ($_smarty_tpl->tpl_vars['detail_deliveryType']->value==1||$_smarty_tpl->tpl_vars['detail_deliveryType']->value==0) {?> checked<?php }?> />
					<label for="deliveryType_1"><s></s>只工作日送货(双休日、假日不用送，写字楼/商用地址客户请选择)</label>
				</li>
				<li<?php if ($_smarty_tpl->tpl_vars['detail_deliveryType']->value==2) {?> class="selected"<?php }?>>
					<input type="radio" name="deliveryType" id="deliveryType_2" value="2"<?php if ($_smarty_tpl->tpl_vars['detail_deliveryType']->value==2) {?> checked<?php }?> />
					<label for="deliveryType_2"><s></s>只双休日、假日送货(工作日不用送)</label>
				</li>
				<li<?php if ($_smarty_tpl->tpl_vars['detail_deliveryType']->value==3) {?> class="selected"<?php }?>>
					<input type="radio" name="deliveryType" id="deliveryType_3" value="3"<?php if ($_smarty_tpl->tpl_vars['detail_deliveryType']->value==3) {?> checked<?php }?> />
					<label for="deliveryType_3"><s></s>学校地址/地址白天没人，请尽量安排其它时间送货 (特别安排可能会超出预计送货天数)</label>
				</li>
				<li<?php if ($_smarty_tpl->tpl_vars['detail_deliveryType']->value==4) {?> class="selected"<?php }?>>
					<input type="radio" name="deliveryType" id="deliveryType_4" value="4"<?php if ($_smarty_tpl->tpl_vars['detail_deliveryType']->value==4) {?> checked<?php }?> />
					<label for="deliveryType_4"><s></s>工作日、双休日与假日均可送货</label>
				</li>
			</ul>

			<h4>配送说明<span>（快递公司由商家根据情况选择，请不要指定。其他要求会尽量协调）</span></h4>
			<input type="text" class="comment" name="comment" size="70" value="<?php echo $_smarty_tpl->tpl_vars['detail_usernote']->value;?>
" />

			<div class="btns">
				<button type="button" class="cbtn" id="addrBtn">确认修改</button>
				<a href="javascript:;" class="cancel">取消</a>
			</div>
		</div>
		<?php }?>
	</dd>
	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
js/tuan-editaddr.js"><?php echo '</script'; ?>
>
	<?php }?>

	<?php if (($_smarty_tpl->tpl_vars['detail_orderstate']->value==3||$_smarty_tpl->tpl_vars['detail_orderstate']->value==4||$_smarty_tpl->tpl_vars['detail_orderstate']->value==6||$_smarty_tpl->tpl_vars['detail_orderstate']->value==7)&&$_smarty_tpl->tpl_vars['detail_expDate']->value!=0) {?>
	<dt>快递信息</dt>
	<dd>
		<ul class="flow-list fn-clear">
			<li>快递公司：<?php echo $_smarty_tpl->tpl_vars['detail_expCompany']->value;?>
</li>
			<li>快递单号：<?php echo $_smarty_tpl->tpl_vars['detail_expNumber']->value;?>
</li>
			<li>发货时间：<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['detail_expDate']->value,"%Y-%m-%d %H:%M:%S");?>
</li>
			<li>物流跟踪：<a href="https://www.baidu.com/s?wd=<?php echo $_smarty_tpl->tpl_vars['detail_expCompany']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['detail_expNumber']->value;?>
" target="_blank" style="color:#027cff;">点击查看详细</a></li>
		</ul>
	</dd>
	<?php }?>

	<dt>卖家信息</dt>
	<dd>
		<ul class="order-address">
			<li>公司名称：<?php echo $_smarty_tpl->tpl_vars['detail_store']->value['member']['nickname'];?>
</li>
			<li>公司地址：<?php echo $_smarty_tpl->tpl_vars['detail_store']->value['addrname'][0];?>
 <?php echo $_smarty_tpl->tpl_vars['detail_store']->value['addrname'][1];?>
 <?php echo $_smarty_tpl->tpl_vars['detail_store']->value['address'];?>
</li>
			<li>联系电话：<?php echo $_smarty_tpl->tpl_vars['detail_store']->value['tel'];?>
</li>
			<li>营业时间：<?php echo $_smarty_tpl->tpl_vars['detail_store']->value['openStart'];?>
 - <?php echo $_smarty_tpl->tpl_vars['detail_store']->value['openEnd'];?>
</li>
		</ul>
	</dd>

	<dt>团购信息</dt>
	<dd>
		<table class="info-table">
			<tbody>
				<tr>
					<th class="left">团购项目</th>
					<th width="100">单价</th>
					<th width="10"></th>
					<th width="100">数量</th>
					<?php if ($_smarty_tpl->tpl_vars['detail_product']->value['tuantype']==2) {?>
					<th width="10"></th>
					<th width="100">运费</th>
					<?php }?>
					<th width="10"></th>
					<th width="200"><?php if ($_smarty_tpl->tpl_vars['detail_paydate']->value==0) {?>订单<?php } else { ?>支付<?php }?>金额</th>
				</tr>
				<tr>
					<td class="left"><a class="deal-title" href="<?php echo $_smarty_tpl->tpl_vars['detail_product']->value['url'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['detail_product']->value['title'];?>
</a></td>
					<td><span class="money">&yen;</span><?php echo $_smarty_tpl->tpl_vars['detail_orderprice']->value;?>
</td>
					<td>x</td>
					<td><?php echo $_smarty_tpl->tpl_vars['detail_procount']->value;?>
</td>
					<?php if ($_smarty_tpl->tpl_vars['detail_product']->value['tuantype']==2) {?>
					<td>+</td>
					<td><?php echo $_smarty_tpl->tpl_vars['detail_freight']->value;?>
</td>
					<?php }?>
					<td>=</td>
					<td class="total"><span class="money">&yen;</span><?php echo $_smarty_tpl->tpl_vars['detail_totalmoney']->value;?>
</td>
				</tr>
			</tbody>
		</table>
		<?php if ($_smarty_tpl->tpl_vars['detail_paydate']->value!=0&&($_smarty_tpl->tpl_vars['detail_point']->value>0||$_smarty_tpl->tpl_vars['detail_balance']->value>0||$_smarty_tpl->tpl_vars['detail_payprice']->value>0)) {?>
		<p class="paydetail">其中：使用
		<?php if ($_smarty_tpl->tpl_vars['detail_point']->value>0) {?>
		【<?php echo $_smarty_tpl->tpl_vars['detail_point']->value;
echo $_smarty_tpl->tpl_vars['cfg_pointName']->value;?>
 = <?php echo $_smarty_tpl->tpl_vars['detail_point']->value/$_smarty_tpl->tpl_vars['cfg_pointRatio']->value;?>
元】
		<?php }?>

		<?php if ($_smarty_tpl->tpl_vars['detail_balance']->value>0) {?>
		【&yen;<?php echo $_smarty_tpl->tpl_vars['detail_balance']->value;?>
余额】
		<?php }?>

		<?php if ($_smarty_tpl->tpl_vars['detail_payprice']->value>0) {?>
		单独支付【&yen;<?php echo $_smarty_tpl->tpl_vars['detail_payprice']->value;?>
】
		<?php }?>
		</p>
		<?php }?>
	</dd>
</dl>
<?php }} ?>
