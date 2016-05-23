<?php

/**
 * 图书借阅控制器
 *		功能有：
 *				增加借阅
 *				登入读者
 *				列出此读者已借图书
 *				续借图书
 *				归还图书
 */

namespace app\controllers;

use yii\web\Controller;
use yii\web\Session;
use yii\data\Pagination;
use yii\helpers\Url;
use Yii;

use app\models\Reader;
use app\models\BookReturn;
use app\models\BookBorrow;


class BookReturnController extends Controller
{

	# 借阅数据的分页条数 (每页)
	public $defaultPageSize = 5;

		
	/*
	 * 没有 Get 和 没有 Session 数据时，展示 “读者编号验证页面”
	 * 有 Get 提交 或 Session 数据时，展示 “归还页面” （里面有 该读者信息，和他借阅了什么书）
	 */
	public function actionIndex()
	{

		$session = new Session;
		$bookReturnModel = new BookReturn;

		$connect = Yii::$app->db;

		if ( $get = Yii::$app->request->get()  ){
			
			// 通过 get 进入到 图书归还页面
			$readerNumber = $get['Reader']['readerNumber'];

			$readerData  = $bookReturnModel -> getReaderInfo( $connect, $readerNumber );	


			if( $readerData ){

				// 读者编号 验证成功
				$session['readerNumber'] = $readerData['readerNumber'];	
				$session['readerID']     = $readerData['PK_readerID'];

			} else {

				// 读者编号 验证失败
				$session['isShowTip']  = true;
				$session['tipContent'] = '没有查询到此读者信息，请确认输入是否正确';
				return $this->redirect('index'); // 等于跳回验证页面
			}

			// 根据此读者 ID, 查出借阅图书
			$borrowQuery = $bookReturnModel -> getBorrowInfo( $connect, $readerData['PK_readerID'] );

			$cloneQuery = clone $borrowQuery;
			$borrowedCount = BookBorrow::find()->where(['and', 'borrowIsReturn = 0', 'FK_readerID = ' . $readerData['PK_readerID']  ])->count();

			$pages = new Pagination(['totalCount' => $cloneQuery->count() ]);
			$pages -> defaultPageSize = $this -> defaultPageSize;

			$models = $borrowQuery -> offset( $pages->offset ) 
					               -> limit(  $pages->limit ) 
					               -> all();

			return $this -> render( 'index' , [

				'pages'         => $pages,	
				'models'        => $models,
				'session'       => $session, 	
				'readerData'    => $readerData,
				'borrowedCount' => $borrowedCount,
			]);


		} elseif( isset( $session['readerNumber']) ){

			// 通过 Session 进入 “归还页面”  ( 但始终都是跳转回 get 提交，因为要分页呀)
		
			$url = 'book-return/index?Reader[readerNumber]=' . $session['readerNumber'] . '&page=1' ;

			# 用完 $session['readerNumber'] 后，注销掉，避免重复跳转
			unset( $session['readerNumber'] );
			return $this -> redirect([$url]);	

		} else {
			
			// 没有 Get 数据 也没有 Session 数据, 显示 “读者验证页面”
			
			$readerModel = new Reader;
			return $this -> render('verify', [
				'readerModel' => $readerModel,		
				'session'     => $session,
			]);	
		}
	
	}



	/*
	 * 在图书归还页， 点击左上角的 “切换读者” 所处理的方法
	 * 把当前的 $session['readerNumber'] 销毁，然后跳转回 actionIndex
	 */ 
	public function actionLogout()
	{
		$session = new Session;

		if( isset( $session['readerNumber'] ) ){
			unset( $session['readerNumber'] );	
		}	

		return $this->redirect('index');
	}

	


	/*
	 * 图书归还 中的 “借阅图书” 按钮
	 */
	public function actionBorrow()
	{
		return $this -> redirect(['book-borrow/index']);	
	}




	 /*
	  * 图书续借
	  */
	public function actionRenew()
	{
		$session = new Session;
		$bookReturnModel = new BookReturn;
		$borrowID = Yii::$app->request->get();	
		$result = $bookReturnModel -> renew( $borrowID );

		$session['isShowTip'] = true;

		if( $result == 1){
			$session['tipContent'] = '续借成功';
		} elseif ( $result == 2 ){
			$session['tipContent'] = '此书早已归还，无需续借';	
		}

		return $this->redirect(['index']);	

	}



	/**
	 * 图书归还
	 */
	public function actionReturn()
	{
		$session = new Session;
		$borrowID = Yii::$app->request->get();	
		$bookReturnModel = new BookReturn;
		$result = $bookReturnModel -> returnBook( $borrowID );
				
		$session['isShowTip'] = true;

		if( $result == 1 ){

			$session['tipContent'] = '归还成功';

		} elseif ( $result == 2){

			$session['tipContent'] = '此书已归还，无需重复归还';

		}
			
		return $this->redirect(['index']);	
	}


}



?>
