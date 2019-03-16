<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:74:"D:\phpStudy\WWW\iwebsite/application/admin\view\extend\feedback\index.html";i:1551680309;s:60:"D:\phpStudy\WWW\iwebsite\application\admin\view\_header.html";i:1551669067;s:65:"D:\phpStudy\WWW\iwebsite\application\admin\view\_header_base.html";i:1551329464;s:58:"D:\phpStudy\WWW\iwebsite\application\admin\view\_tabs.html";i:1551318954;s:60:"D:\phpStudy\WWW\iwebsite\application\admin\view\_footer.html";i:1545213457;}*/ ?>
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
<style>
    .popover{
        width:170px;
        font-size:12px;
        line-height: 21px;
        color: #0d0706;
    }
    .popover span{
        color: #b9b9b9;
    }
    .nickname{
        display: inline-block;
        max-width:200px;
        overflow: hidden;
        text-overflow:ellipsis;
        white-space: nowrap;
        vertical-align: middle;
    }

    .tooltip-inner{
        border:none;
    }
</style>
<div class="page-header">
    <span>当前位置：<span class="text-primary">留言反馈</span></span>
</div>
<div class="page-content">
   <form action="" method="get" class="form-horizontal" role="form">
        <div class="page-toolbar">
            <div class="col-sm-6">
            </div>			 
            <div class="col-sm-6 pull-right">		 		 
    			<div class="input-group">
                        <div class="input-group-select">
                            <select name="status" class='form-control'>
                                <option value="" <?php if($status == ''): ?> selected<?php endif; ?>>状态</option>
                                <option value="1" <?php if($status== '1'): ?> selected<?php endif; ?>>已处理</option>
                                <option value="0" <?php if($status == '0'): ?> selected<?php endif; ?>>未处理</option>
                            </select>
                        </div>
                        <input type="text" class="input-sm form-control" name='keyword' value="<?php echo $keyword; ?>" placeholder="请输入关键词"> <span class="input-group-btn">

                     <button class="btn btn-primary" type="submit"> 搜索</button> </span>
                </div>
            </div>
        </div>
  </form>
 <?php if(count($list)>0): ?>
        <div class="page-table-header">
            <input type='checkbox' />
            <div class="btn-group">
                <button class="btn btn-default btn-sm btn-operation" type="button" data-toggle='batch' data-href="<?php echo url('admin/extend/feedbackstatus',array('status'=>1)); ?>">
                    <i class='icow icow-qiyong'></i> 已处理</button>
                <button class="btn btn-default btn-sm btn-operation" type="button" data-toggle='batch'  data-href="<?php echo url('admin/extend/feedbackstatus',array('status'=>0)); ?>">
                    <i class='icow icow-jinyong'></i> 未处理</button>
                <button class="btn btn-default btn-sm btn-operation" type="button" data-toggle='batch-remove' data-confirm="确认要删除?" data-href="<?php echo url('admin/extend/feedbackdelete'); ?>">
                    <i class='icow icow-shanchu1'></i> 删除</button>
            </div>
        </div>
        <table class="table table-hover  table-responsive">
            <thead>
                <tr>
                    <th style="width:25px;"></th>
                    <th style="width:250px;">标题</th>
                    <th style="width:100px;">姓名</th>
                    <th style="width:100px;">联系方式</th>
                    <th style="width:100px;">时间</th>
                    <th>留言</th>
                    <th style="width:85px;">状态</th>
                    <th style="width: 75px;">操作</th>
                </tr>
            </thead>
            <tbody>
                <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): if( count($list)==0 ) : echo "" ;else: foreach($list as $key=>$row): ?>
                <tr  data-toggle='popover' data-html='true' data-placement='top' data-trigger='hover' data-content='<?php echo $row['desc']; ?>'>
                    <td><input type='checkbox' value="<?php echo $row['id']; ?>"/></td>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['call']; ?></td>
                    <td><?php echo date('Y-m-d H:i',$row['createtime']); ?></td>
                    <td><?php echo $row['content']; ?></td>                            
                     <td>
                       <span class='label <?php if($row['status']==1): ?>label-primary<?php else: ?>label-danger<?php endif; ?>'
							  data-toggle='ajaxSwitch' 
							  data-switch-value='<?php echo $row['status']; ?>'
							  data-switch-value0='0|已处理|label label-danger|<?php echo url('admin/extend/feedbackstatus',array('status'=>1,'id'=>$row['id'])); ?>'  
							  data-switch-value1='1|未处理|label label-success|<?php echo url('admin/extend/feedbackstatus',array('status'=>0,'id'=>$row['id'])); ?>'  
							>
							<?php if($row['status']==1): ?>已处理<?php else: ?>未处理<?php endif; ?></span>
                    </td>
                    <td>
                        <a class='btn btn-default  btn-sm btn-operation btn-op' data-toggle="ajaxRemove"  href="<?php echo url('admin/extend/feedbackdelete', array('id' => $row['id'])); ?>" data-confirm="确认删除此权限吗？">
                          <span data-toggle="tooltip" data-placement="top" title="" data-original-title="删除">
                                    <i class='icow icow-shanchu1'></i>
                               </span>
                        </a>
                    </td>
                </tr>
                <?php endforeach; endif; else: echo "" ;endif; ?>               
            </tbody>
            <tfoot>
                <tr>
                    <td><input type="checkbox"></td>
                    <td>
                        <div class="input-group-btn">
                            <button class="btn btn-default btn-sm btn-operation" type="button" data-toggle='batch' data-href="<?php echo url('admin/extend/feedbackstatus',array('status'=>1)); ?>">
                                <i class='icow icow-qiyong'></i> 已处理</button>
                            <button class="btn btn-default btn-sm btn-operation" type="button" data-toggle='batch'  data-href="<?php echo url('admin/extend/feedbackstatus',array('status'=>0)); ?>">
                                <i class='icow icow-jinyong'></i> 未处理</button>
                            <button class="btn btn-default btn-sm btn-operation" type="button" data-toggle='batch-remove' data-confirm="确认要删除?" data-href="<?php echo url('admin/extend/feedbackdelete'); ?>">
                                <i class='icow icow-shanchu1'></i> 删除</button>
                        </div>
                    </td>
                    <td colspan="3" class="text-right"> <?php echo $pager; ?></td>
                </tr>
            </tfoot>
        </table>
    <?php else: ?>
<div class='panel panel-default'>
	<div class='panel-body' style='text-align: center;padding:30px;'>
		 暂时没有任何留言反馈!
	</div>
</div>
<?php endif; ?>
       </form>
</div>

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