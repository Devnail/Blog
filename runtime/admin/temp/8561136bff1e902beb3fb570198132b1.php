<?php /*a:1:{s:58:"D:\phpEnv\www\www.ytv.com\app\admin\view\comment\edit.html";i:1618066488;}*/ ?>
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
    <input type="hidden" name="pid" value="<?php echo htmlentities($comInfo['id']); ?>">
    <input type="hidden" name="aid" value="<?php echo htmlentities($comInfo['aid']); ?>">
    <input type="hidden" name="user_id" value="<?php echo htmlentities($replayId); ?>">
    <div class="layui-form-item">
        <label class="layui-form-label">用户</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input" name="sort" value="<?php echo htmlentities($toReply); ?>" disabled>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">状态</label>
        <div class="layui-input-inline">
            <input type="hidden" name="status" value="0">
            <input type="checkbox" name="status" lay-skin="primary" title="是否禁用" value="1" <?php if($comInfo['status'] == 1): ?> checked<?php endif; ?>>
        </div>
    </div>
    <div class="layui-form-item layui-form-text">
        <label class="layui-form-label">回复内容</label>
        <div class="layui-input-block">
            <textarea name="content" placeholder="请输入内容" class="layui-textarea"></textarea>
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
        var content = $.trim($('textarea[name="content"]').val());
        if (content=== '') {
            layer.msg('请输入内容', {icon: 2});
            return;
        }
        $.post("<?php echo url('comment/save'); ?>", $('form').serialize(), function (res) {
            if(res.code>0){
                layer.alert(res.msg,{icon:2});
            }else {
                layer.alert(res.msg);
                setTimeout(function (){parent.window.location.reload();},1000);
            }
        }, 'json');
    }
</script>
</body>
</html>