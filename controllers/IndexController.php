<?php

/*
 * IndexController: 管理员登陆验证、 图书馆管理系统的主页展示
 */



namespace app\controllers;

use yii\web\Controller;
use Yii;
use yii\web\User;

use app\models\Manager;
use app\models\Index;



class IndexController extends Controller
{

	/*
	 * 作用: 展示管理员登陆的界面 与 接收管理员登陆的信息
	 */
	public function actionIndex()
	{

		if( $identity = Yii::$app->user->identity ){
			
			$indexModel = new Index;
			// @boolean $tip 指代 view层中是否出现 "登陆成功" 的提示框, true/false
			$indexModel -> prevIsLogin() ? $tip = true : $tip = false;

			return $this->render('index', [
				
				'model' => $identity,
				'tip'   => $tip,	
			]);					
		
		}
		
		
	}

	public function actionLogin()
	{
		
		if( $post = Yii::$app->request->post() ){
			
			$username = $post['Manager']['managerUsername'];
			$password = md5( $post['Manager']['managerPassword'] );
			 

			// 验证用户提交的用户名与密码 是否匹配数据库中的。
			$identity = Manager::findOne([
				'managerUsername' => $username,
				'managerPassword' => $password
		   	]);

			if ( $identity ){
				
				$user = Yii::$app->user; // user 组件

				if( $user->login( $identity) ){
					
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
