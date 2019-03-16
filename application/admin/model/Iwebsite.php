<?php
namespace app\admin\model;
use think\Db;
use think\Request;
use think\Cache;
class Iwebsite extends \think\Model
{
	public static function plog($type = '', $op = '')
    {
		$admininfo = session('admin');
        $adminid = $admininfo['id'];

		$log = array('adminid' => $adminid, 'type' => $type, 'op' => $op, 'ip' => request()->ip(), 'createtime' => time());
		Db::name('admin_log')->insert($log);
		return;
    }

    public static function tempath($path = '')
    {
		$tempath = glob($path);  //匹配文件
		if (empty($tempath) || !$tempath) {
			return false;
		} else {
			$len = count($tempath);
			$tempname = array();
			for ($i=0; $i < $len; $i++) { 
				$tempname[] = basename($tempath[$i]);
			}
			return $tempname;
		}	
    }
    
}