<?php /*a:1:{s:56:"D:\phpEnv\www\www.ytv.com\app\admin\view\cates\edit.html";i:1618066488;}*/ ?>
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
    <input type="hidden" name="id" value="<?php echo htmlentities($cateInfo['id']); ?>">
    <div class="layui-form-item">
        <label class="layui-form-label">分类名称</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input" name="name" value="<?php echo htmlentities($cateInfo['name']); ?>">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">排序</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input" name="sort" value="<?php echo htmlentities($cateInfo['sort']); ?>">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">所属类ID</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input" name="pid" value="<?php echo htmlentities($cateInfo['pid']); ?>">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">关键字</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input" name="keywords" value="<?php echo htmlentities($cateInfo['keywords']); ?>">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">描述</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input" name="desc" value="<?php echo htmlentities($cateInfo['desc']); ?>">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">状态</label>
        <div class="layui-input-inline">
            <input type="hidden" name="ishidden" value="0">
            <input type="hidden" name="status" value="0">
            <input type="checkbox" name="ishidden" lay-skin="primary" title="是否隐藏" value="1" <?php if($cateInfo['ishidden'] == 1): ?> checked<?php endif; ?>>
            <input type="checkbox" name="status" lay-skin="primary" title="是否禁用" value="1" <?php if($cateInfo['status'] == 1): ?> checked<?php endif; ?>>
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
        var name = $.trim($('input[name="name"]').val());
        if (name=== '') {
            layer.msg('请输入菜单名称', {icon: 2});
            return;
        }
        $.post("<?php echo url('cates/save'); ?>", $('form').serialize(), function (res) {
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