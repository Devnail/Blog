<?php


namespace app\admin\controller;


use think\facade\Db;

class Flink extends BaseAdmin
{
    public function index(){
        $flinkData=Db::name('flink')->select();
        return view('',['flinkData'=>$flinkData]);
    }
    public function add(){
        return view();
    }
    public function edit(){
        $id=input('fid',0,'intval');
        $flinkInfo=Db::name('flink')->where(['id'=>$id])->find();
        return view('',['flinkInfo'=>$flinkInfo]);
    }

    public function save(){
        $id=input('id',0,'intval');
        if(request()->isPost()){
            $flinkData=$this->flinkData();
            if($id){
                $flinkData['id']=$id;
            }
            if(!$flinkData['name']){
                return json(['code'=>1,'msg'=>'网址名称不能为空']);
            }
            $res=Db::name('flink')->save($flinkData);
            if(!$res){
                return json(['code'=>1,'msg'=>'保存失败']);
            }
            return  json(['code'=>0,'msg'=>'保存成功']);
        }
    }
    public function delete($fId){
        $del=Db::name('flink')->delete($fId);
        if(!$del){
            return json(['code'=>1,'msg'=>'删除失败']);
        }
        return  json(['code'=>0,'msg'=>'删除成功']);
    }
    private function flinkData(){
        $data['name']=input('name','','trim');
        $data['url']=input('url','','trim');
        return $data;
    }
}