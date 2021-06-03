<?php


namespace app\admin\controller;

/*
 *管理员管理
 */

use app\admin\validate\User;
use think\exception\ValidateException;
use think\facade\Db;

class Admin extends BaseAdmin
{
    //管理员列表
    public function index()
    {
        $gid=$this->admin['gid'];
        if($gid===1){
            $adminList = Db::name('admin')->select();
        }else{
            $adminList = Db::name('admin')->where(['id'=>$this->admin['id']])->select();
        }
        return view('', ['adminadminList' => $adminList]);
    }
    //添加管理员
    public function add()
    {
        //加载角色
        $adminGroup = Db::name('admin_groups')->select();
        return view('', ['adminGroup' => $adminGroup]);
    }
    //编辑管理员
    public function edit(){
        $id=input('id',0,'intval');
        $adminInfo=Db::name('admin')->where('id',$id)->find();
        $adminGroup = Db::name('admin_groups')->select();
        return view('', ['adminGroup' => $adminGroup,'adminInfo'=>$adminInfo]);
    }

    //保存管理员
    public function save()
    {
        $id=input('id','','intval');
        if (request()->isPost()) {
            $adminData = $this->adminData();
            if($id){
                $adminData['id']=$id;
            }
            try {
                validate(User::class)->check([
                    'username' => $adminData['username'],
                    'password' => $adminData['password'],
                ]);
            } catch (ValidateException $e) {
                return  json(['code'=>1,'msg'=>$e->getMessage()]);
            }
            if (!$adminData['gid']) {
                return json(['code' => 1, 'msg' => '角色不能为空']);
            }
            if (!$adminData['truename']) {
                return json(['code' => 1, 'msg' => '姓名不能为空']);
            }
            //密码加密
            if ($adminData['password']) {
                $adminData['password'] = md5($adminData['username'] . $adminData['password']);
            }
            //检查用户是否已存在
/*            $item=Db::name('admin')->where(['username'=>$adminData['username']])->find();
            if($item){
                return json(['code' => 1, 'msg' => '用户已存在']);
            }*/
            $adminData['add_time']=time();
            $res=Db::name('admin')->save($adminData);
            if(!$res){
                return json(['code'=>1,'msg'=>'保存失败']);
            }
            return json(['code'=>0,'msg'=>'保存成功']);
        }
    }
    //管理员删除
    public function delete($adminId){
        $del=Db::name('admin')->delete($adminId);
        if(!$del){
            return json(['code'=>1,'msg'=>'删除失败']);
        }
        return json(['code'=>0,'msg'=>'删除成功']);
    }
    private function adminData()
    {
        $data['username'] = input('username', '', 'trim');
        $data['gid'] = input('gid', 0, 'intval');
        $data['password'] = input('password', '', 'trim');
        $data['truename'] = input('truename', '', 'trim');
        $data['status'] = input('status', 0, 'intval');
        $data['img']=input('img','','trim');
        $data['message']=input('message','','trim');
        return $data;
    }
}