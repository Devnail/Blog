<?php


namespace app\admin\controller;

use think\facade\Db;

class Comment extends BaseAdmin
{
    public function index(){
        if($this->admin['gid']===1){
            $comment=Db::table('ywn_comment')->alias('a')->
            join('ywn_admin b','a.user_id=b.id')->join('ywn_article c','a.aid=c.id')
                ->field('c.title,b.username,a.id,a.pid,a.content,a.status,a.add_time')->select()->toArray();
            $comment&&$comment=$this->getTree($comment);
        }else{
            $comment=Db::table('ywn_comment')->alias('a')->
            join('ywn_admin b','a.user_id=b.id')->join('ywn_article c','a.aid=c.id')->where(['a.user_id'=>$this->admin['id']])
                ->field('c.title,b.username,a.id,a.pid,a.content,a.status,a.add_time')->select()->toArray();
            $comment&&$comment=$this->getTree($comment);
        }

        return view('',['comment'=>$comment]);
    }
    public function edit(){
        $id=input('id',0,'intval');
        $comInfo=Db::name('comment')->where(['id'=>$id])->find();
        $adminInfo=Db::name('admin')->where(['id'=>$comInfo['user_id']])->field('username')->find();
        $articleInfo=Db::name('article')->where(['id'=>$comInfo['aid']])->field('title')->find();
        return view('',['comInfo'=>$comInfo,'toReply'=>
            $adminInfo['username'],'articleInfo'=>
            $articleInfo['title'],'replayId'=>$this->admin['id']]);
    }
    public function delete(){
        $commentId=input('post.commentId',0,'intval');
        $comData=Db::name('comment')->select()->toArray();
        $childData=$this->getSon($commentId,$comData);
        if($childData){
            array_push($childData,$commentId);
            $del=Db::name('comment')->delete($childData);
            if(!$del){
                return json(['code'=>1,'msg'=>'删除失败']);
            }
            return json(['code'=>0,'msg'=>'删除成功']);
        }
        $del=Db::name('comment')->delete($commentId);
        if(!$del){
            return json(['code'=>1,'msg'=>'删除失败']);
        }
        return json(['code'=>0,'msg'=>'删除成功']);
    }
    public function save(){
        if(request()->isPost()){
            $comData=$this->comData();
            if(!$comData['content']){
                return json(['code'=>1,'msg'=>'内容不能为空']);
            }
            $comData['add_time']=time();
            $save=Db::name('comment')->save($comData);
            if(!$save){
                return  json(['code'=>1,'msg'=>'评论成功']);
            }
            return  json(['code'=>0,'msg'=>'评论成功']);
        }
    }
    private function comData(){
        $data['pid']=input('pid',0,'intval');
        $data['aid']=input('aid',0,'intval');
        $data['user_id']=input('user_id',0,'intval');
        $data['status']=input('status',0,'intval');
        $data['content']=input('content','trim');
        return $data;
    }
    //无限极分类引用算法
/*    private  function getTree($items){
        $tree=[];
        //以mid作为主键索引
        $items=array_column($items,null,'id');
        foreach ($items as $item){
            if(isset($items[$item['pid']])){
                $items[$item['pid']]['child'][]=&$items[$item['id']];
            }else{
                $tree[]=&$items[$item['id']];
            }
        }
        return $tree;
    }*/

    //无限极分类递归算法
   public function getTree($arr,$pid=0,$level=0)
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
    //通过父类找出所有子类,并返回所有子类id
    public function getSon($id,$arr){
       static $list=[];
       foreach ($arr as $key =>$value){
           if($value['pid']==$id){
               $list[]=$value['id'];
               unset($arr[$key]);
               $this->getSon($value['id'],$arr);
           }
       }
       return $list;
    }
}