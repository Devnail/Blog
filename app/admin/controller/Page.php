<?php


namespace app\admin\controller;


use think\facade\Db;

class Page extends BaseAdmin
{
    public function index(){
        $pageData=Db::name('page')->select();
        return view('',['pageData'=>$pageData]);
    }
    public function add(){
        return view();
    }
    public function edit(){
        $id=input('id',0,'intval');
        $pageInfo=Db::name('page')->where(['id'=>$id])->find();
        return view('',['pageInfo'=>$pageInfo]);
    }
    public function save(){
        $id=input('id',0,'intval');
        if(request()->isPost()){
            $pageData=$this->pageData();
            if($id){
                $pageData['id']=$id;
            }
            if(!$pageData['title']){
                return json(['code'=>1,'msg'=>'标题不能为空']);
            }
            $pageData['add_time']=time();
            $save=Db::name('page')->save($pageData);
            if(!$save){
                return  json(['code'=>1,'msg'=>'保存失败']);
            }
            return  json(['code'=>0,'msg'=>'保存成功']);
        }
    }
    public function delete($pageId){
        $del=Db::name('page')->delete($pageId);
        if(!$del){
            return json(['code'=>1,'msg'=>'删除失败']);
        }
        return  json(['code'=>0,'msg'=>'删除成功']);
    }
    private function pageData(){
        $data['title']=input('title','','trim');
        $data['keywords']=input('keywords','','trim');
        $data['desc']=input('desc','','trim');
        $data['content']=input('content','','htmlspecialchars');
        $data['img']=input('img','','trim');
        return $data;
    }
}