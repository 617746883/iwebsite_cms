<?php
namespace app\home\controller;
use think\Request;
use think\Db;
class Feedback extends Base
{
	public function index()
	{
		if (Request::instance()->isPost()) {
			$data['title'] = input('title');
			$data['name']  = input('name');
			$data['call']  = input('call');
			$data['content']  = input('content');
			$data['createtime']  = time();

			$add = Db::name('feedback')->insert($data);
			if ($add) {
				$this->success('留言成功，感谢您的支持！');
			}else {
				$this->error('留言失败，请稍后重试！');
			}
		} else if (Request::instance()->isAjax()) {
			$data['title'] = input('title');
			$data['name']  = input('name');
			$data['call']  = input('call');
			$data['content']  = input('content');
			$data['date']  = time();

			$add = Db::name('feedback')->insert($data);
			if ($add) {
				show_json(1);
			} else {
				show_json(0,'留言失败，请稍后重试！');
			}
		}
		return $this->fetch('/index');
	}

}