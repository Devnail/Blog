<?php /*a:1:{s:55:"D:\phpEnv\www\www.ytv.com\app\admin\view\menu\edit.html";i:1618066488;}*/ ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <link rel="stylesheet" type="text/css" href="/public/static/plugins/layui/css/layui.css">
</head>
<body style="padding: 10px">
<form class="layui-form">
    <input type="hidden" name="mid" value="<?php echo htmlentities($menuInfo['mid']); ?>">
    <div class="layui-form-item">
        <label class="layui-form-label">菜单名称</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input" name="title" value="<?php echo htmlentities($menuInfo['title']); ?>">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">排序</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input" name="ord" value="<?php echo htmlentities($menuInfo['ord']); ?>">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">所属类id</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input" name="pid" value="<?php echo htmlentities($menuInfo['pid']); ?>">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">控制器</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input" name="controller" value="<?php echo htmlentities($menuInfo['controller']); ?>">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">方法</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input" name="method" value="<?php echo htmlentities($menuInfo['method']); ?>">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">状态</label>
        <div class="layui-input-inline">
            <input type="hidden" name="ishidden" value="0">
            <input type="hidden" name="status" value="0">
            <input type="checkbox" name="ishidden" lay-skin="primary" title="是否隐藏"  value="1" <?php if($menuInfo['ishidden'] == 1): ?>checked<?php endif; ?>>
            <input type="checkbox" name="status" lay-skin="primary" title="是否禁用"  value="1" <?php if($menuInfo['status'] == 1): ?>checked<?php endif; ?>>
        </div>
    </div>
</form>
<div class="layui-form-item">
    <div class="layui-input-block">
        <button class="layui-btn" onclick="save()">保存</button>
    </div>
</div>
<script src="/public/static/plugins/layui/layui.js"></script>
<script>
    layui.use(['form', 'layer'], function () {
        form = layui.form;
        layer = layui.layer;
        $ = layui.jquery;
    });

    function save() {
        var title = $.trim($('input[name="title"]').val());
        if (title === '') {
            layer.msg('请输入菜单名称', {icon: 2});
            return;
        }
        $.post("<?php echo url('menu/save'); ?>", $('form').serialize(), function (res) {
            if(res.code>0){
                layer.msg(res.msg,{icon:2});
            }else {
                layer.msg(res.msg);
                setTimeout(function (){parent.window.location.reload();},1000);
            }
        }, 'json');
    }
</script>
</body>
</html>