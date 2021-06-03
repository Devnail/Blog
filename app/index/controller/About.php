<?php


namespace app\index\controller;


use think\facade\Db;

class About extends Base
{
    public function index(){
        $aboutData=Db::name('page')->where(['id'=>3])->find();
        return view('',['aboutData'=>$aboutData]);
    }
}