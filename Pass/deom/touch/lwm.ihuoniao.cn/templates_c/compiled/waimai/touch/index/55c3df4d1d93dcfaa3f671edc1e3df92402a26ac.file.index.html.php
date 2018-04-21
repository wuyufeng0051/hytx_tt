<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-06-21 17:53:51
         compiled from "D:\ServerWwwroot\www.lwm.com\templates\waimai\default\index.html" */ ?>
<?php /*%%SmartyHeaderCode:1327159156c177912f2-03589537%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '55c3df4d1d93dcfaa3f671edc1e3df92402a26ac' => 
    array (
      0 => 'D:\\ServerWwwroot\\www.lwm.com\\templates\\waimai\\default\\index.html',
      1 => 1498011322,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1327159156c177912f2-03589537',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_59156c17812190_80902782',
  'variables' => 
  array (
    'title' => 0,
    'cfg_basehost' => 0,
    'cfg_staticPath' => 0,
    'templets_skin' => 0,
    'banner' => 0,
    'b' => 0,
    'tubiao' => 0,
    't' => 0,
    'typeArr' => 0,
    'type' => 0,
    'waimai_channelDomain' => 0,
    'wxjssdk_appId' => 0,
    'wxjssdk_timestamp' => 0,
    'wxjssdk_nonceStr' => 0,
    'wxjssdk_signature' => 0,
    'description' => 0,
    'share_pic' => 0,
    'site_map_key' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59156c17812190_80902782')) {function content_59156c17812190_80902782($_smarty_tpl) {?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no" />
<title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
<link rel="shortcut icon" href="<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
/favicon.ico" />
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['cfg_staticPath']->value;?>
js/core/touchScale.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
js/zepto.min.js"><?php echo '</script'; ?>
>
<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
css/base.css">
<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
css/swiper.min.css">
<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
css/index.css?v=10">
<?php echo '<script'; ?>
 type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"><?php echo '</script'; ?>
>
</head>
<body>
  <!-- 头部 -->
  <div class="header">
  	<div class="header-address">
  		<span><a href="<?php echo getUrlPath(array('service'=>'waimai','template'=>'local'),$_smarty_tpl);?>
" class="fn-clear"><em>定位中..</em></a></span>
  	</div>
  	<div class="header-search">
  		<a href="<?php echo getUrlPath(array('service'=>'waimai','template'=>'search'),$_smarty_tpl);?>
" class="dropnav"></a>
  	</div>
  </div>
	<!-- 头部 end -->

  <?php if ($_smarty_tpl->tpl_vars['banner']->value) {?>
  <div class="wrapper">
    <div class="swiper-container swiper-container1">
      <div class="swiper-wrapper">
        <?php  $_smarty_tpl->tpl_vars['b'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['b']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['banner']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['b']->key => $_smarty_tpl->tpl_vars['b']->value) {
$_smarty_tpl->tpl_vars['b']->_loop = true;
?>
        <div class="slideshow-item">
          <a href="<?php echo $_smarty_tpl->tpl_vars['b']->value['link'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['b']->value['pic'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['b']->value['title'];?>
"></a>
        </div>
        <?php } ?>
      </div>
      <div class="pagination"></div>
    </div>
  </div>
  <?php }?>

  <?php if ($_smarty_tpl->tpl_vars['tubiao']->value) {?>
  <div class="swiper-container swiper-container2">
		<div class="swiper-wrapper">
			<div class="swiper-slide swiper-slide-active" style="width: 414px;">
				<ul class="nav fn-clear">
          <?php  $_smarty_tpl->tpl_vars['t'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['t']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['tubiao']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['t']->key => $_smarty_tpl->tpl_vars['t']->value) {
$_smarty_tpl->tpl_vars['t']->_loop = true;
?>
					<li>
						<a href="<?php echo $_smarty_tpl->tpl_vars['t']->value['link'];?>
">
							<span class="icon-circle"><img src="<?php echo $_smarty_tpl->tpl_vars['t']->value['pic'];?>
"></span><span class="icon-txt"><?php echo $_smarty_tpl->tpl_vars['t']->value['title'];?>
</span>
						</a>
					</li>
          <?php } ?>
				</ul>
			</div>
		</div>
		<div class="swiper-pagination"></div>
	</div>
  <?php }?>

  <!-- 优惠专区 s -->
  <div class="sale">
    <div class="yx-tit"><p><span>优惠专区</span></p></div>
    <div class="sale-slider">
      <div class="swiper-container swiper-container3">
        <div class="swiper-wrapper"><?php echo getMyAd(array('id'=>"166",'type'=>"slide"),$_smarty_tpl);?>
</div>
        <div class="pagination"></div>
      </div>
    </div>
    <div class="sale-img">
      <ul class="fn-clear">
        <?php echo getMyAd(array('id'=>"167"),$_smarty_tpl);?>

      </ul>
    </div>
  </div>
  <div class="sale-list">
    <div class="hideScrollBar">
      <ul class="fn-clear">
        <?php echo getMyAd(array('id'=>"168"),$_smarty_tpl);?>

      </ul>
    </div>
  </div>
  <!-- 优惠专区 e -->

  <!-- 为你优选 s -->
  <div class="youxuan">
    <div class="yx-tit"><p><span>为你优选</span></p></div>
    <ul class="fn-clear">
      <li>
        <a href="http://www.jindianshenghuo.com/waimai/buy-12.html">
          <img src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
upfile/14828215634976.png" alt="">
          <p class="store-tit">肯德基</p>
          <span class="store-status">点评高分店铺</span>
        </a>
      </li>
      <li>
        <a href="http://www.jindianshenghuo.com/waimai/buy-164.html">
          <img src="http://www.jindianshenghuo.com/uploads/waimai/atlas/large/2017/06/14/14974126835068.png" alt="">
          <p class="store-tit">永久香</p>
          <span class="store-status">金点口碑商家</span>
        </a>
      </li>
      <li>
        <a href="http://www.jindianshenghuo.com/waimai/buy-172.html">
          <img src="http://www.jindianshenghuo.com/uploads/waimai/atlas/large/2017/06/13/14973315301269.png" alt="">
          <p class="store-tit">有家卤肉饭</p>
          <span class="store-status">口味相仿爱吃</span>
        </a>
      </li>
      <li>
        <a href="http://www.jindianshenghuo.com/waimai/buy-173.html
                ">
          <img src="http://www.jindianshenghuo.com/uploads/waimai/atlas/large/2017/06/13/14973521946087.jpg
                   " alt="">
          <p class="store-tit">双流老妈兔头</p>
          <span class="store-status">为您精心挑选</span>
        </a>
      </li>
      <li>
        <a href="http://www.jindianshenghuo.com/waimai/buy-168.html">
          <img src="http://www.jindianshenghuo.com/uploads/waimai/atlas/large/2017/06/13/14973508128316.png" alt="">
          <p class="store-tit">老朋友宵夜</p>
          <span class="store-status">口味相仿爱吃</span>
        </a>
      </li>
      <li>
        <a href="http://www.jindianshenghuo.com/waimai/buy-68.html">
          <img src="http://www.jindianshenghuo.com/uploads/waimai/atlas/large/2017/06/14/14974027958766.png" alt="">
          <p class="store-tit">夷品记</p>
          <span class="store-status">店铺好评最多</span>
        </a>
      </li>
    </ul>
  </div>
  <!-- 为你优选 e -->

  <div class="choose-box">
    <div class="choose-tab">
      <ul>
        <li class="tab-typeid"><a href="javascript:;"><i><span>全部分类</span></i></a></li>
        <li class="tab-orderby"><a href="javascript:;"><i><span>综合排序</span></i></a></li>
        <li class="tab-yingye"><a href="javascript:;"><i><span>筛选</span></i></a></li>
      </ul>
    </div>
    <div class="choose-local">
      <div class="choose-slide choose-li" id="choose-classify">
        <ul data-type="typeid">
          <li class="active" data-id=""><a href="javascript:;">全部商家</a></li>
  				<?php  $_smarty_tpl->tpl_vars['type'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['type']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['typeArr']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['type']->key => $_smarty_tpl->tpl_vars['type']->value) {
$_smarty_tpl->tpl_vars['type']->_loop = true;
?>
          <li data-id="<?php echo $_smarty_tpl->tpl_vars['type']->value['id'];?>
"><a href="javascript:;"><b></b><?php echo $_smarty_tpl->tpl_vars['type']->value['title'];?>
<i></i></a></li>
  				<?php } ?>
        </ul>
      </div>
      <div class="choose-slide choose-li" id="choose-sort">
        <ul data-type='orderby'>
  				<li data-id="" class="active"><a href="javascript:;">默认排序</a></li>
  				<li data-id="1"><a href="javascript:;">距离最近</a></li>
  				<li data-id="2"><a href="javascript:;">销量最高</a></li>
  				<li data-id="3"><a href="javascript:;">起送价最低</a></li>
  				<li data-id="4"><a href="javascript:;">评论最多</a></li>
  			</ul>
      </div>
      <div class="choose-slide choose-li" id="choose-screen">
        <ul data-type='yingye'>
  				<li data-id="" class="active"><a href="javascript:;">不限状态</a></li>
  				<li data-id="1"><a href="javascript:;">营业中</a></li>
  			</ul>
      </div>
    </div>
  </div>


	<!-- 商家列表 -->
  <div class="near-box"></div>
	<!-- 商家列表 -->

	<!-- 底部 -->
	<div class="fixFooter">
	  <ul>
	    <li class="ficon1 active"><a href="<?php echo $_smarty_tpl->tpl_vars['waimai_channelDomain']->value;?>
"><i></i>首页</a></li>
	    <li class="ficon3"><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user','template'=>'order','module'=>'waimai'),$_smarty_tpl);?>
"><i></i>订单</a></li>
	    <li class="ficon5"><a href="<?php echo getUrlPath(array('service'=>'member','type'=>'user'),$_smarty_tpl);?>
"><i></i>我的</a></li>
	  </ul>
	</div>
	<!-- 底部 end  -->

  <div class="mask"></div>

<?php echo '<script'; ?>
 type="text/javascript">
    var wxconfig = {
        "appId": '<?php echo $_smarty_tpl->tpl_vars['wxjssdk_appId']->value;?>
',
        "timestamp": '<?php echo $_smarty_tpl->tpl_vars['wxjssdk_timestamp']->value;?>
',
        "nonceStr": '<?php echo $_smarty_tpl->tpl_vars['wxjssdk_nonceStr']->value;?>
',
        "signature": '<?php echo $_smarty_tpl->tpl_vars['wxjssdk_signature']->value;?>
',
        "description": '<?php echo $_smarty_tpl->tpl_vars['description']->value;?>
',
        "title": '<?php echo $_smarty_tpl->tpl_vars['title']->value;?>
',
        "imgUrl": '<?php echo $_smarty_tpl->tpl_vars['share_pic']->value;?>
',
        "link": '<?php echo $_smarty_tpl->tpl_vars['cfg_basehost']->value;?>
',
    };
    var typeid = '', orderby = '', yingye = '', lng = '', lat = '', page = 1, pageSize = 10;
<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="http://api.map.baidu.com/getscript?v=2.0&ak=<?php echo $_smarty_tpl->tpl_vars['site_map_key']->value;?>
&services=&t=<?php echo time();?>
"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
js/swiper.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
js/iscroll.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['templets_skin']->value;?>
js/index.js?v=12"><?php echo '</script'; ?>
>
</body>
</html>
<?php }} ?>
