<?php
/**
 * 栏目管理
 *
 * @author SUL1SS <617746883@QQ.com>
 */
namespace app\admin\controller;
use think\Request;
use think\Db;
class Column extends Base
{
    public function index()
    {
    	$columns = array();
    	$columns = Db::name('column')->order('sort desc,id asc')->select();
  //   	foreach ($columns as $index => $row) {
		// 	if (!empty($row['parentid'])) {
		// 		$children[$row['parentid']][] = $row;
		// 		unset($columns[$index]);
		// 	}
		// }
        // 获取树形或者结构数据
        vendor('tree.Tree');  
        $tree = new \Tree();     
        $rules=$tree->trees($columns,'name','id','parentid');
        $this->assign(['rules'=>$rules]);
    	$this->assign(['children'=>$children,'columns'=>$columns]);
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
		$parentid = input('parentid/d');
		$id = input('id/d');
		$parent = array();
		$parent1 = array();
		$item = array();
		if (!empty($id)) {
			$item = Db::name('column')->where('id',$id)->find();
			if(!empty($item)) {
				if($item['outlink_state'] == 1) {
					$item['outlink1'] = $item['outlink'];
				} else {
					if($item['outlink_state'] == 2) {
						$item['outlink2'] = $item['outlink'];
					}
				}
			}
			$parentid = $item['parentid'];
		}
		if (!empty($parentid)) {
			$parent = Db::name('column')->where('id',$parentid)->find();
			if (empty($parent)) {
				$this->error('抱歉，上级栏目不存在或是已经被删除！', url('admin/column/add'));
			}
			if (!empty($parent['parentid'])) {
				$parent1 = Db::name('column')->where('id',$parent['parentid'])->find();
			}
		}

		if (empty($parent)) {
			$level = 1;
		} else if (empty($parent['parentid'])) {
			$level = 2;
		} else {
			$level = 3;
		}

		if (Request::instance()->isPost()) {
			$data = array('name' => trim(input('name')), 'status' => intval(input('status')), 'sort' => intval(input('sort')), 'page' => intval(input('page')), 'parentid' => intval($parentid), 'thumb' => trim(input('thumb')), 'page_number' => intval(input('page_number')), 'list_type' => trim(input('list_type')), 'content_type' => trim(input('content_type')), 'level' => $level, 'outlink_state' => intval(input('outlink_state')));
			if($data['page'] == 1) {
				$data['description'] = input('description');
				$data['photo'] = trim(input('photo'));
				$data['body'] =  model('common')->html_images($_POST['body'], true);
			}
			if(!empty($data['outlink_state'])) {
				if($data['outlink_state'] == 1) {
					$data['outlink'] = trim(input('outlink1/s',''));
				} else {
					if($data['outlink_state'] == 2) {
						$data['outlink'] = trim(input('outlink2/s',''));
					}
				}
			}
			if (!empty($id)) {
				unset($data['parentid']);
				Db::name('column')->where('id',$id)->update($data);
				model('iwebsite')->plog('admin.column.edit', '修改栏目 ID: ' . $id);
			} else {
				$id = Db::name('column')->insertGetId($data);
				model('iwebsite')->plog('admin.column.add', '添加栏目 ID: ' . $id);
			}
			show_json(1, array('url' => url('admin/column/index')));
		}
		$template_arr = include(APP_PATH."/home/config.php");
		$list_types = model('iwebsite')->tempath($template_arr['template']['view_path'] . 'tpl_list/*.html');
		$content_types = model('iwebsite')->tempath($template_arr['template']['view_path'] . 'tpl_content/*.html');
		$this->assign(['item'=>$item,'parentid'=>$parentid,'parent'=>$parent,'parent1'=>$parent1,'level'=>$level,'list_types'=>$list_types,'content_types'=>$content_types]);
		return $this->fetch('column/post');
	}

	public function delete()
	{
		$id = input('id/d');
		$item = Db::name('column')->where('id',$id)->field('id,name,parentid')->find();
		if (empty($item)) {
			show_json(0,'抱歉，栏目不存在或是已经被删除！');
		}
		$child = Db::name('column')->where('parentid',$id)->count();
		if($child > 0) {
			show_json(0,'请先删除下级栏目');
		}
		Db::name('column')->where('id',$id)->whereOr('parentid',$id)->delete();
		model('iwebsite')->plog('admin.column.delete', '删除栏目 ID: ' . $id . ' 栏目名称: ' . $item['name']);
		show_json(1);
	}

	public function status()
	{
		$id = input('id/d');
		if (empty($id)) {
			$id = input('ids/a');
		}
		$items = Db::name('column')->where('id','in',$id)->select();
		foreach ($items as $item) {
			Db::name('column')->where('id',$item['id'])->setField('status',input('status'));
			model('iwebsite')->plog('admin.column.edit', ('修改栏目状态<br/>ID: ' . $item['id'] . '<br/>栏目名称: ' . $item['name'] . '<br/>状态: ' . input('status')) == 1 ? '显示' : '隐藏');
		}
		show_json(1);
	}

	public function page()
	{
		$id = input('id/d');
		if (empty($id)) {
			$id = input('ids/a');
		}
		$items = Db::name('column')->where('id','in',$id)->select();
		foreach ($items as $item) {
			Db::name('column')->where('id',$item['id'])->setField('page',input('page'));
			model('iwebsite')->plog('admin.column.edit', ('修改栏目状态<br/>ID: ' . $item['id'] . '<br/>栏目名称: ' . $item['name'] . '<br/>状态: ' . input('page')) == 1 ? '显示' : '隐藏');
		}
		show_json(1);
	}

	public function sort()
	{
		$id = intval(input('id'));
		$sort = intval(input('value'));
		$item = Db::name('column')->where('id',$id)->field('id,name')->find();

		if (!empty($item)) {
			Db::name('column')->where('id',$item['id'])->setField('sort',$sort);			
			model('iwebsite')->plog('column.edit', '修改栏目排序 ID: ' . $item['id'] . ' 标题: ' . $item['name'] . ' 排序: ' . $sort . ' ');
		}

		show_json(1);
	}

}