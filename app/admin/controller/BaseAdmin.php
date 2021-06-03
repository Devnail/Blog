<?php


namespace app\admin\controller;


use app\BaseController;
use think\App;
use think\facade\Db;

class BaseAdmin extends BaseController
{
    public function __construct(App $app)
    {
        parent::__construct($app);
        $this->admin=session('admin');
        //未登入用户不允许登入
        if(!$this->admin){
            header('location:/public/admin/index/index');
            exit();
        }
        // 判断用户是否有权限
        $group = Db::name('admin_groups')->where(['gid'=>$this->admin['gid']])->find();
        if(!$group){
            $this->requestError('对不起,你没有去权限');
        }
        $rights = json_decode($group['rights']);
        // 当前访问的菜单
        $controller = request()->controller();
        $method = request()->action();
        $res = Db::name('admin_menu')->where(['controller'=>$controller,'method'=>$method])->find();
        if(!$res){
            $this->requestError('对不起，您访问的功能不存在');
        }
        if($res['status'] == 1){
            $this->requestError('对不起，该功能已禁止使用');
        }
        if(!in_array($res['mid'],$rights)){
            $this->requestError('对不起，您没有权限');
        }

    }
    private function requestError($msg){
        if(request()->isAjax()){
            exit(json_encode(array('code'=>1,'msg'=>$msg)));
        }
        exit($msg);
    }
}