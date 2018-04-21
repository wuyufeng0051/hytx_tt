<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-05-15 14:07:22
         compiled from "D:\ServerWwwroot\www.lwm.com\admin\templates\waimai\waimaiFoodAdd.html" */ ?>
<?php /*%%SmartyHeaderCode:20318591549e2e58184-54321892%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8da6995ecd1f75843ac0adf19113b975c392e704' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\admin\\templates\\waimai\\waimaiFoodAdd.html',
      1 => 1494583962,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20318591549e2e58184-54321892',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_591549e30080b4_64009245',
  'variables' => 
  array (
    'cfg_soft_lang' => 0,
    'cssFile' => 0,
    'action' => 0,
    'adminPath' => 0,
    'pics' => 0,
    'sid' => 0,
    'id' => 0,
    'sort' => 0,
    'title' => 0,
    'price' => 0,
    'typelist' => 0,
    'type' => 0,
    'typeid' => 0,
    'unit' => 0,
    'label' => 0,
    'is_dabao' => 0,
    'dabao_money' => 0,
    'status' => 0,
    'stockvalid' => 0,
    'stock' => 0,
    'formerprice' => 0,
    'descript' => 0,
    'body' => 0,
    'is_nature' => 0,
    'nature' => 0,
    'index' => 0,
    'n' => 0,
    'p' => 0,
    'is_day_limitfood' => 0,
    'day_foodnum' => 0,
    'is_limitfood' => 0,
    'foodnum' => 0,
    'start_time' => 0,
    'stop_time' => 0,
    'limit_time' => 0,
    'editorFile' => 0,
    'jsFile' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_591549e30080b4_64009245')) {function content_591549e30080b4_64009245($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $_smarty_tpl->tpl_vars['cfg_soft_lang']->value;?>
" />
<title>商品列表</title>
<?php echo $_smarty_tpl->tpl_vars['cssFile']->value;?>

<?php echo '<script'; ?>
>
var action = "<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
", adminPath = "<?php echo $_smarty_tpl->tpl_vars['adminPath']->value;?>
";
var modelType = "waimai";
var imglist = {
    "pic": <?php echo $_smarty_tpl->tpl_vars['pics']->value;?>

}
var sid = <?php echo $_smarty_tpl->tpl_vars['sid']->value;?>
;
<?php echo '</script'; ?>
>
<style>
label {display: inline-block;}
.tab-content {overflow: visible;}
input, textarea, .uneditable-input {width: auto;}
input[type="radio"], input[type="checkbox"] {margin: 0 3px 0 0;}

label{vertical-align:middle;font-weight:normal;font-size:14px;display:inline-block;margin-bottom:5px;}
label input{border-radius:0!important;color:#858585;background-color:#fff;border:1px solid #d5d5d5;padding:5px 4px;line-height:1.2; font-size:14px;font-family:inherit;-webkit-box-shadow:none!important;box-shadow:none!important;-webkit-transition-duration:.1s; transition-duration:.1s;background-image:none;margin:0;-webkit-appearance:textfield; }
.form-submit-btn{padding-left:100px;height:60px;margin-top:30px;}
.aa{display:none;}
.priceblock{width:100%;height:50px;background:#f5f5f5;line-height:50px;border:1px solid #eeeeee;margin:10px auto;}
.deletefield,.addsonfield,.sondeletefield{width:50px;height:50px;float:right;background:#eeeeee;color:#FF0000;font-weight:bold;line-height:50px;text-align:center;cursor:pointer;}
.addsonfield{width:100px;border-right:1px solid #ffffff;color:blue;}
.natureblock{border:1px solid #eeeeee;padding:0px;margin:10px;}
.natureblock .fieldblock{width:100%;margin:0 auto;height:50px;background:#f5f5f5;line-height:50px;}
.sonfieldblock{width:90%;margin:5px auto;height:40px;background:#cccccc;line-height:40px;}
.sonfieldblock .sondeletefield{height:40px;line-height:40px;}
</style>
</head>


<div class="main-content">

  <div class="page-content">
    <!-- /section:settings.box -->
    <div class="page-content-area">

      <div class="row">
        <div class="col-sm-11">
          <form enctype="multipart/form-data" class="form-horizontal" id="food-form" action="?sid=<?php echo $_smarty_tpl->tpl_vars['sid']->value;?>
&id=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" method="post">
            <div class="tabbable">
              <ul class="nav nav-tabs tt" id="myTab">
                <li class="active"><a data-toggle="tab" href="#">基本信息</a></li>
                <li><a data-toggle="tab" href="#">商品属性</a></li>
                <li><a data-toggle="tab" href="#">商品限购设置</a></li>
                <li><a data-toggle="tab" href="#">商品图片</a></li>
              </ul>
              <div class="tab-content">
                <!-- 基本信息start -->
                <div id="infocontent" class="tab-pane active tt_1">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label class="col-sm-1"><label for="Food_tag">编号</label></label>
                        <input class="col-sm-1" size="10" maxlength="10" name="sort" id="Food_tag" type="text" value="<?php echo sprintf("%d",$_smarty_tpl->tpl_vars['sort']->value);?>
">（决定展示顺序，编号越大越靠前）</div>
                      <div class="form-group">
                        <label class="col-sm-1"><label for="Food_name">商品名称</label></label>
                        <input class="col-sm-3" size="30" maxlength="30" name="title" id="Food_name" type="text" value="<?php echo $_smarty_tpl->tpl_vars['title']->value;?>
"></div>
                      <div class="form-group">
                        <label class="col-sm-1"><label for="Food_price">价格</label></label>
                        <input class="col-sm-1" name="price" id="Food_price" type="text" value="<?php echo $_smarty_tpl->tpl_vars['price']->value;?>
"></div>
                      <div class="form-group">
                        <label class="col-sm-1" for="Food_type_id">商品分类</label>
                        <select name="typeid" id="Food_type_id">
                            <?php  $_smarty_tpl->tpl_vars['type'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['type']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['typelist']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['type']->key => $_smarty_tpl->tpl_vars['type']->value) {
$_smarty_tpl->tpl_vars['type']->_loop = true;
?>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['type']->value['id'];?>
"<?php if ($_smarty_tpl->tpl_vars['typeid']->value==$_smarty_tpl->tpl_vars['type']->value['id']) {?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['type']->value['title'];?>
</option>
                            <?php } ?>
                        </select>
                        <span id="secondtypehtml"></span>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-1"><label for="Food_unit">商品单位</label></label>
                        <input class="col-sm-1" size="20" maxlength="4" placeholder="如个、斤、份" name="unit" id="Food_unit" type="text" value="<?php echo $_smarty_tpl->tpl_vars['unit']->value;?>
"></div>
                      <div class="form-group">
                        <label class="col-sm-1"><label for="Food_label">标签</label></label>
                        <input class="col-sm-1" size="20" maxlength="4" placeholder="如特价、促销、招牌" name="label" id="Food_label" type="text" value="<?php echo $_smarty_tpl->tpl_vars['label']->value;?>
"></div>
                      <div class="form-group">
                        <label class="col-sm-1" for="Food_is_dabao">是否开启打包费</label>
                        <select name="is_dabao" id="Food_is_dabao">
                          <option value="0"<?php if (!$_smarty_tpl->tpl_vars['is_dabao']->value) {?> selected<?php }?>>关闭</option>
                          <option value="1"<?php if ($_smarty_tpl->tpl_vars['is_dabao']->value) {?> selected<?php }?>>开启</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-1"><label for="Food_dabao_money">打包费金额</label></label>
                        <input class="col-sm-1" name="dabao_money" id="Food_dabao_money" type="text" value="<?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['dabao_money']->value);?>
">
                      </div>
                      <div class="form-group">
                        <label class="col-sm-1" for="Food_status">商品状态</label>
                        <select name="status" id="Food_status">
                          <option value="1"<?php if ($_smarty_tpl->tpl_vars['status']->value||$_smarty_tpl->tpl_vars['status']->value=='') {?> selected<?php }?>>正常</option>
                          <option value="0"<?php if (!$_smarty_tpl->tpl_vars['status']->value&&$_smarty_tpl->tpl_vars['status']->value!='') {?> selected<?php }?>>停售</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-1" for="Food_stockvalid">启用库存</label>
                        <select name="stockvalid" id="Food_stockvalid">
                          <option value="1"<?php if ($_smarty_tpl->tpl_vars['stockvalid']->value) {?> selected<?php }?>>启用</option>
                          <option value="0"<?php if (!$_smarty_tpl->tpl_vars['stockvalid']->value) {?> selected<?php }?>>关闭</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-1"><label for="Food_stock">库存量</label></label>
                        <input class="col-sm-1" size="10" maxlength="10" name="stock" id="Food_stock" type="text" value="<?php echo sprintf("%d",$_smarty_tpl->tpl_vars['stock']->value);?>
">
                      </div>
                      <div class="form-group">
                        <label class="col-sm-1"><label for="Food_formerprice">原价</label></label>
                        <input class="col-sm-1" name="formerprice" id="Food_formerprice" type="text" value="<?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['formerprice']->value);?>
">
                      </div>
                      <div class="form-group">
                        <label class="col-sm-1" for="Food_descript">商品简介</label>
                        <textarea class="col-sm-3" size="200" maxlength="200" name="descript" id="Food_descript"><?php echo $_smarty_tpl->tpl_vars['descript']->value;?>
</textarea>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-1" for="content">描述</label>
                        <div class="col-sm-8" style="padding-left: 0;">
                            <?php echo '<script'; ?>
 id="body" name="body" type="text/plain" style="width:100%;height:500px"><?php echo $_smarty_tpl->tpl_vars['body']->value;?>
<?php echo '</script'; ?>
>
                        </div>
                      </div>
                      <div id="inputimglist" style="display:none"></div>
                    </div>
                  </div>
                </div>
                <!-- 基本信息end -->
                <!-- 自定义属性start -->
                <div id="nature" class="tab-pane tt_1">
                  <div class="alert alert-block alert-success">
                    商品的最终价格是基本信息中商品的基础价格与选择的各属性价格总和，如果不希望某个属性值带上价格，可以将它的属性价格设为0，
                    <br>
                    <span style="color:red;">商品属性可灵活运用于各场景，比如套餐、大杯小杯、冷饮热饮、辣或不辣等等，顾客选择的属性信息将在打印机、短信、邮件、管理后台等各种订单提醒方式中展示。</span>
                    <button type="button" class="close" data-dismiss="alert">
                      <i class="ace-icon fa fa-times"></i>
                    </button>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2" for="Food_is_nature">是否开启商品属性</label>
                    <select name="is_nature" id="Food_is_nature">
                      <option value="1"<?php if ($_smarty_tpl->tpl_vars['is_nature']->value) {?> selected<?php }?>>开启</option>
                      <option value="0"<?php if (!$_smarty_tpl->tpl_vars['is_nature']->value) {?> selected<?php }?>>关闭</option>
                    </select>
                  </div>
                  <div class="widget-box" style="width:100%;margin-left:0px;padding:0px;">
                    <div class="widget-header">
                      <h5>商品属性</h5></div>
                    <div class="widget-body shuxing" style="padding:20px;" id="natureblocklist">
                      <button class="btn btn-success" type="button" id="addpricenature">添加商品属性</button>

                      <?php if ($_smarty_tpl->tpl_vars['id']->value) {?>
                      <?php $_smarty_tpl->tpl_vars['index'] = new Smarty_variable(100, null, 0);?>
                      <?php  $_smarty_tpl->tpl_vars['n'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['n']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['nature']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['n']->key => $_smarty_tpl->tpl_vars['n']->value) {
$_smarty_tpl->tpl_vars['n']->_loop = true;
?>
                      <div class="natureblock fatherblock">
                          <div class="fieldblock">
                              <label>属性名: <input type="text" name="nature[<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
][name]" value="<?php echo $_smarty_tpl->tpl_vars['n']->value['name'];?>
" style="width:80px;"></label>
                              <div class="deletefield" style="" title="删除商品属性"> 删除 </div>
                              <div class="addsonfield" title="增加属性值" onclick="addsonnaturepriceblock(this,<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
);"> 增加属性值 </div>
                          </div>
                          <?php  $_smarty_tpl->tpl_vars['p'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['p']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['n']->value['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['p']->key => $_smarty_tpl->tpl_vars['p']->value) {
$_smarty_tpl->tpl_vars['p']->_loop = true;
?>
                          <div class="sonfieldblock fatherblock">
                              <label>属性值: <input type="text" value="<?php echo $_smarty_tpl->tpl_vars['p']->value['value'];?>
" name="nature[<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
][value][]"></label>
                              <label>价格: <input type="text" value="<?php echo sprintf("%d",$_smarty_tpl->tpl_vars['p']->value['price']);?>
" name="nature[<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
][price][]"></label>
                              <div class="sondeletefield">删除</div>
                          </div>
                          <?php } ?>
                      </div>
                      <?php $_smarty_tpl->tpl_vars['index'] = new Smarty_variable($_smarty_tpl->tpl_vars['index']->value+1, null, 0);?>
                      <?php } ?>
                      <?php }?>

                    </div>
                    <div style="clear:both;"></div>
                  </div>
                </div>
                <!-- 自定义属性 end-->
                <!-- 限购设置 start -->
                <div id="limitfood" class="tab-pane tt_1">
                  <div class="widget-box" style="width:100%;margin-left:0px;padding:0px;">
                    <div class="widget-header"><h5>每天限购</h5></div><br>
                    <div class="form-group" style="margin-left:5px;">
                      <label class="col-sm-1" for="Food_is_day_limitfood">是否开启商品每天限购</label>
                      <select name="is_day_limitfood" id="Food_is_day_limitfood">
                        <option value="0"<?php if (!$_smarty_tpl->tpl_vars['is_day_limitfood']->value) {?> selected<?php }?>>不开启</option>
                        <option value="1"<?php if ($_smarty_tpl->tpl_vars['is_day_limitfood']->value) {?> selected<?php }?>>开启</option>
                      </select>
                    </div>
                    <div class="form-group" style="margin-left:5px;">
                      <label class="col-sm-1"><label for="Food_day_foodnum">每天限购数量</label></label>
                      <input class="col-sm-1" size="5" maxlength="5" placeholder="每天限购的商品数量" style="width:50px;" name="day_foodnum" id="Food_day_foodnum" type="text" value="<?php if ($_smarty_tpl->tpl_vars['day_foodnum']->value) {
echo $_smarty_tpl->tpl_vars['day_foodnum']->value;
} else { ?>1<?php }?>">
                    </div>
                  </div>
                  <div class="widget-box" style="width:100%;margin-left:0px;padding:0px;">
                    <div class="widget-header"><h5>限购活动</h5></div><br>
                    <div class="row">
                      <div class="form-group" style="margin-left:5px;">
                        <label class="col-sm-1" for="Food_is_limitfood">是否开启限购活动</label>
                        <select name="is_limitfood" id="Food_is_limitfood">
                          <option value="0"<?php if (!$_smarty_tpl->tpl_vars['is_limitfood']->value) {?> selected<?php }?>>不开启</option>
                          <option value="1"<?php if ($_smarty_tpl->tpl_vars['is_limitfood']->value) {?> selected<?php }?>>开启</option>
                        </select>
                      </div>
                      <div class="form-group" style="margin-left:5px;">
                        <label class="col-sm-1"><label for="Food_foodnum">每人限购数量</label></label>
                        <input class="col-sm-1" size="5" maxlength="5" placeholder="每人限购的商品数量" style="width:50px;" name="foodnum" id="Food_foodnum" type="text" value="<?php if ($_smarty_tpl->tpl_vars['foodnum']->value) {
echo $_smarty_tpl->tpl_vars['foodnum']->value;
} else { ?>1<?php }?>">
                      </div>
                      <div class="widget-box" style="width:90%;margin-left:20px;padding:0px;">
                        <div class="widget-header"><h5>限制日期范围</h5></div>
                        <div class="widget-body" style="padding:20px;">开始日期:
                          <input id="StatisticsForm_beginDate" type="text" name="start_time" value="<?php echo $_smarty_tpl->tpl_vars['start_time']->value;?>
">
                          <br><br>结束日期:
                          <input id="StatisticsForm_endDate" type="text" name="stop_time" value="<?php echo $_smarty_tpl->tpl_vars['stop_time']->value;?>
">
                          <br><br>
                        </div>
                      </div>
                      <div class="widget-box" style="width:90%;margin-left:20px;padding:0px;">
                        <div class="widget-header"><h5>限制时间段</h5></div>
                        <div class="widget-body" style="padding:20px;">
                          <div style="margin:10px;width:400px;float:left;">(1)
                            <input id="delivertime_0_start" class="chooseTime" type="text" value="<?php if ($_smarty_tpl->tpl_vars['limit_time']->value[0][0]) {
echo $_smarty_tpl->tpl_vars['limit_time']->value[0][0];
} else { ?>00:00<?php }?>" name="limit_time[0][start]" >至
                            <input id="delivertime_0_stop" class="chooseTime" type="text" value="<?php if ($_smarty_tpl->tpl_vars['limit_time']->value[0][1]) {
echo $_smarty_tpl->tpl_vars['limit_time']->value[0][1];
} else { ?>00:00<?php }?>" name="limit_time[0][stop]" >
                          </div>
                          <div style="margin:10px;width:400px;float:left;">(2)
                            <input id="delivertime_1_start" class="chooseTime" type="text" value="<?php if ($_smarty_tpl->tpl_vars['limit_time']->value[1][0]) {
echo $_smarty_tpl->tpl_vars['limit_time']->value[1][0];
} else { ?>00:00<?php }?>" name="limit_time[1][start]" >至
                            <input id="delivertime_1_stop" class="chooseTime" type="text" value="<?php if ($_smarty_tpl->tpl_vars['limit_time']->value[1][1]) {
echo $_smarty_tpl->tpl_vars['limit_time']->value[1][1];
} else { ?>00:00<?php }?>" name="limit_time[1][stop]" >
                          </div>
                          <div style="margin:10px;width:400px;float:left;">(3)
                            <input id="delivertime_2_start" class="chooseTime" type="text" value="<?php if ($_smarty_tpl->tpl_vars['limit_time']->value[2][0]) {
echo $_smarty_tpl->tpl_vars['limit_time']->value[2][0];
} else { ?>00:00<?php }?>" name="limit_time[2][start]" >至
                            <input id="delivertime_2_stop" class="chooseTime" type="text" value="<?php if ($_smarty_tpl->tpl_vars['limit_time']->value[2][1]) {
echo $_smarty_tpl->tpl_vars['limit_time']->value[2][1];
} else { ?>00:00<?php }?>" name="limit_time[2][stop]" >
                          </div>
                          <div style="margin:10px;width:400px;float:left;">(4)
                            <input id="delivertime_3_start" class="chooseTime" type="text" value="<?php if ($_smarty_tpl->tpl_vars['limit_time']->value[3][0]) {
echo $_smarty_tpl->tpl_vars['limit_time']->value[3][0];
} else { ?>00:00<?php }?>" name="limit_time[3][start]" >至
                            <input id="delivertime_3_stop" class="chooseTime" type="text" value="<?php if ($_smarty_tpl->tpl_vars['limit_time']->value[3][1]) {
echo $_smarty_tpl->tpl_vars['limit_time']->value[3][1];
} else { ?>00:00<?php }?>" name="limit_time[3][stop]" >
                          </div>
                          <div style="margin:10px;width:400px;float:left;">(5)
                            <input id="delivertime_4_start" class="chooseTime" type="text" value="<?php if ($_smarty_tpl->tpl_vars['limit_time']->value[4][0]) {
echo $_smarty_tpl->tpl_vars['limit_time']->value[4][0];
} else { ?>00:00<?php }?>" name="limit_time[4][start]" >至
                            <input id="delivertime_4_stop" class="chooseTime" type="text" value="<?php if ($_smarty_tpl->tpl_vars['limit_time']->value[4][1]) {
echo $_smarty_tpl->tpl_vars['limit_time']->value[4][1];
} else { ?>00:00<?php }?>" name="limit_time[4][stop]" >
                          </div>
                          <div style="margin:10px;width:400px;float:left;">(6)
                            <input id="delivertime_5_start" class="chooseTime" type="text" value="<?php if ($_smarty_tpl->tpl_vars['limit_time']->value[5][0]) {
echo $_smarty_tpl->tpl_vars['limit_time']->value[5][0];
} else { ?>00:00<?php }?>" name="limit_time[5][start]" >至
                            <input id="delivertime_5_stop" class="chooseTime" type="text" value="<?php if ($_smarty_tpl->tpl_vars['limit_time']->value[5][1]) {
echo $_smarty_tpl->tpl_vars['limit_time']->value[5][1];
} else { ?>00:00<?php }?>" name="limit_time[5][stop]" >
                          </div>
                          <div style="clear:both;"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div id="imgcontent" class="tab-pane tt_1">

                    <div class="alert alert-block alert-success">支持jpg、jpeg、gif、png格式的图片&nbsp;&nbsp;单张最大1M，最多上传10张，为了达到最佳效果，建议上传宽度为600像素的图片</div>

                    <div class="listImgBox">
              			<div class="list-holder">
              				<ul id="listSection" class="clearfix listSection piece"></ul>
              				<input type="hidden" name="pics" value='[]' class="imglist-hidden">
              			</div>
              			<div class="btn-section clearfix">
              				<div class="uploadinp filePicker" id="filePicker" data-type="album" data-count="10" data-size="1024" data-imglist="pic"><div id="flasHolder"></div><span>添加图片</span></div>
              				<div class="upload-tip">
              					<p><a href="javascript:;" class="deleteAllAtlas" style="display:none;">删除所有</a>&nbsp;&nbsp;<span class="fileerror"></span></p>
              				</div>
              			</div>
                    </div>

				</div>

              </div>
            </div>

            <div class="clearfix form-actions">
              <button id="submitBtn" class="btn btn-info" type="submit" style="margin-left:200px;" onclick="return checkFrom(this.form)"><i class="ace-icon fa fa-check bigger-110"></i>保存</button>
            </div>

          </form>
        </div>
      </div>


    </div>
  </div>

<?php echo $_smarty_tpl->tpl_vars['editorFile']->value;?>

<?php echo $_smarty_tpl->tpl_vars['jsFile']->value;?>

<?php }} ?>
