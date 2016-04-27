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
	 * 展示主页
	 */
	public function actionIndex()
	{
		return $this->renderPartial('index');	
	}


	public function actionTop()
	{
		return $this->render('top');	
	}


	public function actionLeft()
	{
		return $this->render('left');	
	}

	public function actionRight()
	{
		return $this->render('right');	
	}
}











?>
