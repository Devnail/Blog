<?php


namespace app\index\controller;


use think\facade\Db;
class Single extends Base
{
    public function index(){
        $id=input('id','','intval');
        $userId=isset($this->username)?$this->username['id']:false;
        $article=Db::table('ywn_article')->
        alias('a')->join('ywn_cates b','a.cate_id=b.id')->
        field('a.content,a.id,a.title,b.name,a.img,a.add_time,a.cate_id')->where('a.id',$id)->find();
        $recentArticle=Db::name('article')->order('id','desc')->limit(3)->select();
        $comment=Db::table('ywn_comment')->alias('a')->
        join('ywn_admin b','a.user_id=b.id')->
        field('b.username,a.id,a.content,a.add_time,a.pid,b.img,a.user_id')->where(['a.aid'=>$id,'a.status'=>0])->select()->toArray();
        $comment&&$comment=$this->getTree($comment);
        return view('single',['article'=>$article,'recentArticle'=>$recentArticle,'userId'=>$userId,'comment'=>$comment]);
    }
    public function add(){
       if(request()->isPost()){
           $comData=$this->comData();
           if(!$comData['content']){
               return json(['code'=>1,'msg'=>'内容不能为空']);
           }
           $comData['add_time']=time();
           $save=Db::name('comment')->save($comData);
           if(!$save){
               return json(['code'=>1,'msg'=>'评论失败']);
           }
           return json(['code'=>0,'msg'=>'评论成功']);
       }
    }
    private function comData(){
        $data['pid']=input('pid','','intval');
        $data['aid']=input('aid','','intval');
        $data['user_id']=input('user_id','','intval');
        $data['content']=input('content','','trim');
        return $data;
    }
}