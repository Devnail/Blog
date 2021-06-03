<?php


namespace app\admin\controller;


use app\admin\validate\User;
use app\BaseController;
use think\exception\ValidateException;
use think\facade\Db;

class Index extends BaseController
{
    public function index()
    {
        if(session('admin')){
            return  redirect((string)url('home/index'));
        }
        return view('login');
    }
    //用户注册
    public function registered(){
        return view('');
    }
    public function doregist(){
        if(request()->isPost()){
            $adminData=$this->adminData();
            $repassword=input('repassword', '', 'trim');
            $verifycode = input('verifycode', '', 'trim');
            try {
                validate(User::class)->check([
                    'username' => $adminData['username'],
                    'password' =>$adminData['password'],
                ]);
            } catch (ValidateException $e) {
                return  json(['code'=>1,'msg'=>$e->getMessage()]);
            }

            if(!$repassword){
                return  json(['code'=>1,'msg'=>'确认密码不能为空']);
            }
            if($repassword!==$adminData['password']){
                return  json(['code'=>1,'msg'=>'确认密码不一致']);
            }
            if (!$adminData['truename']) {
                return json(['code' => 1, 'msg' => '姓名不能为空']);
            }
            if ($verifycode === '') {
                return json(['code' => 1, 'msg' => '请输入验证码']);
            }
            if (!captcha_check($verifycode)) {
                return json(['code' => 1, 'msg' => '验证码错误']);
            }
            if ($adminData['password']) {
                $adminData['password'] = md5($adminData['username'] . $adminData['password']);
            }
            $item=Db::name('admin')->where(['username'=>$adminData['username']])->find();
            if($item){
                return json(['code' => 1, 'msg' => '用户已存在']);
            }
            $adminData['add_time']=time();
            $res=Db::name('admin')->save($adminData);
            if(!$res){
                return json(['code'=>1,'msg'=>'注册失败']);
            }
            return json(['code'=>0,'msg'=>'注册成功']);
        }
    }
    //管理员登入
    public function dologin()
    {
        if(request()->isPost()){
            $username = input('username', '', 'trim');
            $password = input('password', '', 'trim');
            $verifycode = input('verifycode', '', 'trim');
            try {
                validate(User::class)->check([
                    'username' => $username,
                    'password' => $password,
                ]);
            } catch (ValidateException $e) {
                return  json(['code'=>1,'msg'=>$e->getMessage()]);
            }
            if ($verifycode === '') {
                return json(['code' => 1, 'msg' => '请输入验证码']);
            }
            if (!captcha_check($verifycode)) {
                return json(['code' => 1, 'msg' => '验证码错误']);
            }
            $admin = Db::name('admin')->where(['username' => $username])->find();
            if (!$admin) {
                return json(['code' => 1, 'msg' => '用户不存在']);
            }
            if (md5($admin['username'] . $password) != $admin['password']) {
                return json(['code' => 1, 'msg' => '密码错误']);
            }
            if ($admin['status'] === 1) {
                return json(['code' => 1, 'msg' => '用户已被禁用']);
            }
            session('admin', $admin);
            return json(['code' => 0, 'msg' => '登入成功']);
        }
    }
//    登出
    public function logout()
    {
        session('admin', null);
        return json(['code' => 0, 'msg' => '退出成功']);
    }
    private function adminData(){
        $data['username'] = input('username', '', 'trim');
        $data['password'] = input('password', '', 'trim');
        $data['truename'] = input('truename', '', 'trim');
        return $data;
    }
}