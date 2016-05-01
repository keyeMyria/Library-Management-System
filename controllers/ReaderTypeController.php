<?php

namespace app\controllers;

use yii\web\Controller;

use app\models\ReaderType;



class ReaderTypeController extends Controller
{

	
	public function actionIndex()
	{
		$readerTypeModel = new ReaderType;		
		return $this->render('index', [
			'model' => $readerTypeModel,	
		]);	
	}

}












?>
