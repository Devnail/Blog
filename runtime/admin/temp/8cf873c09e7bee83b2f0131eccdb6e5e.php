<?php /*a:1:{s:56:"D:\phpEnv\www\www.ytv.com\app\admin\view\site\index.html";i:1615819723;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>网站设置</title>
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
    </style>
</head>
<body style="padding: 10px">
<div class="header" style="padding: 10px">
    <span>网站设置</span>
    <div></div>
</div>
<form class="layui-form">
    <div class="layui-form-item">
        <label class="layui-form-label">网站名称</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input" id="title" value="<?php echo htmlentities($site['values']['title']); ?>">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">关键字</label>
        <div class="layui-input-block">
            <input type="text" class="layui-input" id="key" value="<?php echo htmlentities($site['values']['key']); ?>">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">描述</label>
        <div class="layui-input-block">
            <input type="text" class="layui-input" id="desc" value="<?php echo htmlentities($site['values']['desc']); ?>">
        </div>
    </div>
</form>
<div class="layui-form-item">
    <div class="layui-input-block">
        <button class="layui-btn" onclick=save()>提交</button>
    </div>
</div>
<script src="/public/static/plugins/layui/layui.js"></script>
<script>
    layui.use(['layer'], function () {
        $ = layui.jquery;
        layer = layui.layer;
    });
    function save() {
        var title = $.trim($('#title').val());
        if (title === '') {
            layer.msg('网站名称不能为空', {icon: 2});
            return;
        }
        var values=new Object();
        values.title=title;
        values.key=$.trim($('#key').val());
        values.desc=$.trim($('#desc').val());

        var data=new Object();
        data.name='site';
        data.values=values;
        $.post("<?php echo url('site/save'); ?>", data, function (res) {
            if (res.code > 0) {
                layer.msg(res.msg, {icon: 2});
            } else {
                layer.msg(res.msg, {icon: 1});
                setTimeout(function () {
                    window.location.reload();
                }, 1000)
            }
        }, 'json')
    }
</script>
</body>
</html>