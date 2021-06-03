<?php


namespace app\admin\controller;

/*
后台首页
*/


use think\facade\Db;

class Home extends BaseAdmin
{
    public function index(){
        $menu=false;
        $role=Db::name('admin_groups')->where('gid',$this->admin['gid'])->find();
        if($role){
            $role['rights']=(isset($role['rights'])&&$role['rights'])?json_decode($role['rights'],true):[];
        }
        if($role['rights']){
            $where='mid in('.implode(',',$role['rights']).') and ishidden=0 and status=0';
            $menu=Db::name('admin_menu')->where($where)->select()->toArray();
            $menu&&$menu=$this->getTree($menu);
        }
        $site=Db::name('config')->where(['names'=>'site'])->find();
        $site&&$site['values']=json_decode($site['values'],true);
        return view('',['menu'=>$menu,'admin'=>$this->admin,
            'role'=>$role,'site'=>$site]);
    }
    //子目录
    private  function getTree($items){
        //以mid作为主键索引
        $tree=[];
        $items=array_column($items,null,'mid');
        foreach ($items as $item){
            if(isset($items[$item['pid']])){
                $items[$item['pid']]['child'][]=&$items[$item['mid']];
            }else{
                $tree[]=&$items[$item['mid']];
            }
        }
        return $tree;
    }
    public function welcome(){
        return view();
    }
}