<?php


namespace app\admin\controller;


use think\facade\Db;

class Roles extends BaseAdmin
{
    //角色列表
    public function index(){
        $rolesData=Db::name('admin_groups')->select();
        return view('',['rolesData'=>$rolesData]);
    }
    //角色添加
    public function add(){
        $menuList=Db::name('admin_menu')->where(['status'=>0])->select();
        $menu=$this->getTree($menuList->toArray());
        $results = array();
        foreach ($menu as $value) {
            $value['child'] = isset($value['child'])?$this->formatMenus($value['child']):false;
            $results[] = $value;
        }
        return view('',['results'=>$results]);
    }
    //编辑
    public function edit(){
        $gid=input('gid',0,'intval');
        $role=Db::name('admin_groups')->where('gid',$gid)->find();
        $role&&$role['rights']&&$role['rights']=json_decode($role['rights']);
        $menuList=Db::name('admin_menu')->where(['status'=>0])->select();
        $menu=$this->getTree($menuList->toArray());
        $results = array();
        foreach ($menu as $value) {
            $value['child'] = isset($value['child'])?$this->formatMenus($value['child']):false;
            $results[] = $value;
        }
        return view('',['results'=>$results,'role'=>$role]);
    }
    //删除
    public function delete($gid){
        $del=Db::name('admin_groups')->delete($gid);
        if(!$del){
            return json(['code'=>1,'msg'=>'删除失败']);
        }
        return json(['code'=>0,'msg'=>'删除成功']);
    }
    public function save(){
        $gid=input('gid','','intval');
        $data['title']=input('title','','trim');
        $menu=input('menu/a');
        if(request()->isPost()){
            if($gid){
                $data['gid']=$gid;
            }
            if(!$data['title']){
                return json(['code'=>1,'msg'=>'角色名称不能为空']);
            }
            //如果menu为真则执行$data['rights']=json($menu)，否则不执行
            $menu&&$data['rights']=json_encode(array_keys($menu));
            $save=Db::name('admin_groups')->save($data);
            if(!$save){
                return json(['code'=>1,'msg'=>'保存失败']);
            }
            return json(['code'=>0,'msg'=>'保存成功']);
        }
    }
    //添加子目录
    private  function getTree($items){
        //以mid作为主键索引
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
    //转化为二维数组
    private function formatMenus($items,&$res = array()){
        foreach($items as $item){
            if(!isset($item['child'])){
                $res[] = $item;
            }else{
                $tem = $item['child'];
                unset($item['child']);
                $res[] = $item;
                $this->formatMenus($tem,$res);
            }
        }
        return $res;
    }
}