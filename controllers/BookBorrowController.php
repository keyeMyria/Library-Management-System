<?php

/*
 * 图书借阅 
 *		使用流程： 先输入 要借图书的 ISBN 号，然后查询出这本书的信息
 *				   点击 “确认借阅” 按钮
 */

namespace app\controllers;

use yii\web\Controller;
use yii\web\Session;
use Yii;


use app\models\BookInfo;
use app\models\BookBorrow;


class BookBorrowController extends Controller
{
	
	// 借阅周期， 1 代表 1个月， 2 代表 2个月
	public $borrowCycle = 3; 


	public function actionIndex()
	{
		$session         = new Session;
		$bookInfoModel   = new BookInfo;
		$bookBorrowModel = new BookBorrow;

		$connect = Yii::$app->db;
		$request = Yii::$app->request;
if( $post = $request -> post() ){

			// 在 图书借阅 页面 点击 “ 确认借阅 ” 按钮	

			$result = $this -> confirmBorrow( $post );

			$session['isShowTip'] = true;	
			if( $result == 1 ){

				$session['tipContent'] = '借阅成功';
				$session['tipLevel']   = 1;

			} elseif( $result == 2 ){

				$session['tipContent'] = '超过借阅数量限制,请归还部分书籍后再尝试借阅';
				$session['tipLevel']   = 2;
			
			}

			return $this -> redirect('index');	
		}

		if( $get = $request->get() ){
			
			// 在 图书借阅 页面 提交了 ISBN 号查询			
		
			$sreachISBN   = $get['BookInfo']['bookInfoBookISBN'];
			$bookInfoData = $bookBorrowModel -> queryBookInfoByISBN( $connect, $sreachISBN );


			if( $bookInfoData ){

			} else {

				$session['isShowTip']  = true;
				$session['tipContent'] = '无法查询出此ISBN,请检查后重试';
				$session['tipLevel']   = 2;

				$bookInfoData = null;	
			}

			return $this -> render('index', [
 				'session'      => $session,
				'bookInfoData' => $bookInfoData,	
				'bookInfoModel' => $bookInfoModel,
			]);

		} else {

			// 第一次进入 图书借阅页面， 通过在点击 图书归还 页面的 "添加借阅" 按钮

			return $this -> render('index', [
				'session'       => $session,	
				'bookInfoModel' => $bookInfoModel,
				'bookInfoData'  => null,
			]);		
		}



		
	}	






	/**
	 * 从 actionIndex() 分出来的功能, 归属与 actionIndex() 的 post 提交处理部分
	 * 当 在图书借阅页面 查询出了 图书信息之后  点击了 “确认借阅 ” 按钮
	 */
	public function confirmBorrow( $post )
	{
		$bookBorrowModel = new BookBorrow;
		$session         = new Session;
		$connect = Yii::$app->db;

		$readerID = $session['readerID'];
		$allowBorrowNumber = $bookBorrowModel -> getAllowBorrowNumber( $connect , $readerID );

		$borrowedCount     = BookBorrow::find() -> where(['borrowIsReturn' => '0', 'FK_bookInfoID' => $readerID ]) -> count();


		$isAllowBorrow = $allowBorrowNumber - $borrowedCount;


		if( $isAllowBorrow ){

			$timeData = $bookBorrowModel -> borrowTimestamp( $this->borrowCycle  );
					
			$bookBorrowModel -> FK_bookInfoID         = $post['bookInfoID'];
			$bookBorrowModel -> FK_readerID           = $session['readerID'];
			$bookBorrowModel -> borrowBeginTimestamp  = $timeData['beginTime'];
			$bookBorrowModel -> borrowReturnTimestamp = $timeData['endTime'];
			$bookBorrowModel -> borrowIsReturn        = 0;
			
			if( $bookBorrowModel -> save() ){
				// 借阅成功
				return 1;	
			}
		} else {
			// 该用户借阅图书数量超过限制
			return 2;	
		}
	
	}




}


?>
