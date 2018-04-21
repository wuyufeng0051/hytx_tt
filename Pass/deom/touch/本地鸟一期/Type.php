<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/1/15
 * Time: 11:32
 */

namespace app\admin\controller;

use app\admin\model\Classify1;
use app\admin\model\Classify2;
use app\admin\model\Query1;
use app\admin\model\Query;
use think\Request;
use think\Db;
use app\admin\model\Manager;
use think\Session;

class Type extends Admin
{
    protected $beforeActionList=[
        'code',
        'power'
    ];

    protected function code(){
        $this->assign('code','type');
    }

    protected function power(){
        $name=Session::get('bird_admin');
        $pwd=Session::get('bird_admin_password');
        $admin=Manager::where('manager_acc',$name)->where('manager_pwd',$pwd)->find();
        if($admin['manager_level']=='区域管理'){
            $this->redirect('login/index');
        }
    }

    public function index(){
        $list=Classify1::paginate();

        foreach($list as $v){
            $a=Classify2::where('classify2_superior',$v->classify_id)->where('classify2_status',0)->field('classify2_name,classify2_id')->select();
            // $a=implode(' , ',$a);
 
            $v['type2']=$a;
        }
  
         // dump($list[0]['type2']);
        return view('',['list'=>$list,'page'=>$list->render()]);
    }

    public function edit(Request $request){
        $param=$request->param();
        $rend=Classify1::get($param['id']);
        $a=Classify2::where('classify2_superior',$param['id'])->where('classify2_status',0)->column('classify2_name');
        $a=implode(',',$a);
        $rend['type2']=$a;
       return view('',['rend'=>$rend]);
   }

    public function change(Request $request){
        $param=$request->param();
        $before=Classify2::where('classify2_superior',$param['classify_id'])->column('classify2_name');
        $after=explode(',',$param['type2']);
        //被删的
        $del=array_diff($before,$after);
 
        if(!empty($del)) {
             foreach ($del as $key => $v) {
             // echo $where = 'classify2_superior = '.$param['classify_id']." and  classify2_name = ".$v;
               $daty['classify2_status'] = 1;
               $res = Db::table('bird_classify2')->where('classify2_superior = '.$param['classify_id']." and  classify2_name = '".$v."'")->update($daty);
              }
        }
        //新增的
        $add=array_diff($after,$before);
        if(!empty($add)) {
            foreach($add as $v){
                $type=new Classify2;
                $type->classify2_name=$v;
                $type->classify2_superior=$param['classify_id'];
                $type->save();
            }
        }
        return ['code'=>0];
    }

   
   public function number(){
       // $param=$request->param();
         $list = Query1::where('query1_type = 0')->select();
        
        foreach ($list as $key => $value) {
          $list[$key]['name'] = Query::where('query_key = '.$value['query1_id'])->select();
        }
         return view('',['list'=>$list]);
    }
   

    public function queryedit(){
        $id = $_GET['id'];
        $list = Query::where('query_id = '.$id)->find();
        
        $res = explode('-',$list['query_val']);
        $res1 = explode('>',$list['query_val']);
        $res2 = explode('<',$list['query_val']);
        if (!empty($res[1])){
            $list['val'] = 1;
            $list['val1'] = $res[0];
            $list['val2'] = $res[1];
        }else if(!empty($res1[1])){
            $list['val'] = 2;
            $list['val1'] = $res1[1];
        }else if(!empty($res2[1])){
            $list['val'] = 3;
            $list['val1'] = $res2[1];
        }else{
            $list['val'] = 4;
         }
        return view('',['list'=>$list]);
    }


