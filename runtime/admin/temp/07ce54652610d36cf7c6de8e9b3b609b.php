<?php /*a:1:{s:56:"D:\phpEnv\www\www.ytv.com\app\admin\view\menu\index.html";i:1618052425;}*/ ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>菜单列表</title>
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
    <span>菜单列表</span>
    <button class="layui-btn layui-btn-sm layui-btn-primary" onclick="backMenu(<?php echo htmlentities($backid); ?>)">返回上级</button>
    <button class="layui-btn layui-btn-sm" onclick="add()">添加</button>
    <div></div>
</div>
<table class="layui-table">
    <thead>
    <tr>
        <th>ID</th>
        <th>排序</th>
        <th>菜单名称</th>
        <th>控制器</th>
        <th>方法</th>
        <th>是否隐藏</th>
        <th>状态</th>
        <th>操作</th>
        <th>子菜单</th>
    </tr>
    </thead>
    <tbody>
    <?php if(is_array($dataList) || $dataList instanceof \think\Collection || $dataList instanceof \think\Paginator): $i = 0; $__LIST__ = $dataList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?>
    <tr>
        <td><?php echo htmlentities($value['mid']); ?></td>
        <td><?php echo htmlentities($value['ord']); ?></td>
        <td><?php echo htmlentities($value['title']); ?></td>
        <td><?php echo htmlentities($value['controller']); ?></td>
        <td><?php echo htmlentities($value['method']); ?></td>
        <td><?php echo $value['ishidden']===1 ? '隐藏' : '显示'; ?></td>
        <td><?php echo $value['status']===1 ? '禁用' : '启用'; ?></td>
        <td>
            <button class="layui-btn layui-btn-xs" onclick="edit(<?php echo htmlentities($value['mid']); ?>)">编辑</button>
            <button class="layui-btn layui-btn-xs layui-btn-danger" onclick="del(this)" menuId="<?php echo htmlentities($value['mid']); ?>">删除</button>
        </td>
        <td>
            <button class="layui-btn layui-btn-xs" onclick="child(<?php echo htmlentities($value['mid']); ?>)">子菜单</button>
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
            title: '添加菜单',
            shade: 0.3,
            maxmin: true,
            area: ['480px', '420px'],
            content: "<?php echo url('menu/add'); ?>" //iframe的url
        });
    }
    //编辑
    function edit(mid) {
        layer.open({
            type: 2,
            title: '编辑菜单',
            shade: 0.3,
            maxmin: true,
            area: ['480px', '420px'],
            content: "/public/admin/menu/edit?mid="+mid //iframe的url
        });
    }
    //删除
    function del(obj){
        var menuId=$(obj).attr('menuId');
        layer.confirm('确定要删除吗？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            $.post("<?php echo url('menu/delete'); ?>", {
                menuId:menuId,
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
    //子菜单
    function child(pid){
        window.location.href="/public/admin/menu/index?pid="+pid;
    }
    function backMenu(pid){
        window.location.href="/public/admin/menu/index?pid="+pid;
    }
</script>
</body>
</html>