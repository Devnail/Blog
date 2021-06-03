<?php /*a:3:{s:57:"D:\phpEnv\www\www.ytv.com\app\index\view\about\index.html";i:1617725683;s:59:"D:\phpEnv\www\www.ytv.com\app\index\view\public\header.html";i:1618048011;s:59:"D:\phpEnv\www\www.ytv.com\app\index\view\public\footer.html";i:1618031178;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo htmlentities($aboutData['title']); ?></title>

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
                        <img class="logo-dark" src="<?php echo htmlentities($aboutData['img']); ?>" alt="logo">
                    </a>
                </div>
            </div>
        </div>
    </section>
    <div class="content-wrapper oh">

        <!-- Content -->
        <section class="section-wrap about-me pt-mdm-60">
            <div class="container relative">
                <div class="text-center">
                    <h1 class="heading underline-title uppercase"><?php echo htmlentities($aboutData['title']); ?></h1>
                </div>
                <div class="row row-35">
                    <div class="col-sm-12 text-center">
                        <?php echo htmlspecialchars_decode($aboutData['content']); ?>
                    </div>

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

    InstafeedRow.run();

  });
</script> -->


</body>
</html>