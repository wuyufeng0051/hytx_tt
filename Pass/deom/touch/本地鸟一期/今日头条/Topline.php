<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/20
 * Time: 17:24
 */

namespace app\admin\controller;

use app\admin\model\Topline as ToplineModel;
use app\admin\model\Toplineopen;
use think\Request;
use think\Session;

class Topline extends Admin
{
    protected $beforeActionList=[
        'code',
        'power'
    ];

    protected function code(){
        $this->assign('code','topline');
    }

    protected function power(){
        parent::p('topline');
    }

    public function index(Request $request){
        $param=$request->param();
        $rid=Session::get('bird_admin_rid');
        if (isset($param['range'])){
            $list=ToplineModel::where('topline_title','like','%'.$param['range'].'%')->where('topline_rid',$rid)->order('topline_date desc')->paginate('',false,['query' => request()->param()]);
            $range=$param['range'];
        } else {
            $list=ToplineModel::where('topline_rid',$rid)->order('topline_date desc')->paginate('');
            $range=null;
        }
        $switch=Toplineopen::get(1);
        return view('',['list'=>$list,'page'=>$list->render(),'sel'=>$range,'switch'=>$switch]);
    }

    public function toggle(){
        $user=Toplineopen::get(1);
        if ($user->toplineopen_status==0){
            $user->toplineopen_status=1;
            $user->save();
            $message='评论已关';
        } else{
            $user->toplineopen_status=0;
            $user->save();
            $message='评论已开';
        }
        return ['code'=>0,'message'=>$message];
    }

    public function create(){
        return view('');
    }

    public function edit(Request $request){
        $param=$request->param();
        $rid=Session::get('bird_admin_rid');
        $rend=ToplineModel::where('topline_rid',$rid)->find($param['id']);
        return view('',['rend'=>$rend]);
    }

    public function del(Request $request){
        $param=$request->param();
        $topline=ToplineModel::get($param['id']);
        $topline->delete();
        return ['code'=>0,'message'=>'删除成功'];
    }

    public function change(Request $request){
        $param=$request->param();
        $rid=Session::get('bird_admin_rid');
        if (isset($param['topline_id'])){
            $topline=ToplineModel::get($param['topline_id']);
        } else{
            $topline=new ToplineModel;
            $topline->topline_rid=$rid;
        }
        $topline->topline_title=$param['topline_title'];
        if(isset($param['topline_desc'])){
            $topline->topline_desc=$param['topline_desc'];
        }
        $topline->topline_from=$param['topline_from'];
        $topline->topline_status=$param['topline_status'];
        $topline->save();
        $this->redirect('topline/index');
    }

    public function comment(){
        return view('');
    }

    public function repeat(){
        return view('');
    }

    public function view(){
        return view('');
    }

    public function com_view(){
        return view('');
    }

}