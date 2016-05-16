<?php

/**
 * 图书添加功能
 *
 */

namespace app\controllers;

use yii\web\Controller;
use yii\web\Session;
use Yii;

use app\models\Reader;
use app\models\BookRelationship;
use app\models\ReaderType;

class ReaderAddController extends Controller
{

	# 新增条目成功时，提示的内容
	public $addTipContent = '添加成功';

	# 读者的证件类型	
	public $readerCertificateArr = [
		'学生证' => '学生证',
		'身份证' => '身份证',
	];



	/**
	 * 读者添加模块的 显示输入框 和 处理数据 的方法
	*/
	public function actionIndex()
	{
		
		$session = new Session;

		if ( $post = Yii::$app->request->post() ){


			#dump( $post );exit;
		
			// 存入把数据存入 lib_reader 表，返回 id
	
			$readerID = $this -> readerSave( $post );exit;
			$result     = $this -> bookRelationship( $post, $bookInfoID );
			
			if( $result ){

				$session['tipContent'] = $this -> addTipContent;		
				$session['isShowTip']  = true;
				return $this->redirect('book-add');
			}
 
		} else {

			$model = new Reader;

			$session['isShowTip'] = false;

			$readerType = ReaderType::find()->asArray()->all();

			foreach ( $readerType as $key => $value ){
				$readerTypeData[ $readerType[ $key ]['PK_readerTypeID'] ] = $readerType[ $key ]['readerTypeName']; 	
			}

			return $this->render('index', [

				'model'         => $model,	
				'session'       => $session,
				'readerCertificate' => $this -> readerCertificateArr,
				'readerTypeData' => $readerTypeData,


			]);	
		}
	}


	/**
	 * 保存 $post 数据进 lib_bookInfo 数据表
	 * @return $primaryKey 新插入条目所返回的主键
	 */
	public function readerSave( $post )
	{

		$readerModel = new Reader;	
		$readerModel -> FK_readerTypeID         = $post['readerType'];
		$readerModel -> FK_managerID			= Yii::$app->user->id;
	 	$readerModel -> readerNumber            = $post['Reader']['readerNumber'];
		$readerModel -> readerName              = $post['Reader']['readerName'];
		$readerModel -> readerBirthday          = $post['readerBirthday'];
		$readerModel -> readerCertificate       = $post['readerCertificate'];
		$readerModel -> readerCertificateNumber = $post['Reader']['readerCertificateNumber'];
		$readerModel -> readerPhone             = $post['Reader']['readerPhone'];
		#$readerModel -> readerEmail             = $post['Reader']['readerEmail'];
		
		$readerModel -> readerCreateDate        = date('Y-m-d');
		
	   //	 换一种插入语句	
		$readerModel -> save();
		#return $readerModel -> getPrimaryKey();
		$a = $readerModel -> getPrimaryKey();

		dump( $a );exit;
	}


	public function bookRelationship( $post, $bookInfoID )
	{
		$BookRelationshipModel = new BookRelationship;	
		$BookRelationshipModel -> FK_bookInfoID  = $bookInfoID;
		$BookRelationshipModel -> FK_publisherID = $post['publisher'];
		$BookRelationshipModel -> FK_bookTypeID  = $post['bookType'];
		$BookRelationshipModel -> FK_bookshelfID = $post['bookshelf'];
		$BookRelationshipModel -> FK_managerID   = Yii::$app->user->id;
		$BookRelationshipModel -> bookRelationshipStorageTime = date('Y-m-d'); 

		return $BookRelationshipModel -> save();
	}





}

