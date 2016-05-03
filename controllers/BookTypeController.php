<?php

/**
 * 参数设置　> 图书类型管理 , 负责管理现实图书馆中的图书类型类型.
 */

namespace app\controllers;

use yii\web\Controller;
use Yii;
use yii\db\Query;
use yii\data\Pagination;
use yii\web\Session;

use app\models\BookType;


class BookTypeController extends Controller
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
	 * 展现 参数设置 > 图书类型管理 的 Index 页面, 
	 * 因为该 Index 页面中有集成了 添加图书类型的功能，因此在此方法内是需要判断有无 POST 
	 * 数据提交，若有 那就是 添加图书类型，若没有POST提交 那就是展示图书类型的数据 */

	public function actionIndex()
	{

		$request = Yii::$app->request;
		if ( $post = $request -> post() ){

			$this -> actionAddBookType( $post );

		} else {

			$session = new Session;
			$model   = new BookType;
			$query   = (new Query) 
				-> select(['PK_bookTypeID', 'bookTypeName']) 
				-> orderBy('PK_bookTypeID DESC') 
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
	 * 负责添加 图书类型名称 
	 * @param $post array 存放着用户提交过来的新增图书类型的名称
	 */
	public function actionAddBookType( $post )
	{

		$bookTypeModel = new BookType;
		$bookTypeModel -> bookTypeName = $post['bookType']['bookTypeName'];

		if( $bookTypeModel -> save() ){
			$session = new Session;
			$session['tipContent'] = $this -> addTipContent;
			$session['isShowTip' ] = true;

			return $this->redirect(['index']);
		}
	}




	/**
	 * 图书类型名称删除
	 */
	public function actionDelBookType()
	{
		if ( $id = Yii::$app->request->get('id')	){
			if ( $bookType = BookType::findOne( $id ) ){

				$session = new Session;	
				$session['tipContent'] = $this -> delTipContent;
				$session['isShowTip' ] = true;

				$bookType -> delete();	
				return $this->redirect(['index']);
			}
		}
	}



	/**
	 * 图书类型名称修改 , 当 get 数据中有id的话，就表明是从 bookType的 index 页过来的，如果 是post提交，就表明已经做出了修改，把修改保存回数据库，并跳转回 bookType 的 index.
	 *
	 */
	public function actionUpdateBookType()
	{
		$session = Yii::$app->session;
		$request = Yii::$app->request;

		if ( $post = $request->post() ) {

			$bookType = BookType::findOne( $post['id'] ); 
			$bookType -> bookTypeName = $post['bookType']['bookTypeName'];

			if( $bookType -> save() ){
				$session['tipContent'] = $this -> updateTipContent;
				$session['isShowTip' ] = true;			 	
				return $this->redirect(['book-type/index']);
			}

		} elseif ( $id = $request->get('id') ){

			$bookTypeModel = new BookType;
			$bookType      = BookType::findOne( $id );		

			return $this->render( 'update', [
				'model' => $bookTypeModel,	
				'data'  => $bookType,
			]);
		} 
		


	}


}
