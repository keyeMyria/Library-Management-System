<?php

/**
 * 参数设置　> 书架管理 , 负责管理现实图书馆中的书架类型.
 */

namespace app\controllers;

use yii\web\Controller;
use Yii;
use yii\db\Query;
use yii\data\Pagination;

use app\models\Bookshelf;


class BookshelfController extends Controller
{

	/**
	 * 定义一页能显示多少条数据
	 */
	public $defaultPageSize = 10;



	/**
	 * 展现 参数设置 > 书架管理 的 Index 页面
	 */
	public function actionIndex()
	{
		$request = Yii::$app->request;
		if ( $post = $request -> post() ){

			$this -> actionAddBookshelf( $post );

		} else {

			$model = new Bookshelf;

			$query = (new \yii\db\Query) 
				-> select(['PK_bookshelfID', 'bookshelfName']) 
				-> orderBy('PK_bookshelfID DESC') 
				-> from('lib_bookshelf');
			#$data = $query->all();	
			#dump( $data );exit;
			#$query = Bookshelf::find();
			$cloneQuery = clone $query;

		
			$pages = new Pagination(['totalCount' => $cloneQuery->count() ]);
			$pages -> defaultPageSize =  $this -> defaultPageSize;
			$data = $query -> offset( $pages->offset ) 
						   -> limit( $pages->limit ) 
					       -> all();


			return $this->render('index', [
				'model' => $model,
				'data'  => $data,
				'pages' => $pages,
			]);		
		}
	}	


	/**
	 * 负责添加 书架名称 
	 * @param $post array 存放着用户提交过来的新增书架的名称
	 */
	public function actionAddBookshelf( $post )
	{
		$bookshelfModel = new Bookshelf;
		$bookshelfModel -> bookshelfName = $post['Bookshelf']['bookshelfName'];

		if( $bookshelfModel -> save() ){
			return $this->redirect(['index']);
		}
	}

}
