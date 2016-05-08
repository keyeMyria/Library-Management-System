<?php

namespace app\controllers;

use yii\web\Controller;
use Yii;


use app\models\BookSreach;

class BookSreachController extends Controller
{
	
	
	public function actionSreach()
	{
		$sreachTypeArr = [
			'bookName'  => '按书名',	
			'bookISBN'  => '按ISBN',	
			'publisher' => '按出版社',
			'author'    => '按作者',
			'bookshelf' => '按书架',
		];

		if ( $post = Yii::$app->request->post()){
								
			$bookSreachModel = new BookSreach;
			$sreachResult = $bookSreachModel -> bookSreach( $post );

			return $this -> render('index', [
				'sreachType' => $sreachTypeArr,	
				'sreachResult' => $sreachResult,	
			]);
		} else {
		
			return $this -> render('index', [
				'sreachType' => $sreachTypeArr,	
			
			]);	
		}	
	
	
	}

}
