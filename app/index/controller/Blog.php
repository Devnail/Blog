<?php


namespace app\index\controller;



use think\facade\Db;

class Blog extends Base
{
    public function index(){
        $homePage=Db::name('page')->where(['id'=>5])->find();
        $articleList=Db::table('ywn_article')->
        alias('a')->join('ywn_cates b','a.cate_id=b.id')->
        field('a.id,a.title,b.name,a.img,a.add_time,a.content,a.cate_id')->where('b.status',0)->paginate(6);
        return view('',['homePage'=>$homePage,'articleList'=>$articleList]);
    }
}