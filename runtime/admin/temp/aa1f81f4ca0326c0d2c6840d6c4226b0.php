<?php /*a:1:{s:57:"D:\phpEnv\www\www.ytv.com\app\admin\view\roles\index.html";i:1618052489;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>角色列表</title>
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
        .header button{
            float: right;
        }
    </style>
</head>
<body>
<div class="header" style="padding: 10px">
    <span>角色列表</span>
    <button class="layui-btn layui-btn-xs" onclick="add()">添加</button>
    <div></div>
</div>
<table class="layui-table">
    <thead>
        <tr>
            <th>Id</th>
            <th>角色名称</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
    <?php if(is_array($rolesData) || $rolesData instanceof \think\Collection || $rolesData instanceof \think\Paginator): $i = 0; $__LIST__ = $rolesData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?>
        <tr>
            <td><?php echo htmlentities($value['gid']); ?></td>
            <td><?php echo htmlentities($value['title']); ?></td>
            <td>
                <button class="layui-btn-warm layui-btn layui-btn-xs" onclick="edit(<?php echo htmlentities($value['gid']); ?>)">编辑</button>
                <button class="layui-btn-danger layui-btn layui-btn-xs" onclick="del(this)" gid="<?php echo htmlentities($value['gid']); ?>">删除</button>
            </td>
        </tr>
    <?php endforeach; endif; else: echo "" ;endif; ?>
    </tbody>
</table>
<script src="/public/static/plugins/layui/layui.js"></script>
<script>
    layui.use(['layer'],function (){
        $=layui.jquery;
        layer=layui.layer;
    });
    //添加
    function add() {
        layer.open({
            type: 2,
            title: '添加菜单',
            shade: 0.3,
            maxmin: true,
            area: ['480px', '420px'],
            content: "<?php echo url('roles/add'); ?>" //iframe的url
        });
    }
    //编辑
    function edit(gid) {
        layer.open({
            type: 2,
            title: '编辑菜单',
            shade: 0.3,
            maxmin: true,
            area: ['480px', '420px'],
            content: '/public/admin/roles/edit?gid='+gid //iframe的url
        });
    }
    //删除
    function del(obj){
        var gid=$(obj).attr('gid');
        layer.confirm('确定要删除吗？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            $.post("<?php echo url('roles/delete'); ?>", {
                gid:gid
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