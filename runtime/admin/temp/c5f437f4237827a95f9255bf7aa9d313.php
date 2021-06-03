<?php /*a:1:{s:57:"D:\phpEnv\www\www.ytv.com\app\admin\view\flink\index.html";i:1618066488;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>友情连接</title>
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
        }
    </style>
</head>
<body style="padding: 10px">
<div class="header" style="padding: 10px">
    <span>友情链接</span>
    <button class="layui-btn layui-btn-sm" onclick="add()">添加</button>
    <div></div>
</div>
<table class="layui-table">
    <thead>
        <tr>
            <th>Id</th>
            <th>网址名称</th>
            <th>网址</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
    <?php if(is_array($flinkData) || $flinkData instanceof \think\Collection || $flinkData instanceof \think\Paginator): $i = 0; $__LIST__ = $flinkData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?>
        <tr>
            <td><?php echo htmlentities($value['id']); ?></td>
            <td><?php echo htmlentities($value['name']); ?></td>
            <td><?php echo htmlentities($value['url']); ?></td>
            <td>
                <button class="layui-btn layui-btn-xs" onclick="edit(<?php echo htmlentities($value['id']); ?>)">编辑</button>
                <button class="layui-btn layui-btn-xs layui-btn-danger" onclick="del(this)" fId="<?php echo htmlentities($value['id']); ?>">删除</button>
            </td>
        </tr>
    <?php endforeach; endif; else: echo "" ;endif; ?>
    </tbody>
</table>
<script src="/public/static/plugins/layui/layui.js"></script>
<script>
    layui.use('layer',function (){
        layer=layui.layer;
        $=layui.jquery;
    });
    //添加
    function add() {
        layer.open({
            type: 2,
            title: '添加链接',
            shade: 0.3,
            maxmin: true,
            area: ['480px', '420px'],
            content: "<?php echo url('flink/add'); ?>" //iframe的url
        });
    }
    function edit(fid){
        layer.open({
            type:2,
            title:'编辑链接',
            shade:0.3,
            maxmin: true,
            area:['480px','420px'],
            content:'/public/admin/flink/edit?fid='+fid
        });
    }
    function del(obj){
        var fId=$(obj).attr('fId');
        layer.confirm('确定要删除吗？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            $.post("<?php echo url('flink/delete'); ?>", {
                fId:fId,
            }, function (res) {
                if (res.code > 0) {
                    layer.msg(res.msg, {icon: 2});
                } else {
                    layer.msg(res.msg,{icon: 1});
                    setTimeout(function (){window.location.reload();},1000);
                }
            }, 'json');
        });
    }
</script>
</body>
</html>