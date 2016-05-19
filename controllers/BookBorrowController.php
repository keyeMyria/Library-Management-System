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



class BookBorrowController extends Controller
{
	
	public function actionIndex()
	{
		$session = new Session;
		$bookInfoModel = new BookInfo;
		$connect = Yii::$app->db;

		if( $get = Yii::$app->request->get() ){
					
			$sreachISBN = $get['BookInfo']['bookInfoBookISBN'];

			$sql = "SELECT `PK_bookInfoID`,       `bookInfoBookName`,
							`bookInfoBookISBN` ,  `bookInfoBookAuthor` , 
							`bookInfoBookPrice` , `bookInfoBookPage` ,
							`bookTypeName`,       `bookshelfName`,
							`publisherName`,       COUNT( distinct bookInfoBookISBN ) AS count
						FROM lib_bookInfo
							JOIN lib_bookRelationship 
							JOIN lib_bookType 
							JOIN lib_bookshelf 
							JOIN lib_publisher 
						ON FK_bookInfoID = PK_bookInfoID 
							AND FK_bookTypeID = PK_bookTypeID 
							AND FK_bookshelfID = PK_bookshelfID 
							AND FK_publisherID = PK_publisherID  
						WHERE bookInfoBookISBN = $sreachISBN 
						GROUP BY bookInfoBookISBN";
			$bookInfoData = $connect -> createCommand( $sql ) -> queryOne();	
			if( $bookInfoData ){
											
			} else {

				$session['isShowTip']  = true;
				$session['tipContent'] = '无法查询出此ISBN,请检查后重试';
				$session['tipLevel']   = 2;

				$bookInfoData = false;	
			}


			
			return $this -> render('index', [
 				'session'      => $session,
				'bookInfoData' => $bookInfoData,	
				'bookInfoModel' => $bookInfoModel,
			]);


		} else {

			return $this -> render('index', [
				'session' => $session,	
				'bookInfoModel' => $bookInfoModel,
			]);		
		}
		
	
	}	


}
















?>
