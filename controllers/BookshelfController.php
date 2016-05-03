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


	# 新增条目成功时, 提示的内容
	public $addTipContent = '添加成功';


	# 删除条目成功时, 提示的内容
	public $delTipContent = '删除成功';


	# 更新条目成功时, 提示的内容
	public $updateTipContent = '更新成功';

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
			$model   = new Bookshelf;
			$query   = (new Query) 
				-> select(['PK_bookshelfID', 'bookshelfName']) 
				-> orderBy('PK_bookshelfID DESC') 
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
			$session['tipContent'] = $this -> addTipContent;
			$session['isShowTip' ] = true;

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
				$session['tipContent'] = $this -> delTipContent;
				$session['isShowTip' ] = true;

				$bookshelf -> delete();	
				return $this->redirect(['index']);
			}
		}
	}



	/**
	 * 书架名称修改 , 当 get 数据中有id的话，就表明是从 bookshelf的 index 页过来的，如果 是post提交，就表明已经做出了修改，把修改保存回数据库，并跳转回 bookshelf 的 index.
	 *
	 */
	public function actionUpdateBookshelf()
	{
		$session = Yii::$app->session;
		$request = Yii::$app->request;

		if ( $post = $request->post() ) {

			$bookshelf = Bookshelf::findOne( $post['id'] ); 
			$bookshelf -> bookshelfName = $post['Bookshelf']['bookshelfName'];

			if( $bookshelf -> save() ){
				$session['tipContent'] = $this -> updateTipContent;
				$session['isShowTip' ] = true;			 	
				return $this->redirect(['bookshelf/index']);
			}

		} elseif ( $id = $request->get('id') ){

			$bookshelfModel = new Bookshelf;
			$bookshelf      = Bookshelf::findOne( $id );		

			return $this->render( 'update', [
				'model' => $bookshelfModel,	
				'data'  => $bookshelf,
			]);
		} 
		


	}


}
