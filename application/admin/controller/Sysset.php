<?php
/**
 * 后台系统设置
 *
 * @author SUL1SS <617746883@QQ.com>
 */
namespace app\admin\controller;
use think\Request;
use think\Db;
use think\File;
class Sysset extends Base
{
	public function index()
	{
		$data = model('common')->getSysset('iwebsite');
		if (Request::instance()->isPost()) {
			$data = ((is_array(input('data/a')) ? input('data/a') : array()));
			$data['name'] = trim($data['name']);
			model('common')->updateSysset(array('iwebsite' => $data));
			model('iwebsite')->plog('sysset.iwebsite.edit', '修改系统设置-网站设置');
			show_json(1);
		}
		$this->assign('data',$data);
		return $this->fetch('sysset/index');
	}

	public function themes()
	{
		$t = input('t/s','pc'); // pc or  mobile
        $m = ($t == 'pc') ? 'home' : 'mobile';
        $arr = scandir("./template/$t/");
        foreach ($arr as $key => $val) {
			if ($val == '.' || $val == '..' || strstr($val,'svn')|| strstr($val,'DS_Store')) {
                continue;
			}
            $template_config[$val] = include "./template/$t/$val/config.php";
        }
        $this->assign('t', $t);
        $template_arr = include(APP_PATH."/$m/config.php");
        $this->assign('default_theme', $template_arr['template']['default_theme']);
        $this->assign('template_config', $template_config);
		return $this->fetch('');
	}

	public function setthemes()
	{
		$t = input('t/s','pc'); // pc or  mobile
        $m = ($t == 'pc') ? 'home' : 'mobile';
        $key = input('id/s','default'); // pc or  mobile
        if(!is_writeable(APP_PATH."$m/config.php")) {
         	show_json(0,"文件/".APP_PATH."$m/config.php不可写,不能启用模板,请修改权限!!!");
        }           
         
		$config_html ="<?php
return [
    'template' => [
	    // 模板引擎类型 支持 php think 支持扩展
	    'type'         => 'Think',
	    // 默认模板渲染规则 1 解析为小写+下划线 2 全部转换小写
	    'auto_rule'    => 1,
	    // 模板路径
	    'view_path'    => './template/$t/$key/',
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
        'default_theme'     => '$key',
	],
    'view_replace_str'  =>  [
        '__PUBLIC__'=>'/public',
        '__STATIC__' => '/template/$t/$key/static',
        '__ROOT__'=>''
    ]
];
?>";
        file_put_contents(APP_PATH."/$m/config.php", $config_html);
        show_json(1);
	}

	public function close()
	{
		if (Request::instance()->isPost()) {
			$data = ((is_array($_POST['data']) ? $_POST['data'] : array()));
			$data['flag'] = intval($data['flag']);
			$data['detail'] = model('common')->html_images($data['detail']);
			$data['url'] = trim($data['url']);
			model('common')->updateSysset(array('close' => $data));
			$iwebsite = model('common')->getSysset('iwebsite');
			$iwebsite['close'] = $data['flag'];
			$iwebsite['closedetail'] = $data['detail'];
			$iwebsite['closeurl'] = $data['url'];
			model('common')->updateSysset(array('iwebsite' => $iwebsite));
			model('iwebsite')->plog('sysset.close.edit', '修改系统设置-网站关闭设置');
			show_json(1);
		}

		$data = model('common')->getSysset('close');
		if (empty($data)) {
			$iwebsite = model('common')->getSysset('iwebsite');
			$data['flag'] = $iwebsite['close'];
			$data['detail'] = $iwebsite['closedetail'];
			$data['url'] = $iwebsite['closeurl'];
		}
		$this->assign(['data'=>$data]);
		return $this->fetch('');
	}

	public function contact()
	{
		if (Request::instance()->isPost()) {
			$data = ((is_array($_POST['data']) ? $_POST['data'] : array()));
			$data['province'] = trim($data['province']);
			$data['city'] = trim($data['city']);
			$data['area'] = trim($data['area']);
			$data['street'] = trim($data['street']);
			$data['qq'] = trim($data['qq']);
			$data['address'] = trim($data['address']);
			$data['phone'] = trim($data['phone']);
			$data['email'] = trim($data['email']);
			$data['fax'] = trim($data['fax']);
			model('common')->updateSysset(array('contact' => $data));
			$iwebsite = model('common')->getSysset('iwebsite');
			$iwebsite['qq'] = $data['qq'];
			$iwebsite['address'] = $data['address'];
			$iwebsite['phone'] = $data['phone'];
			$iwebsite['email'] = $data['email'];
			$iwebsite['fax'] = $data['fax'];
			$iwebsite['province'] = $data['province'];
			$iwebsite['city'] = $data['city'];
			$iwebsite['area'] = $data['area'];
			$iwebsite['street'] = $data['street'];
			model('common')->updateSysset(array('iwebsite' => $iwebsite));
			model('iwebsite')->plog('sysset.contact.edit', '修改系统设置-联系方式设置');
			show_json(1);
		}
		$data = model('common')->getSysset('contact');
		if (empty($data)) {
			$iwebsite = model('common')->getSysset('iwebsite');
			$data['qq'] = $iwebsite['qq'];
			$data['address'] = $iwebsite['address'];
			$data['phone'] = $iwebsite['phone'];
			$data['email'] = $iwebsite['email'];
			$data['fax'] = $iwebsite['fax'];
			$data['province'] = $iwebsite['province'];
			$data['city'] = $iwebsite['city'];
			$data['area'] = $iwebsite['area'];
			$data['street'] = $iwebsite['street'];
		}
		$area_set = model('util')->get_area_config_set();
		$new_area = 1;
		$address_street = intval($area_set['address_street']);
		$this->assign(['data'=>$data,'new_area'=>$new_area,'address_street'=>$address_street]);
		return $this->fetch('');
	}

	public function seo()
	{
		if (Request::instance()->isPost()) {
			$data = ((is_array($_POST['data']) ? $_POST['data'] : array()));
			$data['seokeywords'] = trim($data['seokeywords']);
			$data['seodescription'] = trim($data['seodescription']);
			model('common')->updateSysset(array('seo' => $data));
			$iwebsite = model('common')->getSysset('iwebsite');
			$iwebsite['seokeywords'] = $data['seokeywords'];
			$iwebsite['seodescription'] = $data['seodescription'];
			model('common')->updateSysset(array('iwebsite' => $iwebsite));
			model('iwebsite')->plog('sysset.seo.edit', '修改系统设置-SEO设置');
			show_json(1);
		}
		$data = model('common')->getSysset('seo');
		if (empty($data)) {
			$iwebsite = model('common')->getSysset('iwebsite');
			$data['seokeywords'] = $iwebsite['seokeywords'];
			$data['seodescription'] = $iwebsite['seodescription'];
		}
		$this->assign(['data'=>$data]);
		return $this->fetch('');
	}

}