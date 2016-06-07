<?php

/**
 * 参数设置　> 出版社管理 , 负责管理出版社名称.
 */

namespace app\controllers;

use yii\web\Controller;
use Yii;
use yii\db\Query;
use yii\data\Pagination;
use yii\web\Session;

use app\models\Publisher;


class PublisherController extends Controller
{

	/**
	 * 定义一页能显示多少条数据
	 */
	public $defaultPageSize = 10;
	public $defaultPageSize_large = 16;


	# 新增条目成功时, 提示的内容
	public $addTipContent = '添加成功';


	# 删除条目成功时, 提示的内容
	public $delTipContent = '删除成功';


	# 更新条目成功时, 提示的内容
	public $updateTipContent = '更新成功';

	/**
	 * 展现 参数设置 > 出版社管理 的 Index 页面, 
	 */
	public function actionIndex()
	{
		$request = Yii::$app->request;
		if ( $post = $request -> post() ){

			$this -> actionAddPublisher( $post );

		} else {

			$session = new Session;
			$model   = new Publisher;
			$query   = (new Query) 
				-> select(['PK_publisherID', 'publisherName']) 
				-> orderBy('PK_publisherID DESC') 
				-> from( $model -> tableName() );
			 
			$cloneQuery = clone $query;
		
			$pages = new Pagination(['totalCount' => $cloneQuery->count() ]);
			$pages -> defaultPageSize =  $this -> defaultPageSize;
			$data = $query -> offset( $pages->offset ) 
						   -> limit( $pages->limit ) 
					       -> all();

			$pages_large = new Pagination(['totalCount' => $cloneQuery->count() ]);
			$pages_large -> defaultPageSize =  $this -> defaultPageSize_large;
			$data_large = $query -> offset( $pages_large->offset ) 
						   -> limit( $pages_large->limit ) 
					       -> all();

			return $this->render('index', [
				'model'			=> $model,
				'data'			=> $data,
				'pages'			=> $pages,
				'data_large'	=> $data_large,
				'pages_large'	=> $pages_large,
				'session'		=> $session,

			]);		
		}
	}	


	/**
	 * 负责添加 出版社名称 
	 * @param $post array 存放着用户提交过来的新增出版社的名称
	 */
	public function actionAddPublisher( $post )
	{
		$publisherModel = new Publisher;
		$publisherModel -> publisherName = $post['Publisher']['publisherName'];

		if( $publisherModel -> save() ){
			$session = new Session;
			$session['tipContent'] = $this -> addTipContent;
			$session['isShowTip' ] = true;

			return $this->redirect(['index']);
		}
	}




	/**
	 * 出版社名称删除
	 */
	public function actionDelPublisher()
	{
		if ( $id = Yii::$app->request->get('id')	){
			if ( $publisher = Publisher::findOne( $id ) ){

				$session = new Session;	
				$session['tipContent'] = $this -> delTipContent;
				$session['isShowTip' ] = true;

				$publisher -> delete();	
				return $this->redirect(['index']);
			}
		}
	}



	/**
	 * 出版社名称修改
	 */
	public function actionUpdatePublisher()
	{
		$session = Yii::$app->session;
		$request = Yii::$app->request;

		if ( $post = $request->post() ) {

			$publisher = Publisher::findOne( $post['id'] ); 
			$publisher -> publisherName = $post['Publisher']['publisherName'];

			if( $publisher -> save() ){
				$session['tipContent'] = $this -> updateTipContent;
				$session['isShowTip' ] = true;			 	
				return $this->redirect(['publisher/index']);
			}

		} elseif ( $id = $request->get('id') ){

			$publisherModel = new Publisher;
			$publisher      = Publisher::findOne( $id );		

			return $this->render( 'update', [
				'model' => $publisherModel,	
				'data'  => $publisher,
			]);
		} 
		


	}


}
