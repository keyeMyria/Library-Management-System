<?php

/**
 * 参数设置　> 书架管理 , 负责管理现实图书馆中的书架类型.
 */

namespace app\controllers;

use yii\web\Controller;
use Yii;
use yii\db\Query;
use yii\data\Pagination;
use yii\web\Session;

use app\models\Bookshelf;


class BookshelfController extends Controller
{

	/**
	 * 定义一页能显示多少条数据
	 */
	public $defaultPageSize = 10;




	/**
	 * 展现 参数设置 > 书架管理 的 Index 页面, 
	 * 因为该 Index 页面中有集成了 添加书架的功能，因此在此方法内是需要判断有无 POST 
	 * 数据提交，若有 那就是 添加书架，若没有POST提交 那就是展示书架的数据
	 */
	public function actionIndex()
	{
		$request = Yii::$app->request;
		if ( $post = $request -> post() ){

			$this -> actionAddBookshelf( $post );

		} else {

			$session = new Session;

			$model = new Bookshelf;

			$query = (new Query) 
				-> select(['PK_bookshelfID', 'bookshelfName']) 
				-> orderBy('PK_bookshelfID DESC') 
				-> from('lib_bookshelf');
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


	/**
	 * 负责添加 书架名称 
	 * @param $post array 存放着用户提交过来的新增书架的名称
	 */
	public function actionAddBookshelf( $post )
	{
		$bookshelfModel = new Bookshelf;
		$bookshelfModel -> bookshelfName = $post['Bookshelf']['bookshelfName'];

		if( $bookshelfModel -> save() ){
			$session = new Session;
			$session['isShowTip'] = true;

			return $this->redirect(['index']);
		}
	}




	/**
	 * 书架名称删除
	 */
	public function actionDelBookshelf()
	{
		if ( $id = Yii::$app->request->get('id')	){
			if ( $bookshelf = Bookshelf::findOne( $id ) ){

				$session = new Session;	
				$session['isShowTip'] = true;

				$bookshelf -> delete();	
				return $this->redirect(['index']);
			}
		}
	}

}
