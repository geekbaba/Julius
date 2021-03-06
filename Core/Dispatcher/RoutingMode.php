<?php
/**
 * Routing Mode
 *
 * @author      Jianghao <geekbaba.j@gmail.com>
 * @date 2013-11-27 下午9:29:34
 * @version 1.0.0
 * @copyright  Copyright 2012 Joincoding Technolcgies Co.,Ltd.
 */
class RoutingMode extends JObject{
	
	
	/**
	 * 路由方法
	 *
	 * @date 2013-11-27下午2:30:01
	 * @version 1.0.0
	 */
	public function dispatch(){
		
			
			if(isset($_GET['m'])&&isset($_GET['c'])){
				//Security
				$action = $_GET['m'];
				$controller = 'Controller_'.$_GET['c'];
				$view = 'View_'.$_GET['c'];
			}else{
				//是否设置默认页面
				if(defined('DEFAULT_INDEX')&&defined('DEFAULT_ACTION')){
					$controller = 'Controller_'.DEFAULT_INDEX;
					$action = DEFAULT_ACTION;
					$view = 'View_'.$controller;
				}else{
					$controller = 'Controller_Index';
					$action = 'index';
					$view = 'View_Index';
				}
			}
			
			$controller = new $controller();
			//echo $view;
			$controller->setView(new $view());
			$controller->$action();
				
	}
	
	/**
	 * 检查当前模式下的路由规则是否正确
	 * 
	 * @return RouteStatus
	 * @date 2013-11-28下午2:58:01
	 * @version 1.0.0
	 */
	public function routeCheck() {
		if(isset($_GET['m']) && isset($_GET['c']) && (!isset($_SERVER["argv"]))){
			if(''!=$_GET['m']&&''!=$_GET['c']){
				return RouteStatus::ROUTE_OK;
			}else{
				return RouteStatus::ROUTE_FAIELD;
			}
		}else if(isset($_SERVER['argv'])){
			return RouteStatus::ROUTE_SKIP;
		}else{
			return RouteStatus::ROUTE_OK;
		}
	}
}