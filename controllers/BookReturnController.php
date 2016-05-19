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

		if ( $post = Yii::$app->request->post() ){

			$readerData = $bookReturnModel -> getReaderInfo( $post['Reader']['readerNumber'] );	
			if( $readerData ){
				
			} else {

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


}



?>
