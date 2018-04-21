<?php
/**
 * 店铺管理 新建店铺
 *
 * @version        $Id: waimaiCourierAdd.php 2017-5-26 上午11:19:16 $
 * @package        HuoNiao.Courier
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */
define('HUONIAOADMIN', ".." );
require_once(dirname(__FILE__)."/../inc/config.inc.php");
$dsql = new dsql($dbo);
$userLogin = new userLogin($dbo);
$tpl = dirname(__FILE__)."/../templates/waimai";
$huoniaoTag->template_dir = $tpl; //设置后台模板目录

$dbname = "waimai_courier";
$templates = "waimaiCourierAdd.html";

//表单提交
if($_POST){

    //获取表单数据
    $id  = (int)$id;
    $sex = (int)$sex;

    //店铺名称
    if(trim($name) == ""){
		echo '{"state": 200, "info": "请输入姓名"}';
		exit();
	}

    //用户名
    if(trim($username) == ""){
		echo '{"state": 200, "info": "请输入用户名"}';
		exit();
	}

    //密码
    if(trim($password) == ""){
		echo '{"state": 200, "info": "请输入密码"}';
		exit();
	}

    //手机号
    if(trim($phone) == ""){
		echo '{"state": 200, "info": "请输入手机号码"}';
		exit();
	}

    //验证是否存在
    if($id){

        //先验证店铺是否存在
        $sql = $dsql->SetQuery("SELECT `id` FROM `#@__$dbname` WHERE `id` = $id");
        $ret = $dsql->dsqlOper($sql, "totalCount");
        if($ret <= 0){
            echo '{"state": 200, "info": "配送员不存在或已经删除！"}';
			exit();
        }

        $sql = $dsql->SetQuery("SELECT `id` FROM `#@__$dbname` WHERE (`name` = '$name' OR `username` = '$username' OR `phone` = '$phone') AND `id` != '$id'");
		$ret = $dsql->dsqlOper($sql, "results");
		if($ret){
			echo '{"state": 200, "info": "配送员已经存在！"}';
			exit();
		}

    }else{
        $sql = $dsql->SetQuery("SELECT `id` FROM `#@__$dbname` WHERE `name` = '$name' OR `username` = '$username' OR `phone` = '$phone'");
		$ret = $dsql->dsqlOper($sql, "results");
		if($ret){
			echo '{"state": 200, "info": "配送员已经存在！"}';
			exit();
		}
    }


    //修改
    if($id){

        $sql = $dsql->SetQuery("UPDATE `#@__$dbname` SET
            `name` = '$name',
            `username` = '$username',
            `password` = '$password',
            `phone` = '$phone',
            `age` = '$age',
            `sex` = '$sex',
            `photo` = '$photo'
          WHERE `id` = $id
        ");
        $ret = $dsql->dsqlOper($sql, "update");
        if($ret == "ok"){
			echo '{"state": 100, "info": '.json_encode("保存成功！").'}';
		}else{
			echo '{"state": 200, "info": "数据更新失败，请检查填写的信息是否合法！"}';
		}
        die;


    //新增
    }else{

        //保存到主表
		$archives = $dsql->SetQuery("INSERT INTO `#@__$dbname` (
            `name`,
            `username`,
            `password`,
            `phone`,
            `age`,
            `sex`,
            `photo`
        ) VALUES (
            '$name',
            '$username',
            '$password',
            '$phone',
            '$age',
            '$sex',
            '$photo'
        )");
		$aid = $dsql->dsqlOper($archives, "lastid");

		if($aid){
			echo '{"state": 100, "id": '.$aid.', "info": '.json_encode("添加成功！").'}';
		}else{
			echo '{"state": 200, "info": "数据插入失败，请检查填写的信息是否合法！"}';
		}
		die;

    }

}


//验证模板文件
if(file_exists($tpl."/".$templates)){

    //css
	$cssFile = array(
		'admin/bootstrap1.css',
		'admin/jquery-ui.css',
		'admin/styles.css',
		'admin/chosen.min.css',
		'admin/ace-fonts.min.css',
		'admin/select.css',
		'admin/ace.min.css',
		'admin/animate.css',
		'admin/font-awesome.min.css',
		'admin/simple-line-icons.css',
		'admin/font.css',
		// 'admin/app.css'
	);
	$huoniaoTag->assign('cssFile', includeFile('css', $cssFile));

    //js
	$jsFile = array(
		'ui/bootstrap.min.js',
		'ui/jquery-ui.min.js',
		'ui/jquery.form.js',
		'ui/jquery.dragsort-0.5.1.min.js',
		'publicUpload.js',
		'admin/waimai/waimaiCourierAdd.js'
	);
	$huoniaoTag->assign('jsFile', includeFile('js', $jsFile));



    //获取信息内容
    if($id){
        $sql = $dsql->SetQuery("SELECT * FROM `#@__$dbname` WHERE `id` = $id");
        $ret = $dsql->dsqlOper($sql, "results");
        if($ret){

            foreach ($ret[0] as $key => $value) {
                $huoniaoTag->assign($key, $value);
            }

        }else{
            showMsg("没有找到相关信息！", "-1");
            die;
        }
    }

	$huoniaoTag->display($templates);
}else{
	echo $templates."模板文件未找到！";
}
