<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:64:"D:\phpStudy\WWW\iwebsite/application/admin\view\login\index.html";i:1551268555;s:65:"D:\phpStudy\WWW\iwebsite\application\admin\view\_header_base.html";i:1551329464;}*/ ?>
<!DOCTYPE html>
<html lang="zh-cn">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php if(!empty($copyright) && !empty($copyright['title'])): ?><?php echo $copyright['title']; else: ?>网站后台管理系统CMS<?php endif; ?></title>
        <link rel="shortcut icon" href="/public/static/images/favicon.ico" />
        <link href="/public/static/css/bootstrap.min.css" rel="stylesheet">
        <link href="/public/static/css/font-awesome.min.css" rel="stylesheet">
        <link href="/public/static/css/animate.css" rel="stylesheet">
        <link href="/public/static/css/v3.css" rel="stylesheet">
        <link href="/public/static/css/common_v3.css" rel="stylesheet">
        <link href="/public/static/fonts/v3/iconfont.css" rel="stylesheet" type="text/css" >
        <link href="/public/static/fonts/iconfont.css" rel="stylesheet" type="text/css" >
        <script src="/public/static/fonts/v3/iconfont.js"></script>
        <script src="/public/static/js/lib/jquery-1.11.1.min.js"></script>
        <script src="/public/static/js/dist/jquery/jquery.gcjs.js"></script>
        <script src="/public/static/js/app/util.js"></script>

        <link href="/public/static/css/we7.common.css" rel="stylesheet">
        <!-- <link href="/public/static/css/we7.common169.css?v=1.0.0" rel="stylesheet"> -->
        <script type="text/javascript" src="/public/static/js/lib/bootstrap.min.js"></script>
        <script type="text/javascript" src="/public/static/js/app/common.min.js?v=20170802"></script>
        <script type="text/javascript">if(util){util.clip = function(){}}</script>
        <script src="/public/static/js/require.js"></script>
        <script src="/public/static/js/config1.0.js"></script>
        <script>
            require.config({
                waitSeconds: 0
            });
        </script>
        <script src="/public/static/js/myconfig.js"></script>
        <script type="text/javascript">
            if (navigator.appName == 'Microsoft Internet Explorer') {
                if (navigator.userAgent.indexOf("MSIE 5.0") > 0 || navigator.userAgent.indexOf("MSIE 6.0") > 0 || navigator.userAgent.indexOf("MSIE 7.0") > 0) {
                    alert('您使用的 IE 浏览器版本过低, 推荐使用 Chrome 浏览器或 IE8 及以上版本浏览器.');
                }
            }
            myrequire.path = "./public/js/";

            function preview_html(txt)
            {
                var win = window.open("", "win", "width=300,height=600");  
                win.document.open("text/html", "replace");
                win.document.write($(txt).val());
                win.document.close();
            }
        </script>
    </head>
    <body>

<style type="text/css">
    body {
        background: #fff;
    }
    .page-header {
        height: 90px;
        margin: 0;
        padding: 0;
        border-bottom: 1px solid #e5e5e5;
    }
    .page-header:before {
        display: none;
    }
    .page-header .inner {
        height: 90px;
        width: 1080px;
        margin: auto;
    }
    .page-header .inner .logo {
        height: 90px;
        width: auto;
        vertical-align: middle;
    }
    .page-header .inner .logo img {
        max-height: 68px;
        height:68px;
        width: 200px;
        margin-top: 11px;
        vertical-align: middle;
    }

    .page-content {
        display: block;
        float: none;
        width: 1080px;
        margin: auto;
        padding: 72px 0;
        display: -webkit-box;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        border-bottom: 1px solid #e5e5e5;
    }

    .signup-adv {
        -webkit-box-flex: 1;
        -webkit-flex: 1;
        -ms-flex: 1;
        flex: 1;
        padding-right: 40px;
    }
    .signup-adv img {
        max-height: 100%;
        max-width: 100%;
    }
    .signup-main{
        width: 360px;
        height: 390px;
        padding: 40px;
        border: 1px solid #e5e5e5;
    }
    .signup-main .title {
        color: #333;
        font-size: 16px;
    }
    .signup-main .title span {
        font-size: 12px;
        color: #666;
        padding-left: 4px;
    }
    .signup-main .input {
        height: 38px;
        width: 100%;
        margin-top: 20px;
    }
    .signup-main .input input {
        height: 38px;
        width: 100%;
        border: 1px solid #e5e5e5;
        outline: none;
        border-radius: 3px;
        padding: 0 10px;
        font-size: 14px;
    }
    .signup-main .input input:focus {
        border: 1px solid #44abf7;
    }
    .signup-main .button {
        height: 38px;
        width: 100%;
        margin-top: 14px;
    }
    .signup-main .button input {
        height: 38px;
        width: 100%;
        background: #44abf7;
        border: 0;
        border-radius: 3px;
        color: #fff;
        font-size: 16px;
        outline: none;
    }
    .signup-main .button input:active {
        background: #33a4f7;
    }
    .signup-main .option {
        height: 40px;
        line-height: 40px;
        text-align: right;
        margin-bottom: 5px;
    }
    .signup-main .option span {
        cursor: pointer;
    }
    .signup-main .option span:hover {
        border-bottom: 1px solid #666;
    }
    .signup-main .text {
        border-top: 1px solid #e5e5e5;
        width: 100%;
        padding: 10px 0;
    }
    .signup-main .text p.title {
        font-size: 14px;
        color: #444;
    }
    .signup-main .text p {
        font-size: 12px;
        margin-bottom: 8px;
        color: #999;
    }
