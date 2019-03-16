<?php
/**
 * 后台基类
 *
 * @author SUL1SS <617746883@QQ.com>
 */
namespace app\home\controller;
use think\Controller;
use think\Db;
use think\Request;
class Base extends Controller
{
    /**
	 * 析构函数，初始化操作
	 * @param  [string]  $token [用户token]
	 * @return [type]           [description]
	 */
	public function __construct()
	{
		parent::__construct();
		$this->checkClose();
		$iwebsite = model('common')->getSysset();
		$copyright = model('common')->getCopyright(0);
		$this->copyright = $copyright;
		$this->iwebsite = $iwebsite;
		$this->assign(['iwebsite'=>$iwebsite,'copyright'=>$copyright]);
	}

	public function checkClose()
	{
		$iwebsite = model('common')->getSysset();
		$close = $iwebsite['close'];
		if (!empty($close['flag'])) {
			if (!empty($close['url'])) {
				header('location: ' . $close['url']);
				exit();
			}
			exit("<!DOCTYPE html>\r\n\t\t\t\t\t<html>\r\n\t\t\t\t\t\t<head>\r\n\t\t\t\t\t\t\t<meta name='viewport' content='width=device-width, initial-scale=1, user-scalable=0'>\r\n\t\t\t\t\t\t\t<title>抱歉，商城暂时关闭</title><meta charset='utf-8'><meta name='viewport' content='width=device-width, initial-scale=1, user-scalable=0'><link rel='stylesheet' type='text/css' href='https://res.wx.qq.com/connect/zh_CN/htmledition/style/wap_err1a9853.css'>\r\n\t\t\t\t\t\t</head>\r\n\t\t\t\t\t\t<body>\r\n\t\t\t\t\t\t<style type='text/css'>\r\n\t\t\t\t\t\tbody { background:#fbfbf2; color:#333;}\r\n\t\t\t\t\t\timg { display:block; width:100%;}\r\n\t\t\t\t\t\t.header {\r\n\t\t\t\t\t\twidth:100%; padding:10px 0;text-align:center;font-weight:bold;}\r\n\t\t\t\t\t\t</style>\r\n\t\t\t\t\t\t<div class='page_msg'>\r\n\t\t\t\t\t\t\r\n\t\t\t\t\t\t<div class='inner'><span class='msg_icon_wrp'><i class='icon80_smile'></i></span>" . $close['detail'] . "</div></div>\r\n\t\t\t\t\t\t</body>\r\n\t\t\t\t\t</html>");
		}
	}

	/* 空操作，用于输出404页面 */
	public function _empty(){
		$this->redirect('/');
	}
	
}