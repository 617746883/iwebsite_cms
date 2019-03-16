<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:41:"./template/pc/default/tpl_list\about.html";i:1551766060;s:60:"D:\phpStudy\WWW\iwebsite\template\pc\default\_head_base.html";i:1551762885;s:57:"D:\phpStudy\WWW\iwebsite\template\pc\default\_header.html";i:1551763778;s:57:"D:\phpStudy\WWW\iwebsite\template\pc\default\_footer.html";i:1551769889;}*/ ?>
<!DOCTYPE html>

<html lang="en" class="no-js">
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8"/>
    <title><?php if(!empty($nav)): ?><?php echo $nav['name']; ?>_<?php endif; ?><?php echo $iwebsite['iwebsite']['name']; ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>

    <!-- GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Hind:300,400,500,600,700" rel="stylesheet" type="text/css">
    <link href="/template/pc/default/static/vendor/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
    <link href="/template/pc/default/static/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>

    <!-- PAGE LEVEL PLUGIN STYLES -->
    <link href="/template/pc/default/static/css/animate.css" rel="stylesheet">
    <link href="/template/pc/default/static/vendor/swiper/css/swiper.min.css" rel="stylesheet" type="text/css"/>

    <!-- THEME STYLES -->
    <link href="/template/pc/default/static/css/layout.min.css" rel="stylesheet" type="text/css"/>

    <!-- Favicon -->
    <link rel="shortcut icon" href="/template/pc/default/static/img/favicon.ico"/>
</head>
<body>
<header class="header navbar-fixed-top">
    <!-- Navbar -->
    <nav class="navbar" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="menu-container">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="toggle-icon"></span>
                </button>

                <!-- Logo -->
                <div class="logo">
                    <a class="logo-wrap" href="index.html">
                        <img class="logo-img logo-img-main" src="<?php echo $iwebsite['iwebsite']['logo']; ?>" onerror="this.src='/template/pc/default/static/img/logo.png'" alt="Asentus Logo">
                    </a>
                </div>
                <!-- End Logo -->
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse nav-collapse">
                <div class="menu-container">
                    <ul class="navbar-nav navbar-nav-right">
                        <li class="nav-item"><a class="nav-item-child nav-item-hover active" href="<?php echo url('/'); ?>">首页</a></li>
                        <?php $think_table = "column";$think_where = "parentid = 0 and level = 1 and status = 1";$think_order = "";$think_limit = "5";$think_db_info = db($think_table)->where($think_where)->order($think_order)->paginate($think_limit);$think_page = $think_db_info->render(); if(is_array($think_db_info) || $think_db_info instanceof \think\Collection || $think_db_info instanceof \think\Paginator): $i = 0; $__LIST__ = $think_db_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                        <li class="nav-item"><a class="nav-item-child nav-item-hover" href="<?php echo url('/column/'.$v['id']); ?>"><?php echo $v['name']; ?></a></li>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </div>
            </div>
            <!-- End Navbar Collapse -->
        </div>
    </nav>
    <!-- Navbar -->
</header>
        <!--========== END HEADER ==========-->

        <!--========== PARALLAX ==========-->
        <div class="parallax-window" data-parallax="scroll" data-image-src="/template/pc/default/static/img/1920x1080/01.jpg">
            <div class="parallax-content container">
                <h1 class="carousel-title"><?php echo $nav['name']; ?></h1>
                <p><?php echo $nav['description']; ?></p>
            </div>
        </div>
        <!--========== PARALLAX ==========-->

        <!--========== PAGE LAYOUT ==========-->
        <!-- Features -->
        <?php if(!empty($navlist)): ?>
        <div class="section-seperator">
            <div class="content-lg container">
                <div class="row">
                    <?php if(is_array($navlist) || $navlist instanceof \think\Collection || $navlist instanceof \think\Paginator): if( count($navlist)==0 ) : echo "" ;else: foreach($navlist as $key=>$vo): ?>
                    <div class="col-sm-4 sm-margin-b-50">
                        <div class="wow fadeInLeft" data-wow-duration=".3" data-wow-delay=".3s">
                            <h3><?php echo $vo['name']; ?></h3>
                            <p><?php echo $vo['description']; ?></p>
                            <a class="link" href="<?php echo $vo['url']; ?>">Read More</a>
                        </div>
                    </div>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
                <!--// end row -->
            </div>
        </div>
        <?php endif; ?>
        <!-- End Features -->

        <!-- About -->
        <div class="content-lg container">
            <div class="row margin-b-20">
                <div class="col-sm-6">
                    <h2><?php echo $nav['name']; ?></h2>
                </div>
            </div>
            <!--// end row -->

            <div class="row">
                <?php echo $find['body']; ?>
            </div>
            <!--// end row -->
        </div>
        <!-- End About -->
        <!-- End Service -->
        <!--========== END PAGE LAYOUT ==========-->

