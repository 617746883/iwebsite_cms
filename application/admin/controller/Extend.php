<?php
/**
 * 扩展管理
 *
 * @author SUL1SS <617746883@QQ.com>
 */
namespace app\admin\controller;
use think\Request;
use think\Db;
class Extend extends Base
{
	public function index()
    {
    	header('location: ' . url('admin/extend/banner'));exit;
    }

    public function banner()
    {
		$psize = 20;
		$condition = ' 1 ';
		$enabled = input('enabled');
		if ($enabled != '') {
			$condition .= ' and enabled=' . intval(input('enabled'));
		}

		if (!empty(input('keyword'))) {
			$keyword = trim(input('keyword'));
			$condition .= ' and bannername like "%' . $keyword . '%"';
		}

		$list = Db::name('banner')->where($condition)->order('displayorder','desc')->paginate($psize);
		$pager = $list->render();
		$this->assign(['list'=>$list,'pager'=>$pager,'enabled'=>$enabled,'keyword'=>$keyword]);
    	return $this->fetch('extend/banner/index');
    }

    public function banneradd()
	{
		$bannerdata = $this->bannerpost();
		return $bannerdata;
	}

	public function banneredit()
	{
		$bannerdata = $this->bannerpost();
		return $bannerdata;
	}

	protected function bannerpost()
	{
		$id = intval(input('id'));

		if (Request::instance()->isPost()) {
			$data = array('bannername' => trim(input('bannername')), 'link' => trim(input('link')), 'enabled' => intval(input('enabled')), 'displayorder' => intval(input('displayorder')), 'thumb' => trim(input('thumb')), 'description' => input('description'));
			if (!empty($id)) {
				Db::name('banner')->where('id',$id)->update($data);
				model('iwebsite')->plog('extend.banner.edit', '修改幻灯片 ID: ' . $id);
			}
			else {
				$id = Db::name('banner')->insertGetId($data);
				model('iwebsite')->plog('extend.banner.add', '添加幻灯片 ID: ' . $id);
			}
			show_json(1);
		}
		$item = Db::name('banner')->where('id',$id)->find();

		$request = Request::instance();
		$controller = strtolower($request->controller());
		$this->assign(['item'=>$item,'controller'=>$controller]);
		return $this->fetch('extend/banner/post');
	}

	public function bannerdelete()
	{
		$id = intval(input('id'));

		if (empty($id)) {
			$id = input('ids/a');
		}

		$items = Db::name('banner')->where('id','in',$id)->field('id,bannername')->select();

		foreach ($items as $item) {
			Db::name('banner')->where('id',$item['id'])->delete();
			model('iwebsite')->plog('extend.banner.delete', '删除幻灯片 ID: ' . $item['id'] . ' 标题: ' . $item['bannername'] . ' ');
		}

		show_json(1);
	}

	public function bannerdisplayorder()
	{
		$id = intval(input('id'));
		$displayorder = intval(input('value'));
		$item =  Db::name('banner')->where('id',$id)->field('id,bannername')->find();

		if (!empty($item)) {
			Db::name('banner')->where('id',$id)->setField('displayorder',$displayorder);
			model('iwebsite')->plog('extend.banner.edit', '修改幻灯片排序 ID: ' . $item['id'] . ' 标题: ' . $item['bannername'] . ' 排序: ' . $displayorder . ' ');
		}

		show_json(1);
	}

	public function bannerenabled()
	{
		$id = intval(input('id'));

		if (empty($id)) {
			$id = input('ids/a');
		}

		$items = Db::name('banner')->where('id','in',$id)->field('id,bannername')->select();

		foreach ($items as $item) {
			Db::name('banner')->where('id',$item['id'])->setField('enabled',input('enabled'));
			model('iwebsite')->plog('extend.banner.edit', ('修改幻灯片状态<br/>ID: ' . $item['id'] . '<br/>标题: ' . $item['bannername'] . '<br/>状态: ' . input('enabled')) == 1 ? '显示' : '隐藏');
		}
		show_json(1);
	}

	public function feedback()
	{
		$psize = 20;
		$status = input('status');
		$keyword = input('keyword');
		$condition = ' 1 ';

		if (!empty($keyword)) {
			$keyword = trim($keyword);
			$condition .= ' and title like "%' . $keyword . '%"';
		}
		if ($status != '') {
			$condition .= ' and status=' . intval($status);
		}

		$list = Db::name('feedback')->where($condition)->order('createtime','title')->paginate($psize);
		$pager = $list->render();

		$this->assign(['list'=>$list,'pager'=>$pager,'status'=>$status,'keyword'=>$keyword]);
		return $this->fetch('extend/feedback/index');
	}

	public function feedbackdelete()
	{
		$id = intval(input('id'));

		if (empty($id)) {
			$id = (is_array($_POST['ids']) ? implode(',', $_POST['ids']) : 0);
		}

		$items = Db::name('feedback')->where('id','in',$id)->field('id,title')->select();

		foreach ($items as $item) {
			Db::name('feedback')->where('id',$item['id'])->delete();
			model('iwebsite')->plog('extend.feedback.delete', '删除意见反馈 ID: ' . $item['id'] . ' 意见反馈: ' . $item['title'] . ' ');
		}

		show_json(1, array('url' => referer()));
	}

