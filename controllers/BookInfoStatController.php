<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\db\Query;

use app\models\Bookshelf;
use app\models\BookRelationship;

class BookInfoStatController extends Controller
{

	public function actionIndex()
	{
		$bookshelfData = Bookshelf::find()->asArray()->all();
		$bookRelsCount = BookRelationship::find()->count();

		$index = 0;
		foreach ( $bookshelfData as $key => $value ){
			// $arr[ 书架id ] => [ 该书架内的图书总数 ]
			$bookshelfCount[ $index ]['count'] = BookRelationship::find()->where( ['FK_bookshelfID' => $bookshelfData[$key]['PK_bookshelfID']] )->count() ;	
			$bookshelfCount[ $index ]['name']  = $bookshelfData[$key]['bookshelfName'];	
			
			$index = $index + 1;
		}



		foreach( $bookshelfCount as $key => $value ){
			// 计算每个书架的书的数量在 整个图书馆 中 占比多少
			$bookshelfCount[$key]['count'] = $bookshelfCount[$key]['count'] / $bookRelsCount * 100;
		}
	
		$json = json_encode( $bookshelfCount );
		return $this->render('index', [
			'data' => $json,	
		]);
	}



}

























?>
