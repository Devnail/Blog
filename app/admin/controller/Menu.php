<?php


namespace app\admin\controller;


use think\facade\Db;

class Menu extends BaseAdmin
{
    public function index(){
        $pid=input('pid',0,'intval');
        //加载菜单列表
        $dataList=Db::name('admin_menu')->where(['pid'=>$pid])->order('ord desc')->select();
        //返回上级菜单id
        $backid=0;
        if($pid>0){
            $parent=Db::name('admin_menu')->where(['mid'=>$pid])->find();
            $backid=$parent['pid'];
        }
        return view('',['dataList'=>$dataList,'pid'=>$pid,'backid'=>$backid]);
    }
    //添加菜单
    public function add(){
        return view();
    }
    //编辑菜单
    public  function edit(){
        $mid=input('mid',0,'intval');
        $menuInfo=Db::name('admin_menu')->where('mid',$mid)->find();
        return view('',['menuInfo'=>$menuInfo]);
    }
    public function save(){
        $mid=input('mid','','intval');
        if(request()->isPost()){
            $menuData=$this->menuData();
            if($mid){
                $menuData['mid']=$mid;
            }
            if(!$menuData['title']){
                return json(['code'=>1,'msg'=>'菜单标题不能为空']);
            }
            if(!$menuData['controller']&&$menuData['pid']!==0){
                return json(['code'=>1,'msg'=>'控制器名称不能为空']);
            }
            if(!$menuData['method']&&$menuData['pid']!==0){
                return  json(['code'=>1,'msg'=>'方法名不能为空']);
            }
            $res=Db::name('admin_menu')->save($menuData);
            if(!$res){
                return json(['code'=>1,'msg'=>'保存失败']);
            }
            return  json(['code'=>0,'msg'=>'保存成功']);
        }
    }
    //删除菜单
    public function delete($menuId){
        $del=Db::name('admin_menu')->delete($menuId);
        if(!$del){
            return json(['code'=>1,'msg'=>'删除失败']);
        }
        return json(['code'=>0,'msg'=>'删除成功']);
    }
    private function menuData()
    {
        $data['title']=input('title','','trim');
        $data['controller']=input('controller','','trim');
        $data['method']=input('method','','trim');
        $data['ord']=input('ord',0,'intval');
        $data['ishidden']=input('ishidden',0,'intval');
        $data['status']=input('status',0,'intval');
        $data['pid']=input('pid',0,'intval');
        return $data;
    }
}