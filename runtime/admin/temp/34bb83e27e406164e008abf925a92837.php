<?php /*a:1:{s:55:"D:\phpEnv\www\www.ytv.com\app\admin\view\roles\add.html";i:1615824918;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>添加角色</title>
    <link rel="stylesheet" type="text/css" href="/public/static/plugins/layui/css/layui.css">
</head>
<body style="padding: 10px">
<form class="layui-form">
    <div class="layui-form-item">
        <label class="layui-form-label">角色名称</label>
        <div class="layui-input-block">
            <input type="text" class="layui-input" name="title">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">权限菜单</label>
        <?php if(is_array($results) || $results instanceof \think\Collection || $results instanceof \think\Paginator): $i = 0; $__LIST__ = $results;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?>
        <div class="layui-input-block">
            <input type="checkbox" name="menu[<?php echo htmlentities($value['mid']); ?>]" lay-skin="primary" title="<?php echo htmlentities($value['title']); ?>">
            <hr>
            <?php if(is_array($value['child']) || $value['child'] instanceof \think\Collection || $value['child'] instanceof \think\Paginator): $i = 0; $__LIST__ = $value['child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cvalue): $mod = ($i % 2 );++$i;?>
            <input type="checkbox" name="menu[<?php echo htmlentities($cvalue['mid']); ?>]" lay-skin="primary" title="<?php echo htmlentities($cvalue['title']); ?>">
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
</form>
<div class="layui-form-item">
    <div class="layui-input-block">
        <button class="layui-btn" onclick="save()">保存</button>
    </div>
</div>
<script src="/public/static/plugins/layui/layui.js"></script>
<script>
    layui.use(['layer', 'form'], function () {
        var form = layui.form;
        layer = layui.layer;
        $ = layui.jquery;
    });

    function save() {
        var title = $.trim($('input[name="title"]').val());
        if (title === '') {
            layer.msg('请填写角色名称', {icon: 2});
            return;
        }
        $.post("<?php echo url('roles/save'); ?>", $('form').serialize(), function (res) {
            if(res.code>0){
                layer.msg(res.msg,{icon:2});
            }else {
                layer.msg(res.msg);
                setTimeout(function (){parent.window.location.reload();},1000);
            }
        }, 'json');
    }
</script>
<script></script>
</body>
</html>