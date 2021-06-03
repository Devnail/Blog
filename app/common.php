<?php
// 应用公共文件

//后台弹窗
function alert($msg, $icon)
{
    $str = '<meta name="viewport" content="initial-scale=1, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <meta http-equiv="Access-Control-Allow-Origin" content="*" />
    <meta http-equiv="pragma" content="no-cache" />
    <script src="/public/static/plugins/layui/layui.js"></script>
    <script src="/public/static/js/jquery-3.4.1.min.js"></script>
    <script>layui.use("layer", function () {layer = layui.layer;});</script>
    ';
    $str.='<script>$(function (){layer.msg("'.$msg.'",{icon:'.$icon.'});})</script>';
    return $str;
}

//删除目录及文件，传入目录
function delFileByDir($dir)
{
    $dh = opendir($dir);
    while ($file = readdir($dh)) {
        if ($file != "." && $file != "..") {

            $fullpath = $dir . "/" . $file;
            if (is_dir($fullpath)) {
                delFileByDir($fullpath);
            } else {
                unlink($fullpath);
            }
        }
    }
    closedir($dh);
}

//文件删除
function delFile($img){
    if(!empty($img)){
        //具体位置加文件名
        $path=root_path().$img;
    }
    if(file_exists($path)){
        //删除文件
        unlink($path);
    }
}

//截取字符
function subtext($text,$length){
    if(mb_strlen($text,'utf8')>$length){
        return mb_substr($text,0,$length,'utf8').'...';
        return  $text;
    }
}