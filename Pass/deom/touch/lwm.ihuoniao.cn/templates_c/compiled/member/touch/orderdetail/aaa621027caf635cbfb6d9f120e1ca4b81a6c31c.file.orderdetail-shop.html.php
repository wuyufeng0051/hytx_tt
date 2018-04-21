<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-05-24 11:08:22
         compiled from "D:\ServerWwwroot\www.lwm.com\templates\member\touch\orderdetail-shop.html" */ ?>
<?php /*%%SmartyHeaderCode:217015924f9265dceb4-33582615%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'aaa621027caf635cbfb6d9f120e1ca4b81a6c31c' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\templates\\member\\touch\\orderdetail-shop.html',
      1 => 1494490906,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '217015924f9265dceb4-33582615',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'detail_orderstate' => 0,
    'detail_retState' => 0,
    'detail_expDate' => 0,
    'stateInfo' => 0,
    'detail_retOkdate' => 0,
    'detail_paydate' => 0,
    'detail_retType' => 0,
    'detail_retNote' => 0,
    'detail_retPics' => 0,
    'pics' => 0,
    'detail_retDate' => 0,
    'detail_retSnote' => 0,
    'detail_retSpics' => 0,
    'detail_retSdate' => 0,
    'detail_expCompany' => 0,
    'detail_expNumber' => 0,
    'detail_username' => 0,
    'detail_usercontact' => 0,
    'detail_useraddr' => 0,
    'detail_note' => 0,
    'detail_product' => 0,
    'detail_store' => 0,
    'product' => 0,
    'detail_payurl' => 0,
    'id' => 0,
    'detail_common' => 0,
    'cfg_pointName' => 0,
    'cfg_pointRatio' => 0,
    'detail_totalPayPrice' => 0,
    'detail_ordernum' => 0,
    'detail_orderdate' => 0,
    'detail_paytype' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5924f9266698e3_02972528',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5924f9266698e3_02972528')) {function content_5924f9266698e3_02972528($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'D:\\ServerWwwroot\\www.lwm.com\\include\\tpl\\plugins\\modifier.date_format.php';
?>
<?php $_smarty_tpl->tpl_vars['stateInfo'] = new Smarty_variable('', null, 0);?>
<?php if ($_smarty_tpl->tpl_vars['detail_orderstate']->value==0) {?>
	<?php $_smarty_tpl->tpl_vars['stateInfo'] = new Smarty_variable("未付款", null, 0);?>
<?php } elseif ($_smarty_tpl->tpl_vars['detail_orderstate']->value==1) {?>
	<?php $_smarty_tpl->tpl_vars['stateInfo'] = new Smarty_variable("等待发货", null, 0);?>
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
<?php } elseif ($_smarty_tpl->tpl_vars['detail_orderstate']->value==10) {?>
	<?php $_smarty_tpl->tpl_vars['stateInfo'] = new Smarty_variable("关闭", null, 0);?>
<?php }?>
	<dl class="info-section">
		<dt>
			<span class="info-title">当前订单状态：</span><em class="info-text"><?php echo $_smarty_tpl->tpl_vars['stateInfo']->value;?>
</em>
			<?php if ($_smarty_tpl->tpl_vars['detail_orderstate']->value==7) {?>
			&nbsp;&nbsp;退款时间：<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['detail_retOkdate']->value,"%Y-%m-%d %H:%M:%S");?>

			<?php }?>
		</dt>

		
		<?php if ($_smarty_tpl->tpl_vars['detail_orderstate']->value==0) {?>
		<dd class="last">
			<p>请您尽快付款，若未及时付款，系统将自动取消订单！</p>
		</dd>
		<?php }?>

		
		<?php if ($_smarty_tpl->tpl_vars['detail_orderstate']->value==1) {?>
		<dd class="last">
			<p>卖家发货前，您支付的钱款不会被打给卖家，请耐心等待卖家发货！</p>
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
					<div class="picbox">
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
					</div>
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


	<?php if (($_smarty_tpl->tpl_vars['detail_orderstate']->value==3||$_smarty_tpl->tpl_vars['detail_orderstate']->value==4||$_smarty_tpl->tpl_vars['detail_orderstate']->value==6||$_smarty_tpl->tpl_vars['detail_orderstate']->value==7)&&$_smarty_tpl->tpl_vars['detail_expDate']->value!=0) {?>
	<div class="info-block">
		<div class="info-title">快递信息</div>
		<div class="info-content">
			<dl><dt>快递公司：</dt><dd><?php echo $_smarty_tpl->tpl_vars['detail_expCompany']->value;?>
</dd></dl>
			<dl><dt>快递公司：</dt><dd><?php echo $_smarty_tpl->tpl_vars['detail_expNumber']->value;?>
</dd></dl>
			<dl><dt>发货时间：</dt><dd><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['detail_expDate']->value,"%Y-%m-%d %H:%M:%S");?>
</dd></dl>
			<dl><dt>物流跟踪：</dt><dd><a href="https://www.baidu.com/s?wd=<?php echo $_smarty_tpl->tpl_vars['detail_expCompany']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['detail_expNumber']->value;?>
" target="_blank" style="color:#027cff;">点击查看详细</a></dd></dl>
		</div>
	</div>
	<?php }?>


	
	<?php if ($_smarty_tpl->tpl_vars['detail_orderstate']->value==1||($_smarty_tpl->tpl_vars['detail_orderstate']->value==2&&$_smarty_tpl->tpl_vars['detail_paydate']->value!=0)||($_smarty_tpl->tpl_vars['detail_orderstate']->value==6&&$_smarty_tpl->tpl_vars['detail_retState']->value==0)) {?>
	<div class="layer">
		<div class="top fn-clear">
      <div class="top-l" id="typeback"><a href="javascript:;">返回</a></div>
			<div class="top-c">申请退款</div>
			<div class="top-r"></div>
    </div>
		<div class="fn-clear">
	    <div class="imgbox">
	      <div class="addimg">
	        <ul class="fn-clear noimg" id="litpic">
	          <li class="add"><div id="filePicker" class="btn"></div></li>
	        </ul>
	      </div>
	    </div>
	    <p class="uploader-btn"></p>
	  </div>
    <dl class="inpbox">
      <dt><span>退款原因</span></dt>
      <dd class="selgroup">
        <select id="type" name="type">
					<option value="">请选择</option>
					<option value="缺货">缺货</option>
					<option value="未按约定时间发货">未按约定时间发货</option>
					<option value="协商一致退款">协商一致退款</option>
					<option value="拍错/多拍/不想要">拍错/多拍/不想要</option>
					<option value="其他">其他</option>
        </select>
      </dd>
      <input type="hidden" name="typeid" id="typeid" value="">
    </dl>
    <dl class="inpbox">
      <dt><span>退款说明</span></dt>
      <dd><textarea placeholder="" name="" class="textarea" id="textarea"></textarea></dd>
    </dl>
		<div class="submit">
			<a href="javascript:;" id="submit">提交申请</a>
		</div>
		<div class="error"></div>
	</div>
	<?php }?>

  <div class="info-block">
    <div class="info-title">联系信息</div>
    <div class="info-content">
    	<dl><dt>收&nbsp;&nbsp;货&nbsp;人：</dt><dd><?php echo $_smarty_tpl->tpl_vars['detail_username']->value;?>
</dd></dl>
    	<dl><dt>联系电话：</dt><dd><?php echo $_smarty_tpl->tpl_vars['detail_usercontact']->value;?>
</dd></dl>
    	<dl><dt>送货地址：</dt><dd><?php echo $_smarty_tpl->tpl_vars['detail_useraddr']->value;?>
</dd></dl>
    	<dl><dt>买家留言：</dt><dd><?php echo $_smarty_tpl->tpl_vars['detail_note']->value;?>
</dd></dl>
    </div>
  </div>

  <div class="info-block">
  	<div class="info-title">购买信息</div>
  	<div class="shop-pro">
  		<?php  $_smarty_tpl->tpl_vars["product"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["product"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['detail_product']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["product"]->key => $_smarty_tpl->tpl_vars["product"]->value) {
$_smarty_tpl->tpl_vars["product"]->_loop = true;
?>
      <div class="item" data-id="103">
        <div class="domain fn-clear">
					<?php if ($_smarty_tpl->tpl_vars['detail_store']->value) {?>
					<a href="<?php echo $_smarty_tpl->tpl_vars['detail_store']->value['domain'];?>
" class="name fn-left"><?php echo $_smarty_tpl->tpl_vars['detail_store']->value['title'];?>
</a>
					<?php } else { ?>
          <a href="javascript:;" class="name fn-left">官方直营</a>
					<?php }?>
        </div>
        <div class="info fn-clear">
          <div class="imgbox fn-left">
            <a href="<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['product']->value['id'];?>
<?php $_tmp1=ob_get_clean();?><?php echo getUrlPath(array('service'=>'shop','template'=>'detail','id'=>$_tmp1),$_smarty_tpl);?>
"><img src="<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['product']->value['litpic'];?>
<?php $_tmp2=ob_get_clean();?><?php echo changeFileSize(array('url'=>$_tmp2,'type'=>'small'),$_smarty_tpl);?>
" alt=""></a>
          </div>
          <div class="txtbox">
            <div class="title"><p><?php echo $_smarty_tpl->tpl_vars['product']->value['title'];?>
</p><span>&yen;<?php echo $_smarty_tpl->tpl_vars['product']->value['price'];?>
</span></div>
          </div>
					<?php if ($_smarty_tpl->tpl_vars['detail_orderstate']->value==1||($_smarty_tpl->tpl_vars['detail_orderstate']->value==2&&$_smarty_tpl->tpl_vars['detail_paydate']->value!=0)||($_smarty_tpl->tpl_vars['detail_orderstate']->value==6&&$_smarty_tpl->tpl_vars['detail_retState']->value==0)) {?>
          <div class="opbtn">
            <a href="javascript:;" class="gray apply-refund-link">退款</a>
          </div>
					<?php }?>
					<?php if ($_smarty_tpl->tpl_vars['detail_orderstate']->value==0) {?>
					<div class="opbtn">
            <a href="<?php echo $_smarty_tpl->tpl_vars['detail_payurl']->value;?>
" class="gray apply-refund-link">付款</a>
          </div>
					<?php }?>
					<?php if ($_smarty_tpl->tpl_vars['detail_orderstate']->value==3) {?>
					<div class="opbtn">
            <a href="<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['id']->value;?>
<?php $_tmp3=ob_get_clean();?><?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'write-comment','module'=>'shop','id'=>$_tmp3),$_smarty_tpl);?>
" class="gray apply-refund-link"><?php if ($_smarty_tpl->tpl_vars['detail_common']->value==1) {?>修改评价<?php } else { ?>评价<?php }?></a>
          </div>
					<?php }?>
        </div>
        <ul class="calculate">
          <li><span>数量</span><em>×<?php echo $_smarty_tpl->tpl_vars['product']->value['count'];?>
</em></li>
          <li><span>运费</span><em>&yen;<?php echo $_smarty_tpl->tpl_vars['product']->value['logistic'];?>
</em></li>
          <?php if ($_smarty_tpl->tpl_vars['product']->value['discount']!=0) {?>
  				<li><span>折扣</span><em>&yen;<?php echo $_smarty_tpl->tpl_vars['product']->value['logistic'];?>
</em></li>
  				<?php }?>

          <?php if ($_smarty_tpl->tpl_vars['detail_orderstate']->value!=0) {?>
  					<?php if ($_smarty_tpl->tpl_vars['product']->value['point']>0) {?>
            <li><span><?php echo $_smarty_tpl->tpl_vars['cfg_pointName']->value;?>
支付</span><em>-&yen;<?php echo $_smarty_tpl->tpl_vars['product']->value['point']/$_smarty_tpl->tpl_vars['cfg_pointRatio']->value;?>
</em></li>
  					<?php }?>
  					<?php if ($_smarty_tpl->tpl_vars['product']->value['balance']>0) {?>
						<li><span>余额支付</span><em>-&yen;<?php echo $_smarty_tpl->tpl_vars['product']->value['balance'];?>
</em></li>
  					<?php }?>
  				<?php }?>

        </ul>
      </div>

  		<?php } ?>
  		<div class="sum">
  			<div class="right">实付款：<font class="fn-right">&yen;<strong><?php echo $_smarty_tpl->tpl_vars['detail_totalPayPrice']->value;?>
</strong></font></span></div>
  		</div>
  	</div>
  </div>

	<?php if ($_smarty_tpl->tpl_vars['detail_store']->value) {?>
	<div class="info-block">
		<div class="info-title">商家信息</div>
		<div class="info-content">
			<dl><dt>联&nbsp;&nbsp;系&nbsp;人：</dt><dd><?php echo $_smarty_tpl->tpl_vars['detail_store']->value['people'];?>
</dd></dl>
			<dl><dt>联系电话：</dt><dd><?php echo $_smarty_tpl->tpl_vars['detail_store']->value['tel'];?>
</dd></dl>
			<dl><dt>地&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;址：</dt><dd><?php echo $_smarty_tpl->tpl_vars['detail_store']->value['address'];?>
</dd></dl>
		</div>
	</div>
	<?php }?>


	<div class="info-block">
		<div class="info-title">订单信息</div>
		<div class="info-content">
			<dl><dt>订单编号：</dt><dd><?php echo $_smarty_tpl->tpl_vars['detail_ordernum']->value;?>
</dd></dl>
			<dl><dt>下单时间：</dt><dd><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['detail_orderdate']->value,"%Y-%m-%d %H:%M:%S");?>
</dd></dl>
			<?php if ($_smarty_tpl->tpl_vars['detail_paydate']->value!=0) {?>
			<dl><dt>付款方式：</dt><dd><?php echo $_smarty_tpl->tpl_vars['detail_paytype']->value;?>
</dd></dl>
			<dl><dt>付款时间：</dt><dd><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['detail_paydate']->value,"%Y-%m-%d %H:%M:%S");?>
</dd></dl>
			<?php }?>
		</div>
	</div>
<?php }} ?>
