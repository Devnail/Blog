<?php


namespace app\admin\controller;


use think\facade\Db;

class Article extends BaseAdmin
{
    public function index(){
        $userId=$this->admin['id'];
        if($userId===1){
            $articleList=Db::table('ywn_article')->
            alias('a')->join('ywn_cates b','a.cate_id=b.id')->
            field('a.id,a.title,a.keywords,a.desc,b.name,a.img,a.add_time')->paginate(6);
        }else{
            $articleList=Db::table('ywn_article')->
            alias('a')->join('ywn_cates b','a.cate_id=b.id')->
            field('a.id,a.title,a.keywords,a.desc,b.name,a.img,a.add_time')->where(['a.user_id'=>$userId])->paginate(6);
        }
        return view('',['articleList'=>$articleList]);
    }
    public function add(){
        $cataData=Db::name('cates')->field('id,name')->select();
        return view('',['cateData'=>$cataData]);
    }
    public function edit(){
        $id=input('id',0,'intval');
        $cataData=Db::name('cates')->field('id,name')->select();
        $articleData=Db::name('article')->where(['id'=>$id])->find();
        return view('',['cateData'=>$cataData,'articleData'=>$articleData]);
    }
    public function save(){
        $id=input('id',0,'intval');
        if(request()->isPost()){
            $articleData=$this->articleData();
            if($id){
                $articleData['id']=$id;
            }
            if(!$articleData['title']){
                return json(['code'=>1,'msg'=>'标题不能为空']);
            }
            if(!$articleData['cate_id']){
                return json(['code'=>1,'msg'=>'分类不能为空']);
            }
            if(!$articleData['img']){
                return json(['code'=>1,'msg'=>'图片不能为空']);
            }
            if(!$articleData['content']){
                return  json(['code'=>1,'msg'=>'']);
            }
            $articleData['user_id']=$this->admin['id'];
            $articleData['add_time']=time();
            $save=Db::name('article')->save($articleData);
            if(!$save){
                return json(['code'=>1,'msg'=>'保存失败']);
            }
            return json(['code'=>0,'msg'=>'保存成功']);
        }
    }
    public function delete($articleId){
        $del=Db::name('article')->delete($articleId);
        if(!$del){
            return json(['code'=>1,'msg'=>'删除失败']);
        }
        return  json(['code'=>0,'msg'=>'删除成功']);
    }
    private function articleData(){
        $data['title']=input('title','','trim');
        $data['cate_id']=input('cate_id',0,'intval');
        $data['keywords']=input('keywords','','trim');
        $data['desc']=input('desc','','trim');
        $data['img']=input('img','','trim');
        $data['content']=input('content','','htmlspecialchars');
        return $data;
    }
}