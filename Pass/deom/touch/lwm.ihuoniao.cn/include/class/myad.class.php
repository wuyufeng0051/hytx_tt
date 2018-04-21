<?php  if(!defined('HUONIAOINC')) exit('Request Error!');
/**
 * 广告插件
 *
 * @version        $Id: myad.class.php 2014-12-18 下午15:48:25 $
 * @package        HuoNiao.class
 * @copyright      Copyright (c) 2013 - 2015, HuoNiao, Inc.
 * @link           http://www.huoniao.co/
 */

if(!function_exists('getMyAd')){
    function getMyAd($params, &$smarty = array()){
        extract ($params);
        global $dsql;

        //正常情况
        if(!empty($id)){
            $handels = new handlers("siteConfig", "adv");
            $return = $handels->getHandle($id);

            if($return['state'] == 100){
                $info = $return['info'];
                return getAdHtml($info, $type, $exp, $insert);
            }

        //分站广告
        }elseif(!empty($model) && !empty($title)){

            $handels = new handlers("siteConfig", "adv");
            $return = $handels->getHandle(array("model" => $model, "title" => $title));

            if($return['state'] == 100){
                $info = $return['info'];
                return getAdHtml($info, $type, $exp, $insert);
            }


        //分类广告
        }elseif(!empty($service) && !empty($typeid)){
            global $tplFloder;
            $tplFloder = str_replace("/", "", $tplFloder);
            $class = 1;
            switch ($type) {
                case 'slide':
                    $class = 2;
                    break;
                case 'stretch':
                    $class = 3;
                    break;
                case 'couplet':
                    $class = 4;
                    break;
                default:
                    $class = 1;
                    break;
            }
            $archives = $dsql->SetQuery("SELECT `id` FROM `#@__advlist` WHERE `state` = 1 AND `model` = '$service' AND `type` = $typeid AND `class` = $class AND `template` = '$tplFloder'");
            $results  = $dsql->dsqlOper($archives, "results");
            if($results){
                $id = $results[0]['id'];
                if(is_numeric($id)){
                    $handels = new handlers("siteConfig", "adv");
                    $return = $handels->getHandle($id);

                    if($return['state'] == 100){
                        $info = $return['info'];
                        return getAdHtml($info, $type, $exp, $insert);
                    }
                }
            }

        }
    }
}

if(!function_exists('getAdHtml')){
    function getAdHtml($info, $type, $exp, $insert){

        global $cfg_basehost;

        //普通广告
        if($info['class'] == 1){

            //代码
            if($info['type'] == "code"){
                return $info['body'];

            //文字
            }elseif($info['type'] == "text"){
                $sty = array();
                if(!empty($info['color'])){
                    $sty[] = "color:".$info['color'];
                }
                if(!empty($info['size'])){
                    $sty[] = "font-size:".$info['size']."px";
                }
                if($info['link'] == ""){
                    return '<font style="'.join("; ", $sty).'">'.$info['title'].'</font>';
                }else{
                    return '<a href="'.$info['link'].'" target="_blank" style="'.join("; ", $sty).'">'.$info['title'].'</a>';
                }

            //图片、flash
            }else{
                return getAttachHtml($info['src'], $info['href'], $info['title'], $info['width'], $info['height'], $exp, $insert);
            }

        //多图广告
        }elseif($info['class'] == 2){

            $list = array();

            //幻灯片【主要为了显示图片说明】
            if($type == "slide"){
                foreach ($info['list'] as $key => $value) {
                    $img = getAttachHtml($value['src'], $value['link'], $value['title'], $info['width'], $info['height']);
                    $href = "href='javascript:;' style='cursor:default;'";
                    if($value['link'] != ""){
                        $href = 'href="'.$value['link'].'" target="_blank"';
                    }
                    $list[] = '<div class="slideshow-item ad'.$key.'">'.$img.'<div class="slideinfo"><h3><a '.$href.'>'.$value['title'].'</a></h3><p>'.$value['desc'].'</p><div class="bg"></div></div></div>';
                }

            //图片列表
            }else{
                foreach ($info['list'] as $key => $value) {
                    $img = getAttachHtml($value['src'], $value['link'], $value['title'], $info['width'], $info['height'], false, $insert);
                    if($value['link'] != ""){
                        $list[] = '<li>'.$img.'<span><a href="'.$value['link'].'" target="_blank">'.$value['title'].'</a></span></li>';
                    }else{
                        $list[] = '<li>'.$img.'<span><a href="javascript:;" style="cursor:default;">'.$value['title'].'</a></span></li>';
                    }
                }
            }
            return join("", $list);

        //伸缩广告
        }elseif($info['class'] == 3){
            $id = create_check_code(6);
            $html = array();
            $imgSmall = getAttachHtml($info['small'], $info['link'], "", $info['width'], $info['smallHeight']);
            $imgLarge = getAttachHtml($info['large'], $info['link'], "", $info['width'], $info['largeHeight']);
            $html[] = '<div id="stretch_'.$id.'"><div id="stretch_body_'.$id.'">'.$imgSmall.'</div><div class="adClose"><i></i><span class="kai"></span></div></div>';
            $html[] = '<script type="text/javascript" src="http://'.$cfg_basehost.'/static/js/ui/jquery.stretch.js"></script>';
            $html[] = '<script type="text/javascript">$(function(){stretchAd("'.$id.'", \''.$imgSmall.'\', \''.$imgLarge.'\', '.$info['smallHeight'].', '.$info['largeHeight'].', '.$info['time'].');});</script>';
            return join("", $html);

        //对联广告
        }elseif($info['class'] == 4){
            $html = array();
            $left = getAttachHtml($info['left']['src'], $info['left']['link'], $info['left']['title'], $info['adwidth'], $info['adheight']);
            $right = getAttachHtml($info['right']['src'], $info['right']['link'], $info['right']['title'], $info['adwidth'], $info['adheight']);

            $html[] = '<script type="text/javascript" src="http://'.$cfg_basehost.'/static/js/ui/jquery.couplet.js"></script>';
            $html[] = '<script type="text/javascript">$(function(){couplet(\''.$left.'\', \''.$right.'\', '.$info['width'].', '.$info['adwidth'].', '.$info['adheight'].', '.$info['topheight'].');});</script>';
            return join("", $html);
        }
    }
}
