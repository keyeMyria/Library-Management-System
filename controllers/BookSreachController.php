<?php

namespace app\controllers;

use yii\web\Controller;
use Yii;



class BookSreachController extends Controller
{
	
	
	public function actionSreach()
	{
		if ( $post = Yii::$app->request->post()){
								
			dump( $post );exit;
		} else {

			$sreachTypeArr = [
				'bookName'  => '按书名',	
				'bookISBN'  => '按ISBN',	
				'publisher' => '按出版社',
				'author'    => '按作者',
				'bookshelf' => '按书架',
			];
		
			return $this -> render('index', [
				'sreachType' => $sreachTypeArr,	
			
			]);	
		}	
	
	
	}

}
