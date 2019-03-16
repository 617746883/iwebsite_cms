<?php
namespace app\common\model;
use think\Db;
use think\Request;
class System extends \think\Model
{
	public static function init($merch = 0)
    {
    	$request = Request::instance();
		$route = strtolower($request->module() . '/' . $request->controller() . '/' . $request->action());
    	$routes = explode('/', $route);
        $arr = array(
			'merch'       => $merch,
			'order1'      => 1,
			'order4'      => 0,
			'notice'      => array(),
			'comment'     => 0,
			'foldnav'     => 0,
			'foldpanel'   => 0,
			'routes'      => $routes,
			'right_menu'  => self::initRightMenu($routes,$merch)
		);

		return $arr;
    }

    /**
     * 初始化右侧顶部菜单
     */
	protected static function initRightMenu($routes, $merch = false)
	{
		$shopset = model('common')->getSysset();
		$return_arr = array(
			'system'     => 0,
			'menu_title' => '',
			'menu_items' => array(),
			'logout'     => ''
		);
		
		if ($merch) {
			$return_arr['menu_title'] = session('?account') ? session('account')['username'] : '商户管理后台';
			$return_arr['menu_items'][] = array('text' => '修改密码', 'href' => url('merch/user/updatepwd'));
			$return_arr['logout'] = url('merch/system/loginout');
		} else {
			$return_arr['menu_title'] = session('?admin') ? session('admin')['username'] : '网站管理后台';
			if ($routes[1] != 'system') {
				$return_arr['system'] = 1;
			}

			if ($routes[1] == 'system') {
				$return_arr['menu_items'][] = array('text' => '返回系统', 'href' => url('admin/index/index'), 'blank' => true);
				$return_arr['logout'] = url('admin/system/loginout');
			} else {
				$return_arr['menu_items'][] = 'line';
				$return_arr['menu_items'][] = array('text' => '我的信息', 'href' => url('admin/user/index'), 'blank' => true);
				$return_arr['menu_items'][] = array('text' => '修改密码', 'href' => url('admin/user/index'), 'blank' => true);
				$return_arr['menu_items'][] = 'line';
				$return_arr['menu_items'][] = array('text' => '权限管理', 'href' => url('admin/system/perm'), 'blank' => true);
				$return_arr['menu_items'][] = array('text' => '返回系统', 'href' => url('admin/index/index'), 'blank' => true);
				$return_arr['logout'] = url('admin/system/loginout');
			}
		}
		return $return_arr;
	}

