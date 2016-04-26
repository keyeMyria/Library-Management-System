<?php

/*
 * IndexController: 管理员登陆验证、 图书馆管理系统的主页展示
 */



namespace app\controllers;

use yii\web\Controller;
use Yii;
use yii\web\User;
use yii\web\Session;

use app\models\Manager;
use app\models\Index;



class IndexController extends Controller
{

	
	/*
	 * 作用: 展示管理员登陆的界面 与 接收管理员登陆的信息
	 */
	public function actionIndex()
	{

		$user    = Yii::$app->user; 
		$session = Yii::$app->session;
		$session -> open();
		
		if( $identity = $user -> identity ){
			
			return $this->render('index', [
				
				'model'	   => $identity,
				'session'  => $session,
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
					return $this->goHome();

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
	 * 用户登出 
	 * @return 返回路由 index/login (登录页)
	 */
	public function actionLogout()
	{
		$user =	Yii::$app->user;	
		if ( $user -> identity) {
			$user -> logout();	
			return $this -> redirect(['index/login']);
		}
	}
	


	public function actionTest()
	{
	}





}
