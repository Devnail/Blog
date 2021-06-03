<?php /*a:1:{s:57:"D:\phpEnv\www\www.ytv.com\app\admin\view\admin\index.html";i:1618052238;}*/ ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
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
<body>
<div class="header" style="padding: 10px">
    <span>用户列表</span>
    <button class="layui-btn layui-btn-sm" onclick="add()">添加</button>
    <div></div>
</div>
<table class="layui-table">
    <thead>
    <tr>
        <th>ID</th>
        <th>用户名</th>
        <th>真实姓名</th>
        <th>角色</th>
        <th>状态</th>
        <th>添加时间</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
    <?php if(is_array($adminadminList) || $adminadminList instanceof \think\Collection || $adminadminList instanceof \think\Paginator): $i = 0; $__LIST__ = $adminadminList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?>
    <tr>
        <td><?php echo htmlentities($value['id']); ?></td>
        <td><?php echo htmlentities($value['username']); ?></td>
        <td><?php echo htmlentities($value['truename']); ?></td>
        <td><?php echo htmlentities($value['gid']); ?></td>
        <td><?php echo $value['status']===0 ? '正常' : '<span style="color: red">禁用</span>'; ?></td>
        <td><?php echo htmlentities(date('Y-m-d H:i:s',!is_numeric($value['add_time'])? strtotime($value['add_time']) : $value['add_time'])); ?></td>
        <td>
            <button class="layui-btn layui-btn-xs" onclick="edit(<?php echo htmlentities($value['id']); ?>)">编辑</button>
            <button class="layui-btn layui-btn-xs layui-btn-danger" onclick="del(this)" adminId="<?php echo htmlentities($value['id']); ?>">删除</button>
        </td>
    </tr>
    <?php endforeach; endif; else: echo "" ;endif; ?>
    </tbody>
</table>
<script src="/public/static/plugins/layui/layui.js"></script>
<script>
    layui.use('layer', function () {
        layer = layui.layer;
        $ = layui.jquery;
    });

    //添加
    function add() {
        layer.open({
            type: 2,
            title: '添加管理员',
            shade: 0.3,
            maxmin: true,
            area: ['480px', '420px'],
            content: "<?php echo url('admin/add'); ?>" //iframe的url
        });
    }
    //编辑
    function edit(id) {
        layer.open({
            type: 2,
            title: '编辑管理员',
            shade: 0.3,
            maxmin: true,
            area: ['480px', '420px'],
            content: "/public/admin/admin/edit?id="+id //iframe的url
        });
    }
    //删除
    function del(obj){
        var adminId=$(obj).attr('adminId');
        layer.confirm('确定要删除吗？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            $.post("<?php echo url('admin/delete'); ?>", {
                adminId:adminId,
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