	/**
     * 获取 全部菜单带路由
     * @param bool $full 是否返回长URL
     * @return array
     */
	public function getMenu($full = false, $merch = 0)
	{
		$return_menu = array();
		$return_submenu = array();
		$request = Request::instance();
		$route = strtolower($request->module() . '/' . $request->controller() . '/' . $request->action());
		$routes = explode('/', $route);
		$top = strtolower($request->controller());

		if(empty($merch)) {
			$allmenus = $this->shopMenu();
			$mod = 'admin';
		}	

		if (!empty($allmenus)) {
			$submenu = isset($allmenus[$top]) ? $allmenus[$top] : array();
			if (empty($submenu)) {
				$othermenu = $this->otherMenu();
				if (!empty($othermenu[$top])) {
					$submenu = $othermenu[$top];
				}
			}
			if (empty($submenu)) {
				$submenu = $this->pluginMenu($top);
				$isplugin = true;
			}
			foreach ($allmenus as $key => $val) {
				$menu_item = array('route' => empty($val['route']) ? $key : $val['route'], 'text' => $val['title']);
				if (!empty($val['index'])) {
					$menu_item['index'] = $val['index'];
				}

				if (!empty($val['param'])) {
					$menu_item['param'] = $val['param'];
				}

				if (!empty($val['icon'])) {
					$menu_item['icon'] = $val['icon'];

					if (!empty($val['iconcolor'])) {
						$menu_item['iconcolor'] = $val['iconcolor'];
					}
				}

				if (($top == $menu_item['route']) || ($menu_item['route'] == $route) || (('{$mod}/system/' . $top) == $menu_item['route'])) {
					$menu_item['active'] = 1;
				}

				if ($full) {
					$menu_item['url'] = url("{$mod}/{$menu_item['route']}/index");
				}
				$return_menu[] = $menu_item;
			}
			unset($key);
			unset($val);
			if (!empty($submenu)) {
				$return_submenu['subtitle'] = $submenu['subtitle'];

				if (!empty($submenu['main'])) {
					$return_submenu['route'] = $top;
					if (is_string($submenu['main'])) {
						$return_submenu['route'] .= '.' . $submenu['main'];
					}
				}

				if (!empty($submenu['index'])) {
					$return_submenu['route'] = $top . '.' . $submenu['index'];
				}
				if (!empty($submenu['items'])) {
					foreach ($submenu['items'] as $i => $child) {
						if (!empty($child['top'])) {
							$top = '';
						}
						if (empty($child['items'])) {
							$return_submenu_default = $top . '';
							if (!empty($child['route'])) {
								if (!empty($top)) {
									$route_second .= '';
								}
								$route_second .= $child['route'];
							}
							$return_menu_child = array('title' => $child['title'], 'route' => empty($child['route']) ? $return_submenu_default : $route_second);
							if (!empty($child['param'])) {
								$return_menu_child['param'] = $child['param'];
							}

							if (!empty($child['perm'])) {
								$return_menu_child['perm'] = $child['perm'];
							}

							if (!empty($child['permmust'])) {
								$return_menu_child['permmust'] = $child['permmust'];
							}

							if ($routes[1] == 'system') {
								$return_menu_child['route'] = 'admin/system/' . $return_menu_child['route'];
							}

							$addedit = false;

							if (!$child['route_must']) {
								if ((($return_menu_child['route'] . '/add') == $route) || (($return_menu_child['route'] . '/edit') == $route)) {
									$addedit = true;
								}
							}

							if ($child['route_in'] || strexists($route, $return_menu_child['route'])) {
								$return_menu_child['active'] = 1;
							}

							if ($full) {
								$return_menu_child['url'] = url("{$mod}/{$top}/{$return_menu_child['route']}");
							}

							$return_submenu['items'][] = $return_menu_child;
							unset($return_submenu_default);
							unset($route_second);
						}
						else
						{
							$return_menu_child = array(
								'title' => $child['title'],
								'items' => array()
							);
							foreach ($child['items'] as $ii => $three) {
								$return_submenu_default = $top . '';
								$route_second = 'main';
								if (!empty($child['route'])) {
									$return_submenu_default = $top . '/' . $child['route'];
									$route_second = $child['route'];
								}
								$return_submenu_three = array('title' => $three['title']);
								if (!empty($three['route'])) {
									if (!empty($child['route'])) {
										if (!empty($three['route_ns'])) {
											$return_submenu_three['route'] = $top . '/' . $three['route'];
										}
										else {
											$return_submenu_three['route'] = $top . '/' . $child['route'] . '/' . $three['route'];
										}
									}
									else {
										if (!empty($three['top'])) {
											$return_submenu_three['route'] = $three['route'];
										}
										else {
											$return_submenu_three['route'] = $top . '/' . $three['route'];
										}

										$route_second = $three['route'];
									}
								}
								else {
									$return_submenu_three['route'] = $return_submenu_default;
								}
								if (!empty($three['param'])) {
									$return_submenu_three['param'] = $three['param'];
								}

								if (!empty($three['perm'])) {
									$return_submenu_three['perm'] = $three['perm'];
								}

								if (!empty($three['permmust'])) {
									$return_submenu_three['permmust'] = $three['permmust'];
								}

								// if ($routes[1] == 'system') {
								// 	$return_submenu_three['route'] = '{$mod}/system/' . $return_submenu_three['route'];
								// }
								$addedit = false;

								if (!empty($three['route_must'])) {
									if ((($return_submenu_three['route'] . '/add') == $route) || (($return_submenu_three['route'] . '/edit') == $route)) {
										$addedit = true;
									}
								}
								if (!empty($three['route_in']) || strexists($route, $return_submenu_three['route'])) {
									$return_menu_child['active'] = 1;
									$return_submenu_three['active'] = 1;
								}
								if (!empty($child['extend'])) {
									if ($child['extend'] == $route) {
										$return_menu_child['active'] = 1;
									}
								} else {
									if (!empty($child['extends']) && is_array($child['extends'])) {
										if (in_array($route, $child['extends'])) {
											$return_menu_child['active'] = 1;
										}
									}
								}

								if ($full) {
									$return_submenu_three['url'] = url("{$mod}/{$return_submenu_three['route']}");
								}
								$return_menu_child['items'][] = $return_submenu_three;
							}
							if (!empty($child['items']) && empty($return_menu_child['items'])) {
								continue;
							}

							$return_submenu['items'][] = $return_menu_child;
							unset($ii);
							unset($three);
							unset($route_second);
						}
					}
				}
			}
		}
		
		return array('menu' => $return_menu, 'submenu' => $return_submenu, 'shopmenu' => self::getShopMenu($merch));
	}

