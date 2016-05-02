<?php

namespace app\controllers;

use yii\web\Controller;
use yii\web\Session;
use yii\db\Query;
use yii\data\Pagination;
use Yii;

use app\models\ReaderType;



class ReaderTypeController extends Controller
{

	public $defaultPageSize = 10;
	
	public function actionIndex()
	{
		$request = Yii::$app->request;
		if ( $post = $request -> post() ){


			$this -> actionAddReaderType( $post );

		} else {

			$session = new Session;
			$model   = new ReaderType;
			$query  = (new Query) 
				-> select(['PK_readerTypeID', 'readerTypeName', 'readerTypeBorrowNumber']) 
				-> orderBy('PK_readerTypeID DESC') 
				-> from( $model -> tableName() );
			$cloneQuery = clone $query;
		
			$pages = new Pagination(['totalCount' => $cloneQuery->count() ]);
			$pages -> defaultPageSize =  $this -> defaultPageSize;
			$data = $query -> offset( $pages->offset ) 
						   -> limit( $pages->limit ) 
					       -> all();

			return $this->render('index', [
				'model'		=> $model,
				'data'		=> $data,
				'pages'		=> $pages,
				'session'   => $session,

			]);		
		}
	}



	public function actionAddReaderType( $post )
	{
		$ReaderTypeModel = new ReaderType;
		#$ReaderTypeModel -> bookshelfName = $post['Bookshelf']['bookshelfName'];
		$ReaderTypeModel -> readerTypeName = $post['ReaderType']['readerTypeName'];		
		$ReaderTypeModel -> readerTypeBorrowNumber = $post['ReaderType']['readerTypeBorrowNumber'];		
	
		$res = ReaderType::find()->where( ['readerTypeName' => $post['ReaderType']['readerTypeName'] ] ) -> one();
		if( !empty($res) ){
			// 输入的 读者类型名称 已存在
			// 那就给个 tip 说明，并返回 index
			dump( $res );exit;
		}

	
		xit;
		if( $ReaderTypeModel -> save() ){
			$session = new Session;
			$session['isShowTip'] = true;

			return $this->redirect(['index']);
		}
	}






















































































































}












?>
