<?php
namespace app\home\controller;
use think\Db;
class Content extends Base
{
	public function index()
    {
    	$id = intval(input('id'));
    	if(empty($id)) {
    		$this->redirect('/');
    	}
    	$find = Db::name('content')->where('id = ' . $id)->find();
    	if(empty($id)) {
    		$this->redirect('/');
    	}
		// 子栏目递归
		$navid = $find['columnid'];
		// 当前位置
		$paths = model('column')->path('column',$navid);
		foreach ($paths as $v) {
			$path[] = array(
				'url' 	=> url('/column/'.$v['id']),
				'name' 	=> $v['name'],
			);
		}

		// 更新点击
		$find['readnum'] += 1;
		$data['readnum'] = $find['readnum'];
		Db::name('content')->where('id = ' . $id)->update($data);
		if ($find['thumb']) {
			$thumb = $find['thumb'];
		}else{
			$thumb = '';
		}
		// 页面赋值
		$content = array(			
			'id' 		=> $find['id'],
			'title' 		=> $find['title'],
			'columnid' 	=> $find['columnid'],
			'description' 	=> $find['description'],
			'isrecommand' 	=> $find['isrecommand'],
			'thumb' 		=> $thumb,
			'content' 		=> $find['content'],
			'readnum' 		=> $find['readnum'] + $find['readnum_v'],
			'date_v' 		=> $v['date_v']
		);

		// 上一篇
		$sqlprev = Db::name('content')->where('columnid = ' . intval($content['columnid']) . ' and id < ' . $content['id'])->find();
		$prev = array(
			'url' 	=> !empty($sqlprev['id']) ? url('/Content/'.$sqlprev['id']) : 'javascript:;',
			'title' 	=> !empty($sqlprev['title']) ? $sqlprev['title'] : '没有了',
		);
		// 下一篇
		$sqlnext = Db::name('content')->where('columnid = ' . intval($content['columnid']) . ' and id > ' . $content['id'])->find();
		$next = array(
			'url' 	=> !empty($sqlnext['id']) ? url('/Content/'.$sqlnext['id']) : '#',
			'title' 	=> !empty($sqlnext['title']) ? $sqlnext['title'] : '没有了',
		);

		//赋值模版
		$nav = Db::name('column')->where('id = ' . intval($find['columnid']))->field('content_type,name,id')->find();
    	
		// if (empty($nav) || empty($nav['content_type'])) {
		// 	$this->redirect('/');
		// }
		$type = str_replace('.html','',$nav['content_type']);
		// 子栏目列表
		$navlist = $this->navid($nav['id']);

		// 评论
		$comment = Db::name('comment')->where('status = 1 and id = ' . $id)->order('good desc,id desc')->select();		
		foreach ($comment as $v) {
			$msgnums = D('Curd')->select('comment_more','id='.$v['id'],'good desc,id desc',null,'id');
			if ($msgnums) {
				$msgnum = count($msgnums);
			}else {
				$msgnum = 0;
			}
			$comments[] = array(
				'id'=>$v['id'],
				'nick'=>$v['nick'],
				'thumb'=>$v['thumb'] ? $v['thumb']:__ROOT__ . '/Public/CDN/images/duface.png',
				'date_v'=>$v['date_v'],
				'message'=>$v['message'],
				'good'=>$v['good'],
				'msgnum'=>$msgnum,
				'url' => url('/Comment/content',array('id'=>$v['id'])),
				);

		}
		$this->assign(['path'=>$path,'content'=>$content,'prev'=>$prev,'next'=>$next,'nav'=>$nav,'navlist'=>$navlist]);
    	return $this->fetch('tpl_content/'.$type);
    }

    // 查找一级栏目id
	protected function navid($parentid = 0) {
		$nav = Db::name('column')->where('id = ' .$parentid)->field('id,parentid')->find();
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
		$sql = Db::name('column')->where($navwhere)->order('sort desc,id asc')->field('id,name')->select();
		$i = 0;
		foreach ($sql as $v) {	// 赋值
			$i++;
			switch ($v['outlink_state']) {
		    		case '0':
		    			$url = url('/column/' . $v['id']);
		    			break;
		    		case '1':
		    			$url = $v['outlink'];
		    			break;
		    		case '2':
		    			$url = $v['outlink'];
		    			break;
		    		default:
		    			$url = url('/column/' . $v['id']);
		    			break;
		    	}
			$navlist[] = array(
				'i'	=> $i,
				'id'	=> $v['id'],
				'url' 	=> $url,
				'name' 	=> $v['name'],
			);
		}
		return $navlist;
	}

}