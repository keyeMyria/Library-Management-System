<?php

namespace app\controllers;

use yii\web\Controller;
use yii\web\Session;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use Yii;


use app\models\BookSreach;

class BookSreachController extends Controller
{
	public $defaultPageSize = 5;

	
	public $defaultAction = 'sreach';
	/**
	 * 图书搜索
	 */
	public function actionSreach()
	{
		$session = new Session;
		$sreachTypeArr = [
			'bookName'  => '按书名',	
			'bookISBN'  => '按ISBN',	
			'publisher' => '按出版社',
			'author'    => '按作者',
			'bookshelf' => '按书架',
		];

		if ( $post = Yii::$app->request->post()){
			

			$sreachText = $post['sreachText'];
			$bookSreachModel = new BookSreach;

			if( empty( $post['sreachText'])){
				
				$session['isShowTip']  = true;					
				$session['tipContent'] = '请输入要搜索的内容';

				$sreachResult     = null;
				$sreachResultInfo = null;

			} else {

				$session['isShowTip'] = false;

				$sreachResult       = $bookSreachModel -> bookSreach( $post );
				#$sreachResultInfo  = $bookSreachModel -> getSreachResultInfo();
				
					
				$cloneQuery = clone $sreachResult;

				$pages = new Pagination(['totalCount' => $cloneQuery->count() ] );
				$pages -> defaultPageSize = $this -> defaultPageSize;

				
				$models = $sreachResult -> offset( $pages->offset ) -> limit( $pages->limit ) -> all();


				



			}

			return $this -> render('index', [
				'pages' => $pages,
				'models' => $models,
				'session'          => $session,
				'sreachType'       => $sreachTypeArr,	
				'sreachText'       => $sreachText,
				'sreachResult'     => $sreachResult,	
				#'sreachResultInfo' => $sreachResultInfo,
			]);

		} else {
			
			// 第一次进入 图书搜索页面		
			$session['isShowTip'] = false;
			
			return $this -> render('index', [
				'session'    => $session,
				'sreachType' => $sreachTypeArr,	
			
			]);	
		}	
	
	
	}

}
