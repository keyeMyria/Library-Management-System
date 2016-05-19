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
use Yii;

use app\models\Reader;
use app\models\BookReturn;



class BookReturnController extends Controller
{

		
	public function actionIndex()
	{

		$session = new Session;
		$bookReturnModel = new BookReturn;

		if ( isset( $session['readerNumber'] ) ){
			// session 中的读者编号还在	
			$readerData = $bookReturnModel -> getReaderInfo( $session['readerNumber'] );	
			return $this -> render( 'index' , [
				'session' => $session, 	
				'readerData' => $readerData,
			]);
				
		}

		if ( $get = Yii::$app->request->get() ){

			$readerData = $bookReturnModel -> getReaderInfo( $get['Reader']['readerNumber'] );	

			if( $readerData ){
				// 读者编号 验证成功
				$session['readerNumber'] = $readerData -> readerNumber;								

			} else {

				// 读者编号 验证失败
				$session['isShowTip'] = true;
				$session['tipContent'] = '没有查询到此读者信息，请确认输入是否正确';
				return $this->redirect('index'); // 等于跳回验证页面
			}

			return $this -> render( 'index' , [
				'session' => $session, 	
				'readerData' => $readerData,
			]);

		} else {


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

}



?>
