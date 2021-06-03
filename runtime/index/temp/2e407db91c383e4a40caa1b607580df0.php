<?php /*a:4:{s:59:"D:\phpEnv\www\www.ytv.com\app\index\view\single\single.html";i:1618084402;s:59:"D:\phpEnv\www\www.ytv.com\app\index\view\public\header.html";i:1618048011;s:60:"D:\phpEnv\www\www.ytv.com\app\index\view\public\righter.html";i:1618038596;s:59:"D:\phpEnv\www\www.ytv.com\app\index\view\public\footer.html";i:1618031178;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo htmlentities($article['title']); ?></title>

    <meta charset="utf-8">
    <!--[if IE]>
    <meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="">

    <!-- Google Fonts -->
    <!-- <link href='http://fonts.googleapis.com/css?family=Raleway:300,400%7COpen+Sans:400,400i,700%7CLibre+Baskerville:400i' rel='stylesheet'> -->

    <!-- Css -->
    <link rel="stylesheet" href="/public/index/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="/public/index/css/font-icons.css"/>
    <link rel="stylesheet" href="/public/index/css/sliders.css"/>
    <link rel="stylesheet" href="/public/index/css/style.css"/>
    <link rel="stylesheet" href="/public/index/css/responsive.css"/>
    <link rel="stylesheet" href="/public/index/css/spacings.css"/>
    <link rel="stylesheet" href="/public/index/css/animate.min.css"/>
    <link rel="stylesheet" href="/public/index/css/mypage.css"/>
</head>

<body class="relative">

<!-- Preloader -->
<div class="loader-mask">
    <div class="loader">
        <div></div>
        <div></div>
    </div>
</div>

<div class="main-wrapper oh">
    <header class="nav-type-1 dark-nav">

    <!-- Fullscreen search -->
    <div class="search-wrap">
        <div class="search-inner">
            <div class="search-cell">
                <form method="get"action="<?php echo url('search/index'); ?>">
                    <div class="search-field-holder">
                        <input type="search" class="form-control main-search-input" placeholder="查找" name="keywords">
                        <div class="search-submit-icon"><i class="icon icon_search"></i></div>
                        <input type="submit" class="search-submit" value="search">
                    </div>
                </form>
            </div>
        </div>
        <i class="icon icon_close search-close" id="search-close"></i>
    </div> <!-- end fullscreen search -->

    <nav class="navbar navbar-fixed-top">
        <div class="navigation">
            <div class="container relative">

                <div class="row">

                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div> <!-- end navbar-header -->


                    <!-- side menu -->
                    <div class="side-menu nav-left hidden-sm hidden-xs">
                        <div class="nav-inner">
                            <div class="nav-search-wrap hidden-sm hidden-xs">
                                <a href="#" class="nav-search search-trigger">
                                    <i class="icon icon_search"></i>
                                </a>
                            </div>
                        </div>
                    </div> <!-- end side menu -->

                    <div class="col-md-12 nav-wrap">
                        <div class="collapse navbar-collapse text-center" id="navbar-collapse">

                            <ul class="nav navbar-nav">

                                <li><a href="<?php echo url('index/index'); ?>">主页</a></li>
                                <li><a href="<?php echo url('about/index'); ?>">关于</a></li>
                                <li><a href="<?php echo url('blog/index'); ?>">博文</a></li>
                                <?php if(empty($username) || (($username instanceof \think\Collection || $username instanceof \think\Paginator ) && $username->isEmpty())): ?>
                                <li>
                                    <a href="<?php echo url('admin/index/index'); ?>">登入</a>
                                </li>
                                <li>
                                    <a href="<?php echo url('admin/index/registered'); ?>">注册</a>
                                </li>
                                <?php else: ?>
                                <li>
                                    <a href="<?php echo url('admin/home/index'); ?>"><?php echo htmlentities($username['username']); ?></a>
                                </li>
                                <li>
                                    <a href="<?php echo url('index/logout'); ?>">注销</a>
                                </li>
                                <?php endif; ?>
                                <li id="mobile-search" class="hidden-lg hidden-md">
                                    <form method="get" class="mobile-search">
                                        <input type="search" class="form-control" placeholder="查找...">
                                        <button type="submit" class="search-button">
                                            <i class="icon icon_search"></i>
                                        </button>
                                    </form>
                                </li>

                            </ul> <!-- end menu -->
                        </div> <!-- end collapse -->
                    </div> <!-- end col -->

                    <!-- side menu -->
                    <div class="side-menu right mobile-left-align">
                        <div class="nav-inner menu-socials social-icons">
                            <div class="right">
                                <a href="#"><i class="fa fa-wechat"></i></a>
                                <a href="#"><i class="fa fa-qq"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-weibo"></i></a>
                                <a href="#"><i class="fa fa-google"></i></a>
                            </div>
                        </div>
                    </div> <!-- end side menu -->

                </div> <!-- end row -->
            </div> <!-- end container -->
        </div> <!-- end navigation -->
    </nav> <!-- end navbar -->
</header>
    <section class="bg-light">
        <div class="container-fluid">
            <div class="logo-container text-center">
                <div class="logo-wrap">
                    <a href="single.html">
                        <img class="logo-dark" src="<?php echo htmlentities($article['img']); ?>" alt="logo">
                    </a>
                </div>
            </div>
        </div>
    </section>
    <div class="content-wrapper oh">

        <!-- Content -->
        <section class="content post-single pt-70 pt-mdm-60">
            <div class="container relative">
                <div class="row">

                    <!-- post content -->
                    <div class="col-md-9 post-content mb-50">

                        <!-- large post -->
                        <article class="entry-item large-post">

                            <div class="entry-header">
                                <a href="<?php echo url('category/index',['cid'=>$article['cate_id']]); ?>" class="entry-category"><?php echo htmlentities($article['name']); ?></a>
                                <h1 class="entry-title"><?php echo htmlentities($article['title']); ?></h1>
                            </div>

                            <div class="entry-img">
                                <img src="<?php echo htmlentities($article['img']); ?>" alt="">
                            </div>

                            <div class="entry-wrap">
                                <div class="entry">

                                    <div class="entry-content">
                                        <div class="article">
                                            <?php echo htmlspecialchars_decode($article['content']); ?>
                                        </div>

                                        <div class="entry-meta-wrap clearfix">
                                            <ul class="entry-meta">
                                                <li class="entry-date">
                                                    <a href="#"><?php echo htmlentities(date('Y-m-d',!is_numeric($article['add_time'])? strtotime($article['add_time']) : $article['add_time'])); ?></a>
                                                </li>
                                            </ul>

                                            <div class="social-icons right">
                                                <a href="#"><i class="fa fa-wechat"></i></a>
                                                <a href="#"><i class="fa fa-qq"></i></a>
                                                <a href="#"><i class="fa fa-twitter"></i></a>
                                                <a href="#"><i class="fa fa-weibo"></i></a>
                                                <a href="#"><i class="fa fa-google"></i></a>
                                            </div>
                                        </div>


                                        <!-- related posts -->
                                        <div class="related-posts mt-40">
                                            <div class="heading-lines mb-30">
                                                <h3 class="heading small">近期发布</h3>
                                            </div>
                                            <div class="row">
                                                <?php if(is_array($recentArticle) || $recentArticle instanceof \think\Collection || $recentArticle instanceof \think\Paginator): $i = 0; $__LIST__ = $recentArticle;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ra): $mod = ($i % 2 );++$i;?>
                                                <div class="col-sm-4">
                                                    <article class="entry-item">
                                                        <div class="entry-img">
                                                            <a href="blog-single.html">
                                                                <img src="<?php echo htmlentities($ra['img']); ?>">
                                                            </a>
                                                        </div>
                                                        <h4 class="entry-title">
                                                            <a href="<?php echo url('single/index',['id'=>$ra['id']]); ?>"><?php echo htmlentities($ra['title']); ?></a>
                                                        </h4>
                                                        <div class="entry-meta-wrap clearfix">
                                                            <ul class="entry-meta">
                                                                <li class="entry-date">
                                                                    <a href="#"><?php echo htmlentities(date('Y-m-d',!is_numeric($ra['add_time'])? strtotime($ra['add_time']) : $ra['add_time'])); ?></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </article>
                                                </div>
                                                <?php endforeach; endif; else: echo "" ;endif; ?>
                                            </div>
                                        </div>

                                        <!-- Comments -->
                                        <div class="entry-comments mt-20">
                                            <div class="heading-lines mb-30">
                                                <h3 class="heading small">留下你的评论</h3>
                                            </div>
                                            <ul class="comment-list" id="pageMain">
                                                <?php if(is_array($comment) || $comment instanceof \think\Collection || $comment instanceof \think\Paginator): $i = 0; $__LIST__ = $comment;if( count($__LIST__)==0 ) : echo "暂时没有评论!" ;else: foreach($__LIST__ as $key=>$cv): $mod = ($i % 2 );++$i;?>
                                                <li>
                                                    <?php if($cv['level']===0): ?>
                                                    <div class="comment-body">
                                                        <img src="<?php echo htmlentities($cv['img']); ?>" class="comment-avatar" width="70" height="70">
                                                        <div class="comment-content">
                                                            <span class="comment-author"><?php echo htmlentities($cv['username']); ?></span>
                                                            <span class="comment-date"><?php echo htmlentities(date('Y-m-d',!is_numeric($cv['add_time'])? strtotime($cv['add_time']) : $cv['add_time'])); ?></span>
                                                            <p><?php echo htmlentities($cv['content']); ?></p>
                                                            <a href="javascript:;" class="reply" pid="<?php echo htmlentities($cv['id']); ?>" uid="<?php echo htmlentities($cv['user_id']); ?>" sid="<?php echo htmlentities($userId); ?>">回复</a>
                                                        </div>
                                                    </div>
                                                    <?php else: ?>
                                                    <ul class="comment-reply">
                                                        <li>
                                                            <div class="comment-body">
                                                                <img src="<?php echo htmlentities($cv['img']); ?>" class="comment-avatar" width="70" height="70">
                                                                <div class="comment-content">
                                                                    <span class="comment-author"><?php echo htmlentities($cv['username']); ?></span>
                                                                    <span class="comment-date"><?php echo htmlentities(date('Y-m-d',!is_numeric($cv['add_time'])? strtotime($cv['add_time']) : $cv['add_time'])); ?></span>
                                                                    <p><?php echo htmlentities($cv['content']); ?></p>
                                                                    <a href="javascript:;" class="reply" pid="<?php echo htmlentities($cv['id']); ?>" uid="<?php echo htmlentities($cv['user_id']); ?>" sid="<?php echo htmlentities($userId); ?>">回复</a>
                                                                </div>
                                                            </div>
                                                        </li> <!-- end reply comment -->
                                                    </ul>
                                                    <?php endif; ?>
                                                </li> <!-- end 1-2 comment -->
                                                <?php endforeach; endif; else: echo "暂时没有评论!" ;endif; ?>
                                            </ul>
                                            <?php if(!(empty($comment) || (($comment instanceof \think\Collection || $comment instanceof \think\Paginator ) && $comment->isEmpty()))): ?>
                                                <div id="pageBox" class="text-center">
                                                <span id="prev">上一页</span>
                                                <ul id="pageNav"></ul>
                                                <span id="next">下一页</span>
                                            </div>
                                            <?php endif; ?>
                                        </div> <!--  end comments -->

                                        <!-- Leave a Comment -->
                                        <div class="comment-form mt-60">
                                            <div class="heading-lines mb-30">
                                                <h3 class="heading small">留下评论</h3>
                                            </div>
                                            <form id="my-comment">
                                                <input type="hidden" name="pid" value="0">
                                                <input type="hidden" name="aid" value="<?php echo htmlentities($article['id']); ?>">
                                                <input type="hidden" name="user_id" value="<?php echo htmlentities($userId); ?>">
                                                <div class="row row-16">
                                                    <div class="col-md-12">
                                                    <textarea  name="content" placeholder="留下你的评论"
                                                              rows="8"></textarea>
                                                    </div>
                                                </div>
                                            </form>
                                            <input type="button" class="btn btn-lg btn-color mt-20" value="发表" id="submit-message" onclick="save()">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article> <!-- end large post -->
                    </div> <!-- end col -->

                    <!-- Sidebar -->
                    <aside class="col-md-3 sidebar">
    <?php if(!(empty($username) || (($username instanceof \think\Collection || $username instanceof \think\Paginator ) && $username->isEmpty()))): ?>
    <div class="widget about-blog text-center">
        <div class="heading-lines">
            <h3 class="widget-title heading">关于我</h3>
        </div>
        <img src="<?php echo htmlentities($username['img']); ?>" alt="">
        <p class="mb-20 mt-30"><?php echo htmlentities($username['message']); ?></p>
    </div>
    <?php endif; ?>
    <!-- Categories -->
    <div class="widget categories">
        <div class="heading-lines">
            <h3 class="widget-title heading">分类</h3>
        </div>
        <ul class="list-dividers">
            <?php if(is_array($cates) || $cates instanceof \think\Collection || $cates instanceof \think\Paginator): $i = 0; $__LIST__ = $cates;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cv): $mod = ($i % 2 );++$i;?>
            <li>
                <a href="<?php echo url('category/index',['cid'=>$cv['id']]); ?>"><?php echo htmlentities($cv['name']); ?></a><span>(<?php echo htmlentities($cv['count']); ?>)</span>
            </li>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
    </div>

    <!-- Ad banner -->
    <div class="widget custom-ad-banner">
        <?php if(is_array($slider) || $slider instanceof \think\Collection || $slider instanceof \think\Paginator): $i = 0; $__LIST__ = $slider;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sv): $mod = ($i % 2 );++$i;?>
        <a href="<?php echo htmlentities($sv['url']); ?>" target="_blank">
            <img src="<?php echo htmlentities($sv['img']); ?>" alt="<?php echo htmlentities($sv['title']); ?>" class="mb-10">
        </a>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </div>

    <!-- Recent Posts -->
    <div class="widget recent-posts">
        <div class="heading-lines">
            <h3 class="widget-title heading">最近发布</h3>
        </div>
        <div class="entry-list w-thumbs">
            <ul class="posts-list list-dividers">
                <?php if(is_array($rArticle) || $rArticle instanceof \think\Collection || $rArticle instanceof \think\Paginator): $i = 0; $__LIST__ = $rArticle;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$rv): $mod = ($i % 2 );++$i;?>
                <li class="entry-li">
                    <article class="post-small clearfix">
                        <div class="entry-img">
                            <a href="<?php echo url('single/index',['id'=>$rv['id']]); ?>" target="_blank">
                                <img src="<?php echo htmlentities($rv['img']); ?>" width="100px" height="100px">
                            </a>
                        </div>
                        <div class="entry">
                            <h3 class="entry-title"><a href="<?php echo url('single/index',['id'=>$rv['id']]); ?>"><?php echo htmlentities($rv['title']); ?></a></h3>
                            <ul class="entry-meta list-inline">
                                <li class="entry-date">
                                    <a href="#"><?php echo htmlentities(date('Y-m-d',!is_numeric($rv['add_time'])? strtotime($rv['add_time']) : $rv['add_time'])); ?></a>
                                </li>
                            </ul>
                        </div>
                    </article>
                </li>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
    </div>
</aside>
                    <!-- end sidebar -->

                </div> <!-- end row -->
            </div> <!-- end container -->
        </section> <!-- end content -->

        <!-- Instagram Feed -->
<div class="instagram-feed text-center">
    <h3 class="heading uppercase"><?php echo htmlentities($contact['title']); ?></h3>
    <img src="<?php echo htmlentities($contact['img']); ?>" width="100" height="100">
    <h5 class="heading uppercase mb-30"><?php echo htmlspecialchars_decode($contact['content']); ?></h5>
    <ul id="instafeed-row"></ul>
</div>


<div class="widget-social">
    <div class="social-icons text-center">
        <a href="#">
            <i class="fa fa-wechat"></i>
            <span>wechat</span>
        </a>
        <a href="#">
            <i class="fa fa-qq"></i>
            <span>qq</span>
        </a>
        <a href="#">
            <i class="fa fa-twitter"></i>
            <span>twitter</span>
        </a>
        <a href="#">
            <i class="fa fa-weibo"></i>
            <span>weibo</span>
        </a>
        <a href="#">
            <i class="fa fa-google"></i>
            <span>google</span>
        </a>
    </div>
</div>


<!-- Footer Type-1 -->
<footer class="footer footer-type-1 bg-dark">
    <div class="bottom-footer">
        <div class="container">
            <div class="row">

                <div class="col-sm-12 copyright text-center">
                <span>
                  Copyright &copy; 2020.ywn博客
                </span>
                </div>

            </div>
        </div>
    </div>
</footer> <!-- end footer -->


<div id="back-to-top">
    <a href="#top"><i class="fa fa-angle-up"></i></a>
</div>

    </div> <!-- end content wrapper -->
</div> <!-- end main wrapper -->

<!-- jQuery Scripts -->
<script type="text/javascript" src="/public/index/js/jquery.min.js"></script>
<script type="text/javascript" src="/public/index/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/public/index/js/plugins.js"></script>
<!--<script type="text/javascript" src="/public/index/js/twitterFetcher_min.js"></script>-->
<script type="text/javascript" src="/public/index/js/scripts.js"></script>
<script type="text/javascript" src="/public/index/layer/layer.js"></script>
<script type="text/javascript" src="/public/index/js/mypage.js"></script>
<script>
    $(function () {
        //页面加载完毕后开始执行的事件
        $(".reply").click(function () {
            let pid=$(this).attr('pid');
            let uid=$(this).attr('uid');
            let sid=$(this).attr('sid');
            if(uid===sid){
                layer.msg('不能评论自己',{icon:2});
                return;
            }
            $(".to-replay").remove();
            $(this).parent().append("<div class=\"comment-form mt-60 to-replay\">\n" +
                "  <form id=\"my-replay\">\n" +
                '   <input type=\"hidden\" name=\"pid\" value="'+pid+'" />\n' +
                "    <input type=\"hidden\" name=\"aid\" value=\"<?php echo htmlentities($article['id']); ?>\" />\n" +
                "    <input type=\"hidden\" name=\"user_id\" value=\"<?php echo htmlentities($userId); ?>\" />\n" +
                "    <div class=\"row row-16\">\n" +
                "      <div class=\"col-md-12\">\n" +
                "        <textarea name=\"content\" placeholder=\"留下你的评论\" rows=\"8\"></textarea>\n" +
                "      </div>\n" +
                "    </div>\n" +
                "  </form>\n" +
                "  <input\n" +
                "    type=\"button\"\n" +
                "    class=\"btn btn-lg btn-color mt-20\"\n" +
                "    value=\"发表\"\n" +
                "    id=\"submit-message\"\n" +
                "    onclick=\"repaly()\"\n" +
                "  />\n" +
                "</div>");
        });
    });

    //评论
    function save(){
        var content=$.trim($('textarea[name="content"]').val());
        var uid=$('input[name="user_id"]').val();
        if(uid===''){
            layer.open({
                type: 2,
                content:"<?php echo url('admin/index/index'); ?>",
                area:['40%','80%'],
                btn:['回到当前页面？'],
                anim: 5,
                maxmin: true,
                end:function(index,layero){
                    location.reload();
                }
            })
            return;
        }
        if(content===''){
            layer.msg('请输入内容', {icon: 2});
            return;
        }
        $.post("<?php echo url('single/add'); ?>", $('#my-comment').serialize(), function (res) {
            if(res.code>0){
                layer.msg(res.msg,{icon:2});
            }else {
                layer.msg(res.msg);
                setTimeout(function (){window.location.reload();},1000);
            }
        }, 'json');
    }
    //回复
    function repaly(){
        var content=$.trim($('textarea[name="content"]').val());
        var uid=$('input[name="user_id"]').val();
        if(uid===''){
            layer.open({
                type: 2,
                content:"<?php echo url('admin/index/index'); ?>",
                area:['40%','80%'],
                btn:['回到当前页面？'],
                anim: 5,
                maxmin: true,
                end:function(index,layero){
                    location.reload();
                }
            })
            return;
        }
        if(content===''){
            layer.msg('请输入内容', {icon: 2});
            return;
        }
        $.post("<?php echo url('single/add'); ?>", $('#my-replay').serialize(), function (res) {
            if(res.code>0){
                layer.msg(res.msg,{icon:2});
            }else {
                layer.msg(res.msg);
                setTimeout(function (){window.location.reload();},1000);
            }
        }, 'json');
    }
</script>
<!-- Instafeed -->
<!-- <script type="text/javascript">
  $(window).load(function() {

    var InstafeedRow = new Instafeed({
        target: 'instafeed-row',
        get: 'user',
        userId: '3562688430',
        accessToken: '3562688430.ceddd6d.c54fa5142fa847f89827e5cf9b19d885',
        resolution: 'low_resolution',
        limit: '6',
        template: '<li class="instagram-item"><a target="_blank" href="{{link}}"><img class="instagram-img" alt="Instagram Image" src="{{image}}"></a></li>'
    });

    var InstafeedGrid = new Instafeed({
        target: 'instafeed-grid',
        get: 'user',
        userId: '3562688430',
        accessToken: '3562688430.ceddd6d.c54fa5142fa847f89827e5cf9b19d885',
        resolution: 'low_resolution',
        limit: '9',
        template: '<li class="instagram-item"><a target="_blank" href="{{link}}"><img class="instagram-img" alt="Instagram Image" src="{{image}}"></a></li>'
    });

    InstafeedRow.run();
    InstafeedGrid.run();

  });
</script> -->


</body>
</html>