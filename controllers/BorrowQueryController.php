<?php

/**
 * 图书借阅查询模块
 *
 */

namespace app\controllers;

use yii\web\Controller;
use yii\web\Session;
use yii\data\Pagination;
use Yii;

use app\models\BorrowQuery;
use app\models\BookInfo;



class BorrowQueryController extends Controller
{

	public $defaultPageSize = 5;
	public $defaultPageSize_large = 8;


	public function actionIndex()
	{

		$session          = new Session;
		$bookInfoModel    = new BookInfo;
		$borrowQueryModel = new BorrowQuery;

		$connect = Yii::$app->db;

		$pages        = null;
		$models       = null;
		$pages_large  = null;
		$models_large = null;



		if ( $get = Yii::$app->request->get() ){

			$borrowQuery = $borrowQueryModel -> borrowQuery( $connect, $get );

			$cloneQuery = clone $borrowQuery;

			$pages = new Pagination([ 'totalCount' => $cloneQuery->count() ]);
			$pages -> defaultPageSize = $this -> defaultPageSize;

			$models = $borrowQuery -> offset( $pages->offset ) -> limit( $pages->limit ) -> all();
			
			$models = $bookInfoModel -> cutBookName( $models , 30 );

			// 大屏显示 的数据
			$pages_large = new Pagination([ 'totalCount' => $cloneQuery->count() ]);
			$pages_large -> defaultPageSize = $this -> defaultPageSize_large;

			$models_large = $borrowQuery -> offset( $pages_large->offset ) -> limit( $pages_large->limit ) -> all();
			
			$models_large = $bookInfoModel -> cutBookName( $models_large , 30 );
		}


		return $this -> render('index', [
			'pages'         => $pages,	
			'session'       => $session,
			'models'        => $models,
			'pages_large'   => $pages_large,	
			'models_large'  => $models_large,
		]);	

	
	}





}















?>
