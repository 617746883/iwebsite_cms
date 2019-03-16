<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:65:"D:\phpStudy\WWW\iwebsite/application/admin\view\content\post.html";i:1551749089;s:60:"D:\phpStudy\WWW\iwebsite\application\admin\view\_header.html";i:1551669067;s:65:"D:\phpStudy\WWW\iwebsite\application\admin\view\_header_base.html";i:1551329464;s:58:"D:\phpStudy\WWW\iwebsite\application\admin\view\_tabs.html";i:1551318954;s:60:"D:\phpStudy\WWW\iwebsite\application\admin\view\_footer.html";i:1545213457;}*/ ?>
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

<div class="wb-header" style="position: fixed;">
    <div class="logo">
        <img class='logo-img' src="<?php echo isset($copyright['logo']) ? $copyright['logo'] : ''; ?>" onerror="this.src='/public/static/images/nologo.png'"/>
    </div>
    <ul>
        <li class="">
            <a href="<?php echo url('admin/index/index'); ?>">
                <i class="fa fa-home"></i>
                <span>首页</span>
            </a>
        </li>
        <li class="active">
            <a href="<?php echo url('/admin/sysset/index'); ?>">
                <i class="fa fa-cube"></i>
                <span>设置</span>
            </a>
        </li>
        <li class="">
            <a href="<?php echo url('/admin/system/index'); ?>">
                <i class="fa fa-laptop"></i>
                <span>系统</span>
            </a>
        </li>
        <li class="">
            <a href="<?php echo url('/admin/content/index'); ?>">
                <i class="fa fa-list"></i>
                <span>内容</span>
            </a>
        </li>
        <li class="">
            <a href="<?php echo url('/admin/column/index'); ?>">
                <i class="fa fa-th"></i>
                <span>栏目</span>
            </a>
        </li>
        <li class="">
            <a href="<?php echo url('/admin/extend/index'); ?>">
                <i class="fa fa-tags"></i>
                <span>扩展</span>
            </a>
        </li>
    </ul>
    <div class="wb-header-flex"></div>
    <ul>
        <li data-toggle="tooltip" data-placement="bottom" title="">
            <a href="<?php echo url('admin/system/index'); ?>"><i class="icow icow-syssetL"></i>系统管理</a>
        </li>
        <li class="dropdown auto ellipsis">
            <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><?php echo isset($system['right_menu']) && $system['right_menu']['menu_title']; ?><span style="position: relative;"></span></a>
            <ul class="dropdown-menu">
                <?php if(is_array($system['right_menu']['menu_items']) || $system['right_menu']['menu_items'] instanceof \think\Collection || $system['right_menu']['menu_items'] instanceof \think\Paginator): if( count($system['right_menu']['menu_items'])==0 ) : echo "" ;else: foreach($system['right_menu']['menu_items'] as $key=>$right_menu_item): if(!is_array($right_menu_item)): else: ?>
                        <li>
                            <a href="<?php echo $right_menu_item['href']; ?>" <?php if($right_menu_item['blank']): ?>target="_blank"<?php endif; ?>>
                                <i class="icow <?php echo isset($right_menu_item['icow']) ? $right_menu_item['icow'] : ''; ?> " style="font-size: 30px;"></i>
                                <span style="display: block"><?php echo $right_menu_item['text']; ?></span>
                            </a>
                        </li>
                    <?php endif; endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </li>
        <li data-toggle="tooltip" data-placement="bottom" title="退出登陆" data-href="<?php echo $system['right_menu']['logout']; ?>">
            <a class="wb-header-logout"><i class="icow icow-exit"></i></a>
        </li>
    </ul>
</div>

<!-- 一级导航 -->
<div class="wb-nav <?php if(!empty($system['foldnav'])): ?>fold<?php endif; ?>">
    <p class="wb-nav-fold"><i class="icow icow-zhedie"></i></p>
    <ul>
        <?php if(is_array($sysmenus['menu']) || $sysmenus['menu'] instanceof \think\Collection || $sysmenus['menu'] instanceof \think\Paginator): if( count($sysmenus['menu'])==0 ) : echo "" ;else: foreach($sysmenus['menu'] as $key=>$sysmenu): ?>
            <li <?php if(!empty($sysmenu['active'])): ?>class="active"<?php endif; ?>>
                <a href="<?php echo $sysmenu['url']; ?>">
                    <?php if($sysmenu['route']=='extend'): ?>
                    <svg class="iconplug" aria-hidden="true">
                        <use xlink:href="#icow-yingyong3"></use>
                    </svg>
                    <?php else: if(!empty($sysmenu['icon'])): ?>
                            <i class="icow icow-<?php echo $sysmenu['icon']; ?>" <?php if(!empty($sysmenu['iconcolor'])): ?> style="color: <?php echo $sysmenu['iconcolor']; ?>"<?php endif; ?>></i>
                        <?php endif; endif; if($sysmenu['route'] == 'sysset'): ?>
                        <span class="wb-nav-title <?php if(empty($notice_redis_click['notice_redis_click']) || !isset($notice_redis_click['notice_redis_click'])): ?>point<?php endif; ?>"><?php echo $sysmenu['text']; ?></span>
                    <?php else: ?>
                        <span class="wb-nav-title"><?php echo $sysmenu['text']; ?></span>
                    <?php endif; ?>
                </a>
                <span class="wb-nav-tip"><?php echo $sysmenu['text']; ?></span>
            </li>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>
