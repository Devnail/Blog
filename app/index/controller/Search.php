<?php


namespace app\index\controller;


use think\facade\Db;

class Search extends Base
{

    public function index(){
        $searchPage=Db::name('page')->where('id','7')->find();
        $keyWords=input('keywords','','trim');
        $articleList=Db::table('ywn_article')->
        alias('a')->join('ywn_cates b','a.cate_id=b.id')->
        field('a.id,a.title,b.name,a.img,a.add_time,a.content,a.cate_id')->
        where([['a.title','like',"%{$keyWords}%"],['b.status','=',0]])->paginate(3);
        return view('',['articleList'=>$articleList,'searchPage'=>$searchPage]);
    }
}