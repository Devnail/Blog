<?php /*a:1:{s:57:"D:\phpEnv\www\www.ytv.com\app\admin\view\index\login.html";i:1618118822;}*/ ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>登入</title>
    <link rel="stylesheet" type="text/css" href="/public/static/plugins/layui/css/layui.css">
</head>
<body class="layui-bg-gray">
<div style="position: absolute; left:50%;top:50%;width: 500px;margin-left: -250px;margin-top: -200px;">
    <div style="background: #ffffff;padding: 20px;border-radius: 4px;box-shadow: 5px 5px 20px #444444;">
        <div class="layui-form">
            <div class="layui-form-item" style="color: gray">
                <h2>登入</h2>
            </div>
            <hr>
            <div class="layui-form-item">
                <label class="layui-form-label">
                    用户名
                </label>
                <div class="layui-input-block">
                    <input type="text" id="username" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">
                    密码
                </label>
                <div class="layui-input-block">
                    <input type="password" id="password" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">验证码</label>
                <div class="layui-input-inline">
                    <input type="text" id="verifycode" class="layui-input">
                </div>
                <img src="<?php echo captcha_src(); ?>" alt="captcha" id="img" onclick="reloadImg()"/>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn" onclick="login()">登入</button>
                    <a href="<?php echo url('index/index/index'); ?>" class="layui-btn">返回</a>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/public/static/plugins/layui/layui.js"></script>
<script>
    layui.use('layer', function () {
        $ = layui.jquery;
        layer = layui.layer;
        // 用户名控件获取焦点
        $('#username').focus();
        // 回车登录
        $('input').keydown(function (e) {
            if (e.keyCode == 13) {
                login();
            }
        });
    });

    // 重新生成验证码
    function reloadImg() {
        $('#img').attr('src', '<?php echo captcha_src(); ?>?rand=' + Math.random());
    }

    //登入
    function login() {
        var username = $.trim($('#username').val());
        var password = $.trim($('#password').val());
        var verifycode = $.trim($('#verifycode').val());
        if (username === '') {
            layer.msg('请输入用户名', {icon: 2});
            return;
        }
        if (password === '') {
            layer.msg('请输入密码', {icon: 2});
            return;
        }
        if (verifycode === '') {
            layer.msg('请输入验证码', {icon: 2});
            return;
        }
        $.post("<?php echo url('index/dologin'); ?>", {
            username: username,
            password: password,
            verifycode: verifycode
        }, function (res) {
            if (res.code > 0) {
                reloadImg();
                layer.msg(res.msg, {icon: 2});
            } else {
                layer.msg(res.msg);
                setTimeout(function () {
                    window.location.href = "<?php echo url('home/index'); ?>"
                }, 1000);
            }
        }, 'json');
    }
</script>
</body>
</html>