	/**
     * 获取 主网站菜单
     * @return array
     */
	public function getShopMenu($merch = 0)
	{
		$return_menu = array();

		if (!$merch) {
			$menus = $this->shopMenu();
		} else {
			$menus = $this->pluginMenu('merch');
		}

		foreach ($menus as $key => $val) {
			$menu_item = array(
				'title' => $val['subtitle'],
				'items' => array()
			);

			if (empty($val['items'])) {
				continue;
			}

			foreach ($val['items'] as $child) {
				$child_route_default = $key;

				if (!empty($child['route'])) {
					$child_route_default = $key . '/' . $child['route'];

					if (!empty($child['top'])) {
						$child_route_default = $child['route'];
					}
				}

				if (empty($child['items'])) {
					$menu_item_child = array('title' => $child['title'], 'route' => $child_route_default);

					if (!empty($child['param'])) {
					}

					$menu_item_child['url'] = url("admin/{$menu_item_child['route']}");
					$menu_item['items'][] = $menu_item_child;
				} else {
					foreach ($child['items'] as $three) {
						$menu_item_three = array('title' => $three['title'], 'route' => empty($three['route']) ? $child_route_default : $child_route_default . '/' . $three['route']);

						if (!empty($three['param'])) {
						}

						$menu_item_three['url'] = url("admin/{$menu_item_three['route']}");
						$menu_item['items'][] = $menu_item_three;
					}
				}
			}

			$return_menu[] = $menu_item;
		}

		return $return_menu;
	}

	/**
     * 定义 网站 菜单
     * @return array
     */
	protected function shopMenu()
	{
		$shopmenu = array(	
			'column'    => array('title' => '栏目', 'subtitle' => '栏目管理', 'icon' => 'statistics'),
			'content'    => array('title' => '内容', 'subtitle' => '内容管理', 'icon' => 'list'),
			'extend'    => array(
				'title'    => '扩展',
				'subtitle' => '扩展管理',
				'icon'     => 'plugins',
				'items'    => array(
					array('title' => '幻灯片管理', 'route' => 'banner'),
					array('title' => '友情链接管理', 'route' => 'link'),
					array('title' => '留言反馈管理', 'route' => 'feedback')
					)
				),
			'sysset'     => array(
				'title'    => '设置',
				'subtitle' => '网站设置',
				'icon'     => 'sysset',
				'items'    => array(
					array(
						'title' => '网站',
						'items' => array(
							array('title' => '基础设置', 'route' => 'index'),
							array('title' => '主题设置', 'route' => 'themes'),
							array('title' => '网站状态', 'route' => 'close'),
							)
						),
					array(
						'title' => '其他',
						'items' => array(
							array('title' => '联系方式', 'route' => 'contact'),
							array('title' => 'SEO设置', 'route' => 'seo'),
							)
						)
					)
				),
			'system'    => array(
				'title'    => '系统',
				'subtitle' => '系统管理',
				'icon'     => 'wangzhan',
				'items'    => array(
					array('title' => '管理员管理', 'route' => 'admin'),
					array('title' => '操作日志', 'route' => 'plog'),
					array(
						'title'    => '权限管理',
						'items'    => array(
							array('title' => '权限管理', 'route' => 'role'),
							array('title' => '权限组', 'route' => 'perm'),
							)
						),
					array(
						'title'    => '常用工具',
						'items'    => array(
							array('title' => '更新缓存', 'route' => 'updatecache'),
							array('title' => '数据库', 'route' => 'database')
							)
						),
					array(
						'title'    => '版权',
						'items'    => array(
							array('title' => '手机端', 'route' => 'copyrightweb'),
							array('title' => '管理端', 'route' => 'copyrightmanage'),
							)
						)
					)
				),
			);

		return $shopmenu;
	}

