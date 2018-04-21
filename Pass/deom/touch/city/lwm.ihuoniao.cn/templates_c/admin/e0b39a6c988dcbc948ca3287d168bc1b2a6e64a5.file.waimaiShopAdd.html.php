<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-06-23 17:41:35
         compiled from "D:\ServerWwwroot\www.lwm.com\admin\templates\waimai\waimaiShopAdd.html" */ ?>
<?php /*%%SmartyHeaderCode:143985915182d73c043-71827403%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e0b39a6c988dcbc948ca3287d168bc1b2a6e64a5' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\admin\\templates\\waimai\\waimaiShopAdd.html',
      1 => 1498044727,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '143985915182d73c043-71827403',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5915182d90ce36_00421611',
  'variables' => 
  array (
    'cfg_soft_lang' => 0,
    'cssFile' => 0,
    'action' => 0,
    'adminPath' => 0,
    'shop_banner' => 0,
    'id' => 0,
    'sort' => 0,
    'shopname' => 0,
    'typeArr' => 0,
    'type' => 0,
    'typeid' => 0,
    'category' => 0,
    'phone' => 0,
    'address' => 0,
    'qq' => 0,
    'description' => 0,
    'coordX' => 0,
    'coordY' => 0,
    'manager' => 0,
    'status' => 0,
    'closeinfo' => 0,
    'ordervalid' => 0,
    'closeorder' => 0,
    'merchant_deliver' => 0,
    'cancelorder' => 0,
    'weeks' => 0,
    'start_time1' => 0,
    'end_time1' => 0,
    'start_time2' => 0,
    'end_time2' => 0,
    'start_time3' => 0,
    'end_time3' => 0,
    'delivery_radius' => 0,
    'delivery_area' => 0,
    'delivery_fee_mode' => 0,
    'basicprice' => 0,
    'delivery_fee' => 0,
    'delivery_fee_type' => 0,
    'delivery_fee_value' => 0,
    'service_area_data' => 0,
    'k' => 0,
    'data' => 0,
    'range_delivery_fee_value' => 0,
    'fee' => 0,
    'shop_notice' => 0,
    'shop_notice_used' => 0,
    'buy_notice' => 0,
    'linktype' => 0,
    'callshow' => 0,
    'unitshow' => 0,
    'opencomment' => 0,
    'showtype' => 0,
    'food_showtype' => 0,
    'showsales' => 0,
    'show_basicprice' => 0,
    'show_delivery' => 0,
    'show_range' => 0,
    'show_area' => 0,
    'show_delivery_service' => 0,
    'delivery_service' => 0,
    'memo_hint' => 0,
    'address_hint' => 0,
    'order_prefix' => 0,
    'paytype' => 0,
    'offline_limit' => 0,
    'pay_offline_limit' => 0,
    'preset' => 0,
    'p' => 0,
    'is_first_discount' => 0,
    'first_discount' => 0,
    'is_discount' => 0,
    'discount_value' => 0,
    'open_promotion' => 0,
    'promotions' => 0,
    'smsvalid' => 0,
    'sms_phone' => 0,
    'emailvalid' => 0,
    'email_address' => 0,
    'weixinvalid' => 0,
    'customerid' => 0,
    'auto_printer' => 0,
    'showordernum' => 0,
    'open_addservice' => 0,
    'addservice' => 0,
    'selfdefine' => 0,
    'self' => 0,
    'share_title' => 0,
    'share_pic' => 0,
    'cfg_attachment' => 0,
    'bind_print' => 0,
    'print_config' => 0,
    'print_state' => 0,
    'fencheng_foodprice' => 0,
    'fencheng_delivery' => 0,
    'fencheng_dabao' => 0,
    'fencheng_addservice' => 0,
    'fencheng_discount' => 0,
    'fencheng_promotion' => 0,
    'fencheng_firstdiscount' => 0,
    'fencheng_offline' => 0,
    'site_map_key' => 0,
    'jsFile' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5915182d90ce36_00421611')) {function content_5915182d90ce36_00421611($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $_smarty_tpl->tpl_vars['cfg_soft_lang']->value;?>
" />
<title>店铺管理</title>
<?php echo $_smarty_tpl->tpl_vars['cssFile']->value;?>

<?php echo '<script'; ?>
>
var action = "<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
", adminPath = "<?php echo $_smarty_tpl->tpl_vars['adminPath']->value;?>
", modelType = "waimai", imglist = {
    "banner": <?php echo $_smarty_tpl->tpl_vars['shop_banner']->value;?>

}
<?php echo '</script'; ?>
>
<style>
label {display: inline-block;}
.tab-content {overflow: visible;}
input, textarea, .uneditable-input {width: auto;}
input[type="radio"], input[type="checkbox"] {margin: 0 3px 0 0;}

#df_area {padding-left:20px;}
.fieldblock input {height:30px;line-height:30px;}
.selfdefineblock input {height:30px;line-height:30px;}
.rangedeliveryfeeblock input {height:30px;line-height:30px;}
.form-submit-btn {padding-left:100px;height:60px;margin-top:30px;}
.aa {display:none;}
.amap-sug-result {z-index:1051; width:500px;}
.col-sm-1 {width: 10.33333333%;}
.clear {clear:both;}
.addfield {margin-top:-10px;width:120px;height:30px;background:#27B3EF;line-height:30px;color:#ffffff;font-weight:bold;text-align:center;font-size:16px;cursor:pointer;float:left;margin-right:10px;} #filecontent {width:1000px;height:auto;margin-top:10px;}
.xxfield,.txfield,.selfdefine,.rangedeliveryfee {width:1000px;heigth:40px;background:#f5f5f5;line-height:40px;border:1px solid #eeeeee;margin-top:10px;}
.deletefield,.deleteselfdefine,.deleterangedeliveryfee {width:40px;height:40px;float:right;background:#eeeeee;color:#FF0000;font-weight:bold;line-height:40px;text-align:center;cursor:pointer;}
.save_field {margin-top:10px;width:60px;height:30px;background:#61b509;line-height:30px;color:#ffffff;font-weight:bold;text-align:center;font-size:16px;cursor:pointer;}
.map-search-result {border:1px solid #d1d1d1;width:500px;height:auto;z-index:1055;margin-top: 0px;position: absolute;background-color:#fefefe;}

.mapview {position: relative; height: 550px; background: rgb(252, 249, 242);}
.mapview .opr-bar {position: absolute; z-index: 2; width: 300px; left: 0; top: 0; bottom: 0; background: rgba(255, 255, 255, .98);}
.mapview .opr-bar .add-area {margin: 14px 20px 15px; height: 40px; border-radius: 4px; color: #fff; line-height: 40px; background-color: #2672ec; cursor: pointer; text-align: center;}
.mapview .opr-bar .con {padding: 0 20px; height: 574px; overflow-x: hidden; overflow-y: auto;}

.tool-tips,.tool-tips:hover {text-decoration:none}
.no-valid,.opr-bar .add-area,.opr-bar .area .change-input,.review-icon,.set-radius .form-control {text-align:center}
body.marker {cursor:url(/static/imgs/markerMouse.png),auto!important}
.opr-bar {position:absolute;top:0;width:300px;height:100%;z-index:999;background:#fff;cursor:auto}
.opr-bar .area:hover,.opr-bar .valid {background:#f5f5f5}
.opr-bar .title {font-size:14px;padding-left:20px;color:#6a6a6a;font-weight:700;margin-top:10px}
.edit,.edit-opr,.opr-bar .tip {font-size:12px}
.opr-bar .areas,.opr-bar .desc {padding:0 20px}
.edit {margin-top:2px;color:#4A4A4A}
.opr-bar .scroll {height:400px;overflow:auto}
.opr-bar .desc p {border-bottom:solid 1px #dedede;line-height:50px}
.opr-bar .desc input[type=text].wrong {border:1px solid red}
.opr-bar .areas h4 {padding:30px 0 0}
.opr-bar .area p {margin-bottom:4px}
.opr-bar .area {margin-top:10px;position:relative}
.opr-bar .valid .area-boder {border:1px solid #f5f5f5}
.opr-bar .valid .item-title,.opr-bar .valid .min-price,.opr-bar .valid .shipping-fee .shipping-fee-text,.opr-bar .valid:before {opacity:.5}
.opr-bar .area-boder {border:1px solid #e5e5e5;padding:16px 14px 0 20px}
.opr-bar .area.wrong {border:1px solid red}
.opr-bar .area:before {content:'';display:block;width:6px;height:100%;left:0;top:0;position:absolute}
.opr-bar .area1:before {background-color:#0f5bb0}
.opr-bar .area1 .item-title {color:#0f5bb0}
.opr-bar .item-title {margin-bottom:10px;font-weight:700}
.opr-bar .area2:before {background-color:#90c738}
.opr-bar .area2 .item-title {color:#90c738}
.opr-bar .area3:before {background-color:#05944b}
.opr-bar .area3 .item-title {color:#05944b}
.opr-bar .area4:before {background-color:#9a6b38}
.opr-bar .area4 .item-title {color:#9a6b38}
.opr-bar .area5:before {background-color:#6c553c}
.opr-bar .area5 .item-title {color:#6c553c}
.opr-bar .area6:before {background-color:#4788ee}
.opr-bar .area6 .item-title {color:#4788ee}
.opr-bar .area7:before {background-color:#b56fe7}
.opr-bar .area7 .item-title {color:#b56fe7}
.opr-bar .area8:before {background-color:#fa96cc}
.opr-bar .area8 .item-title {color:#fa96cc}
.opr-bar .area9:before {background-color:#ee4565}
.opr-bar .area9 .item-title {color:#ee4565}
.opr-bar .area10:before {background-color:#e90000}
.opr-bar .area10 .item-title {color:#e90000}
.opr-bar .area .change-input {display:inline-block;width:70px;margin:0 5px 0 25px; padding: 0; height: 25px;}
.remark-input {display:inline-block;width:140px!important;margin-left:12px}
.review-status {border-top:1px dashed #E5E5E5;padding-top:15px;color:#FFA735}
.review-status2 {color:#FF5A5A}
.review-icon {width:55px;height:17px;border:1px solid;-webkit-border-radius:8px;border-radius:8px}
.review-text {width:148px;word-break:break-all}
.mapview .opr-bar .add-area-disabled {background:#B5B5B5;cursor:not-allowed}
.opr-bar .tip {position:absolute;bottom:0;width:100%;background-color:#fafafa;color:#4a4a4a;padding:14px 16px}
.wrong {border:1px solid red}
.panel {margin:20px}
.panel-body {margin:0;padding:0}
.page-container {height:500px;position:relative}
.area i {font-style:normal;font-weight:700}
.alert-danger {padding:10px}
.poi-name {padding-top:6px;font-size:16px;color:#4a4a4a}
.poi-address {padding-bottom:5px;font-size:14px;color:#4a4a4a}
.shop-link {padding:2px 32px;line-height:34px;border:0;position:absolute;right:20px;top:21px;font-size:14px}
.panel,.set-radius {position:relative}
.tool-tips {color:#333}
.distribution-title {font-size:16px;line-height:20px;margin-left:5px;font-weight:700}
.distribution-title-tip {color:#a0a0a0;font-size:14px}
.min-price,.shipping-fee {display:inline-block;margin-bottom:18px;font-size:12px;color:#4a4a4a;padding-right:8px;margin-right:8px; line-height: 25px;}
.question-circle {color:#ccc;font-size:14px;margin:3px 0 0 6px}
.no-valid {width:42px;height:14px;line-height:14px;background-color:#ccc;color:#fff;font-size:12px;border-radius:2px;margin:3px 0 0 6px}
.new-area {margin:0 0 10px;padding:10px 0;border-top:1px dashed #E5E5E5}
.edit-type {margin-top:15px}
.set-radius {display:inline-block;width:140px;height:34px}
.set-radius .form-control:focus {border-color:#DDD}
.set-radius .add,.set-radius .minus {position:absolute;top:0;line-height:34px;width:35px;height:34px;border:1px solid #DDD;text-align:center;font-size:20px;cursor:pointer}
.set-radius .add {right:-2px;border-radius:0 4px 4px 0}
.set-radius .minus {left:0;border-radius:4px 0 0 4px}
.set-radius input[type=text] {margin-right:-1px}
.area .delete {display:none;margin:10px 0;padding:10px 0;border-top:1px dashed #E5E5E5;cursor:pointer}
.area .delete i {font-weight:lighter}
.label-radio {margin-right: 10px;}
.hover-opr {display: none;}
.area:hover .hover-opr {display: block;}

#mapview {position: absolute; left: 0; top: 0; right: 0; bottom: 0; z-index: 1;}
img {max-width: inherit;}
.set-radius .form-control {padding-left: 0; height: 23px; padding-right: 0;}
</style>
</head>

<div class="main-content">

  <div class="page-content">
    <!-- /section:settings.box -->
    <div class="page-content-area">

    <style>input[type=checkbox].ace.ace-switch.ace-switch-5+.lbl::before { content: "开启a0\a0\a0\a0\a0关闭"; }</style>
    <div class="row">
      <div class="col-sm-11">
        <form class="form-horizontal" id="shop-form" action="waimaiShopAdd.php" method="post">
          <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" />
          <div class="alert alert-danger" id="shop-form_es_" style="display:none">
            <p>请更正下列输入错误:</p>
            <ul><li>dummy</li></ul>
          </div>
          <div class="tabbable ">
            <ul class="nav nav-tabs tt" id="myTab">
              <li class="active"><a data-toggle="tab" href="#">基本信息</a></li>
              <li class=""><a data-toggle="tab" href="#">营业信息</a></li>
              <li class=""><a data-toggle="tab" href="#">外送费</a></li>
              <li class=""><a data-toggle="tab" href="#">店铺显示</a></li>
              <li class=""><a data-toggle="tab" href="#">支付方式</a></li>
              <!-- <li class=""><a data-toggle="tab" href="#">配送时间</a></li> -->
              <li class=""><a data-toggle="tab" href="#">预设选项</a></li>
              <li class=""><a data-toggle="tab" href="#">店铺活动</a></li>
              <li class=""><a data-toggle="tab" href="#">订单提醒</a></li>
              <li class=""><a data-toggle="tab" href="#">店铺图片</a></li>
              <li class=""><a data-toggle="tab" href="#">增值服务</a></li>
              <li class=""><a data-toggle="tab" href="#">自定义显示内容</a></li>
              <li class=""><a data-toggle="tab" href="#">分享店铺设置</a></li>
              <li class=""><a data-toggle="tab" href="#">打印机绑定</a></li>
              <li class=""><a data-toggle="tab" href="#">分成设置</a></li>
            </ul>
            <div class="tab-content">
                <div id="basicinfo" class="tab-pane active tt_1">
                  <div class="form-group ">
                    <label class="col-sm-1"><label for="Config_tag">编号</label></label>
                    <input class="col-sm-2" name="sort" id="Config_tag" type="text" value="<?php echo sprintf("%d",$_smarty_tpl->tpl_vars['sort']->value);?>
">
                    <span class="help-button" data-rel="popover" data-trigger="hover" data-placement="bottom" data-content="决定展示顺序，编号越大越靠前" title="" data-original-title="编号说明">
                      <span class="ace-icon fa fa-info bigger-120"></span>
                    </span>
                  </div>
                  <div class="form-group ">
                    <label class="col-sm-1"><label for="Config_shopname">店铺名称</label></label>
                    <input class="col-sm-2" size="20" maxlength="20" name="shopname" id="Config_shopname" type="text" value="<?php echo $_smarty_tpl->tpl_vars['shopname']->value;?>
">
                  </div>
                  <div class="form-group ">
                    <label class="col-sm-1"><label for="Config_type_id">店铺分类</label></label>
                    <select class="col-sm-2 chosen-select" name="typeid[]" id="Config_type_id" data-placeholder="多选" multiple="multiple" style="width:300px;">
                      <?php  $_smarty_tpl->tpl_vars['type'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['type']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['typeArr']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['type']->key => $_smarty_tpl->tpl_vars['type']->value) {
$_smarty_tpl->tpl_vars['type']->_loop = true;
?>
                      <option value="<?php echo $_smarty_tpl->tpl_vars['type']->value['id'];?>
"<?php if ($_smarty_tpl->tpl_vars['typeid']->value&&in_array($_smarty_tpl->tpl_vars['type']->value['id'],$_smarty_tpl->tpl_vars['typeid']->value)) {?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['type']->value['title'];?>
</option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group ">
                    <label class="col-sm-1"><label for="Config_category_id">行业类型</label></label>
                    <select class="col-sm-2" name="category" id="Config_category_id">
                      <option value="1"<?php if (!$_smarty_tpl->tpl_vars['category']->value||$_smarty_tpl->tpl_vars['category']->value==1) {?> selected<?php }?>>中式快餐</option>
                      <option value="2"<?php if ($_smarty_tpl->tpl_vars['category']->value==2) {?> selected<?php }?>>便利店</option>
                      <option value="3"<?php if ($_smarty_tpl->tpl_vars['category']->value==3) {?> selected<?php }?>>饮品</option>
                      <option value="4"<?php if ($_smarty_tpl->tpl_vars['category']->value==4) {?> selected<?php }?>>水果</option>
                      <option value="5"<?php if ($_smarty_tpl->tpl_vars['category']->value==5) {?> selected<?php }?>>甜品</option>
                      <option value="6"<?php if ($_smarty_tpl->tpl_vars['category']->value==6) {?> selected<?php }?>>零食</option>
                      <option value="7"<?php if ($_smarty_tpl->tpl_vars['category']->value==7) {?> selected<?php }?>>蛋糕面包</option>
                      <option value="8"<?php if ($_smarty_tpl->tpl_vars['category']->value==8) {?> selected<?php }?>>生活服务</option>
                      <option value="9"<?php if ($_smarty_tpl->tpl_vars['category']->value==9) {?> selected<?php }?>>西式快餐</option>
                      <option value="10"<?php if ($_smarty_tpl->tpl_vars['category']->value==10) {?> selected<?php }?>>粉面小吃</option>
                      <option value="11"<?php if ($_smarty_tpl->tpl_vars['category']->value==11) {?> selected<?php }?>>夜宵</option>
                      <option value="12"<?php if ($_smarty_tpl->tpl_vars['category']->value==12) {?> selected<?php }?>>日韩料理</option>
                      <option value="13"<?php if ($_smarty_tpl->tpl_vars['category']->value==13) {?> selected<?php }?>>火锅</option>
                      <option value="14"<?php if ($_smarty_tpl->tpl_vars['category']->value==14) {?> selected<?php }?>>自助餐</option>
                      <option value="15"<?php if ($_smarty_tpl->tpl_vars['category']->value==15) {?> selected<?php }?>>烧烤</option>
                      <option value="16"<?php if ($_smarty_tpl->tpl_vars['category']->value==16) {?> selected<?php }?>>海鲜</option>
                      <option value="17"<?php if ($_smarty_tpl->tpl_vars['category']->value==17) {?> selected<?php }?>>咖啡</option>
                      <option value="18"<?php if ($_smarty_tpl->tpl_vars['category']->value==18) {?> selected<?php }?>>下午茶</option>
                    </select>
                  </div>
                  <div class="form-group ">
                    <label class="col-sm-1"><label for="Config_orderphone">联系电话</label></label>
                    <input class="col-sm-2" name="phone" id="Config_orderphone" type="text" maxlength="20" value="<?php echo $_smarty_tpl->tpl_vars['phone']->value;?>
">
                  </div>
                  <div class="form-group ">
                    <label class="col-sm-1"><label for="Config_shopaddress">店铺地址</label></label>
                    <textarea class="col-sm-3" rows="5" name="address" id="Config_shopaddress"><?php echo $_smarty_tpl->tpl_vars['address']->value;?>
</textarea>
                  </div>
                  <div class="form-group ">
                    <label class="col-sm-1"><label for="Config_QQ">QQ</label></label>
                    <input class="col-sm-2" name="qq" id="Config_QQ" type="text" maxlength="16" value="<?php echo $_smarty_tpl->tpl_vars['qq']->value;?>
">
                  </div>
                  <div class="form-group ">
                    <label class="col-sm-1"><label for="Config_shopdes">店铺描述</label></label>
                    <textarea class="col-sm-3" rows="5" name="description" id="Config_shopdes"><?php echo $_smarty_tpl->tpl_vars['description']->value;?>
</textarea>
                  </div>
                  <div class="form-group ">
                    <label class="col-sm-1"><label for="Config_coordinate_x">店铺纬度</label></label>
                    <input class="col-sm-2" id="coordinate_x_" name="coordX" type="text" value="<?php echo $_smarty_tpl->tpl_vars['coordX']->value;?>
">&nbsp;&nbsp;
                    <a href="javascript:;" role="button" class="btn btn-sm btn-success" id="markMap">自动获取经纬度</a></div>
                  <div class="form-group ">
                    <label class="col-sm-1"><label for="Config_coordinate_y">店铺经度</label></label>
                    <input class="col-sm-2" id="coordinate_y_" name="coordY" type="text" value="<?php echo $_smarty_tpl->tpl_vars['coordY']->value;?>
"></div>
                  <div class="form-group ">
                    <label class="col-sm-1" for="manager">资质照片</label>
                  </div>
                  <div class="form-group ">
                    <label class="col-sm-1" for="manager">对应会员ID</label>
                    <input class="col-sm-2" id="manager" name="manager" type="text" value="<?php echo $_smarty_tpl->tpl_vars['manager']->value;?>
" placeholder="会员ID请到会员列表查看"></div>
                </div>
                <div id="businessinfo" class="tab-pane tt_1">
                  <div class="form-group">
                    <label class="col-sm-1" for="Config_shopstatus">店铺状态</label>
                    <select name="status" id="Config_shopstatus">
                      <option value="1"<?php if ($_smarty_tpl->tpl_vars['status']->value==1||$_smarty_tpl->tpl_vars['status']->value=='') {?> selected="selected"<?php }?>>开启</option>
                      <option value="0"<?php if ($_smarty_tpl->tpl_vars['status']->value==0&&$_smarty_tpl->tpl_vars['status']->value!='') {?> selected="selected"<?php }?>>关闭</option>
                    </select>
                    <span class="help-button" data-rel="popover" data-trigger="hover" data-placement="right" data-content="用于店铺的临时关闭，关闭后顾客无法下单" title="" data-original-title="设置说明">
                      <span class="ace-icon fa fa-info bigger-120"></span>
                    </span>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-1" for="Config_closeinfo">店铺关闭提示信息</label>
                    <textarea class="col-sm-3" rows="4" name="closeinfo" id="Config_closeinfo"><?php echo $_smarty_tpl->tpl_vars['closeinfo']->value;?>
</textarea>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-1" for="Config_ordervalid">微信下单</label>
                    <select name="ordervalid" id="Config_ordervalid">
                      <option value="1"<?php if ($_smarty_tpl->tpl_vars['ordervalid']->value==1||$_smarty_tpl->tpl_vars['ordervalid']->value=='') {?> selected="selected"<?php }?>>开启</option>
                      <option value="0"<?php if ($_smarty_tpl->tpl_vars['ordervalid']->value==0&&$_smarty_tpl->tpl_vars['ordervalid']->value!='') {?> selected="selected"<?php }?>>关闭</option>
                    </select>
                    <span class="help-button" data-rel="popover" data-trigger="hover" data-placement="right" data-content="关闭后顾客不能通过微信下单，只能浏览商品" title="" data-original-title="微信下单说明">
                      <span class="ace-icon fa fa-info bigger-120"></span>
                    </span>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-1" for="Config_ordervalid_remind">微信下单关闭提示信息</label>
                    <textarea class="col-sm-3" rows="4" name="closeorder" id="Config_ordervalid_remind"><?php echo $_smarty_tpl->tpl_vars['closeorder']->value;?>
</textarea>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-1" for="Config_is_merchant_deliver">开启商家配送功能</label>
                    <select name="merchant_deliver" id="Config_is_merchant_deliver">
                      <option value="1"<?php if ($_smarty_tpl->tpl_vars['merchant_deliver']->value==1||$_smarty_tpl->tpl_vars['merchant_deliver']->value=='') {?> selected="selected"<?php }?>>开启</option>
                      <option value="0"<?php if ($_smarty_tpl->tpl_vars['merchant_deliver']->value==0&&$_smarty_tpl->tpl_vars['merchant_deliver']->value!='') {?> selected="selected"<?php }?>>关闭</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-1" for="Config_open_selftake">开启到店自取功能</label>
                    <select name="selftake" id="Config_open_selftake">
                      <option value="1"<?php if ($_smarty_tpl->tpl_vars['merchant_deliver']->value) {?> selected="selected"<?php }?>>开启</option>
                      <option value="0"<?php if (!$_smarty_tpl->tpl_vars['merchant_deliver']->value) {?> selected="selected"<?php }?>>关闭</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-1" for="Config_open_limitcancelorder">是否允许顾客取消未处理订单</label>
                    <select name="cancelorder" id="Config_open_limitcancelorder">
                      <option value="1"<?php if ($_smarty_tpl->tpl_vars['cancelorder']->value) {?> selected="selected"<?php }?>>允许</option>
                      <option value="0"<?php if (!$_smarty_tpl->tpl_vars['cancelorder']->value) {?> selected="selected"<?php }?>>不允许</option>
                    </select>
                    <span class="help-button" data-rel="popover" data-trigger="hover" data-placement="right" data-content="此设置只针对货到付款订单和余额支付订单，在线支付的订单顾客始终无法取消" title="" data-original-title="设置说明">
                      <span class="ace-icon fa fa-info bigger-120"></span>
                    </span>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-1" for="Config_weeks">营业星期</label>
                    <?php if ($_smarty_tpl->tpl_vars['id']->value) {?>
                    <label><input type="checkbox" value="1" name="weeks[]"<?php if (strstr($_smarty_tpl->tpl_vars['weeks']->value,"1")) {?> checked<?php }?>>星期一</label>&nbsp;&nbsp;&nbsp;&nbsp;
                    <label><input type="checkbox" value="2" name="weeks[]"<?php if (strstr($_smarty_tpl->tpl_vars['weeks']->value,"2")) {?> checked<?php }?>>星期二</label>&nbsp;&nbsp;&nbsp;&nbsp;
                    <label><input type="checkbox" value="3" name="weeks[]"<?php if (strstr($_smarty_tpl->tpl_vars['weeks']->value,"3")) {?> checked<?php }?>>星期三</label>&nbsp;&nbsp;&nbsp;&nbsp;
                    <label><input type="checkbox" value="4" name="weeks[]"<?php if (strstr($_smarty_tpl->tpl_vars['weeks']->value,"4")) {?> checked<?php }?>>星期四</label>&nbsp;&nbsp;&nbsp;&nbsp;
                    <label><input type="checkbox" value="5" name="weeks[]"<?php if (strstr($_smarty_tpl->tpl_vars['weeks']->value,"5")) {?> checked<?php }?>>星期五</label>&nbsp;&nbsp;&nbsp;&nbsp;
                    <label><input type="checkbox" value="6" name="weeks[]"<?php if (strstr($_smarty_tpl->tpl_vars['weeks']->value,"6")) {?> checked<?php }?>>星期六</label>&nbsp;&nbsp;&nbsp;&nbsp;
                    <label><input type="checkbox" value="7" name="weeks[]"<?php if (strstr($_smarty_tpl->tpl_vars['weeks']->value,"7")) {?> checked<?php }?>>星期日</label>
                    <?php } else { ?>
                    <label><input type="checkbox" value="1" name="weeks[]" checked>星期一</label>&nbsp;&nbsp;&nbsp;&nbsp;
                    <label><input type="checkbox" value="2" name="weeks[]" checked>星期二</label>&nbsp;&nbsp;&nbsp;&nbsp;
                    <label><input type="checkbox" value="3" name="weeks[]" checked>星期三</label>&nbsp;&nbsp;&nbsp;&nbsp;
                    <label><input type="checkbox" value="4" name="weeks[]" checked>星期四</label>&nbsp;&nbsp;&nbsp;&nbsp;
                    <label><input type="checkbox" value="5" name="weeks[]" checked>星期五</label>&nbsp;&nbsp;&nbsp;&nbsp;
                    <label><input type="checkbox" value="6" name="weeks[]" checked>星期六</label>&nbsp;&nbsp;&nbsp;&nbsp;
                    <label><input type="checkbox" value="7" name="weeks[]" checked>星期日</label>
                    <?php }?>
                  </div>
                  <div class="tabbable">
                    <ul class="nav nav-tabs yy" id="myTab">
                      <li class="active"><a data-toggle="tab" href="#" aria-expanded="false">营业时间段1</a></li>
                      <li><a data-toggle="tab" href="#" aria-expanded="false">营业时间段2</a></li>
                      <li><a data-toggle="tab" href="#" aria-expanded="false">营业时间段3</a></li>
                    </ul>
                    <div class="tab-content">
                      <div id="shop_time_1" class="tab-pane yy_1 in active ">
                        <div>
                          <input class="chooseTime" id="Config_shop_start_time" type="text" value="<?php if ($_smarty_tpl->tpl_vars['id']->value) {
echo $_smarty_tpl->tpl_vars['start_time1']->value;
} else { ?>08:00<?php }?>" name="start_time1" />至
                          <input class="chooseTime" id="Config_shop_stop_time" type="text" value="<?php if ($_smarty_tpl->tpl_vars['id']->value) {
echo $_smarty_tpl->tpl_vars['end_time1']->value;
} else { ?>20:00<?php }?>" name="end_time1" />
                          <div class="errorMessage" id="Config_shop_start_time_em_" style="display:none"></div>
                          <div class="errorMessage" id="Config_shop_stop_time_em_" style="display:none"></div>
                        </div>
                      </div>
                      <div id="shop_time_2" class="tab-pane yy_1">
                        <div>
                          <input class="chooseTime" id="Config_shop_start_time_2" type="text" value="<?php if ($_smarty_tpl->tpl_vars['id']->value) {
echo $_smarty_tpl->tpl_vars['start_time2']->value;
} else { ?>00:00<?php }?>" name="start_time2" />至
                          <input class="chooseTime" id="Config_shop_stop_time_2" type="text" value="<?php if ($_smarty_tpl->tpl_vars['id']->value) {
echo $_smarty_tpl->tpl_vars['end_time2']->value;
} else { ?>00:00<?php }?>" name="end_time2" />
                          <div class="errorMessage" id="Config_shop_start_time_2_em_" style="display:none"></div>
                          <div class="errorMessage" id="Config_shop_stop_time_2_em_" style="display:none"></div>
                        </div>
                      </div>
                      <div id="shop_time_3" class="tab-pane yy_1">
                        <div>
                          <input class="chooseTime" id="Config_shop_start_time_3" type="text" value="<?php if ($_smarty_tpl->tpl_vars['id']->value) {
echo $_smarty_tpl->tpl_vars['start_time3']->value;
} else { ?>00:00<?php }?>" name="start_time3" />至
                          <input class="chooseTime" id="Config_shop_stop_time_3" type="text" value="<?php if ($_smarty_tpl->tpl_vars['id']->value) {
echo $_smarty_tpl->tpl_vars['end_time3']->value;
} else { ?>00:00<?php }?>" name="end_time3" />
                          <div class="errorMessage" id="Config_shop_start_time_3_em_" style="display:none"></div>
                          <div class="errorMessage" id="Config_shop_stop_time_3_em_" style="display:none"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="space"></div>
                  <div class="form-group">
                    <label class="col-sm-1" for="Config_delivery_radius">店铺服务最大距离</label>
                    <input class="col-sm-1" size="10" maxlength="10" name="delivery_radius" id="Config_delivery_radius" type="text" value="<?php if ($_smarty_tpl->tpl_vars['id']->value) {
echo $_smarty_tpl->tpl_vars['delivery_radius']->value;
} else { ?>1.0<?php }?>">
                    <span style="font-size: 14px;float: left;">公里</span>
                    <span class="help-inline col-xs-12 col-sm-7">
                      <span class="help-button" data-rel="popover" data-trigger="hover" data-placement="bottom" data-content="该设置仅在开启了系统设置中的顾客位置验证才生效，不在服务范围的顾客无法下单" title="" data-original-title="设置说明">
                        <span class="ace-icon fa fa-info bigger-120"></span>
                      </span>
                    </span>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-1"><label for="Config_area">配送区域</label></label>
                    <textarea class="col-sm-3" rows="4" name="delivery_area" id="Config_area"><?php echo $_smarty_tpl->tpl_vars['delivery_area']->value;?>
</textarea>
                  </div>
                </div>
                <div id="deliveryfee" class="tab-pane tt_1">

                  <div class="alert alert-info">
                      <button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>
                      <p>
                          1、您只能选择一种起送价、配送费模式，当您选择了其中一种模式后，其他模式的设置将默认失效，建议您选择按区域设置；<br>
                          2、如果店铺设置了按距离收费，那么将以距离为准，不会采用此处按区域设置的收费方式，但顾客下单填写的地址超出服务区域，仍然无法下单；<br>
                          3、您设置的区域顾客无法看到，请您在店铺显示页面手动填写配送区域说明，否则顾客可能会因为区域不同配送费不同感到疑惑，您做好必要的解释工作；<br>
                      </p>
                  </div>

                  <div class="form-group" style="margin-top:20px;">
                    <label class="col-sm-2" for="delivery_fee_mode">选择起送价、配送费模式</label>
                    <select name="delivery_fee_mode" id="delivery_fee_mode">
                      <option value="1"<?php if ($_smarty_tpl->tpl_vars['delivery_fee_mode']->value==1||!$_smarty_tpl->tpl_vars['delivery_fee_mode']->value) {?> selected="selected"<?php }?>>固定配送费、起送价</option>
                      <option value="2"<?php if ($_smarty_tpl->tpl_vars['delivery_fee_mode']->value==2) {?> selected="selected"<?php }?>>按区域</option>
                      <option value="3"<?php if ($_smarty_tpl->tpl_vars['delivery_fee_mode']->value==3) {?> selected="selected"<?php }?>>按距离</option>
                    </select>
                  </div>


                  <div class="delivery_fee_mode widget-box"<?php if ($_smarty_tpl->tpl_vars['delivery_fee_mode']->value==1||!$_smarty_tpl->tpl_vars['delivery_fee_mode']->value) {?> style="display: block;"<?php } else { ?> style="display: none;"<?php }?> id="delivery_fee_mode1">
                    <div class="widget-header"><h5>固定起送价和配送费</h5></div>
                    <div class="widget-body">
                      <div class="widget-main">
                  <div class="form-group">
                            <label class="col-sm-1">固定起送价</label>
                    <input class="col-sm-1" size="10" maxlength="10" name="basicprice" id="Config_basicprice" type="text" value="<?php if ($_smarty_tpl->tpl_vars['id']->value) {
echo $_smarty_tpl->tpl_vars['basicprice']->value;
} else { ?>10.0<?php }?>">元
                    <span class="required">*</span>
                  </div>
                  <div class="form-group">
                            <label class="col-sm-1" for="Config_delivery_fee">固定配送费</label>
                    <input class="col-sm-1" size="10" maxlength="10" name="delivery_fee" id="Config_delivery_fee" type="text" value="<?php if ($_smarty_tpl->tpl_vars['id']->value) {
echo $_smarty_tpl->tpl_vars['delivery_fee']->value;
} else { ?>3.0<?php }?>">元
                    <span class="required">*</span>
                  </div>
                          <div class="form-group">
                            <label class="col-sm-1">
                                <input name="delivery_fee_type" value="2" type="checkbox" class="ace"<?php if ($_smarty_tpl->tpl_vars['delivery_fee_type']->value=="2") {?> checked="checked"<?php }?>>
                                <span class="lbl" style="z-index: 1"> 满</span>
                      </label>
                      <label>
                        <input size="10" maxlength="10" name="delivery_fee_value" id="Config_no_delivery_fee_value" type="text" value="<?php if ($_smarty_tpl->tpl_vars['id']->value) {
echo $_smarty_tpl->tpl_vars['delivery_fee_value']->value;
} else { ?>0.0<?php }?>">
                                <span class="lbl" style="z-index: 1">元免配送费</span>
                      </label>
                    </div>
                  </div>
                  </div>
                  </div>

                  <div class="delivery_fee_mode widget-box"<?php if ($_smarty_tpl->tpl_vars['delivery_fee_mode']->value==2) {?> style="display: block;"<?php } else { ?> style="display: none;"<?php }?> id="delivery_fee_mode2">
                    <div class="widget-header"><h5>按区域设置起送价和配送费</h5></div>
                    <div class="widget-body">
                      <div class="widget-main mapview">
                        <div class="opr-bar">
                            <div class="con">

                                <?php  $_smarty_tpl->tpl_vars['data'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['data']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['service_area_data']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['data']->key => $_smarty_tpl->tpl_vars['data']->value) {
$_smarty_tpl->tpl_vars['data']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['data']->key;
?>
                                <div class="area area<?php echo $_smarty_tpl->tpl_vars['k']->value+1;?>
" data-index="<?php echo $_smarty_tpl->tpl_vars['k']->value+1;?>
" data-points="<?php echo $_smarty_tpl->tpl_vars['data']->value['points'];?>
" data-qisong="<?php echo $_smarty_tpl->tpl_vars['data']->value['qisong'];?>
" data-peisong="<?php echo $_smarty_tpl->tpl_vars['data']->value['peisong'];?>
">
                                    <div class="area-boder">
                                        <div class="clearfix">
                                            <span class="item-title pull-left">配送范围</span>
                                            <span class="hover-opr edit-opr J-opr pull-right">
                                                <a class="save J-del ubl" href="javascript:;">删除</a>
                                                <i class="c-gray"> / </i>
                                                <a class="quit J-edit c-gray" href="javascript:;">编辑</a>
                                            </span>
                                        </div>
                                        <span class="J-min-price min-price">
                                            <span>起送价 </span>
                                            <span class="fr J-value"><i><?php echo $_smarty_tpl->tpl_vars['data']->value['qisong'];?>
</i> 元</span>
                                        </span>
                                        <span class="J-shipping-fee shipping-fee">
                                            <span class="shipping-fee-text">配送费 </span>
                                            <span class="fr J-value"><i><?php echo $_smarty_tpl->tpl_vars['data']->value['peisong'];?>
</i> 元</span>
                                        </span>
                                    </div>
                                </div>
                                <?php } ?>

                                <div class="add-area"><i class="fa fa-plus"></i> 新增配送区域</div>
                            </div>
                        </div>

                        <textarea name="service_area_data" id="service_area_data" class="hide">[]</textarea>
                        <div id="mapview"></div>

                      </div>
                    </div>
                  </div>

                  <div class="delivery_fee_mode widget-box"<?php if ($_smarty_tpl->tpl_vars['delivery_fee_mode']->value==3) {?> style="display: block;"<?php } else { ?> style="display: none;"<?php }?> id="delivery_fee_mode3">
                    <div class="widget-header"><h5>设置不同配送距离的外送费和起送价</h5></div>
                    <div class="widget-body">
                      <div class="widget-main ">
                        <div class="lievf">
                          <div class="btn btn-sm btn-success addrangedeliveryfee">添加不同距离外送费</div>
                          <div class="clear"></div>
                        </div>

                        <?php if ($_smarty_tpl->tpl_vars['range_delivery_fee_value']->value) {?>
                        <?php  $_smarty_tpl->tpl_vars['fee'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['fee']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['range_delivery_fee_value']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['fee']->key => $_smarty_tpl->tpl_vars['fee']->value) {
$_smarty_tpl->tpl_vars['fee']->_loop = true;
?>
                        <div class="rangedeliveryfee rangedeliveryfeeblock">
                            配送距离&nbsp;<input type="text" style="width:80px;" class="name" name="rangedeliveryfee[start][]" value="<?php echo $_smarty_tpl->tpl_vars['fee']->value[0];?>
">&nbsp;
                            公里至&nbsp;<input type="text" style="width:80px;" class="name" name="rangedeliveryfee[stop][]" value="<?php echo $_smarty_tpl->tpl_vars['fee']->value[1];?>
">&nbsp;公里，外送费&nbsp;
                            <input type="text" style="width:80px;" class="content" name="rangedeliveryfee[value][]" value="<?php echo $_smarty_tpl->tpl_vars['fee']->value[2];?>
">&nbsp;元，起送价&nbsp;
                            <input type="text" style="width:80px;" class="content" name="rangedeliveryfee[minvalue][]" value="<?php echo $_smarty_tpl->tpl_vars['fee']->value[3];?>
">&nbsp;元
                            <div class="deleterangedeliveryfee" title="删除自定义显示项">删除</div>
                        </div>
                        <?php } ?>
                        <?php }?>
                        <div id="rangedeliveryfeecontent"></div>
                        <div style="clear:both;"></div>
                      </div>
                    </div>
                  </div>

                </div>

                <div id="show" class="tab-pane tt_1">
                  <div class="form-group">
                    <label class="col-sm-1" for="Config_notice">店铺公告</label>
                    <textarea class="col-sm-3" rows="5" id="shop_notice" name="shop_notice"><?php echo $_smarty_tpl->tpl_vars['shop_notice']->value;?>
</textarea>
                  </div>
                  <div class="form-group">
                    <div class="checkbox">
                      <label>
                        <input class="ace" name="shop_notice_used" id="Config_shop_notice_used" value="1" type="checkbox"<?php if ($_smarty_tpl->tpl_vars['shop_notice_used']->value) {?> checked<?php }?>>
                        <span class="lbl"><label for="Config_shop_notice_used">是否开启选购页面公告</label></span>
                      </label>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-1"><label for="Config_shop_notice">选购页面公告</label></label>
                    <textarea class="col-sm-3" rows="5" name="buy_notice" id="Config_shop_notice"><?php echo $_smarty_tpl->tpl_vars['buy_notice']->value;?>
</textarea>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-1" for="Config_linktype">进入店铺链接类型</label>
                    <select name="linktype" id="Config_linktype">
                      <option value="0"<?php if (!$_smarty_tpl->tpl_vars['linktype']->value) {?> selected<?php }?>>首页</option>
                      <option value="1"<?php if ($_smarty_tpl->tpl_vars['linktype']->value) {?> selected<?php }?>>选购</option>
                    </select>
                    <span class="help-button" data-rel="popover" data-trigger="hover" data-placement="right" data-content="这个决定进入店铺时候显示的页面是店铺信息页面还是商品选购页面" title="" data-original-title="设置说明">
                      <span class="ace-icon fa fa-info bigger-120"></span>
                    </span>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-1" for="Config_callshow">店铺首页显示拨打电话</label>
                    <select name="callshow" id="Config_callshow">
                      <option value="0"<?php if (!$_smarty_tpl->tpl_vars['callshow']->value) {?> selected<?php }?>>不显示</option>
                      <option value="1"<?php if ($_smarty_tpl->tpl_vars['callshow']->value) {?> selected<?php }?>>显示</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-1" for="Config_unitshow">商品单位</label>
                    <select name="unitshow" id="Config_unitshow">
                      <option value="0"<?php if (!$_smarty_tpl->tpl_vars['unitshow']->value) {?> selected<?php }?>>不显示</option>
                      <option value="1"<?php if ($_smarty_tpl->tpl_vars['unitshow']->value) {?> selected<?php }?>>显示</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-1" for="Config_is_opencomment">评论功能</label>
                    <select name="opencomment" id="Config_is_opencomment">
                      <option value="1"<?php if ($_smarty_tpl->tpl_vars['opencomment']->value||$_smarty_tpl->tpl_vars['opencomment']->value=='') {?> selected<?php }?>>开启</option>
                      <option value="0"<?php if (!$_smarty_tpl->tpl_vars['opencomment']->value&&$_smarty_tpl->tpl_vars['opencomment']->value!='') {?> selected<?php }?>>关闭</option>
                    </select>
                  </div>
                  <!--是否开启在微信店铺列表中显示销售量，显示店铺到客户所在位置的距离>
                  <div class="form-group"></div>
                  <div class="form-group"></div-->
                  <!--是否开启在微信店铺列表中显示销售量，显示店铺到客户所在位置的距离-->
                  <div class="form-group">
                    <label class="col-sm-1" for="Config_showtype">展示风格</label>
                    <select name="showtype" id="Config_showtype">
                      <option value="1"<?php if ($_smarty_tpl->tpl_vars['showtype']->value==1) {?> selected<?php }?>>文字展示</option>
                      <option value="2"<?php if ($_smarty_tpl->tpl_vars['showtype']->value==2||!$_smarty_tpl->tpl_vars['showtype']->value) {?> selected<?php }?>>小图展示</option>
                      <option value="3"<?php if ($_smarty_tpl->tpl_vars['showtype']->value==3) {?> selected<?php }?>>中图展示</option>
                      <option value="4"<?php if ($_smarty_tpl->tpl_vars['showtype']->value==4) {?> selected<?php }?>>大图展示</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-1" for="Config_food_showtype">商品详情显示风格</label>
                    <select name="food_showtype" id="Config_food_showtype">
                      <option value="0"<?php if (!$_smarty_tpl->tpl_vars['food_showtype']->value) {?> selected<?php }?>>弹框显示</option>
                      <option value="1"<?php if ($_smarty_tpl->tpl_vars['food_showtype']->value) {?> selected<?php }?>>新页面显示</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <select name="showsales" id="Config_showsales">
                      <option value="1"<?php if ($_smarty_tpl->tpl_vars['showsales']->value) {?> selected<?php }?>>显示</option>
                      <option value="0"<?php if (!$_smarty_tpl->tpl_vars['showsales']->value) {?> selected<?php }?>>不显示</option>
                    </select>
                    <label class="col-sm-1" for="Config_showsales">选购页面是否显示商品销量</label>
                  </div>
                  <div class="form-group">
                    <select name="show_basicprice" id="Config_is_show_basicprice">
                      <option value="0"<?php if (!$_smarty_tpl->tpl_vars['show_basicprice']->value) {?> selected<?php }?>>显示</option>
                      <option value="1"<?php if ($_smarty_tpl->tpl_vars['show_basicprice']->value) {?> selected<?php }?>>不显示</option>
                    </select>
                    <label class="col-sm-1" for="Config_is_show_basicprice">店铺首页是否显示起送价</label>
                  </div>
                  <div class="form-group">
                    <select name="show_delivery" id="Config_is_show_delivery">
                      <option value="0"<?php if (!$_smarty_tpl->tpl_vars['show_delivery']->value) {?> selected<?php }?>>显示</option>
                      <option value="1"<?php if ($_smarty_tpl->tpl_vars['show_delivery']->value) {?> selected<?php }?>>不显示</option>
                    </select>
                    <label class="col-sm-1" for="Config_is_show_delivery">店铺首页是否显示外送费</label>
                  </div>
                  <div class="form-group">
                    <select name="show_range" id="Config_is_show_range">
                      <option value="0"<?php if (!$_smarty_tpl->tpl_vars['show_range']->value) {?> selected<?php }?>>显示</option>
                      <option value="1"<?php if ($_smarty_tpl->tpl_vars['show_range']->value) {?> selected<?php }?>>不显示</option>
                    </select>
                    <label class="col-sm-1" for="Config_is_show_range">店铺首页是否显示服务距离</label>
                  </div>
                  <div class="form-group">
                    <select name="show_area" id="Config_is_show_area">
                      <option value="0"<?php if (!$_smarty_tpl->tpl_vars['show_area']->value) {?> selected<?php }?>>显示</option>
                      <option value="1"<?php if ($_smarty_tpl->tpl_vars['show_area']->value) {?> selected<?php }?>>不显示</option>
                    </select>
                    <label class="col-sm-1" for="Config_is_show_area">店铺首页是否显示配送区域</label>
                  </div>
                  <div class="form-group">
                    <select name="show_delivery_service" id="Config_is_show_delivery_service">
                      <option value="1"<?php if ($_smarty_tpl->tpl_vars['show_delivery_service']->value) {?> selected<?php }?>>显示</option>
                      <option value="0"<?php if (!$_smarty_tpl->tpl_vars['show_delivery_service']->value) {?> selected<?php }?>>不显示</option>
                    </select>
                    <label class="col-sm-1" for="Config_is_show_delivery_service">店铺列表是否显示配送服务商名称</label>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-1" for="Config_delivery_service">配送服务商名称</label>
                    <input class="col-sm-3" size="20" maxlength="255" placeholder="输入配送服务商，如：乐外卖专送" name="delivery_service" id="Config_delivery_service" type="text" value="<?php echo $_smarty_tpl->tpl_vars['delivery_service']->value;?>
">
                  </div>
                  <div class="form-group">
                    <label class="col-sm-1" for="Config_memo_hint">购物车页面订单备注提示</label>
                    <input class="col-sm-3" size="20" maxlength="20" name="memo_hint" id="Config_memo_hint" type="text" value="<?php if ($_smarty_tpl->tpl_vars['memo_hint']->value) {
echo $_smarty_tpl->tpl_vars['memo_hint']->value;
} else { ?>如：不要辣、12点前送到<?php }?>">
                  </div>
                  <div class="form-group">
                    <label class="col-sm-1" for="Config_address_hint">地址提示</label>
                    <input class="col-sm-3" size="20" maxlength="20" name="address_hint" id="Config_address_hint" type="text" value="<?php if ($_smarty_tpl->tpl_vars['address_hint']->value) {
echo $_smarty_tpl->tpl_vars['address_hint']->value;
} else { ?>如：XX小区5号楼318<?php }?>">
                  </div>
                  <div class="form-group">
                    <label class="col-sm-1"><label for="Config_order_prefix">订单编号前缀</label></label>
                    <input class="col-sm-2" name="order_prefix" id="Config_order_prefix" type="text" maxlength="20" value="<?php echo $_smarty_tpl->tpl_vars['order_prefix']->value;?>
">
                    <span class="help-inline col-xs-12 col-sm-7">
                      <span class="help-button" data-rel="popover" data-trigger="hover" data-placement="bottom" data-content="需要去“系统设置-》帐号设置-》显示设置”中，将订单编号显示类型设置为按店铺编号才有效" title="" data-original-title="设置说明">
                        <span class="ace-icon fa fa-info bigger-120"></span>
                      </span>
                    </span>
                  </div>
                </div>
                <div id="pay" class="tab-pane tt_1">
                  <!-- <div class="form-group">
                    <div class="radio">
                      <label>
                          支付类型显示顺序
                          <input type="text" name="paytype_sequence" value="<?php echo $_smarty_tpl->tpl_vars['paytype']->value;?>
">
                      </label>
                    </div>
                  </div> -->
                  <div class="form-group">
                    <div class="radio">
                      <label>
                        <input class="paycheck ace" type="checkbox" name="paytype[]" value="1" id="openpayone"<?php if (strstr($_smarty_tpl->tpl_vars['paytype']->value,"1")) {?> checked<?php }?>>
                        <span class="lbl"><label for="openpayone">货到付款</label></span>
                      </label>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="radio">
                      <label>
                        <input class="paycheck ace" type="checkbox" name="paytype[]" value="2" id="openpaytwo"<?php if (strstr($_smarty_tpl->tpl_vars['paytype']->value,"2")) {?> checked<?php }?>>
                        <span class="lbl"><label for="openpaytwo">余额支付</label></span>
                      </label>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="radio">
                      <label>
                        <input class="paycheck ace" type="checkbox" name="paytype[]" value="3" checked="" id="openpaythree"<?php if (!$_smarty_tpl->tpl_vars['id']->value||strstr($_smarty_tpl->tpl_vars['paytype']->value,"3")) {?> checked<?php }?>>
                        <span class="lbl"><label for="openpaythree">在线支付</label></span>
                      </label>
                    </div>
                  </div>
                  <div id="pay_offline" class="widget-box">
                    <div class="widget-header">
                      <h5>货到付款金额限制</h5></div>
                    <div class="col-xs-12">
                      <div class="alert alert-danger" style="margin-top: 15px;">如订单金额大于货到付款限制金额，则客人无法选择货到付款</div></div>
                    <div class="widget-body">
                      <div class="widget-main">
                        <div class="form-group">
                          <label class="col-sm-2" for="Config_is_pay_offline_limit">是否开启货到付款金额限制</label>
                          <select name="offline_limit" id="Config_is_pay_offline_limit">
                            <option value="1"<?php if ($_smarty_tpl->tpl_vars['offline_limit']->value) {?> selected<?php }?>>开启</option>
                            <option value="0"<?php if (!$_smarty_tpl->tpl_vars['offline_limit']->value) {?> selected<?php }?>>关闭</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-2" for="Config_pay_offline_limit">货到付款限制金额</label>
                          <input class="col-sm-1" name="pay_offline_limit" id="Config_pay_offline_limit" type="text" value="<?php if ($_smarty_tpl->tpl_vars['pay_offline_limit']->value) {
echo $_smarty_tpl->tpl_vars['pay_offline_limit']->value;
} else { ?>0.0<?php }?>">元
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- <div id="delivertime" class="tab-pane tt_1">
                  <div class="alert alert-block alert-success">
                    <button type="button" class="close" data-dismiss="alert">
                      <i class="ace-icon fa fa-times"></i>
                    </button>
                    <p>点击查看教程<a href="#" target="_blank">《如何利用配送时间功能最大化配送效率，提高业绩》</a></p>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2" for="Config_opendelivertime">是否开启配送时间限制</label>
                    <select name="Config[opendelivertime]" id="Config_opendelivertime">
                      <option value="0" selected="selected">关闭</option>
                      <option value="1">开启</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2" for="Config_is_nowdelivery">是否开启尽快送达</label>
                    <select name="Config[is_nowdelivery]" id="Config_is_nowdelivery">
                      <option value="0" selected="selected">关闭</option>
                      <option value="1">开启</option></select>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2" for="Config_days">配送时间关联的天数</label>
                    <select name="Config[days]" id="Config_days">
                      <option value="1" selected="selected">一天</option>
                      <option value="2">二天</option>
                      <option value="3">三天</option>
                      <option value="4">四天</option>
                      <option value="5">五天</option>
                      <option value="6">六天</option>
                      <option value="7">七天</option></select>
                  </div>
                  <h3 class="header smaller lighter green"></h3>
                  <div class="form-group">
                    <label class="col-sm-2" for="Config_is_delivertimerange">是否开启最少提前多少分钟下单</label>
                    <select name="Config[is_delivertimerange]" id="Config_is_delivertimerange">
                      <option value="0" selected="selected">开启</option>
                      <option value="1">关闭</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2" for="Config_delivertimerange">最少提前多少分钟下单</label>
                    <input class="col-sm-1" size="10" maxlength="3" name="Config[delivertimerange]" id="Config_delivertimerange" type="text" value="30">分钟</div>
                  <h3 class="header smaller lighter green"></h3>
                  <div class="form-group">
                    <label class="col-sm-2" for="Config_open_schedule">是否开启提前下单算预定功能</label>
                    <select name="Config[open_schedule]" id="Config_open_schedule">
                      <option value="0" selected="selected">关闭</option>
                      <option value="1">开启</option></select>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2" for="Config_leadtimes">提前多少分钟算预定</label>
                    <input class="col-sm-1" size="10" maxlength="3" name="Config[leadtimes]" id="Config_leadtimes" type="text" value="300">分钟</div>
                  <div class="form-group">
                    <label class="col-sm-2" for="Config_schedule_delivery">预定的配送费</label>
                    <input class="col-sm-1" size="10" maxlength="3" name="Config[schedule_delivery]" id="Config_schedule_delivery" type="text" value="0.00">元</div>
                  <div class="widget-box">
                    <div class="widget-header">
                      <h5>配送时间段</h5></div>
                    <br>
                    <div class="form-group">
                      <label class="col-sm-2" style="margin-left:10px;" for="Config_open_time_delivery">是否开启配送时间配送费功能</label>
                      <select name="Config[open_time_delivery]" id="Config_open_time_delivery">
                        <option value="0" selected="selected">关闭</option>
                        <option value="1">开启</option></select>
                    </div>
                    <div class="widget-body">
                      <div class="widget-main">
                        <div style="margin:10px;width:1000px;float:left;">(1) 时间段:
                          <input class="chooseTime" id="delivertime_0_start" type="text" value="00:00" name="delivertime[0][start]" />至
                          <input class="chooseTime" id="delivertime_0_stop" type="text" value="00:00" name="delivertime[0][stop]" />&nbsp;&nbsp;&nbsp; 配送费:
                          <input type="text" value="0" style="width:80px;" name="delivertime[0][delivery_value]" />元</div>
                        <div style="margin:10px;width:1000px;float:left;">(2) 时间段:
                          <input class="chooseTime" id="delivertime_1_start" type="text" value="00:00" name="delivertime[1][start]" />至
                          <input class="chooseTime" id="delivertime_1_stop" type="text" value="00:00" name="delivertime[1][stop]" />&nbsp;&nbsp;&nbsp; 配送费:
                          <input type="text" value="0" style="width:80px;" name="delivertime[1][delivery_value]" />元</div>
                        <div style="margin:10px;width:1000px;float:left;">(3) 时间段:
                          <input class="chooseTime" id="delivertime_2_start" type="text" value="00:00" name="delivertime[2][start]" />至
                          <input class="chooseTime" id="delivertime_2_stop" type="text" value="00:00" name="delivertime[2][stop]" />&nbsp;&nbsp;&nbsp; 配送费:
                          <input type="text" value="0" style="width:80px;" name="delivertime[2][delivery_value]" />元</div>
                        <div style="margin:10px;width:1000px;float:left;">(4) 时间段:
                          <input class="chooseTime" id="delivertime_3_start" type="text" value="00:00" name="delivertime[3][start]" />至
                          <input class="chooseTime" id="delivertime_3_stop" type="text" value="00:00" name="delivertime[3][stop]" />&nbsp;&nbsp;&nbsp; 配送费:
                          <input type="text" value="0" style="width:80px;" name="delivertime[3][delivery_value]" />元</div>
                        <div style="margin:10px;width:1000px;float:left;">(5) 时间段:
                          <input class="chooseTime" id="delivertime_4_start" type="text" value="00:00" name="delivertime[4][start]" />至
                          <input class="chooseTime" id="delivertime_4_stop" type="text" value="00:00" name="delivertime[4][stop]" />&nbsp;&nbsp;&nbsp; 配送费:
                          <input type="text" value="0" style="width:80px;" name="delivertime[4][delivery_value]" />元</div>
                        <div style="margin:10px;width:1000px;float:left;">(6) 时间段:
                          <input class="chooseTime" id="delivertime_5_start" type="text" value="00:00" name="delivertime[5][start]" />至
                          <input class="chooseTime" id="delivertime_5_stop" type="text" value="00:00" name="delivertime[5][stop]" />&nbsp;&nbsp;&nbsp; 配送费:
                          <input type="text" value="0" style="width:80px;" name="delivertime[5][delivery_value]" />元</div>
                        <div style="margin:10px;width:1000px;float:left;">(7) 时间段:
                          <input class="chooseTime" id="delivertime_6_start" type="text" value="00:00" name="delivertime[6][start]" />至
                          <input class="chooseTime" id="delivertime_6_stop" type="text" value="00:00" name="delivertime[6][stop]" />&nbsp;&nbsp;&nbsp; 配送费:
                          <input type="text" value="0" style="width:80px;" name="delivertime[6][delivery_value]" />元</div>
                        <div style="margin:10px;width:1000px;float:left;">(8) 时间段:
                          <input class="chooseTime" id="delivertime_7_start" type="text" value="00:00" name="delivertime[7][start]" />至
                          <input class="chooseTime" id="delivertime_7_stop" type="text" value="00:00" name="delivertime[7][stop]" />&nbsp;&nbsp;&nbsp; 配送费:
                          <input type="text" value="0" style="width:80px;" name="delivertime[7][delivery_value]" />元</div>
                        <div style="margin:10px;width:1000px;float:left;">(9) 时间段:
                          <input class="chooseTime" id="delivertime_8_start" type="text" value="00:00" name="delivertime[8][start]" />至
                          <input class="chooseTime" id="delivertime_8_stop" type="text" value="00:00" name="delivertime[8][stop]" />&nbsp;&nbsp;&nbsp; 配送费:
                          <input type="text" value="0" style="width:80px;" name="delivertime[8][delivery_value]" />元</div>
                        <div style="margin:10px;width:1000px;float:left;">(10) 时间段:
                          <input class="chooseTime" id="delivertime_9_start" type="text" value="00:00" name="delivertime[9][start]" />至
                          <input class="chooseTime" id="delivertime_9_stop" type="text" value="00:00" name="delivertime[9][stop]" />&nbsp;&nbsp;&nbsp; 配送费:
                          <input type="text" value="0" style="width:80px;" name="delivertime[9][delivery_value]" />元</div>
                        <div style="margin:10px;width:1000px;float:left;">(11) 时间段:
                          <input class="chooseTime" id="delivertime_10_start" type="text" value="00:00" name="delivertime[10][start]" />至
                          <input class="chooseTime" id="delivertime_10_stop" type="text" value="00:00" name="delivertime[10][stop]" />&nbsp;&nbsp;&nbsp; 配送费:
                          <input type="text" value="0" style="width:80px;" name="delivertime[10][delivery_value]" />元</div>
                        <div style="margin:10px;width:1000px;float:left;">(12) 时间段:
                          <input class="chooseTime" id="delivertime_11_start" type="text" value="00:00" name="delivertime[11][start]" />至
                          <input class="chooseTime" id="delivertime_11_stop" type="text" value="00:00" name="delivertime[11][stop]" />&nbsp;&nbsp;&nbsp; 配送费:
                          <input type="text" value="0" style="width:80px;" name="delivertime[11][delivery_value]" />元</div>
                        <div style="margin:10px;width:1000px;float:left;">(13) 时间段:
                          <input class="chooseTime" id="delivertime_12_start" type="text" value="00:00" name="delivertime[12][start]" />至
                          <input class="chooseTime" id="delivertime_12_stop" type="text" value="00:00" name="delivertime[12][stop]" />&nbsp;&nbsp;&nbsp; 配送费:
                          <input type="text" value="0" style="width:80px;" name="delivertime[12][delivery_value]" />元</div>
                        <div style="margin:10px;width:1000px;float:left;">(14) 时间段:
                          <input class="chooseTime" id="delivertime_13_start" type="text" value="00:00" name="delivertime[13][start]" />至
                          <input class="chooseTime" id="delivertime_13_stop" type="text" value="00:00" name="delivertime[13][stop]" />&nbsp;&nbsp;&nbsp; 配送费:
                          <input type="text" value="0" style="width:80px;" name="delivertime[13][delivery_value]" />元</div>
                        <div style="margin:10px;width:1000px;float:left;">(15) 时间段:
                          <input class="chooseTime" id="delivertime_14_start" type="text" value="00:00" name="delivertime[14][start]" />至
                          <input class="chooseTime" id="delivertime_14_stop" type="text" value="00:00" name="delivertime[14][stop]" />&nbsp;&nbsp;&nbsp; 配送费:
                          <input type="text" value="0" style="width:80px;" name="delivertime[14][delivery_value]" />元</div>
                        <div style="margin:10px;width:1000px;float:left;">(16) 时间段:
                          <input class="chooseTime" id="delivertime_15_start" type="text" value="00:00" name="delivertime[15][start]" />至
                          <input class="chooseTime" id="delivertime_15_stop" type="text" value="00:00" name="delivertime[15][stop]" />&nbsp;&nbsp;&nbsp; 配送费:
                          <input type="text" value="0" style="width:80px;" name="delivertime[15][delivery_value]" />元</div>
                        <div style="margin:10px;width:1000px;float:left;">(17) 时间段:
                          <input class="chooseTime" id="delivertime_16_start" type="text" value="00:00" name="delivertime[16][start]" />至
                          <input class="chooseTime" id="delivertime_16_stop" type="text" value="00:00" name="delivertime[16][stop]" />&nbsp;&nbsp;&nbsp; 配送费:
                          <input type="text" value="0" style="width:80px;" name="delivertime[16][delivery_value]" />元</div>
                        <div style="margin:10px;width:1000px;float:left;">(18) 时间段:
                          <input class="chooseTime" id="delivertime_17_start" type="text" value="00:00" name="delivertime[17][start]" />至
                          <input class="chooseTime" id="delivertime_17_stop" type="text" value="00:00" name="delivertime[17][stop]" />&nbsp;&nbsp;&nbsp; 配送费:
                          <input type="text" value="0" style="width:80px;" name="delivertime[17][delivery_value]" />元</div>
                        <div style="margin:10px;width:1000px;float:left;">(19) 时间段:
                          <input class="chooseTime" id="delivertime_18_start" type="text" value="00:00" name="delivertime[18][start]" />至
                          <input class="chooseTime" id="delivertime_18_stop" type="text" value="00:00" name="delivertime[18][stop]" />&nbsp;&nbsp;&nbsp; 配送费:
                          <input type="text" value="0" style="width:80px;" name="delivertime[18][delivery_value]" />元</div>
                        <div style="margin:10px;width:1000px;float:left;">(20) 时间段:
                          <input class="chooseTime" id="delivertime_19_start" type="text" value="00:00" name="delivertime[19][start]" />至
                          <input class="chooseTime" id="delivertime_19_stop" type="text" value="00:00" name="delivertime[19][stop]" />&nbsp;&nbsp;&nbsp; 配送费:
                          <input type="text" value="0" style="width:80px;" name="delivertime[19][delivery_value]" />元</div>
                        <div style="clear:both;"></div>
                      </div>
                    </div>
                  </div>
                  <div style="clear:both;"></div>
                </div> -->
                <div id="options" class="tab-pane tt_1">
                  <div id="yw0">
                    <div class="alert in alert-block fade alert-info">
                      <a href="#" class="close" data-dismiss="alert">×</a>字段名长度为1-10个字，不能为空;选项字段的选项值之间用逗号(,)分开：<br />如：1号桌,2号桌,3号桌..，每个选项值长度为1-20个字，不能为空；填写字段的提示语长度为0-100个字，可以为空;
                    </div>
                  </div>
                  <div>
                    <div>
                      <div class="btn btn-sm btn-success addxxfield">添加选项字段</div>
                      <div class="btn btn-sm btn-success addtxfield">添加填写字段</div>
                      <div class="clear"></div>
                    </div>
                    <div id="fieldcontent"></div>

                    <?php if ($_smarty_tpl->tpl_vars['preset']->value) {?>
                    <?php  $_smarty_tpl->tpl_vars['p'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['p']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['preset']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['p']->key => $_smarty_tpl->tpl_vars['p']->value) {
$_smarty_tpl->tpl_vars['p']->_loop = true;
?>
                    <div class="xxfield fieldblock">
                        (<span style="font-weight:bold;"><?php if ($_smarty_tpl->tpl_vars['p']->value[0]==1) {?>选项字段<?php } else { ?>填写字段<?php }?></span>)&nbsp;&nbsp;
                        字段名:<input type="text" style="width:80px;" class="name" name="field[name][]" value="<?php echo $_smarty_tpl->tpl_vars['p']->value[2];?>
">&nbsp;&nbsp;&nbsp;&nbsp;
                        选项值:<input type="text" style="width:300px;" class="content" name="field[content][]" value="<?php echo $_smarty_tpl->tpl_vars['p']->value[3];?>
">&nbsp;&nbsp;&nbsp;&nbsp;
                        显示顺序:<input type="text" style="width:50px;" class="content" name="field[sort][]" value="<?php echo $_smarty_tpl->tpl_vars['p']->value[1];?>
">
                        <input type="hidden" class="type" name="field[type][]" value="<?php echo $_smarty_tpl->tpl_vars['p']->value[0];?>
">
                        <div class="deletefield" title="删除选项字段">删除</div>
                    </div>
                    <?php } ?>
                    <?php }?>

                  </div>
                </div>
                <div id="shopactivity" class="tab-pane tt_1">
                  <div class="form-group">
                    <div class="checkbox">
                      <label>
                        <input id="ytConfig_is_first_discount" type="hidden" value="0" name="Config[is_first_discount]">
                        <input class="ace" name="is_first_discount" id="Config_is_first_discount" value="1" type="checkbox"<?php if ($_smarty_tpl->tpl_vars['is_first_discount']->value) {?> checked<?php }?>>
                        <span class="lbl"><label for="Config_is_first_discount">是否开启店铺首单减免功能</label></span>
                      </label>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-1" for="Config_first_discount">店铺首单减免金额</label>
                    <input class="col-sm-1" name="first_discount" id="Config_first_discount" type="text" value="<?php if ($_smarty_tpl->tpl_vars['first_discount']->value) {
echo $_smarty_tpl->tpl_vars['first_discount']->value;
} else { ?>0.0<?php }?>">元
                  </div>
                  <!-- <div class="form-group">
                    <div class="checkbox">
                      <label>
                        <input id="ytConfig_is_coupon" type="hidden" value="0" name="Config[is_coupon]">
                        <input class="ace" name="Config[is_coupon]" id="Config_is_coupon" value="1" type="checkbox">
                        <span class="lbl"><label for="Config_is_coupon">启用优惠券</label></span>
                      </label>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-1" for="Config_coupon_max">优惠券最大面值</label>
                    <input class="col-sm-1" name="Config[coupon_max]" id="Config_coupon_max" type="text" value="10.0">元</div>
                  <div class="form-group">
                    <div class="checkbox">
                      <label>
                        <input id="ytConfig_is_only_online" type="hidden" value="0" name="Config[is_only_online]">
                        <input class="ace" name="Config[is_only_online]" id="Config_is_only_online" value="1" type="checkbox">
                        <span class="lbl">
                          <label for="Config_is_only_online">是否开启只有在线支付和余额付款才能使用优惠券</label></span>
                      </label>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="checkbox">
                      <label>
                        <input id="ytConfig_is_only_promotion" type="hidden" value="0" name="Config[is_only_promotion]">
                        <input class="ace" name="Config[is_only_promotion]" id="Config_is_only_promotion" value="1" type="checkbox">
                        <span class="lbl">
                          <label for="Config_is_only_promotion">是否开启只有在线支付和余额付款才进行满减优惠</label></span>
                      </label>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="checkbox">
                      <label>
                        <input id="ytConfig_is_only_discount" type="hidden" value="0" name="Config[is_only_discount]">
                        <input class="ace" name="Config[is_only_discount]" id="Config_is_only_discount" value="1" type="checkbox">
                        <span class="lbl">
                          <label for="Config_is_only_discount">是否开启只有在线支付和余额付款才能打折</label></span>
                      </label>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="checkbox">
                      <label>
                        <input id="ytConfig_member_discount_type" type="hidden" value="0" name="Config[member_discount_type]">
                        <input class="ace" name="Config[member_discount_type]" id="Config_member_discount_type" value="1" type="checkbox">
                        <span class="lbl">
                          <label for="Config_member_discount_type">是否开启只有余额支付才能使用会员优惠、会员打折、会员免配送费</label></span>
                      </label>
                    </div>
                  </div> -->
                  <div class="form-group">
                    <div class="checkbox">
                      <label>
                        <input id="ytConfig_is_discount" type="hidden" value="0" name="Config[is_discount]">
                        <input class="ace" name="is_discount" id="Config_is_discount" value="1" type="checkbox"<?php if ($_smarty_tpl->tpl_vars['is_discount']->value) {?> checked<?php }?>>
                        <span class="lbl"><label for="Config_is_discount">启用店铺打折</label></span>
                      </label>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-1" for="Config_discount_value">店铺折扣值</label>
                    <input class="col-sm-1" name="discount_value" id="Config_discount_value" type="text" value="<?php if ($_smarty_tpl->tpl_vars['discount_value']->value) {
echo $_smarty_tpl->tpl_vars['discount_value']->value;
} else { ?>10.0<?php }?>">
                    <span class="help-button" data-rel="popover" data-trigger="hover" data-placement="right" data-content="如8折输入8，88折输入8.8" title="" data-original-title="会员折扣填写说明">
                      <span class="ace-icon fa fa-info bigger-120"></span>
                    </span>
                  </div>
                  <!-- <div class="form-group">
                    <div class="checkbox">
                      <label>
                        <input id="ytConfig_discountlimitmember" type="hidden" value="0" name="Config[discountlimitmember]">
                        <input class="ace" name="Config[discountlimitmember]" id="Config_discountlimitmember" value="1" type="checkbox">
                        <span class="lbl">
                          <label for="Config_discountlimitmember">是否只有会员才能打折</label></span>
                      </label>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="checkbox">
                      <label>
                        <input id="ytConfig_is_delivery_free" type="hidden" value="0" name="Config[is_delivery_free]">
                        <input class="ace" name="Config[is_delivery_free]" id="Config_is_delivery_free" value="1" type="checkbox">
                        <span class="lbl">
                          <label for="Config_is_delivery_free">启用会员免配送费</label></span>
                      </label>
                    </div>
                  </div> -->
                  <div class="form-group">
                    <div class="checkbox">
                      <label>
                        <input id="ytConfig_open_promotion" type="hidden" value="0" name="Config[open_promotion]">
                        <input class="ace" name="open_promotion" id="Config_open_promotion" value="1" type="checkbox"<?php if ($_smarty_tpl->tpl_vars['open_promotion']->value) {?> checked<?php }?>>
                        <span class="lbl"><label for="Config_open_promotion">开启消费满减活动</label></span>
                      </label>
                    </div>
                  </div>
                  <div class="form-group">
                    <label style="padding-left:20px;">消费满多少元（整数）：
                      <input type="text" name="promotions[0][amount]" value="<?php if ($_smarty_tpl->tpl_vars['promotions']->value) {
echo $_smarty_tpl->tpl_vars['promotions']->value[0][0];
}?>" placeholder="这里填写满多少元,如满100元减8元，这里填100" size="50"></label>
                    <br>
                    <label style="padding-left:20px;">减多少元（整数）：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <input type="text" name="promotions[0][discount]" value="<?php if ($_smarty_tpl->tpl_vars['promotions']->value) {
echo $_smarty_tpl->tpl_vars['promotions']->value[0][1];
}?>" placeholder="这里填写减多少元,如满100元减8元，这里填8" size="50"></label>
                    <span class="help-button" data-rel="popover" data-trigger="hover" data-placement="right" data-content="填写的必须是整数，如满100元减8元，满多少元的输入框填100，减多少元的输入框填8" title="" data-original-title="店铺消费满减的填写说明">
                      <span class="ace-icon fa fa-info bigger-120"></span>
                    </span>
                  </div>
                  <div class="form-group">
                    <label style="padding-left:20px;">消费满多少元（整数）：
                      <input type="text" name="promotions[1][amount]" value="<?php if ($_smarty_tpl->tpl_vars['promotions']->value) {
echo $_smarty_tpl->tpl_vars['promotions']->value[1][0];
}?>" placeholder="这里填写满多少元,如满100元减8元，这里填100" size="50"></label>
                    <br>
                    <label style="padding-left:20px;">减多少元（整数）：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <input type="text" name="promotions[1][discount]" value="<?php if ($_smarty_tpl->tpl_vars['promotions']->value) {
echo $_smarty_tpl->tpl_vars['promotions']->value[1][1];
}?>" placeholder="这里填写减多少元,如满100元减8元，这里填8" size="50"></label>
                    <span class="help-button" data-rel="popover" data-trigger="hover" data-placement="right" data-content="填写的必须是整数，如满100元减8元，满多少元的输入框填100，减多少元的输入框填8" title="" data-original-title="店铺消费满减的填写说明">
                      <span class="ace-icon fa fa-info bigger-120"></span>
                    </span>
                  </div>
                  <div class="form-group">
                    <label style="padding-left:20px;">消费满多少元（整数）：
                      <input type="text" name="promotions[2][amount]" value="<?php if ($_smarty_tpl->tpl_vars['promotions']->value) {
echo $_smarty_tpl->tpl_vars['promotions']->value[2][0];
}?>" placeholder="这里填写满多少元,如满100元减8元，这里填100" size="50"></label>
                    <br>
                    <label style="padding-left:20px;">减多少元（整数）：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <input type="text" name="promotions[2][discount]" value="<?php if ($_smarty_tpl->tpl_vars['promotions']->value) {
echo $_smarty_tpl->tpl_vars['promotions']->value[2][1];
}?>" placeholder="这里填写减多少元,如满100元减8元，这里填8" size="50"></label>
                    <span class="help-button" data-rel="popover" data-trigger="hover" data-placement="right" data-content="填写的必须是整数，如满100元减8元，满多少元的输入框填100，减多少元的输入框填8" title="" data-original-title="店铺消费满减的填写说明">
                      <span class="ace-icon fa fa-info bigger-120"></span>
                    </span>
                  </div>
                  <!-- <div class="form-group">
                    <div class="checkbox">
                      <label>
                        <input id="ytConfig_open_fullcoupon" type="hidden" value="0" name="Config[open_fullcoupon]">
                        <input class="ace" name="Config[open_fullcoupon]" id="Config_open_fullcoupon" value="1" type="checkbox">
                        <span class="lbl">
                          <label for="Config_open_fullcoupon">是否开启满多少送优惠券功能</label></span>
                      </label>
                    </div>
                  </div> -->
                  <!-- <div class="form-group">
                    <label style="padding-left:20px;">消费满多少元（整数）：
                      <input type="text" name="fullcoupon[0][full]" value="" placeholder="这里填写满多少元,如满100元，这里填100" size="50"></label>
                    <label style="padding-left:20px;">送优惠券：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <select name="fullcoupon[0][coupon]" id="coupon">
                        <option value="">请选择优惠券</option>
                        <option value="32000">金点生鲜3元抵用券</option>
                        <option value="32001">金点生鲜5元体验券</option>
                        <option value="32002">金点生鲜10元优惠券</option></select>
                    </label>
                    <span class="help-button" data-rel="popover" data-trigger="hover" data-placement="right" data-content="填写的必须是整数，如满100元送哪种优惠券，满多少元的输入框填100，选择需要赠送的优惠券" title="" data-original-title="店铺消费满送优惠券的填写说明">
                      <span class="ace-icon fa fa-info bigger-120"></span>
                    </span>
                  </div>
                  <div class="form-group">
                    <label style="padding-left:20px;">消费满多少元（整数）：
                      <input type="text" name="fullcoupon[1][full]" value="" placeholder="这里填写满多少元,如满100元，这里填100" size="50"></label>
                    <label style="padding-left:20px;">送优惠券：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <select name="fullcoupon[1][coupon]" id="coupon">
                        <option value="">请选择优惠券</option>
                        <option value="32000">金点生鲜3元抵用券</option>
                        <option value="32001">金点生鲜5元体验券</option>
                        <option value="32002">金点生鲜10元优惠券</option></select>
                    </label>
                    <span class="help-button" data-rel="popover" data-trigger="hover" data-placement="right" data-content="填写的必须是整数，如满100元送哪种优惠券，满多少元的输入框填100，选择需要赠送的优惠券" title="" data-original-title="店铺消费满送优惠券的填写说明">
                      <span class="ace-icon fa fa-info bigger-120"></span>
                    </span>
                  </div>
                  <div class="form-group">
                    <label style="padding-left:20px;">消费满多少元（整数）：
                      <input type="text" name="fullcoupon[2][full]" value="" placeholder="这里填写满多少元,如满100元，这里填100" size="50"></label>
                    <label style="padding-left:20px;">送优惠券：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <select name="fullcoupon[2][coupon]" id="coupon">
                        <option value="">请选择优惠券</option>
                        <option value="32000">金点生鲜3元抵用券</option>
                        <option value="32001">金点生鲜5元体验券</option>
                        <option value="32002">金点生鲜10元优惠券</option></select>
                    </label>
                    <span class="help-button" data-rel="popover" data-trigger="hover" data-placement="right" data-content="填写的必须是整数，如满100元送哪种优惠券，满多少元的输入框填100，选择需要赠送的优惠券" title="" data-original-title="店铺消费满送优惠券的填写说明">
                      <span class="ace-icon fa fa-info bigger-120"></span>
                    </span>
                  </div>
                  <div class="form-group">
                    <div class="checkbox">
                      <label>
                        <input id="ytConfig_open_full_gift" type="hidden" value="0" name="Config[open_full_gift]">
                        <input class="ace" name="Config[open_full_gift]" id="Config_open_full_gift" value="1" type="checkbox">
                        <span class="lbl">
                          <label for="Config_open_full_gift">是否开启满多少送优惠券礼包功能</label></span>
                      </label>
                    </div>
                  </div>
                  <div class="form-group">
                    <label style="padding-left:20px;">消费满多少元（整数）：
                      <input type="text" name="full_gift[full]" value="" placeholder="这里填写满多少元,如满100元，这里填100" size="50"></label>
                    <label style="padding-left:20px;">送优惠券礼包：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <select name="full_gift[gift_id]" id="coupon">
                        <option value="">请选择优惠券</option>
                        <option value="1021">金点生鲜优惠大礼包礼包</option></select>
                    </label>
                    <span class="help-button" data-rel="popover" data-trigger="hover" data-placement="right" data-content="填写的必须是整数，如满100元送哪种优惠券，满多少元的输入框填100，选择需要赠送的优惠券" title="" data-original-title="店铺消费满送优惠券的填写说明">
                      <span class="ace-icon fa fa-info bigger-120"></span>
                    </span>
                  </div> -->
                </div>
                <div id="orderattention" class="tab-pane tt_1">
                  <!-- <div class="alert alert-block alert-success">
                    <button type="button" class="close" data-dismiss="alert">
                      <i class="ace-icon fa fa-times"></i>
                    </button>
                    <p>注意：
                      <br>1.短信订单提醒每67个字（包含中文、英文、数字、标点等）扣除1条短信余额，超过67个字将扣除多条短信余额。
                      <br>2.邮箱订单提醒建议使用QQ邮箱并将service@email.lewaimai.com加入白名单防止收不到邮件或者邮件出现在垃圾信箱。</p>
                  </div> -->
                  <!-- <div class="form-group">
                    <div class="checkbox">
                      <label>
                        <input id="ytConfig_order_voice_remind" type="hidden" value="0" name="Config[order_voice_remind]">
                        <input class="ace" name="Config[order_voice_remind]" id="Config_order_voice_remind" value="1" type="checkbox">
                        <span class="lbl">
                          <label for="Config_order_voice_remind">外卖订单5分钟未确认自动给商家拨打语音电话通知（需要充值短信余额）</label></span>
                      </label>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-1" for="Config_voice_phone">接收语音通知电话号码</label>
                    <input class="col-sm-2" size="10" maxlength="20" name="Config[voice_phone]" id="Config_voice_phone" type="text" value=""></div> -->
                  <div class="form-group">
                    <div class="checkbox">
                      <label>
                        <input id="ytConfig_smsvalid" type="hidden" value="0" name="Config[smsvalid]">
                        <input class="ace" name="smsvalid" id="Config_smsvalid" value="1" type="checkbox"<?php if ($_smarty_tpl->tpl_vars['smsvalid']->value) {?> checked<?php }?>>
                        <span class="lbl"><label for="Config_smsvalid">短信订单提醒</label></span>
                      </label>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-1" for="Config_sms_phone">接收短信手机号码</label>
                    <input class="col-sm-2" size="10" maxlength="20" name="sms_phone" id="Config_sms_phone" type="text" value="<?php echo $_smarty_tpl->tpl_vars['sms_phone']->value;?>
">
                  </div>
                  <div class="form-group">
                    <div class="checkbox">
                      <label>
                        <input id="ytConfig_emailvalid" type="hidden" value="0" name="Config[emailvalid]">
                        <input class="ace" name="emailvalid" id="Config_emailvalid" value="1" type="checkbox"<?php if ($_smarty_tpl->tpl_vars['emailvalid']->value) {?> checked<?php }?>>
                        <span class="lbl"><label for="Config_emailvalid">邮箱订单提醒</label></span>
                      </label>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-1" for="Config_email_address">接收订单email地址</label>
                    <input class="col-sm-2" size="10" maxlength="50" name="email_address" id="Config_email_address" type="text" value="<?php echo $_smarty_tpl->tpl_vars['email_address']->value;?>
">&nbsp;&nbsp;
                    <!-- <a href="#" target="_blank" title="查看微信订单提醒设置教程" rel="tooltip" class="btn btn-sm btn-danger">设置教程</a> -->
                  </div>
                  <div class="form-group">
                    <div class="checkbox">
                      <label>
                        <input id="ytConfig_weixinvalid" type="hidden" value="0" name="Config[weixinvalid]">
                        <input class="ace" name="weixinvalid" id="Config_weixinvalid" value="1" type="checkbox"<?php if ($_smarty_tpl->tpl_vars['weixinvalid']->value) {?> checked<?php }?>>
                        <span class="lbl"><label for="Config_weixinvalid">微信订单提醒</label></span>
                      </label>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-1" for="Config_lewaimai_customerid">乐外卖顾客ID</label>
                    <input class="col-sm-2" name="customerid" id="Config_lewaimai_customerid" type="text" value="<?php echo $_smarty_tpl->tpl_vars['customerid']->value;?>
">&nbsp;&nbsp;
                    <span class="help-button" data-rel="popover" data-trigger="hover" data-placement="right" data-content="初次设置必看！" title="" data-original-title="初次设置必看！">
                      <span class="ace-icon fa fa-info bigger-120"></span>
                    </span>
                  </div>
                  <!--<div class="form-group"></div>
                  <div class="form-group">
                  <div class="checkbox">
                  <label>
                  <span class="lbl"></span></label>
                  </div>
                  </div>
                  <div class="form-group"></div>-->
                  <div class="form-group">
                    <label class="col-sm-1" for="Config_auto_printer">是否开启自动打印外卖新订单</label>
                    <select name="auto_printer" id="Config_auto_printer">
                      <option value="1"<?php if ($_smarty_tpl->tpl_vars['auto_printer']->value||$_smarty_tpl->tpl_vars['auto_printer']->value=='') {?> selected<?php }?>>开启</option>
                      <option value="0"<?php if (!$_smarty_tpl->tpl_vars['auto_printer']->value&&$_smarty_tpl->tpl_vars['auto_printer']->value!='') {?> selected<?php }?>>不开启</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-1" for="Config_showordernum">打印是否显示下单次数</label>
                    <select name="showordernum" id="Config_showordernum">
                      <option value="1"<?php if ($_smarty_tpl->tpl_vars['showordernum']->value||$_smarty_tpl->tpl_vars['showordernum']->value=='') {?> selected<?php }?>>显示</option>
                      <option value="0"<?php if (!$_smarty_tpl->tpl_vars['showordernum']->value&&$_smarty_tpl->tpl_vars['showordernum']->value!='') {?> selected<?php }?>>不显示</option>
                    </select>
                  </div>
                  <!-- <div class="form-group">
                    <label class="col-sm-1" for="Config_showordernum_type">显示下单次数类型</label>
                    <select name="Config[showordernum_type]" id="Config_showordernum_type">
                      <option value="1" selected="selected">平台</option>
                      <option value="0">店铺</option>
                    </select>
                  </div> -->
                </div>
                <div id="printershopimg" class="tab-pane tt_1">
                  <div class="alert alert-block alert-success">支持jpg、jpeg、gif、png格式的图片&nbsp;&nbsp;单张最大1M，最多上传10张，为了达到最佳效果，建议上传宽度为600像素的图片</div>

                  <div class="listImgBox">
        			<div class="list-holder">
        				<ul id="listSection" class="clearfix listSection piece"></ul>
        				<input type="hidden" name="shop_banner" value='[]' class="imglist-hidden">
        			</div>
        			<div class="btn-section clearfix">
        				<div class="uploadinp filePicker" id="filePicker" data-type="album" data-count="10" data-size="1024" data-imglist="banner"><div id="flasHolder"></div><span>添加图片</span></div>
        				<div class="upload-tip">
        					<p><a href="javascript:;" class="deleteAllAtlas" style="display:none;">删除所有</a>&nbsp;&nbsp;<span class="fileerror"></span></p>
        				</div>
        			</div>
                  </div>

                  <div style="clear:both;height:50px;"></div>
                </div>
                <div id="addservice" class="tab-pane tt_1">
                  <div id="yw0">
                    <div class="alert in alert-block fade alert-info"><a href="#" class="close" data-dismiss="alert">×</a>增值服务可设置名称（名称不能重复）,对应的增值服务费用,还有服务对应的时间,如果顾客是在那个时间内下的单,就会增加对应的费用！</div></div>
                  <div class="form-group">
                    <label class="col-sm-1" for="Config_open_addservice">是否开启增值服务</label>
                    <select name="open_addservice" id="Config_open_addservice">
                      <option value="0"<?php if (!$_smarty_tpl->tpl_vars['open_addservice']->value) {?> selected<?php }?>>关闭</option>
                      <option value="1"<?php if ($_smarty_tpl->tpl_vars['open_addservice']->value) {?> selected<?php }?>>开启</option>
                    </select>
                  </div>
                  <div class="widget-box">
                    <div class="widget-header"><h5>增值服务</h5></div>
                    <div class="widget-body">
                      <div class="widget-main">
                        <div style="margin:10px;width:1000px;float:left;">(1) &nbsp;&nbsp;名称:
                          <input type="text" name="addservice[0][name]" value="<?php if ($_smarty_tpl->tpl_vars['addservice']->value) {
echo $_smarty_tpl->tpl_vars['addservice']->value[0][0];
}?>" />时间段:
                          <input class="chooseTime" id="addservice_0_start" type="text" value="<?php if ($_smarty_tpl->tpl_vars['addservice']->value) {
echo $_smarty_tpl->tpl_vars['addservice']->value[0][1];
} else { ?>00:00<?php }?>" name="addservice[0][start]" />至
                          <input class="chooseTime" id="addservice_0_stop" type="text" value="<?php if ($_smarty_tpl->tpl_vars['addservice']->value) {
echo $_smarty_tpl->tpl_vars['addservice']->value[0][2];
} else { ?>00:00<?php }?>" name="addservice[0][stop]" />&nbsp;&nbsp;价格:
                          <input type="text" name="addservice[0][price]" value="<?php if ($_smarty_tpl->tpl_vars['addservice']->value) {
echo $_smarty_tpl->tpl_vars['addservice']->value[0][3];
} else { ?>0<?php }?>" /></div>
                        <div style="margin:10px;width:1000px;float:left;">(2) &nbsp;&nbsp;名称:
                          <input type="text" name="addservice[1][name]" value="<?php if ($_smarty_tpl->tpl_vars['addservice']->value) {
echo $_smarty_tpl->tpl_vars['addservice']->value[1][0];
}?>" />时间段:
                          <input class="chooseTime" id="addservice_1_start" type="text" value="<?php if ($_smarty_tpl->tpl_vars['addservice']->value) {
echo $_smarty_tpl->tpl_vars['addservice']->value[1][1];
} else { ?>00:00<?php }?>" name="addservice[1][start]" />至
                          <input class="chooseTime" id="addservice_1_stop" type="text" value="<?php if ($_smarty_tpl->tpl_vars['addservice']->value) {
echo $_smarty_tpl->tpl_vars['addservice']->value[1][2];
} else { ?>00:00<?php }?>" name="addservice[1][stop]" />&nbsp;&nbsp;价格:
                          <input type="text" name="addservice[1][price]" value="<?php if ($_smarty_tpl->tpl_vars['addservice']->value) {
echo $_smarty_tpl->tpl_vars['addservice']->value[1][3];
} else { ?>0<?php }?>" /></div>
                        <div style="margin:10px;width:1000px;float:left;">(3) &nbsp;&nbsp;名称:
                          <input type="text" name="addservice[2][name]" value="<?php if ($_smarty_tpl->tpl_vars['addservice']->value) {
echo $_smarty_tpl->tpl_vars['addservice']->value[2][0];
}?>" />时间段:
                          <input class="chooseTime" id="addservice_2_start" type="text" value="<?php if ($_smarty_tpl->tpl_vars['addservice']->value) {
echo $_smarty_tpl->tpl_vars['addservice']->value[2][1];
} else { ?>00:00<?php }?>" name="addservice[2][start]" />至
                          <input class="chooseTime" id="addservice_2_stop" type="text" value="<?php if ($_smarty_tpl->tpl_vars['addservice']->value) {
echo $_smarty_tpl->tpl_vars['addservice']->value[2][2];
} else { ?>00:00<?php }?>" name="addservice[2][stop]" />&nbsp;&nbsp;价格:
                          <input type="text" name="addservice[2][price]" value="<?php if ($_smarty_tpl->tpl_vars['addservice']->value) {
echo $_smarty_tpl->tpl_vars['addservice']->value[2][3];
} else { ?>0<?php }?>" /></div>
                        <div style="margin:10px;width:1000px;float:left;">(4) &nbsp;&nbsp;名称:
                          <input type="text" name="addservice[3][name]" value="<?php if ($_smarty_tpl->tpl_vars['addservice']->value) {
echo $_smarty_tpl->tpl_vars['addservice']->value[3][0];
}?>" />时间段:
                          <input class="chooseTime" id="addservice_3_start" type="text" value="<?php if ($_smarty_tpl->tpl_vars['addservice']->value) {
echo $_smarty_tpl->tpl_vars['addservice']->value[3][1];
} else { ?>00:00<?php }?>" name="addservice[3][start]" />至
                          <input class="chooseTime" id="addservice_3_stop" type="text" value="<?php if ($_smarty_tpl->tpl_vars['addservice']->value) {
echo $_smarty_tpl->tpl_vars['addservice']->value[3][2];
} else { ?>00:00<?php }?>" name="addservice[3][stop]" />&nbsp;&nbsp;价格:
                          <input type="text" name="addservice[3][price]" value="<?php if ($_smarty_tpl->tpl_vars['addservice']->value) {
echo $_smarty_tpl->tpl_vars['addservice']->value[3][3];
} else { ?>0<?php }?>" /></div>
                        <div style="margin:10px;width:1000px;float:left;">(5) &nbsp;&nbsp;名称:
                          <input type="text" name="addservice[4][name]" value="<?php if ($_smarty_tpl->tpl_vars['addservice']->value) {
echo $_smarty_tpl->tpl_vars['addservice']->value[4][0];
}?>" />时间段:
                          <input class="chooseTime" id="addservice_4_start" type="text" value="<?php if ($_smarty_tpl->tpl_vars['addservice']->value) {
echo $_smarty_tpl->tpl_vars['addservice']->value[4][1];
} else { ?>00:00<?php }?>" name="addservice[4][start]" />至
                          <input class="chooseTime" id="addservice_4_stop" type="text" value="<?php if ($_smarty_tpl->tpl_vars['addservice']->value) {
echo $_smarty_tpl->tpl_vars['addservice']->value[4][2];
} else { ?>00:00<?php }?>" name="addservice[4][stop]" />&nbsp;&nbsp;价格:
                          <input type="text" name="addservice[4][price]" value="<?php if ($_smarty_tpl->tpl_vars['addservice']->value) {
echo $_smarty_tpl->tpl_vars['addservice']->value[4][3];
} else { ?>0<?php }?>" /></div>
                        <div style="clear:both;"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div id="selfdefine" class="tab-pane tt_1">
                  <div id="yw0">
                    <div class="alert in alert-block fade alert-info">
                      <a href="#" class="close" data-dismiss="alert">×</a>设置自定义项以及对应的值，用于显示在店铺首页的店铺信息部分中。（例如：微信公众号等）;
                      <!-- <p><a class="btn btn-danger" href="#" target="_blank">设置教程</a></p> -->
                    </div>
                  </div>
                  <div class="addse">
                    <div>
                      <div class="btn btn-sm btn-success addselfdefine">添加自定义显示项</div>
                      <div class="clear"></div>
                    </div>
                    <div id="selfdefinecontent"></div>
                  </div>

                  <?php if ($_smarty_tpl->tpl_vars['selfdefine']->value) {?>
                  <?php  $_smarty_tpl->tpl_vars['self'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['self']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['selfdefine']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['self']->key => $_smarty_tpl->tpl_vars['self']->value) {
$_smarty_tpl->tpl_vars['self']->_loop = true;
?>
                  <div class="selfdefine selfdefineblock" style="">
                      项目类型:
                      <select class="selfdefine-type" name="selfdefine[type][]">
                          <option value="content"<?php if ($_smarty_tpl->tpl_vars['self']->value[0]=="content") {?> selected<?php }?>>内容</option>
                          <option value="link"<?php if ($_smarty_tpl->tpl_vars['self']->value[0]=="link") {?> selected<?php }?>>外链</option>
                      </select>&nbsp;&nbsp;&nbsp;&nbsp;
                      <span class="selfdefine_name"><?php if ($_smarty_tpl->tpl_vars['self']->value[0]=="content") {?>自定义显示项<?php } else { ?>链接名<?php }?>:</span>
                      <input type="text" style="width:80px;" class="name" name="selfdefine[name][]" value="<?php echo $_smarty_tpl->tpl_vars['self']->value[1];?>
">&nbsp;&nbsp;&nbsp;&nbsp;
                      <span class="selfdefine_value"><?php if ($_smarty_tpl->tpl_vars['self']->value[0]=="content") {?>选项值<?php } else { ?>链接<?php }?>:</span>
                      <input type="text" style="width:300px;" class="content" name="selfdefine[content][]" value="<?php echo $_smarty_tpl->tpl_vars['self']->value[2];?>
">
                      <div class="deleteselfdefine" title="删除自定义显示项">删除</div>
                  </div>
                  <?php } ?>
                  <?php }?>

                </div>
                <div id="shareaward" class="tab-pane tt_1">
                  <div class="form-group">
                    <label class="col-sm-1" for="Config_share_title">分享标题</label>
                    <input class="col-sm-1" name="share_title" id="Config_share_title" type="text" maxlength="200" value="<?php echo $_smarty_tpl->tpl_vars['share_title']->value;?>
">
                    <span style="color:red;line-height:34px;margin-left:20px;">（不设置默认为【店铺名称】微信店铺）</span>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-1" for="Config_share_image">分享图片</label>
                    <div class="fn-clear listImgBox" style="float: left;">
                        <div class="thumb" style="width: auto;">
                            <div class="uploadinp filePicker thumbtn"<?php if ($_smarty_tpl->tpl_vars['share_pic']->value!='') {?> style="display:none;"<?php }?> id="filePicker1" data-type="thumb"  data-count="1" data-size="1024" data-imglist=""><div></div><span></span></div>
                            <?php if ($_smarty_tpl->tpl_vars['share_pic']->value!='') {?>
                			<ul id="listSection1" class="listSection thumblist fn-clear" style="display:inline-block;"><li id="WU_FILE_0_1"><a href='<?php echo $_smarty_tpl->tpl_vars['cfg_attachment']->value;
echo $_smarty_tpl->tpl_vars['share_pic']->value;?>
' target="_blank" title=""><img alt="" src="<?php echo $_smarty_tpl->tpl_vars['cfg_attachment']->value;
echo $_smarty_tpl->tpl_vars['share_pic']->value;?>
" data-val="<?php echo $_smarty_tpl->tpl_vars['share_pic']->value;?>
"/></a><a class="reupload li-rm" href="javascript:;">删除图片</a></li></ul>
                			<?php } else { ?>
                			<ul id="listSection1" class="listSection thumblist fn-clear"></ul>
                			<?php }?>
    						<input type="hidden" name="share_pic" value="<?php echo $_smarty_tpl->tpl_vars['share_pic']->value;?>
" class="imglist-hidden" id="litpic">
                        </div>
		            </div>
                </div>

            </div>
            <div id="printer" class="tab-pane tt_1">
              <div class="form-group">
                <label class="col-sm-1" for="Config_open_addservice">是否开启打印机</label>
                <select name="bind_print" id="Config_bind_print">
                  <option value="0"<?php if (!$_smarty_tpl->tpl_vars['bind_print']->value) {?> selected<?php }?>>关闭</option>
                  <option value="1"<?php if ($_smarty_tpl->tpl_vars['bind_print']->value) {?> selected<?php }?>>开启</option>
                </select>
              </div>
              <div class="widget-box">
                <div class="widget-header"><h5>绑定打印机</h5></div>
                <div class="widget-body">
                  <div class="widget-main">
                      <div class="form-group hide">
                        <label class="col-sm-1">用户ID：</label>
                        <input class="col-sm-2" name="print_config[partner][]" type="text" value="<?php if ($_smarty_tpl->tpl_vars['print_config']->value[0]['partner']) {
echo $_smarty_tpl->tpl_vars['print_config']->value[0]['partner'];
} else { ?>12132<?php }?>">
                      </div>
                      <div class="form-group hide">
                        <label class="col-sm-1">API 密钥：</label>
                        <input class="col-sm-4" name="print_config[apikey][]" type="text" value="<?php if ($_smarty_tpl->tpl_vars['print_config']->value[0]['apikey']) {
echo $_smarty_tpl->tpl_vars['print_config']->value[0]['apikey'];
} else { ?>578b4b6a47218e27e7a6a5eaa53082fa823ca415<?php }?>">
                      </div>
                      <div class="form-group">
                        <label class="col-sm-1">打印机终端号：</label>
                        <input class="col-sm-2" name="print_config[mcode][]" type="text" value="<?php echo $_smarty_tpl->tpl_vars['print_config']->value[0]['mcode'];?>
">
                      </div>
                      <div class="form-group">
                        <label class="col-sm-1">打印机密钥：</label>
                        <input class="col-sm-2" name="print_config[msign][]" type="text" value="<?php echo $_smarty_tpl->tpl_vars['print_config']->value[0]['msign'];?>
">
                      </div>
                      <div class="form-group">
                        <label class="col-sm-1">打印机状态：</label>
                        <?php if ($_smarty_tpl->tpl_vars['print_state']->value==1) {?>
                        <b style="color:green">在线</b>
                        <?php } elseif ($_smarty_tpl->tpl_vars['print_state']->value==2) {?>
                        <b style="color:red">缺纸</b>
                        <?php } elseif ($_smarty_tpl->tpl_vars['print_state']->value==3) {?>
                        <b style="color:red">离线</b>
                        <?php } else { ?>
                        未知
                        <?php }?>
                      </div>
                  </div>
                </div>
              </div>
            </div>

            <div id="fencheng" class="tab-pane tt_1">

                <div id="fc0">
                    <div class="alert in alert-block fade alert-info">
                      <a href="#" class="close" data-dismiss="alert">×</a>此处设置的均为平台的收入或分摊项;
                      <!-- <p><a class="btn btn-danger" href="#" target="_blank">设置教程</a></p> -->
                    </div>
                  </div>

                <div class="widget-box">
                    <div class="widget-header"><h5>收入项</h5></div>
                    <div class="widget-body">
                      <div class="widget-main">
                            <div class="form-group">
                              <label class="col-sm-1" for="fencheng_foodprice">商品原价</label>
                              <input class="col-sm-1" name="fencheng_foodprice" id="fencheng_foodprice" type="number" min="0" max="100" value="<?php if ($_smarty_tpl->tpl_vars['fencheng_foodprice']->value) {
echo $_smarty_tpl->tpl_vars['fencheng_foodprice']->value;
} else { ?>10<?php }?>">&nbsp;%
                            </div>
                            <div class="form-group">
                              <label class="col-sm-1" for="fencheng_delivery">配送费</label>
                              <input class="col-sm-1" name="fencheng_delivery" id="fencheng_delivery" type="number" min="0" max="100" value="<?php if ($_smarty_tpl->tpl_vars['fencheng_delivery']->value) {
echo $_smarty_tpl->tpl_vars['fencheng_delivery']->value;
} else { ?>100<?php }?>">&nbsp;%
                            </div>
                            <div class="form-group">
                              <label class="col-sm-1" for="fencheng_dabao">打包费</label>
                              <input class="col-sm-1" name="fencheng_dabao" id="fencheng_dabao" type="number" min="0" max="100" value="<?php echo $_smarty_tpl->tpl_vars['fencheng_dabao']->value;?>
">&nbsp;%
                            </div>
                            <div class="form-group">
                              <label class="col-sm-1" for="fencheng_addservice">增值服务费</label>
                              <input class="col-sm-1" name="fencheng_addservice" id="fencheng_addservice" type="number" min="0" max="100" value="<?php echo $_smarty_tpl->tpl_vars['fencheng_addservice']->value;?>
">&nbsp;%
                            </div>
                        </div>
                    </div>
                </div>

                <div class="widget-box">
                    <div class="widget-header"><h5>优惠分摊</h5></div>
                    <div class="widget-body">
                      <div class="widget-main">
                            <div class="form-group">
                              <label class="col-sm-1" for="fencheng_discount">折扣</label>
                              <input class="col-sm-1" name="fencheng_discount" id="fencheng_discount" type="number" min="0" max="100" value="<?php echo $_smarty_tpl->tpl_vars['fencheng_discount']->value;?>
">&nbsp;%
                            </div>
                            <div class="form-group">
                              <label class="col-sm-1" for="fencheng_promotion">满减</label>
                              <input class="col-sm-1" name="fencheng_promotion" id="fencheng_promotion" type="number" min="0" max="100" value="<?php echo $_smarty_tpl->tpl_vars['fencheng_promotion']->value;?>
">&nbsp;%
                            </div>
                            <div class="form-group">
                              <label class="col-sm-1" for="fencheng_firstdiscount">首单减免</label>
                              <input class="col-sm-1" name="fencheng_firstdiscount" id="fencheng_firstdiscount" type="number" min="0" max="100" value="<?php if ($_smarty_tpl->tpl_vars['fencheng_firstdiscount']->value) {
echo $_smarty_tpl->tpl_vars['fencheng_firstdiscount']->value;
} else { ?>100<?php }?>">&nbsp;%
                            </div>
                        </div>
                    </div>
                </div>

                <div class="widget-box hide">
                    <div class="widget-header"><h5>其他调整扣除项</h5></div>
                    <div class="widget-body">
                      <div class="widget-main">
                          <div class="checkbox">
                              <label>
                                <input class="ace" name="fencheng_offline" id="fencheng_offline" value="1" type="checkbox"<?php if ($_smarty_tpl->tpl_vars['fencheng_offline']->value==1) {?> checked<?php }?>>
                                <span class="lbl"><label for="fencheng_offline">是否扣除货到付款</label></span>
                              </label>
                          </div><br />
                            <font color="red" style="margin-left: 30px;">注：此处如果实际交易中货到付款的钱已经被商家收取，则需要从商家应得金额中扣除货到付款额，请选择“是”。如果被平台收取，则不需要扣除，请选择“否”。</font>
                        </div>
                    </div>
                </div>

            </div>

                <div class="clearfix form-actions save_data" style="position:absolute;left:0px;right:0px;bottom:-120px;">
                  <button id="submitBtn" class="btn btn-info" type="submit" style="margin-left:200px;" onclick="return checkFrom(this.form)">
                    <i class="ace-icon fa fa-check bigger-110"></i>保存</button>
                </div>
                <div id="inputimglist" style="display:none;"></div>
            </div>
          </div>
        </form>
      </div>
    </div>
    <!-- PAGE CONTENT ENDS -->
    <div style="height:100px;"></div>

    </div>
  </div>

<?php echo '<script'; ?>
 type="text/template" id="addNewArea">
    <div class="area areaCount">
        <div class="area-boder">
            <div class="clearfix">
                <span class="edit-opr J-opr pull-right ">
                    <a class="quit J-remove c-gray" href="javascript:;">删除</a>
                    <i class="c-gray"> / </i>
                    <a class="save J-save ubl" href="javascript:;">保存</a>
                </span>
            </div>
            <span class="J-min-price min-price">
                <span>起送价 </span>
                <span class="fr J-input ct-lightgrey pull-right"><input class="change-input form-control" type="text" value="0">元</span>
            </span>
            <span class="J-shipping-fee shipping-fee">
                <span class="shipping-fee-text">配送费 </span>
                <span class="fr J-input ct-lightgrey pull-right"><input type="text" class="change-input form-control" value="0">元</span>
            </span>
            <div class="new-area J-radius">
                <div>
                    <label class="label-radio inline curp"><input type="radio" class="J-change-type" name="area" value="poly" checked><span class="custom-radio"></span> 多边形区域</label>
                    <label class="label-radio inline curp"><input type="radio" class="J-change-type" name="area" value="circle"><span class="custom-radio"></span> 圆形区域</label></div>
                <div class="f-small c-grayer edit-type">
                    <div class="J-type-area">单击鼠标左键开始绘制配送范围，双击鼠标左键即可完成编辑</div>
                    <div class="J-type-area" style="display:none;">
                        半径&nbsp;&nbsp;
                        <span class="J-set set-radius">
                            <div class="minus">-</div>
                            <input class="form-control" type="text" value="2.0">
                            <div class="add">+</div>
                        </span>&nbsp;&nbsp;公里
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php echo '</script'; ?>
>


<?php echo '<script'; ?>
 type="text/javascript" src="http://api.map.baidu.com/getscript?v=2.0&ak=<?php echo $_smarty_tpl->tpl_vars['site_map_key']->value;?>
&services=&t=<?php echo time();?>
"><?php echo '</script'; ?>
>

<!--加载鼠标绘制工具-->
<?php echo '<script'; ?>
 type="text/javascript" src="http://api.map.baidu.com/library/DrawingManager/1.4/src/DrawingManager_min.js"><?php echo '</script'; ?>
>
<link rel="stylesheet" href="http://api.map.baidu.com/library/DrawingManager/1.4/src/DrawingManager_min.css" />
<?php echo $_smarty_tpl->tpl_vars['jsFile']->value;?>

<?php }} ?>
