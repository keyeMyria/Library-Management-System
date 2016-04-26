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
	 * @boolean  true 代表登陆后第一次进入主页,  false 代表只是在主页刷新而已. 
	 *			在主页中根据此变量, true 展示 "登陆成功" 的提示框, false 反之.
	 */

	
	/*
	 * 作用: 展示管理员登陆的界面 与 接收管理员登陆的信息
	 */
	public function actionIndex()
	{

		$user    = Yii::$app->user; 
		$session = Yii::$app->session;
		$session -> open();

		
		if( $identity = $user -> identity ){
			
			$indexModel = new Index;

			return $this->render('index', [
				
				'model'		   => $identity,
				'session'	   => $session,
			]);					
		
		}
		
		
	}

	public function actionLogin()
	{
		
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
					$this->goHome();

				} else {
					echo "用户名或密码正确，但登陆失败";	
				}	

			} else {
				echo "用户名或密码错误！";	
			}



			
		

		} else {

			$managerModel = new Manager;	
			return $this->render('login', ['model' => $managerModel ]);	
		}
	
	}



	public function actionTest()
	{

	}




}
