<?php

/**
 * 图书添加功能
 *
 */

namespace app\controllers;

use yii\web\Controller;
use yii\web\Session;
use Yii;

use app\models\BookType;
use app\models\Publisher;
use app\models\Bookshelf;
use app\models\BookAdd;

class BookAddController extends Controller
{

	public function actionBookAdd()
	{
		if ( $post = Yii::$app->request->post() ){
		
		
		} else {

			$data = $this -> combineDropDownListData();	



			$model = new BookAdd;
			$session = new Session;	
			$session['isShowTip'] = false;
			return $this->render('index', [
				'session' => $session,
				'bookTypeData' => $data[0],
				'publisherData' => $data[1],
				'bookshelfData' => $data[2],
				'model' => $model,	

			]);	
		
		}
	}



	public function combineDropDownListData()
	{
	
		$bookType  =  BookType::find()-> asArray() ->all();
		$publisher = Publisher::find()-> asArray() ->all();
		$bookshelf = Bookshelf::find()-> asArray() ->all();
	
		foreach ( $bookType as $key => $value ){
			$bookTypeData[ $bookType[$key]['PK_bookTypeID'] ] = $bookType[$key]['bookTypeName'];
		}
	
		foreach ( $publisher as $key => $value ){
			$publisherData[ $publisher[$key]['PK_publisherID'] ] = $publisher[$key]['publisherName'];
		}

		foreach ( $bookshelf as $key => $value ){
			$bookshelfData[ $bookshelf[$key]['PK_bookshelfID'] ] = $bookshelf[$key]['bookshelfName'];
		}

		$data[] = $bookTypeData;
		$data[] = $publisherData;
		$data[] = $bookshelfData;
		return   $data;
	}

}
