<?php
return [
    'template' => [
	    // 模板引擎类型 支持 php think 支持扩展
	    'type'         => 'Think',
	    // 默认模板渲染规则 1 解析为小写+下划线 2 全部转换小写
	    'auto_rule'    => 1,
	    // 模板路径
	    'view_path'    => './template/pc/default/',
	    // 模板后缀
	    'view_suffix'  => 'html',
	    // 模板文件名分隔符
	    'view_depr'    => DS,
	    // 模板引擎普通标签开始标记
	    'tpl_begin'    => '{',
	    // 模板引擎普通标签结束标记
	    'tpl_end'      => '}',
	    // 标签库标签开始标记
	    'taglib_begin' => '{',
	    // 标签库标签结束标记
	    'taglib_end'   => '}',
	    // 预先加载的标签库
        'taglib_pre_load'     =>    'app\common\Taglib\Iwebsite', 
        //模板文件名
        'default_theme'     => 'default',
	],
    'view_replace_str'  =>  [
        '__PUBLIC__'=>'/public',
        '__STATIC__' => '/template/pc/default/static',
        '__ROOT__'=>''
    ]
];
?>