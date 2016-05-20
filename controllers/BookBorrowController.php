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

			$timeData = $bookBorrowModel -> borrowTimestamp( $this->borrowCycle  );
			
			$bookBorrowModel -> FK_bookInfoID         = $post['bookInfoID'];
			$bookBorrowModel -> FK_readerID           = $session['readerID'];
			$bookBorrowModel -> borrowBeginTimestamp  = $timeData['beginTime'];
			$bookBorrowModel -> borrowReturnTimestamp = $timeData['endTime'];
			$bookBorrowModel -> borrowIsReturn        = 0;

			if( $bookBorrowModel -> save() ){
				$session['isShowTip'] = true;	
				$session['tipContent'] = '借阅成功';
				$session['tipLevel']   = 1;
				return $this -> redirect('index');	
			}
			
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


}
















?>