<!--========== FOOTER ==========-->
        <footer class="footer">
            <!-- Links -->
            <div class="footer-seperator">
                <div class="content-lg container">
                    <div class="row">
                        <div class="col-sm-2 sm-margin-b-50">
                            <!-- List -->
                            <ul class="list-unstyled footer-list">
                                <li class="footer-list-item"><a class="footer-list-link" href="<?php echo url('/'); ?>">首页</a></li>
                                <?php $think_table = "column";$think_where = "parentid = 0 and level = 1 and status = 1";$think_order = "sort desc";$think_limit = "5";$think_db_info = db($think_table)->where($think_where)->order($think_order)->paginate($think_limit);$think_page = $think_db_info->render(); if(is_array($think_db_info) || $think_db_info instanceof \think\Collection || $think_db_info instanceof \think\Paginator): $i = 0; $__LIST__ = $think_db_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                                <li class="footer-list-item"><a class="footer-list-link" href="<?php echo url('/column/'.$v['id']); ?>"><?php echo $v['name']; ?></a></li>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </ul>
                            <!-- End List -->
                        </div>
                        <div class="col-sm-4 sm-margin-b-30">
                            <!-- List -->
                            <ul class="list-unstyled footer-list">
                                <?php $think_table = "link";$think_where = "status = 1";$think_order = "sort desc";$think_limit = "5";$think_db_info = db($think_table)->where($think_where)->order($think_order)->paginate($think_limit);$think_page = $think_db_info->render(); if(is_array($think_db_info) || $think_db_info instanceof \think\Collection || $think_db_info instanceof \think\Paginator): $i = 0; $__LIST__ = $think_db_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                                <li class="footer-list-item"><a class="footer-list-link" href="<?php echo $v['url']; ?>"><?php echo $v['name']; ?></a></li>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </ul>
                            <!-- End List -->
                        </div>
                        <div class="col-sm-5 sm-margin-b-30">
                            <form action="<?php echo url('/home/feedback/index'); ?>" method="post">
                            <h2 class="color-white">Send Us A Note</h2>
                            <input type="text" class="form-control footer-input margin-b-20" name="title" placeholder="title" required>
                            <input type="text" class="form-control footer-input margin-b-20" name="name" placeholder="name" required>
                            <input type="text" class="form-control footer-input margin-b-20" name="call" placeholder="Phone" required>
                            <textarea class="form-control footer-input margin-b-30" rows="6" name="content" placeholder="content" required></textarea>
                            <button type="submit" class="btn-theme btn-theme-sm btn-base-bg text-uppercase">Submit</button>
                            </form>
                        </div>
                    </div>
                    <!--// end row -->
                </div>
            </div>
            <!-- End Links -->

            <!-- Copyright -->
            <div class="content container">
                <div class="row">
                    <div class="col-xs-6">
                        <img class="footer-logo" src="/template/pc/default/static/img/logo.png" alt="Asentus Logo">
                    </div>
                    <div class="col-xs-6 text-right">
                        <p class="margin-b-0"><?php echo $copyright['copyright']; ?></p>
                    </div>
                </div>
                <!--// end row -->
            </div>
            <!-- End Copyright -->
        </footer>
        <!--========== END FOOTER ==========-->

        <!-- Back To Top -->
        <a href="javascript:void(0);" class="js-back-to-top back-to-top">Top</a>

<!-- JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- CORE PLUGINS -->
<script src="/template/pc/default/static/vendor/jquery.min.js" type="text/javascript"></script>
<script src="/template/pc/default/static/vendor/jquery-migrate.min.js" type="text/javascript"></script>
<script src="/template/pc/default/static/vendor/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

<!-- PAGE LEVEL PLUGINS -->
<script src="/template/pc/default/static/vendor/jquery.easing.js" type="text/javascript"></script>
<script src="/template/pc/default/static/vendor/jquery.back-to-top.js" type="text/javascript"></script>
<script src="/template/pc/default/static/vendor/jquery.smooth-scroll.js" type="text/javascript"></script>
<script src="/template/pc/default/static/vendor/jquery.wow.min.js" type="text/javascript"></script>
<script src="/template/pc/default/static/vendor/swiper/js/swiper.jquery.min.js" type="text/javascript"></script>
<script src="/template/pc/default/static/vendor/masonry/jquery.masonry.pkgd.min.js" type="text/javascript"></script>
<script src="/template/pc/default/static/vendor/masonry/imagesloaded.pkgd.min.js" type="text/javascript"></script>

<!-- PAGE LEVEL SCRIPTS -->
<script src="/template/pc/default/static/js/layout.min.js" type="text/javascript"></script>
<script src="/template/pc/default/static/js/components/wow.min.js" type="text/javascript"></script>
<script src="/template/pc/default/static/js/components/swiper.min.js" type="text/javascript"></script>
<script src="/template/pc/default/static/js/components/masonry.min.js" type="text/javascript"></script>
<script>
    $(function(){
        $('button[type=submit]').click(function(){
            if ($('input[name=title]').val() == '') {
                alert('标题不能为空');
                return false;
            }
            if ($('input[name=name]').val() == '') {
                alert('姓名不能为空');
                return false;
            }
            if ($('input[name=call]').val() == '') {
                alert('联系方式不能为空');
                return false;
            }
            if ($('input[name=content]').val() == '') {
                alert('内容不能为空');
                return false;
            }
        });
    })
</script>
    </body>
    <!-- END BODY -->
</html>