<?php
/*
 +----------------------------------------------------------------------
 + Title        : 自定义循环标签
 + Author       : 小黄牛
 + Version      : V1.0.0.v
 + Initial-Time : 2017-10-19 14:30
 + Last-time    : 2017-10-19 14:30 + 小黄牛
 + Desc         : 
 +----------------------------------------------------------------------
*/
namespace app\common\Taglib;
use think\template\TagLib;
use think\Db;
class Iwebsite extends TagLib{
    /**
     * 定义标签列表
     */
    protected $tags   =  [
        # 标签定义： attr 属性列表 close 是否闭合（0 或者1 默认1） alias 标签别名 level 嵌套层次
        'list'      => ['attr' => 'table,where,order,value,key,limit,page', 'close' => 1],
    ];

    /** 
     * 调用方法
     */
    public function tagList($attr, $content){
        $table = !empty($attr['table']) ? $attr['table'] : '';     // 表名
        $where = !empty($attr['where']) ? $attr['where'] : '';     // 查询条件
        $order = !empty($attr['order']) ? $attr['order'] : '';     // 排序 
        $value = !empty($attr['value']) ? $attr['value'] : 'v';    // 解析数组名
        $key   = !empty($attr['key'])   ? $attr['key'] : 'i';      // 解析key名
        $limit = !empty($attr['limit']) ? $attr['limit'] : '10';   // 分页条数
        $page  = !empty($attr['page'])  ? $attr['page'] : 'false'; // 是否分页
        $html  = '<?php ';
        $html .= '$think_table = "'.$table.'";';
        $html .= '$think_where = "'.$where.'";';
        $html .= '$think_order = "'.$order.'";';
        $html .= '$think_limit = "'.$limit.'";';
        # 开启分页
        if ($page) {
            $html .= '$think_db_info = db($think_table)->where($think_where)->order($think_order)->paginate($think_limit);';
            $html .= '$think_page = $think_db_info->render();';
        } else {
            $html .= '$think_db_info = db($think_table)->where($think_where)->order($think_order)->limit($think_limit)->select();';
        }
        $html .= ' ?>';
        # 开启循环
        $html .= '{volist name="think_db_info" id="' . $value . '" key="' . $key . '"}';
        $html .= $content;
        $html .= '{/volist}';
        return $html;
    } 
    
}