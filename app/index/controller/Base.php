<?php


namespace app\index\controller;


use app\BaseController;
use think\App;
use think\facade\Db;
use think\facade\View;

class Base extends BaseController
{
    protected $username;
    public function __construct(App $app)
    {
        parent::__construct($app);
        $this->username=session('admin');
        $slider=Db::name('slider')->field('url,img,title')->select();
        $rArticle=Db::name('article')->order('id','desc')->field('img,title,add_time,id')->limit(4)->select();
        $contact=Db::name('page')->where(['id'=>4])->field('title,content,img')->find();
        //$cateCount=Db::name('cates')->count();
        $cates=Db::name('cates')->order('id','desc')->where(['status'=>0])->select()->toArray();
        foreach ($cates as $key=>$cv){
            $cates[$key]['count']=Db::name('article')->where(['cate_id'=>$cates[$key]['id']])->count();
        }

        if($this->username){
            View::assign('username',$this->username);
        }
        View::assign('rArticle',$rArticle);
        View::assign('contact',$contact);
        View::assign('cates',$cates);
        View::assign('slider',$slider);
    }
    protected function getTree($arr,$pid=0,$level=0)
    {
        static $list = [];
        foreach ($arr as $key => $value) {
            if ($value["pid"] == $pid) {
                $value["level"] = $level;
                $list[] = $value;
                unset($arr[$key]); //删除已经排好的数据为了减少遍历的次数，当然递归本身就很费神就是了
                $this->getTree($arr,$value["id"],$level+1);
            }
        }
        return $list;
    }
}