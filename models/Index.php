<?php


/**
 * 本模型不关联任何数据表。
 * 本模型负责处理与 IndexController 的功能
 */

namespace app\models;

use yii\base\Model;


class Index extends Model
{

	/**
	 * prev is login 负责判断来到路由 index/index 之前的页面是否是路由 index/login
	 *				(意为:是不是经过登陆后才来到首页的))
	 *	@return boolean  
	 */
	public function prevIsLogin()
	{
		$loginUrl = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] . '?r=index/login';
		$prevUrl = isset( $_SERVER['HTTP_REFERER'] ) ? $_SERVER['HTTP_REFERER'] : false;

		if ( $prevUrl === $loginUrl ){
			return true;	
		} else {
			return false;	
		}
	}


}

