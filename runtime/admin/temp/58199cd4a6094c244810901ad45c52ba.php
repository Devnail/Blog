<?php /*a:1:{s:55:"D:\phpEnv\www\www.ytv.com\app\admin\view\page\edit.html";i:1618066488;}*/ ?>
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
    <input type="hidden" value="<?php echo htmlentities($pageInfo['id']); ?>" name="id">
    <div class="layui-form-item">
        <label class="layui-form-label">标题</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input" name="title" value="<?php echo htmlentities($pageInfo['title']); ?>">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">关键字</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input" name="keywords" value="<?php echo htmlentities($pageInfo['keywords']); ?>">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">描述</label>
        <div class="layui-input-block">
            <input type="text" class="layui-input" name="desc" value="<?php echo htmlentities($pageInfo['desc']); ?>">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">图片上传</label>
        <div class="layui-input-block">
            <button type="button" class="layui-btn" id="upload" onclick="return false;">
                <i class="layui-icon">&#xe67c;</i>上传图片
            </button>
            <img src="<?php echo htmlentities($pageInfo['img']); ?>" id="preview_img" height="30px">
            <input type="hidden" name="img" value="<?php echo htmlentities($pageInfo['img']); ?>">
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-input-block">
            <input value="<?php echo htmlentities($pageInfo['content']); ?>" name="content" type="hidden">
            <textarea id="edit">
                <?php echo $pageInfo['content']; ?>
            </textarea>
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
    let edit;
   layui.extend({
       tinymce: '/public/static/plugins/layui_exts/tinymce/tinymce'
   }).use(['tinymce', 'layer','form','upload'], function () {
       var tinymce = layui.tinymce,upload=layui.upload,layer = layui.layer;
       $ = layui.jquery;
       edit = tinymce.render({
           elem: "#edit"
           ,images_upload_url:"<?php echo url('slider/upload'); ?>"//配置上传接口
           ,form:{
               name:'img'
           }
           , height: 450
           , width:'100%'
       });
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
        $('input[name="content"]').attr('value',edit.getContent());
        var title = $.trim($('input[name="title"]').val());
        if(title===''){
            layer.msg('请输入标题',{icon:2});
            return;
        }
        $.post("<?php echo url('page/save'); ?>",$('form').serialize(), function (res) {
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