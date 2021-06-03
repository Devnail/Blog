<?php

/**
 * 系统设置
*/
namespace app\admin\controller;


use think\facade\Db;

class Site extends BaseAdmin
{
    public function index(){
        $site=Db::name('config')->where(['names'=>'site'])->find();
        $site&&$site['values']=json_decode($site['values'],true);
        return view('',['site'=>$site]);
    }
    public function save(){
        $title=input('post.name','','trim');
        $data['values']=json_encode(input('post.values'));
        $site=Db::name('config')->where(['names'=>$title])->find();
        if($site){
            Db::name('config')->where(['names'=>$title])->update($data);
        }else{
            $data['names']=$title;
            Db::name('config')->save($data);
        }
        return json(['code'=>0,'msg'=>'保存成功']);
    }
    //删除缓存，会删除runtime下面各文件夹的文件
    public function clear(){
        $path = root_path() . 'runtime';
        delFileByDir($path);
        return alert('清除成功',1);
    }
}