</div>

<!-- 二级导航 -->
<?php if(!empty($no_left)): else: if(!empty($sysmenus['submenu']['items'])): ?>
    <div class="wb-subnav">
      <div style="width: 100%;height: 100%;overflow-y: auto">
          <div class="subnav-scene">
	<?php if(empty($sysmenus['submenu']['route']) && empty($sysmenus['submenu']['main'])): ?>
		<?php echo $sysmenus['submenu']['subtitle']; else: ?>
		<a href="<?php echo url($sysmenus['submenu']['route']); ?>"><?php echo $sysmenus['submenu']['subtitle']; ?></a>
	<?php endif; ?>
</div>

<?php if(!empty($sysmenus['submenu']['items'])): if(is_array($sysmenus['submenu']['items']) || $sysmenus['submenu']['items'] instanceof \think\Collection || $sysmenus['submenu']['items'] instanceof \think\Paginator): if( count($sysmenus['submenu']['items'])==0 ) : echo "" ;else: foreach($sysmenus['submenu']['items'] as $key=>$submenu): if(!empty($submenu['items'])): ?>
			<div class='menu-header <?php if(!empty($submenu['active'])): ?>active data-active<?php endif; ?>'><div class="menu-icon fa fa-caret-<?php if(!empty($submenu['active'])): ?>down<?php else: ?>right<?php endif; ?>"></div><?php echo $submenu['title']; ?></div>
			<ul <?php if(!empty($submenu['active'])): ?>style="display: block"<?php endif; ?>>
				<?php if(is_array($submenu['items']) || $submenu['items'] instanceof \think\Collection || $submenu['items'] instanceof \think\Paginator): if( count($submenu['items'])==0 ) : echo "" ;else: foreach($submenu['items'] as $key=>$threemenu): ?>
					<li <?php if(!empty($threemenu['active'])): ?>class="active"<?php endif; ?>><a href="<?php echo $threemenu['url']; ?>" style="cursor: pointer;" data-route="<?php echo $threemenu['route']; ?>"><?php echo $threemenu['title']; ?></a>
				<?php endforeach; endif; else: echo "" ;endif; ?>
			</ul>
		<?php else: ?>
			<ul class="single">
				<li <?php if(!empty($submenu['active'])): ?>class="active"<?php endif; ?> style=" position: relative"><a href="<?php echo $submenu['url']; ?>" style="cursor: pointer;" data-route="<?php echo $submenu['route']; ?>"><?php echo $submenu['title']; ?></a></li>
			</ul>
		<?php endif; endforeach; endif; else: echo "" ;endif; endif; ?>
          <div class="wb-subnav-fold icow"></div>
      </div>
    </div>
<?php endif; endif; ?>
<div class="wb-container right-panel">
<script type="text/javascript" src="/public/static/js/lib/moment.js"></script>
<link rel="stylesheet" href="/public/static/components/datetimepicker/jquery.datetimepicker.css">
<link rel="stylesheet" href="/public/static/components/daterangepicker/daterangepicker.css">
<div class="page-header">
    当前位置：<span class="text-primary"><?php if(!empty($item['id'])): ?>编辑<?php else: ?>添加<?php endif; ?>内容<?php if(!empty($item['id'])): ?>(<?php echo $item['title']; ?>)<?php endif; ?></span>
</div>