    public function savequery(){
        // $type=new Query; 
        $name = $_POST['name'];
        $typequery = $_POST['typequery'];
     
        $type['query_val']= $_POST['val'];
        $valtype = $_POST['valtype'];
        $id = $_POST['id'];

        if ($valtype == 3) {
            if ($typequery == 1) { 
             $type['query_name'] = $name."元/月";
            }else if ($typequery == 2){
             $type['query_name'] = $name."元以上";
            }else if ($typequery == 3){
             $type['query_name'] = $name."元以下";
            } 
        }else if($valtype == 8){
            if ($typequery == 1) { 
             $type['query_name'] = $name."万";
            }else if ($typequery == 2){
             $type['query_name'] = $name."万以上";
            }else if ($typequery == 3){
             $type['query_name'] = $name."万以下";
            } 
        }else if($valtype == 12){
            if ($typequery == 1) { 
             $type['query_name'] = $name."万";
            }else if ($typequery == 2){
             $type['query_name'] = $name."万以上";
            }else if ($typequery == 3){
             $type['query_name'] = $name."万以下";
            } 
        }else if($valtype == 18){
           if ($typequery == 1) { 
             $type['query_name'] = $name."万";
            }else if ($typequery == 2){
             $type['query_name'] = $name."万以上";
            }else if ($typequery == 3){
             $type['query_name'] = $name."万以下";
            } 
        }else if($valtype == 5 || $valtype == 9 || $valtype == 14 || $valtype == 17){
            if ($typequery == 1) { 
            $type['query_name'] = $name."㎡";
            }else if ($typequery == 2){
            $type['query_name'] = $name."㎡以上";
            }else if ($typequery == 3){
            $type['query_name'] = $name."㎡以下";
            }
        }
        
      
        $res=  Db::table('bird_query')->where('query_id = '.$id)->update($type);
        return $res;
         // $this->redirect('login/index');
     }


    public function useragreement(){
        $res=  Db::table('bird_agreement')->where('agreement_id = 1')->select();

         return view('',['res'=>$res]);
    }

    public function edituseragreement(){
        $type['agreement_desc'] = $_POST['agreement_desc'];
        $res=  Db::table('bird_agreement')->where('agreement_id = 1')->update($type);
        return $res;
        // return $res;
    }

   

   public function editclass(){
    //编辑或删除
    $classify2_id = $_GET['classify2_id'];
    // dump($classify2_id);die;
    $res= Db::table('bird_classify2')->where('classify2_id = '.$classify2_id)->find();
    $res_one =Db::table('bird_classify1')->where('classify_id = '.$res['classify2_superior'])->find();
    // dump($res['classify2_superior']);
    return view('',['res'=>$res,'res_one'=>$res_one]);
   }

   public function resone(){
    // return $_POST['classify2_id'];
         $daty['classify2_name']= $_POST['classify2_name'];
         $res_one =Db::table('bird_classify2')->where('classify2_id = '.$_POST['classify2_id'])->update($daty);
         return $res_one;
   }

      public function resonedel(){
    // return $_POST['classify2_id'];
         $daty['classify2_status']= 1;
         $res_one =Db::table('bird_classify2')->where('classify2_id = '.$_POST['classify2_id'])->update($daty);
         return $res_one;
   }

   public function addclassify(){
    $classify_id = $_GET['classify_id'];
    $res_one =Db::table('bird_classify1')->where('classify_id = '.$classify_id)->find();
    return view('',['res_one'=>$res_one]);
   }
   
    public function assclassify(){
    $day['classify2_superior'] = $_POST['classify2_superior'];
    $day['classify2_name'] = $_POST['classify2_name'];
    $res_one =Db::table('bird_classify2')->insert($day);
    return $res_one;
   }

