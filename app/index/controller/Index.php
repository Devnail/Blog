<?php
namespace app\index\controller;

use think\facade\Db;

class Index extends Base
{
    public function index(){
        $homePage=Db::name('page')->where(['id'=>1])->find();
        $articleList=Db::table('ywn_article')->
        alias('a')->join('ywn_cates b','a.cate_id=b.id')->
        field('a.id,a.title,b.name,a.img,a.add_time,a.content,a.cate_id')->limit(7)->select();
        return view('',['homePage'=>$homePage,'articleList'=>$articleList]);
    }
    public function logout(){
        session('admin', null);
        return  redirect((string)url('index/index'));
    }
}