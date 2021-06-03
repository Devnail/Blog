<?php /*a:1:{s:55:"D:\phpEnv\www\www.ytv.com\app\admin\view\admin\add.html";i:1618066488;}*/ ?>
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
    <div class="layui-form-item">
        <label class="layui-form-label">用户名</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input" name="username">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">角色</label>
        <div class="layui-input-inline">
            <select name="gid">
                <option value=0></option>
                <?php if(is_array($adminGroup) || $adminGroup instanceof \think\Collection || $adminGroup instanceof \think\Paginator): $i = 0; $__LIST__ = $adminGroup;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?>
                <option value="<?php echo htmlentities($value['gid']); ?>"><?php echo htmlentities($value['title']); ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">密码</label>
        <div class="layui-input-inline">
            <input type="password" class="layui-input" name="password">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">姓名</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input" name="truename">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">头像</label>
        <div class="layui-input-block">
            <button type="button" class="layui-btn" id="upload" onclick="return false;">
                <i class="layui-icon">&#xe67c;</i>上传图片
            </button>
            <img src="" id="preview_img" height="30px">
            <input type="hidden" name="img" value="">
        </div>
    </div>
    <div class="layui-form-item layui-form-text">
        <label class="layui-form-label">个人介绍</label>
        <div class="layui-input-block">
            <textarea name="message" placeholder="请输入内容" class="layui-textarea"></textarea>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">状态</label>
        <div class="layui-input-inline">
            <input type="hidden" name="status" value="0">
            <input type="checkbox" lay-skin="primaty" title="禁用" value="1" name="status">
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
    layui.use(['form', 'layer','upload'], function () {
        var form = layui.form,
        layer = layui.layer,
        upload = layui.upload;
        $ = layui.jquery;
        var uploadInst = upload.render({
            elem: '#upload' //绑定元素
            , url: "<?php echo url('slider/upload'); ?>" //上传接口
            ,field: 'img'
            , done: function (res) {
                $('#preview_img').attr('src',res.data);
                $('input[name="img"]').attr('value',res.data);
                layer.msg(res.msg,{icon:1});
            }
            , error: function (res) {
                layer.msg(res.msg,{icon:2});
            }
        });
    });

    function save() {
        var username = $.trim($('input[name="username"]').val());
        var password = $.trim($('input[name="password"]').val());
        var gid = $('select[name="gid"]').val();
        var truename = $.trim($('input[name="truename"]').val());
        if (username === '') {
            layer.msg('请输入用户名', {icon: 2});
            return;
        }
        if (password=== '') {
            layer.msg('请输入密码', {icon: 2});
            return;
        }
        if (gid === '') {
            layer.msg('请选择用户角色', {icon: 2});
            return;
        }
        if (truename === '') {
            layer.msg('请输入姓名', {icon: 2});
            return;
        }
        $.post("<?php echo url('admin/save'); ?>", $('form').serialize(), function (res) {
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