<div class="page-content">
    <div class="page-sub-toolbar">
         <span class=''>
            <a class="btn btn-primary btn-sm" href="<?php echo url('admin/content/eventsadd'); ?>">添加新内容</a>
        </span>
    </div>
    <form action="" method="post" class="form-horizontal form-validate" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $item['id']; ?>"/>
        <div class="form-group">
            <label class="col-lg control-label">排序</label>
            <div class="col-sm-9 col-xs-12">
                <input type="text" name="displayorder" class="form-control" value="<?php echo $item['displayorder']; ?>"/>
                <span class='help-block'>数字越大，排名越靠前</span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg control-label must">内容标题</label>
            <div class="col-sm-9 col-xs-12 ">
                <input type="text" id='title' name="title" class="form-control" value="<?php echo $item['title']; ?>" data-rule-required="true"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg control-label must">栏目</label>
            <div class="col-sm-9 col-xs-12">
                <select class="form-control select2" name="columnid" data-rule-required='true'>
                    <option value="">请选择内容所属栏目</option>
                    <?php if(is_array($columns) || $columns instanceof \think\Collection || $columns instanceof \think\Paginator): if( count($columns)==0 ) : echo "" ;else: foreach($columns as $key=>$column): ?>
                        <option value="<?php echo $column['id']; ?>" <?php if($item['columnid']==$column['id']): ?> selected="selected"<?php endif; ?>><?php echo $column['name']; ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg control-label">封面图片</label>
            <div class="col-sm-9 col-xs-12">
                <?php echo tpl_form_field_image2('thumb', $item['thumb']); ?>
                <span class='help-block'>建议尺寸:640 * 350 , 请将所有内容图片尺寸保持一致</span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg control-label"></label>
            <div class="col-sm-3">
                <input type="text" name="mp" class="form-control" value="<?php if(empty($item['mp'])): ?><?php echo $mp['name']; else: ?><?php echo $item['mp']; endif; ?>" placeholder="系统" bind-in="art_mp" bind-de="<?php echo $mp['name']; ?>">
            </div>
            <div class="col-sm-3">
                <input type="text" name="author" class="form-control" value="<?php echo $item['author']; ?>" placeholder="发布作者" bind-in="art_author" bind-de="编辑小美">
            </div>
            <div class="col-sm-3">
                <?php echo tpl_form_field_date('date_v', $item['date_v'],false); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg control-label">虚拟阅读数</label>
            <div class="col-sm-3">
                <input type="text" name="readnum_v" class="form-control" value="<?php echo $item['readnum_v']; ?>" placeholder="虚拟阅读数" bind-in="art_read" bind-de="0" bind-num='1'>
            </div>
            <label class="col-lg control-label">虚拟点赞数</label>
            <div class="col-sm-3">
                <input type="text" name="likenum_v" class="form-control" value="<?php echo $item['likenum_v']; ?>" placeholder="虚拟点赞数" bind-in="art_like" bind-de="0" bind-num='1'>
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg control-label">属性</label>
            <div class="col-sm-9 col-xs-12">
                <label for="isrecommand" class="checkbox-inline">
                    <input type="checkbox" name="isrecommand" value="1" id="isrecommand" <?php if($item['isrecommand'] == 1): ?>checked="true"<?php endif; ?> /> 推荐
                </label>
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg control-label">状态</label>
            <div class="col-sm-9 col-xs-12">
                <label class='radio-inline'>
                    <input type='radio' name='status' value=1' <?php if($item['status']==1): ?>checked<?php endif; ?> /> 显示
                </label>
                <label class='radio-inline'>
                    <input type='radio' name='status' value=0' <?php if($item['status']==0): ?>checked<?php endif; ?> /> 隐藏
                </label>
            </div>
        </div>
        <div class="form-group-title">内容介绍</div>
        <div class="form-group">
            <label class="col-lg control-label must">简介</label>
            <div class="col-sm-9 col-xs-12">
                <textarea name="description" class="form-control richtext" rows="5"><?php echo $item['description']; ?></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg control-label">详情</label>
            <div class="col-sm-9 col-xs-12">
                <?php echo tpl_ueditor('content',$item['content'],array('height'=>'200')); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg control-label"></label>
            <div class="col-sm-9 col-xs-12">
                <input type="submit" value="提交" class="btn btn-primary"/>
                <input type="button" name="back" onclick='history.back()' style='margin-left:10px;' value="返回列表" class="btn btn-default" />
            </div>
        </div>
    </form>
</div>

<script language='javascript'>
    function formcheck() {
        if ($("#title").isEmpty()) {
            Tip.focus("title", "请填写内容名称!");
            return false;
        }
        if ($("input[name=thumb]").isEmpty()) {
            Tip.focus("thumb", "请上传内容图片!");
            return false;
        }
        return true;
    }
</script>


    <div id="page-loading">
        <div class="page-loading-inner">
            <div class="sk-three-bounce">
                <div class="sk-child sk-bounce1"></div>
                <div class="sk-child sk-bounce2"></div>
                <div class="sk-child sk-bounce3"></div>
            </div>
        </div>
    </div>

    <?php if(!empty($copyright) && !empty($copyright['copyright'])): ?>
    <div class="wb-footer" style='width:100%;'>
        <div><?php echo $copyright['copyright']; ?></div>
    </div>
    <?php endif; ?>

</div>




<script language='javascript'>
    require(['bootstrap'], function ($) {
        $('[data-toggle="tooltip"]').tooltip("destroy").tooltip({
            container: $(document.body)
        });
        $('[data-toggle="popover"]').popover("destroy").popover({
            container: $(document.body)
        });
    });

    $(function () {
        //$('.page-content').show();
        $('.img-thumbnail').each(function () {
            if ($(this).attr('src').indexOf('nopic.jpg') != -1) {
                $(this).attr('src', "/public/static/images/nopic.jpg");
            }
        })
    });
</script>
<script language="javascript">
    myrequire(['web/init']);
    if( $('form.form-validate').length<=0){
        window.formInited = true;
    }
    window.formInitTimer = setInterval(function () {
        if (typeof(window.formInited ) !== 'undefined') {
            $('#page-loading').remove();
            clearInterval(window.formInitTimer);
        }else{
            $('#page-loading').show();
        }
    }, 1);
</script>

</body>
</html>

<!--SUL1SS-->