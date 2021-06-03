<?php /*a:1:{s:59:"D:\phpEnv\www\www.ytv.com\app\admin\view\comment\index.html";i:1618052425;}*/ ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>评论列表</title>
    <link rel="stylesheet" type="text/css" href="/public/static/plugins/layui/css/layui.css">
    <style>
        .header span {
            background-color: #009688;
            margin-left: 30px;
            padding: 10px;
            color: #ffffff;
        }

        .header div {
            border-bottom: solid 2px #009688;
            margin-top: 8px;
        }

        .header button {
            float: right;
            margin-top: -5px;
            margin-left: 5px;
        }
    </style>
</head>
<body>
<div class="header" style="padding: 10px">
    <span>评论列表</span>
    <div></div>
</div>
<table class="layui-table">
    <thead>
    <tr parentId="0">
        <th>伸缩</th>
        <th>ID</th>
        <th>用户名</th>
        <th>文章标题</th>
        <th>内容</th>
        <th>状态</th>
        <th>添加时间</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
    <?php if(is_array($comment) || $comment instanceof \think\Collection || $comment instanceof \think\Paginator): $i = 0; $__LIST__ = $comment;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cv): $mod = ($i % 2 );++$i;?>
    <tr id="<?php echo htmlentities($cv['id']); ?>" parentId="<?php echo htmlentities($cv['pid']); ?>">
        <td style="text-align: center"><span class="open">+</span></td>
        <td><?php echo htmlentities($cv['id']); ?></td>
        <td><?php echo str_repeat("-",$cv['level']);; ?><?php echo htmlentities($cv['username']); ?></td>
        <td><?php echo htmlentities($cv['title']); ?></td>
        <td><?php echo mb_substr($cv['content'],0,20,'utf-8'); ?></td>
        <td><?php echo $cv['status']===0 ? '正常' : '<span style="color: red">禁用</span>'; ?></td>
        <td><?php echo htmlentities(date('Y-m-d H:i:s',!is_numeric($cv['add_time'])? strtotime($cv['add_time']) : $cv['add_time'])); ?></td>
        <td>
            <button class="layui-btn layui-btn-xs" onclick="edit(<?php echo htmlentities($cv['id']); ?>)">回复</button>
            <button class="layui-btn layui-btn-xs layui-btn-danger" onclick="del(this)" commentId="<?php echo htmlentities($cv['id']); ?>">删除</button>
        </td>
    </tr>
    <?php endforeach; endif; else: echo "" ;endif; ?>
    </tbody>
</table>
<script src="/public/static/plugins/layui/layui.js"></script>
<script>
    layui.use('layer', function () {
        layer = layui.layer;
        $=layui.jquery;
        //列表伸展
        $('tr[parentId!=0]').hide();
        $('.open').click(function(){
            var id=$(this).parents('tr').attr('id');
            if($(this).text()==='+'){
                $(this).text('-');
                $('tr[parentId='+id+']').show();
            }else{
                $(this).text('+');
                $('tr[parentId='+id+']').hide();
            }
        });
    });
    //编辑
    function edit(id) {
        layer.open({
            type: 2,
            title: '编辑评论',
            shade: 0.3,
            maxmin: true,
            area: ['480px', '420px'],
            content: "/public/admin/comment/edit?id="+id //iframe的url
        });
    }
    //删除
    function del(obj){
        var commentId=$(obj).attr('commentId');
        layer.confirm('确定要删除吗？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            $.post("<?php echo url('comment/delete'); ?>", {
                commentId:commentId,
            }, function (res) {
                if (res.code > 0) {
                    layer.alert(res.msg, {icon: 2});
                } else {
                    layer.alert(res.msg,{icon: 1});
                    setTimeout(function (){window.location.reload();},1000);
                }
            }, 'json');
        });
    }
</script>
</body>
</html>