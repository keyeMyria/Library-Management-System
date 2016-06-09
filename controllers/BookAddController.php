<?php

/**
 * 图书添加功能
 *
 */

namespace app\controllers;

use yii\web\Controller;
use yii\web\Session;
use Yii;

use app\models\BookType;
use app\models\Publisher;
use app\models\Bookshelf;
use app\models\BookAdd;
use app\models\BookInfo;
use app\models\BookRelationship;

class BookAddController extends Controller
{

	# 新增条目成功时，提示的内容
	public $addTipContent = '添加成功';


	/**
	 * 图书添加模块的 显示输入框 和 处理数据 的方法
	 */
	public function actionBookAdd()
	{
		
		$session = new Session;

		if ( $post = Yii::$app->request->post() ){
		
			// 存入把数据存入 lib_bookInfo 表，返回 id
	
			$bookInfoID = $this -> bookInfoSave( $post );

			$result     = $this -> bookRelationship( $post, $bookInfoID);
			dump( $result );exit;
			
			if( $result ){

				$session['tipContent'] = $this -> addTipContent;		
				$session['isShowTip']  = true;
				return $this->redirect('book-add');
			}

		} else {

			$model = new BookAdd;
			$data = $model -> combineDropDownListData();	

			return $this->render('index', [

				'bookTypeData'  => $data[0],
				'publisherData' => $data[1],
				'bookshelfData' => $data[2],
				'model'         => $model,	
				'session'       => $session,
			]);	
		}
	}


	/**
	 * 保存 $post 数据进 lib_bookInfo 数据表
	 * @return $primaryKey 新插入条目所返回的主键
	 */
	public function bookInfoSave( $post )
	{
		$BookInfoModel = new BookInfo;	
		$BookInfoModel -> bookInfoBookName       = $post['BookAdd']['bookInfoBookName'];
		$BookInfoModel -> bookInfoBookISBN       = $post['BookAdd']['bookInfoBookISBN'];
		$BookInfoModel -> bookInfoBookAuthor     = $post['BookAdd']['bookInfoBookAuthor'];
		$BookInfoModel -> bookInfoBookTranslator = $post['BookAdd']['bookInfoBookTranslator'] ? $post['BookAdd']['bookInfoBookTranslator'] : null;
		$BookInfoModel -> bookInfoBookPrice      = $post['BookAdd']['bookInfoBookPrice'];
		$BookInfoModel -> bookInfoBookPage       = $post['BookAdd']['bookInfoBookPage'];
	
		$BookInfoModel -> save();
		return $BookInfoModel -> getPrimaryKey();
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

