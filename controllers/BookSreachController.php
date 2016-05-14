<?php

namespace app\controllers;

use yii\web\Controller;
use yii\web\Session;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use Yii;


use app\models\BookSreach;
use app\models\BookInfo;
use app\models\BookRelationship;


class BookSreachController extends Controller
{
	// 搜索结果 一页内显示的数据条数
	public $defaultPageSize = 6;

	// 定义搜索结果的 图书名 的长度
	public $viewBookNameLength = 36;
	

	public $defaultAction = 'sreach';


	/**
	 * 图书搜索
	 */
	public function actionSreach()
	{

		$session = new Session;
		$sreachTypeArr = [
			'bookName'  => '按书名',	
			'bookISBN'  => '按ISBN',	
			'publisher' => '按出版社',
			'author'    => '按作者',
			'bookshelf' => '按书架',
		];

		if ( $get = Yii::$app->request->get()){
			

			$sreachText = $get['sreachText'];
			$bookSreachModel = new BookSreach;

			if( empty( $get['sreachText']) ){

				// 有 get 提交，但搜索框却啥都没填		
				$session['isShowTip']  = true;					
				$session['tipContent'] = '请输入要搜索的内容';

				$pages  = null;
				$models = null;
				$sreachResult     = null;
				$sreachResultInfo = null;

			} else {

				$session['isShowTip'] = false;

				$sreachResult       = $bookSreachModel -> bookSreach( $get );
				$sreachResultInfo  = $bookSreachModel -> getSreachResultInfo();

				$cloneQuery = clone $sreachResult;

				// 分页
				$pages = new Pagination(['totalCount' => $cloneQuery->count() ] );
				$pages -> defaultPageSize = $this -> defaultPageSize;

				$models = $sreachResult -> offset( $pages->offset ) -> limit( $pages->limit ) -> all();
				$models = $this -> cutBookName( $models ); # 此方法检查要输出到 view 的书名是否过长, 如果过长则 cut 短点.

			}
			
			// 判断是否出现 tip 层
			if( $session['checkIsShowTipNum'] ){
				$session['isShowTip']  = true;	
				$session['tipContent'] = '操作成功'; 
				$session['checkIsShowTipNum'] = 0;  // 归位，以防止刷新时重新出现 tip 
			}

			return $this -> render('index', [
				'pages'			   => $pages,
				'models'		   => $models,
				'session'          => $session,
				'sreachType'       => $sreachTypeArr,	
				'sreachText'       => $sreachText,
				'sreachResult'     => $sreachResult,	
				'sreachResultInfo' => $sreachResultInfo,
			]);

		} else {
			
			// 第一次进入 图书搜索页面		
			$session['isShowTip'] = false;
			
			return $this -> render('index', [
				'session'    => $session,
				'sreachType' => $sreachTypeArr,	
			
			]);	
		}	
	
	
	}



	/*
	 * 图书搜索结果中的删除方法
	 *
	 */  
	public function actionDel()
	{
		$session = new Session;

		if ( $get = Yii::$app->request->get() ){

			$bookInfo  = BookInfo::findOne( $get['id'] );

			if ( $bookInfo ){

				$bookRelspData  = BookRelationship::find()-> where([ 'FK_bookInfoID' => $bookInfo->PK_bookInfoID ]) -> one();
				$bookRelsp      = BookRelationship::findOne( $bookRelspData ->PK_bookRelationshipID );
				
				if( $bookRelsp -> delete() ){
					$bookInfo -> delete();	

					$session['checkIsShowTipNum'] = 1;

					$url = $_SERVER['HTTP_REFERER'];
					echo "<script> location.href = '{$url}' </script>";
				}
			}




			
		}
	
	}








	/*
	 * 此方法被 $this -> actionSreach() 所调用。
	 * 负责对超长的 图书名称 进行 cut， 好让 view 层输出的更优美.
	 *
	 */
	public function cutBookName( $data )
	{
		foreach( $data as $key => $value )
		{
			$bookName =  $data[$key]['bookInfoBookName'] ;
			
			if ( mb_strlen( $bookName ) > $this -> viewBookNameLength ){ $data[$key]['bookInfoBookName'] = mb_substr( $bookName , 0 , $this->viewBookNameLength) . "....";
			}
		}
		return $data;
	}



}
