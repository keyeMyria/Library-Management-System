<?php

/*
 * IndexController: 管理员登陆验证、用户注销、 图书馆管理系统的主页展示
 */



namespace app\controllers;

use yii\web\Controller;
use Yii;
use yii\web\User;
use yii\web\Session;
use yii\helpers\Url;

use app\models\Manager;
use app\models\Index;
use app\models\ParseUserAgent;



class IndexController extends Controller
{

	
	/*
	 * 作用: 展示管理员登陆的界面 与 接收管理员登陆的信息
	 */
	public function actionIndex()
	{

		$userAgentParse = new ParseUserAgent;
		$userAgentData  = $userAgentParse -> parse_user_agent();

		$user    = Yii::$app->user; 
		$session = Yii::$app->session;
		$session -> open();
		
		if( $identity = $user -> identity ){
			
			return $this->render('index', [
				
				'model'	    => $identity,
				'session'   => $session,
				'userAgent' => $userAgentData,
			]);					
		} 
				
	
	}


	/**
	 * 用户登录模块, 输入正确跳转到路由 index/index, 输入错误就跳转本页并给出提示框.
	 * @return  goHome() | render('login')
	 */
	public function actionLogin()
	{
		
		$managerModel = new Manager;	

		if( $post = Yii::$app->request->post() ){
			
			$username =      $post['Manager']['managerUsername'];
			$password = md5( $post['Manager']['managerPassword'] );
			 

			// 验证用户提交的用户名与密码 是否匹配数据库中的。
			$identity = Manager::findOne([
				'managerUsername' => $username,
				'managerPassword' => $password,
		   	]);

			if ( $identity ){
				
				$user    = Yii::$app->user;    // user 组件
				$session = Yii::$app->session; // session 组件

				if( $user->login( $identity) ){
					
					$session['isFirstLogin'] = true;
					return $this->redirect(['frameset/index']);

				} else {
					$tipText = '登陆失败';	
				}	

			} else {
				$tipText = '用户名或密码错误,请重新输入';	
			}


			return $this->render( 'login', [
				'model'   => $managerModel, 
				'tipText' => $tipText,			
			]);

		} else {

			return $this->render('login', ['model' => $managerModel ]);	
		}
	}


	/**
	 * 用户登出 (注销)
	 * @return 返回路由 index/login (登录页)
	 */
	public function actionLogout()
	{
		$user =	Yii::$app->user;	
		if ( $user -> identity) {
			$user -> logout();	

			/**
			 * 用 js 的 top.location.href 去跳转, 而不是用 $this->redirect()，这样做
			 * 的原因是：这个有 "登出" 按钮的页面, 是 frameset 框架中的 right 部分, 
			 * 如果用了后者, 那么这个跳转还是在 right 部分内, 也就是说 你在　right 部分按了 "登出" 按钮
			 * 但 frameset 内的　top \ left 部分还是在的。
			 * 但如果你用的是前者, 他就是跳回一个完整的用户登陆页面.
			 */
			$url = Url::toRoute(['index/login']);
			echo "<script>  top.location.href =	'$url'; </script>";
		}
	}	

}
