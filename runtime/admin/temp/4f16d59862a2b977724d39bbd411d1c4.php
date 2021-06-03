<?php /*a:1:{s:56:"D:\phpEnv\www\www.ytv.com\app\admin\view\home\index.html";i:1617935613;}*/ ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>后台首页</title>
    <link rel="stylesheet" type="text/css" href="/public/static/plugins/layui/css/layui.css">
    <style>
        .header {
            width: 100%;
            height: 50px;
            line-height: 50px;
            background: #2e6da4;
            color: #ffffff;
        }

        .title {
            margin-left: 20px;
            font-size: 20px;
        }

        .userinfo {
            float: right;
            margin-right: 10px;
        }

        .userinfo a {
            color: #ffffff;
        }

        .menu {
            width: 200px;
            background-color: #333744;
            position: absolute;
        }

        .layui-collapse {
            border: none;
        }

        .layui-colla-item {
            border-top: none;
        }

        .layui-colla-title {
            background-color: #393D49;
            color: #FFFFFF;
        }

        .layui-colla-content {
            border: 0;
            padding: 0;
        }
        .main{
            position: absolute;
            left: 200px;
            right: 0;
        }
    </style>
</head>
<body>
<!--header-->
<div class="header">
    <span class="title"><?php echo htmlentities($site['values']['title']); ?>管理系统</span>
    <span class="userinfo">
        <span>
            <a href="<?php echo url('index/index/index'); ?>"><img src="<?php echo htmlentities($admin['img']); ?>" class="layui-nav-img"><?php echo htmlentities($admin['username']); ?>【<?php echo htmlentities($role['title']); ?>】</a>
        </span>
        <span>
            <a href="javascript:;" onclick="logout()">退出</a>
        </span>
    </span>
</div>
<!--left-menu-->
<div class="menu" id="menu">
    <div class="layui-collapse" lay-accordion>
        <?php if(is_array($menu) || $menu instanceof \think\Collection || $menu instanceof \think\Paginator): $i = 0; $__LIST__ = $menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?>
        <div class="layui-colla-item">
            <h2 class="layui-colla-title"><?php echo htmlentities($value['title']); ?></h2>
            <div class="layui-colla-content">
                <?php if(isset($value['child'])&&$value['child']): ?>
                <ul class="layui-nav layui-nav-tree" lay-filter="test">
                    <?php if(is_array($value['child']) || $value['child'] instanceof \think\Collection || $value['child'] instanceof \think\Paginator): $i = 0; $__LIST__ = $value['child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cvalue): $mod = ($i % 2 );++$i;?>
                    <li class="layui-nav-item"><a href="javascript:;" onclick="menuFire(this)" src="/public/admin/<?php echo htmlentities($cvalue['controller']); ?>/<?php echo htmlentities($cvalue['method']); ?>"><?php echo htmlentities($cvalue['title']); ?></a></li>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
                <?php endif; ?>
            </div>
        </div>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
</div>
<!--page-->
<div class="main">
    <iframe src="<?php echo url('home/welcome'); ?>" style="width: 100%;height: 100%" frameborder="0" scrolling="0" onload="resetMainHeight(this)"></iframe>
</div>
<script src="/public/static/plugins/layui/layui.js"></script>
<script>
    layui.use(['element','layer'], function () {
        var element = layui.element;
        $ = layui.jquery;
        resetMenuHeight();
    });
    //重新设置菜单高度
    function resetMenuHeight(){
        //获取浏览器高度
        var height=document.documentElement.clientHeight-50;
        $('#menu').height(height);
    }
    function resetMainHeight(obj){
        var height=parent.document.documentElement.clientHeight-53;
        $(obj).parent('div').height(height);
    }
    //菜单点击
    function menuFire(obj){
        //获取url
        var src=$(obj).attr('src');
        //设置iframe的src
        $('iframe').attr('src',src);
    }
    //退出账号
    function logout(){
        //退前前确认
        layer.confirm('确定要退出吗',{
            'icon':3,
            'btn':['确定','取消'],

        },function (){
            $.get("<?php echo url('index/logout'); ?>",function (res){
                if(res.code>0){
                    layer.msg(res.msg,{icon:2});
                }else {
                    layer.msg(res.msg,{icon:1});
                    setTimeout(function (){window.location.href="<?php echo url('index/index'); ?>"},1000);
                }
            },'json')
        });
    }
</script>
</body>
</html>