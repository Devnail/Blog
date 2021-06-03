<?php /*a:1:{s:56:"D:\phpEnv\www\www.ytv.com\app\admin\view\page\index.html";i:1618052489;}*/ ?>
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
    <span>栏目列表</span>
    <button class="layui-btn layui-btn-sm" onclick="add()">添加</button>
    <div></div>
</div>
<table class="layui-table">
    <thead>
    <tr>
        <th>ID</th>
        <th>标题</th>
        <th>关键字</th>
        <th>描述</th>
        <th>图片</th>
        <th>添加时间</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
    <?php if(is_array($pageData) || $pageData instanceof \think\Collection || $pageData instanceof \think\Paginator): $i = 0; $__LIST__ = $pageData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$pv): $mod = ($i % 2 );++$i;?>
    <tr>
        <td><?php echo htmlentities($pv['id']); ?></td>
        <td><?php echo htmlentities($pv['title']); ?></td>
        <td><?php echo htmlentities($pv['keywords']); ?></td>
        <td><?php echo htmlentities($pv['desc']); ?></td>
        <td><img src="<?php echo htmlentities($pv['img']); ?>" height="30px"></td>
        <td><?php echo htmlentities(date('Y-m-d H:i:s',!is_numeric($pv['add_time'])? strtotime($pv['add_time']) : $pv['add_time'])); ?></td>
        <td>
            <button class="layui-btn layui-btn-xs" onclick="edit(<?php echo htmlentities($pv['id']); ?>)">编辑</button>
            <button class="layui-btn layui-btn-xs layui-btn-danger" onclick="del(this)" pageId="<?php echo htmlentities($pv['id']); ?>">删除</button>
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
            title: '添加页面',
            shade: 0.3,
            maxmin: true,
            area: ['800px', '600px'],
            content: "<?php echo url('page/add'); ?>" //iframe的url
        });
    }
    //编辑
    function edit(id) {
        layer.open({
            type: 2,
            title: '编辑页面',
            shade: 0.3,
            maxmin: true,
            area: ['800px', '600px'],
            content: "/public/admin/page/edit?id="+id //iframe的url
        });
    }
    //删除
    function del(obj){
        var pageId=$(obj).attr('pageId');
        layer.confirm('确定要删除吗？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            $.post("<?php echo url('page/delete'); ?>", {
                pageId:pageId,
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