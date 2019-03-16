<?php
namespace app\home\controller;
use think\Db;
class Column extends Base
{
    public function index()
    {
    	$id = intval(input('id'));
    	if(empty($id)) {
    		$this->redirect('/');
    	}
    	// 当前位置
		$paths = model('column')->path('column',$id);
		foreach ($paths as $v) {
			$path[] = array(
				'url' => url('/Column/'.$v['id']),
				'name' => $v['name'],
			);
		}

		//栏目数据
		$where = 'id = ' . $id;
		$find = Db::name('column')->where($where)->field('id,name,description,photo,list_type,name,page_number,page,body')->find();
		if(empty($find)) {
    		$this->redirect('/');
    	}

    	// 获取当前栏目下的内容
    	$pageid = model('column')->nav('column',$id);	// 获取当前栏目下的子栏目id
    	$pagewhere = ' status = 1 ';
    	if(!empty($pageid)) {
    		$pagewhere .= ' and columnid in (' . implode(',',$pageid) . ')';
    	}
    	$type = str_replace('.html','',$find['list_type']);
    	if(empty($type)) {
    		$this->redirect('/');
    	}
		$size = $find['page_number'] ? $find['page_number'] : '10';
		$sql = Db::name('content')->where($pagewhere)->order('displayorder desc,id desc')->paginate($size);
		$pager = $sql->render();
		foreach ($sql as $v) {	//	赋值
			switch ($v['outlink_state']) {
				case '0':
					$url = url('/Content/'.$v['id']);
					break;
				case '1':
					$url = $v['outlink'];
					break;
				case '3':
					$url = $v['outlink'];
					break;
				default:
					$url = url('/Content/'.$v['id']);
					break;
			}
			$contentlist[] = array(
				'id' 		=> $v['id'],
				'title' 		=> $v['title'],
				'columnid' 	=> $v['columnid'],
				'author' 	=> $v['author'],
				'description' 	=> htmlspecialchars_decode($v['description']),
				'thumb' 		=> empty($v['thumb']) ? '' : $v['thumb'],
				'readnum' 		=> $v['readnum'] + $v['readnum_v'],
				'url' 		=> $url,
                'date_v'     => $v['date_v'],
			);
		}
		$this->contentlist=$contentlist;

		// 子栏目列表
		$navlist = $this->navid($id);
		$this->assign(['path'=>$path,'nav'=>$find,'find'=>$find,'contentlist'=>$contentlist,'pager'=>$pager,'navlist'=>$navlist]);
    	return $this->fetch('tpl_list/'.$type);
    }

    // 查找一级栏目id
	protected function navid($parentid = 0) {
		$nav = Db::name('column')->where('id = ' . intval($parentid))->field('id,parentid')->find();
		$navparentid = $nav['parentid'];

		if ($navparentid == 0) {
			$navid = $nav['id'];
			$navlist = $this->navlist($navid);	// 循环子栏目

			return $navlist;
		}else {
			// 所有一级栏目下的子栏目
			$navid = $this->navid($navparentid);
			// 当前栏目下的子栏目
			// $navid = $this->navlist($parentid);
			return $navid;
		}		
	}

	// 当前栏目下的子栏目
	protected function navlist($id = 0) {
		// 递归子栏目id
		$cid = model('column')->nav('column',$id);
		$navwhere = ' 1 ';
		if(!empty($cid)) {
    		$navwhere .= ' and id in (' . implode(',',$cid) . ')';
    	}
		$sql = Db::name('column')->where($navwhere)->order('sort desc,id asc')->select();
		$i = 0;
		foreach ($sql as $v) {	// 赋值
			$i++;
			switch ($v['outlink_state']) {
		    		case '0':
		    			$url = url('/Column/' . $v['id']);
		    			break;
		    		case '1':
		    			$url = $v['outlink'];
		    			break;
		    		case '2':
		    			$url = $v['outlink'];
		    			break;
		    		default:
		    			$url = url('/Column/' . $v['id']);
		    			break;
		    	}
			$navlist[] = array(
				'i'	=> $i,
				'outlink_state'	=> $v['outlink_state'],
				'id'	=> $v['id'],
				'url' 	=> $url,
				'name' 	=> $v['name'],
				'description' 	=> htmlspecialchars_decode($v['description']),
				'body'	=> $v['body'],
			);
		}
		return $navlist;
	}

}
