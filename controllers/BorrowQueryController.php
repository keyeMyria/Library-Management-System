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


	public function actionIndex()
	{

		$session          = new Session;
		$bookInfoModel    = new BookInfo;
		$borrowQueryModel = new BorrowQuery;
		$connect = Yii::$app->db;
		$pages = null;
		$models = null;


		if ( $get = Yii::$app->request->get() ){

			$borrowQuery = $borrowQueryModel -> borrowQuery( $connect, $get );

			$cloneQuery = clone $borrowQuery;

			$pages = new Pagination([ 'totalCount' => $cloneQuery->count() ]);
			$pages -> defaultPageSize = $this -> defaultPageSize;

			$models = $borrowQuery -> offset( $pages->offset ) -> limit( $pages->limit ) -> all();
			
			$models = $bookInfoModel -> cutBookName( $models , 30 );

		}


		return $this -> render('index', [
			'pages' => $pages,	
			'session' => $session,
			'models'  => $models,
		]);	

	
	}





}















?>
