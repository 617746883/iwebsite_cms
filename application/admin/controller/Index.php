<?php
/**
 * 后台首页
 *
 * @author SUL1SS <617746883@QQ.com>
 */
namespace app\admin\controller;
use think\Db;
class Index extends Base
{
    public function index()
    {    	
    	$content = Db::name('content')->where('deleted = 0')->count();
    	$column = Db::name('column')->where('status = 1')->count();
    	$link = Db::name('link')->where('status = 1')->count();
    	$comment = Db::name('comment')->count();
    	$this->assign(['content'=>$content,'column'=>$column,'link'=>$link,'comment'=>$comment]);
        return $this->fetch('/index');
    }

    public function _empty()
    {
    	return $this->fetch('/error');
    }

}