</style>
<body>

<div class="page-header">
    <div class="inner">
        <div class="logo">
            <?php if(!empty($iwebsiteset['logo'])): ?>
                <img src="<?php echo $iwebsiteset['logo']; ?>"/>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="page-content">
    <div class="signup-adv">
        <img src="<?php if(empty($iwebsiteset['img'])): ?>/public/static/images/copyright.png<?php else: ?><?php echo $iwebsiteset['img']; endif; ?>" style="width: 100%;height: 100%; object-fit: fill;" />
    </div>
    <div class="signup-main">
        <div class="title"><?php echo isset($iwebsiteset['name']) ? $iwebsiteset['name'] : ''; ?> 管理員<span>登录到后台管理系统</span></div>
        <div class="input"><input type="text" name="username" placeholder="请输入登录账号" /></div>
        <div class="input"><input type="password" name="password" placeholder="请输入登录密码" /></div>
        <div class="button"><input type="submit" value="登录" id="btn-login" /></div>
        <div class="option"><span class="foget">忘记密码</span> </div>
        <div class="text">
            <p class="title">温馨提示</p>
            <p>请使用管理员分配的账号密码进行登录，有问题请联系系统管理员。</p>
        </div>
    </div>
</div>


<script language='javascript'>
    $(".foget").click(function () {
        tip.alert("忘记密码请联系系统管理员");
    });
    $(".signup-main .input input").keydown(function (e) {
        if(e.keyCode==13){
            var name = $(this).attr('name');
            var value = $.trim($(this).val());
            if(name=='username' && value!=''){
                $("input[name='password']").focus();
            }
            if(name=='password' && value!=''){
                $('#btn-login').click();
            }
        }
    });
    $('#btn-login').click(function () {
        if ($(":input[name=username]").isEmpty()) {
            tip.msgbox.err('请输入登录账号');
            $(":input[name=username]").focus();
            return;
        }
        if ($(":input[name=password]").isEmpty()) {
            tip.msgbox.err('请输入登录密码');
            $(":input[name=password]").focus();
            return;
        }
        if ($(this).attr('stop')) {
            return;
        }
        $('#btn-login').attr('stop', 1).val('正在登录...');
        $.ajax({
            url: "<?php echo url('admin/login/checklogin'); ?>",
            type: 'post',
            data: {username: $(":input[name=username]").val(), password: $(":input[name=password]").val()},
            dataType: 'json',
            cache: false,
            success: function (ret) {
                if (ret.status == 1) {
                    tip.msgbox.suc("登录成功");
                    $('#btn-login').attr('stop', 1).val('跳转中...');
                    setTimeout(function () {
                        location.href = ret.result.url;
                    }, 500);
                    return;
                }
                $('#btn-login').removeAttr('stop').val('登录');
                $(":input[name=password]").select();
                tip.msgbox.err(ret.result.message);
            }
        })
    })
</script>
<script language="javascript">myrequire(['web/init'],function(){});</script>
<?php if(!empty($copyright) && !empty($copyright['copyright'])): ?>
<div class="signup-footer" style='width:750px;margin:auto;margin-top:10px;'>
    <div><?php echo $copyright['copyright']; ?></div>
</div>
<?php else: ?>
<div class="signup-footer" style='width:750px;margin:auto;margin-top:10px;'>
    <div>SUL1SS.copyright 2019</div>
</div>
<?php endif; ?>
</body>
</html>