   public function car_list(){
      $list=Classify1::paginate();

        foreach($list as $v){
            $a=Classify2::where('classify2_superior',$v->classify_id)->where('classify2_status',0)->field('classify2_name,classify2_id')->select();
            // $a=implode(' , ',$a);
 
            $v['type2']=$a;
        }
  
         // dump($list[0]['type2']);
        return view('',['list'=>$list,'page'=>$list->render()]);

   }
  public function cL_add(){
      $list=Classify1::paginate();

        foreach($list as $v){
            $a=Classify2::where('classify2_superior',$v->classify_id)->where('classify2_status',0)->field('classify2_name,classify2_id')->select();
            // $a=implode(' , ',$a);
 
            $v['type2']=$a;
        }
  
         // dump($list[0]['type2']);
        return view('',['list'=>$list,'page'=>$list->render()]);
   }
   public function business_list(){
      $list=Classify1::paginate();

        foreach($list as $v){
            $a=Classify2::where('classify2_superior',$v->classify_id)->where('classify2_status',0)->field('classify2_name,classify2_id')->select();
            // $a=implode(' , ',$a);
 
            $v['type2']=$a;
        }
  
         // dump($list[0]['type2']);
        return view('',['list'=>$list,'page'=>$list->render()]);
   }
   public function bL_add(){
      $list=Classify1::paginate();

        foreach($list as $v){
            $a=Classify2::where('classify2_superior',$v->classify_id)->where('classify2_status',0)->field('classify2_name,classify2_id')->select();
            // $a=implode(' , ',$a);
 
            $v['type2']=$a;
        }
  
         // dump($list[0]['type2']);
        return view('',['list'=>$list,'page'=>$list->render()]);
   }
   public function dating_list(){
      $list=Classify1::paginate();

        foreach($list as $v){
            $a=Classify2::where('classify2_superior',$v->classify_id)->where('classify2_status',0)->field('classify2_name,classify2_id')->select();
            // $a=implode(' , ',$a);
 
            $v['type2']=$a;
        }
  
         // dump($list[0]['type2']);
        return view('',['list'=>$list,'page'=>$list->render()]);
   }
   public function dat_add(){
      $list=Classify1::paginate();

        foreach($list as $v){
            $a=Classify2::where('classify2_superior',$v->classify_id)->where('classify2_status',0)->field('classify2_name,classify2_id')->select();
            // $a=implode(' , ',$a);
 
            $v['type2']=$a;
        }
  
         // dump($list[0]['type2']);
        return view('',['list'=>$list,'page'=>$list->render()]);
   }
   public function che_add(){
      $list=Classify1::paginate();

        foreach($list as $v){
            $a=Classify2::where('classify2_superior',$v->classify_id)->where('classify2_status',0)->field('classify2_name,classify2_id')->select();
            // $a=implode(' , ',$a);
 
            $v['type2']=$a;
        }
  
         // dump($list[0]['type2']);
        return view('',['list'=>$list,'page'=>$list->render()]);
   }
   public function che_list(){
      $list=Classify1::paginate();

        foreach($list as $v){
            $a=Classify2::where('classify2_superior',$v->classify_id)->where('classify2_status',0)->field('classify2_name,classify2_id')->select();
            // $a=implode(' , ',$a);
 
            $v['type2']=$a;
        }
  
         // dump($list[0]['type2']);
        return view('',['list'=>$list,'page'=>$list->render()]);
   }
   public function huo_add(){
      $list=Classify1::paginate();

        foreach($list as $v){
            $a=Classify2::where('classify2_superior',$v->classify_id)->where('classify2_status',0)->field('classify2_name,classify2_id')->select();
            // $a=implode(' , ',$a);
 
            $v['type2']=$a;
        }
  
         // dump($list[0]['type2']);
        return view('',['list'=>$list,'page'=>$list->render()]);
   }
   public function huo_list(){
      $list=Classify1::paginate();

        foreach($list as $v){
            $a=Classify2::where('classify2_superior',$v->classify_id)->where('classify2_status',0)->field('classify2_name,classify2_id')->select();
            // $a=implode(' , ',$a);
 
            $v['type2']=$a;
        }
  
         // dump($list[0]['type2']);
        return view('',['list'=>$list,'page'=>$list->render()]);
   }
   public function turntable(){
      $list=Classify1::paginate();

        foreach($list as $v){
            $a=Classify2::where('classify2_superior',$v->classify_id)->where('classify2_status',0)->field('classify2_name,classify2_id')->select();
            // $a=implode(' , ',$a);
 
            $v['type2']=$a;
        }
  
         // dump($list[0]['type2']);
        return view('',['list'=>$list,'page'=>$list->render()]);
   }
   public function turn_record(){
      $list=Classify1::paginate();

        foreach($list as $v){
            $a=Classify2::where('classify2_superior',$v->classify_id)->where('classify2_status',0)->field('classify2_name,classify2_id')->select();
            // $a=implode(' , ',$a);
 
            $v['type2']=$a;
        }
  
         // dump($list[0]['type2']);
        return view('',['list'=>$list,'page'=>$list->render()]);
   }
   public function turn_qian(){
      $list=Classify1::paginate();

        foreach($list as $v){
            $a=Classify2::where('classify2_superior',$v->classify_id)->where('classify2_status',0)->field('classify2_name,classify2_id')->select();
            // $a=implode(' , ',$a);
 
            $v['type2']=$a;
        }
  
         // dump($list[0]['type2']);
        return view('',['list'=>$list,'page'=>$list->render()]);
   }
   public function secondhand_list(){
      $list=Classify1::paginate();

        foreach($list as $v){
            $a=Classify2::where('classify2_superior',$v->classify_id)->where('classify2_status',0)->field('classify2_name,classify2_id')->select();
            // $a=implode(' , ',$a);
 
            $v['type2']=$a;
        }
  
         // dump($list[0]['type2']);
        return view('',['list'=>$list,'page'=>$list->render()]);
   }
   public function secondhand_add(){
      $list=Classify1::paginate();

        foreach($list as $v){
            $a=Classify2::where('classify2_superior',$v->classify_id)->where('classify2_status',0)->field('classify2_name,classify2_id')->select();
            // $a=implode(' , ',$a);
 
            $v['type2']=$a;
        }
  
         // dump($list[0]['type2']);
        return view('',['list'=>$list,'page'=>$list->render()]);
   }
   public function zhuan_set(){
      $list=Classify1::paginate();

        foreach($list as $v){
            $a=Classify2::where('classify2_superior',$v->classify_id)->where('classify2_status',0)->field('classify2_name,classify2_id')->select();
            // $a=implode(' , ',$a);
 
            $v['type2']=$a;
        }
  
         // dump($list[0]['type2']);
        return view('',['list'=>$list,'page'=>$list->render()]);
   }
   public function quanzhi_add(){
      $list=Classify1::paginate();

        foreach($list as $v){
            $a=Classify2::where('classify2_superior',$v->classify_id)->where('classify2_status',0)->field('classify2_name,classify2_id')->select();
            // $a=implode(' , ',$a);
 
            $v['type2']=$a;
        }
  
         // dump($list[0]['type2']);
        return view('',['list'=>$list,'page'=>$list->render()]);
   }
   public function jianzhi_add(){
      $list=Classify1::paginate();

        foreach($list as $v){
            $a=Classify2::where('classify2_superior',$v->classify_id)->where('classify2_status',0)->field('classify2_name,classify2_id')->select();
            // $a=implode(' , ',$a);
 
            $v['type2']=$a;
        }
  
         // dump($list[0]['type2']);
        return view('',['list'=>$list,'page'=>$list->render()]);
   }
   public function jianli_add(){
      $list=Classify1::paginate();

        foreach($list as $v){
            $a=Classify2::where('classify2_superior',$v->classify_id)->where('classify2_status',0)->field('classify2_name,classify2_id')->select();
            // $a=implode(' , ',$a);
 
            $v['type2']=$a;
        }
  
         // dump($list[0]['type2']);
        return view('',['list'=>$list,'page'=>$list->render()]);
   }
   public function house_add(){
      $list=Classify1::paginate();

        foreach($list as $v){
            $a=Classify2::where('classify2_superior',$v->classify_id)->where('classify2_status',0)->field('classify2_name,classify2_id')->select();
            // $a=implode(' , ',$a);
 
            $v['type2']=$a;
        }
  
         // dump($list[0]['type2']);
        return view('',['list'=>$list,'page'=>$list->render()]);
   }
   public function sellhouse(){
      $list=Classify1::paginate();

        foreach($list as $v){
            $a=Classify2::where('classify2_superior',$v->classify_id)->where('classify2_status',0)->field('classify2_name,classify2_id')->select();
            // $a=implode(' , ',$a);
 
            $v['type2']=$a;
        }
  
         // dump($list[0]['type2']);
        return view('',['list'=>$list,'page'=>$list->render()]);
   }
   public function sellshop(){
      $list=Classify1::paginate();

        foreach($list as $v){
            $a=Classify2::where('classify2_superior',$v->classify_id)->where('classify2_status',0)->field('classify2_name,classify2_id')->select();
            // $a=implode(' , ',$a);
 
            $v['type2']=$a;
        }
  
         // dump($list[0]['type2']);
        return view('',['list'=>$list,'page'=>$list->render()]);
   }
   public function sellland(){
      $list=Classify1::paginate();

        foreach($list as $v){
            $a=Classify2::where('classify2_superior',$v->classify_id)->where('classify2_status',0)->field('classify2_name,classify2_id')->select();
            // $a=implode(' , ',$a);
 
            $v['type2']=$a;
        }
  
         // dump($list[0]['type2']);
        return view('',['list'=>$list,'page'=>$list->render()]);
   }
   public function wantbuy(){
      $list=Classify1::paginate();

        foreach($list as $v){
            $a=Classify2::where('classify2_superior',$v->classify_id)->where('classify2_status',0)->field('classify2_name,classify2_id')->select();
            // $a=implode(' , ',$a);
 
            $v['type2']=$a;
        }
  
         // dump($list[0]['type2']);
        return view('',['list'=>$list,'page'=>$list->render()]);
   }
   public function wantrent(){
      $list=Classify1::paginate();

        foreach($list as $v){
            $a=Classify2::where('classify2_superior',$v->classify_id)->where('classify2_status',0)->field('classify2_name,classify2_id')->select();
            // $a=implode(' , ',$a);
 
            $v['type2']=$a;
        }
  
         // dump($list[0]['type2']);
        return view('',['list'=>$list,'page'=>$list->render()]);
   }
   public function renthouse_add(){
      $list=Classify1::paginate();

        foreach($list as $v){
            $a=Classify2::where('classify2_superior',$v->classify_id)->where('classify2_status',0)->field('classify2_name,classify2_id')->select();
            // $a=implode(' , ',$a);
 
            $v['type2']=$a;
        }
  
         // dump($list[0]['type2']);
        return view('',['list'=>$list,'page'=>$list->render()]);
   }
   public function rentshop_add(){
      $list=Classify1::paginate();

        foreach($list as $v){
            $a=Classify2::where('classify2_superior',$v->classify_id)->where('classify2_status',0)->field('classify2_name,classify2_id')->select();
            // $a=implode(' , ',$a);
 
            $v['type2']=$a;
        }
  
         // dump($list[0]['type2']);
        return view('',['list'=>$list,'page'=>$list->render()]);
   }
   public function zhuanshop_add(){
      $list=Classify1::paginate();

        foreach($list as $v){
            $a=Classify2::where('classify2_superior',$v->classify_id)->where('classify2_status',0)->field('classify2_name,classify2_id')->select();
            // $a=implode(' , ',$a);
 
            $v['type2']=$a;
        }
  
         // dump($list[0]['type2']);
        return view('',['list'=>$list,'page'=>$list->render()]);
   }
   public function rentland_add(){
      $list=Classify1::paginate();

        foreach($list as $v){
            $a=Classify2::where('classify2_superior',$v->classify_id)->where('classify2_status',0)->field('classify2_name,classify2_id')->select();
            // $a=implode(' , ',$a);
 
            $v['type2']=$a;
        }
  
         // dump($list[0]['type2']);
        return view('',['list'=>$list,'page'=>$list->render()]);
   }
   public function sellhouse_add(){
      $list=Classify1::paginate();

        foreach($list as $v){
            $a=Classify2::where('classify2_superior',$v->classify_id)->where('classify2_status',0)->field('classify2_name,classify2_id')->select();
            // $a=implode(' , ',$a);
 
            $v['type2']=$a;
        }
  
         // dump($list[0]['type2']);
        return view('',['list'=>$list,'page'=>$list->render()]);
   }
   public function sellshop_add(){
      $list=Classify1::paginate();

        foreach($list as $v){
            $a=Classify2::where('classify2_superior',$v->classify_id)->where('classify2_status',0)->field('classify2_name,classify2_id')->select();
            // $a=implode(' , ',$a);
 
            $v['type2']=$a;
        }
  
         // dump($list[0]['type2']);
        return view('',['list'=>$list,'page'=>$list->render()]);
   }
   public function sellland_add(){
      $list=Classify1::paginate();

        foreach($list as $v){
            $a=Classify2::where('classify2_superior',$v->classify_id)->where('classify2_status',0)->field('classify2_name,classify2_id')->select();
            // $a=implode(' , ',$a);
 
            $v['type2']=$a;
        }
  
         // dump($list[0]['type2']);
        return view('',['list'=>$list,'page'=>$list->render()]);
   }
   public function wantbuy_add(){
      $list=Classify1::paginate();

        foreach($list as $v){
            $a=Classify2::where('classify2_superior',$v->classify_id)->where('classify2_status',0)->field('classify2_name,classify2_id')->select();
            // $a=implode(' , ',$a);
 
            $v['type2']=$a;
        }
  
         // dump($list[0]['type2']);
        return view('',['list'=>$list,'page'=>$list->render()]);
   }
   public function wantrent_add(){
      $list=Classify1::paginate();

        foreach($list as $v){
            $a=Classify2::where('classify2_superior',$v->classify_id)->where('classify2_status',0)->field('classify2_name,classify2_id')->select();
            // $a=implode(' , ',$a);
 
            $v['type2']=$a;
        }
  
         // dump($list[0]['type2']);
        return view('',['list'=>$list,'page'=>$list->render()]);
   }


}