	public function feedbackstatus()
	{
		$id = intval(input('id'));

		if (empty($id)) {
			$id = (is_array($_POST['ids']) ? implode(',', $_POST['ids']) : 0);
		}

		$status = intval(input('status'));
		$items = Db::name('feedback')->where('id','in',$id)->field('id,title')->select();

		foreach ($items as $item) {
			Db::name('feedback')->where('id',$item['id'])->setField('status',$status);
			model('iwebsite')->plog('extend.feedback.edit', '修改意见反馈状态 ID: ' . $item['id'] . ' 意见反馈: ' . $item['title'] . ' 状态: ' . ($status == 0 ? '查看' : '未读'));
		}

		show_json(1, array('url' => referer()));
	}

	public function feedbackdetail()
	{
		$id = intval(input('id'));
		$item = Db::name('feedback')->alias('f')->join('member m','m.id = f.mid','left')->where('f.id','eq',$id)->field('f.*,m.realname,m.mobileverify,m.mobile,m.isblack,m.avatar,m.nickname')->find();
		$piclist = array();
		if (!(empty($item['thumbs_url']))) {
			$piclist = iunserializer($item['thumbs_url']);
		}
		$this->assign(['item'=>$item,'piclist'=>$piclist]);
		return $this->fetch('extend/feedback/detail');
	}

	public function link()
    {
		$psize = 20;
		$condition = ' 1 ';
		$enabled = input('enabled');
		if ($enabled != '') {
			$condition .= ' and enabled=' . intval(input('enabled'));
		}

		if (!empty(input('keyword'))) {
			$keyword = trim(input('keyword'));
			$condition .= ' and name like "%' . $keyword . '%"';
		}

		$list = Db::name('link')->where($condition)->order('sort','desc')->paginate($psize);
		$pager = $list->render();
		$this->assign(['list'=>$list,'pager'=>$pager,'enabled'=>$enabled,'keyword'=>$keyword]);
    	return $this->fetch('extend/link/index');
    }

    public function linkadd()
	{
		$linkdata = $this->linkpost();
		return $linkdata;
	}

	public function linkedit()
	{
		$linkdata = $this->linkpost();
		return $linkdata;
	}

	protected function linkpost()
	{
		$id = intval(input('id'));

		if (Request::instance()->isPost()) {
			$data = array('name' => trim(input('name')), 'url' => trim(input('url')), 'status' => intval(input('status')), 'sort' => intval(input('sort')), 'thumb' => trim(input('thumb')));
			if (!empty($id)) {
				Db::name('link')->where('id',$id)->update($data);
				model('iwebsite')->plog('extend.link.edit', '修改幻灯片 ID: ' . $id);
			}
			else {
				$id = Db::name('link')->insertGetId($data);
				model('iwebsite')->plog('extend.link.add', '添加幻灯片 ID: ' . $id);
			}
			show_json(1);
		}
		$item = Db::name('link')->where('id',$id)->find();

		$request = Request::instance();
		$controller = strtolower($request->controller());
		$this->assign(['item'=>$item,'controller'=>$controller]);
		return $this->fetch('extend/link/post');
	}

	public function linkdelete()
	{
		$id = intval(input('id'));

		if (empty($id)) {
			$id = input('ids/a');
		}

		$items = Db::name('link')->where('id','in',$id)->field('id,name')->select();

		foreach ($items as $item) {
			Db::name('link')->where('id',$item['id'])->delete();
			model('iwebsite')->plog('extend.link.delete', '删除幻灯片 ID: ' . $item['id'] . ' 标题: ' . $item['name'] . ' ');
		}

		show_json(1);
	}

	public function linkdisplayorder()
	{
		$id = intval(input('id'));
		$displayorder = intval(input('value'));
		$item =  Db::name('link')->where('id',$id)->field('id,name')->find();

		if (!empty($item)) {
			Db::name('link')->where('id',$id)->setField('displayorder',$displayorder);
			model('iwebsite')->plog('extend.link.edit', '修改幻灯片排序 ID: ' . $item['id'] . ' 标题: ' . $item['name'] . ' 排序: ' . $displayorder . ' ');
		}

		show_json(1);
	}

	public function linkstatus()
	{
		$id = intval(input('id'));

		if (empty($id)) {
			$id = input('ids/a');
		}

		$items = Db::name('link')->where('id','in',$id)->field('id,name')->select();

		foreach ($items as $item) {
			Db::name('link')->where('id',$item['id'])->setField('status',input('status'));
			model('iwebsite')->plog('extend.link.edit', ('修改幻灯片状态<br/>ID: ' . $item['id'] . '<br/>标题: ' . $item['name'] . '<br/>状态: ' . input('status')) == 1 ? '显示' : '隐藏');
		}
		show_json(1);
	}

}