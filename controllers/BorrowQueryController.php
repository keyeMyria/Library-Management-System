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



class BorrowQueryController extends Controller
{

	public $defaultPageSize = 5;


	public function actionIndex()
	{

		$session = new Session;
		$borrowQueryModel = new BorrowQuery;
		$connect = Yii::$app->db;
		$pages = null;
		$models = null;


		if ( $get = Yii::$app->request->get() ){
			/*
			 * 查找最近 30 天 借出去但未归还的书籍
			 * 使用 between 字段 borrowBeginTimestamp
			 */


			$borrowQuery = $borrowQueryModel -> borrowQuery( $connect, $get );

			$cloneQuery = clone $borrowQuery;

			$pages = new Pagination([ 'totalCount' => $cloneQuery->count() ]);
			$pages -> defaultPageSize = $this -> defaultPageSize;

			$models = $borrowQuery -> offset( $pages->offset ) -> limit( $pages->limit ) -> all();
		}


		return $this -> render('index', [
			'pages' => $pages,	
			'session' => $session,
			'models'  => $models,
		]);	

	
	}





}















?>
