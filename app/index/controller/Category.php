<?php


namespace app\index\controller;


use think\facade\Db;

class Category extends Base
{
    public function index(){
        $cid=input('cid','','intval');
        $cateGory=Db::name('page')->where(['id'=>6])->find();
        $cateName=Db::name('cates')->where('id',$cid)->find();
        $articleList=Db::table('ywn_article')->
        alias('a')->join('ywn_cates b','a.cate_id=b.id')->
        field('a.id,a.title,b.name,a.img,a.add_time,a.content,a.cate_id')->where(['a.cate_id'=>$cid,'b.status'=>0])->paginate(3);
        return view('',['cateGory'=>$cateGory,'cateName'=>$cateName,'articleList'=>$articleList]);
    }
}