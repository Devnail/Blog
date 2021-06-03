<?php


namespace app\admin\controller;


use think\facade\Db;
use think\exception\ValidateException;
use think\facade\Filesystem;

class Slider extends BaseAdmin
{
    public function index(){
        $sliderData=Db::name('slider')->order('ord desc')->select();
        return view('',['sliderData'=>$sliderData]);
    }
    public function add(){
        return view();
    }
    public function edit(){
        $id=input('id',0,'intval');
        $sliderInfo=Db::name('slider')->where(['id'=>$id])->find();
        return view('',['sliderInfo'=>$sliderInfo]);
    }
    public function delete($sliderId){
       $del=Db::name('slider')->delete($sliderId);
        if (!$del){
            return json(['code'=>1,'msg'=>'删除失败']);
        }
        return json(['code'=>0,'msg'=>'删除成功']);
    }
    public function save(){
        $id=input('id',0,'intval');
        if(request()->isPost()){
            $sliderData=$this->sliderData();
            if($id){
                $sliderData['id']=$id;
            }
            if(!$sliderData['title']){
                return json(['code'=>1,'msg'=>'标题不能为空']);
            }
            if(!$sliderData['url']){
                return json(['code'=>1,'msg'=>'链接不能为空']);
            }
            if(!$sliderData['img']){
                return json(['code'=>1,'msg'=>'图片不能为空']);
            }
            $res=Db::name('slider')->save($sliderData);
            if(!$res){
                return  json(['code'=>1,'msg'=>'保存失败']);
            }
            return  json(['code'=>0,'msg'=>'上传成功']);
        }
    }
    public function upload(){
        $file = request()->file('img');
        if($file===null){
            return json(['code'=>1,'msg'=>'没有文件上传']);
        }
        try {
            // 使用验证器验证上传的文件
            validate(
                [
                    'file' => [
                        // 限制文件大小(单位b)，这里限制为4M
                        'fileSize' => 4 * 1024 * 1024,
                        // 限制文件后缀，多个后缀以英文逗号分割
                        'fileExt'  => 'gif,jpg'
                    ]
                ],
                [
                    'file.fileSize' => '文件太大',
                    'file.fileExt' => '不支持的文件后缀',
                ]
            )->check(['file' => $file]);
            // 上传到本地服务器
            $savename = Filesystem::disk('public')->putFile( 'img', $file);
            $path=DIRECTORY_SEPARATOR.'public' . DIRECTORY_SEPARATOR . 'upload'.DIRECTORY_SEPARATOR.$savename;
            $path=str_replace('\\','/',$path);
        } catch (ValidateException $e) {
            return  json(['code'=>1,'msg'=>$e->getMessage()]);
        }
        return json(['code'=>0,'data'=>$path,'msg'=>'上传成功']);
    }

    private function sliderData(){
        $data['title']=input('title','','trim');
        $data['url']=input('url','','trim');
        $data['img']=input('img','','trim');
        $data['ord']=input('ord',0,'intval');
        return $data;
    }
}