	/**
     * 获取 系统管理 菜单
     * @return array
     */
	protected function systemMenu()
	{
		return array(
			'user'    => array(
				'title'    => '用户',
				'subtitle' => '用户管理',
				'icon'     => 'member',
				'items'    => array(
					array('title' => '管理员管理', 'route' => 'user'),
					array('title' => '操作日志', 'route' => 'plog'),
					array(
						'title'    => '权限管理',
						'isplugin' => 'grant',
						'items'    => array(
							array('title' => '权限管理', 'route' => 'perm'),
							array('title' => '权限组', 'route' => 'group'),
							)
						)
					)
				),
			'copyright' => array(
				'title'    => '版权',
				'subtitle' => '版权设置',
				'icon'     => 'banquan',
				'items'    => array(
					array('title' => '手机端', 'route' => 'web'),
					array('title' => '管理端', 'route' => 'manage'),
					)
				),
		);
	}

	/**
     * 获取 其他 菜单
     * @return array
     */
	protected function otherMenu()
	{
		return array(
			'perm' => array(
				'title'    => '权限',
				'subtitle' => '权限系统',
				'icon'     => 'store',
				'items'    => array(
					array('title' => '角色管理', 'route' => 'role'),
					array('title' => '操作员管理', 'route' => 'user'),
					array('title' => '操作日志', 'route' => 'log')
				)
			)
		);
	}

	/**
     * 获取 插件 菜单
     * @param array $plugin 要获取的插件标识
     * @return array
     */
	protected function pluginMenu($plugin = '')
	{
		if (empty($plugin)) {
			return array();
		}
		$allmenus = $this->allPluginMenu();
		return isset($allmenus[$plugin]) ? $allmenus[$plugin] : array();
	}

	/**
     * 获取 全部插件 菜单
     * @return array
     */
	protected function allPluginMenu()
	{
		return array(
			'groups' => array(
				'title'    => '团购',
				'subtitle' => '团购管理',
				'icon'     => 'page',
				'extend' => 'admin/plugins/index',
				'items'    => array(
					array('title' => '商品管理', 'route' => 'goods', 'extend' => 'admin/plugins/index'),
					array('title' => '分类管理', 'route' => 'category'),
					array('title' => '幻灯片管理', 'route' => 'banner'),
					array(
						'title'  => '拼团管理',
						'extend' => 'groups/teamdetail',
						'items'  => array(
							array(
								'title' => '拼团成功',
								'route' => 'teamsuccess'
								),
							array(
								'title' => '拼团中',
								'route' => 'teaming'
								),
							array(
								'title' => '拼团失败',
								'route' => 'teamerror'
								),
							array(
								'title' => '全部拼团',
								'route' => 'teamall'
								)
							)
						),
					array(
						'title'  => '订单管理',
						'extend' => 'groups/orderdetail',
						'items'  => array(
							array(
								'title' => '待发货',
								'route' => 'order1'
								),
							array(
								'title' => '待收货',
								'route' => 'order2'
								),
							array(
								'title' => '待付款',
								'route' => 'order3'
								),
							array(
								'title' => '已完成',
								'route' => 'order4'
								),
							array(
								'title' => '已关闭',
								'route' => 'order5'
								),
							array(
								'title' => '全部订单',
								'route' => 'orderall'
								)
							)
						),
					array(
						'title'  => '核销管理',
						'extend' => 'groups/orderdetail',
						'items'  => array(
							array(
								'title' => '未核销',
								'route' => 'verify1'
								),
							array(
								'title' => '已核销',
								'route' => 'verify2'
								),
							array(
								'title' => '已取消',
								'route' => 'verify0'
								)
							)
						),
					// array(
					// 	'title'  => '维权设置',
					// 	'extend' => 'groups.refund.detail',
					// 	'items'  => array(
					// 		array(
					// 			'title' => '维权申请',
					// 			'route' => 'refundapply'
					// 			),
					// 		array(
					// 			'title' => '维权完成',
					// 			'route' => 'refundover'
					// 			)
					// 		)
					// 	),
					array('title' => '评价管理', 'route' => 'comment'),
					array('title' => '基础设置', 'route' => 'set'),
				)
			),
		);
	}

}