<?php /*a:4:{s:56:"D:\phpEnv\www\www.ytv.com\app\index\view\blog\index.html";i:1618078389;s:59:"D:\phpEnv\www\www.ytv.com\app\index\view\public\header.html";i:1618048011;s:60:"D:\phpEnv\www\www.ytv.com\app\index\view\public\righter.html";i:1618038596;s:59:"D:\phpEnv\www\www.ytv.com\app\index\view\public\footer.html";i:1618031178;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo htmlentities($homePage['title']); ?></title>

    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="">

    <!-- Google Fonts -->
    <!-- <link href='http://fonts.googleapis.com/css?family=Raleway:300,400%7COpen+Sans:400,400i,700%7CLibre+Baskerville:400i' rel='stylesheet'> -->

    <!-- Css -->
    <link rel="stylesheet" href="/public/index/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/public/index/css/font-icons.css" />
    <link rel="stylesheet" href="/public/index/css/sliders.css" />
    <link rel="stylesheet" href="/public/index/css/style.css" />
    <link rel="stylesheet" href="/public/index/css/responsive.css" />
    <link rel="stylesheet" href="/public/index/css/spacings.css" />
    <link rel="stylesheet" href="/public/index/css/animate.min.css" />
    <link rel="stylesheet" type="text/css" href="/public/static/plugins/layui/css/layui.css">
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
                    <a href="index.html">
                        <img class="logo-dark" src="<?php echo htmlentities($homePage['img']); ?>" alt="logo">
                    </a>
                </div>
            </div>
        </div>
    </section>
    <div class="content-wrapper oh">

        <!-- Latest Stories -->
        <section class="section-wrap latest-stories pb-0">
            <div class="container-fluid nopadding">

                <div class="heading-row text-center mb-40">
                    <h2 class="heading uppercase small">最近发布</h2>
                </div>

                <div id="main-slider" class="flickity-slider-wrap">
                    <?php if(is_array($articleList) || $articleList instanceof \think\Collection || $articleList instanceof \think\Paginator): $i = 0; $__LIST__ = $articleList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?>
                    <div class="gallery-cell">
                        <article>
                            <a href="<?php echo url('single/index',['id'=>$value['id']]); ?>" class="entry-img">
                                <img src="<?php echo htmlentities($value['img']); ?>" width="200px" height="150px">
                                <span class="entry-category"><?php echo htmlentities($value['name']); ?></span>
                            </a>
                            <div class="entry text-center">
                                <h4 class="entry-title uppercase"><a href="<?php echo url('single/index',['id'=>$value['id']]); ?>"><?php echo htmlentities($value['title']); ?></a></h4>
                                <span class="entry-date"><?php echo htmlentities(date('Y-m-d',!is_numeric($value['add_time'])? strtotime($value['add_time']) : $value['add_time'])); ?></span>
                            </div>
                        </article>
                    </div>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
            </div>
        </section> <!-- end latest stories -->
        <!-- Content -->
        <section class="content blog-standard">
            <div class="container relative">
                <div class="row">
                    <!-- post content -->
                    <div class="col-md-9 post-content mb-50">
                        <!-- grid posts -->
                        <div class="row items-grid">
                            <?php if(is_array($articleList) || $articleList instanceof \think\Collection || $articleList instanceof \think\Paginator): $i = 0; $__LIST__ = $articleList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?>
                            <div class="col-sm-6">
                                <article class="entry-item">
                                    <div class="entry-img">
                                        <a href="<?php echo url('single/index',['id'=>$value['id']]); ?>">
                                            <img src="<?php echo htmlentities($value['img']); ?>">
                                        </a>
                                    </div>
                                    <div class="entry-header">
                                        <a href="<?php echo url('category/index',['cid'=>$value['cate_id']]); ?>" class="entry-category"><?php echo htmlentities($value['name']); ?></a>
                                        <h2 class="entry-title">
                                            <a href="<?php echo url('single/index',['id'=>$value['id']]); ?>"><?php echo htmlentities($value['title']); ?></a>
                                        </h2>
                                    </div>
                                    <div class="entry-wrap">
                                        <div class="entry">
                                            <div class="entry-content">
                                                <?php echo subtext(htmlspecialchars_decode($value['content']),300); ?>
                                            </div>
                                            <div class="entry-meta-wrap clearfix">
                                                <ul class="entry-meta">
                                                    <li class="entry-date">
                                                        <a href="#"><?php echo htmlentities(date('Y-m-d',!is_numeric($value['add_time'])? strtotime($value['add_time']) : $value['add_time'])); ?></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            </div>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </div> <!-- end grid posts -->
                        <div class="text-center">
                            <?php echo $articleList; ?>
                        </div>
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