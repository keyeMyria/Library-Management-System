<?php

/*
 * 读者搜索控制器
 */


namespace app\controllers;

use yii\web\Controller;
use yii\web\Session;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use Yii;


use app\models\ReaderSreach;
use app\models\Reader;
use app\models\ReaderType;


class ReaderSreachController extends Controller
{
	// 搜索结果 一页内显示的数据条数
	public $defaultPageSize = 8;

	// 定义搜索结果的 图书名 的长度
	public $viewBookNameLength = 36;

	public $defaultAction = 'sreach';


	/**
	 * 读者搜索
	 */
	public function actionSreach()
	{

		$session = new Session;
		$sreachTypeArr = [
			'readerName'    => '按姓名',	
			'readerNumber'  => '读编号',	
		];

		if ( $get = Yii::$app->request->get()){
			
			$sreachText = $get['sreachText'];
			$ReaderSreachModel = new ReaderSreach;

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

				$sreachResult     = $ReaderSreachModel -> readerSreach( $get );
				$sreachResultInfo = $ReaderSreachModel -> getSreachResultInfo();

				$cloneQuery = clone $sreachResult;

				// 分页
				$pages = new Pagination(['totalCount' => $cloneQuery->count() ] );
				$pages -> defaultPageSize = $this -> defaultPageSize;

				$models = $sreachResult -> offset( $pages->offset ) -> limit( $pages->limit ) -> all();
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

			$reader  = Reader::findOne( $get['id'] );

			if ( $reader -> delete() ){

					$session['checkIsShowTipNum'] = 1;

					$url = $_SERVER['HTTP_REFERER'];
					echo "<script> location.href = '{$url}' </script>";
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


			$reader = Reader::findOne( $post['PK_readerID'] );	

			$reader -> readerName    = $post['Reader']['readerName'];
			$reader -> readerNumber	    = $post['Reader']['readerNumber'];
			$reader -> save();

			 $session['checkIsShowTipNum'] = 1;
			$url = $session['recordSreachUrl']; 
			echo "<script> location.href = '{$url}' </script>";
		}

		
		if ( $get = Yii::$app->request->get() )	{
			// 从图书搜索结果页面点击 “编辑” 过来的


			// 把原来的 图书搜索结果页面的 url 保存下来，等下编辑完成后可以跳转回去
			$session['recordSreachUrl'] = $_SERVER['HTTP_REFERER'];
			$session['isShowTip'] = false;
			
			$readerModel = new Reader;
			$data = $this -> getEditNeedData( $get['id'] );

			return $this->render('edit', [
			
				'model'				=> $readerModel,
				'session'			=> $session,
				'readerData'		=> $data['reader'],
				'readerTypeData'    => $data['readerType'],
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
			$data = Reader::find()->where(['PK_readerID' => $id])->asArray() -> one();
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
		$data['reader'] = Reader::find()->where([ 'PK_readerID' => $id ])->asArray()-> one();		
		$readerType = ReaderType::find() -> asArray() -> all(); 

        foreach ( $readerType as $key => $value ) {
             $data['readerType'][ $readerType[$key]['PK_readerTypeID']] = $readerType[$key]['readerTypeName'];
       	 }

		return $data;
	}










}
