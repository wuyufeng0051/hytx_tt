<?php require_once(dirname(__FILE__).'/common.inc.php');?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>视频预览</title>
<style>
* {padding:0; margin:0;}
</style>
</head>

<body>
<div id="video" style="position:relative;z-index: 100;width:650px;height:500px;float: left;"><div id="a1"></div></div>

<script type="text/javascript" src="../static/js/ui/ckplayer/ckplayer.js" charset="utf-8"></script>
<script type="text/javascript">
	var flashvars={
		f:'<?php echo getRealFilePath($_GET['f']);?>',
		c:0,
		p:1,
		e:0,
		m:0,
		o:0,
		w:0,
		v:80
		};
	CKobject.embedSWF('../static/js/ui/ckplayer/ckplayer.swf','a1','ckplayer_a1','650','500',flashvars);

	var video=['<?php echo getRealFilePath($_GET['f']);?>'];
	var support=['iPad','iPhone','ios','android+false','msie10+false'];
	CKobject.embedHTML5('video','ckplayer_a1',650,500,video,flashvars,support);
  </script>
</body>
</html>
