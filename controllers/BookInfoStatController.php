<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\db\Query;


use app\models\Bookshelf;
use app\models\BookRelationship;

class BookInfoStatController extends Controller
{

	public $defaultAction = 'two-pie';


	/*
	 * 双饼图，分内圈 和 外圈.
	 *		内圈： 是分出大类，比如书架的 小说区 、计算机区
	 *		外圈： 是这些大类里面的子类， 比如 小说区里面的 （情感小说、恐怖小说 等等）
	 *
	 */
	public function actionTwoPie()
	{

		$connect = Yii::$app->db;

		// 图书总数
		$bookRelsCount = BookRelationship::find()->count();

		$bookshelfIDSql = "SELECT FK_bookshelfID FROM lib_bookRelationship GROUP BY FK_bookshelfID";
		$bookshelfIDArr = $connect -> createCommand( $bookshelfIDSql ) -> queryAll(); 

		foreach ( $bookshelfIDArr as $key => $value ) {
			/* 思路：
					在 lib_bookRelationship 中使用 GROUP BY FK_bookshelfID 得到 不重复的 bookshelfID  	
					然后循环 这个 bookshelfID, 去 lib_bookRelationship 找，找个这个 书架大分类下的小分类
					的名称 和 占比。
			 */	

			// 书架大分类 ID
			$bookshelfID =  $bookshelfIDArr[$key]['FK_bookshelfID'];

			$sql = " SELECT count(*) AS count, bookTypeName, bookshelfName  
						FROM lib_bookRelationship JOIN lib_bookType JOIN lib_bookshelf 
						ON FK_bookTypeID = PK_bookTypeID AND FK_bookshelfID = PK_bookshelfID   
						WHERE FK_bookshelfID = $bookshelfID 
						GROUP BY FK_bookTypeID;";
			
			$classifyCount = $connect -> createCommand( $sql ) -> queryAll(); 


			foreach( $classifyCount  as $key => $value ){
				// 循环出每个图书分类 在 图书总数 中的占比
				$classifyPercent[ $key ]['percent'] = round( $classifyCount[ $key ]['count'] / $bookRelsCount * 100 , 2 );
				$classifyPercent[ $key ]['bookTypeName'] = $classifyCount[ $key ]['bookTypeName'];
			}


			$bookshelfPercent['bookshelfPercent'] = 0;

			// 书架大分类 的 书架名称
			$bookshelfPercent['bookshelfName'] = $classifyCount[0]['bookshelfName'];

			// 将书架 归属于 此书架的子分类的 名称 和 占比 存入
			$bookshelfPercent['subClass'] = $classifyPercent;

			foreach ( $classifyPercent as $key => $value ){
				// 通过 大分类 书架区 下面的 子分类 的占比 ， 进行相加，得出整个 大分类 在图书总数中的占比
				$bookshelfPercent['bookshelfPercent'] = $bookshelfPercent['bookshelfPercent'] + $classifyPercent[ $key ]['percent']; 
			}

			unset( $classifyPercent );
			$data[] = $bookshelfPercent;
		}

		#dump( $data );exit;
		$json = json_encode( $data );
		return $this->render('index', [
			'data' => $json,	
		]);
	}
	



}

























?>
