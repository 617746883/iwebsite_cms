<?php
namespace app\common\model;
use think\Db;
use think\Request;
class Column extends \think\Model
{
	// 获取栏目数据
	public function nav($name,$parentid = 0) {
		if (is_var($name)) {
			$sql = Db::name($name)->order('sort asc,id asc')->field('id,parentid,name')->select();
			$data = self::getChildsId($sql,$parentid);
			// 没有子栏目则返回一级栏目
			if (empty($data)) {
				$data[] = $parentid;
			}
			return $data;
		}else {
			return false;
		}
		
	}
	// 传递一个父级分类ID返回所有子级分类
	Static Public function getChildsId ($column,$parentid = 0) {

		$arr = array();
		foreach ($column as $v) {
			if ($v['parentid'] == $parentid) {
				$arr[] = $v['id']; //子ID
				$arr = array_merge($arr,self::getChildsId($column,$v['id']));
			}
		}

		return $arr;
	}

	// 当前位置
	public function path($name,$id) {
		$sql = Db::name($name)->field('id,name,parentid')->select();
		$data = self::getParents($sql,$id);
		return $data;
	}

	//传递一个子分类ID返回所有栏目父级分类
	Static Public function getParents($column,$id){
		$arr = array();
		foreach ($column as $v) {
			if ($v['id'] == $id) {
				$arr[] = $v;
				$arr = array_merge(self::getParents($column,$v['parentid']),$arr);
			}
		}
		return $arr;
	}
}