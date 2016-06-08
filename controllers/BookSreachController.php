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
use app\models\BookType;
use app\models\Bookshelf;
use app\models\Publisher;


class BookSreachController extends Controller
{
	// 搜索结果 一页内显示的数据条数
	public $defaultPageSize = 6;
	public $defaultPageSize_large = 10;

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
			$bookInfoModel   = new BookInfo;

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

				$sreachResult      = $bookSreachModel -> bookSreach( $get );
				$sreachResultInfo  = $bookSreachModel -> getSreachResultInfo();

				$cloneQuery = clone $sreachResult;

				// 分页
				$pages = new Pagination(['totalCount' => $cloneQuery->count() ] );
				$pages -> defaultPageSize = $this -> defaultPageSize;

				$models = $sreachResult  -> offset( $pages->offset ) -> limit( $pages->limit ) -> all();
				$models = $bookInfoModel -> cutBookName( $models , 25 );

				// 大屏专用数据
				$pages_large = new Pagination(['totalCount' => $cloneQuery->count() ] );
				$pages_large -> defaultPageSize = $this -> defaultPageSize_large;

				$models_large = $sreachResult  -> offset( $pages_large->offset ) -> limit( $pages_large->limit ) -> all();
				$models_large = $bookInfoModel -> cutBookName( $models_large , 25 );

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
				'pages_large'	   => $pages_large,
				'models_large'	   => $models_large,
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
	 * 图书搜索结果 中的编辑 方法
	 */
	public function actionEdit()
	{
		$session = new Session;

		if( $post = Yii::$app->request->post() ){
			// 从编辑页面提交

			$bookInfo = BookInfo::findOne( $post['bookInfoID'] );	
			$bookRels = BookRelationship::findOne( $post['bookInfoID'] );

			$bookInfo -> bookInfoBookISBN	    = $post['BookInfo']['bookInfoBookISBN'];
			$bookInfo -> bookInfoBookName	    = $post['BookInfo']['bookInfoBookName'];
			$bookInfo -> bookInfoBookAuthor     = $post['BookInfo']['bookInfoBookAuthor'];
			$bookInfo -> bookInfoBookTranslator = $post['BookInfo']['bookInfoBookTranslator'];
			$bookInfo -> bookInfoBookPrice      = $post['BookInfo']['bookInfoBookPrice'];
			$bookInfo -> bookInfoBookPage       = $post['BookInfo']['bookInfoBookPage'];
			$bookInfo -> save();

			$bookRels -> FK_bookTypeID  = $post['bookType'];
			$bookRels -> FK_bookshelfID = $post['bookshelf'];
			$bookRels -> FK_publisherID = $post['publisher'];
			$bookRels -> save();

			 $session['checkIsShowTipNum'] = 1;
			$url = $session['recordSreachUrl']; 
			echo "<script> location.href = '{$url}' </script>";
		}

		
		if ( $get = Yii::$app->request->get() )	{
			// 从图书搜索结果页面点击 “编辑” 过来的


			// 把原来的 图书搜索结果页面的 url 保存下来，等下编辑完成后可以跳转回去
			$session['recordSreachUrl'] = $_SERVER['HTTP_REFERER'];
			$session['isShowTip'] = false;
			
			$bookInfoModel = new BookInfo;
			$data = $this -> getEditNeedData( $get['id'] );

			return $this->render('edit', [
			
				'model' => $bookInfoModel,
				'session' => $session,
				'bookInfoData'  => $data['bookInfoData'],
				'bookRelsData'  => $data['bookRelsData'],
				'bookTypeData'  => $data['bookTypeData'],
				'bookshelfData' => $data['bookshelfData'],
				'publisherData' => $data['publisherData'],
			]);
		}
	}





	/**
	 * 图书搜索结果 中的 “ 查看更多 ”
	 */
	public function actionViewMore()
	{

		$connect = Yii::$app->db;
	
		if( $get = Yii::$app->request->get() ){
			$id  = $get['id'];
			$sql = "SELECT `bookInfoBookISBN`, `bookInfoBookName`, `bookInfoBookAuthor`, `bookInfoBookTranslator`, `bookInfoBookPrice`, `bookInfoBookPage`, `managerUsername`, `bookRelationshipStorageTime`, `bookTypeName`, `bookshelfName`, `publisherName`
			   	FROM lib_bookInfo  AS b JOIN lib_bookRelationship AS r JOIN lib_publisher AS p JOIN lib_bookType AS t JOIN lib_bookshelf AS f JOIN lib_manager AS m
				ON b.PK_bookInfoID = r.FK_bookInfoID AND r.FK_publisherID = p.PK_publisherID AND r.FK_bookTypeID = t.PK_bookTypeID AND r.FK_bookshelfID = f.PK_bookshelfID AND r.FK_managerID = m.PK_managerID
				WHERE PK_bookInfoID = $id";
			$data = $connect -> createCommand( $sql ) -> queryOne();

			return $this->render('viewMore', [
				'data' => $data,	
			]);
		}		
	
	}
	











	/*
	 * 取出 $this->actionEdit() 方法中所需的数据
	 * @return $array 返回数组，键名为表名，键值为一个数组，里面为 'id' => 'name' 的形式
	 */ 
	public function getEditNeedData( $id )
	{
		$data['bookInfoData']  = BookInfo::find()->where([ 'PK_bookInfoID' => $id ]) -> one();		
		$data['bookRelsData']  = BookRelationship::find()->where([ 'FK_bookInfoID' => $id ]) -> one();

		$bookType  =  BookType::find()->asArray()->all();
		$bookshelf = Bookshelf::find()->asArray()->all();
		$publisher = Publisher::find()->asArray()->all();

		foreach ( $bookType as $key => $value ) {
			$bookTypeData[ $bookType[$key]['PK_bookTypeID']] = $bookType[$key]['bookTypeName'];
		}

		foreach ( $bookshelf as $key => $value ) {
			$bookshelfData[ $bookshelf[$key]['PK_bookshelfID'] ] = $bookshelf[$key]['bookshelfName'];
		}

		foreach ( $publisher as $key => $value ) {
			$publisherData[ $publisher[$key]['PK_publisherID'] ]  = $publisher[$key]['publisherName'];
		}
		
		$data['bookTypeData']  = $bookTypeData;
		$data['bookshelfData'] = $bookshelfData;
		$data['publisherData'] = $publisherData;
  
		return $data;
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
