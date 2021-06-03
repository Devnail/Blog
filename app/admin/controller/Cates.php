<?php


namespace app\admin\controller;


use think\facade\Db;

class Cates extends BaseAdmin
{
    public function index(){
        $pid=input('pid',0,'intval');
        //子菜单
        $cateList=Db::name('cates')->where(['pid'=>$pid])->order('sort desc')->select();
        //返回上一级
        $backId=0;
        if($pid>0){
            $parent=Db::name('cates')->where(['id'=>$pid])->find();
            $backId=$parent['pid'];
        }
        return view('',['cateList'=>$cateList,'pid'=>$pid,'backId'=>$backId]);
    }
    public function add(){
        return view('');
    }
    public function edit(){
        $cid=input('cid',0,'intval');
        $cateInfo=Db::name('cates')->where(['id'=>$cid])->find();
        return view('',['cateInfo'=>$cateInfo]);
    }
    public function save(){
        $id=input('id','','intval');
        if(request()->isPost()){
            $cateData=$this->cataData();
            if($id){
                $cateData['id']=$id;
            }
            if(!$cateData['name']){
                return json(['code'=>1,'msg'=>'分类名不能为空']);
            }
            $res=Db::name('cates')->save($cateData);
            if(!$res){
                return json(['code'=>1,'msg'=>'保存失败']);
            }
            return  json(['code'=>0,'msg'=>'保存成功']);
        }
    }
    public function delete($cateId){
        $del=Db::name('cates')->delete($cateId);
        if (!$del){
            return json(['code'=>1,'msg'=>'删除失败']);
        }
        return json(['code'=>0,'msg'=>'删除成功']);
    }
    private function cataData(){
        $data['name']=input('name','','trim');
        $data['sort']=input('sort',0,'intval');
        $data['pid']=input('pid',0,'intval');
        $data['keywords']=input('keywords','','trim');
        $data['desc']=input('desc','','trim');
        $data['ishidden']=input('ishidden',0,'intval');
        $data['status']=input('status',0,'intval');
        return $data;
    }
}