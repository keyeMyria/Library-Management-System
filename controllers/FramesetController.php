<?php


/**
 * FramesetController  html <frameset> 框架控制器
 * 负责把页面分为三部分: top \ left \ right
 *
 */

namespace app\controllers;

use yii\web\Controller;
use Yii;



class FramesetController extends Controller
{


	/**
	 * 展示主页 ( 有登陆的身份标示才显示 Index, 没有身份标示说明未登陆,
	 * 则跳回 index/login )
	 */
	public function actionIndex()
	{
		if( Yii::$app->user->identity ) {
			return $this->renderPartial('index');	
		} else {
			return $this->redirect(['index/login']);	
		}
	}


	public function actionTop()
	{
		$model = Yii::$app->user->identity;	
		return $this->render('top', [ 'model' => $model ]);	
		
	}


	public function actionLeft()
	{
		return $this->render('left');	
	}

}











?>
