<?php
/**
 * 内容管理
 *
 * @author SUL1SS <617746883@QQ.com>
 */
namespace app\admin\controller;
use think\Request;
use think\Db;
class Content extends Base
{
    public function index()
    {
		$psize = 20;
    	$select_column = (empty($_GET['column']) ? '' : ' and a.columnid=' . intval($_GET['column']) . ' ');
		$select_title = (empty($_GET['keyword']) ? '' : ' and a.title LIKE \'%' . $_GET['keyword'] . '%\' ');
		$contents = array();
		$contents = Db::name('content')->alias('a')->join('column c','c.id=a.columnid','left')->field('a.id,a.displayorder, a.title,a.columnid,a.date_v,a.readnum,a.likenum,a.status,a.isrecommand,a.createtime,c.name as culumnname')->where(' deleted = 0 ' . $select_title . $select_column)->order('a.displayorder','desc')->paginate($psize);
		$pager = $contents->render();

		if (!empty($contents)) {
			foreach ($contents as $k => $value) {
				$value['url'] = getHttpHost()  . url('index/webview/content',array('aid'=>$value['id']), true);
				$data = array();
	    		$data = $value;
	    		$contents->offsetSet($k,$data);
			}
			unset($value);
		}

		$contentnum = Db::name('content')->count();
		$columns = model('common')->getFullColumn(true,true);
		$this->assign(['contents'=>$contents,'pager'=>$pager,'contentnum'=>$contentnum,'columns'=>$columns]);
		return $this->fetch('');
    }

    public function add()
	{
		$data = $this->post();
		return $data;
	}

	public function edit()
	{
		$data = $this->post();
		return $data;
	}

	protected function post()
	{
		$aid = intval(input('aid'));
		$item = Db::name('content')->where('id',$aid)->find();

		if (Request::instance()->isPost()) {
			$data = array('displayorder' => intval(input('displayorder')), 'title' => trim(input('title')), 'columnid' => intval(input('columnid')), "date_v" => trim(input('date_v')), 'description' => trim(input('description')), 'thumb' => trim(input('thumb')), 'mp' => trim(input('mp')), 'author' => trim(input('author')), 'readnum_v' => intval(input('readnum_v')), 'likenum_v' => trim(input('likenum_v')), 'status' => intval(input('status')), 'isrecommand' => intval(input('isrecommand')), 'content' => model('common')->html_images($_POST['content'], true));

			if (empty($item)) {
				$data['createtime'] = time();
				$aid = Db::name('content')->insertGetId($data);
				model('iwebsite')->plog('content.add', '添加内容 ID: ' . $aid . ' 标题: ' . $data['title']);
			} else {
				Db::name('content')->where('id',$item['id'])->update($data);
				model('iwebsite')->plog('content.edit', '编辑内容 ID: ' . $aid . ' 标题: ' . $data['title']);
			}
			show_json(1, array('url' => url('admin/content/edit', array('aid' => $aid, 'tab' => str_replace('#tab_', '', $_GET['tab'])))));
		}

		$columns = model('common')->getFullColumn(true,true);
		$this->assign(['columns'=>$columns,'item'=>$item,'aid'=>$aid,'tab'=>str_replace('#tab_', '', $_GET['tab'])]);
		return $this->fetch('content/post');
	}

	public function delete()
	{
		$id = intval(input('id'));

		if (empty($id)) {
			$id = (is_array($_POST['ids']) ? implode(',', $_POST['ids']) : 0);
		}

		$items = Db::name('content')->where('id','in',$id)->field('id,title')->select();
		foreach ($items as $item) {
			Db::name('content')->where('id',$item['id'])->setField('deleted',1);			
			model('iwebsite')->plog('content.delete', '删除内容 ID: ' . $item['id'] . ' 标题: ' . $item['title'] . ' ');
		}

		show_json(1, array('url' => referer()));
	}

	public function displayorder()
	{
		$id = intval(input('id'));
		$displayorder = intval(input('value'));
		$item = Db::name('content')->where('id',$id)->field('id,title')->find();

		if (!empty($item)) {
			Db::name('content')->where('id',$item['id'])->setField('displayorder',$displayorder);			
			model('iwebsite')->plog('content.edit', '修改内容排序 ID: ' . $item['id'] . ' 标题: ' . $item['title'] . ' 排序: ' . $displayorder . ' ');
		}

		show_json(1);
	}

	public function status()
	{
		$id = intval(input('id'));

		if (empty($id)) {
			$id = (is_array($_POST['ids']) ? implode(',', $_POST['ids']) : 0);
		}
		$status = input('status/d');
		$items = Db::name('content')->where('id','in',$id)->field('id,title')->select();

		foreach ($items as $item) {
			Db::name('content')->where('id',$item['id'])->setField('status',$status);			
			model('iwebsite')->plog('content.edit', ('修改内容状态<br/>ID: ' . $item['id'] . '<br/>标题: ' . $item['title'] . '<br/>状态: ' . $status) == 1 ? '开启' : '关闭');
		}

		show_json(1, array('url' => referer()));
	}

	public function isrecommand()
	{
		$id = intval(input('id'));

		if (empty($id)) {
			$id = (is_array($_POST['ids']) ? implode(',', $_POST['ids']) : 0);
		}
		$isrecommand = input('isrecommand/d');
		$items = Db::name('content')->where('id','in',$id)->field('id,title')->select();

		foreach ($items as $item) {
			Db::name('content')->where('id',$item['id'])->setField('isrecommand',$isrecommand);			
			model('iwebsite')->plog('content.edit', ('修改内容状态<br/>ID: ' . $item['id'] . '<br/>标题: ' . $item['title'] . '<br/>状态: ' . $isrecommand) == 1 ? '推荐' : '不推荐');
		}

		show_json(1, array('url' => referer()));
	}

}