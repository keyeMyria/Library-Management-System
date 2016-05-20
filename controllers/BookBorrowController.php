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
	
	public function actionIndex()
	{
		$session         = new Session;
		$bookInfoModel   = new BookInfo;
		$bookBorrowModel = new BookBorrow;

		$connect = Yii::$app->db;
		$request = Yii::$app->request;

		if( $post = $request -> post() ){
			// 在 图书借阅 页面 点击 “ 确认借阅 ” 按钮	
			dump( $post );exit;
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
				'session' => $session,	
				'bookInfoModel' => $bookInfoModel,
				'bookInfoData' => null,
			]);		
		}



		
	}	


}
















?>
