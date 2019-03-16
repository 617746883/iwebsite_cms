<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:64:"D:\phpStudy\WWW\iwebsite/application/admin\view\column\post.html";i:1551750489;s:60:"D:\phpStudy\WWW\iwebsite\application\admin\view\_header.html";i:1551669067;s:65:"D:\phpStudy\WWW\iwebsite\application\admin\view\_header_base.html";i:1551329464;s:58:"D:\phpStudy\WWW\iwebsite\application\admin\view\_tabs.html";i:1551318954;s:60:"D:\phpStudy\WWW\iwebsite\application\admin\view\_footer.html";i:1545213457;}*/ ?>
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
<div class="page-header">
	当前位置：
	<span class="text-primary">
		<?php if(!empty($item['id'])): ?>编辑<?php else: ?>添加<?php endif; ?>栏目 <small><?php if(!empty($item['id'])): ?>修改【<?php echo $item['name']; ?>】<?php endif; ?></small>
	</span>
</div>
<div class="page-content">
	<div class="page-sub-toolbar">
		<span class=''>
			<a class="btn btn-primary btn-sm" href="<?php echo url('admin/column/add'); ?>">添加新栏目</a>
		</span>
	</div>
<form action="" method="post" class="form-horizontal form-validate" enctype="multipart/form-data" >
	<?php if(!empty($parentid)): ?>
	<div class="form-group">
		<label class="col-sm-2 control-label">上级栏目</label>
		<div class="col-sm-9 col-xs-12 control-label" style="text-align:left;">
			<?php if(!empty($parent1)): ?><?php echo $parent1['name']; ?> >> <?php endif; ?>
			<?php echo $parent['name']; ?></div>
	</div>
	<?php endif; ?>
	<div class="form-group">
		<label class="col-sm-2 control-label">排序</label>
		<div class="col-sm-9 col-xs-12">
			<input type="text" name="sort" class="form-control" value="<?php echo $item['sort']; ?>" />
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label must">栏目名称</label>
		<div class="col-sm-9 col-xs-12">
			<input type="text" name="name" class="form-control" value="<?php echo $item['name']; ?>" data-rule-required='true' />
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">列表页</label>
		<div class="col-sm-9 col-xs-12">
			<select class="form-control select2" name="list_type" data-rule-required='true'>
	            <option value="">请选择列表页</option>
	            <?php if(is_array($list_types) || $list_types instanceof \think\Collection || $list_types instanceof \think\Paginator): if( count($list_types)==0 ) : echo "" ;else: foreach($list_types as $key=>$list_type): ?>
	                <option value="<?php echo $list_type; ?>" <?php if($item['list_type']==$list_type): ?> selected="selected"<?php endif; ?>><?php echo $list_type; ?></option>
	            <?php endforeach; endif; else: echo "" ;endif; ?>
	        </select>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">内容页</label>
		<div class="col-sm-9 col-xs-12">
			<select class="form-control select2" name="content_type" data-rule-required='true'>
	            <option value="">请选择内容页</option>
	            <?php if(is_array($content_types) || $content_types instanceof \think\Collection || $content_types instanceof \think\Paginator): if( count($content_types)==0 ) : echo "" ;else: foreach($content_types as $key=>$content_type): ?>
	                <option value="<?php echo $content_type; ?>" <?php if($item['content_type']==$content_type): ?> selected="selected"<?php endif; ?>><?php echo $content_type; ?></option>
	            <?php endforeach; endif; else: echo "" ;endif; ?>
	        </select>
		</div>
	</div>
	<div class="form-group">
		<label for="sort" class="col-sm-2 control-label">分页数据</label>
		<div class="col-sm-2">
			<input type="number" name="page_number" value="<?php echo $item['page_number']; ?>" class="form-control">
		</div>
	</div>
	<?php if(empty($parentid)): ?>
	<div class="form-group">
		<label class="col-sm-2 control-label">栏目图标</label>
		<div class="col-sm-9 col-xs-12">
			<?php echo tpl_form_field_image2('thumb', $item['thumb']); ?>
			<span class="help-block">建议尺寸: 100*100，或正方型图片 </span>
		</div>
	</div>
	<?php endif; ?>
	<div class="form-group">
	    <label class="col-sm-2 control-label">栏目外链类型</label>
	    <div class="col-sm-9 col-xs-12">
	        <label class="radio-inline"><input type="radio" name="outlink_state" value="0" <?php if($item['outlink_state'] == '0'): ?> checked <?php endif; ?>/> 无</label>
	        <label class="radio-inline"><input type="radio" name="outlink_state" value="1" <?php if($item['outlink_state'] == '1'): ?> checked <?php endif; ?>/> 栏目/内容</label>
	        <label class="radio-inline"><input type="radio" name="outlink_state" value="2" <?php if($item['outlink_state'] == '2'): ?> checked <?php endif; ?>/> 外链</label>
	    </div>
	</div>
	<div class="form-group choose choose_1" <?php if($item['outlink_state'] == '1'): ?> style='display: block;' <?php else: ?> style='display: none;' <?php endif; ?>>
	    <label class="col-sm-2 control-label">栏目/内容</label>
		<div class="col-sm-9 col-xs-12">
			<div class="input-group">
				<input type="text" name="outlink1" class="form-control" value="<?php echo $item['outlink1']; ?>" id="outlink1" />
				<span data-input="#outlink1" data-toggle="selectUrl" class="input-group-addon btn btn-default">选择链接</span>
			</div>
		</div>
	</div>
	<div class="form-group choose choose_2" <?php if($item['outlink_state'] == '2'): ?> style='display: block;' <?php else: ?> style='display: none;' <?php endif; ?>>
	    <label class="col-sm-2 control-label">链接</label>
		<div class="col-sm-9 col-xs-12">
			<input type="text" name="outlink2" class="form-control" value="<?php echo $item['outlink2']; ?>" />
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">开启单页</label>
		<div class="col-sm-9 col-xs-12">
			<label class='radio-inline'>
				<input type='radio' name='page' value='1' <?php if($item['page']==1): ?>checked<?php endif; ?> /> 是
			</label>
			<label class='radio-inline'>
				<input type='radio' name='page' value='0' <?php if($item['page']==0): ?>checked<?php endif; ?> /> 否
			</label>
		</div> 
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">是否显示</label>
		<div class="col-sm-9 col-xs-12">
			<label class='radio-inline'>
				<input type='radio' name='status' value=1' <?php if($item['status']==1): ?>checked<?php endif; ?> /> 是
			</label>
			<label class='radio-inline'>
				<input type='radio' name='status' value=0' <?php if($item['status']==0): ?>checked<?php endif; ?> /> 否
			</label>
		</div>
	</div>
	<div class="choosepage choosepage_1" <?php if($item['page'] == '1'): ?> style='display: block;' <?php else: ?> style='display: none;' <?php endif; ?>>
	<div class="form-group-title">单页内容</div>
	<div class="form-group">
		<label class="col-lg control-label must">封面图</label>
		<div class="col-sm-9 col-xs-12">
			<?php echo tpl_form_field_image2('thumb', $item['thumb']); ?>
			<span class="help-block">建议尺寸: 640*300，或正方型图片 </span>
		</div>
	</div>
    <div class="form-group">
        <label class="col-lg control-label must">简介</label>
        <div class="col-sm-9 col-xs-12">
            <textarea name="description" class="form-control richtext" rows="5"><?php echo $item['description']; ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg control-label">详情</label>
        <div class="col-sm-9 col-xs-12">
            <?php echo tpl_ueditor('body',$item['body'],array('height'=>'200')); ?>
        </div>
    </div>
    </div>
	<div class="form-group">
		<label class="col-sm-2 control-label"></label>
		<div class="col-sm-9 col-xs-12">
			<input type="submit"  value="提交" class="btn btn-primary"/>
			<input type="button" name="back" onclick='history.back()' style='margin-left:10px;' value="返回列表" class="btn btn-default" />
		</div>
	</div>
</form>
</div>
<script type="text/javascript">
	$(':radio[name=outlink_state]').click(function () {
        var v = $(this).val();
        $(".choose").hide();
        $(".choose_" + v).show();
    });
    $(':radio[name=page]').click(function () {
        var v = $(this).val();
        $(".choosepage").hide();
        $(".choosepage_" + v).show();
    })
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